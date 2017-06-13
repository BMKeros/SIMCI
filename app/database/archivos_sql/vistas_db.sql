--Vista para obtener todos los campos de usuario con sus relaciones
DROP VIEW IF EXISTS vista_usuarios_full CASCADE;
CREATE OR REPLACE VIEW vista_usuarios_full AS
  SELECT
    usuarios.id                   AS id_usuario,
    usuarios.usuario              AS usuario,
    usuarios.email                AS email,
    usuarios.imagen               AS imagen,
    usuarios.activo               AS activo,
    usuarios.created_at           AS created_at,
    usuarios.updated_at           AS updated_at,
    usuarios.cod_tipo_usuario     AS cod_tipo_usuario,
    tipos_usuario.nombre          AS tipo_usuario_nombre,
    tipos_usuario.descripcion     AS tipo_usuario_descripcion,
    permisos_usuario(usuarios.id) AS permisos,
    personas.id                   AS id_persona,
    personas.primer_nombre        AS primer_nombre,
    personas.segundo_nombre       AS segundo_nombre,
    personas.primer_apellido      AS primer_apellido,
    personas.segundo_apellido     AS segundo_apellido,
    personas.cedula               AS cedula,
    personas.fecha_nacimiento     AS fecha_nacimiento,
    personas.sexo_id              AS sexo_id,
    sexos.descripcion             AS sexo
  FROM usuarios
    INNER JOIN tipos_usuario ON tipos_usuario.codigo = usuarios.cod_tipo_usuario
    LEFT JOIN personas ON personas.usuario_id = usuarios.id
    LEFT JOIN sexos ON personas.sexo_id = sexos.id;


DROP VIEW IF EXISTS vista_objetos_full CASCADE;
CREATE OR REPLACE VIEW vista_objetos_full AS
  SELECT
    catalogo_objetos.id               AS cod_objeto,
    catalogo_objetos.nombre           AS nombre_objeto,
    catalogo_objetos.descripcion      AS descripcion_objeto,
    catalogo_objetos.especificaciones AS especificaciones_objeto,
    catalogo_objetos.created_at       AS created_at,
    catalogo_objetos.updated_at       AS updated_at,
    unidades.cod_unidad               AS cod_unidad,
    unidades.nombre                   AS nombre_unidad,
    unidades.abreviatura              AS abreviatura_unidad,
    tipos_unidades.id                 AS cod_tipo_unidad,
    tipos_unidades.nombre             AS nombre_tipo_unidad,
    clase_objetos.id                  AS cod_clase_objeto,
    clase_objetos.nombre              AS nombre_clase_objeto,
    clase_objetos.descripcion         AS descripcion_clase_objeto
  FROM catalogo_objetos
    INNER JOIN unidades ON unidades.cod_unidad = catalogo_objetos.cod_unidad
    INNER JOIN tipos_unidades ON tipos_unidades.id = unidades.tipo_unidad
    INNER JOIN clase_objetos ON clase_objetos.id = catalogo_objetos.cod_clase_objeto;


/*OJO PENDIENTE POR EVALUAR PORQUE NO TRAE TODOS LOS REGISTROS*/
DROP VIEW IF EXISTS vista_inventario_full CASCADE;
CREATE OR REPLACE VIEW vista_inventario_full AS
  SELECT
    inventario.numero_orden           AS numero_orden,
    inventario.cantidad_disponible    AS cantidad_disponible,
    inventario.elemento_movible       AS elemento_movible,
    inventario.created_at             AS created_at,
    inventario.updated_at             AS updated_at,
    almacenes.codigo                  AS cod_dimension,
    almacenes.descripcion             AS descripcion_dimension,
    sub_dimensiones.codigo            AS cod_subdimension,
    sub_dimensiones.descripcion       AS descripcion_subdimension,
    agrupaciones.codigo               AS cod_agrupacion,
    agrupaciones.nombre               AS nombre_agrupacion,
    agrupaciones.descripcion          AS descripcion_agrupacion,
    sub_agrupaciones.codigo           AS cod_subagrupacion,
    sub_agrupaciones.nombre           AS nombre_subagrupacion,
    sub_agrupaciones.descripcion      AS descripcion_subagrupacion,

    /*pendiente por evaluar a ver si se queda o se elimina ya que estosw campo se traen en la vista de objetos-laboratorio*/
    catalogo_objetos.id               AS cod_objeto,
    catalogo_objetos.nombre           AS nombre_objeto,
    catalogo_objetos.descripcion      AS descripcion_objeto,
    catalogo_objetos.especificaciones AS especificaciones_objeto,
    unidades.cod_unidad               AS cod_unidad,
    unidades.nombre                   AS nombre_unidad,
    unidades.abreviatura              AS abreviatura_unidad,
    tipos_unidades.id                 AS cod_tipo_unidad,
    tipos_unidades.nombre             AS nombre_tipo_unidad,
    clase_objetos.id                  AS cod_clase_objeto,
    clase_objetos.nombre              AS nombre_clase_objeto,
    clase_objetos.descripcion         AS descripcion_clase_objeto

  FROM inventario
    INNER JOIN almacenes ON almacenes.codigo = inventario.cod_dimension
    INNER JOIN sub_dimensiones ON sub_dimensiones.codigo = inventario.cod_subdimension
    INNER JOIN agrupaciones ON agrupaciones.codigo = inventario.cod_agrupacion
    LEFT JOIN sub_agrupaciones ON sub_agrupaciones.codigo = inventario.cod_subagrupacion
    INNER JOIN catalogo_objetos ON catalogo_objetos.id = inventario.cod_objeto
    INNER JOIN unidades ON unidades.cod_unidad = catalogo_objetos.cod_unidad
    INNER JOIN tipos_unidades ON tipos_unidades.id = unidades.tipo_unidad
    INNER JOIN clase_objetos ON clase_objetos.id = catalogo_objetos.cod_clase_objeto;

DROP VIEW IF EXISTS vista_almacen_full CASCADE;
CREATE OR REPLACE VIEW vista_almacen_full AS
  SELECT
    almacenes.codigo                    AS cod_dimension,
    almacenes.descripcion               AS descripcion,
    almacenes.created_at                AS created_at,
    almacenes.updated_at                AS updated_at,
    responsable_p.primer_nombre         AS primer_nombre_responsable,
    responsable_p.primer_apellido       AS primer_apellido_responsable,
    primer_auxiliar_p.primer_nombre     AS primer_nombre_primer_auxiliar,
    primer_auxiliar_p.primer_apellido   AS primer_apellido_primer_auxiliar,
    segundo_auxiliar_p.primer_nombre    AS primer_nombre_segundo_auxiliar,
    segundo_auxiliar_p.primer_apellido  AS primer_apellido_segundo_auxiliar
  FROM almacenes
    INNER JOIN usuarios AS responsable ON responsable.id = almacenes.responsable
    INNER JOIN personas AS responsable_p ON responsable_p.usuario_id = responsable.id
    INNER JOIN usuarios AS primer_auxiliar ON primer_auxiliar.id = almacenes.primer_auxiliar
    INNER JOIN personas AS primer_auxiliar_p ON primer_auxiliar_p.usuario_id = primer_auxiliar.id
    LEFT JOIN usuarios AS segundo_auxiliar ON segundo_auxiliar.id = almacenes.segundo_auxiliar
    LEFT JOIN personas AS segundo_auxiliar_p ON segundo_auxiliar_p.usuario_id = segundo_auxiliar.id;

DROP VIEW IF EXISTS vista_laboratorio_full;
CREATE OR REPLACE VIEW vista_laboratorio_full AS
  SELECT
    laboratorios.codigo      AS cod_laboratorio,
    laboratorios.nombre      AS nombre_laboratorio,
    laboratorios.descripcion AS descripcion_laboratorio,
    laboratorios.secuencia   AS secuencia_laboratorio,
    laboratorios.created_at  AS created_at,
    laboratorios.updated_at  AS updated_at
  FROM laboratorios;


/*FALTA COMPLETAR ESTA VISTA*/
DROP VIEW IF EXISTS vista_stock_laboratorio_full CASCADE;
CREATE OR REPLACE VIEW vista_stock_laboratorio_full AS
  SELECT
    objetos_laboratorio.id               AS id,
    objetos_laboratorio.cod_dimension    AS cod_dimension,
    almacenes.descripcion                AS descripcion_dimension,
    objetos_laboratorio.cod_subdimension AS cod_subdimension,
    sub_dimensiones.descripcion          AS descripcion_subdimension,
    objetos_laboratorio.cod_agrupacion   AS cod_agrupacion,
    agrupaciones.nombre                  AS nombre_agrupacion,
    objetos_laboratorio.created_at       AS created_at,
    objetos_laboratorio.updated_at       AS updated_at,
    objetos_laboratorio.numero_orden     AS numero_orden,
    laboratorios.codigo                  AS cod_laboratorio,
    laboratorios.nombre                  AS nombre_laboratorio,
    laboratorios.descripcion             AS descripcion_laboratorio,
    catalogo_objetos.id                  AS cod_objeto,
    catalogo_objetos.nombre              AS nombre_objeto,
    catalogo_objetos.descripcion         AS descripcion_objeto,
    catalogo_objetos.especificaciones    AS especificaciones_objeto,
    unidades.cod_unidad                  AS cod_unidad,
    unidades.nombre                      AS nombre_unidad,
    unidades.abreviatura                 AS abreviatura_unidad,
    tipos_unidades.id                    AS cod_tipo_unidad,
    tipos_unidades.nombre                AS nombre_tipo_unidad,
    clase_objetos.id                     AS cod_clase_objeto,
    clase_objetos.nombre                 AS nombre_clase_objeto,
    clase_objetos.descripcion            AS descripcion_clase_objeto,
    objetos_laboratorio.cantidad         AS cantidad

  FROM objetos_laboratorio
    INNER JOIN laboratorios ON laboratorios.codigo = objetos_laboratorio.cod_laboratorio
    INNER JOIN catalogo_objetos ON catalogo_objetos.id = objetos_laboratorio.cod_objeto
    INNER JOIN unidades ON unidades.cod_unidad = catalogo_objetos.cod_unidad
    INNER JOIN tipos_unidades ON tipos_unidades.id = unidades.tipo_unidad
    INNER JOIN clase_objetos ON clase_objetos.id = catalogo_objetos.cod_clase_objeto
    INNER JOIN almacenes ON almacenes.codigo = objetos_laboratorio.cod_dimension
    INNER JOIN sub_dimensiones ON sub_dimensiones.codigo = objetos_laboratorio.cod_subdimension
    INNER JOIN agrupaciones ON agrupaciones.codigo = objetos_laboratorio.cod_agrupacion;


DROP VIEW IF EXISTS vista_elementos_inventario CASCADE;
CREATE OR REPLACE VIEW vista_elementos_inventario AS
  SELECT
    vista_inventario_full.cod_dimension,
    vista_inventario_full.descripcion_dimension,
    vista_inventario_full.cod_subdimension,
    vista_inventario_full.descripcion_subdimension,
    vista_inventario_full.cod_agrupacion,
    vista_inventario_full.nombre_agrupacion,
    vista_inventario_full.cod_objeto,
    vista_inventario_full.nombre_objeto,
    sum(vista_inventario_full.cantidad_disponible) AS cantidad_total_disponible,
    vista_inventario_full.cod_unidad,
    vista_inventario_full.nombre_unidad,
    vista_inventario_full.abreviatura_unidad

  FROM vista_inventario_full

  GROUP BY
    vista_inventario_full.cod_dimension,
    vista_inventario_full.descripcion_dimension,
    vista_inventario_full.cod_subdimension,
    vista_inventario_full.descripcion_subdimension,
    vista_inventario_full.cod_agrupacion,
    vista_inventario_full.nombre_agrupacion,
    vista_inventario_full.cod_objeto,
    vista_inventario_full.nombre_objeto,
    vista_inventario_full.cod_unidad,
    vista_inventario_full.nombre_unidad,
    vista_inventario_full.abreviatura_unidad

  ORDER BY
    nombre_objeto;


DROP VIEW IF EXISTS vista_reactivos_disponibles CASCADE;
CREATE OR REPLACE VIEW vista_reactivos_disponibles AS
  SELECT
    DISTINCT
    inventario.cod_dimension       AS cod_dimension,
    inventario.cod_subdimension    AS cod_subdimension,
    inventario.cod_agrupacion      AS cod_agrupacion,
    inventario.cod_objeto          AS cod_objeto,
    inventario.numero_orden        AS numero_orden,
    inventario.cantidad_disponible AS cantidad_disponible

  FROM inventario
    LEFT JOIN elementos_retenidos ON (inventario.cod_dimension = elementos_retenidos.cod_dimension) AND
                                     (inventario.cod_subdimension = elementos_retenidos.cod_subdimension) AND
                                     (inventario.cod_agrupacion = elementos_retenidos.cod_agrupacion) AND
                                     (inventario.cod_objeto = elementos_retenidos.cod_objeto) AND
                                     (inventario.numero_orden = elementos_retenidos.numero_orden)

  WHERE elementos_retenidos.cod_dimension IS NULL AND
        elementos_retenidos.cod_subdimension IS NULL AND
        elementos_retenidos.cod_agrupacion IS NULL AND
        elementos_retenidos.cod_objeto IS NULL AND
        elementos_retenidos.numero_orden IS NULL;


DROP VIEW IF EXISTS vista_pedidos_full;
CREATE OR REPLACE VIEW vista_pedidos_full AS
  SELECT
    pedidos.cod_orden                           AS cod_orden,
    pedidos.cod_dimension                       AS cod_dimension,
    pedidos.cod_subdimension                    AS cod_subdimension,
    pedidos.cod_agrupacion                      AS cod_agrupacion,
    pedidos.cod_objeto                          AS cod_objeto,
    pedidos.numero_orden                        AS numero_orden,-- Este campo no tiene nada que ver con la orden
    pedidos.cantidad_solicitada                 AS cantidad_solicitada,
    vista_objetos_full.nombre_objeto            AS nombre_objeto,
    vista_objetos_full.descripcion_objeto       AS descripcion_objeto,
    vista_objetos_full.especificaciones_objeto  AS especificaciones_objeto,
    vista_objetos_full.cod_unidad               AS cod_unidad,
    vista_objetos_full.nombre_unidad            AS nombre_unidad,
    vista_objetos_full.abreviatura_unidad       AS abreviatura_unidad,
    vista_objetos_full.nombre_tipo_unidad       AS nombre_tipo_unidad,
    vista_objetos_full.nombre_clase_objeto      AS nombre_clase_objeto,
    vista_objetos_full.descripcion_clase_objeto AS descripcion_clase_objeto

  FROM pedidos
    INNER JOIN vista_objetos_full ON vista_objetos_full.cod_objeto = pedidos.cod_objeto;


DROP VIEW IF EXISTS vista_correos CASCADE;
CREATE OR REPLACE VIEW vista_correos AS
  SELECT
    correos.id                                  AS id,
    correos.emisor                              AS emisor_id,
    usuarios.id                                 AS id_usuario_emisor,
    usuarios.usuario                            AS usuario_emisor,
    formato_nombre_completo(personas.primer_nombre, personas.primer_apellido)   AS nombre_emisor_completo,

    usuario_receptor.id                         AS id_usuario_receptor,
    usuario_receptor.usuario                    AS usuario_receptor,
    formato_nombre_completo(personas_receptor.primer_nombre, personas_receptor.primer_apellido)   AS nombre_receptor_completo,
    
    correos.asunto                              AS asunto,
    correos.descripcion                         AS descripcion,
    correos.created_at                          AS fecha_recibido,
    archivos.id                                 AS archivo_id,
    archivos.path                               AS path_archivo,
    archivos.nombre_original                    AS nombre_original_archivo,
    archivos.nombre_generado                    AS nombre_generado_archivo,
    archivos.extension                          AS extension_archivo,
    archivos.path || archivos.nombre_generado || '.' || archivos.extension  AS ruta_descargar_archivo

  FROM correo_destinatarios
  INNER JOIN correos ON correos.id = correo_destinatarios.correo_id
  LEFT JOIN archivos ON archivos.id = correos.archivo_id
  INNER JOIN usuarios ON usuarios.id = correos.emisor
  INNER JOIN personas ON personas.usuario_id = usuarios.id

  INNER JOIN usuarios AS usuario_receptor ON usuario_receptor.id = correo_destinatarios.destinatario
  INNER JOIN personas AS personas_receptor ON personas_receptor.usuario_id = usuario_receptor.id;