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


CREATE OR REPLACE VIEW vista_obejos_laboratorio AS
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
	INNER JOIN clase_objetos ON clase_objetos.id = catalogo_objetos.cod_clase_objeto

	/**/