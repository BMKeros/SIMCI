<?php
//comentario de prueba

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
	
	/**
	+Funcion para obtener la data del usuario logueado 
	+para luego enviarla a las vistas como json
	*/
	protected function get_data_usuario(){
		return json_encode(
			array(
				'id_usuario'=> Auth::id(),
				'usuario'=> Auth::user()->usuario,
				'email' => Auth::user()->email,
				'tipo_usuario' => Auth::user()->cod_tipo_usuario,
			)
		);
	}

	/**
	+Funcion para el response para las datatables
	+param [1] = tabla
	+param [2] = extras
	*/
	protected function generar_paginacion_dinamica($consulta = null, $extras = array('campo_where' => '', 'campo_orden' => 'id', 'especial' => '')){

		$length = Input::get('length', 10);
		$value_search = Input::get('search');
		$pagina = Input::get('page', 1);
		$draw = Input::get('draw',1);
		$start = Input::get('start', 0);
		$orden = Input::get('ordenar','asc');

		$current_page = ceil($start/$length)+1;
		
		Paginator::setCurrentPage($current_page);
		

		if(quitar_espacios($value_search['value']) == ''){
			$data = $consulta->orderBy($extras['campo_orden'],$orden)->paginate($length);	
		}
		else{
			$data = $consulta->where($extras['campo_where'],'ILIKE','%'.$value_search['value'].'%')
			->orderBy($extras['campo_orden'],$orden)
			->paginate($length);	
		}
		
		$response = array(
			"draw"=>$draw,
			"page"=>$data->getCurrentPage(),
			"recordsTotal"=>$data->getTotal(),
			"recordsFiltered"=> $data->getTotal(),
			"data" => $data->all()
		);

		return $response;
	}

}
