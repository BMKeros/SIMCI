<?php

class BusquedasController extends Controller {
	
	public function __construct(){
        $this->beforeFilter('guest', array('except' => ''));
	}

}