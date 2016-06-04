<?php

class CorreosController extends Controller
{
    public function postEnviarCorreo()
    {
        DB::beginTransaction();

        $emisor = Auth::user()->id;
        $asunto = Input::get('asunto');
        $destinatarios = Input::get('lista_destinatarios');
        $descripcion = Input::get('descripcion');
        $archivo = Input::file('archivo');

        //reglas
        $reglas = array(
            'emisor' => 'required|exists:usuarios,id|numeric',
            'asunto' => 'required|alpha|max:80',
            'destinatarios' => 'required',
            'descripcion' => 'required|alpha|max:250',
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
            'alpha' => ':attribute debe contener solo caracteres',
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
                $nuevo_correo->descripcion = $descripcion;

                if (Input::hasFile('archivo')) {

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