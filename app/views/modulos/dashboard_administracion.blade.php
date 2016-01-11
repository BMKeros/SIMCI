@extends('layouts.plantilla_base_modulos')

@section('titulo')
	<title>SIMCI - Administracion</title>
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
			      {{ ucfirst(Auth::user()->usuario )}}
			     	<i class="dropdown icon"></i>
			      	<div class="menu">
			        	<a class="item"><i class="edit icon"></i> Edit Profile</a>
			        	<a class="item"><i class="globe icon"></i> Choose Language</a>
			        	<a class="item" href="/autenticacion/logout"><i class="settings icon"></i>Salir</a>
			      	</div>
			    </div>
    		</div>
		</div>
	</header>


	<div class="ui left vertical inverted labeled icon sidebar menu" id="menu-administracion">
		<a class="item" href="#">
  			<i class="home icon"></i>
  			Inicio
		</a>
	
		<a class="item" ng-href="#/usuarios">
  			<i class="user layout icon"></i>
  			Usuarios
		</a>
	
		<a class="item">
  			<i class="smile icon"></i>
  			Friends
		</a>	
	
		<a class="item">
  			<i class="calendar icon"></i>
  			History
		</a>
	
	   		<a class="item">
  			<i class="mail icon"></i>
  			Messages
		</a>
	
		<a class="item">
  			<i class="chat icon"></i>
  			Discussions
		</a>
	
    	<a class="item">
	      	<i class="trophy icon"></i>
	      	Achievements
    	</a>
	
    	<a class="item">
	      	<i class="shop icon"></i>
	      	Store
    	</a>
	
    	<a class="item">
	      	<i class="settings icon"></i>
	      	Settings
    	</a>
	</div>

	<!-- Boton para abrir el menu -->
	<div class="ui animated fade big launch button" id="btn-abrir-menu">
		<div class="hidden content">
			Menu
		</div>
		<div class="visible content">
			<i class="sidebar icon"></i>
		</div>
	</div>
	
	<div class="ui container">
		<div class="ui one column grid">
			<div class="column">
				<div ng-view>
					<div class="ui container">
					  <div class="ui active inverted dimmer">
					    <div class="ui large text loader">Cargando</div>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
  	<footer>
  		<div class="ui bottom fixed menu barra_inferior">
		  	<div class="item right">
		  		<a class="ui teal tag label">
		  			<span id="reloj">0:00:00</span>
		  		</a>
			</div>
		</div>
  	</footer>
	
@stop

@section('js')
	<script>
		$(document).ready(function(){

			$("#btn-abrir-menu").click(function(){
		    	$('#menu-administracion')
		    	.sidebar({
		    		transition:'overlay',
		    		dimPage: false,
		    	})
		    	.sidebar('toggle');
		  	});
		});
	</script>
@stop