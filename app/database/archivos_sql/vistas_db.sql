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
