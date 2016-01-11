@extends('layouts.plantilla_master')

@section('titulo')
	<title>SIMCI</title>
@stop

@section('contenido-body')
	<header>
  		<div class="ui fixed menu">
    		<div class="ui container">
    			<a href="#" class="header item">
        			<img class="logo" src="/img/logo.png">
        			&nbsp;&nbsp;&nbsp;SIMCI
      			</a>
      			<div class="ui simple dropdown right item">
	        		{{ ucfirst(Auth::user()->usuario )}} <i class="dropdown icon"></i>
			        <div class="menu">
			        	<a class="item" href="#">Link Item</a>
			          	<a class="item" href="#">Link Item</a>
			          	<div class="divider"></div>
			          	<div class="header">Header Item</div>
			          	<div class="item">
			            	<i class="dropdown icon"></i>
			            	Sub Menu
			            	<div class="menu">
			              		<a class="item" href="#">Link Item</a>
			              		<a class="item" href="#">Link Item</a>
			            	</div>
			          	</div>
			          	<a class="item" href="#">Link Item</a>
			        </div>
		      	</div>
    		</div>
		</div>
	</header>
@show
