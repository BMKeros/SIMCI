<?php  
	class ReportesController extends Controller {

		public function getMostrar()
	    {

	        $tipo_busqueda = Input::get('type', 'todos');
	        $orden = Input::get('ordenar', 'asc');

	        switch ($tipo_busqueda) {

	            case 'reporte':
	                $reporte_id = Input::get('id', null);
	                
	                if (!is_null($reporte_id)) {

	                    $data = DB::table('reportes')
							->select('titulo', 'cosulta')
	                        ->orderBy('id', $orden)
	                        ->where('id', '=', $reporte_id)
	                        ->first();

	                    $response = $data;
	                } else {
	                    $response = array();
	                }
	                break;

	            case 'paginacion':

	                $consulta = DB::table('reportes')
	                    ->select('titulo', 'consulta');

	                $response = $this->generar_paginacion_dinamica($consulta,
	                    array('campo_where' => 'titulo', 'campo_orden' => 'titulo'));

	                break;

	            default:
	                $response = array();
	                break;
	        }

	        return Response::json($response);
	    }

		public function postRegistrarReporte(){

			$titulo = Input::get('titulo', null);
			$consulta = Input::get('consulta', null);

			$reglas = array(
	        	'titulo' => 'required|alpha_num|unique:consultas',
	        	'consulta' => 'required|alpha_num|unique:consultas',
	        );

	        $campos = array(
	            'titulo' => $titulo,
	            'consulta' => $consulta,
	        );

	        $mensajes = array(
	            'required' => 'El campo :attribute es necesario',
	            'alpha_num' => 'El campo :attribute debe contener caracteres alfanumericos',
	            'unique' => 'El :attribute ya fue asignado a otra consulta',
	        );


	        $validacion = Validator::make($campos, $reglas, $mensajes);

	        if ($validacion->fails()) {
	            return Response::json(array('resultado' => false, 'mensajes' => $validacion->messages()->all()));
	        } else {
	        	$consulta = new Consulta;
	            $consulta->titulo = $titulo;
	            $consulta->consulta = $consulta;

	            $consulta->save();

	            return Response::json(array('resultado' => true, 'mensajes' => 'Consulta creada con exito'));
	        }
		}
	}
?>