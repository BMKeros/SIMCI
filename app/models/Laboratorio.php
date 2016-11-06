<?php  
class Laboratorio extends Eloquent{

	protected $table = 'laboratorios';
	protected $fillable = array('codigo', 'nombre', 'descripcion');
	protected $primaryKey = 'codigo';

	static public function get_nombre($cod_laboratorio)
	{

		$consulta = DB::table('laboratorios')
			->select(RAW("UPPER(laboratorios.nombre) as resultado"))
			->where('laboratorios.codigo', '=', $cod_laboratorio)
			->first();

		return $consulta->resultado;
	}
}
?>