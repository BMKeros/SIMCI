<?php  

	class ElementoQuimico extends Eloquent {

		protected $table = 'elementos_quimicos';
		protected $fillable = array('periodo','grupo_cas','grupo_iupac','simbolo','numero_atomico',
			'nombre', 'peso_atomico', 'valencia', 'temp_ebullicion',
			'temp_fusion','bloque', 'cod_estado','cod_clasificacion','cod_subclasificacion','config_electronica',
			'densidad','electronegatividad');
	}
?>