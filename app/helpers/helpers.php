<?php

function RAW($text_sql = '')
{
    if (empty($text_sql)) {
        return '';
    }
    return DB::raw($text_sql);
}

function get_now()
{
    return date("Y-m-d H:i:s");
}

function drop_cascade($table = null)
{
    if (Schema::hasTable($table)) {
        DB::statement('DROP TABLE ' . $table . ' CASCADE;');
    }
}

function reset_secuencia($table = null)
{
    if (Schema::hasTable($table)) {
        DB::statement('ALTER SEQUENCE ' . $table . '_id_seq RESTART WITH 1');
    }
}

function remplaza_coma_punto($string = null)
{
    return (empty($string) || strlen($string) == 0) ? ('') : (str_replace([','], '.', $string));
}

function redirect_por_tipo($tipo_usuario = null)
{
    if ($tipo_usuario == TIPO_USER_ROOT || $tipo_usuario == TIPO_USER_ADMIN) {
        return Redirect::action('ModulosController@getAdministracion');
    } else if ($tipo_usuario == TIPO_USER_ESTUDIANTE) {
        return Redirect::action('ModulosController@getEstudiantes');
    } else if ($tipo_usuario == TIPO_USER_PROFESOR) {
        return Redirect::action('ModulosController@getProfesores');
    } else if ($tipo_usuario == TIPO_USER_SUPERVISOR) {
        return Redirect::action('ModulosController@getSupervisor');
    } else if ($tipo_usuario == TIPO_USER_ALMACENISTA) {
        return Redirect::action('ModulosController@getAlmacenista');
    } else {
        Auth::logout();
        return Redirect::to('/')->with(array('mensaje_alerta' => "Error ha ocurrido un problema con su tipo de usuario"));
    }
}

function atributos_dinamicos($atributos = null, $default = null)
{

    if ($atributos && !empty($atributos)) {

        $default_atributos = ($default) ? ($default) : (array('class' => "ui", 'id' => 'default', 'name' => 'default'));

        foreach ($default_atributos as $key => $value) {
            (array_key_exists($key, $atributos)) ? '' : $atributos[$key] = $value;
        }

        $tmp = "";
        foreach ($atributos as $key => $value) {
            $tmp .= sprintf(" %s=\"%s\" ", $key, $value);
        }

        return $tmp;
    } else {
        return "";
    }
}

function quitar_espacios($input = '')
{
    return str_replace(array(' ', '   '), '', $input);
}

function input_default($input = '', $default = '')
{
    $num_char = strlen(quitar_espacios($input));
    return ($num_char == 0) ? ($default) : ($input);
}


function cargar_crear_imagen_usuario($archivo = null, $name_usuario = "")
{
    if ($archivo) {
        $extension = explode(".", $archivo->getClientOriginalName());
        $extension = $extension[count($extension) - 1];
        $name = sprintf('%s_img_perfil_user.%s', $name_usuario, $extension);
        $archivo->move('uploads/imagenes', $name);
        return $name;
    } else {
        return null;
    }
}

function agregar_ceros($numero = 0, $cantidad_ceros = 1)
{
    $ceros = "";
    for ($i = 0; $i < $cantidad_ceros; $i++) {
        $ceros .= "0";
    }
    return ($numero > 0 && $numero < 10) ? (sprintf("%s%d", $ceros, $numero)) : ((String)$numero);
}

function crear_codigo($numero = 1, $tipo_codigo = null)
{
    if ($tipo_codigo) {
        $numero = $numero + 1;

        $tipo_codigo = strtoupper($tipo_codigo);

        if ($tipo_codigo == "ALMACEN") {
            $codigo_tmp = CODIGO_ALMACEN;
        } else if ($tipo_codigo == "PERMISO") {
            $codigo_tmp = CODIGO_PERMISO;
        } else if ($tipo_codigo == "TIPO_USUARIO") {
            $codigo_tmp = CODIGO_TIPO_USUARIO;
        } else if ($tipo_codigo == "LABORATORIO") {
            $codigo_tmp = CODIGO_LABORATORIO;
        } else if ($tipo_codigo == "AGRUPACION") {
            $codigo_tmp = CODIGO_AGRUPACION;
        } else if ($tipo_codigo == "PROVEEDOR") {
            $codigo_tmp = CODIGO_PROVEEDORES;
        } else {
            $codigo_tmp = '';
        }

        return sprintf("%s%s", $codigo_tmp, agregar_ceros($numero, 1));
    } else {
        return null;
    }
}

function get_array_permisos_usuario($id_usuario = null)
{
    if (is_null($id_usuario)) {
        return array();
    } else {
        $permisos = DB::table('permisos_usuarios')->select('cod_permiso')->where('usuario_id', '=', $id_usuario)->lists('cod_permiso');

        return $permisos;
    }
}

function generar_codigo_orden()
{

    $hash = hash('crc32b', uniqid(rand(), true));

    return 'O-' . strtoupper($hash);
}

