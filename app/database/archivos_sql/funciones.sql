-- Function: capitalize(text)

--DROP FUNCTION IF EXISTS capitalize(text);

CREATE OR REPLACE FUNCTION capitalize(TEXT)
  RETURNS TEXT AS
  $BODY$
  DECLARE
    total TEXT;
  BEGIN
    SELECT concat(UPPER(LEFT($1, 1)) :: TEXT, LOWER(SUBSTRING($1, 2, length($1))) :: TEXT)
    INTO total;
    RETURN total;
  END;
  $BODY$
LANGUAGE plpgsql VOLATILE
COST 100;


-- Function: formato_unidad_objeto(text, text)

DROP FUNCTION IF EXISTS formato_unidad_objeto(text, text);

CREATE OR REPLACE FUNCTION formato_unidad_objeto(nombre TEXT, abrev TEXT)
  RETURNS TEXT AS
  $BODY$
  DECLARE
    retorno TEXT;
  BEGIN
    SELECT capitalize(lower(nombre)) || ' (' || abrev || ')'
    INTO retorno;
    RETURN retorno;
  END;
  $BODY$
LANGUAGE plpgsql VOLATILE
COST 100;


-- Function: formato_nombre_completo(text, text)

DROP FUNCTION IF EXISTS formato_nombre_completo(text, text);

CREATE OR REPLACE FUNCTION formato_nombre_completo(nombre TEXT, apellido TEXT)
  RETURNS TEXT AS
  $BODY$
  DECLARE
    retorno TEXT;
  BEGIN
    SELECT capitalize(lower(nombre)) || ' ' || capitalize(lower(apellido))
    INTO retorno;
    RETURN retorno;
  END;
  $BODY$
LANGUAGE plpgsql VOLATILE
COST 100;



-- Function: permisos_usuario(int)

--DROP FUNCTION IF EXISTS permisos_usuario(int);

--Funcion para obtener todos los permisos de un usuario en especifico
CREATE OR REPLACE FUNCTION permisos_usuario(INT)
  RETURNS JSON AS
  $BODY$
  DECLARE
    permisos JSON;
  BEGIN
    SELECT array_to_json(
        array_agg(
            row_to_json(campos)
        )
    )
    FROM (
           SELECT
             permisos_usuarios.cod_permiso,
             permisos.nombre
           FROM permisos_usuarios
             INNER JOIN permisos ON permisos.codigo = permisos_usuarios.cod_permiso
           WHERE permisos_usuarios.usuario_id = $1
         ) AS campos
    INTO permisos;

    RETURN permisos;
  END;
  $BODY$
LANGUAGE plpgsql VOLATILE
COST 100;


-- Function: public.mover_stock_laboratorio(text, text, text, text, text, integer, integer)

--DROP FUNCTION IF EXISTS public.mover_stock_laboratorio(text, text, text, text, text, integer, integer);

CREATE OR REPLACE FUNCTION public.mover_stock_laboratorio(
  _cod_laboratorio         TEXT,
  _cod_laboratorio_destino TEXT,
  _cod_dimension           TEXT,
  _cod_subdimension        TEXT,
  _cod_agrupacion          TEXT,
  _cod_objeto              INTEGER,
  _numero_orden            INTEGER,
  _cantidad_mover          INTEGER)

  RETURNS BOOLEAN AS
  $BODY$
  DECLARE
    cantidad_actual         INTEGER;
    cantidad_restante       INTEGER;
    cantidad_objeto_destino INTEGER;
    id_objeto               INTEGER;
  BEGIN
    -- Buscamos la cantidad actual del elemento en el laboratorio origen
    SELECT cantidad
    INTO cantidad_actual
    FROM objetos_laboratorio
    WHERE
      cod_laboratorio = _cod_laboratorio :: TEXT AND
      cod_dimension = _cod_dimension AND
      cod_subdimension = _cod_subdimension AND
      cod_agrupacion = _cod_agrupacion AND
      cod_objeto = _cod_objeto AND
      numero_orden = _numero_orden;

    SELECT cantidad_actual - _cantidad_mover
    INTO cantidad_restante;

    --IF cantidad_restante = 0
    --THEN
    --  DELETE FROM objetos_laboratorio WHERE
    --    cod_laboratorio = _cod_laboratorio :: TEXT AND
    --    cod_dimension = _cod_dimension AND
    --    cod_subdimension = _cod_subdimension AND
    --    cod_agrupacion = _cod_agrupacion AND
    --    cod_objeto = _cod_objeto AND
    --    numero_orden = _numero_orden;
    --END IF

    IF cantidad_actual <> cantidad_restante AND cantidad_restante >= 0
    THEN
      ---Si cambio la cantidad se actualiza el objeto en la tabla
      UPDATE objetos_laboratorio
      SET cantidad = cantidad_restante, updated_at = NOW()
      WHERE
        cod_laboratorio = _cod_laboratorio :: TEXT AND
        cod_dimension = _cod_dimension AND
        cod_subdimension = _cod_subdimension AND
        cod_agrupacion = _cod_agrupacion AND
        cod_objeto = _cod_objeto AND
        numero_orden = _numero_orden;

      --Verificamos si el objeto que se movera existe en el laboratorio destino
      SELECT
        id,
        cantidad
      INTO id_objeto, cantidad_objeto_destino
      FROM objetos_laboratorio
      WHERE cod_laboratorio = _cod_laboratorio_destino :: TEXT AND
            cod_dimension = _cod_dimension AND
            cod_subdimension = _cod_subdimension AND
            cod_agrupacion = _cod_agrupacion AND
            cod_objeto = _cod_objeto AND
            numero_orden = _numero_orden;

      -- Si el objeto existe en el laboratorio destino se actualiza
      IF id_objeto IS NOT NULL
      THEN

        --Si existe el objeto en el laboratorio destino se actualiza su cantidad
        UPDATE objetos_laboratorio
        SET cantidad = (cantidad_objeto_destino + _cantidad_mover), updated_at = NOW()
        WHERE
          cod_laboratorio = _cod_laboratorio_destino :: TEXT AND
          cod_dimension = _cod_dimension AND
          cod_subdimension = _cod_subdimension AND
          cod_agrupacion = _cod_agrupacion AND
          cod_objeto = _cod_objeto AND
          numero_orden = _numero_orden;

        RETURN TRUE; --Retornamos true para hacer saber que se hizo el procedimiento

      ELSE
        --Si no existe el objeto en el laboratorio destino se crear con la cantidad
        INSERT INTO objetos_laboratorio (
          cod_laboratorio, cod_dimension, cod_subdimension, cod_agrupacion,
          cod_objeto, numero_orden, cantidad, created_at, updated_at)
        VALUES (_cod_laboratorio_destino,
                _cod_dimension,
                _cod_subdimension,
                _cod_agrupacion,
                _cod_objeto, _numero_orden, _cantidad_mover, NOW(), NOW());

        RETURN TRUE; --Retornamos true para hacer saber que se hizo el procedimiento

      END IF;
    ELSE
      RETURN FALSE; --Retornamos false por si no se hace el procedimiento
    END IF;
  END;
  $BODY$
LANGUAGE plpgsql VOLATILE
COST 100;


-- Function: public.agregar_stock_laboratorio(text, text, text,integer, text ,integer);

DROP FUNCTION IF EXISTS public.agregar_stock_laboratorio( TEXT, TEXT, TEXT, INTEGER, INTEGER, TEXT, INTEGER );

CREATE OR REPLACE FUNCTION public.agregar_stock_laboratorio(
  _cod_dimension    TEXT,
  _cod_subdimension TEXT,
  _cod_agrupacion   TEXT,
  _cod_objeto       INTEGER,
  _numero_orden     INTEGER,
  _cod_laboratorio  TEXT,
  _cantidad         INTEGER)

  RETURNS BOOLEAN AS
  $BODY$
  DECLARE
    id_stock_laboratorio           INTEGER;
    cantidad_existente             INTEGER;
    cantidad_disponible_inventario INTEGER;
  BEGIN
    --Consultamos al inventario para ver si la cantidad que se esta
    --agregando no es mayor a la existente
    SELECT cantidad_disponible :: INTEGER
    INTO cantidad_disponible_inventario
    FROM inventario
    WHERE
      cod_dimension = _cod_dimension AND
      cod_subdimension = _cod_subdimension AND
      cod_agrupacion = _cod_agrupacion AND
      cod_objeto = _cod_objeto AND
      numero_orden = _numero_orden
    LIMIT 1;

    IF _cantidad > 0 AND (_cantidad <= cantidad_disponible_inventario)
    THEN
      SELECT
        id,
        cantidad
      INTO id_stock_laboratorio, cantidad_existente
      FROM objetos_laboratorio
      WHERE
        cod_dimension = _cod_dimension AND
        cod_subdimension = _cod_subdimension AND
        cod_agrupacion = _cod_agrupacion AND
        cod_objeto = _cod_objeto AND
        numero_orden = _numero_orden AND
        cod_laboratorio = _cod_laboratorio;

      IF id_stock_laboratorio IS NULL
      THEN
        INSERT INTO objetos_laboratorio (
          cod_laboratorio, cod_dimension, cod_subdimension, cod_agrupacion,
          cod_objeto, numero_orden, cantidad, created_at, updated_at)
        VALUES (_cod_laboratorio, _cod_dimension,
                _cod_subdimension, _cod_agrupacion, _cod_objeto, _numero_orden,
                _cantidad, NOW(), NOW());

        RETURN TRUE;
      ELSE
        UPDATE objetos_laboratorio
        SET cantidad = (cantidad_existente + _cantidad), updated_at = NOW()
        WHERE
          id = id_stock_laboratorio AND
          cod_dimension = _cod_dimension AND
          cod_subdimension = _cod_subdimension AND
          cod_agrupacion = _cod_agrupacion AND
          cod_objeto = _cod_objeto AND
          numero_orden = _numero_orden AND
          cod_laboratorio = _cod_laboratorio;

        RETURN TRUE;
      END IF; -- Condicion id_stock_laboratorio IS NULL
    END IF;
    -- Condicion _cantidad > 0 AND (_cantidad <= cantidad_disponible_inventario)
    RETURN FALSE;
  END;
  $BODY$
LANGUAGE plpgsql VOLATILE
COST 100;


-- Function: public.obtener_cantidad_disponible_elemento(text, text, text, integer)

-- DROP FUNCTION public.obtener_cantidad_disponible_elemento(text, text, text, integer);

CREATE OR REPLACE FUNCTION public.obtener_cantidad_disponible_elemento(
  _cod_dimension    TEXT,
  _cod_subdimension TEXT,
  _cod_agrupacion   TEXT,
  _cod_objeto       INTEGER)
  RETURNS NUMERIC AS
  $BODY$
  DECLARE
    total_inventario NUMERIC;
    total_retenido   NUMERIC;
  BEGIN
    --Consultamos la cantidad disponible en el inventario
    SELECT SUM(cantidad_disponible)
    INTO total_inventario
    FROM inventario
    WHERE
      cod_dimension = _cod_dimension AND
      cod_subdimension = _cod_subdimension AND
      cod_agrupacion = _cod_agrupacion AND
      cod_objeto = _cod_objeto;

    --Consultamos la cantidad retenida en la tabla retenidos
    SELECT SUM(cantidad_solicitada)
    INTO total_retenido
    FROM elementos_retenidos
    WHERE
      cod_dimension = _cod_dimension AND
      cod_subdimension = _cod_subdimension AND
      cod_agrupacion = _cod_agrupacion AND
      cod_objeto = _cod_objeto;

    IF total_inventario IS NULL
    THEN
      total_inventario = 0;
    END IF;

    IF total_retenido IS NULL
      THEN
        total_retenido = 0;
    END IF;

    RETURN (total_inventario - total_retenido);
  END;
  $BODY$
LANGUAGE plpgsql VOLATILE
COST 100;


-- Function: public.seleccionar_elemento_disponible(text, text, text, integer, numeric)

DROP FUNCTION IF EXISTS public.seleccionar_elemento_disponible( TEXT, TEXT, TEXT, INTEGER, NUMERIC );

CREATE OR REPLACE FUNCTION public.seleccionar_elemento_disponible(
  IN _cod_dimension       TEXT,
  IN _cod_subdimension    TEXT,
  IN _cod_agrupacion      TEXT,
  IN _cod_objeto          INTEGER,
  IN _cantidad_solicitada NUMERIC)
  RETURNS TABLE(cod_dimension CHARACTER VARYING(4), cod_subdimension CHARACTER VARYING(3), cod_agrupacion CHARACTER VARYING(3), cod_objeto INTEGER, numero_orden INTEGER, cantidad_disponible NUMERIC) AS
  $BODY$
  DECLARE
    num_elementos_disponibles INTEGER;
    --Esta variable se usa en el procedimiento de seleccionar varios potes
    clase_objeto_solicitado   TEXT;
    -- Esta variable almacenara la clase del elemento que se esta solicitando
    cantidad_disponible       NUMERIC;
    --Esta variable se usara para guardar la cantidad disponible del elemento
    variable_record           RECORD;
    --Usada para guardar el resultado de una consulta

  BEGIN

    --Buscamos la clase del objeto que se esta pidiendo
    SELECT UPPER(clase_objetos.nombre)
    INTO clase_objeto_solicitado
    FROM catalogo_objetos
      INNER JOIN clase_objetos ON catalogo_objetos.cod_clase_objeto = clase_objetos.id
    WHERE catalogo_objetos.id = _cod_objeto;

    --Condicion para verificar si el elemento que se esta solicitando es un reactivo

    IF clase_objeto_solicitado = 'REACTIVO'
    THEN
      --Comienzo del procedimiento especial se asignacion de potes

        -- Obtenemos el numero de elementos disponibles
      SELECT COUNT(*)
      INTO num_elementos_disponibles
      FROM vista_reactivos_disponibles AS vista
      WHERE
        vista.cod_dimension = _cod_dimension AND
        vista.cod_subdimension = _cod_subdimension AND
        vista.cod_agrupacion = _cod_agrupacion AND
        vista.cod_objeto = _cod_objeto;

      IF num_elementos_disponibles = 0
      THEN
        RETURN QUERY
        SELECT
          vista_reactivos_disponibles.cod_dimension,
          vista_reactivos_disponibles.cod_subdimension,
          vista_reactivos_disponibles.cod_agrupacion,
          vista_reactivos_disponibles.cod_objeto,
          vista_reactivos_disponibles.numero_orden,
          vista_reactivos_disponibles.cantidad_disponible
        FROM vista_reactivos_disponibles
        WHERE
          num_elementos_disponibles <> 0
        LIMIT 1; -- No hay disponibilidad
      ELSIF
        EXISTS(
            SELECT
              vista_reactivos_disponibles.cod_dimension,
              vista_reactivos_disponibles.cod_subdimension,
              vista_reactivos_disponibles.cod_agrupacion,
              vista_reactivos_disponibles.cod_objeto,
              vista_reactivos_disponibles.numero_orden,
              vista_reactivos_disponibles.cantidad_disponible
            FROM vista_reactivos_disponibles
            WHERE
              vista_reactivos_disponibles.cod_dimension = _cod_dimension AND
              vista_reactivos_disponibles.cod_subdimension = _cod_subdimension AND
              vista_reactivos_disponibles.cod_agrupacion = _cod_agrupacion AND
              vista_reactivos_disponibles.cod_objeto = _cod_objeto AND
              vista_reactivos_disponibles.cantidad_disponible >= _cantidad_solicitada
            ORDER BY vista_reactivos_disponibles.cantidad_disponible
            LIMIT 1
        )
        THEN
          -- Buscamos el unico elemento disponible
          RETURN QUERY
          SELECT
            vista_reactivos_disponibles.cod_dimension,
            vista_reactivos_disponibles.cod_subdimension,
            vista_reactivos_disponibles.cod_agrupacion,
            vista_reactivos_disponibles.cod_objeto,
            vista_reactivos_disponibles.numero_orden,
            vista_reactivos_disponibles.cantidad_disponible
          FROM vista_reactivos_disponibles
          WHERE
            vista_reactivos_disponibles.cod_dimension = _cod_dimension AND
            vista_reactivos_disponibles.cod_subdimension = _cod_subdimension AND
            vista_reactivos_disponibles.cod_agrupacion = _cod_agrupacion AND
            vista_reactivos_disponibles.cod_objeto = _cod_objeto AND
            vista_reactivos_disponibles.cantidad_disponible >= _cantidad_solicitada
          ORDER BY vista_reactivos_disponibles.cantidad_disponible
          LIMIT 1;

      ELSE
        IF num_elementos_disponibles >= 2
        THEN
          RETURN QUERY
          SELECT
            T1.cod_dimension,
            T1.cod_subdimension,
            T1.cod_agrupacion,
            T1.cod_objeto,
            T1.numero_orden,
            T1.cantidad_disponible
          FROM vista_reactivos_disponibles T1
            INNER JOIN vista_reactivos_disponibles T2 ON
                                                        T1.cod_dimension = T2.cod_dimension AND
                                                        T1.cod_subdimension = T2.cod_subdimension AND
                                                        T1.cod_agrupacion = T2.cod_agrupacion AND
                                                        T1.cod_objeto = T2.cod_objeto
          WHERE
            T1.cod_dimension = _cod_dimension AND T2.cod_dimension = _cod_dimension AND
            T1.cod_subdimension = _cod_subdimension AND T2.cod_subdimension = _cod_subdimension AND
            T1.cod_agrupacion = _cod_agrupacion AND T2.cod_agrupacion = _cod_agrupacion AND
            T1.cod_objeto = _cod_objeto AND T2.cod_objeto = _cod_objeto AND
            T1.numero_orden <> T2.numero_orden AND
            (T1.cantidad_disponible + T2.cantidad_disponible) >= _cantidad_solicitada
          GROUP BY
            T1.cod_dimension,
            T1.cod_subdimension,
            T1.cod_agrupacion,
            T1.cod_objeto,
            T1.numero_orden,
            T1.cantidad_disponible,
            T2.cantidad_disponible
          LIMIT 2;

        END IF;
      END IF;
    ELSE
      --Comienzo del prcedimiento normal de asignacion

        --Buscamos la cantidad disponible del elemento
      SELECT obtener_cantidad_disponible_elemento(_cod_dimension, _cod_subdimension, _cod_agrupacion, _cod_objeto)
      INTO cantidad_disponible;

      IF cantidad_disponible >= _cantidad_solicitada
      THEN
        RETURN QUERY
        SELECT
          inventario.cod_dimension,
          inventario.cod_subdimension,
          inventario.cod_agrupacion,
          inventario.cod_objeto,
          inventario.numero_orden,
          inventario.cantidad_disponible
        FROM
          inventario
        WHERE
          inventario.cod_dimension = _cod_dimension AND
          inventario.cod_subdimension = _cod_subdimension AND
          inventario.cod_agrupacion = _cod_agrupacion AND
          inventario.cod_objeto = _cod_objeto
        ORDER BY
          inventario.cantidad_disponible
        LIMIT 1;

      END IF;
    END IF;
  END;

  /*SELECT array_to_json(
      array_agg(
          row_to_json(campos)
      )
  )
  FROM (
         SELECT
           T1.cod_dimension,
           T1.cod_subdimension,
           T1.cod_agrupacion,
           T1.cod_objeto,
           T1.numero_orden                                   AS numero_orden_recipiente_1,
           T1.cantidad_disponible                            AS cantidad_recipiente_1,
           T2.cod_objeto,
           T2.numero_orden                                   AS numero_orden_recipiente_2,
           T2.cantidad_disponible                            AS cantidad_recipiente_2,
           (T1.cantidad_disponible + T2.cantidad_disponible) AS cantidad_total
         FROM inventario T1
           CROSS JOIN inventario T2
         WHERE
           T1.numero_orden < T2.numero_orden AND
           T1.cod_dimension = 'AL05' AND T2.cod_dimension = 'AL05' AND
           T1.cod_subdimension = 'F56' AND T2.cod_subdimension = 'F56' AND
           T1.cod_agrupacion = 'CP1' AND T2.cod_agrupacion = 'CP1' AND
           T1.cod_objeto = '41' AND T2.cod_objeto = '41'
         ORDER BY
           cantidad_total
         LIMIT 1
       ) AS campos;*/
  $BODY$
LANGUAGE plpgsql VOLATILE
COST 100
ROWS 1000;


-- Function: public.retener_elemento_inventario(text, text, text, integer, integer, numeric)
DROP FUNCTION IF EXISTS public.retener_elemento_inventario( TEXT, TEXT, TEXT, INTEGER, INTEGER, NUMERIC );

CREATE OR REPLACE FUNCTION public.retener_elemento_inventario(
  _cod_dimension       TEXT,
  _cod_subdimension    TEXT,
  _cod_agrupacion      TEXT,
  _cod_objeto          INTEGER,
  _numero_orden        INTEGER,
  _cantidad_solicitada NUMERIC)
  RETURNS VOID AS
  $BODY$
  DECLARE
    cantidad_total NUMERIC;
  BEGIN
    SELECT obtener_cantidad_disponible_elemento(_cod_dimension, _cod_subdimension, _cod_agrupacion, _cod_objeto)
    INTO cantidad_total;

    IF EXISTS(
        SELECT 1
        FROM elementos_retenidos
        WHERE
          elementos_retenidos.cod_dimension = _cod_dimension AND
          elementos_retenidos.cod_subdimension = _cod_subdimension AND
          elementos_retenidos.cod_agrupacion = _cod_agrupacion AND
          elementos_retenidos.cod_objeto = _cod_objeto AND
          elementos_retenidos.numero_orden = _numero_orden
    )
    THEN
      UPDATE elementos_retenidos
      SET
        cantidad_existente  = cantidad_total + cantidad_solicitada,
        cantidad_solicitada = (cantidad_solicitada + _cantidad_solicitada),
        updated_at          = NOW()
      WHERE elementos_retenidos.cod_dimension = _cod_dimension AND
            elementos_retenidos.cod_subdimension = _cod_subdimension AND
            elementos_retenidos.cod_agrupacion = _cod_agrupacion AND
            elementos_retenidos.cod_objeto = _cod_objeto AND
            elementos_retenidos.numero_orden = _numero_orden;
    ELSE
      INSERT INTO public.elementos_retenidos (
        cod_dimension, cod_subdimension, cod_agrupacion, cod_objeto,
        numero_orden, cantidad_existente, cantidad_solicitada, created_at,
        updated_at)
      VALUES (_cod_dimension, _cod_subdimension, _cod_agrupacion, _cod_objeto,
              _numero_orden, cantidad_total, _cantidad_solicitada, NOW(),
              NOW());
    END IF;

  END;
  $BODY$
LANGUAGE plpgsql VOLATILE
COST 100;


DROP FUNCTION IF EXISTS public.retornar_stock_laboratorio( INTEGER, NUMERIC );

CREATE OR REPLACE FUNCTION public.retornar_stock_laboratorio(
  _id_objetos_laboratorio INTEGER,
  _cantidad_retornar      NUMERIC)
  RETURNS JSON AS
  $BODY$
  DECLARE
    resultado               RECORD;
    cantidad_retornar_total NUMERIC;
    consulta                TEXT;
  BEGIN
    consulta = 'SELECT
      cod_dimension,
      cod_subdimension,
      cod_agrupacion,
      cod_objeto,
      numero_orden,
      cantidad
    FROM objetos_laboratorio
    WHERE id = ' || _id_objetos_laboratorio || ' LIMIT 1;';

    FOR resultado IN EXECUTE consulta LOOP

      IF _cantidad_retornar > resultado.cantidad
      THEN
        RETURN '{"resultado":false, "mensajes": ["No puede exceder de la cantidad exitente"]}' :: JSON;
      ELSE
        --Almacenamos la cantidad total a retornar
        cantidad_retornar_total = (resultado.cantidad - _cantidad_retornar);

        --Actualizamos la cantidad total en la tabla objetos laboratorio
        UPDATE objetos_laboratorio
        SET
          cantidad   = cantidad_retornar_total,
          updated_at = NOW()
        WHERE id = _id_objetos_laboratorio;

        --Actualizamos la cantidad total en la tabla de retenidos
        UPDATE elementos_retenidos
        SET
          cantidad_solicitada = (cantidad_solicitada - _cantidad_retornar),
          updated_at          = NOW()
        WHERE
          elementos_retenidos.cod_dimension = resultado.cod_dimension AND
          elementos_retenidos.cod_subdimension = resultado.cod_subdimension AND
          elementos_retenidos.cod_agrupacion = resultado.cod_agrupacion AND
          elementos_retenidos.cod_objeto = resultado.cod_objeto AND
          elementos_retenidos.numero_orden = resultado.numero_orden;

        --Verificamos si la cantidad que quedo en objetos laboratorio en = 0
        IF cantidad_retornar_total = 0
        THEN

          --Eliminamos el registro que tiene 0 cantidad de objetos_laboratorio
          DELETE FROM objetos_laboratorio
          WHERE id = _id_objetos_laboratorio;

          --Eliminamos el registro que tiene 0 cantidad de la tabla retenidos
          DELETE FROM elementos_retenidos
          WHERE
            elementos_retenidos.cantidad_solicitada = 0 AND
            elementos_retenidos.cod_dimension = resultado.cod_dimension AND
            elementos_retenidos.cod_subdimension = resultado.cod_subdimension AND
            elementos_retenidos.cod_agrupacion = resultado.cod_agrupacion AND
            elementos_retenidos.cod_objeto = resultado.cod_objeto AND
            elementos_retenidos.numero_orden = resultado.numero_orden;

        END IF;

        RETURN '{"resultado": true, "mensajes": ["Cantidad retornada con exito"]}' :: JSON;

      END IF;
    END LOOP;

    RETURN '{"resultado":false, "mensajes": ["objeto no encontrado"]}' :: JSON;

  END;
  $BODY$
LANGUAGE plpgsql VOLATILE
COST 100;