@extends('layouts.plantilla_master')


@section('titulo')
	<title>SIMCI</title>
@stop
		
@section('css')
	<link rel="stylesheet" type="text/css" href="/css/formulario_inicio_sesion.css">
@stop
	

@section('contenido-body-master')
	
	<div class="ui fixed menu">
	    <div class="ui container">
	    	<a href="#" class="header item">
	        	<img class="logo" src="/img/logo.png">
	        	&nbsp;&nbsp;&nbsp;SIMCI
	      	</a>
	    </div>
  	</div>
	

	<div class="ui two column doubling stackable grid container">
		<div class="ui one column centered grid">
			<div class="column">
				<div class="formulario" id="inicio_sesion">
			    	<div class="ten wide column">
					  	<div class="column">
					  		<div class="ui blue message">
					  			<div align="center"><p style="font-size:18px">Inicio Sesion</p></div>
					  		</div>

				  			@if(Session::has('mensaje_error'))
				  				<div class="ui error message" align="center"><i class=" remove circle outline icon"></i>{{Session::get('mensaje_error')}}</div>
				  			@elseif(Session::has('mensaje_exito'))
				  				<div class="ui positive message" align="center"><i class="check icon"></i>{{Session::get('mensaje_exito')}}</div>
				  			@elseif(Session::has('mensaje_alerta'))
								<div class="ui warning message" align="center"><i class="warning sign icon"></i>{{Session::get('mensaje_alerta')}}</div>
				  			@endif
					  		

		   			    	<form class="ui large form" id="form-inicio-sesion" action="/autenticacion/login" method="POST">
					      		<div class="field">
					        		<label>Usuario</label>
					        		<div class="ui left icon input">
					          			<input type="text" placeholder="Usuario" id="usuario-login" name="usuario">
					          			<i class="user icon"></i>
					        		</div>
					      		</div>
					      	
						      	<div class="field">
						        	<label>Password</label>
						        	<div class="ui left icon input">
						          		<input type="password" placeholder="Password" id="password-login" name="password">
						          		<i class="lock icon"></i>
						        	</div>
						      	</div>


  								<button class="large ui right floated blue submit button"  id="btn-inicio-sesion"><i class="sign in icon"></i>Iniciar Sesion</button>
  									
  								<div class="large ui right floated submit buttonui reset button"> <i class=" trash outline icon"></i>
  								Limpiar</div>

					      		<div class="ui error message"></div>
					    	</form>
					 	</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop


@section('js')
	<script src="/js/scripts_formularios.js"></script>

	<script>
		$(document).ready(function(){
			$('.ui.form').form(reglas_formulario_login);
		});
	</script>
@stop