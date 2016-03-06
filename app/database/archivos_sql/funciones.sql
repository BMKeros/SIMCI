-- Function: capitalize(text)

-- DROP FUNCTION capitalize(text);

CREATE OR REPLACE FUNCTION capitalize(text)
  RETURNS text AS
$BODY$
declare
	total text;
BEGIN
   SELECT concat(UPPER(LEFT($1,1))::text , LOWER(SUBSTRING($1,2,length($1)))::text) into total;
   RETURN total;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;


-- Function: permisos_usuario(int)

-- DROP FUNCTION permisos_usuario(int);

--Funcion para obtener todos los permisos de un usuario en especifico
CREATE OR REPLACE FUNCTION permisos_usuario(int)
  RETURNS json AS
$BODY$
declare
	permisos json;
BEGIN
   SELECT array_to_json(
		array_agg(
			row_to_json(campos)
		)
	) FROM ( 
		SELECT 
			permisos_usuarios.cod_permiso, 
			permisos.nombre
		FROM permisos_usuarios
		INNER JOIN permisos ON permisos.codigo = permisos_usuarios.cod_permiso
		WHERE permisos_usuarios.usuario_id = $1
	) as campos INTO permisos;

   RETURN permisos;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
