<?php

class ModulosController extends Controller {

	public function __construct(){
       $this->beforeFilter('CheckGuest', array('except' => ''));
	}
	protected function get_data_usuario(){
		return json_encode(
			array(
				'id_usuario'=> Auth::id(),
				'usuario'=> Auth::user()->usuario,
				'email' => Auth::user()->email,
				'tipo_usuario' => Auth::user()->cod_tipo_usuario
			)
		);
	}

	public function getAdministracion(){
		$data = $this->get_data_usuario();
		return View::make('modulos.dashboard_administracion')->with('data_usuario',$data);
	}

	public function getProfesores(){
		$data = $this->get_data_usuario();
		return View::make('modulos.dashboard_profesor')->with('data_usuario',$data);
	}

	public function getEstudiantes(){
		$data = $this->get_data_usuario();
		return View::make('modulos.dashboard_estudiante')->with('data_usuario',$data);
	}

	public function getAlmacenista(){
		$data = $this->get_data_usuario();
		return View::make('modulos.dashboard_almacenista')->with('data_usuario',$data);
	}

	public function getSupervisor(){
		$data = $this->get_data_usuario();
		return View::make('modulos.dashboard_supervisor')->with('data_usuario',$data);
	}
}