<?php  
	class ConsultasController extends Controller {
	
		public function getObtener(){

			$tipo_busqueda = Input::get('type', 'estado');

			switch($tipo_busqueda){
				case 'estado':
					$data = DB::table('estados')
						->select('id_estado as value', 'estado as name')
						->orderBy('name', 'asc')
						->get();

					$response = $data;
				break;

				case 'ciudad':
					$id_estado = Input::get('id_estado');

					if($id_estado){

						$data = DB::table('ciudades')
							->select('id_ciudad as value', 'ciudad as name')
							->where('id_estado', '=', $id_estado)
							->orderBy('name', 'asc')
							->get();
						
						$response = $data;
					}
					else{
						$response = array();
					}
				break;

				case 'municipio':
					
					$id_estado = Input::get('id_estado');

					if($id_estado){

						$data = DB::table('municipios')
							->select('id_municipio as value', 'municipio as name')
							->where('id_estado', '=', $id_estado)
							->orderBy('name', 'asc')
							->get();

						$response = $data;
					}
					else{
						$response = array();
					}
				break;

				case 'parroquia':
					
					$id_municipio = Input::get('id_municipio');

					if($id_municipio){

						$data = DB::table('parroquias')
							->select('id_parroquia as value', 'parroquia as name')
							->where('id_municipio', '=', $id_municipio)
							->orderBy('name', 'asc')
							->get();

						$response = $data;	
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