<?php

class ModulosController extends Controller {

	public function __construct(){
        $this->beforeFilter('guest', array('except' => ''));
	}

	public function getAdministracion(){
		return "Modulo administracion";
	}

	public function getProfesores(){
		return "Modulo administracion";
	}

	public function getEstudiantes(){
		return "Modulo usurios";
	}
}