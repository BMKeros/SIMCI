<?php

class ModulosController extends Controller {

	public function __construct(){
       $this->beforeFilter('CheckGuest', array('except' => ''));
	}

	public function getAdministracion(){
		return View::make('modulos.dashboard_administracion');
	}

	public function getProfesores(){
		return View::make('modulos.dashboard_profesor');
	}

	public function getEstudiantes(){
		return View::make('modulos.dashboard_estudiante');
	}

	public function getAlmacenistas(){
		return View::make('modulos.dashboard_almacenista');
	}

	public function getSupervisor(){
		return View::make('modulos.dashboard_supervisor');
	}
}