<?php

class ModulosController extends Controller {

	public function __construct(){
        $this->beforeFilter('guest', array('except' => ''));
	}

	public function getAdministracion(){
		return View::make('modulos.dashboard_administracion');
	}

	public function getProfesores(){
		return Vien::make('modulos.dashboard_profesor');
	}

	public function getEstudiantes(){
		return Vien::make('modulos.dashboard_estudiante');
	}
}