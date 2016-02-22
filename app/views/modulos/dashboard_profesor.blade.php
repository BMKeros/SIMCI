@extends('layouts.plantilla_master')

@section('titulo')
	<title>SIMCI - Profesor</title>
@stop

@section('contenido-body-master')
	
	<header>
  		<div class="ui fixed menu">
    		<div class="ui container">
    			<a class="item"  id="btn-abrir-menu">
					<i class="sidebar icon"></i>
    			</a>
    			<a href="#" class="header item">
        			<img class="logo" src="/img/logo.png">
        			&nbsp;&nbsp;&nbsp;SIMCI
      			</a>
      			
      			<div class="right menu">
      				
      				<div class="ui pointing dropdown link item">
    					Notificaciones
    					<div class="ui red label">22</div>
    					<i class="dropdown icon"></i>
    					<div class="menu">
      						<div class="header">Novedades</div>
				          	<a class="item">Shirts</a>
				          	<a class="item">Pants</a>
				          	<a class="item">Jeans</a>
				        </div>
      				</div>

      				<div class="ui dropdown item">
      					<img class="ui right spaced avatar image" src="{{ Auth::user()->get_avatar() }}">
						Usuario
    					<i class="dropdown icon"></i>
    					<div class="menu">
      						<div class="item">
        						<div class="ui card">
  									<div class="image">
    									<img src="{{ Auth::user()->imagen }}">
  									</div>
  									<div class="content">
    									<a class="header">{{ ucfirst(Auth::user()->usuario) }}</a>
    									<div class="meta">
      										<span class="date">Tipo: {{ Auth::user()->nombre_tipo_usuario() }}</span>
    									</div>
    									<div class="description">
      										{{ Auth::user()->nombre_corto()}}
    									</div>
  									</div>
  									<div class="extra content">
    									<a href="/autenticacion/logout"><i class="settings icon"></i>Salir</a>
  									</div>
								</div>
      						</div>
      					</div>
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

		<a class="item" ng-href="#/laboratorio">
	      	<i class="lab icon"></i>
	      	Laboratorios
    	</a>

    	<a class="item" ng-href="#/inventario">
  			<i class="archive icon"></i>
  			Inventario
		</a>

		<a class="item" ng-href="#/catalogo">
  			<i class="book icon"></i>
  			Catalogo
		</a>
	
		<a class="item" ng-href="#/ordenes">
  			<i class="edit icon"></i>
  			Ordenes
		</a>
	
    	<a class="item" ng-href="#/reporte">
	      	<i class="file text outline icon"></i>
	      	Reportes
    	</a>

		<a class="item" ng-href="#/documentos">
	      	<i class="travel icon"></i>
	      	Documentos
    	</a>

    	<a class="item" ng-href="#/consulta">
  			<i class="call icon"></i>
  			Consultas
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
	
	<div class="ui container espacio_buttom">
		<div ng-view>
			<!--<div class="ui container">
			  <div class="ui active inverted dimmer">
			    <div class="ui large text loader">Cargando</div>
			  </div>
			</div>-->
		</div>
	</div>
	
	<div class="ui bottom fixed menu barra_inferior">
	  	<div class="item right">
	  		<a class="ui teal tag label">
	  			<span id="reloj">0:00:00</span>
	  		</a>
		</div>
	</div>
  	
@stop

@section('js')
	<script>
		$(document).ready(function(){

			$("#btn-abrir-menu").click(function(){
		    	$('#menu-administracion')
		    	.sidebar({
		    		transition:'overlay',
		    		dimPage: false,
		    		context: 'body',
		    	})
		    	.sidebar('toggle');
		  	});

		  	$('.ui.dropdown').dropdown({
		  		transition: 'drop'
		  	});
		});
	</script>
@stop
	