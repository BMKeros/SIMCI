@extends('layouts.plantilla_master')

@section('titulo')
	<title>SIMCI - Administracion</title>
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
      				<!--
      				<div class="ui pointing dropdown link item">
    					Notificaciones
    					<div class="ui red label" id="label_num_notificaciones">0</div>
    					<i class="dropdown icon"></i>
    					<div class="menu">
      						<div class="header">Novedades</div>
				          	<a class="item">Shirts</a>
				          	<a class="item">Pants</a>
				          	<a class="item">Jeans</a>
				        </div>
      				</div>-->

      				<!-- Asi funciona, pero como no es buena practica (blablabla) tener los estilos aui los podes mandar a la hoja de estilos xD L tai jodiendo xDlkslaklskl-->
      				
      				<div class="ui pointing dropdown link item" tabindex="0"> 
					  	<span class="text">Shopping</span> 
					  	<i class="dropdown icon"></i>
					    <div class="menu transition hidden" tabindex="-1" style="width: 400px; margin-left: -150px;">
					        <div class="header">Events</div>
					        <div class="right" style=" float: right; margin-top: -25px; margin-right: 10px; ">Create / Edit</div>
					        <div class="divider"></div>
					        
					<div class="item"> <img class="ui avatar" src="http://simci.tl/img/perfil-default.jpg" style=" width: 60px; max-height: 140px; "> <span style="display: inline-block;">User<br>Hola</span> <div style="float: right; top: 20px; position: relative">05/04/2016</div></div><div class="item" style="
					    /* padding-bottom: 10px !important; */
					"> <img class="ui avatar" src="http://simci.tl/img/perfil-default.jpg" style=" width: 60px; max-height: 140px; "> <span style="display: inline-block;padding-bottom: 25px;">User<br>Hola</span> <div style="float: right; top: 20px; position: relative">05/04/2016</div></div>
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
	
		<a class="item" ng-href="#/usuarios">
  			<i class="user layout icon"></i>
  			Usuarios
		</a>
	
		<a class="item" ng-href="#/catalogo">
  			<i class="book icon"></i>
  			Catalogo
		</a>

		<a class="item" ng-href="#/inventario">
  			<i class="archive icon"></i>
  			Inventario
		</a>	

		<a class="item" ng-href="#/proveedores">
  			<i class="shop icon"></i>
  			Proveedor
		</a>
		
		<a class="item" ng-href="#/laboratorio">
  			<i class="lab icon"></i>
  			Laboratorio
		</a>
	
	   	<a class="item" ng-href="#/ordenes">
  			<i class="edit icon"></i>
  			Ordenes
		</a>
	
    	<a class="item" ng-href="#/reportes">
	      	<i class="file text outline icon"></i>
	      	Reportes
    	</a>
	
    	<a class="item" ng-href="#/documentos">
	      	<i class="travel icon"></i>
	      	Documentos
    	</a>

    	<a class="item" ng-href="#/consulta">
  			<i class="search icon"></i>
  			Consultas
		</a>
		
    	<a class="item">
	      	<i class="settings icon"></i>
	      	Settings
    	</a>
	</div>
	
	<div class="ui container espacio_buttom espacio_top">
		<div ng-view></div>
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

			$('#contenedorPadre').addClass('backgroundPadre');

			$("#btn-abrir-menu").click(function(){
		    	$('#menu-administracion')
		    	.sidebar({
		    		transition:'overlay',
		    		dimPage: true,
		    		context: $('body'),
		    	})
		    	.sidebar('toggle');
		  	});

		  	$('.ui.dropdown').dropdown({
		  		transition: 'drop'
		  	});
		});
	</script>
@stop
