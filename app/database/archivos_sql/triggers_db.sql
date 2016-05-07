--Funcion que se encarga de actualizar el updated_at
CREATE OR REPLACE FUNCTION actualizar_campo_updated()
  RETURNS TRIGGER AS $$
BEGIN
  NEW.updated_at = now();
  RETURN NEW;
END;
$$ language 'plpgsql';

-- TABLA CATALOGO OBJETOS
CREATE OR REPLACE TRIGGER trigger_campo_updated_at BEFORE UPDATE ON catalogo_objetos FOR EACH ROW EXECUTE PROCEDURE actualizar_campo_updated();

-- TABLA PROVEEDORES
CREATE OR REPLACE TRIGGER trigger_campo_updated_at BEFORE UPDATE ON proveedores FOR EACH ROW EXECUTE PROCEDURE actualizar_campo_updated();


--Funcion para generar el campo codigo de las tablas
CREATE OR REPLACE FUNCTION generar_codigo_tabla()
  RETURNS TRIGGER AS
  $BODY$
DECLARE
  nomenclatura TEXT;
  secuencia TEXT;
BEGIN
  --Verificamos la tabla que ejecuta el triggers para asignarle su nomenclatura
  IF TG_TABLE_NAME = 'laboratorios'
  THEN
    nomenclatura = 'LA';
  ELSIF TG_TABLE_NAME = 'proveedores'
    THEN
      nomenclatura = 'PRV';
  END IF;

  --Creamos el nombre de la secuencia partiendo del nombre de la tabla
  --OJO las secuencias deben llevar el mismo formato con el que se usan aqui
  secuencia = TG_TABLE_NAME || '_codigo_secuencia';

  SELECT nomenclatura::TEXT || TRIM(to_char(NEXTVAL(secuencia::TEXT), '09')) INTO NEW.codigo;
  RETURN NEW;
END;
$BODY$
LANGUAGE 'plpgsql' VOLATILE;

--Tabla de laboratorios
DROP TRIGGER IF EXISTS trigger_generar_campo_personalizado ON laboratorios;
CREATE TRIGGER trigger_generar_campo_personalizado BEFORE INSERT ON laboratorios FOR EACH ROW EXECUTE PROCEDURE generar_codigo_tabla();

--Tabla proveedores
DROP TRIGGER IF EXISTS trigger_generar_campo_personalizado ON proveedores;
CREATE TRIGGER trigger_generar_campo_personalizado BEFORE INSERT ON proveedores FOR EACH ROW EXECUTE PROCEDURE generar_codigo_tabla();