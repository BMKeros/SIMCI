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
			        	<a class="item"><i class="settings icon"></i> Account Settings</a>
			      	</div>
			    </div>
    		</div>
		</div>
	</header>


	<div class="ui left vertical inverted labeled icon sidebar menu" id="menu-administracion">
		<a class="item" href="#/prueba">
  			<i class="home icon"></i>
  			Home
		</a>
	
		<a class="item">
  			<i class="block layout icon"></i>
  			Topics
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
			<div ng-view></div>
			</div>
		</div>
	</div>
	
	<!--<div class="ui cards">
  				<div class="card">
    				<div class="content">
      					<img class="right floated mini ui image" src="/images/avatar/large/elliot.jpg">
      					<div class="header">
        					Ver Usuarios
      					</div>
      					
      					<div class="meta">
        					Descripcion
      					</div>
      					
      					<div class="description">
        					Esta opcion podras ver todos los usuarios registrados en el sistema
      					</div>
    				</div>
    				
    				<div class="extra content">
      					<div class="ui two buttons">
        					<div class="ui basic green button">Approve</div>
      					</div>
    				</div>
  				</div>
  				</div>-->

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
