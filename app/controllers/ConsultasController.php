<?php  
	class ConsultasController extends Controller {
		//falta colocar aquji las funciones respectivas

		public function getMostrar(){

			$tipo_busqueda = Input::get('type', 'estado');

			switch($tipo_busqueda){
				case 'estado':
					$response = DB::table('estados')
						->select('id_estado', 'estado')
						->get();
					
				break;

				case 'ciudad':
					$id_estado = Input::get('id_estado');

					if($id_estado){

						$response = DB::table('ciudades')
							->select('id_ciudad', 'ciudad')
							->where('id_estado', '=', $id_estado)
							->get();
							

						if(is_null($response)){
							$response = array();
						}
					}
					else{
						$response = array();
					}
				break;

				case 'municipio':
					
					$id_estado = Input::get('id_estado');

					if($id_estado){

						$response = DB::table('municipios')
							->select('id_municipio', 'municipio')
							->where('id_estado', '=', $id_estado)
							->get();
							

						if(is_null($response)){
							$response = array();
						}
					}
					else{
						$response = array();
					}
				break;

				case 'parroquia':
					
					$id_municipio = Input::get('id_municipio');

					if($id_municipio){

						$response = DB::table('parroquias')
							->select('id_parroquia', 'parroquia')
							->where('id_municipio', '=', $id_municipio)
							->get();
							

						if(is_null($response)){
							$response = array();
						}
					}
					else{
						$response = array();
					}
				break;
			}

			return Response::json($response);
		}
	
	}

?>