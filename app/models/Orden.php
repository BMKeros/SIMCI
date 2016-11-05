<?php  
	class Orden extends Eloquent{
		protected $table = 'ordenes';
        protected $fillable = array('id', 'codigo', 'responsable', 'solicitante', 'fecha_actividad', 'fecha', 'hora', 'cod_laboratorio', 'observaciones', 'status');


        static public function get_datos_responsable($codigo_orden)
        {
            $consulta = DB::table('ordenes')
                ->select(
                    RAW('formato_nombre_completo(personas.primer_nombre, personas.primer_apellido) as nombre_completo'),
                    'usuarios.email')
                ->join('usuarios', 'usuarios.id', '=', 'ordenes.responsable')
                ->join('personas', 'personas.usuario_id', '=', 'usuarios.id')
                ->where('codigo', $codigo_orden)
                ->first();

            return $consulta;
        }

        static public function get_datos_solicitante($codigo_orden)
        {
            $consulta = DB::table('ordenes')
                ->select(
                    RAW('formato_nombre_completo(personas.primer_nombre, personas.primer_apellido) as nombre_completo'),
                    'usuarios.email')
                ->join('usuarios', 'usuarios.id', '=', 'ordenes.solicitante')
                ->join('personas', 'personas.usuario_id', '=', 'usuarios.id')
                ->where('codigo', $codigo_orden)
                ->first();

            return $consulta;
        }
	}
?>