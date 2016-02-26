<?php  
	class ConsultasController extends Controller {
		//falta colocar aquji las funciones respectivas

		public function getMostrar(){

			$tipo_busqueda = Input::get('type', 'estado');

			switch($tipo_busqueda){
				case 'estado':
					$data = DB::table('estados')
						->select('id_estado', 'estado')
						->get();

					$response = array("success"=>true, "results" => $data);
					
				break;

				case 'ciudad':
					$id_estado = Input::get('id_estado');

					if($id_estado){

						$data = DB::table('ciudades')
							->select('id_ciudad', 'ciudad')
							->where('id_estado', '=', $id_estado)
							->get();
						
						$response = array("success"=>true, "results" => $data);

						if(is_null($data)){
							$response = array("success" => false, 'results' => array());
						}
					}
					else{
						$response = array("success" => false, 'results' => array());
					}
				break;

				case 'municipio':
					
					$id_estado = Input::get('id_estado');

					if($id_estado){

						$data = DB::table('municipios')
							->select('id_municipio', 'municipio')
							->where('id_estado', '=', $id_estado)
							->get();

						$response = array("success"=>true, "results" => $data);
							

						if(is_null($response)){
							$response = array("success" => false, 'results' => array());
						}
					}
					else{
						$response = array("success" => false, 'results' => array());
					}
				break;

				case 'parroquia':
					
					$id_municipio = Input::get('id_municipio');

					if($id_municipio){

						$data = DB::table('parroquias')
							->select('id_parroquia', 'parroquia')
							->where('id_municipio', '=', $id_municipio)
							->get();

						$response = array("success"=>true, "results" => $data);	

						if(is_null($response)){
							$response = array("success" => false, 'results' => array());
						}
					}
					else{
						$response = array("success" => false, 'results' => array());
					}
				break;
			}

			return Response::json($response);
		}
	
	}

?>