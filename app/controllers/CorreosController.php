<?php

class CorreosController extends Controller
{
    public function postEnviarCorreo()
    {
        $emisor = Auth::user()->id;
        $asunto = Input::get('asunto');
        $destinatario = Input::get('destinatario');
        $descripcion = Input::get('descripcion');
        $archivo = Input::file('archivo');

        if (Input::hasFile('archivo')) {

            $nuevo_archivo = new Archivo();
            $nuevo_archivo->nombre_original = $archivo->getClientOriginalName();
            $nuevo_archivo->nombre_generado = generar_nombre_archivo();
            $nuevo_archivo->extension = get_extension_archivo($archivo->getClientOriginalName());
            $nuevo_archivo->ubicacion = '';

        }
    }
}