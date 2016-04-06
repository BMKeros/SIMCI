-- Function: capitalize(text)

-- DROP FUNCTION capitalize(text);

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


-- Function: permisos_usuario(int)

-- DROP FUNCTION permisos_usuario(int);

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


--Funcion usada para mover los objetos de los laboratorios
--DROP FUNCTION IF EXISTS mover_stock( TEXT, TEXT, INTEGER, INTEGER);
CREATE OR REPLACE FUNCTION mover_stock_laboratorio(_cod_laboratorio TEXT, _cod_laboratorio_destino TEXT,
                                                   _cod_objeto      INT, _cantidad_mover INT)
  RETURNS BOOLEAN AS
  $BODY$
  DECLARE
    cantidad_actual         INTEGER;
    cantidad_restante       INTEGER;
    cantidad_objeto_destino INTEGER;
  BEGIN

    SELECT cantidad
    FROM objetos_laboratorio
    WHERE cod_laboratorio = _cod_laboratorio :: TEXT AND cod_objeto = _cod_objeto
    INTO cantidad_actual;
    SELECT cantidad_actual - _cantidad_mover
    INTO cantidad_restante;

    IF cantidad_actual <> cantidad_restante AND cantidad_restante >= 0
    THEN
      ---Si cambio la cantidad se actualiza el objeto en la tabla
      UPDATE objetos_laboratorio
      SET cantidad = cantidad_restante
      WHERE cod_laboratorio = _cod_laboratorio :: TEXT AND cod_objeto = _cod_objeto;

      --Verificamos si el objeto que se movera existe en el laboratorio destino

      IF EXISTS(
          SELECT cantidad
          FROM objetos_laboratorio
          WHERE cod_laboratorio = _cod_laboratorio_destino :: TEXT AND cod_objeto = _cod_objeto
      )
      THEN

        SELECT cantidad
        INTO cantidad_objeto_destino
        FROM objetos_laboratorio
        WHERE cod_laboratorio = _cod_laboratorio_destino :: TEXT AND cod_objeto = _cod_objeto;

        --Si existe el objeto en el laboratorio destino se actualiza su cantidad
        UPDATE objetos_laboratorio
        SET cantidad = (cantidad_objeto_destino + _cantidad_mover), updated_at = NOW()
        WHERE cod_laboratorio = _cod_laboratorio_destino :: TEXT AND cod_objeto = _cod_objeto;

        RETURN TRUE; --Retornamos true para hacer saber que se hizo el procedimiento

      ELSE
        --Si no existe el objeto en el laboratorio destino se crear con la cantidad
        INSERT INTO public.objetos_laboratorio (
          cod_laboratorio, cod_objeto, cantidad, created_at, updated_at)
        VALUES (_cod_laboratorio_destino, _cod_objeto, _cantidad_mover, NOW(), NOW());

        RETURN TRUE; --Retornamos true para hacer saber que se hizo el procedimiento

      END IF;
    ELSE
      RETURN FALSE; --Retornamos false por si no se hace el procedimiento
    END IF;
  END;
  $BODY$
LANGUAGE plpgsql VOLATILE



-- DROP FUNCTION public.agregar_stock_laboratorio(text, text, text,integer, text ,integer);
-- Function: public.agregar_stock_laboratorio(text, text, text,integer, text ,integer);

DROP FUNCTION public.agregar_stock_laboratorio( TEXT, TEXT, TEXT, INTEGER, TEXT, INTEGER );

CREATE OR REPLACE FUNCTION public.agregar_stock_laboratorio(
  _cod_dimension    TEXT,
  _cod_subdimension TEXT,
  _cod_agrupacion   TEXT,
  _cod_objeto       INTEGER,
  _cod_laboratorio  TEXT,
  _cantidad         INTEGER)

  RETURNS BOOLEAN AS
  $BODY$
  DECLARE
    id_stock_laboratorio INTEGER;
    cantidad_existente   INTEGER;
  BEGIN
    IF _cantidad > 0
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
        cod_laboratorio = _cod_laboratorio;

      IF id_stock_laboratorio IS NULL
      THEN
        INSERT INTO objetos_laboratorio (
          cod_laboratorio, cod_dimension, cod_subdimension, cod_agrupacion,
          cod_objeto, cantidad, created_at, updated_at)
        VALUES (_cod_laboratorio, _cod_dimension,
                _cod_subdimension, _cod_agrupacion, _cod_objeto,
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
          cod_laboratorio = _cod_laboratorio;

        RETURN TRUE;
      END IF; -- Condicion id_stock_laboratorio IS NULL
    END IF;
    -- Condicion >= 0
    RETURN FALSE;
  END;
  $BODY$
LANGUAGE plpgsql VOLATILE
COST 100;