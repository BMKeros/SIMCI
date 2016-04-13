
--Funcion que se encarga de actualizar el updated_at
CREATE OR REPLACE FUNCTION actualizar_campo_updated()
RETURNS TRIGGER AS $$
BEGIN
    NEW.updated_at = now();
    RETURN NEW;
END;
$$ language 'plpgsql';

 -- TABLA CATALOGO OBJETOS
CREATE OR REPLACE TRIGGER trigger_campo_updated_at BEFORE UPDATE ON catalogo_objetos FOR EACH ROW EXECUTE PROCEDURE  actualizar_campo_updated();

-- TABLA PROVEEDORES
CREATE OR REPLACE TRIGGER trigger_campo_updated_at BEFORE UPDATE ON proveedores FOR EACH ROW EXECUTE PROCEDURE  actualizar_campo_updated();
