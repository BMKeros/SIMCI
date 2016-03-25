--Vista para obtener todos los campos de usuario con sus relaciones
CREATE OR REPLACE VIEW vista_usuarios_full AS 
	SELECT 
		usuarios.id  as id_usuario,
		usuarios.usuario as usuario,
		usuarios.email as email,
		usuarios.imagen as imagen,
		usuarios.activo as activo,
		usuarios.cod_tipo_usuario as cod_tipo_usuario,
		tipos_usuario.nombre as tipo_usuario_nombre,
		tipos_usuario.descripcion as tipo_usuario_descripcion,
		permisos_usuario(usuarios.id) as permisos,
		personas.id as id_persona,
		personas.primer_nombre as primer_nombre,
		personas.segundo_nombre  as segundo_nombre,
		personas.primer_apellido as primer_apellido,
		personas.segundo_apellido as segundo_apellido,
		personas.cedula as cedula,
		personas.fecha_nacimiento as fecha_nacimiento,
		personas.sexo_id as sexo_id,
		sexos.descripcion as sexo
	FROM usuarios
	INNER JOIN tipos_usuario ON tipos_usuario.codigo = usuarios.cod_tipo_usuario
	LEFT JOIN personas ON personas.usuario_id = usuarios.id
	LEFT JOIN sexos ON personas.sexo_id = sexos.id;


CREATE OR REPLACE VIEW vista_objetos_full AS
	SELECT
		catalogo_objetos.id as cod_objeto,
		catalogo_objetos.nombre as nombre_objeto,
		catalogo_objetos.descripcion as descripcion_objeto,
		catalogo_objetos.especificaciones as especificaciones_objeto,
		unidades.cod_unidad as cod_unidad,
		unidades.nombre as nombre_unidad,
		unidades.abreviatura as abreviatura_unidad,
		tipos_unidades.id as cod_tipo_unidad,
		tipos_unidades.nombre as nombre_tipo_unidad,
		clase_objetos.id as cod_clase_objeto,
		clase_objetos.nombre as nombre_clase_objeto,
		clase_objetos.descripcion as descripcion_clase_objeto
	FROM catalogo_objetos
	INNER JOIN unidades ON unidades.cod_unidad = catalogo_objetos.cod_unidad
	INNER JOIN tipos_unidades ON tipos_unidades.id = unidades.tipo_unidad
	INNER JOIN clase_objetos ON clase_objetos.id = catalogo_objetos.cod_clase_objeto;
	


/*OJO PENDIENTE POR EVALUAR PORQUE NO TRAE TODOS LOS REGISTROS*/
CREATE OR REPLACE VIEW vista_inventarios_full AS
	SELECT
		inventario.numero_orden as numero_orden,
		inventario.cantidad_disponible as cantidad_disponible,
		inventario.usa_recipientes as usa_recipientes,
		inventario.elemento_movible as elemento_movible,
		inventario.recipientes_disponibles as recipientes_disponibles,
		almacenes.codigo as cod_dimension,
		almacenes.descripcion as descripcion_dimension,
		sub_dimensiones.codigo as cod_subdimension,
		sub_dimensiones.descripcion as descripcion_subdimension,
		agrupaciones.codigo as cod_agrupacion,
		agrupaciones.nombre as nombre_agrupacion,
		agrupaciones.descripcion as descripcion_agrupacion,
		sub_agrupaciones.codigo as cod_subagrupacion,
		sub_agrupaciones.nombre as nombre_subagrupaciones,
		sub_agrupaciones.descripcion as descripcion_subagrupacion,

		/*pendiente por evaluar a ver si se queda o se elimina ya que estosw campo se traen en la vista de objetos-laboratorio*/
		catalogo_objetos.id as cod_objeto,
		catalogo_objetos.nombre as nombre_objeto,
		catalogo_objetos.descripcion as descripcion_objeto,
		catalogo_objetos.especificaciones as especificaciones_objeto,
		unidades.cod_unidad as cod_unidad,
		unidades.nombre as nombre_unidad,
		unidades.abreviatura as abreviatura_unidad,
		tipos_unidades.id as cod_tipo_unidad,
		tipos_unidades.nombre as nombre_tipo_unidad,
		clase_objetos.id as cod_clase_objeto,
		clase_objetos.nombre as nombre_clase_objeto,
		clase_objetos.descripcion as descripcion_clase_objeto

	FROM inventario 
	INNER JOIN almacenes ON almacenes.codigo = inventario.cod_dimension
	INNER JOIN sub_dimensiones ON sub_dimensiones.codigo = inventario.cod_subdimension
	INNER JOIN agrupaciones ON agrupaciones.codigo = inventario.cod_agrupacion
	LEFT JOIN sub_agrupaciones ON sub_agrupaciones.codigo = inventario.cod_subagrupacion
	INNER JOIN catalogo_objetos ON catalogo_objetos.id = inventario.cod_objeto
	INNER JOIN unidades ON unidades.cod_unidad = catalogo_objetos.cod_unidad
	INNER JOIN tipos_unidades ON tipos_unidades.id = unidades.tipo_unidad
	INNER JOIN clase_objetos ON clase_objetos.id = catalogo_objetos.cod_clase_objeto;

CREATE OR REPLACE VIEW vista_almacen_full AS
	SELECT 
		almacenes.codigo as cod_dimension,
		almacenes.descripcion as descripcion,
		responsable.primer_nombre as primer_nombre_responsable,
		responsable.primer_apellido as primer_apellido_responsable,
		primer_auxiliar.primer_nombre as primer_nombre_primer_auxiliar,
		primer_auxiliar.primer_apellido as primer_apellido_primer_auxiliar,
		segundo_auxiliar.primer_nombre as primer_nombre_segundo_auxiliar,
		segundo_auxiliar.primer_apellido as primer_apellido_segundo_auxiliar
	FROM almacenes
	INNER JOIN personas as responsable ON responsable.id = almacenes.responsable
	INNER JOIN personas as primer_auxiliar ON primer_auxiliar.id = almacenes.primer_auxiliar
	LEFT JOIN personas as segundo_auxiliar ON segundo_auxiliar.id = almacenes.segundo_auxiliar;

CREATE OR REPLACE VIEW vista_laboratorio_full AS
	SELECT
		laboratorios.codigo as cod_laboratorio,
		laboratorios.nombre as nombre_laboratorio,
		laboratorios.descripcion as descripcion_laboratorio,
		laboratorios.secuencia as secuencia_laboratorio
	FROM laboratorios;


/*FALTA COMPLETAR ESTA VISTA*/
CREATE OR REPLACE VIEW vista_stock_full AS
	SELECT
		laboratorios.codigo as cod_laboratorio,
		laboratorios.nombre as nombre_laboratorio,
		laboratorios.descripcion as descripcion_laboratorio,
		catalogo_objetos.id as cod_objeto,
		catalogo_objetos.nombre as nombre_objeto,
		catalogo_objetos.descripcion as descripcion_objeto,
		catalogo_objetos.especificaciones as especificaciones_objeto,
		unidades.cod_unidad as cod_unidad,
		unidades.nombre as nombre_unidad,
		unidades.abreviatura as abreviatura_unidad,
		tipos_unidades.id as cod_tipo_unidad,
		tipos_unidades.nombre as nombre_tipo_unidad,
		clase_objetos.id as cod_clase_objeto,
		clase_objetos.nombre as nombre_clase_objeto,
		clase_objetos.descripcion as descripcion_clase_objeto

	FROM objetos_laboratorio
	INNER JOIN laboratorios ON laboratorios.codigo = objetos_laboratorio.cod_laboratorio
	INNER JOIN catalogo_objetos ON catalogo_objetos.id = objetos_laboratorio.cod_objeto
	INNER JOIN unidades ON unidades.cod_unidad = catalogo_objetos.cod_unidad
	INNER JOIN tipos_unidades ON tipos_unidades.id = unidades.tipo_unidad
	INNER JOIN clase_objetos ON clase_objetos.id = catalogo_objetos.cod_clase_objeto; 
