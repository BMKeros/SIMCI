<?php

class InventarioController extends BaseController
{

    public function __construct()
    {
        //$this->beforeFilter('APICheckPermisos');
    }

    public function getMostrar()
    {

        $tipo_busqueda = Input::get('type', 'todos');
        $orden = Input::get('ordenar', 'asc');

        switch ($tipo_busqueda) {

            case 'elemento_full':
                $cod_dimension = Input::get('cod_dimension', null);
                $cod_subdimension = Input::get('cod_subdimension', null);
                $cod_agrupacion = Input::get('cod_agrupacion', null);
                $cod_objeto = Input::get('cod_objeto', null);
                $numero_orden = Input::get('numero_orden', null);

                if (!is_null($cod_dimension) && !is_null($cod_subdimension) && !is_null($cod_agrupacion) && !is_null($cod_objeto) && !is_null($numero_orden)) {

                    $data = DB::table('vista_inventario_full')
                        ->select('cod_dimension',
                            'descripcion_dimension as nombre_dimension',
                            'cod_subdimension',
                            'descripcion_subdimension as nombre_subdimension',
                            'cod_agrupacion',
                            'elemento_movible',
                            'nombre_agrupacion',
                            'cod_agrupacion',
                            'cod_subagrupacion',
                            'descripcion_subagrupacion as nombre_subagrupacion',
                            'numero_orden',
                            'cantidad_disponible',
                            'cod_objeto',
                            'nombre_objeto',
                            'nombre_unidad',
                            'abreviatura_unidad as abreviatura',
                            'created_at',
                            'updated_at')
                        ->where('cod_dimension', '=', $cod_dimension)
                        ->where('cod_subdimension', '=', $cod_subdimension)
                        ->where('cod_agrupacion', '=', $cod_agrupacion)
                        ->where('cod_objeto', '=', $cod_objeto)
                        ->where('numero_orden', '=', $numero_orden)
                        ->orderBy('nombre_objeto', 'asc')
                        ->first();

                    $response = $data;
                } else {
                    $response = array();
                }
                break;

            case 'paginacion':

                $consulta = DB::table('vista_elementos_inventario')
                    ->select('cod_dimension',
                        'cod_subdimension',
                        'cod_agrupacion',
                        'cantidad_total_disponible',
                        'cod_objeto',
                        'nombre_objeto',
                        'nombre_unidad',
                        'abreviatura_unidad as abreviatura');


                $response = $this->generar_paginacion_dinamica($consulta,
                    array('campo_where' => 'nombre_objeto', 'campo_orden' => 'nombre_objeto'));

                break;

            case 'listar_elementos':

                $cod_dimension = Input::get('cod_dimension', null);
                $cod_subdimension = Input::get('cod_subdimension', null);
                $cod_agrupacion = Input::get('cod_agrupacion', null);
                $cod_objeto = Input::get('cod_objeto', null);

                $consulta = DB::table('vista_inventario_full')
                    ->select('cod_dimension',
                        'cod_subdimension',
                        'cod_agrupacion',
                        'cod_subagrupacion',
                        'numero_orden',
                        'cantidad_disponible',
                        'cod_objeto',
                        'nombre_objeto',
                        'nombre_unidad',
                        'abreviatura_unidad as abreviatura')
                    ->where('cod_dimension', '=', $cod_dimension)
                    ->where('cod_subdimension', '=', $cod_subdimension)
                    ->where('cod_agrupacion', '=', $cod_agrupacion)
                    ->where('cod_objeto', '=', $cod_objeto);

                $response = $this->generar_paginacion_dinamica($consulta,
                    array('campo_where' => 'nombre_objeto', 'campo_orden' => 'nombre_objeto'));

                break;

            case 'paginacion_almacenes':
                $consulta = DB::table('vista_almacen_full')
                    ->select('cod_dimension as codigo',
                        'descripcion',
                        'primer_nombre_responsable as nombre_responsable',
                        'primer_apellido_responsable as apellido_responsable',
                        'primer_nombre_primer_auxiliar as nombre_primer_auxiliar',
                        'primer_apellido_primer_auxiliar as apellido_primer_auxiliar',
                        'primer_nombre_segundo_auxiliar as nombre_segundo_auxiliar',
                        'primer_apellido_segundo_auxiliar as apellido_segundo_auxiliar');

                $response = $this->generar_paginacion_dinamica($consulta,
                    array('campo_where' => 'descripcion', 'campo_orden' => 'cod_dimension'));

                break;

            case 'almacen_full':
                $cod_almacen = Input::get('cod_almacen', null);

                $data = DB::table('vista_almacen_full')
                    ->select('cod_dimension as codigo',
                        'descripcion',
                        'primer_nombre_responsable as nombre_responsable',
                        'primer_apellido_responsable as apellido_responsable',
                        'primer_nombre_primer_auxiliar as nombre_primer_auxiliar',
                        'primer_apellido_primer_auxiliar as apellido_primer_auxiliar',
                        'primer_nombre_segundo_auxiliar as nombre_segundo_auxiliar',
                        'primer_apellido_segundo_auxiliar as apellido_segundo_auxiliar',
                        'created_at',
                        'updated_at')
                    ->where('cod_dimension', '=', $cod_almacen)
                    ->first();

                $response = $data;

                break;

            case 'query':

                $value_search = Input::get('query');

                if (quitar_espacios($value_search) != '') {

                    $data = DB::table('vista_inventario_full')
                        ->select(DB::raw('capitalize(nombre_objeto) as name'), 'cod_objeto as value')
                        ->where('nombre_objeto', 'ILIKE', '%' . $value_search . '%')
                        ->get();

                    $response = array("success" => true, "results" => $data);
                } else {
                    $data = DB::table('vista_inventario_full')
                        ->select(DB::raw('capitalize(nombre_objeto) as name'), 'cod_objeto as value')
                        ->orderBy('name', 'desc')
                        ->take(7)
                        ->get();

                    $response = array("success" => true, "results" => $data);
                }
                break;

            case 'search':
                $value_search = Input::get('query');

                $data = DB::table('vista_inventario_full')
                    ->select('cod_dimension', 'cod_subdimension', 'cod_agrupacion', 'cod_objeto', 'nombre_objeto', 'especificaciones_objeto', 'descripcion_objeto', 'nombre_clase_objeto')
                    ->where('nombre_objeto', 'ILIKE', '%' . $value_search . '%')
                    ->groupBy('cod_dimension')
                    ->groupBy('cod_subdimension')
                    ->groupBy('cod_agrupacion')
                    ->groupBy('cod_objeto')
                    ->groupBy('nombre_objeto')
                    ->groupBy('especificaciones_objeto')
                    ->groupBy('descripcion_objeto')
                    ->groupBy('nombre_clase_objeto')
                    ->get();

                $response = array("success" => true, "results" => $data);

                break;

            case 'generar_numero_orden':
                $cod_dimension = Input::get('cod_dimension', null);
                $cod_subdimension = Input::get('cod_subdimension', null);
                $cod_agrupacion = Input::get('cod_agrupacion', null);
                $cod_objeto = Input::get('cod_objeto', null);

                $data = DB::table('inventario')
                    ->where('cod_dimension', '=', $cod_dimension)
                    ->where('cod_subdimension', '=', $cod_subdimension)
                    ->where('cod_agrupacion', '=', $cod_agrupacion)
                    ->where('cod_objeto', '=', $cod_objeto)
                    ->count();

                $response = array('resultado' => true, 'datos' => ($data + 1));
                break;

            default:
                $response = array();
                break;

        }

        return Response::json($response);
    }

    public function postRegistrarElemento()
    {

        $cod_dimension = Input::get('cod_dimension');
        $cod_sub_dimension = Input::get('cod_sub_dimension');
        $cod_agrupacion = Input::get('cod_agrupacion');
        $cod_sub_agrupacion = Input::get('cod_sub_agrupacion');
        $cod_objeto = Input::get('cod_objeto');
        $numero_orden = Input::get('numero_orden');
        $cantidad_disponible = Input::get('cantidad_disponible');
        $elemento_movible = Input::get('elemento_movible');

        //este codigo es para verificar si existe en el inventario
        $codigo_elemento = $cod_dimension . "-" . $cod_sub_dimension . "-" . $cod_agrupacion . "-" . $cod_objeto . "-" . $numero_orden;

        $reglas = array(
            'cod_dimension' => 'required|alpha_num|exists:almacenes,codigo',
            'cod_sub_dimension' => 'required|alpha_num|exists:sub_dimensiones,codigo',
            'cod_agrupacion' => 'required|alpha_num|exists:agrupaciones,codigo',
            'cod_sub_agrupacion' => 'alpha_num|exists:sub_agrupaciones,codigo',
            'numero_orden' => 'required|numeric',
            'cod_objeto' => 'required|numeric|exists:catalogo_objetos,id',
            'cantidad_disponible' => 'required|numeric',
            'elemento_movible' => 'required|boolean',
            'codigo_elemento' => 'exists_elemento'
        );

        $campos = array(
            'cod_dimension' => $cod_dimension,
            'cod_sub_dimension' => $cod_sub_dimension,
            'cod_agrupacion' => $cod_agrupacion,
            'cod_sub_agrupacion' => $cod_sub_agrupacion,
            'numero_orden' => $numero_orden,
            'cod_objeto' => $cod_objeto,
            'cantidad_disponible' => $cantidad_disponible,
            'elemento_movible' => $elemento_movible,
            'codigo_elemento' => $codigo_elemento
        );

        $mensajes = array(
            'required' => 'El campo :attribute es necesario',
            'alpha_num' => 'El campo :attribute debe contener caracteres alfanumericos',
            'unique' => 'El campo :attribute ya existe en el inventario',
            'integer' => 'El campo :attribute debe ser numerico',
            'boolean' => 'El campo :attribute debe ser una eleccion logita Ej:(true o false)',
            ':attribute no existe',
            'numeric' => 'El :attribute debe ser solo numeros',
            'exists' => ':attribute no existe!',
            'exists_elemento' => 'Este elemento ya existe en el inventario'

        );

        $validacion = Validator::make($campos, $reglas, $mensajes);

        if ($validacion->fails()) {
            return Response::json(array('resultado' => false, 'mensajes' => $validacion->messages()->all()));
        } else {
            $nuevo_elemento = new ElementoInventario;

            $nuevo_elemento->cod_dimension = $cod_dimension;
            $nuevo_elemento->cod_subdimension = $cod_sub_dimension;
            $nuevo_elemento->cod_agrupacion = $cod_agrupacion;
            $nuevo_elemento->cod_subagrupacion = $cod_sub_agrupacion;
            $nuevo_elemento->numero_orden = $numero_orden;
            $nuevo_elemento->cod_objeto = $cod_objeto;
            $nuevo_elemento->cantidad_disponible = $cantidad_disponible;
            $nuevo_elemento->elemento_movible = $elemento_movible;

            $nuevo_elemento->save();

            return Response::json(array(
                    'resultado' => true,
                    'mensajes' => array('Nuevo Elemento creado con exito.',
                    ))
            );
        }
    }

    public function postActualizarElemento($id)
    {

        $cod_dimension = Input::get('cod_dimension', null);
        $cod_subdimension = Input::get('cod_subdimension', null);
        $cod_agrupacion = Input::get('cod_agrupacion', null);
        $cod_objeto = Input::get('cod_objeto', null);
        $numero_orden = Input::get('numero_orden', null);

        if (!is_null($cod_dimension) && !is_null($cod_subdimension) && !is_null($cod_agrupacion) && !is_null($cod_objeto) && !is_null($numero_orden)) {

            $elemento = DB::table('inventario')
                ->where('cod_dimension', '=', $cod_dimension)
                ->where('cod_subdimension', '=', $cod_subdimension)
                ->where('cod_agrupacion', '=', $cod_agrupacion)
                ->where('cod_objeto', '=', $cod_objeto)
                ->where('numero_orden', '=', $numero_orden)
                ->first();

            if (!is_null($elemento)) {
                $cod_dimension = input_default(Input::get('cod_dimension'), $elemento->cod_dimension);
                $cod_sub_dimension = input_default(Input::get('cod_sub_dimension'), $elemento->cod_subdimension);
                $cod_agrupacion = input_default(Input::get('cod_agrupacion'), $elemento->cod_agrupacion);
                $cod_sub_agrupacion = input_default(Input::get('cod_sub_agrupacion'), $elemento->cod_subagrupacion);
                $numero_orden = input_default(Input::get('numero_orden'), $elemento->numero_orden);
                $cod_objeto = input_default(Input::get('cod_objeto'), $elemento->cod_objeto);
                $cantidad_disponible = input_default(Input::get('cantidad_disponible'), $elemento->cantidad_disponible);
                $elemento_movible = input_default(Input::get('elemento_movible'), $elemento->recipientes_disponibles);

                $reglas = array(
                    'cod_dimension' => 'required|alpha_num|exists:almacenes,codigo',
                    'cod_sub_dimension' => 'required|alpha_num|exists:sub_dimensiones,codigo',
                    'cod_agrupacion' => 'required|alpha_num|exists:agrupaciones,codigo',
                    'cod_sub_agrupacion' => 'alpha_num|exists:sub_agrupaciones,codigo',
                    'numero_orden' => 'required|numeric',
                    'cod_objeto' => 'required|numeric|exists:catalogo_objetos,id|unique:inventario',
                    'cantidad_disponible' => 'required|numeric',
                    'elemento_movible' => 'required|boolean'
                );

                $campos = array(
                    'cod_dimension' => $cod_dimension,
                    'cod_sub_dimension' => $cod_sub_dimension,
                    'cod_agrupacion' => $cod_agrupacion,
                    'cod_sub_agrupacion' => $cod_sub_agrupacion,
                    'numero_orden' => $numero_orden,
                    'cod_objeto' => $cod_objeto,
                    'cantidad_disponible' => $cantidad_disponible,
                    'elemento_movible' => $elemento_movible
                );

                $mensajes = array(
                    'required' => 'El campo :attribute es necesario',
                    'alpha_num' => 'El campo :attribute debe contener caracteres alfanumericos',
                    'unique' => 'El campo :attribute ya existe',
                    'integer' => 'El campo :attribute debe ser numerico',
                    'boolean' => 'El campo :attribute debe ser una eleccion logita Ej:(true o false)',
                    ':attribute no existe',
                    'numeric' => 'El :attribute debe ser solo numeros',
                    'exists' => ':attribute no existe!'
                );

                $validacion = Validator::make($campos, $reglas, $mensajes);

                if ($validacion->fails()) {
                    return Response::json(array('resultado' => false, 'mensajes' => $validacion->messages()->all()));
                } else {
                    $elemento->cod_dimension = $cod_dimension;
                    $elemento->cod_subdimension = $cod_sub_dimension;
                    $elemento->cod_agrupacion = $cod_agrupacion;
                    $elemento->cod_subagrupacion = $cod_sub_agrupacion;
                    $elemento->numero_orden = $numero_orden;
                    $elemento->cod_objeto = $cod_objeto;
                    $elemento->cantidad_disponible = $cantidad_disponible;
                    $elemento->elemento_movible = $elemento_movible;

                    $elemento->save();

                    return Response::json(array(
                            'resultado' => true,
                            'mensajes' => 'Elemento Actualizado con exito.'
                        )
                    );
                }
            } else {
                return Response::json(array('resultado' => false, 'mensajes' => 'ID no existe'));
            }
        } else {
            return Response::json(array('resultado' => false, 'mensajes' => 'Error codigos no existentes'), 404);
        }
    }

    public function postEliminarElemento($id)
    {

        $cod_dimension = Input::get('cod_dimension', null);
        $cod_subdimension = Input::get('cod_subdimension', null);
        $cod_agrupacion = Input::get('cod_agrupacion', null);
        $cod_objeto = Input::get('cod_objeto', null);
        $numero_orden = Input::get('numero_orden', null);

        if (!is_null($cod_dimension) && !is_null($cod_subdimension) && !is_null($cod_agrupacion) && !is_null($cod_objeto) && !is_null($numero_orden)) {

            $elemento = DB::table('inventario')
                ->where('cod_dimension', '=', $cod_dimension)
                ->where('cod_subdimension', '=', $cod_subdimension)
                ->where('cod_agrupacion', '=', $cod_agrupacion)
                ->where('cod_objeto', '=', $cod_objeto)
                ->where('numero_orden', '=', $numero_orden)
                ->first();

            if (!is_null($elemento)) {
                $elemento->delete();
                return Response::json(array('resultado' => true, 'mensajes' => 'Elemento eliminado con exito'));
            } else {
                return Response::json(array('resultado' => false, 'mensajes' => 'Elemento no existe'));
            }
        } else {
            return Response::json(array('resultado' => false, 'mensajes' => 'Error codigos no existentes'), 404);
        }
    }

    public function postRegistrarAlmacen()
    {
        $responsable = Input::get('responsable');
        $primer_auxiliar = Input::get('primer_auxiliar');
        $segundo_auxiliar = Input::get('segundo_auxiliar');
        $descripcion = Input::get('descripcion');

        $reglas = array(
            'responsable' => 'required|integer|exists:personas,id',
            'primer_auxiliar' => 'required|integer|exists:personas,id',
            'segundo_auxiliar' => 'integer|exists:personas,id',
            'descripcion' => 'required|min:3|max:150'
        );

        $campos = array(
            'responsable' => $responsable,
            'primer_auxiliar' => $primer_auxiliar,
            'segundo_auxiliar' => $segundo_auxiliar,
            'descripcion' => $descripcion
        );

        $mensajes = array(
            'required' => 'El campo :attribute es obligatorio',
            'integer' => 'El campo :attribute debe ser numerico',
            'unique' => 'El campo :attribute ya existe, intente con otro',
            'min' => 'El campo :attribute no debe tener menos de :min caracteres',
            'max' => 'El campo :attribute no debe exceder los :max caracteres',
            'exists' => ':attribute no existe'
        );

        $validacion = Validator::make($campos, $reglas, $mensajes);

        if ($validacion->fails()) {
            return Response::json(array('resultado' => false, 'mensajes' => $validacion->messages()->all()));
        } else {
            $nuevo_almacen = new Almacen;

            $num_almacen = DB::table('almacenes')->max('secuencia');

            $nuevo_almacen->codigo = crear_codigo($num_almacen, "ALMACEN");
            $nuevo_almacen->responsable = $responsable;
            $nuevo_almacen->primer_auxiliar = $primer_auxiliar;
            $nuevo_almacen->segundo_auxiliar = $segundo_auxiliar;
            $nuevo_almacen->descripcion = $descripcion;

            $nuevo_almacen->save();

            return Response::json(array('resultado' => true, 'mensajes' => array('Nuevo Almacen creado con exito.')));
        }
    }

    public function postRegistrarSubDimension()
    {

        $codigo = Input::get('codigo');
        $descripcion = Input::get('descripcion');

        $reglas = array(
            'codigo' => 'required|unique:sub_dimensiones|min:2|max:3',
            'descripcion' => 'required|min:2|max:150'
        );

        $campos = array(
            'codigo' => $codigo,
            'descripcion' => $descripcion
        );

        $mensajes = array(
            'required' => 'El campo :attribute es obligatorio',
            'unique' => 'El campo :attribute ya existe, intente con otro',
            'min' => 'El campo :attribute no debe tener menos de :min caracteres',
            'max' => 'El campo :attribute no debe exceder los :max caracteres'
        );

        $validacion = Validator::make($campos, $reglas, $mensajes);

        if ($validacion->fails()) {
            return Response::json(array('resultado' => false, 'mensajes' => $validacion->messages()->all()));
        } else {
            $nuevo_estantes = new SubDimension;

            $nuevo_estantes->codigo = $codigo;
            $nuevo_estantes->descripcion = $descripcion;

            $nuevo_estantes->save();

            return Response::json(array('resultado' => true, 'mensajes' => array('Nueva Sub Dimension creado con exito.')));
        }
    }

    public function postRegistrarAgrupacion()
    {
        $codigo = Input::get('codigo');
        $nombre = Input::get('nombre');
        $descripcion = Input::get('descripcion');

        $reglas = array(
            'codigo' => 'required|unique:agrupaciones|min:1|max:3',
            'nombre' => 'required|min:5|max:50',
            'descripcion' => 'min:5|max:150'
        );

        $campos = array(
            'codigo' => $codigo,
            'nombre' => $nombre,
            'descripcion' => $descripcion
        );

        $mensajes = array(
            'unique' => 'El campo :attribute ya existe, intente con otro',
            'required' => 'El campo :attribute es obligatorio',
            'min' => 'El campo :attribute no debe tener menos de :min caracteres',
            'max' => 'El campo :attribute no debe exceder los :max caracteres'
        );

        $validacion = Validator::make($campos, $reglas, $mensajes);

        if ($validacion->fails()) {
            return Response::json(array('resultado' => false, 'mensajes' => $validacion->messages()->all()));
        } else {
            $agrupacion = new Agrupacion;

            $agrupacion->codigo = $codigo;
            $agrupacion->nombre = $nombre;
            $agrupacion->descripcion = $descripcion;

            $agrupacion->save();

            return Response::json(array('resultado' => true, 'mensajes' => array('Nueva agrupacion creado con exito.')));
        }
    }

    public function postRegistrarSubAgrupacion()
    {
        $codigo = Input::get('codigo');
        $nombre = Input::get('nombre');
        $descripcion = Input::get('descripcion');

        $reglas = array(
            'codigo' => 'required|unique:sub_agrupaciones|min:1|max:3',
            'nombre' => 'required|min:5|max:50',
            'descripcion' => 'min:5|max:150'
        );

        $campos = array(
            'codigo' => $codigo,
            'nombre' => $nombre,
            'descripcion' => $descripcion
        );

        $mensajes = array(
            'unique' => 'El campo :attribute ya existe, intente con otro',
            'required' => 'El campo :attribute es obligatorio',
            'min' => 'El campo :attribute no debe tener menos de :min caracteres',
            'max' => 'El campo :attribute no debe exceder los :max caracteres'
        );

        $validacion = Validator::make($campos, $reglas, $mensajes);

        if ($validacion->fails()) {
            return Response::json(array('resultado' => false, 'mensajes' => $validacion->messages()->all()));
        } else {
            $sub_agrupacion = new SubAgrupacion;

            $sub_agrupacion->codigo = $codigo;
            $sub_agrupacion->nombre = $nombre;
            $sub_agrupacion->descripcion = $descripcion;

            $sub_agrupacion->save();

            return Response::json(array('resultado' => true, 'mensajes' => array('Nueva sub-agrupacion creado con exito.')));
        }
    }
}

?>