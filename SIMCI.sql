--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.1
-- Dumped by pg_dump version 9.5.1

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

--
-- Name: capitalize(text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION capitalize(text) RETURNS text
    LANGUAGE plpgsql
    AS $_$
declare
	total text;
BEGIN
   SELECT concat(UPPER(LEFT($1,1))::text , LOWER(SUBSTRING($1,2,length($1)))::text) into total;
   RETURN total;
END;
$_$;


ALTER FUNCTION public.capitalize(text) OWNER TO postgres;

--
-- Name: permisos_usuario(integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION permisos_usuario(integer) RETURNS json
    LANGUAGE plpgsql
    AS $_$
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
$_$;


ALTER FUNCTION public.permisos_usuario(integer) OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: agrupaciones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE agrupaciones (
    codigo character varying(3) NOT NULL,
    nombre character varying(50) NOT NULL,
    descripcion character varying(150) NOT NULL,
    secuencia integer NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE agrupaciones OWNER TO postgres;

--
-- Name: agrupaciones_secuencia_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE agrupaciones_secuencia_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE agrupaciones_secuencia_seq OWNER TO postgres;

--
-- Name: agrupaciones_secuencia_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE agrupaciones_secuencia_seq OWNED BY agrupaciones.secuencia;


--
-- Name: almacenes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE almacenes (
    codigo character varying(4) NOT NULL,
    responsable integer NOT NULL,
    primer_auxiliar integer,
    segundo_auxiliar integer,
    descripcion character varying(150) NOT NULL,
    secuencia integer NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE almacenes OWNER TO postgres;

--
-- Name: almacenes_secuencia_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE almacenes_secuencia_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE almacenes_secuencia_seq OWNER TO postgres;

--
-- Name: almacenes_secuencia_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE almacenes_secuencia_seq OWNED BY almacenes.secuencia;


--
-- Name: catalogo_objetos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE catalogo_objetos (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL,
    descripcion character varying(200) NOT NULL,
    especificaciones character varying(200) NOT NULL,
    cod_unidad integer NOT NULL,
    cod_clase_objeto integer NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE catalogo_objetos OWNER TO postgres;

--
-- Name: catalogo_objetos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE catalogo_objetos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE catalogo_objetos_id_seq OWNER TO postgres;

--
-- Name: catalogo_objetos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE catalogo_objetos_id_seq OWNED BY catalogo_objetos.id;


--
-- Name: ciudades; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE ciudades (
    id_ciudad integer NOT NULL,
    id_estado integer NOT NULL,
    ciudad character varying(200) NOT NULL,
    capital boolean DEFAULT false NOT NULL
);


ALTER TABLE ciudades OWNER TO postgres;

--
-- Name: ciudades_id_ciudad_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE ciudades_id_ciudad_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ciudades_id_ciudad_seq OWNER TO postgres;

--
-- Name: ciudades_id_ciudad_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE ciudades_id_ciudad_seq OWNED BY ciudades.id_ciudad;


--
-- Name: clase_objetos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE clase_objetos (
    id integer NOT NULL,
    nombre character varying(30) NOT NULL,
    descripcion character varying(50) NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE clase_objetos OWNER TO postgres;

--
-- Name: clase_objetos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE clase_objetos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE clase_objetos_id_seq OWNER TO postgres;

--
-- Name: clase_objetos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE clase_objetos_id_seq OWNED BY clase_objetos.id;


--
-- Name: clasificacion_elementos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE clasificacion_elementos (
    cod_clasificacion integer NOT NULL,
    descripcion character varying(25) NOT NULL
);


ALTER TABLE clasificacion_elementos OWNER TO postgres;

--
-- Name: elementos_quimicos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE elementos_quimicos (
    id integer NOT NULL,
    periodo integer NOT NULL,
    grupo_cas character varying(5) NOT NULL,
    grupo_iupac integer NOT NULL,
    simbolo character varying(3) NOT NULL,
    numero_atomico integer NOT NULL,
    nombre character varying(20) NOT NULL,
    peso_atomico numeric(20,10) NOT NULL,
    valencia character varying(20) NOT NULL,
    temp_ebullicion numeric(20,10) NOT NULL,
    temp_fusion numeric(20,10) NOT NULL,
    bloque character varying(2) NOT NULL,
    cod_estado integer NOT NULL,
    cod_clasificacion integer NOT NULL,
    cod_subclasificacion integer NOT NULL,
    config_electronica character varying(90) NOT NULL,
    densidad numeric(15,10) NOT NULL,
    electronegatividad numeric(15,10) NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE elementos_quimicos OWNER TO postgres;

--
-- Name: elementos_quimicos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE elementos_quimicos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE elementos_quimicos_id_seq OWNER TO postgres;

--
-- Name: elementos_quimicos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE elementos_quimicos_id_seq OWNED BY elementos_quimicos.id;


--
-- Name: entradas_inventario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE entradas_inventario (
    id integer NOT NULL,
    id_proveedor character varying(5) NOT NULL,
    id_usuario integer NOT NULL,
    cod_objeto integer NOT NULL,
    cod_dimension character varying(4) NOT NULL,
    cod_subdimension character varying(3) NOT NULL,
    cod_agrupacion character varying(4) NOT NULL,
    cantidad numeric(8,2) NOT NULL,
    hora time without time zone NOT NULL,
    fecha date NOT NULL,
    observaciones character varying(200) NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE entradas_inventario OWNER TO postgres;

--
-- Name: entradas_inventario_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE entradas_inventario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE entradas_inventario_id_seq OWNER TO postgres;

--
-- Name: entradas_inventario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE entradas_inventario_id_seq OWNED BY entradas_inventario.id;


--
-- Name: estados; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE estados (
    id_estado integer NOT NULL,
    estado character varying(250) NOT NULL,
    "iso_3166-2" character varying(4) NOT NULL
);


ALTER TABLE estados OWNER TO postgres;

--
-- Name: estados_id_estado_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE estados_id_estado_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE estados_id_estado_seq OWNER TO postgres;

--
-- Name: estados_id_estado_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE estados_id_estado_seq OWNED BY estados.id_estado;


--
-- Name: estados_materia; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE estados_materia (
    cod_estado integer NOT NULL,
    descripcion character varying(30) NOT NULL
);


ALTER TABLE estados_materia OWNER TO postgres;

--
-- Name: inventario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE inventario (
    cod_dimension character varying(4) NOT NULL,
    cod_subdimension character varying(3) NOT NULL,
    cod_agrupacion character varying(3) NOT NULL,
    cod_subagrupacion character varying(3),
    numero_orden integer NOT NULL,
    cod_objeto integer NOT NULL,
    cantidad_disponible numeric(8,2) NOT NULL,
    usa_recipientes boolean NOT NULL,
    elemento_movible boolean DEFAULT false NOT NULL,
    recipientes_disponibles integer,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE inventario OWNER TO postgres;

--
-- Name: laboratorios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE laboratorios (
    codigo character varying(4) NOT NULL,
    nombre character varying(40) NOT NULL,
    descripcion character varying(150),
    secuencia integer NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE laboratorios OWNER TO postgres;

--
-- Name: laboratorios_secuencia_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE laboratorios_secuencia_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE laboratorios_secuencia_seq OWNER TO postgres;

--
-- Name: laboratorios_secuencia_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE laboratorios_secuencia_seq OWNED BY laboratorios.secuencia;


--
-- Name: mensajes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE mensajes (
    id integer NOT NULL,
    mensaje character varying(200) NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE mensajes OWNER TO postgres;

--
-- Name: mensajes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE mensajes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mensajes_id_seq OWNER TO postgres;

--
-- Name: mensajes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE mensajes_id_seq OWNED BY mensajes.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE migrations (
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE migrations OWNER TO postgres;

--
-- Name: municipios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE municipios (
    id_municipio integer NOT NULL,
    id_estado integer NOT NULL,
    municipio character varying(100) NOT NULL
);


ALTER TABLE municipios OWNER TO postgres;

--
-- Name: municipios_id_municipio_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE municipios_id_municipio_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE municipios_id_municipio_seq OWNER TO postgres;

--
-- Name: municipios_id_municipio_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE municipios_id_municipio_seq OWNED BY municipios.id_municipio;


--
-- Name: notificaciones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE notificaciones (
    id integer NOT NULL,
    mensaje_id integer NOT NULL,
    fecha date NOT NULL,
    hora time without time zone NOT NULL,
    emisor integer NOT NULL,
    receptor integer NOT NULL,
    visto boolean DEFAULT false NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE notificaciones OWNER TO postgres;

--
-- Name: notificaciones_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE notificaciones_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE notificaciones_id_seq OWNER TO postgres;

--
-- Name: notificaciones_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE notificaciones_id_seq OWNED BY notificaciones.id;


--
-- Name: objetos_laboratorio; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE objetos_laboratorio (
    id integer NOT NULL,
    cod_laboratorio character varying(4) NOT NULL,
    cod_objeto integer NOT NULL,
    created_at timestamp without time zone NOT NULL,
    updated_at timestamp without time zone NOT NULL
);


ALTER TABLE objetos_laboratorio OWNER TO postgres;

--
-- Name: objetos_laboratorio_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE objetos_laboratorio_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE objetos_laboratorio_id_seq OWNER TO postgres;

--
-- Name: objetos_laboratorio_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE objetos_laboratorio_id_seq OWNED BY objetos_laboratorio.id;


--
-- Name: parroquias; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE parroquias (
    id_parroquia integer NOT NULL,
    id_municipio integer NOT NULL,
    parroquia character varying(250) NOT NULL
);


ALTER TABLE parroquias OWNER TO postgres;

--
-- Name: parroquias_id_parroquia_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE parroquias_id_parroquia_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE parroquias_id_parroquia_seq OWNER TO postgres;

--
-- Name: parroquias_id_parroquia_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE parroquias_id_parroquia_seq OWNED BY parroquias.id_parroquia;


--
-- Name: permisos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE permisos (
    codigo character varying(5) NOT NULL,
    nombre character varying(15) NOT NULL,
    descripcion character varying(150) NOT NULL,
    secuencia integer NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE permisos OWNER TO postgres;

--
-- Name: permisos_secuencia_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE permisos_secuencia_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE permisos_secuencia_seq OWNER TO postgres;

--
-- Name: permisos_secuencia_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE permisos_secuencia_seq OWNED BY permisos.secuencia;


--
-- Name: permisos_usuarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE permisos_usuarios (
    id integer NOT NULL,
    cod_permiso character varying(4) NOT NULL,
    usuario_id integer NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE permisos_usuarios OWNER TO postgres;

--
-- Name: permisos_usuarios_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE permisos_usuarios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE permisos_usuarios_id_seq OWNER TO postgres;

--
-- Name: permisos_usuarios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE permisos_usuarios_id_seq OWNED BY permisos_usuarios.id;


--
-- Name: personas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE personas (
    id integer NOT NULL,
    primer_nombre character varying(15) NOT NULL,
    segundo_nombre character varying(15),
    primer_apellido character varying(15) NOT NULL,
    segundo_apellido character varying(15),
    cedula character varying(8) NOT NULL,
    sexo_id integer NOT NULL,
    usuario_id integer NOT NULL,
    fecha_nacimiento date NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE personas OWNER TO postgres;

--
-- Name: personas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE personas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE personas_id_seq OWNER TO postgres;

--
-- Name: personas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE personas_id_seq OWNED BY personas.id;


--
-- Name: proveedores; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE proveedores (
    codigo character varying(5) NOT NULL,
    razon_social character varying(150) NOT NULL,
    doc_identificacion character varying(11) NOT NULL,
    telefono_fijo1 character varying(15) NOT NULL,
    telefono_fijo2 character varying(15),
    telefono_movil1 character varying(15) NOT NULL,
    telefono_movil2 character varying(15),
    email character varying(100) NOT NULL,
    direccion character varying(200) NOT NULL,
    cod_estado integer NOT NULL,
    cod_ciudad integer NOT NULL,
    cod_municipio integer NOT NULL,
    cod_parroquia integer NOT NULL,
    secuencia integer NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE proveedores OWNER TO postgres;

--
-- Name: proveedores_secuencia_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE proveedores_secuencia_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE proveedores_secuencia_seq OWNER TO postgres;

--
-- Name: proveedores_secuencia_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE proveedores_secuencia_seq OWNED BY proveedores.secuencia;


--
-- Name: salidas_inventario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE salidas_inventario (
    id integer NOT NULL,
    id_usuario integer NOT NULL,
    cod_objeto integer NOT NULL,
    cantidad numeric(8,2) NOT NULL,
    cod_dimension character varying(4) NOT NULL,
    cod_subdimension character varying(3) NOT NULL,
    cod_agrupacion character varying(4) NOT NULL,
    hora time without time zone NOT NULL,
    fecha date NOT NULL,
    observaciones character varying(200) NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE salidas_inventario OWNER TO postgres;

--
-- Name: salidas_inventario_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE salidas_inventario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE salidas_inventario_id_seq OWNER TO postgres;

--
-- Name: salidas_inventario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE salidas_inventario_id_seq OWNED BY salidas_inventario.id;


--
-- Name: sexos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE sexos (
    id integer NOT NULL,
    descripcion character varying(15) NOT NULL
);


ALTER TABLE sexos OWNER TO postgres;

--
-- Name: sexos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sexos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sexos_id_seq OWNER TO postgres;

--
-- Name: sexos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE sexos_id_seq OWNED BY sexos.id;


--
-- Name: sub_agrupaciones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE sub_agrupaciones (
    codigo character varying(3) NOT NULL,
    nombre character varying(50) NOT NULL,
    descripcion character varying(150) NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE sub_agrupaciones OWNER TO postgres;

--
-- Name: sub_dimensiones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE sub_dimensiones (
    codigo character varying(3) NOT NULL,
    descripcion character varying(150) NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE sub_dimensiones OWNER TO postgres;

--
-- Name: subclasificacion_elementos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE subclasificacion_elementos (
    cod_clasificacion integer NOT NULL,
    cod_subclasificacion integer NOT NULL,
    descripcion character varying(25) NOT NULL
);


ALTER TABLE subclasificacion_elementos OWNER TO postgres;

--
-- Name: tipos_unidades; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE tipos_unidades (
    id integer NOT NULL,
    nombre character varying(20) NOT NULL
);


ALTER TABLE tipos_unidades OWNER TO postgres;

--
-- Name: tipos_unidades_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tipos_unidades_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tipos_unidades_id_seq OWNER TO postgres;

--
-- Name: tipos_unidades_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tipos_unidades_id_seq OWNED BY tipos_unidades.id;


--
-- Name: tipos_usuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE tipos_usuario (
    codigo character varying(4) NOT NULL,
    nombre character varying(15) NOT NULL,
    descripcion character varying(50) NOT NULL,
    secuencia integer NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE tipos_usuario OWNER TO postgres;

--
-- Name: tipos_usuario_secuencia_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tipos_usuario_secuencia_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tipos_usuario_secuencia_seq OWNER TO postgres;

--
-- Name: tipos_usuario_secuencia_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tipos_usuario_secuencia_seq OWNED BY tipos_usuario.secuencia;


--
-- Name: unidades; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE unidades (
    cod_unidad integer NOT NULL,
    nombre character varying(50) NOT NULL,
    abreviatura character varying(10) NOT NULL,
    tipo_unidad integer NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE unidades OWNER TO postgres;

--
-- Name: unidades_cod_unidad_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE unidades_cod_unidad_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE unidades_cod_unidad_seq OWNER TO postgres;

--
-- Name: unidades_cod_unidad_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE unidades_cod_unidad_seq OWNED BY unidades.cod_unidad;


--
-- Name: usuarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE usuarios (
    id integer NOT NULL,
    usuario character varying(15) NOT NULL,
    email character varying(60) NOT NULL,
    password character varying(255) NOT NULL,
    cod_tipo_usuario character varying(4) NOT NULL,
    imagen character varying(100) DEFAULT '/img/perfil-default.jpg'::character varying NOT NULL,
    activo boolean DEFAULT true NOT NULL,
    remember_token character varying(100),
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE usuarios OWNER TO postgres;

--
-- Name: usuarios_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE usuarios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE usuarios_id_seq OWNER TO postgres;

--
-- Name: usuarios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE usuarios_id_seq OWNED BY usuarios.id;


--
-- Name: vista_almacen_full; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_almacen_full AS
 SELECT almacenes.codigo AS cod_dimension,
    almacenes.descripcion,
    responsable.primer_nombre AS primer_nombre_responsable,
    responsable.primer_apellido AS primer_apellido_responsable,
    primer_auxiliar.primer_nombre AS primer_nombre_primer_auxiliar,
    primer_auxiliar.primer_apellido AS primer_apellido_primer_auxiliar,
    segundo_auxiliar.primer_nombre AS primer_nombre_segundo_auxiliar,
    segundo_auxiliar.primer_apellido AS primer_apellido_segundo_auxiliar
   FROM (((almacenes
     JOIN personas responsable ON ((responsable.id = almacenes.responsable)))
     JOIN personas primer_auxiliar ON ((primer_auxiliar.id = almacenes.primer_auxiliar)))
     LEFT JOIN personas segundo_auxiliar ON ((segundo_auxiliar.id = almacenes.segundo_auxiliar)));


ALTER TABLE vista_almacen_full OWNER TO postgres;

--
-- Name: vista_inventario; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_inventario AS
 SELECT inventario.numero_orden,
    inventario.cantidad_disponible,
    inventario.usa_recipientes,
    inventario.elemento_movible,
    inventario.recipientes_disponibles,
    almacenes.codigo AS cod_dimension,
    almacenes.descripcion AS descripcion_dimension,
    sub_dimensiones.codigo AS cod_subdimension,
    sub_dimensiones.descripcion AS descripcion_subdimension,
    agrupaciones.codigo AS cod_agrupacion,
    agrupaciones.nombre AS nombre_agrupacion,
    agrupaciones.descripcion AS descripcion_agrupacion,
    sub_agrupaciones.codigo AS cod_subagrupacion,
    sub_agrupaciones.nombre AS nombre_subagrupaciones,
    sub_agrupaciones.descripcion AS descripcion_subagrupacion,
    catalogo_objetos.id AS cod_objeto,
    catalogo_objetos.nombre AS nombre_objeto,
    catalogo_objetos.descripcion AS descripcion_objeto,
    catalogo_objetos.especificaciones AS especificaciones_objeto,
    unidades.cod_unidad,
    unidades.nombre AS nombre_unidad,
    unidades.abreviatura AS abreviatura_unidad,
    tipos_unidades.id AS cod_tipo_unidad,
    tipos_unidades.nombre AS nombre_tipo_unidad,
    clase_objetos.id AS cod_clase_objeto,
    clase_objetos.nombre AS nombre_clase_objeto,
    clase_objetos.descripcion AS descripcion_clase_objeto
   FROM ((((((((inventario
     JOIN almacenes ON (((almacenes.codigo)::text = (inventario.cod_dimension)::text)))
     JOIN sub_dimensiones ON (((sub_dimensiones.codigo)::text = (inventario.cod_subdimension)::text)))
     JOIN agrupaciones ON (((agrupaciones.codigo)::text = (inventario.cod_agrupacion)::text)))
     LEFT JOIN sub_agrupaciones ON (((sub_agrupaciones.codigo)::text = (inventario.cod_subagrupacion)::text)))
     JOIN catalogo_objetos ON ((catalogo_objetos.id = inventario.cod_objeto)))
     JOIN unidades ON ((unidades.cod_unidad = catalogo_objetos.cod_unidad)))
     JOIN tipos_unidades ON ((tipos_unidades.id = unidades.tipo_unidad)))
     JOIN clase_objetos ON ((clase_objetos.id = catalogo_objetos.cod_clase_objeto)));


ALTER TABLE vista_inventario OWNER TO postgres;

--
-- Name: vista_objetos_full; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_objetos_full AS
 SELECT catalogo_objetos.id AS cod_objeto,
    catalogo_objetos.nombre AS nombre_objeto,
    catalogo_objetos.descripcion AS descripcion_objeto,
    catalogo_objetos.especificaciones AS especificaciones_objeto,
    unidades.cod_unidad,
    unidades.nombre AS nombre_unidad,
    unidades.abreviatura AS abreviatura_unidad,
    tipos_unidades.id AS cod_tipo_unidad,
    tipos_unidades.nombre AS nombre_tipo_unidad,
    clase_objetos.id AS cod_clase_objeto,
    clase_objetos.nombre AS nombre_clase_objeto,
    clase_objetos.descripcion AS descripcion_clase_objeto
   FROM (((catalogo_objetos
     JOIN unidades ON ((unidades.cod_unidad = catalogo_objetos.cod_unidad)))
     JOIN tipos_unidades ON ((tipos_unidades.id = unidades.tipo_unidad)))
     JOIN clase_objetos ON ((clase_objetos.id = catalogo_objetos.cod_clase_objeto)));


ALTER TABLE vista_objetos_full OWNER TO postgres;

--
-- Name: vista_usuarios_full; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_usuarios_full AS
 SELECT usuarios.id AS id_usuario,
    usuarios.usuario,
    usuarios.email,
    usuarios.imagen,
    usuarios.activo,
    usuarios.cod_tipo_usuario,
    tipos_usuario.nombre AS tipo_usuario_nombre,
    tipos_usuario.descripcion AS tipo_usuario_descripcion,
    permisos_usuario(usuarios.id) AS permisos,
    personas.id AS id_persona,
    personas.primer_nombre,
    personas.segundo_nombre,
    personas.primer_apellido,
    personas.segundo_apellido,
    personas.cedula,
    personas.fecha_nacimiento,
    personas.sexo_id,
    sexos.descripcion AS sexo
   FROM (((usuarios
     JOIN tipos_usuario ON (((tipos_usuario.codigo)::text = (usuarios.cod_tipo_usuario)::text)))
     LEFT JOIN personas ON ((personas.usuario_id = usuarios.id)))
     LEFT JOIN sexos ON ((personas.sexo_id = sexos.id)));


ALTER TABLE vista_usuarios_full OWNER TO postgres;

--
-- Name: secuencia; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY agrupaciones ALTER COLUMN secuencia SET DEFAULT nextval('agrupaciones_secuencia_seq'::regclass);


--
-- Name: secuencia; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY almacenes ALTER COLUMN secuencia SET DEFAULT nextval('almacenes_secuencia_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY catalogo_objetos ALTER COLUMN id SET DEFAULT nextval('catalogo_objetos_id_seq'::regclass);


--
-- Name: id_ciudad; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ciudades ALTER COLUMN id_ciudad SET DEFAULT nextval('ciudades_id_ciudad_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY clase_objetos ALTER COLUMN id SET DEFAULT nextval('clase_objetos_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY elementos_quimicos ALTER COLUMN id SET DEFAULT nextval('elementos_quimicos_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY entradas_inventario ALTER COLUMN id SET DEFAULT nextval('entradas_inventario_id_seq'::regclass);


--
-- Name: id_estado; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY estados ALTER COLUMN id_estado SET DEFAULT nextval('estados_id_estado_seq'::regclass);


--
-- Name: secuencia; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY laboratorios ALTER COLUMN secuencia SET DEFAULT nextval('laboratorios_secuencia_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mensajes ALTER COLUMN id SET DEFAULT nextval('mensajes_id_seq'::regclass);


--
-- Name: id_municipio; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY municipios ALTER COLUMN id_municipio SET DEFAULT nextval('municipios_id_municipio_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY notificaciones ALTER COLUMN id SET DEFAULT nextval('notificaciones_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY objetos_laboratorio ALTER COLUMN id SET DEFAULT nextval('objetos_laboratorio_id_seq'::regclass);


--
-- Name: id_parroquia; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY parroquias ALTER COLUMN id_parroquia SET DEFAULT nextval('parroquias_id_parroquia_seq'::regclass);


--
-- Name: secuencia; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY permisos ALTER COLUMN secuencia SET DEFAULT nextval('permisos_secuencia_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY permisos_usuarios ALTER COLUMN id SET DEFAULT nextval('permisos_usuarios_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY personas ALTER COLUMN id SET DEFAULT nextval('personas_id_seq'::regclass);


--
-- Name: secuencia; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY proveedores ALTER COLUMN secuencia SET DEFAULT nextval('proveedores_secuencia_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY salidas_inventario ALTER COLUMN id SET DEFAULT nextval('salidas_inventario_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sexos ALTER COLUMN id SET DEFAULT nextval('sexos_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipos_unidades ALTER COLUMN id SET DEFAULT nextval('tipos_unidades_id_seq'::regclass);


--
-- Name: secuencia; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipos_usuario ALTER COLUMN secuencia SET DEFAULT nextval('tipos_usuario_secuencia_seq'::regclass);


--
-- Name: cod_unidad; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY unidades ALTER COLUMN cod_unidad SET DEFAULT nextval('unidades_cod_unidad_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuarios ALTER COLUMN id SET DEFAULT nextval('usuarios_id_seq'::regclass);


--
-- Data for Name: agrupaciones; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY agrupaciones (codigo, nombre, descripcion, secuencia, created_at, updated_at) FROM stdin;
M1	metales	agrupacion de metales	1	2016-03-22 03:09:49	2016-03-22 03:09:49
AC2	acidos bases	agrupacion de acidos bases	2	2016-03-22 03:10:05	2016-03-22 03:10:05
AB2	acidos basicos	esta es la agrupacion para los aciodos basicos/	3	2016-03-22 03:33:12	2016-03-22 03:33:12
CE1	telefonos samsung	esta es la agrupación de samsung	4	2016-03-22 03:35:07	2016-03-22 03:35:07
CP1	computadoras	agrupacion de computadoras	5	2016-03-22 03:36:10	2016-03-22 03:36:10
\.


--
-- Name: agrupaciones_secuencia_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('agrupaciones_secuencia_seq', 5, true);


--
-- Data for Name: almacenes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY almacenes (codigo, responsable, primer_auxiliar, segundo_auxiliar, descripcion, secuencia, created_at, updated_at) FROM stdin;
AL01	3	2	1	almacen de reactivos quimicos	1	2016-03-22 03:01:34	2016-03-22 03:01:34
AL02	2	3	1	Este es almacen	2	2016-03-22 03:26:33	2016-03-22 03:26:33
AL03	3	3	\N	Almacen de procesos quimicos	3	2016-03-22 03:38:24	2016-03-22 03:38:24
AL04	1	1	1	almacen de tratamientod de agua	4	2016-03-22 03:38:40	2016-03-22 03:38:40
AL05	1	2	\N	almacen de desechos	5	2016-03-22 03:40:51	2016-03-22 03:40:51
\.


--
-- Name: almacenes_secuencia_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('almacenes_secuencia_seq', 5, true);


--
-- Data for Name: catalogo_objetos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY catalogo_objetos (id, nombre, descripcion, especificaciones, cod_unidad, cod_clase_objeto, created_at, updated_at) FROM stdin;
1	ACETATO DE ZINC DIHIDRATO	ACETATO DE ZINC DIHIDRATO	(CH3COOH)2Zn .2H2O	21	1	2016-03-22 02:47:49	2016-03-22 02:47:49
2	CLORURO DE ZINC	CLORURO DE ZINC	ZnCl2	21	1	2016-03-22 02:48:13	2016-03-22 02:48:13
3	NITRATO DE ZINC HEXAHIDRATADO	NITRATO DE ZINC HEXAHIDRATADO	Zn(NO3)2 .6H2O	21	1	2016-03-22 02:48:45	2016-03-22 02:48:45
4	SULFATO DE ZINC HEPTAHIDRATADO)	SULFATO DE ZINC HEPTAHIDRATADO	Zn(SO4) .7H2O	21	1	2016-03-22 02:49:31	2016-03-22 02:49:31
5	alizarina	alizarina	alizarina	21	1	2016-03-22 02:51:12	2016-03-22 02:51:12
6	Viales Para Muestra con Tapa Roscable Autoclavables	Viales Para Muestra con Tapa Roscable Autoclavables	Viales Para Muestra con Tapa Roscable Autoclavables	21	2	2016-03-22 02:51:19	2016-03-22 02:51:19
7	almidon	almidon	almidon	21	1	2016-03-22 02:51:50	2016-03-22 02:51:50
8	ALUMINIO METALICO EN LIMADURA	ALUMINIO METALICO EN LIMADURA	formula: Al	21	1	2016-03-22 02:53:50	2016-03-22 02:53:50
9	ALUMINIO METALICO EN ASTILLA	ALUMINIO METALICO EN ASTILLA	formula: Al	21	1	2016-03-22 02:55:14	2016-03-22 02:55:14
10	BROMURO DE MERCURIO	BROMURO DE MERCURIO	HgBr2	21	1	2016-03-22 02:55:32	2016-03-22 02:55:32
11	ALUMINIO METALICO GRANULADO	ALUMINIO METALICO GRANULADO	formula: Al	21	1	2016-03-22 02:55:42	2016-03-22 02:55:42
12	amarillo de titanio	amarillo de titanio	amarillo de titanio	21	1	2016-03-22 02:55:58	2016-03-22 02:55:58
13	ALUMINIO METALICO EN POLVO	ALUMINIO METALICO EN POLVO	formula: Al	21	1	2016-03-22 02:56:09	2016-03-22 02:56:09
14	CLORURO DE ALUMINO HEXAHIDRATADO	CLORURO DE ALUMINO HEXAHIDRATADO	AlCl3 .6H2O	21	1	2016-03-22 02:56:32	2016-03-22 02:56:32
15	HIDROXIDO DE ALUMINIO	HIDROXIDO DE ALUMINIO	Al2O3	21	1	2016-03-22 02:56:50	2016-03-22 02:56:50
16	HIDROXIDO DE ALUMINIO TRIHIDRATADO	HIDROXIDO DE ALUMINIO TRIHIDRATADO	Al2O3 .3H2O	21	1	2016-03-22 02:57:11	2016-03-22 02:57:11
17	azul de anilina	azul de anilina	azul de anilina	21	1	2016-03-22 02:57:32	2016-03-22 02:57:32
18	CLORURO FERROSO TETRAHIDRATADO	CLORURO FERROSO TETRAHIDRATADO	FeCl2 . 4H2O	21	1	2016-03-22 03:01:36	2016-03-22 03:01:36
19	CLORURO FERROSO HEXAHIDRATADO	CLORURO FERROSO HEXAHIDRATADO	FeCl2 . 6H2O	21	1	2016-03-22 03:01:58	2016-03-22 03:01:58
20	HIERRO (POLVO)	HIERRO (POLVO)	formula: Fe	21	1	2016-03-22 03:02:21	2016-03-22 03:02:21
21	HIERRO (BARRAS)	HIERRO (BARRAS)	formula: Fe	21	1	2016-03-22 03:02:46	2016-03-22 03:02:46
22	SULFATO FERROSO AMONIACAL HEXAHIDRATADO	SULFATO FERROSO AMONIACAL HEXAHIDRATADO	(NH4)2(Fe(SO4)2) .6H2O	21	1	2016-03-22 03:03:04	2016-03-22 03:03:04
23	SULFATO FERROSO HEPTAHIDRATADO	SULFATO FERROSO HEPTAHIDRATADO	FeSO4 .7H2O	21	1	2016-03-22 03:03:43	2016-03-22 03:03:43
24	OXIDO FERRICO	OXIDO FERRICO	Fe2O3	21	1	2016-03-22 03:04:00	2016-03-22 03:04:00
25	azul de bromofenol	azul de bromofenol	azul de bromofenol	21	1	2016-03-22 03:04:01	2016-03-22 03:04:01
26	ACETATO DE SODIO	ACETATO DE SODIO	(CH3COO)2Ca . 2H2O	21	1	2016-03-22 03:04:30	2016-03-22 03:04:30
27	azul de bromotinos	azul de bromotinol	azul de bromotinol	21	1	2016-03-22 03:04:48	2016-03-22 03:04:48
28	CALCIO (GRANULADO METÁLICO)	CALCIO (GRANULADO METÁLICO)	formula: Ca	21	1	2016-03-22 03:04:52	2016-03-22 03:04:52
29	CARBONATO DE CALCIO	CARBONATO DE CALCIO	CaCO3	21	1	2016-03-22 03:05:08	2016-03-22 03:05:08
30	azul de metileno	azul de metileno	azul de metileno	21	1	2016-03-22 03:05:25	2016-03-22 03:05:25
31	CARBURO DE CALCIO	CARBURO DE CALCIO	CaCO2	21	1	2016-03-22 03:05:30	2016-03-22 03:05:30
32	azul de timol	azul de timol	azul de timol	21	1	2016-03-22 03:06:47	2016-03-22 03:06:47
33	CLORURO DE CALCIO DIHIDRATADO	CLORURO DE CALCIO DIHIDRATADO	CaCl2 . 2H2O	21	1	2016-03-22 03:07:08	2016-03-22 03:07:08
34	balsamo de canada	balsamo de canada	balsamo de canada	21	1	2016-03-22 03:07:21	2016-03-22 03:07:21
35	benzoxinoxima	benzoxinoxima	benzoxinoxima	21	1	2016-03-22 03:10:36	2016-03-22 03:10:36
36	2,2  bipyridina	2,2  bipyridina	2,2  bipyridina	21	1	2016-03-22 03:11:46	2016-03-22 03:11:46
37	brucina	brucina	brucina	21	1	2016-03-22 03:13:24	2016-03-22 03:13:24
38	bromocresol purpura	bromocresol purpura	bromocresol purpura	21	1	2016-03-22 03:14:15	2016-03-22 03:14:15
39	cresol purpura	cresol purpura	Cresol Purpura	21	1	2016-03-22 03:18:28	2016-03-22 03:18:28
40	DIFENILCARBACIDA	DIFENILCARBACIDA	C13H14N4O	46	1	2016-03-22 03:25:22	2016-03-22 03:25:22
41	samsung galaxy S6	samsung galaxy S6 especial para gente con cobre	2gb ram 15gbSDD	44	3	2016-03-22 03:27:32	2016-03-22 03:27:32
42	samsung galaxy S4	samsung galaxy S4 para personas de bajos recursos	1gb ram 4gb sd camara 15mx	44	3	2016-03-22 03:28:14	2016-03-22 03:28:14
43	caniama tr1	industrias caniama	2gb ram procesador 1.5 celeron	44	3	2016-03-22 03:29:27	2016-03-22 03:29:27
44	caniama tr1	industrias caniama	2gb ram procesador 1.5 celeron	44	3	2016-03-22 03:29:27	2016-03-22 03:29:27
45	difenilamina	difenilamina	difenilamina	21	1	2016-03-22 03:34:56	2016-03-22 03:34:56
46	DIFENILCARBACIDA	DIFENILCARBACIDA	C13H14N4O	21	1	2016-03-22 03:35:24	2016-03-22 03:35:24
47	1,5DIFENILCARBOZONA	1,5DIFENILCARBOZONA	C13H12N4O	21	1	2016-03-22 03:37:19	2016-03-22 03:37:19
48	DITHIZONA	DITHIZONA	C13H12N4S	46	1	2016-03-22 03:38:04	2016-03-22 03:38:04
49	dimetilglioxim	dimetilglioxim	dimetilglioxim	46	1	2016-03-22 03:38:31	2016-03-22 03:38:31
50	2,4 DINITROFENILIDRACINA	2,4 DINITROFENILIDRACINA	2,4 DINITROFENILIDRACINA	46	1	2016-03-22 03:39:14	2016-03-22 03:39:14
51	ERIOCROMO CIANINA R	C23H15NA3O9S	C23H15NA3O9S	46	1	2016-03-22 03:39:40	2016-03-22 03:39:40
52	EOSINA AMARILLENTA	EOSINA AMARILLENTA	EOSINA AMARILLENTA	46	1	2016-03-22 03:40:52	2016-03-22 03:40:52
53	FENOLTALEINA	FENOLTALEINA	C20H14O4	46	1	2016-03-22 03:41:15	2016-03-22 03:41:15
54	1,10 FENOLTROLINA	1,10 FENOLTROLINA	C12H8N2H2O	46	1	2016-03-22 03:42:30	2016-03-22 03:42:30
\.


--
-- Name: catalogo_objetos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('catalogo_objetos_id_seq', 54, true);


--
-- Data for Name: ciudades; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY ciudades (id_ciudad, id_estado, ciudad, capital) FROM stdin;
1	1	Maroa	f
2	1	Puerto Ayacucho	t
3	1	San Fernando de Atabapo	f
4	2	Anaco	f
5	2	Aragua de Barcelona	f
6	2	Barcelona	t
7	2	Boca de Uchire	f
8	2	Cantaura	f
9	2	Clarines	f
10	2	El Chaparro	f
11	2	El Pao Anzoátegui	f
12	2	El Tigre	f
13	2	El Tigrito	f
14	2	Guanape	f
15	2	Guanta	f
16	2	Lechería	f
17	2	Onoto	f
18	2	Pariaguán	f
19	2	Píritu	f
20	2	Puerto La Cruz	f
21	2	Puerto Píritu	f
22	2	Sabana de Uchire	f
23	2	San Mateo Anzoátegui	f
24	2	San Pablo Anzoátegui	f
25	2	San Tomé	f
26	2	Santa Ana de Anzoátegui	f
27	2	Santa Fe Anzoátegui	f
28	2	Santa Rosa	f
29	2	Soledad	f
30	2	Urica	f
31	2	Valle de Guanape	f
43	3	Achaguas	f
44	3	Biruaca	f
45	3	Bruzual	f
46	3	El Amparo	f
47	3	El Nula	f
48	3	Elorza	f
49	3	Guasdualito	f
50	3	Mantecal	f
51	3	Puerto Páez	f
52	3	San Fernando de Apure	t
53	3	San Juan de Payara	f
54	4	Barbacoas	f
55	4	Cagua	f
56	4	Camatagua	f
58	4	Choroní	f
59	4	Colonia Tovar	f
60	4	El Consejo	f
61	4	La Victoria	f
62	4	Las Tejerías	f
63	4	Magdaleno	f
64	4	Maracay	t
65	4	Ocumare de La Costa	f
66	4	Palo Negro	f
67	4	San Casimiro	f
68	4	San Mateo	f
69	4	San Sebastián	f
70	4	Santa Cruz de Aragua	f
71	4	Tocorón	f
72	4	Turmero	f
73	4	Villa de Cura	f
74	4	Zuata	f
75	5	Barinas	t
76	5	Barinitas	f
77	5	Barrancas	f
78	5	Calderas	f
79	5	Capitanejo	f
80	5	Ciudad Bolivia	f
81	5	El Cantón	f
82	5	Las Veguitas	f
83	5	Libertad de Barinas	f
84	5	Sabaneta	f
85	5	Santa Bárbara de Barinas	f
86	5	Socopó	f
87	6	Caicara del Orinoco	f
88	6	Canaima	f
89	6	Ciudad Bolívar	t
90	6	Ciudad Piar	f
91	6	El Callao	f
92	6	El Dorado	f
93	6	El Manteco	f
94	6	El Palmar	f
95	6	El Pao	f
96	6	Guasipati	f
97	6	Guri	f
98	6	La Paragua	f
99	6	Matanzas	f
100	6	Puerto Ordaz	f
101	6	San Félix	f
102	6	Santa Elena de Uairén	f
103	6	Tumeremo	f
104	6	Unare	f
105	6	Upata	f
106	7	Bejuma	f
107	7	Belén	f
108	7	Campo de Carabobo	f
109	7	Canoabo	f
110	7	Central Tacarigua	f
111	7	Chirgua	f
112	7	Ciudad Alianza	f
113	7	El Palito	f
114	7	Guacara	f
115	7	Guigue	f
116	7	Las Trincheras	f
117	7	Los Guayos	f
118	7	Mariara	f
119	7	Miranda	f
120	7	Montalbán	f
121	7	Morón	f
122	7	Naguanagua	f
123	7	Puerto Cabello	f
124	7	San Joaquín	f
125	7	Tocuyito	f
126	7	Urama	f
127	7	Valencia	t
128	7	Vigirimita	f
129	8	Aguirre	f
130	8	Apartaderos Cojedes	f
131	8	Arismendi	f
132	8	Camuriquito	f
133	8	El Baúl	f
134	8	El Limón	f
135	8	El Pao Cojedes	f
136	8	El Socorro	f
137	8	La Aguadita	f
138	8	Las Vegas	f
139	8	Libertad de Cojedes	f
140	8	Mapuey	f
141	8	Piñedo	f
142	8	Samancito	f
143	8	San Carlos	t
144	8	Sucre	f
145	8	Tinaco	f
146	8	Tinaquillo	f
147	8	Vallecito	f
148	9	Tucupita	t
149	24	Caracas	t
150	24	El Junquito	f
151	10	Adícora	f
152	10	Boca de Aroa	f
153	10	Cabure	f
154	10	Capadare	f
155	10	Capatárida	f
156	10	Chichiriviche	f
157	10	Churuguara	f
158	10	Coro	t
159	10	Cumarebo	f
160	10	Dabajuro	f
161	10	Judibana	f
162	10	La Cruz de Taratara	f
163	10	La Vela de Coro	f
164	10	Los Taques	f
165	10	Maparari	f
166	10	Mene de Mauroa	f
167	10	Mirimire	f
168	10	Pedregal	f
169	10	Píritu Falcón	f
170	10	Pueblo Nuevo Falcón	f
171	10	Puerto Cumarebo	f
172	10	Punta Cardón	f
173	10	Punto Fijo	f
174	10	San Juan de Los Cayos	f
175	10	San Luis	f
176	10	Santa Ana Falcón	f
177	10	Santa Cruz De Bucaral	f
178	10	Tocopero	f
179	10	Tocuyo de La Costa	f
180	10	Tucacas	f
181	10	Yaracal	f
182	11	Altagracia de Orituco	f
183	11	Cabruta	f
184	11	Calabozo	f
185	11	Camaguán	f
196	11	Chaguaramas Guárico	f
197	11	El Socorro	f
198	11	El Sombrero	f
199	11	Las Mercedes de Los Llanos	f
200	11	Lezama	f
201	11	Onoto	f
202	11	Ortíz	f
203	11	San José de Guaribe	f
204	11	San Juan de Los Morros	t
205	11	San Rafael de Laya	f
206	11	Santa María de Ipire	f
207	11	Tucupido	f
208	11	Valle de La Pascua	f
209	11	Zaraza	f
210	12	Aguada Grande	f
211	12	Atarigua	f
212	12	Barquisimeto	t
213	12	Bobare	f
214	12	Cabudare	f
215	12	Carora	f
216	12	Cubiro	f
217	12	Cují	f
218	12	Duaca	f
219	12	El Manzano	f
220	12	El Tocuyo	f
221	12	Guaríco	f
222	12	Humocaro Alto	f
223	12	Humocaro Bajo	f
224	12	La Miel	f
225	12	Moroturo	f
226	12	Quíbor	f
227	12	Río Claro	f
228	12	Sanare	f
229	12	Santa Inés	f
230	12	Sarare	f
231	12	Siquisique	f
232	12	Tintorero	f
233	13	Apartaderos Mérida	f
234	13	Arapuey	f
235	13	Bailadores	f
236	13	Caja Seca	f
237	13	Canaguá	f
238	13	Chachopo	f
239	13	Chiguara	f
240	13	Ejido	f
241	13	El Vigía	f
242	13	La Azulita	f
243	13	La Playa	f
244	13	Lagunillas Mérida	f
245	13	Mérida	t
246	13	Mesa de Bolívar	f
247	13	Mucuchíes	f
248	13	Mucujepe	f
249	13	Mucuruba	f
250	13	Nueva Bolivia	f
251	13	Palmarito	f
252	13	Pueblo Llano	f
253	13	Santa Cruz de Mora	f
254	13	Santa Elena de Arenales	f
255	13	Santo Domingo	f
256	13	Tabáy	f
257	13	Timotes	f
258	13	Torondoy	f
259	13	Tovar	f
260	13	Tucani	f
261	13	Zea	f
262	14	Araguita	f
263	14	Carrizal	f
264	14	Caucagua	f
265	14	Chaguaramas Miranda	f
266	14	Charallave	f
267	14	Chirimena	f
268	14	Chuspa	f
269	14	Cúa	f
270	14	Cupira	f
271	14	Curiepe	f
272	14	El Guapo	f
273	14	El Jarillo	f
274	14	Filas de Mariche	f
275	14	Guarenas	f
276	14	Guatire	f
277	14	Higuerote	f
278	14	Los Anaucos	f
279	14	Los Teques	t
280	14	Ocumare del Tuy	f
281	14	Panaquire	f
282	14	Paracotos	f
283	14	Río Chico	f
284	14	San Antonio de Los Altos	f
285	14	San Diego de Los Altos	f
286	14	San Fernando del Guapo	f
287	14	San Francisco de Yare	f
288	14	San José de Los Altos	f
289	14	San José de Río Chico	f
290	14	San Pedro de Los Altos	f
291	14	Santa Lucía	f
292	14	Santa Teresa	f
293	14	Tacarigua de La Laguna	f
294	14	Tacarigua de Mamporal	f
295	14	Tácata	f
296	14	Turumo	f
297	15	Aguasay	f
298	15	Aragua de Maturín	f
299	15	Barrancas del Orinoco	f
300	15	Caicara de Maturín	f
301	15	Caripe	f
302	15	Caripito	f
303	15	Chaguaramal	f
305	15	Chaguaramas Monagas	f
307	15	El Furrial	f
308	15	El Tejero	f
309	15	Jusepín	f
310	15	La Toscana	f
311	15	Maturín	t
312	15	Miraflores	f
313	15	Punta de Mata	f
314	15	Quiriquire	f
315	15	San Antonio de Maturín	f
316	15	San Vicente Monagas	f
317	15	Santa Bárbara	f
318	15	Temblador	f
319	15	Teresen	f
320	15	Uracoa	f
321	16	Altagracia	f
322	16	Boca de Pozo	f
323	16	Boca de Río	f
324	16	El Espinal	f
325	16	El Valle del Espíritu Santo	f
326	16	El Yaque	f
327	16	Juangriego	f
328	16	La Asunción	t
329	16	La Guardia	f
330	16	Pampatar	f
331	16	Porlamar	f
332	16	Puerto Fermín	f
333	16	Punta de Piedras	f
334	16	San Francisco de Macanao	f
335	16	San Juan Bautista	f
336	16	San Pedro de Coche	f
337	16	Santa Ana de Nueva Esparta	f
338	16	Villa Rosa	f
339	17	Acarigua	f
340	17	Agua Blanca	f
341	17	Araure	f
342	17	Biscucuy	f
343	17	Boconoito	f
344	17	Campo Elías	f
345	17	Chabasquén	f
346	17	Guanare	t
347	17	Guanarito	f
348	17	La Aparición	f
349	17	La Misión	f
350	17	Mesa de Cavacas	f
351	17	Ospino	f
352	17	Papelón	f
353	17	Payara	f
354	17	Pimpinela	f
355	17	Píritu de Portuguesa	f
356	17	San Rafael de Onoto	f
357	17	Santa Rosalía	f
358	17	Turén	f
359	18	Altos de Sucre	f
360	18	Araya	f
361	18	Cariaco	f
362	18	Carúpano	f
363	18	Casanay	f
364	18	Cumaná	t
365	18	Cumanacoa	f
366	18	El Morro Puerto Santo	f
367	18	El Pilar	f
368	18	El Poblado	f
369	18	Guaca	f
370	18	Guiria	f
371	18	Irapa	f
372	18	Manicuare	f
373	18	Mariguitar	f
374	18	Río Caribe	f
375	18	San Antonio del Golfo	f
376	18	San José de Aerocuar	f
377	18	San Vicente de Sucre	f
378	18	Santa Fe de Sucre	f
379	18	Tunapuy	f
380	18	Yaguaraparo	f
381	18	Yoco	f
382	19	Abejales	f
383	19	Borota	f
384	19	Bramon	f
385	19	Capacho	f
386	19	Colón	f
387	19	Coloncito	f
388	19	Cordero	f
389	19	El Cobre	f
390	19	El Pinal	f
391	19	Independencia	f
392	19	La Fría	f
393	19	La Grita	f
394	19	La Pedrera	f
395	19	La Tendida	f
396	19	Las Delicias	f
397	19	Las Hernández	f
398	19	Lobatera	f
399	19	Michelena	f
400	19	Palmira	f
401	19	Pregonero	f
402	19	Queniquea	f
403	19	Rubio	f
404	19	San Antonio del Tachira	f
405	19	San Cristobal	t
406	19	San José de Bolívar	f
407	19	San Josecito	f
408	19	San Pedro del Río	f
409	19	Santa Ana Táchira	f
410	19	Seboruco	f
411	19	Táriba	f
412	19	Umuquena	f
413	19	Ureña	f
414	20	Batatal	f
415	20	Betijoque	f
416	20	Boconó	f
417	20	Carache	f
418	20	Chejende	f
419	20	Cuicas	f
420	20	El Dividive	f
421	20	El Jaguito	f
422	20	Escuque	f
423	20	Isnotú	f
424	20	Jajó	f
425	20	La Ceiba	f
426	20	La Concepción de Trujllo	f
427	20	La Mesa de Esnujaque	f
428	20	La Puerta	f
429	20	La Quebrada	f
430	20	Mendoza Fría	f
431	20	Meseta de Chimpire	f
432	20	Monay	f
433	20	Motatán	f
434	20	Pampán	f
435	20	Pampanito	f
436	20	Sabana de Mendoza	f
437	20	San Lázaro	f
438	20	Santa Ana de Trujillo	f
439	20	Tostós	f
440	20	Trujillo	t
441	20	Valera	f
442	21	Carayaca	f
443	21	Litoral	f
444	25	Archipiélago Los Roques	f
445	22	Aroa	f
446	22	Boraure	f
447	22	Campo Elías de Yaracuy	f
448	22	Chivacoa	f
449	22	Cocorote	f
450	22	Farriar	f
451	22	Guama	f
452	22	Marín	f
453	22	Nirgua	f
454	22	Sabana de Parra	f
455	22	Salom	f
456	22	San Felipe	t
457	22	San Pablo de Yaracuy	f
458	22	Urachiche	f
459	22	Yaritagua	f
460	22	Yumare	f
461	23	Bachaquero	f
462	23	Bobures	f
463	23	Cabimas	f
464	23	Campo Concepción	f
465	23	Campo Mara	f
466	23	Campo Rojo	f
467	23	Carrasquero	f
468	23	Casigua	f
469	23	Chiquinquirá	f
470	23	Ciudad Ojeda	f
471	23	El Batey	f
472	23	El Carmelo	f
473	23	El Chivo	f
474	23	El Guayabo	f
475	23	El Mene	f
476	23	El Venado	f
477	23	Encontrados	f
478	23	Gibraltar	f
479	23	Isla de Toas	f
480	23	La Concepción del Zulia	f
481	23	La Paz	f
482	23	La Sierrita	f
483	23	Lagunillas del Zulia	f
484	23	Las Piedras de Perijá	f
485	23	Los Cortijos	f
486	23	Machiques	f
487	23	Maracaibo	t
488	23	Mene Grande	f
489	23	Palmarejo	f
490	23	Paraguaipoa	f
491	23	Potrerito	f
492	23	Pueblo Nuevo del Zulia	f
493	23	Puertos de Altagracia	f
494	23	Punta Gorda	f
495	23	Sabaneta de Palma	f
496	23	San Francisco	f
497	23	San José de Perijá	f
498	23	San Rafael del Moján	f
499	23	San Timoteo	f
500	23	Santa Bárbara Del Zulia	f
501	23	Santa Cruz de Mara	f
502	23	Santa Cruz del Zulia	f
503	23	Santa Rita	f
504	23	Sinamaica	f
505	23	Tamare	f
506	23	Tía Juana	f
507	23	Villa del Rosario	f
508	21	La Guaira	t
509	21	Catia La Mar	f
510	21	Macuto	f
511	21	Naiguatá	f
512	25	Archipiélago Los Monjes	f
513	25	Isla La Tortuga y Cayos adyacentes	f
514	25	Isla La Sola	f
515	25	Islas Los Testigos	f
516	25	Islas Los Frailes	f
517	25	Isla La Orchila	f
518	25	Archipiélago Las Aves	f
519	25	Isla de Aves	f
520	25	Isla La Blanquilla	f
521	25	Isla de Patos	f
522	25	Islas Los Hermanos	f
\.


--
-- Name: ciudades_id_ciudad_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('ciudades_id_ciudad_seq', 1, false);


--
-- Data for Name: clase_objetos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY clase_objetos (id, nombre, descripcion, created_at, updated_at) FROM stdin;
1	Reactivo	reactivos quimicos	\N	\N
2	Instrumento	intrumentos de laboratorio	\N	\N
3	Equipo	equipos de laboratorio	\N	\N
\.


--
-- Name: clase_objetos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('clase_objetos_id_seq', 3, true);


--
-- Data for Name: clasificacion_elementos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY clasificacion_elementos (cod_clasificacion, descripcion) FROM stdin;
10	Metales
20	No Metales
30	Metaloides
40	Sin clasificacion
\.


--
-- Data for Name: elementos_quimicos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY elementos_quimicos (id, periodo, grupo_cas, grupo_iupac, simbolo, numero_atomico, nombre, peso_atomico, valencia, temp_ebullicion, temp_fusion, bloque, cod_estado, cod_clasificacion, cod_subclasificacion, config_electronica, densidad, electronegatividad, created_at, updated_at) FROM stdin;
1	1	IA	1	H	1	Hidrógeno	1.0079700000	1	20.2800000000	14.0100000000	S	1	20	201	1s1	0.0899000000	2.1000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
2	1	VIIIA	18	He	2	Helio	4.0026000000	2	4.2200000000	0.0000000000	S	1	20	203	1s2	0.1785000000	0.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
3	2	IA	1	Li	3	Litio	6.9400000000	2,1	1615.0000000000	453.6900000000	S	2	10	101	1s2 2s1	535.0000000000	0.9800000000	2016-03-22 02:03:44	2016-03-22 02:03:44
4	2	IIA	2	Be	4	Berilio	9.0121831000	2,2	2743.0000000000	1560.0000000000	S	3	10	102	1s2 2s2	1848.0000000000	1.5000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
5	2	IIIA	13	B	5	Boro	10.8100000000	2,3	4273.0000000000	2348.0000000000	P	2	30	400	1s2 2s2 2p1	2460.0000000000	2.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
6	2	IVA	14	C	6	Carbono	12011.0000000000	2,4	4300.0000000000	3823.0000000000	P	2	20	202	1s2 2s2 2p2	2260.0000000000	2.5000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
7	2	VA	15	N	7	Nitrógeno	14007.0000000000	2,5	77.3600000000	63.0500000000	P	1	20	202	1s2 2s2 2p3	1251.0000000000	3.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
8	2	VIA	16	O	8	Oxígeno	15999.0000000000	2,6	90.2000000000	54.8000000000	P	4	20	202	1s2 2s2 2p4	1429.0000000000	3.5000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
9	2	VIIA	17	F	9	Flúor	18.9984031630	2,7	85.0300000000	53.5000000000	P	5	20	201	1s2 2s2 2p5	1696.0000000000	4.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
10	2	VIIIA	18	Ne	10	Neón	20.1797000000	2,8	27.0700000000	24.5600000000	P	1	20	203	1s2 2s2 2p6	0.9000000000	0.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
11	3	IA	1	Na	11	Sodio	22.9897692800	2,8,1	1156.0000000000	370.8700000000	S	2	10	101	1s2 2s2 2p6 3s1	968.0000000000	0.9300000000	2016-03-22 02:03:44	2016-03-22 02:03:44
12	3	IIA	2	Mg	12	Magnesio	24305.0000000000	2,8,2	1363.0000000000	923.0000000000	S	6	10	102	1s2 2s2 2p6 3s2	1738.0000000000	1.3100000000	2016-03-22 02:03:44	2016-03-22 02:03:44
13	3	IIIA	13	Al	13	Aluminio	26.9815385000	2,8,3	2792.0000000000	933.4700000000	P	7	10	106	1s2 2s2 2p6 3s2 3p1	2700.0000000000	1.6100000000	2016-03-22 02:03:44	2016-03-22 02:03:44
14	3	IVA	14	Si	14	Silicio	28085.0000000000	2,8,4	3173.0000000000	1687.0000000000	P	2	30	400	1s2 2s2 2p6 3s2 3p2	2330.0000000000	1.9000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
15	3	VA	15	P	15	Fósforo	30.9737619980	2,8,5	1040.0000000000	594.2200000000	P	3	20	202	1s2 2s2 2p6 3s2 3p3	13534.0000000000	2.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
16	3	VIA	16	S	16	Azufre	32.0600000000	2,8,6	717.8700000000	388.3600000000	P	7	20	202	1s2 2s2 2p6 3s2 3p4	1960.0000000000	2.5800000000	2016-03-22 02:03:44	2016-03-22 02:03:44
17	3	VIIA	17	Cl	17	Cloro	35.4500000000	2,8,7	239.1100000000	171.6000000000	P	5	20	201	1s2 2s2 2p6 3s2 3p5	3214.0000000000	3.1600000000	2016-03-22 02:03:44	2016-03-22 02:03:44
18	3	VIIIA	18	Ar	18	Argón	39948.0000000000	2,8,8	87.3000000000	83.8000000000	P	1	20	203	1s2 2s2 2p6 3s2 3p6	1784.0000000000	0.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
19	4	IA	1	K	19	Potasio	39.0983000000	2,8,8,1	1032.0000000000	336.5300000000	S	7	10	101	1s2 2s2 2p6 3s2 3p6 4s1	856.0000000000	0.8200000000	2016-03-22 02:03:44	2016-03-22 02:03:44
20	4	IIA	2	Ca	20	Calcio	40078.0000000000	2,8,8,2	1757.0000000000	1115.0000000000	S	6	10	102	1s2 2s2 2p6 3s2 3p6 4s2	1550.0000000000	1.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
21	4	IIIB	3	Sc	21	Escandio	44.9559080000	2,8,9,2	3103.0000000000	1814.0000000000	D	7	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d1	2985.0000000000	1.3600000000	2016-03-22 02:03:44	2016-03-22 02:03:44
22	4	IVB	4	Ti	22	Titanio	47867.0000000000	2,8,10,2	3560.0000000000	1941.0000000000	D	7	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d2	4507.0000000000	1.5400000000	2016-03-22 02:03:44	2016-03-22 02:03:44
23	4	VB	5	V	23	Vanadio	50.9415000000	2,8,11,2	3680.0000000000	2183.0000000000	D	7	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d3	6110.0000000000	1.6300000000	2016-03-22 02:03:44	2016-03-22 02:03:44
24	4	VIB	6	Cr	24	Cromo	51.9961000000	2,8,13,1	2944.0000000000	2180.0000000000	D	7	10	105	1s2 2s2 2p6 3s2 3p6 4s1 3d5	7140.0000000000	1.6600000000	2016-03-22 02:03:44	2016-03-22 02:03:44
25	4	VIIB	7	Mn	25	Maganeso	54.9380440000	2,8,13,2	2334.0000000000	1519.0000000000	D	2	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d5	8650.0000000000	1.6900000000	2016-03-22 02:03:44	2016-03-22 02:03:44
26	4	VIIIB	8	Fe	26	Hierro	55845.0000000000	2,8,14,2	3134.0000000000	1811.0000000000	D	8	10	105	1s1 2s2 2p6 3s2 3p6 4s2 3d6	7874.0000000000	1.8300000000	2016-03-22 02:03:44	2016-03-22 02:03:44
27	4	VIIIB	9	Co	27	Cobalto	58.9331940000	2,8,15,2	3200.0000000000	1768.0000000000	D	8	10	105	1s1 2s2 2p6 3s2 3p6 4s2 3d7	8900.0000000000	1.8800000000	2016-03-22 02:03:44	2016-03-22 02:03:44
28	4	VIIIB	10	Ni	28	Níquel	58.6934000000	2,8,16,2	3186.0000000000	1728.0000000000	D	8	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d8	8908.0000000000	1.9100000000	2016-03-22 02:03:44	2016-03-22 02:03:44
29	4	IB	11	Cu	29	Cobre	63546.0000000000	2,8,18,1	3200.0000000000	1357.7700000000	D	2	10	105	1s2 2s2 2p6 3s2 3p6 4s1 3d10	8920.0000000000	1.9000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
30	4	IIB	12	Zn	30	Cinc	65.3800000000	2,8,18,2	1180.0000000000	692.6800000000	D	2	10	105	1s2 2s2 2p6 3p6 4s2 3d10	7140.0000000000	1.6500000000	2016-03-22 02:03:44	2016-03-22 02:03:44
31	4	IIIA	13	Ga	31	Galio	69723.0000000000	2,8,18,3	2477.0000000000	302.9100000000	P	7	10	106	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p1	5904.0000000000	1.8100000000	2016-03-22 02:03:44	2016-03-22 02:03:44
32	4	IVA	14	Ge	32	Germanio	72.6300000000	2,8,18,4	3093.0000000000	1211.4000000000	P	7	30	400	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p2	5323.0000000000	2.0100000000	2016-03-22 02:03:44	2016-03-22 02:03:44
33	4	VA	15	As	33	Arsénico	74.9215950000	2,8,18,5	887.0000000000	1090.0000000000	P	7	30	400	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p3	5727.0000000000	2.1800000000	2016-03-22 02:03:44	2016-03-22 02:03:44
34	4	VIA	16	Se	34	Selenio	78971.0000000000	2,8,18,6	958.0000000000	494.0000000000	P	7	20	202	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p4	4819.0000000000	2.5500000000	2016-03-22 02:03:44	2016-03-22 02:03:44
35	4	VIIA	17	Br	35	Bromo	79904.0000000000	2,8,18,7	332.0000000000	265.8000000000	P	9	20	201	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p5	3120.0000000000	2.9600000000	2016-03-22 02:03:44	2016-03-22 02:03:44
36	4	VIIIA	18	Kr	36	Kripton	83798.0000000000	2,8,18,8	119.9300000000	115.7900000000	P	5	20	203	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6	3.7500000000	3.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
37	5	IA	1	Rb	37	Rubidio	85.4678000000	2,8,18,8,1	961.0000000000	312.4600000000	S	7	10	101	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s1	1532.0000000000	0.8200000000	2016-03-22 02:03:44	2016-03-22 02:03:44
38	5	IIA	2	Sr	38	Estroncio	87.6200000000	2,8,18,8,2	1655.0000000000	1050.0000000000	S	6	10	102	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2	2630.0000000000	0.9500000000	2016-03-22 02:03:44	2016-03-22 02:03:44
39	5	IIIB	3	Y	39	Itrio	88.9058400000	2,8,18,9,2	3618.0000000000	1799.0000000000	D	7	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d1	4472.0000000000	1.2200000000	2016-03-22 02:03:44	2016-03-22 02:03:44
40	5	IVB	4	Zr	40	Circonio	91224.0000000000	2,8,18,10,2	4682.0000000000	2128.0000000000	D	7	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d2	6511.0000000000	1.3300000000	2016-03-22 02:03:44	2016-03-22 02:03:44
41	5	VB	5	Nb	41	Niobio	92.9063700000	2,8,18,12,1	5017.0000000000	2750.0000000000	D	7	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s1 4d4	8570.0000000000	1.6000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
42	5	VIB	6	Mo	42	Molibdeno	95.9500000000	2,8,18,13,1	4912.0000000000	2896.0000000000	D	7	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s1 4d5	10280.0000000000	2.1600000000	2016-03-22 02:03:44	2016-03-22 02:03:44
43	5	VIIB	7	Tc	43	Tecnecio	98.0000000000	2,8,18,13,2	4538.0000000000	2430.0000000000	D	6	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d5	11500.0000000000	1.9000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
44	5	VIIIB	8	Ru	44	Rutenio	101.0700000000	2,8,18,15,1	4423.0000000000	2607.0000000000	D	7	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s1 4d7	12370.0000000000	2.2000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
45	5	VIIIB	9	Rh	45	Rodio	102.9055000000	2,8,18,16,1	3968.0000000000	2237.0000000000	D	7	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s1 4d8	12450.0000000000	2.2800000000	2016-03-22 02:03:44	2016-03-22 02:03:44
46	5	VIIIB	10	Pd	46	Paladio	106.4200000000	2,8,18,18	3236.0000000000	1828.0500000000	D	7	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 4d10	12023.0000000000	2.2000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
47	5	IB	11	Ag	47	Plata	107.8682000000	2,8,18,18,1	2435.0000000000	1234.9300000000	D	7	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s1 4d10	10490.0000000000	1.9300000000	2016-03-22 02:03:44	2016-03-22 02:03:44
48	5	IIB	12	Cd	48	Cadmio	112414.0000000000	2,8,18,18,2	1040.0000000000	594.2200000000	D	7	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10	8650.0000000000	1.6900000000	2016-03-22 02:03:44	2016-03-22 02:03:44
49	5	IIIA	13	In	49	Indio	114818.0000000000	2,8,18,18,3	2345.0000000000	429.7500000000	P	7	10	106	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p1	7310.0000000000	1.7800000000	2016-03-22 02:03:44	2016-03-22 02:03:44
50	5	IVA	14	Sn	50	Estaño	118.7100000000	2,8,18,18,4	2875.0000000000	505.0800000000	P	7	10	106	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p2	7310.0000000000	1.9600000000	2016-03-22 02:03:44	2016-03-22 02:03:44
51	5	VA	15	Sb	51	Antimonio	121.7600000000	2,8,18,18,5	1860.0000000000	903.7800000000	P	7	30	400	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p3	6697.0000000000	2.0500000000	2016-03-22 02:03:44	2016-03-22 02:03:44
52	5	VIA	16	Te	52	Telurio	127.6000000000	2,8,18,18,6	1261.0000000000	722.6600000000	P	2	30	400	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p4	6240.0000000000	2.1000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
53	5	VIIA	17	I	53	Yodo	126.9044700000	2,8,18,18,7	457.4000000000	386.8500000000	P	7	20	201	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p5	4940.0000000000	2.6600000000	2016-03-22 02:03:44	2016-03-22 02:03:44
54	5	VIIIA	18	Xe	54	Xenón	131293.0000000000	2,8,18,18,8	165.1000000000	161.3000000000	P	5	20	203	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6	5.9000000000	2.6000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
55	6	IA	1	Cs	55	Cesio	132.9054519600	2,8,18,18,8,1	944.0000000000	301.5900000000	S	7	10	101	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s1	1879.0000000000	0.7900000000	2016-03-22 02:03:44	2016-03-22 02:03:44
56	6	IIA	2	Ba	56	Bario	137327.0000000000	2,8,18,18,8,2	2143.0000000000	1000.0000000000	S	6	10	102	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2	3510.0000000000	0.8900000000	2016-03-22 02:03:44	2016-03-22 02:03:44
57	6	IVB	3	La	57	Lantano	138.9054700000	2,8,18,18,9,2	3737.0000000000	1193.0000000000	F	7	10	103	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 5d1	6146.0000000000	1.1000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
58	6	VB	3	Ce	58	Cerio	140116.0000000000	2,8,18,19,9,2	3633.0000000000	1071.0000000000	F	7	10	103	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f1 5d1	6689.0000000000	1.1200000000	2016-03-22 02:03:44	2016-03-22 02:03:44
59	6	VIB	3	Pr	59	Praseodimio	140.9076600000	2,8,18,21,8,2	3563.0000000000	1204.0000000000	F	7	10	103	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f3	6640.0000000000	1.1300000000	2016-03-22 02:03:44	2016-03-22 02:03:44
60	6	VIIB	3	Nd	60	Neodimio	144242.0000000000	2,8,18,22,8,2	3373.0000000000	1294.0000000000	F	7	10	103	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f4	7010.0000000000	1.1400000000	2016-03-22 02:03:44	2016-03-22 02:03:44
61	6	VIIIB	3	Pm	61	Prometio	145.0000000000	2,8,18,23,8,2	3273.0000000000	1373.0000000000	F	7	10	103	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f5	7264.0000000000	0.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
62	6	VIIIB	3	Sm	62	Samario	150.3600000000	2,8,18,24,8,2	2076.0000000000	1345.0000000000	F	7	10	103	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f6	7353.0000000000	1.1700000000	2016-03-22 02:03:44	2016-03-22 02:03:44
63	6	VIIIB	3	Eu	63	Europio	151964.0000000000	2,8,18,25,8,2	1800.0000000000	1095.0000000000	F	7	10	103	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f7	5244.0000000000	0.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
64	6	IB	3	Gd	64	Gadolinio	157.2500000000	2,8,18,25,9,2	3523.0000000000	1586.0000000000	F	7	10	103	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f7 5d1	7901.0000000000	1.2000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
65	6	IIB	3	Tb	65	Terbio	158.9253500000	2,8,18,27,8,2	3503.0000000000	1629.0000000000	F	7	10	103	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f9	8219.0000000000	0.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
66	6	IIIA	3	Dy	66	Disprosio	162.5000000000	2,8,18,28,8,2	2840.0000000000	1685.0000000000	F	7	10	103	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f10	8551.0000000000	1.2200000000	2016-03-22 02:03:44	2016-03-22 02:03:44
67	6	IVA	3	Ho	67	Holmio	164.9303300000	2,8,18,29,8,2	2973.0000000000	1747.0000000000	F	7	10	103	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f11	8795.0000000000	1.2300000000	2016-03-22 02:03:44	2016-03-22 02:03:44
68	6	VA	3	Er	68	Erbio	167259.0000000000	2,8,18,30,8,2	3141.0000000000	1770.0000000000	F	7	10	103	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f12	9066.0000000000	1.2400000000	2016-03-22 02:03:44	2016-03-22 02:03:44
69	6	VIA	3	Tm	69	Tulio	168.9342200000	2,8,18,31,8,2	2223.0000000000	1818.0000000000	F	7	10	103	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f13	9321.0000000000	1.2500000000	2016-03-22 02:03:44	2016-03-22 02:03:44
70	6	VIIA	3	Yb	70	Iterbio	173054.0000000000	2,8,18,32,8,2	1469.0000000000	1092.0000000000	F	7	10	103	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14	6570.0000000000	0.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
71	6	VIIIA	3	Lu	71	Lutecio	174.9668000000	2,8,18,32,9,2	3675.0000000000	1936.0000000000	F	7	10	103	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d1	9841.0000000000	1.2700000000	2016-03-22 02:03:44	2016-03-22 02:03:44
72	6	IVB	4	hf	72	Hafnio	178.4900000000	2,8,18,32,10,2	4876.0000000000	2506.0000000000	D	7	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d2	13310.0000000000	1.3000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
73	6	VB	5	Ta	73	Tantalio	180.9478800000	2,8,18,32,11,2	5731.0000000000	3290.0000000000	D	7	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d3	16650.0000000000	1.5000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
74	6	VIB	6	W	74	Wolframio	183.8400000000	2,8,18,32,12,2	5828.0000000000	3695.0000000000	D	7	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d4	19250.0000000000	2.3600000000	2016-03-22 02:03:44	2016-03-22 02:03:44
75	6	VIIB	7	Re	75	Renio	186207.0000000000	2,8,18,32,13,2	5869.0000000000	3459.0000000000	D	10	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d5	21020.0000000000	1.9000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
76	6	VIIIB	8	Os	76	Osmio	190.2300000000	2,8,18,32,14,2	5285.0000000000	3306.0000000000	D	7	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d6	22610.0000000000	2.2000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
77	6	VIIIB	9	Ir	77	Iridio	192217.0000000000	2,8,18,32,15,2	4701.0000000000	2739.0000000000	D	7	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d7	22650.0000000000	2.2000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
78	6	VIIIB	10	Pt	78	Platino	195084.0000000000	2,8,18,32,17,1	4098.0000000000	2041.4000000000	D	7	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s1 4f14 5d9	21090.0000000000	2.2800000000	2016-03-22 02:03:44	2016-03-22 02:03:44
79	6	IB	11	Au	79	Oro	196.9665690000	2,8,18,32,18,1	3129.0000000000	1337.3300000000	D	7	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s1 4f14 5d10	19300.0000000000	2.5400000000	2016-03-22 02:03:44	2016-03-22 02:03:44
80	6	IIB	12	Hg	80	Mercurio	200.5900000000	2,8,18,32,18,2	629.8800000000	234.3200000000	D	11	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10	13534.0000000000	2.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
81	6	IIIA	13	Tl	81	Talio	204.3800000000	2,8,18,32,18,3	1746.0000000000	577.0000000000	P	7	10	106	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p1	11850.0000000000	1.6200000000	2016-03-22 02:03:44	2016-03-22 02:03:44
82	6	IVA	14	Pb	82	Plomo	207.2000000000	2,8,18,32,18,4	2022.0000000000	600.6100000000	P	7	10	106	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p2	11340.0000000000	2.3300000000	2016-03-22 02:03:44	2016-03-22 02:03:44
83	6	VA	15	Bi	83	Bismuto	208.9804000000	2,8,18,32,18,5	1837.0000000000	544.4000000000	P	7	10	106	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p3	9780.0000000000	2.0200000000	2016-03-22 02:03:44	2016-03-22 02:03:44
84	6	VIA	16	Po	84	Polonio	209.0000000000	2,8,18,32,18,6	1235.0000000000	527.0000000000	P	2	30	400	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p4	9196.0000000000	2.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
85	6	VIIA	17	At	85	Astato	210.0000000000	2,8,18,32,18,7	610.0000000000	575.0000000000	P	7	20	201	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p5	0.0000000000	2.2000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
86	6	VIIIA	18	Rn	86	Radón	222.0000000000	2,8,18,32,18,8	211.3000000000	202.0000000000	P	5	20	203	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6	9.7300000000	0.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
87	7	IA	1	Fr	87	Francio	223.0000000000	2,8,18,32,18,8,1	950.0000000000	300.0000000000	S	11	10	101	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s1	0.0000000000	0.7000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
88	7	IIA	2	Ra	88	Radio	226.0000000000	2,8,18,32,18,2	2010.0000000000	973.0000000000	S	2	10	102	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2	5000.0000000000	0.9000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
89	7	IVB	3	Ac	89	Actinio	227.0000000000	2,8,18,32,18,9,2	3473.0000000000	1323.0000000000	F	7	10	104	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 6d1	10070.0000000000	1.1000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
90	7	VB	3	Th	90	Torio	232.0377000000	2,8,18,32,18,10,2	5093.0000000000	2023.0000000000	F	7	10	104	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 6d2	11724.0000000000	1.3000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
91	7	VIB	3	Pa	91	Protactinio	231.0358800000	2,8,18,32,20,9,2	4273.0000000000	1845.0000000000	F	11	10	104	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f2 6d1	15370.0000000000	1.5000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
92	7	VIIB	3	U	92	Uranio	238.0289100000	2,8,18,32,21,9,2	4200.0000000000	1408.0000000000	F	7	10	104	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f3 6d1	19050.0000000000	1.3800000000	2016-03-22 02:03:44	2016-03-22 02:03:44
93	7	VIIIB	3	Np	93	Neptunio	237.0000000000	2,8,18,32,22,9,2	4273.0000000000	917.0000000000	F	7	10	104	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f4 6d1	20450.0000000000	1.3600000000	2016-03-22 02:03:44	2016-03-22 02:03:44
94	7	VIIIB	3	Pu	94	Plutonio	244.0000000000	2,8,18,32,24,8,2	3503.0000000000	913.0000000000	F	7	10	104	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f6	19816.0000000000	1.2800000000	2016-03-22 02:03:44	2016-03-22 02:03:44
95	7	VIIIB	3	Am	95	Americio	243.0000000000	2,8,18,32,25,8,2	2284.0000000000	1449.0000000000	F	7	10	104	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f7	0.0000000000	1.3000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
96	7	IB	3	Cm	96	Curio	247.0000000000	2,8,18,32,25,9,2	3383.0000000000	1618.0000000000	F	7	10	104	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f7 6d1	13510.0000000000	1.3000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
97	7	IIB	3	Bk	97	Berkelio	247.0000000000	2,8,18,32,27,8,2	0.0000000000	1323.0000000000	F	7	10	104	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f9	14780.0000000000	1.3000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
98	7	IIIA	3	Cf	98	Californio	251.0000000000	2,8,18,32,28,8,2	0.0000000000	1173.0000000000	F	7	10	104	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f10	15100.0000000000	1.3000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
99	7	IVA	3	Es	99	Einstenio	252.0000000000	2,8,18,32,29,8,2	0.0000000000	1133.0000000000	F	7	10	104	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f11	0.0000000000	1.3000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
100	7	VA	3	Fm	100	Fermio	257.0000000000	2,8,18,32,30,8,2	0.0000000000	1800.0000000000	F	7	10	104	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f12	0.0000000000	1.3000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
101	7	VIA	3	Md	101	Mendelevio	258.0000000000	2,8,18,32,31,8,2	0.0000000000	1100.0000000000	F	7	10	104	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f13	0.0000000000	1.3000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
102	7	VIIA	3	No	102	Nobelio	259.0000000000	2,8,18,32,32,8,2	0.0000000000	1100.0000000000	F	7	10	104	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f14	0.0000000000	1.3000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
103	7	VIIIA	3	Lr	103	Lawrencio	262.0000000000	2,8,18,32,32,8,3	0.0000000000	1900.0000000000	F	7	10	104	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f14 7p1	0.0000000000	0.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
104	7	IVB	4	Rf	104	Rutherfordio	267.0000000000	2,8,18,32,32,10,2	0.0000000000	0.0000000000	D	7	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f14 6d2	0.0000000000	0.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
105	7	VB	5	Db	105	Dubnio	268.0000000000	2,8,18,32,32,11,2	0.0000000000	0.0000000000	D	7	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f14 6d3	0.0000000000	0.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
106	7	VIB	6	Sg	106	Seaborgio	271.0000000000	2,8,18,32,32,12,2	0.0000000000	0.0000000000	D	7	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f14 6d4	0.0000000000	0.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
107	7	VIIB	7	Bh	107	Bohrio	272.0000000000	2,8,18,32,32,13,2	0.0000000000	0.0000000000	D	7	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f14 6d5	0.0000000000	0.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
108	7	VIIIB	8	Hs	108	Hassio	270.0000000000	2,8,18,32,32,14,2	0.0000000000	0.0000000000	D	7	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f14 6d6	0.0000000000	0.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
109	7	VIIIB	9	Mt	109	Meitnerio	276.0000000000	2,8,18,32,32,15,2	0.0000000000	0.0000000000	D	7	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f14 6d7	0.0000000000	0.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
110	7	VIIIB	10	Ds	110	Darmstadio	281.0000000000	2,8,18,32,32,17,1	0.0000000000	0.0000000000	D	7	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s1 5f14 6d9	0.0000000000	0.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
111	7	IB	11	Rg	111	Roentgenio	280.0000000000	2,8,18,32,32,18,1	0.0000000000	0.0000000000	D	12	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s1 5f14 6d10	0.0000000000	0.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
112	7	IIB	12	Cn	112	Copernicio	285.0000000000	2,8,18,32,32,18,2	0.0000000000	0.0000000000	D	11	10	105	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f14 6d10	0.0000000000	0.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
113	7	IIIA	13	Uut	113	Ununtrio	284.0000000000	2,8,18,32,32,18,3	0.0000000000	0.0000000000	-	13	10	106	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f14 6d10 7p1	0.0000000000	0.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
114	7	IVA	14	Fl	114	Flerovio	289.0000000000	2,8,18,32,32,18,4	0.0000000000	0.0000000000	-	13	10	106	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f14 6d10 7p2	0.0000000000	0.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
115	7	VA	15	Uup	115	Ununpentio	288.0000000000	2,8,18,32,32,18,5	0.0000000000	0.0000000000	-	11	10	106	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f14 6d10 7p3	0.0000000000	0.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
116	7	VIA	16	Lv	116	Livermorio	293.0000000000	2,8,18,32,32,18,6	0.0000000000	0.0000000000	-	11	10	106	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f14 6d10 7p4	0.0000000000	0.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
117	7	VIIA	17	Uus	117	Ununseptio	294.0000000000	2,8,18,32,32,18,7	0.0000000000	0.0000000000	-	13	20	201	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f14 6d10 7p5	0.0000000000	0.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
118	7	VIIIA	18	Uuo	118	Ununoctio	294.0000000000	2,8,18,32,32,18,8	0.0000000000	0.0000000000	-	12	20	203	1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f14 6d10 7p6	0.0000000000	0.0000000000	2016-03-22 02:03:44	2016-03-22 02:03:44
\.


--
-- Name: elementos_quimicos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('elementos_quimicos_id_seq', 118, true);


--
-- Data for Name: entradas_inventario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY entradas_inventario (id, id_proveedor, id_usuario, cod_objeto, cod_dimension, cod_subdimension, cod_agrupacion, cantidad, hora, fecha, observaciones, created_at, updated_at) FROM stdin;
\.


--
-- Name: entradas_inventario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('entradas_inventario_id_seq', 1, false);


--
-- Data for Name: estados; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY estados (id_estado, estado, "iso_3166-2") FROM stdin;
1	Amazonas	VE-X
2	Anzoátegui	VE-B
3	Apure	VE-C
4	Aragua	VE-D
5	Barinas	VE-E
6	Bolívar	VE-F
7	Carabobo	VE-G
8	Cojedes	VE-H
9	Delta Amacuro	VE-Y
10	Falcón	VE-I
11	Guárico	VE-J
12	Lara	VE-K
13	Mérida	VE-L
14	Miranda	VE-M
15	Monagas	VE-N
16	Nueva Esparta	VE-O
17	Portuguesa	VE-P
18	Sucre	VE-R
19	Táchira	VE-S
20	Trujillo	VE-T
21	Vargas	VE-W
22	Yaracuy	VE-U
23	Zulia	VE-V
24	Distrito Capital	VE-A
25	Dependencias Federales	VE-Z
\.


--
-- Name: estados_id_estado_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('estados_id_estado_seq', 1, false);


--
-- Data for Name: estados_materia; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY estados_materia (cod_estado, descripcion) FROM stdin;
1	Gas
2	Solido (No Magnetico)
3	Solido (Diamagnetico)
4	Gas (Paramagnetico)
5	Gas (No Magnetico)
6	Solido (Paramagnetico)
7	Solido
8	Solido (Ferromagnetico)
9	Liquido (muy Movil y Volatil)
10	Sin Estado
11	Liquido
12	Desconocido
13	Solido (predicción)
\.


--
-- Data for Name: inventario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY inventario (cod_dimension, cod_subdimension, cod_agrupacion, cod_subagrupacion, numero_orden, cod_objeto, cantidad_disponible, usa_recipientes, elemento_movible, recipientes_disponibles, created_at, updated_at) FROM stdin;
AL01	EA1	M1	\N	1	21	10.00	f	t	\N	2016-03-22 03:10:54	2016-03-22 03:10:54
AL01	ES1	AC2	\N	1	19	100.00	f	t	\N	2016-03-22 03:11:17	2016-03-22 03:11:17
AL01	EA1	AC2	\N	2	2	10.00	f	t	\N	2016-03-22 03:11:37	2016-03-22 03:11:37
AL01	ES1	AC2	\N	10	14	100.00	f	t	\N	2016-03-22 03:12:32	2016-03-22 03:12:32
AL01	F56	CP1	CX1	10	43	12.00	f	t	\N	2016-03-22 03:38:22	2016-03-22 03:38:22
AL02	E5	CE1	R1	10	41	1506.00	f	t	\N	2016-03-22 03:38:50	2016-03-22 03:38:50
AL03	F56	CP1	CX1	10	44	1.00	f	t	\N	2016-03-22 03:39:40	2016-03-22 03:39:40
AL02	E5	CE1	\N	8	42	100.00	f	t	\N	2016-03-22 03:40:10	2016-03-22 03:40:10
\.


--
-- Data for Name: laboratorios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY laboratorios (codigo, nombre, descripcion, secuencia, created_at, updated_at) FROM stdin;
LA01	laboratorio de procesos quimicos	en este laboratorio se realizan pruebas	1	2016-03-22 04:13:29	2016-03-22 04:13:29
\.


--
-- Name: laboratorios_secuencia_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('laboratorios_secuencia_seq', 1, true);


--
-- Data for Name: mensajes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY mensajes (id, mensaje, created_at, updated_at) FROM stdin;
\.


--
-- Name: mensajes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('mensajes_id_seq', 1, false);


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY migrations (migration, batch) FROM stdin;
2015_11_22_052201_crear_tabla_almacenes	1
2015_11_26_002820_crear_tabla_personas	1
2015_11_26_003319_crear_tabla_usuarios	1
2015_12_01_173140_crear_tabla_sexos	1
2015_12_01_173343_crear_tabla_permisos	1
2015_12_01_173532_crear_tabla_permisos_usuarios	1
2015_12_03_150253_crear_tabla_tipos_usuario	1
2016_01_05_230121_crear_tabla_inventario	1
2016_01_05_230150_crear_tabla_catalogo_objetos	1
2016_02_01_141608_crear_tabla_clase_objetos	1
2016_02_04_142858_crear_tabla_tipos_unidades	1
2016_02_04_143519_crear_tabla_mensajes	1
2016_02_04_143542_crear_tabla_notificaciones	1
2016_02_04_143613_crear_tabla_laboratorios	1
2016_02_04_143638_crear_tabla_objetos_laboratorio	1
2016_02_11_203239_crear_tabla_sub_dimension	1
2016_02_11_220624_crear_tabla_agrupacion	1
2016_02_11_223213_crear_tabla_sub_agrupacion	1
2016_02_22_165901_crear_tabla_proveedores	1
2016_02_24_144245_crear_tabla_estados	1
2016_02_24_144323_crear_tabla_ciudades	1
2016_02_24_144410_crear_tabla_municipios	1
2016_02_24_144433_crear_tabla_parroquias	1
2016_03_03_132300_crear_tabla_entradas_inventario	1
2016_03_03_132401_crear_tabla_salidas_inventario	1
2016_03_03_133502_crear_index_tablas	1
2015_11_22_051746_crear_tabla_unidades	1
2015_11_22_051840_crear_tabla_elementos_quimicos	1
2015_11_22_051912_crear_tabla_estados_materias	1
2015_11_22_052001_crear_tabla_clasificacion_elementos	1
2015_11_22_052132_crear_tabla_sub_clasificacion_elementos	1
\.


--
-- Data for Name: municipios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY municipios (id_municipio, id_estado, municipio) FROM stdin;
1	1	Alto Orinoco
2	1	Atabapo
3	1	Atures
4	1	Autana
5	1	Manapiare
6	1	Maroa
7	1	Río Negro
8	2	Anaco
9	2	Aragua
10	2	Manuel Ezequiel Bruzual
11	2	Diego Bautista Urbaneja
12	2	Fernando Peñalver
13	2	Francisco Del Carmen Carvajal
14	2	General Sir Arthur McGregor
15	2	Guanta
16	2	Independencia
17	2	José Gregorio Monagas
18	2	Juan Antonio Sotillo
19	2	Juan Manuel Cajigal
20	2	Libertad
21	2	Francisco de Miranda
22	2	Pedro María Freites
23	2	Píritu
24	2	San José de Guanipa
25	2	San Juan de Capistrano
26	2	Santa Ana
27	2	Simón Bolívar
28	2	Simón Rodríguez
29	3	Achaguas
30	3	Biruaca
31	3	Muñóz
32	3	Páez
33	3	Pedro Camejo
34	3	Rómulo Gallegos
35	3	San Fernando
36	4	Atanasio Girardot
37	4	Bolívar
38	4	Camatagua
39	4	Francisco Linares Alcántara
40	4	José Ángel Lamas
41	4	José Félix Ribas
42	4	José Rafael Revenga
43	4	Libertador
44	4	Mario Briceño Iragorry
45	4	Ocumare de la Costa de Oro
46	4	San Casimiro
47	4	San Sebastián
48	4	Santiago Mariño
49	4	Santos Michelena
50	4	Sucre
51	4	Tovar
52	4	Urdaneta
53	4	Zamora
54	5	Alberto Arvelo Torrealba
55	5	Andrés Eloy Blanco
56	5	Antonio José de Sucre
57	5	Arismendi
58	5	Barinas
59	5	Bolívar
60	5	Cruz Paredes
61	5	Ezequiel Zamora
62	5	Obispos
63	5	Pedraza
64	5	Rojas
65	5	Sosa
66	6	Caroní
67	6	Cedeño
68	6	El Callao
69	6	Gran Sabana
70	6	Heres
71	6	Piar
72	6	Angostura (Raúl Leoni)
73	6	Roscio
74	6	Sifontes
75	6	Sucre
76	6	Padre Pedro Chien
77	7	Bejuma
78	7	Carlos Arvelo
79	7	Diego Ibarra
80	7	Guacara
81	7	Juan José Mora
82	7	Libertador
83	7	Los Guayos
84	7	Miranda
85	7	Montalbán
86	7	Naguanagua
87	7	Puerto Cabello
88	7	San Diego
89	7	San Joaquín
90	7	Valencia
91	8	Anzoátegui
92	8	Tinaquillo
93	8	Girardot
94	8	Lima Blanco
95	8	Pao de San Juan Bautista
96	8	Ricaurte
97	8	Rómulo Gallegos
98	8	San Carlos
99	8	Tinaco
100	9	Antonio Díaz
101	9	Casacoima
102	9	Pedernales
103	9	Tucupita
104	10	Acosta
105	10	Bolívar
106	10	Buchivacoa
107	10	Cacique Manaure
108	10	Carirubana
109	10	Colina
110	10	Dabajuro
111	10	Democracia
112	10	Falcón
113	10	Federación
114	10	Jacura
115	10	José Laurencio Silva
116	10	Los Taques
117	10	Mauroa
118	10	Miranda
119	10	Monseñor Iturriza
120	10	Palmasola
121	10	Petit
122	10	Píritu
123	10	San Francisco
124	10	Sucre
125	10	Tocópero
126	10	Unión
127	10	Urumaco
128	10	Zamora
129	11	Camaguán
130	11	Chaguaramas
131	11	El Socorro
132	11	José Félix Ribas
133	11	José Tadeo Monagas
134	11	Juan Germán Roscio
135	11	Julián Mellado
136	11	Las Mercedes
137	11	Leonardo Infante
138	11	Pedro Zaraza
139	11	Ortíz
140	11	San Gerónimo de Guayabal
141	11	San José de Guaribe
142	11	Santa María de Ipire
143	11	Sebastián Francisco de Miranda
144	12	Andrés Eloy Blanco
145	12	Crespo
146	12	Iribarren
147	12	Jiménez
148	12	Morán
149	12	Palavecino
150	12	Simón Planas
151	12	Torres
152	12	Urdaneta
179	13	Alberto Adriani
180	13	Andrés Bello
181	13	Antonio Pinto Salinas
182	13	Aricagua
183	13	Arzobispo Chacón
184	13	Campo Elías
185	13	Caracciolo Parra Olmedo
186	13	Cardenal Quintero
187	13	Guaraque
188	13	Julio César Salas
189	13	Justo Briceño
190	13	Libertador
191	13	Miranda
192	13	Obispo Ramos de Lora
193	13	Padre Noguera
194	13	Pueblo Llano
195	13	Rangel
196	13	Rivas Dávila
197	13	Santos Marquina
198	13	Sucre
199	13	Tovar
200	13	Tulio Febres Cordero
201	13	Zea
223	14	Acevedo
224	14	Andrés Bello
225	14	Baruta
226	14	Brión
227	14	Buroz
228	14	Carrizal
229	14	Chacao
230	14	Cristóbal Rojas
231	14	El Hatillo
232	14	Guaicaipuro
233	14	Independencia
234	14	Lander
235	14	Los Salias
236	14	Páez
237	14	Paz Castillo
238	14	Pedro Gual
239	14	Plaza
240	14	Simón Bolívar
241	14	Sucre
242	14	Urdaneta
243	14	Zamora
258	15	Acosta
259	15	Aguasay
260	15	Bolívar
261	15	Caripe
262	15	Cedeño
263	15	Ezequiel Zamora
264	15	Libertador
265	15	Maturín
266	15	Piar
267	15	Punceres
268	15	Santa Bárbara
269	15	Sotillo
270	15	Uracoa
271	16	Antolín del Campo
272	16	Arismendi
273	16	García
274	16	Gómez
275	16	Maneiro
276	16	Marcano
277	16	Mariño
278	16	Península de Macanao
279	16	Tubores
280	16	Villalba
281	16	Díaz
282	17	Agua Blanca
283	17	Araure
284	17	Esteller
285	17	Guanare
286	17	Guanarito
287	17	Monseñor José Vicente de Unda
288	17	Ospino
289	17	Páez
290	17	Papelón
291	17	San Genaro de Boconoíto
292	17	San Rafael de Onoto
293	17	Santa Rosalía
294	17	Sucre
295	17	Turén
296	18	Andrés Eloy Blanco
297	18	Andrés Mata
298	18	Arismendi
299	18	Benítez
300	18	Bermúdez
301	18	Bolívar
302	18	Cajigal
303	18	Cruz Salmerón Acosta
304	18	Libertador
305	18	Mariño
306	18	Mejía
307	18	Montes
308	18	Ribero
309	18	Sucre
310	18	Valdéz
341	19	Andrés Bello
342	19	Antonio Rómulo Costa
343	19	Ayacucho
344	19	Bolívar
345	19	Cárdenas
346	19	Córdoba
347	19	Fernández Feo
348	19	Francisco de Miranda
349	19	García de Hevia
350	19	Guásimos
351	19	Independencia
352	19	Jáuregui
353	19	José María Vargas
354	19	Junín
355	19	Libertad
356	19	Libertador
357	19	Lobatera
358	19	Michelena
359	19	Panamericano
360	19	Pedro María Ureña
361	19	Rafael Urdaneta
362	19	Samuel Darío Maldonado
363	19	San Cristóbal
364	19	Seboruco
365	19	Simón Rodríguez
366	19	Sucre
367	19	Torbes
368	19	Uribante
369	19	San Judas Tadeo
370	20	Andrés Bello
371	20	Boconó
372	20	Bolívar
373	20	Candelaria
374	20	Carache
375	20	Escuque
376	20	José Felipe Márquez Cañizalez
377	20	Juan Vicente Campos Elías
378	20	La Ceiba
379	20	Miranda
380	20	Monte Carmelo
381	20	Motatán
382	20	Pampán
383	20	Pampanito
384	20	Rafael Rangel
385	20	San Rafael de Carvajal
386	20	Sucre
387	20	Trujillo
388	20	Urdaneta
389	20	Valera
390	21	Vargas
391	22	Arístides Bastidas
392	22	Bolívar
407	22	Bruzual
408	22	Cocorote
409	22	Independencia
410	22	José Antonio Páez
411	22	La Trinidad
412	22	Manuel Monge
413	22	Nirgua
414	22	Peña
415	22	San Felipe
416	22	Sucre
417	22	Urachiche
418	22	José Joaquín Veroes
441	23	Almirante Padilla
442	23	Baralt
443	23	Cabimas
444	23	Catatumbo
445	23	Colón
446	23	Francisco Javier Pulgar
447	23	Páez
448	23	Jesús Enrique Losada
449	23	Jesús María Semprún
450	23	La Cañada de Urdaneta
451	23	Lagunillas
452	23	Machiques de Perijá
453	23	Mara
454	23	Maracaibo
455	23	Miranda
456	23	Rosario de Perijá
457	23	San Francisco
458	23	Santa Rita
459	23	Simón Bolívar
460	23	Sucre
461	23	Valmore Rodríguez
462	24	Libertador
\.


--
-- Name: municipios_id_municipio_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('municipios_id_municipio_seq', 1, false);


--
-- Data for Name: notificaciones; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY notificaciones (id, mensaje_id, fecha, hora, emisor, receptor, visto, created_at, updated_at) FROM stdin;
\.


--
-- Name: notificaciones_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('notificaciones_id_seq', 1, false);


--
-- Data for Name: objetos_laboratorio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY objetos_laboratorio (id, cod_laboratorio, cod_objeto, created_at, updated_at) FROM stdin;
\.


--
-- Name: objetos_laboratorio_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('objetos_laboratorio_id_seq', 1, false);


--
-- Data for Name: parroquias; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY parroquias (id_parroquia, id_municipio, parroquia) FROM stdin;
1	1	Alto Orinoco
2	1	Huachamacare Acanaña
3	1	Marawaka Toky Shamanaña
4	1	Mavaka Mavaka
5	1	Sierra Parima Parimabé
6	2	Ucata Laja Lisa
7	2	Yapacana Macuruco
8	2	Caname Guarinuma
9	3	Fernando Girón Tovar
10	3	Luis Alberto Gómez
11	3	Pahueña Limón de Parhueña
12	3	Platanillal Platanillal
13	4	Samariapo
14	4	Sipapo
15	4	Munduapo
16	4	Guayapo
17	5	Alto Ventuari
18	5	Medio Ventuari
19	5	Bajo Ventuari
20	6	Victorino
21	6	Comunidad
22	7	Casiquiare
23	7	Cocuy
24	7	San Carlos de Río Negro
25	7	Solano
26	8	Anaco
27	8	San Joaquín
28	9	Cachipo
29	9	Aragua de Barcelona
30	11	Lechería
31	11	El Morro
32	12	Puerto Píritu
33	12	San Miguel
34	12	Sucre
35	13	Valle de Guanape
36	13	Santa Bárbara
37	14	El Chaparro
38	14	Tomás Alfaro
39	14	Calatrava
40	15	Guanta
41	15	Chorrerón
42	16	Mamo
43	16	Soledad
44	17	Mapire
45	17	Piar
46	17	Santa Clara
47	17	San Diego de Cabrutica
48	17	Uverito
49	17	Zuata
50	18	Puerto La Cruz
51	18	Pozuelos
52	19	Onoto
53	19	San Pablo
54	20	San Mateo
55	20	El Carito
56	20	Santa Inés
57	20	La Romereña
58	21	Atapirire
59	21	Boca del Pao
60	21	El Pao
61	21	Pariaguán
62	22	Cantaura
63	22	Libertador
64	22	Santa Rosa
65	22	Urica
66	23	Píritu
67	23	San Francisco
68	24	San José de Guanipa
69	25	Boca de Uchire
70	25	Boca de Chávez
71	26	Pueblo Nuevo
72	26	Santa Ana
73	27	Bergatín
74	27	Caigua
75	27	El Carmen
76	27	El Pilar
77	27	Naricual
78	27	San Crsitóbal
79	28	Edmundo Barrios
80	28	Miguel Otero Silva
81	29	Achaguas
82	29	Apurito
83	29	El Yagual
84	29	Guachara
85	29	Mucuritas
86	29	Queseras del medio
87	30	Biruaca
88	31	Bruzual
89	31	Mantecal
90	31	Quintero
91	31	Rincón Hondo
92	31	San Vicente
93	32	Guasdualito
94	32	Aramendi
95	32	El Amparo
96	32	San Camilo
97	32	Urdaneta
98	33	San Juan de Payara
99	33	Codazzi
100	33	Cunaviche
101	34	Elorza
102	34	La Trinidad
103	35	San Fernando
104	35	El Recreo
105	35	Peñalver
106	35	San Rafael de Atamaica
107	36	Pedro José Ovalles
108	36	Joaquín Crespo
109	36	José Casanova Godoy
110	36	Madre María de San José
111	36	Andrés Eloy Blanco
112	36	Los Tacarigua
113	36	Las Delicias
114	36	Choroní
115	37	Bolívar
116	38	Camatagua
117	38	Carmen de Cura
118	39	Santa Rita
119	39	Francisco de Miranda
120	39	Moseñor Feliciano González
121	40	Santa Cruz
122	41	José Félix Ribas
123	41	Castor Nieves Ríos
124	41	Las Guacamayas
125	41	Pao de Zárate
126	41	Zuata
127	42	José Rafael Revenga
128	43	Palo Negro
129	43	San Martín de Porres
130	44	El Limón
131	44	Caña de Azúcar
132	45	Ocumare de la Costa
133	46	San Casimiro
134	46	Güiripa
135	46	Ollas de Caramacate
136	46	Valle Morín
137	47	San Sebastían
138	48	Turmero
139	48	Arevalo Aponte
140	48	Chuao
141	48	Samán de Güere
142	48	Alfredo Pacheco Miranda
143	49	Santos Michelena
144	49	Tiara
145	50	Cagua
146	50	Bella Vista
147	51	Tovar
148	52	Urdaneta
149	52	Las Peñitas
150	52	San Francisco de Cara
151	52	Taguay
152	53	Zamora
153	53	Magdaleno
154	53	San Francisco de Asís
155	53	Valles de Tucutunemo
156	53	Augusto Mijares
157	54	Sabaneta
158	54	Juan Antonio Rodríguez Domínguez
159	55	El Cantón
160	55	Santa Cruz de Guacas
161	55	Puerto Vivas
162	56	Ticoporo
163	56	Nicolás Pulido
164	56	Andrés Bello
165	57	Arismendi
166	57	Guadarrama
167	57	La Unión
168	57	San Antonio
169	58	Barinas
170	58	Alberto Arvelo Larriva
171	58	San Silvestre
172	58	Santa Inés
173	58	Santa Lucía
174	58	Torumos
175	58	El Carmen
176	58	Rómulo Betancourt
177	58	Corazón de Jesús
178	58	Ramón Ignacio Méndez
179	58	Alto Barinas
180	58	Manuel Palacio Fajardo
181	58	Juan Antonio Rodríguez Domínguez
182	58	Dominga Ortiz de Páez
183	59	Barinitas
184	59	Altamira de Cáceres
185	59	Calderas
186	60	Barrancas
187	60	El Socorro
188	60	Mazparrito
189	61	Santa Bárbara
190	61	Pedro Briceño Méndez
191	61	Ramón Ignacio Méndez
192	61	José Ignacio del Pumar
193	62	Obispos
194	62	Guasimitos
195	62	El Real
196	62	La Luz
197	63	Ciudad Bolívia
198	63	José Ignacio Briceño
199	63	José Félix Ribas
200	63	Páez
201	64	Libertad
202	64	Dolores
203	64	Santa Rosa
204	64	Palacio Fajardo
205	65	Ciudad de Nutrias
206	65	El Regalo
207	65	Puerto Nutrias
208	65	Santa Catalina
209	66	Cachamay
210	66	Chirica
211	66	Dalla Costa
212	66	Once de Abril
213	66	Simón Bolívar
214	66	Unare
215	66	Universidad
216	66	Vista al Sol
217	66	Pozo Verde
218	66	Yocoima
219	66	5 de Julio
220	67	Cedeño
221	67	Altagracia
222	67	Ascensión Farreras
223	67	Guaniamo
224	67	La Urbana
225	67	Pijiguaos
226	68	El Callao
227	69	Gran Sabana
228	69	Ikabarú
229	70	Catedral
230	70	Zea
231	70	Orinoco
232	70	José Antonio Páez
233	70	Marhuanta
234	70	Agua Salada
235	70	Vista Hermosa
236	70	La Sabanita
237	70	Panapana
238	71	Andrés Eloy Blanco
239	71	Pedro Cova
240	72	Raúl Leoni
241	72	Barceloneta
242	72	Santa Bárbara
243	72	San Francisco
244	73	Roscio
245	73	Salóm
246	74	Sifontes
247	74	Dalla Costa
248	74	San Isidro
249	75	Sucre
250	75	Aripao
251	75	Guarataro
252	75	Las Majadas
253	75	Moitaco
254	76	Padre Pedro Chien
255	76	Río Grande
256	77	Bejuma
257	77	Canoabo
258	77	Simón Bolívar
259	78	Güigüe
260	78	Carabobo
261	78	Tacarigua
262	79	Mariara
263	79	Aguas Calientes
264	80	Ciudad Alianza
265	80	Guacara
266	80	Yagua
267	81	Morón
268	81	Yagua
269	82	Tocuyito
270	82	Independencia
271	83	Los Guayos
272	84	Miranda
273	85	Montalbán
274	86	Naguanagua
275	87	Bartolomé Salóm
276	87	Democracia
277	87	Fraternidad
278	87	Goaigoaza
279	87	Juan José Flores
280	87	Unión
281	87	Borburata
282	87	Patanemo
283	88	San Diego
284	89	San Joaquín
285	90	Candelaria
286	90	Catedral
287	90	El Socorro
288	90	Miguel Peña
289	90	Rafael Urdaneta
290	90	San Blas
291	90	San José
292	90	Santa Rosa
293	90	Negro Primero
294	91	Cojedes
295	91	Juan de Mata Suárez
296	92	Tinaquillo
297	93	El Baúl
298	93	Sucre
299	94	La Aguadita
300	94	Macapo
301	95	El Pao
302	96	El Amparo
303	96	Libertad de Cojedes
304	97	Rómulo Gallegos
305	98	San Carlos de Austria
306	98	Juan Ángel Bravo
307	98	Manuel Manrique
308	99	General en Jefe José Laurencio Silva
309	100	Curiapo
310	100	Almirante Luis Brión
311	100	Francisco Aniceto Lugo
312	100	Manuel Renaud
313	100	Padre Barral
314	100	Santos de Abelgas
315	101	Imataca
316	101	Cinco de Julio
317	101	Juan Bautista Arismendi
318	101	Manuel Piar
319	101	Rómulo Gallegos
320	102	Pedernales
321	102	Luis Beltrán Prieto Figueroa
322	103	San José (Delta Amacuro)
323	103	José Vidal Marcano
324	103	Juan Millán
325	103	Leonardo Ruíz Pineda
326	103	Mariscal Antonio José de Sucre
327	103	Monseñor Argimiro García
328	103	San Rafael (Delta Amacuro)
329	103	Virgen del Valle
330	10	Clarines
331	10	Guanape
332	10	Sabana de Uchire
333	104	Capadare
334	104	La Pastora
335	104	Libertador
336	104	San Juan de los Cayos
337	105	Aracua
338	105	La Peña
339	105	San Luis
340	106	Bariro
341	106	Borojó
342	106	Capatárida
343	106	Guajiro
344	106	Seque
345	106	Zazárida
346	106	Valle de Eroa
347	107	Cacique Manaure
348	108	Norte
349	108	Carirubana
350	108	Santa Ana
351	108	Urbana Punta Cardón
352	109	La Vela de Coro
353	109	Acurigua
354	109	Guaibacoa
355	109	Las Calderas
356	109	Macoruca
357	110	Dabajuro
358	111	Agua Clara
359	111	Avaria
360	111	Pedregal
361	111	Piedra Grande
362	111	Purureche
363	112	Adaure
364	112	Adícora
365	112	Baraived
366	112	Buena Vista
367	112	Jadacaquiva
368	112	El Vínculo
369	112	El Hato
370	112	Moruy
371	112	Pueblo Nuevo
372	113	Agua Larga
373	113	El Paují
374	113	Independencia
375	113	Mapararí
376	114	Agua Linda
377	114	Araurima
378	114	Jacura
379	115	Tucacas
380	115	Boca de Aroa
381	116	Los Taques
382	116	Judibana
383	117	Mene de Mauroa
384	117	San Félix
385	117	Casigua
386	118	Guzmán Guillermo
387	118	Mitare
388	118	Río Seco
389	118	Sabaneta
390	118	San Antonio
391	118	San Gabriel
392	118	Santa Ana
393	119	Boca del Tocuyo
394	119	Chichiriviche
395	119	Tocuyo de la Costa
396	120	Palmasola
397	121	Cabure
398	121	Colina
399	121	Curimagua
400	122	San José de la Costa
401	122	Píritu
402	123	San Francisco
403	124	Sucre
404	124	Pecaya
405	125	Tocópero
406	126	El Charal
407	126	Las Vegas del Tuy
408	126	Santa Cruz de Bucaral
409	127	Bruzual
410	127	Urumaco
411	128	Puerto Cumarebo
412	128	La Ciénaga
413	128	La Soledad
414	128	Pueblo Cumarebo
415	128	Zazárida
416	113	Churuguara
417	129	Camaguán
418	129	Puerto Miranda
419	129	Uverito
420	130	Chaguaramas
421	131	El Socorro
422	132	Tucupido
423	132	San Rafael de Laya
424	133	Altagracia de Orituco
425	133	San Rafael de Orituco
426	133	San Francisco Javier de Lezama
427	133	Paso Real de Macaira
428	133	Carlos Soublette
429	133	San Francisco de Macaira
430	133	Libertad de Orituco
431	134	Cantaclaro
432	134	San Juan de los Morros
433	134	Parapara
434	135	El Sombrero
435	135	Sosa
436	136	Las Mercedes
437	136	Cabruta
438	136	Santa Rita de Manapire
439	137	Valle de la Pascua
440	137	Espino
441	138	San José de Unare
442	138	Zaraza
443	139	San José de Tiznados
444	139	San Francisco de Tiznados
445	139	San Lorenzo de Tiznados
446	139	Ortiz
447	140	Guayabal
448	140	Cazorla
449	141	San José de Guaribe
450	141	Uveral
451	142	Santa María de Ipire
452	142	Altamira
453	143	El Calvario
454	143	El Rastro
455	143	Guardatinajas
456	143	Capital Urbana Calabozo
457	144	Quebrada Honda de Guache
458	144	Pío Tamayo
459	144	Yacambú
460	145	Fréitez
461	145	José María Blanco
462	146	Catedral
463	146	Concepción
464	146	El Cují
465	146	Juan de Villegas
466	146	Santa Rosa
467	146	Tamaca
468	146	Unión
469	146	Aguedo Felipe Alvarado
470	146	Buena Vista
471	146	Juárez
472	147	Juan Bautista Rodríguez
473	147	Cuara
474	147	Diego de Lozada
475	147	Paraíso de San José
476	147	San Miguel
477	147	Tintorero
478	147	José Bernardo Dorante
479	147	Coronel Mariano Peraza 
480	148	Bolívar
481	148	Anzoátegui
482	148	Guarico
483	148	Hilario Luna y Luna
484	148	Humocaro Alto
485	148	Humocaro Bajo
486	148	La Candelaria
487	148	Morán
488	149	Cabudare
489	149	José Gregorio Bastidas
490	149	Agua Viva
491	150	Sarare
492	150	Buría
493	150	Gustavo Vegas León
494	151	Trinidad Samuel
495	151	Antonio Díaz
496	151	Camacaro
497	151	Castañeda
498	151	Cecilio Zubillaga
499	151	Chiquinquirá
500	151	El Blanco
501	151	Espinoza de los Monteros
502	151	Lara
503	151	Las Mercedes
504	151	Manuel Morillo
505	151	Montaña Verde
506	151	Montes de Oca
507	151	Torres
508	151	Heriberto Arroyo
509	151	Reyes Vargas
510	151	Altagracia
511	152	Siquisique
512	152	Moroturo
513	152	San Miguel
514	152	Xaguas
515	179	Presidente Betancourt
516	179	Presidente Páez
517	179	Presidente Rómulo Gallegos
518	179	Gabriel Picón González
519	179	Héctor Amable Mora
520	179	José Nucete Sardi
521	179	Pulido Méndez
522	180	La Azulita
523	181	Santa Cruz de Mora
524	181	Mesa Bolívar
525	181	Mesa de Las Palmas
526	182	Aricagua
527	182	San Antonio
528	183	Canagua
529	183	Capurí
530	183	Chacantá
531	183	El Molino
532	183	Guaimaral
533	183	Mucutuy
534	183	Mucuchachí
535	184	Fernández Peña
536	184	Matriz
537	184	Montalbán
538	184	Acequias
539	184	Jají
540	184	La Mesa
541	184	San José del Sur
542	185	Tucaní
543	185	Florencio Ramírez
544	186	Santo Domingo
545	186	Las Piedras
546	187	Guaraque
547	187	Mesa de Quintero
548	187	Río Negro
549	188	Arapuey
550	188	Palmira
551	189	San Cristóbal de Torondoy
552	189	Torondoy
553	190	Antonio Spinetti Dini
554	190	Arias
555	190	Caracciolo Parra Pérez
556	190	Domingo Peña
557	190	El Llano
558	190	Gonzalo Picón Febres
559	190	Jacinto Plaza
560	190	Juan Rodríguez Suárez
561	190	Lasso de la Vega
562	190	Mariano Picón Salas
563	190	Milla
564	190	Osuna Rodríguez
565	190	Sagrario
566	190	El Morro
567	190	Los Nevados
568	191	Andrés Eloy Blanco
569	191	La Venta
570	191	Piñango
571	191	Timotes
572	192	Eloy Paredes
573	192	San Rafael de Alcázar
574	192	Santa Elena de Arenales
575	193	Santa María de Caparo
576	194	Pueblo Llano
577	195	Cacute
578	195	La Toma
579	195	Mucuchíes
580	195	Mucurubá
581	195	San Rafael
582	196	Gerónimo Maldonado
583	196	Bailadores
584	197	Tabay
585	198	Chiguará
586	198	Estánquez
587	198	Lagunillas
588	198	La Trampa
589	198	Pueblo Nuevo del Sur
590	198	San Juan
591	199	El Amparo
592	199	El Llano
593	199	San Francisco
594	199	Tovar
595	200	Independencia
596	200	María de la Concepción Palacios Blanco
597	200	Nueva Bolivia
598	200	Santa Apolonia
599	201	Caño El Tigre
600	201	Zea
601	223	Aragüita
602	223	Arévalo González
603	223	Capaya
604	223	Caucagua
605	223	Panaquire
606	223	Ribas
607	223	El Café
608	223	Marizapa
609	224	Cumbo
610	224	San José de Barlovento
611	225	El Cafetal
612	225	Las Minas
613	225	Nuestra Señora del Rosario
614	226	Higuerote
615	226	Curiepe
616	226	Tacarigua de Brión
617	227	Mamporal
618	228	Carrizal
619	229	Chacao
620	230	Charallave
621	230	Las Brisas
622	231	El Hatillo
623	232	Altagracia de la Montaña
624	232	Cecilio Acosta
625	232	Los Teques
626	232	El Jarillo
627	232	San Pedro
628	232	Tácata
629	232	Paracotos
630	233	Cartanal
631	233	Santa Teresa del Tuy
632	234	La Democracia
633	234	Ocumare del Tuy
634	234	Santa Bárbara
635	235	San Antonio de los Altos
636	236	Río Chico
637	236	El Guapo
638	236	Tacarigua de la Laguna
639	236	Paparo
640	236	San Fernando del Guapo
641	237	Santa Lucía del Tuy
642	238	Cúpira
643	238	Machurucuto
644	239	Guarenas
645	240	San Antonio de Yare
646	240	San Francisco de Yare
647	241	Leoncio Martínez
648	241	Petare
649	241	Caucagüita
650	241	Filas de Mariche
651	241	La Dolorita
652	242	Cúa
653	242	Nueva Cúa
654	243	Guatire
655	243	Bolívar
656	258	San Antonio de Maturín
657	258	San Francisco de Maturín
658	259	Aguasay
659	260	Caripito
660	261	El Guácharo
661	261	La Guanota
662	261	Sabana de Piedra
663	261	San Agustín
664	261	Teresen
665	261	Caripe
666	262	Areo
667	262	Capital Cedeño
668	262	San Félix de Cantalicio
669	262	Viento Fresco
670	263	El Tejero
671	263	Punta de Mata
672	264	Chaguaramas
673	264	Las Alhuacas
674	264	Tabasca
675	264	Temblador
676	265	Alto de los Godos
677	265	Boquerón
678	265	Las Cocuizas
679	265	La Cruz
680	265	San Simón
681	265	El Corozo
682	265	El Furrial
683	265	Jusepín
684	265	La Pica
685	265	San Vicente
686	266	Aparicio
687	266	Aragua de Maturín
688	266	Chaguamal
689	266	El Pinto
690	266	Guanaguana
691	266	La Toscana
692	266	Taguaya
693	267	Cachipo
694	267	Quiriquire
695	268	Santa Bárbara
696	269	Barrancas
697	269	Los Barrancos de Fajardo
698	270	Uracoa
699	271	Antolín del Campo
700	272	Arismendi
701	273	García
702	273	Francisco Fajardo
703	274	Bolívar
704	274	Guevara
705	274	Matasiete
706	274	Santa Ana
707	274	Sucre
708	275	Aguirre
709	275	Maneiro
710	276	Adrián
711	276	Juan Griego
712	276	Yaguaraparo
713	277	Porlamar
714	278	San Francisco de Macanao
715	278	Boca de Río
716	279	Tubores
717	279	Los Baleales
718	280	Vicente Fuentes
719	280	Villalba
720	281	San Juan Bautista
721	281	Zabala
722	283	Capital Araure
723	283	Río Acarigua
724	284	Capital Esteller
725	284	Uveral
726	285	Guanare
727	285	Córdoba
728	285	San José de la Montaña
729	285	San Juan de Guanaguanare
730	285	Virgen de la Coromoto
731	286	Guanarito
732	286	Trinidad de la Capilla
733	286	Divina Pastora
734	287	Monseñor José Vicente de Unda
735	287	Peña Blanca
736	288	Capital Ospino
737	288	Aparición
738	288	La Estación
739	289	Páez
740	289	Payara
741	289	Pimpinela
742	289	Ramón Peraza
743	290	Papelón
744	290	Caño Delgadito
745	291	San Genaro de Boconoito
746	291	Antolín Tovar
747	292	San Rafael de Onoto
748	292	Santa Fe
749	292	Thermo Morles
750	293	Santa Rosalía
751	293	Florida
752	294	Sucre
753	294	Concepción
754	294	San Rafael de Palo Alzado
755	294	Uvencio Antonio Velásquez
756	294	San José de Saguaz
757	294	Villa Rosa
758	295	Turén
759	295	Canelones
760	295	Santa Cruz
761	295	San Isidro Labrador
762	296	Mariño
763	296	Rómulo Gallegos
764	297	San José de Aerocuar
765	297	Tavera Acosta
766	298	Río Caribe
767	298	Antonio José de Sucre
768	298	El Morro de Puerto Santo
769	298	Puerto Santo
770	298	San Juan de las Galdonas
771	299	El Pilar
772	299	El Rincón
773	299	General Francisco Antonio Váquez
774	299	Guaraúnos
775	299	Tunapuicito
776	299	Unión
777	300	Santa Catalina
778	300	Santa Rosa
779	300	Santa Teresa
780	300	Bolívar
781	300	Maracapana
782	302	Libertad
783	302	El Paujil
784	302	Yaguaraparo
785	303	Cruz Salmerón Acosta
786	303	Chacopata
787	303	Manicuare
788	304	Tunapuy
789	304	Campo Elías
790	305	Irapa
791	305	Campo Claro
792	305	Maraval
793	305	San Antonio de Irapa
794	305	Soro
795	306	Mejía
796	307	Cumanacoa
797	307	Arenas
798	307	Aricagua
799	307	Cogollar
800	307	San Fernando
801	307	San Lorenzo
802	308	Villa Frontado (Muelle de Cariaco)
803	308	Catuaro
804	308	Rendón
805	308	San Cruz
806	308	Santa María
807	309	Altagracia
808	309	Santa Inés
809	309	Valentín Valiente
810	309	Ayacucho
811	309	San Juan
812	309	Raúl Leoni
813	309	Gran Mariscal
814	310	Cristóbal Colón
815	310	Bideau
816	310	Punta de Piedras
817	310	Güiria
818	341	Andrés Bello
819	342	Antonio Rómulo Costa
820	343	Ayacucho
821	343	Rivas Berti
822	343	San Pedro del Río
823	344	Bolívar
824	344	Palotal
825	344	General Juan Vicente Gómez
826	344	Isaías Medina Angarita
827	345	Cárdenas
828	345	Amenodoro Ángel Lamus
829	345	La Florida
830	346	Córdoba
831	347	Fernández Feo
832	347	Alberto Adriani
833	347	Santo Domingo
834	348	Francisco de Miranda
835	349	García de Hevia
836	349	Boca de Grita
837	349	José Antonio Páez
838	350	Guásimos
839	351	Independencia
840	351	Juan Germán Roscio
841	351	Román Cárdenas
842	352	Jáuregui
843	352	Emilio Constantino Guerrero
844	352	Monseñor Miguel Antonio Salas
845	353	José María Vargas
846	354	Junín
847	354	La Petrólea
848	354	Quinimarí
849	354	Bramón
850	355	Libertad
851	355	Cipriano Castro
852	355	Manuel Felipe Rugeles
853	356	Libertador
854	356	Doradas
855	356	Emeterio Ochoa
856	356	San Joaquín de Navay
857	357	Lobatera
858	357	Constitución
859	358	Michelena
860	359	Panamericano
861	359	La Palmita
862	360	Pedro María Ureña
863	360	Nueva Arcadia
864	361	Delicias
865	361	Pecaya
866	362	Samuel Darío Maldonado
867	362	Boconó
868	362	Hernández
869	363	La Concordia
870	363	San Juan Bautista
871	363	Pedro María Morantes
872	363	San Sebastián
873	363	Dr. Francisco Romero Lobo
874	364	Seboruco
875	365	Simón Rodríguez
876	366	Sucre
877	366	Eleazar López Contreras
878	366	San Pablo
879	367	Torbes
880	368	Uribante
881	368	Cárdenas
882	368	Juan Pablo Peñalosa
883	368	Potosí
884	369	San Judas Tadeo
885	370	Araguaney
886	370	El Jaguito
887	370	La Esperanza
888	370	Santa Isabel
889	371	Boconó
890	371	El Carmen
891	371	Mosquey
892	371	Ayacucho
893	371	Burbusay
894	371	General Ribas
895	371	Guaramacal
896	371	Vega de Guaramacal
897	371	Monseñor Jáuregui
898	371	Rafael Rangel
899	371	San Miguel
900	371	San José
901	372	Sabana Grande
902	372	Cheregüé
903	372	Granados
904	373	Arnoldo Gabaldón
905	373	Bolivia
906	373	Carrillo
907	373	Cegarra
908	373	Chejendé
909	373	Manuel Salvador Ulloa
910	373	San José
911	374	Carache
912	374	La Concepción
913	374	Cuicas
914	374	Panamericana
915	374	Santa Cruz
916	375	Escuque
917	375	La Unión
918	375	Santa Rita
919	375	Sabana Libre
920	376	El Socorro
921	376	Los Caprichos
922	376	Antonio José de Sucre
923	377	Campo Elías
924	377	Arnoldo Gabaldón
925	378	Santa Apolonia
926	378	El Progreso
927	378	La Ceiba
928	378	Tres de Febrero
929	379	El Dividive
930	379	Agua Santa
931	379	Agua Caliente
932	379	El Cenizo
933	379	Valerita
934	380	Monte Carmelo
935	380	Buena Vista
936	380	Santa María del Horcón
937	381	Motatán
938	381	El Baño
939	381	Jalisco
940	382	Pampán
941	382	Flor de Patria
942	382	La Paz
943	382	Santa Ana
944	383	Pampanito
945	383	La Concepción
946	383	Pampanito II
947	384	Betijoque
948	384	José Gregorio Hernández
949	384	La Pueblita
950	384	Los Cedros
951	385	Carvajal
952	385	Campo Alegre
953	385	Antonio Nicolás Briceño
954	385	José Leonardo Suárez
955	386	Sabana de Mendoza
956	386	Junín
957	386	Valmore Rodríguez
958	386	El Paraíso
959	387	Andrés Linares
960	387	Chiquinquirá
961	387	Cristóbal Mendoza
962	387	Cruz Carrillo
963	387	Matriz
964	387	Monseñor Carrillo
965	387	Tres Esquinas
966	388	Cabimbú
967	388	Jajó
968	388	La Mesa de Esnujaque
969	388	Santiago
970	388	Tuñame
971	388	La Quebrada
972	389	Juan Ignacio Montilla
973	389	La Beatriz
974	389	La Puerta
975	389	Mendoza del Valle de Momboy
976	389	Mercedes Díaz
977	389	San Luis
978	390	Caraballeda
979	390	Carayaca
980	390	Carlos Soublette
981	390	Caruao Chuspa
982	390	Catia La Mar
983	390	El Junko
984	390	La Guaira
985	390	Macuto
986	390	Maiquetía
987	390	Naiguatá
988	390	Urimare
989	391	Arístides Bastidas
990	392	Bolívar
991	407	Chivacoa
992	407	Campo Elías
993	408	Cocorote
994	409	Independencia
995	410	José Antonio Páez
996	411	La Trinidad
997	412	Manuel Monge
998	413	Salóm
999	413	Temerla
1000	413	Nirgua
1001	414	San Andrés
1002	414	Yaritagua
1003	415	San Javier
1004	415	Albarico
1005	415	San Felipe
1006	416	Sucre
1007	417	Urachiche
1008	418	El Guayabo
1009	418	Farriar
1010	441	Isla de Toas
1011	441	Monagas
1012	442	San Timoteo
1013	442	General Urdaneta
1014	442	Libertador
1015	442	Marcelino Briceño
1016	442	Pueblo Nuevo
1017	442	Manuel Guanipa Matos
1018	443	Ambrosio
1019	443	Carmen Herrera
1020	443	La Rosa
1021	443	Germán Ríos Linares
1022	443	San Benito
1023	443	Rómulo Betancourt
1024	443	Jorge Hernández
1025	443	Punta Gorda
1026	443	Arístides Calvani
1027	444	Encontrados
1028	444	Udón Pérez
1029	445	Moralito
1030	445	San Carlos del Zulia
1031	445	Santa Cruz del Zulia
1032	445	Santa Bárbara
1033	445	Urribarrí
1034	446	Carlos Quevedo
1035	446	Francisco Javier Pulgar
1036	446	Simón Rodríguez
1037	446	Guamo-Gavilanes
1038	448	La Concepción
1039	448	San José
1040	448	Mariano Parra León
1041	448	José Ramón Yépez
1042	449	Jesús María Semprún
1043	449	Barí
1044	450	Concepción
1045	450	Andrés Bello
1046	450	Chiquinquirá
1047	450	El Carmelo
1048	450	Potreritos
1049	451	Libertad
1050	451	Alonso de Ojeda
1051	451	Venezuela
1052	451	Eleazar López Contreras
1053	451	Campo Lara
1054	452	Bartolomé de las Casas
1055	452	Libertad
1056	452	Río Negro
1057	452	San José de Perijá
1058	453	San Rafael
1059	453	La Sierrita
1060	453	Las Parcelas
1061	453	Luis de Vicente
1062	453	Monseñor Marcos Sergio Godoy
1063	453	Ricaurte
1064	453	Tamare
1065	454	Antonio Borjas Romero
1066	454	Bolívar
1067	454	Cacique Mara
1068	454	Carracciolo Parra Pérez
1069	454	Cecilio Acosta
1070	454	Cristo de Aranza
1071	454	Coquivacoa
1072	454	Chiquinquirá
1073	454	Francisco Eugenio Bustamante
1074	454	Idelfonzo Vásquez
1075	454	Juana de Ávila
1076	454	Luis Hurtado Higuera
1077	454	Manuel Dagnino
1078	454	Olegario Villalobos
1079	454	Raúl Leoni
1080	454	Santa Lucía
1081	454	Venancio Pulgar
1082	454	San Isidro
1083	455	Altagracia
1084	455	Faría
1085	455	Ana María Campos
1086	455	San Antonio
1087	455	San José
1088	456	Donaldo García
1089	456	El Rosario
1090	456	Sixto Zambrano
1091	457	San Francisco
1092	457	El Bajo
1093	457	Domitila Flores
1094	457	Francisco Ochoa
1095	457	Los Cortijos
1096	457	Marcial Hernández
1097	458	Santa Rita
1098	458	El Mene
1099	458	Pedro Lucas Urribarrí
1100	458	José Cenobio Urribarrí
1101	459	Rafael Maria Baralt
1102	459	Manuel Manrique
1103	459	Rafael Urdaneta
1104	460	Bobures
1105	460	Gibraltar
1106	460	Heras
1107	460	Monseñor Arturo Álvarez
1108	460	Rómulo Gallegos
1109	460	El Batey
1110	461	Rafael Urdaneta
1111	461	La Victoria
1112	461	Raúl Cuenca
1113	447	Sinamaica
1114	447	Alta Guajira
1115	447	Elías Sánchez Rubio
1116	447	Guajira
1117	462	Altagracia
1118	462	Antímano
1119	462	Caricuao
1120	462	Catedral
1121	462	Coche
1122	462	El Junquito
1123	462	El Paraíso
1124	462	El Recreo
1125	462	El Valle
1126	462	La Candelaria
1127	462	La Pastora
1128	462	La Vega
1129	462	Macarao
1130	462	San Agustín
1131	462	San Bernardino
1132	462	San José
1133	462	San Juan
1134	462	San Pedro
1135	462	Santa Rosalía
1136	462	Santa Teresa
1137	462	Sucre (Catia)
1138	462	23 de enero
\.


--
-- Name: parroquias_id_parroquia_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('parroquias_id_parroquia_seq', 1, false);


--
-- Data for Name: permisos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY permisos (codigo, nombre, descripcion, secuencia, created_at, updated_at) FROM stdin;
UL20	lectura	solo consultar todas las opciones	1	\N	\N
UE21	escritura	hacer cambios a ciertas opciones	2	\N	\N
ULE4	lectura	realizar consultas y cambios a ciertas opciones del sistema	3	\N	\N
AD40	ROOT	permisos para leer, escribir, actualizar y eliminar todas las opciones del sistema	4	\N	\N
\.


--
-- Name: permisos_secuencia_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('permisos_secuencia_seq', 4, true);


--
-- Data for Name: permisos_usuarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY permisos_usuarios (id, cod_permiso, usuario_id, created_at, updated_at) FROM stdin;
1	AD40	6	\N	\N
3	AD40	8	\N	\N
4	AD40	7	\N	\N
\.


--
-- Name: permisos_usuarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('permisos_usuarios_id_seq', 4, true);


--
-- Data for Name: personas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY personas (id, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, cedula, sexo_id, usuario_id, fecha_nacimiento, created_at, updated_at) FROM stdin;
1	israel	\N	lugo	\N	24352838	10	6	2016-03-02	2016-03-22 02:58:30	2016-03-22 02:58:30
3	ivan	\N	castillo	\N	25096400	10	8	1994-09-08	2016-03-22 02:59:59	2016-03-22 02:59:59
2	daniels	\N	bonalde	\N	23674783	10	7	1994-04-19	2016-03-22 02:59:18	2016-03-22 03:01:59
\.


--
-- Name: personas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('personas_id_seq', 3, true);


--
-- Data for Name: proveedores; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY proveedores (codigo, razon_social, doc_identificacion, telefono_fijo1, telefono_fijo2, telefono_movil1, telefono_movil2, email, direccion, cod_estado, cod_ciudad, cod_municipio, cod_parroquia, secuencia, created_at, updated_at) FROM stdin;
PRV01	empresa quimica	J8273423	12345678923	\N	12345678923	\N	empresa@gmail.com	alguna direccion	10	158	118	390	1	2016-03-22 04:05:34	2016-03-22 04:05:34
\.


--
-- Name: proveedores_secuencia_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('proveedores_secuencia_seq', 1, true);


--
-- Data for Name: salidas_inventario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY salidas_inventario (id, id_usuario, cod_objeto, cantidad, cod_dimension, cod_subdimension, cod_agrupacion, hora, fecha, observaciones, created_at, updated_at) FROM stdin;
\.


--
-- Name: salidas_inventario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('salidas_inventario_id_seq', 1, false);


--
-- Data for Name: sexos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sexos (id, descripcion) FROM stdin;
10	Masculino
20	Femenino
\.


--
-- Name: sexos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('sexos_id_seq', 1, false);


--
-- Data for Name: sub_agrupaciones; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sub_agrupaciones (codigo, nombre, descripcion, created_at, updated_at) FROM stdin;
R1	color rojo	sub agrupacion color rojo	2016-03-22 03:35:36	2016-03-22 03:35:36
CX1	canaimas	suub agrupacion de caniamas	2016-03-22 03:36:43	2016-03-22 03:36:43
\.


--
-- Data for Name: sub_dimensiones; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sub_dimensiones (codigo, descripcion, created_at, updated_at) FROM stdin;
ES1	Estante de sales	2016-03-22 03:08:58	2016-03-22 03:08:58
EA1	Estante de quimicos	2016-03-22 03:09:17	2016-03-22 03:09:17
E5	Estante de telefonos	2016-03-22 03:33:42	2016-03-22 03:33:42
F56	estante de computadoras	2016-03-22 03:33:53	2016-03-22 03:33:53
\.


--
-- Data for Name: subclasificacion_elementos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY subclasificacion_elementos (cod_clasificacion, cod_subclasificacion, descripcion) FROM stdin;
10	101	Alcalinos
10	102	Alcalinotérreos
10	103	Lantanidos
10	104	Actinidos
10	105	Metales de Transición
10	106	Metales de Bloque P
20	201	Halogenos
20	202	Otros no Metales
20	203	Gases Nobles
40	400	Sin clasificacion
\.


--
-- Data for Name: tipos_unidades; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tipos_unidades (id, nombre) FROM stdin;
1	longitud
2	peso
3	temperatura
4	volumen
5	otros
\.


--
-- Name: tipos_unidades_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tipos_unidades_id_seq', 5, true);


--
-- Data for Name: tipos_usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tipos_usuario (codigo, nombre, descripcion, secuencia, created_at, updated_at) FROM stdin;
TU01	Root	Root	1	\N	\N
TU02	Administrador	Administrador	2	\N	\N
TU03	Profesor	Profesor	3	\N	\N
TU04	Estudiante	Estudiante	4	\N	\N
TU05	Almacenista	Almacenista	5	\N	\N
TU06	Supervisor	Supervisor	6	\N	\N
\.


--
-- Name: tipos_usuario_secuencia_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tipos_usuario_secuencia_seq', 6, true);


--
-- Data for Name: unidades; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY unidades (cod_unidad, nombre, abreviatura, tipo_unidad, created_at, updated_at) FROM stdin;
1	metro	m	1	\N	\N
2	Pulgada	plg	1	\N	\N
3	Pie	ft	1	\N	\N
4	Micro	µ	1	\N	\N
5	Decimetro	dc	1	\N	\N
6	Centimetro	cm	1	\N	\N
7	Milimetro	mm	1	\N	\N
8	Micrometro	µm	1	\N	\N
9	Manometro	nm	1	\N	\N
10	Picometro	pm	1	\N	\N
11	Libra	lb	2	\N	\N
12	Onza	oz	2	\N	\N
13	Decigramo	dg	2	\N	\N
14	Centigrados	cg	2	\N	\N
15	Miligramos	mg	2	\N	\N
16	Microgramos	µg	2	\N	\N
17	Manogramos	ng	2	\N	\N
18	Picogramos	pg	2	\N	\N
19	Decagramos	deg	2	\N	\N
20	Hectogramos	Hg	2	\N	\N
21	Kilogramos	Kg	2	\N	\N
22	Miriagramos	Mig	2	\N	\N
23	Fahreheint	F	3	\N	\N
24	Kelvin	K	3	\N	\N
25	Celsius	C	3	\N	\N
26	Galon	gal	4	\N	\N
27	Pie cubico	pie3	4	\N	\N
28	Decimetros cubicos	dm3	4	\N	\N
29	Centimetros cubicos	cm3	4	\N	\N
30	Milimetros cubicos	mm3	4	\N	\N
31	Micrometros cubicos	µm3	4	\N	\N
32	Manometros cubicos	nm3	4	\N	\N
33	Picometros cubicos	pm3	4	\N	\N
34	Decametros cubicos	dem3	4	\N	\N
35	Hectometros cubicos	Hm3	4	\N	\N
36	Kilometros cubicos	km3	4	\N	\N
37	Miriametros cubicos	Min3	4	\N	\N
38	Decametros	dem	1	\N	\N
39	Hectometros	Hm	1	\N	\N
40	Kilometros	Km	1	\N	\N
41	Miriametros	Min	1	\N	\N
42	Tonelada metrica	t	2	\N	\N
43	Cajas	caj	5	\N	\N
44	Unidad	unid	5	\N	\N
45	Sacos	sac	5	\N	\N
46	gramos	gr	2	2016-03-22 03:19:53	2016-03-22 03:19:53
\.


--
-- Name: unidades_cod_unidad_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('unidades_cod_unidad_seq', 46, true);


--
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY usuarios (id, usuario, email, password, cod_tipo_usuario, imagen, activo, remember_token, created_at, updated_at) FROM stdin;
1	simci	simci@gmail.com	$2y$10$1imucEkMDzdr/8OEtum1z.rHsbY6nBZ7w1WFtJivc25Mj2qDug7Va	TU01	/img/perfil-default.jpg	t	\N	2016-03-22 02:42:43	2016-03-22 02:42:43
2	profesor	profesor@gmail.com	$2y$10$lk9x3rSC9ih8SSD6ZEs2pOolLT2xnxFSK3nq13b0aHSz2D/vyUWHe	TU03	/img/perfil-default.jpg	t	\N	2016-03-22 02:42:44	2016-03-22 02:42:44
3	supervisor	supervisor@gmail.com	$2y$10$b1bdP75zXUIL0p1RS0BwPOy6oaN8lF3WoD.Fd0K.Dv3BXV1c82nYm	TU06	/img/perfil-default.jpg	t	\N	2016-03-22 02:42:44	2016-03-22 02:42:44
4	almacenista	almacenista@gmail.com	$2y$10$zfK/sdS1RL.umQkrA2soMuP6y3/s7Wnx6axVr7rnWNbuN5lIX3eXa	TU05	/img/perfil-default.jpg	t	\N	2016-03-22 02:42:44	2016-03-22 02:42:44
5	estudiante	estudiante@gmail.com	$2y$10$3nXzBSBds13IP2M2hGaD9e1bq34vIg6aE1emr0Zvfb4TRpTenH.iq	TU04	/img/perfil-default.jpg	t	\N	2016-03-22 02:42:44	2016-03-22 02:42:44
6	hostelix	hostelixisrael@gmail.com	$2y$10$qWgM4wo5WcJXwuafmJJzUeIr57cm19tXLkUC.Ccce4b9c6msW4ggO	TU02	/img/perfil-default.jpg	t	\N	2016-03-22 02:58:30	2016-03-22 02:58:30
7	daniels	danztwd@gmail.com	$2y$10$2qtt0Ic.5tAiqY7r1nHeSOzHY8rXL2ZvHTNqUL6Clo04.lzO8fdoO	TU02	/img/perfil-default.jpg	t	\N	2016-03-22 02:59:18	2016-03-22 02:59:18
8	ivantelix	ivantelix@gmail.com	$2y$10$.hPy68lU6eIQmDF.ys6li.2pA0fWnImpeKpPyAopRY6mIHi0Y7Qia	TU02	/img/perfil-default.jpg	t	\N	2016-03-22 02:59:59	2016-03-22 02:59:59
\.


--
-- Name: usuarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('usuarios_id_seq', 8, true);


--
-- Name: agrupaciones_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY agrupaciones
    ADD CONSTRAINT agrupaciones_pkey PRIMARY KEY (codigo);


--
-- Name: almacenes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY almacenes
    ADD CONSTRAINT almacenes_pkey PRIMARY KEY (codigo);


--
-- Name: catalogo_objetos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY catalogo_objetos
    ADD CONSTRAINT catalogo_objetos_pkey PRIMARY KEY (id);


--
-- Name: ciudades_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ciudades
    ADD CONSTRAINT ciudades_pkey PRIMARY KEY (id_ciudad);


--
-- Name: clase_objetos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY clase_objetos
    ADD CONSTRAINT clase_objetos_pkey PRIMARY KEY (id);


--
-- Name: clasificacion_elementos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY clasificacion_elementos
    ADD CONSTRAINT clasificacion_elementos_pkey PRIMARY KEY (cod_clasificacion);


--
-- Name: elementos_quimicos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY elementos_quimicos
    ADD CONSTRAINT elementos_quimicos_pkey PRIMARY KEY (id);


--
-- Name: entradas_inventario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY entradas_inventario
    ADD CONSTRAINT entradas_inventario_pkey PRIMARY KEY (id);


--
-- Name: estados_materia_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY estados_materia
    ADD CONSTRAINT estados_materia_pkey PRIMARY KEY (cod_estado);


--
-- Name: estados_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY estados
    ADD CONSTRAINT estados_pkey PRIMARY KEY (id_estado);


--
-- Name: inventario_cod_dimension_cod_subdimension_cod_agrupacion_cod_ob; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY inventario
    ADD CONSTRAINT inventario_cod_dimension_cod_subdimension_cod_agrupacion_cod_ob UNIQUE (cod_dimension, cod_subdimension, cod_agrupacion, cod_objeto);


--
-- Name: inventario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY inventario
    ADD CONSTRAINT inventario_pkey PRIMARY KEY (cod_dimension, cod_subdimension, cod_agrupacion, cod_objeto);


--
-- Name: laboratorios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY laboratorios
    ADD CONSTRAINT laboratorios_pkey PRIMARY KEY (codigo);


--
-- Name: mensajes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mensajes
    ADD CONSTRAINT mensajes_pkey PRIMARY KEY (id);


--
-- Name: municipios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY municipios
    ADD CONSTRAINT municipios_pkey PRIMARY KEY (id_municipio);


--
-- Name: notificaciones_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY notificaciones
    ADD CONSTRAINT notificaciones_pkey PRIMARY KEY (id);


--
-- Name: objetos_laboratorio_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY objetos_laboratorio
    ADD CONSTRAINT objetos_laboratorio_pkey PRIMARY KEY (id);


--
-- Name: parroquias_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY parroquias
    ADD CONSTRAINT parroquias_pkey PRIMARY KEY (id_parroquia);


--
-- Name: permisos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY permisos
    ADD CONSTRAINT permisos_pkey PRIMARY KEY (codigo);


--
-- Name: permisos_usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY permisos_usuarios
    ADD CONSTRAINT permisos_usuarios_pkey PRIMARY KEY (id);


--
-- Name: personas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY personas
    ADD CONSTRAINT personas_pkey PRIMARY KEY (id);


--
-- Name: proveedores_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY proveedores
    ADD CONSTRAINT proveedores_email_unique UNIQUE (email);


--
-- Name: proveedores_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY proveedores
    ADD CONSTRAINT proveedores_pkey PRIMARY KEY (codigo);


--
-- Name: salidas_inventario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY salidas_inventario
    ADD CONSTRAINT salidas_inventario_pkey PRIMARY KEY (id);


--
-- Name: sexos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sexos
    ADD CONSTRAINT sexos_pkey PRIMARY KEY (id);


--
-- Name: sub_agrupaciones_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sub_agrupaciones
    ADD CONSTRAINT sub_agrupaciones_pkey PRIMARY KEY (codigo);


--
-- Name: sub_dimensiones_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sub_dimensiones
    ADD CONSTRAINT sub_dimensiones_pkey PRIMARY KEY (codigo);


--
-- Name: subclasificacion_elementos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY subclasificacion_elementos
    ADD CONSTRAINT subclasificacion_elementos_pkey PRIMARY KEY (cod_subclasificacion);


--
-- Name: tipos_unidades_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipos_unidades
    ADD CONSTRAINT tipos_unidades_pkey PRIMARY KEY (id);


--
-- Name: tipos_usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipos_usuario
    ADD CONSTRAINT tipos_usuario_pkey PRIMARY KEY (codigo);


--
-- Name: unidades_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY unidades
    ADD CONSTRAINT unidades_pkey PRIMARY KEY (cod_unidad);


--
-- Name: usuarios_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuarios
    ADD CONSTRAINT usuarios_email_unique UNIQUE (email);


--
-- Name: usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id);


--
-- Name: usuarios_usuario_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuarios
    ADD CONSTRAINT usuarios_usuario_unique UNIQUE (usuario);


--
-- Name: almacenes_primer_auxiliar_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY almacenes
    ADD CONSTRAINT almacenes_primer_auxiliar_foreign FOREIGN KEY (primer_auxiliar) REFERENCES personas(id);


--
-- Name: almacenes_responsable_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY almacenes
    ADD CONSTRAINT almacenes_responsable_foreign FOREIGN KEY (responsable) REFERENCES personas(id);


--
-- Name: almacenes_segundo_auxiliar_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY almacenes
    ADD CONSTRAINT almacenes_segundo_auxiliar_foreign FOREIGN KEY (segundo_auxiliar) REFERENCES personas(id);


--
-- Name: catalogo_objetos_cod_clase_objeto_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY catalogo_objetos
    ADD CONSTRAINT catalogo_objetos_cod_clase_objeto_foreign FOREIGN KEY (cod_clase_objeto) REFERENCES clase_objetos(id);


--
-- Name: catalogo_objetos_cod_unidad_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY catalogo_objetos
    ADD CONSTRAINT catalogo_objetos_cod_unidad_foreign FOREIGN KEY (cod_unidad) REFERENCES unidades(cod_unidad);


--
-- Name: ciudades_id_estado_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ciudades
    ADD CONSTRAINT ciudades_id_estado_foreign FOREIGN KEY (id_estado) REFERENCES estados(id_estado);


--
-- Name: elementos_quimicos_cod_clasificacion_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY elementos_quimicos
    ADD CONSTRAINT elementos_quimicos_cod_clasificacion_foreign FOREIGN KEY (cod_clasificacion) REFERENCES clasificacion_elementos(cod_clasificacion);


--
-- Name: elementos_quimicos_cod_estado_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY elementos_quimicos
    ADD CONSTRAINT elementos_quimicos_cod_estado_foreign FOREIGN KEY (cod_estado) REFERENCES estados_materia(cod_estado);


--
-- Name: elementos_quimicos_cod_subclasificacion_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY elementos_quimicos
    ADD CONSTRAINT elementos_quimicos_cod_subclasificacion_foreign FOREIGN KEY (cod_subclasificacion) REFERENCES subclasificacion_elementos(cod_subclasificacion);


--
-- Name: entradas_inventario_cod_dimension_cod_subdimension_cod_agrupaci; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY entradas_inventario
    ADD CONSTRAINT entradas_inventario_cod_dimension_cod_subdimension_cod_agrupaci FOREIGN KEY (cod_dimension, cod_subdimension, cod_agrupacion, cod_objeto) REFERENCES inventario(cod_dimension, cod_subdimension, cod_agrupacion, cod_objeto);


--
-- Name: entradas_inventario_id_proveedor_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY entradas_inventario
    ADD CONSTRAINT entradas_inventario_id_proveedor_foreign FOREIGN KEY (id_proveedor) REFERENCES proveedores(codigo);


--
-- Name: entradas_inventario_id_usuario_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY entradas_inventario
    ADD CONSTRAINT entradas_inventario_id_usuario_foreign FOREIGN KEY (id_usuario) REFERENCES usuarios(id);


--
-- Name: inventario_cod_agrupacion_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY inventario
    ADD CONSTRAINT inventario_cod_agrupacion_foreign FOREIGN KEY (cod_agrupacion) REFERENCES agrupaciones(codigo);


--
-- Name: inventario_cod_dimension_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY inventario
    ADD CONSTRAINT inventario_cod_dimension_foreign FOREIGN KEY (cod_dimension) REFERENCES almacenes(codigo);


--
-- Name: inventario_cod_objeto_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY inventario
    ADD CONSTRAINT inventario_cod_objeto_foreign FOREIGN KEY (cod_objeto) REFERENCES catalogo_objetos(id);


--
-- Name: inventario_cod_subdimension_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY inventario
    ADD CONSTRAINT inventario_cod_subdimension_foreign FOREIGN KEY (cod_subdimension) REFERENCES sub_dimensiones(codigo);


--
-- Name: municipios_id_estado_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY municipios
    ADD CONSTRAINT municipios_id_estado_foreign FOREIGN KEY (id_estado) REFERENCES estados(id_estado);


--
-- Name: notificaciones_emisor_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY notificaciones
    ADD CONSTRAINT notificaciones_emisor_foreign FOREIGN KEY (emisor) REFERENCES usuarios(id);


--
-- Name: notificaciones_mensaje_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY notificaciones
    ADD CONSTRAINT notificaciones_mensaje_id_foreign FOREIGN KEY (mensaje_id) REFERENCES mensajes(id);


--
-- Name: notificaciones_receptor_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY notificaciones
    ADD CONSTRAINT notificaciones_receptor_foreign FOREIGN KEY (receptor) REFERENCES usuarios(id);


--
-- Name: objetos_laboratorio_cod_laboratorio_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY objetos_laboratorio
    ADD CONSTRAINT objetos_laboratorio_cod_laboratorio_foreign FOREIGN KEY (cod_laboratorio) REFERENCES laboratorios(codigo);


--
-- Name: objetos_laboratorio_cod_objeto_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY objetos_laboratorio
    ADD CONSTRAINT objetos_laboratorio_cod_objeto_foreign FOREIGN KEY (cod_objeto) REFERENCES catalogo_objetos(id);


--
-- Name: parroquias_id_municipio_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY parroquias
    ADD CONSTRAINT parroquias_id_municipio_foreign FOREIGN KEY (id_municipio) REFERENCES municipios(id_municipio);


--
-- Name: personas_sexo_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY personas
    ADD CONSTRAINT personas_sexo_id_foreign FOREIGN KEY (sexo_id) REFERENCES sexos(id);


--
-- Name: personas_usuario_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY personas
    ADD CONSTRAINT personas_usuario_id_foreign FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE;


--
-- Name: salidas_inventario_cod_dimension_cod_subdimension_cod_agrupacio; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY salidas_inventario
    ADD CONSTRAINT salidas_inventario_cod_dimension_cod_subdimension_cod_agrupacio FOREIGN KEY (cod_dimension, cod_subdimension, cod_agrupacion, cod_objeto) REFERENCES inventario(cod_dimension, cod_subdimension, cod_agrupacion, cod_objeto);


--
-- Name: salidas_inventario_id_usuario_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY salidas_inventario
    ADD CONSTRAINT salidas_inventario_id_usuario_foreign FOREIGN KEY (id_usuario) REFERENCES usuarios(id);


--
-- Name: unidades_tipo_unidad_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY unidades
    ADD CONSTRAINT unidades_tipo_unidad_foreign FOREIGN KEY (tipo_unidad) REFERENCES tipos_unidades(id);


--
-- Name: usuarios_cod_tipo_usuario_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuarios
    ADD CONSTRAINT usuarios_cod_tipo_usuario_foreign FOREIGN KEY (cod_tipo_usuario) REFERENCES tipos_usuario(codigo);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

