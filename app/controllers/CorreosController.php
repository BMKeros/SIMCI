<?php

class CorreosController extends BaseController
{

    public function getMostrar()
    {
        $tipo_busqueda = Input::get('type', 'todos');
        $orden = Input::get('ordenar', ' asc');

        switch ($tipo_busqueda) {
            case 'todos':
                if ($orden) {
                    //le falta aun los campos que traera la consulta
                    $response = DB::table('correo_destinatarios')
                        ->select('correos.emisor', 'correos.asunto', 'correos.descripcion')
                        ->join('correos', 'correos.id', '=', 'correo_destinatarios.correos_id')
                        ->where('correo_destinatarios.destinatario', '=', Auth::user()->id)
                        ->orderBy('correos.id', $orden)
                        ->get();

                } else {
                    $response = DB::table('correo_destinatarios')
                        ->select('correos.emisor', 'correos.asunto', 'correos.descripcion')
                        ->join('correos', 'correos.id', '=', 'correo_destinatarios.correos_id')
                        ->where('correo_destinatarios.destinatario', '=', Auth::user()->id)
                        ->get();
                }
                break;

            case 'paginacion':

                $consulta = DB::table('vista_correos')
                    ->select('id', 'emisor', 'asunto', 'descripcion', 'path_archivo', 'nombre_original_archivo',
                        'nombre_generado_archivo', 'extension_archivo');

                $response = $this->generar_paginacion_dinamica($consulta,
                    array('campo_where' => 'asunto', 'campo_orden' => 'id'));

                break;

            default:
                $response = DB::table('vista_correos')->get();
                break;
        }

        return Response::json($response);
    }


    public function postEnviarCorreo()
    {
        DB::beginTransaction();

        $emisor = Auth::user()->id;
        $asunto = Input::get('asunto');
        $destinatarios = Input::get('destinatarios');
        $descripcion = Input::get('descripcion');
        $archivo = Input::file('archivo');

        //reglas
        $reglas = array(
            'emisor' => 'required|exists:usuarios,id|numeric',
            'asunto' => 'required|max:80',
            'destinatarios' => 'required',
            'descripcion' => 'required|max:250',
            'archivo' => 'mimes:jpeg,bmp,png,zip,pdf,tar.gz,tar',
        );

        $campos = array(
            'emisor' => $emisor,
            'asunto' => $asunto,
            'destinatarios' => $destinatarios,
            'descripcion' => $descripcion,
            'archivo' => $archivo
        );

        $mensajes = array(
            'required' => ':attribute no puede estar en blanco',
            'alpha_num' => ':attribute debe contener solo caracteres y numeros',
            'max' => ':attribute debe tener un maximo de :max caracteres',
            'exists' => ':attribute no existe',
            'numeric' => ':attribute debe tener solo numeros',
        );

        $validacion = Validator::make($campos, $reglas, $mensajes);

        if ($validacion->fails()) {

            return Response::json(['resultado' => false, 'mensajes' => $validacion->messages()->all()]);

        } else {

            try {

                $nuevo_correo = new Correo();
                $nuevo_correo->emisor = $emisor;
                $nuevo_correo->asunto = $asunto;
                $nuevo_correo->descripcion = $descripcion;

                var_dump(Input::hasFile('archivo'));die();

                if (Input::hasFile('archivo')) {

                    //Esta funcion es para crear el directorio donde se suben los archivos del correo
                    crear_directorio(PATH_ARCHIVOS_CORREO);

                    $nuevo_archivo = new Archivo();
                    $nuevo_archivo->nombre_original = $archivo->getClientOriginalName();
                    $nuevo_archivo->nombre_generado = generar_nombre_archivo();
                    $nuevo_archivo->extension = get_extension_archivo($archivo->getClientOriginalName());
                    $nuevo_archivo->path = PATH_ARCHIVOS_CORREO;

                    //movemos el archivo a la carpeta
                    $archivo->move(PATH_ARCHIVOS_CORREO, $nuevo_archivo->get_full_name());

                    //Guardamos el archivo
                    $nuevo_archivo->save();

                    //Asignamos el archivo al correo
                    $nuevo_correo->archivo = $nuevo_archivo->id;
                }

                //Guardamos el correo
                $nuevo_correo->save();

                //Enviamos el correo a los destinatarios
                foreach ($destinatarios as $destinatario) {
                    DB::table('correo_destinatarios')->insert([
                        'correo_id' => $nuevo_correo->id,
                        'destinatario' => $destinatario,
                        'created_at' => get_now(),
                        'updated_at' => get_now()
                    ]);

                    //Enviamos una notificacion al destinatario
                    crear_notificacion("Ha recibido un nuevo correo", $destinatario);
                }

            } catch (\Exception $e) {
                DB::rollBack();

                return Response::json(array(
                    'resultado' => false,
                    'mensajes' => array($e->getMessage())
                ), 500);
            }

            DB::commit();

            return Response::json(array(
                'resultado' => true,
                'mensajes' => ['Correo enviado con exito']
            ), 200);
        }
    }
}