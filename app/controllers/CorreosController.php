<?php

class CorreosController extends BaseController
{

    public function getMostrar()
    {
        $tipo_busqueda = Input::get('type', 'todos');
        $orden = Input::get('ordenar', ' asc');
        $id_correo = Input::get('id');

        switch ($tipo_busqueda) {
            case 'todos':
                if ($orden) {
                    //le falta aun los campos que traera la consulta
                    $response = DB::table('correo_destinatarios')
                        ->select('correos.emisor', 'correos.asunto', 'correos.descripcion', 'ruta_descargar_archivo')
                        ->join('correos', 'correos.id', '=', 'correo_destinatarios.correos_id')
                        ->where('correo_destinatarios.destinatario', '=', Auth::user()->id)
                        ->orderBy('correos.id', $orden)
                        ->get();

                } else {
                    $response = DB::table('correo_destinatarios')
                        ->select('correos.emisor', 'correos.asunto', 'correos.descripcion', 'ruta_descargar_archivo')
                        ->join('correos', 'correos.id', '=', 'correo_destinatarios.correos_id')
                        ->where('correo_destinatarios.destinatario', '=', Auth::user()->id)
                        ->get();
                }
                break;

            case 'correo':
                    if($id_correo){
                        $response = DB::table('vista_correos')
                            ->select('id', 'emisor_id', 'emisor', 'asunto', 'descripcion', 'fecha_recibido',
                                        'archivo_id', 'path_archivo', 'nombre_original_archivo', 
                                        'nombre_generado_archivo', 'extension_archivo', 'ruta_descargar_archivo')
                            ->where('id', '=', $id_correo)
                            ->first();
                            

                        if(is_null($response)){
                            $response = array();
                        }
                    }
                    else{
                        $response = array();
                    }
                break;

            case 'paginacion':

                $consulta = DB::table('vista_correos')
                    ->select('id', 'emisor_id', 'emisor', 'asunto', 'descripcion', 'fecha_recibido', 'ruta_descargar_archivo');

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
            'archivo' => 'mimes:jpeg,bmp,png,zip,pdf,tar.gz,tar,doc,docx,ppt,pptx,ods,odt|max:5000',
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
            'mimes' => 'Solo se admiten los formatos jpeg,bmp,png,zip,pdf,tar.gz,tar,doc,docx,ppt,pptx,ods,odt'
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

                //Esta variable es para verificar si se subio el archivo en el sistema
                //si ocurre un error 500 borrar el archivo subido
                $subio_archivo = false;
                $nombre_archivo_subido = "";

                if (Input::hasFile('archivo')) {

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

                    //Esto es por si ocurre un error 500, para poder eliminar el archivo que se subio
                    $subio_archivo = true;
                    $nombre_archivo_subido = public_path(PATH_ARCHIVOS_CORREO . $nuevo_archivo->get_full_name());

                    //Asignamos el archivo al correo
                    $nuevo_correo->archivo_id = $nuevo_archivo->id;
                }

                //Guardamos el correo
                $nuevo_correo->save();

                //Convertimos el string separado por COMAS de los ids de usuario, y lo convertimos en un array
                $destinatarios = explode(",", $destinatarios);

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

                if ($subio_archivo) {
                    unlink($nombre_archivo_subido);
                }

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