<?php  

	class PedidosController extends BaseController{

		public function getMostrar(){
			$type = Input::get('type', 'todos');
			$tipo_movimiento = Input::get('cod_tipo_movimiento', null);
			
			switch($type){
				case 'todos':
					$data = DB::table('vista_pedidos_full')->get();

					$response = array('resultado' => true, 'data' => $data);
									
				break;

				default:
					$response = array();
				break;
			}

			return Response::json(array('resultado' => true, 'data' => $response));

		}


		public function postRegistrarElemento(){
			$cod_dimension = Input::get('cod_dimension');
			$cod_subdimension = Input::get('cod_subdimension');
			$cod_agrupacion = Input::get('cod_agrupacion');
			$cod_objeto = Input::get('cod_objeto');
			$numero_orden = Input::get('numero_orden');

			$cantidad_disponible = Input::get('cantidad_disponible');
			$cantidad_solicitada = Input::get('cantidad_solicitada');
			$cod_referencia = Input::get('cod_referencia');
			$cod_tipo_movimiento = Input::get('cod_tipo_movimiento');

			$reglas = array(
				'cod_dimension' => 'required|unique:elementos_disponibles', 
				'cod_subdimension' => 'required|unique:elementos_disponibles',
				'cod_agrupacion' => 'required|unique:elementos_disponibles',
				'cod_objeto' => 'required|unique:elementos_disponibles',
				'numero_orden' => 'required',
				'cantidad_disponible' => 'required|numeric',
				'cantidad_solicitada' => 'required| numeric',
				'cod_referencia' => 'required|alpha_num',
				'cod_tipo_movimiento' => 'required|alpha_num'
			);

			$campos = array(
				'cod_dimension' => $cod_dimension,
				'cod_subdimension' => $cod_subdimension,
				'cod_agrupacion' => $cod_agrupacion,
				'cod_objeto' => $cod_objeto,
				'numero_orden' => $numero_orden,
				'cantidad_disponible' => $cantidad_disponible,
				'cantidad_solicitada' => $cantidad_solicitada,
				'cod_referencia' => $cod_referencia,
				'cod_tipo_movimiento' => $cod_tipo_movimiento,
			);

			$mensajes = array(
				'required' => 'El campo :attribute es necesario',
				'alpha_num' => ':attribute debe ser alfanumerico',
				'numeric' => 'El :attribute debe ser solo numeros',
				'unique' => 'Este :attribute ya existe'
			);

			$validacion = Validator::make($campos, $reglas, $mensajes);

			if($validacion->fails()){
				return Response::json(array('resultado' => false, 'mensajes' => $validacion->messages()->all()));
			}
			else{
				$pedido = new Pedido;

				$pedido->cod_dimension = $cod_dimension;
				$pedido->cod_subdimension = $cod_subdimension;
				$pedido->cod_agrupacion = $cod_agrupacion;
				$pedido->cod_objeto = $cod_objeto;
				$pedido->numero_orden = $numero_orden;
				$pedido->cantidad_disponible= $cantidad_disponible;
				$pedido->cantidad_solicitada = $cantidad_solicitada;
				$pedido->cod_referencia = $cod_referencia;
				$pedido->cod_tipo_movimiento = $cod_tipo_movimiento;

				$pedido->save();

				return Response::json(array('resultado' => true, 'mensajes' => 'Nuevo pedido generado con exito.'));
			}
		}
	}

?>