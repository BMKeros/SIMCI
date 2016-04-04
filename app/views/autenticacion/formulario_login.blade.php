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

			<div class="ui grid centered" style="padding-top:25%">
				<div class="eight column row">
					<div class="column">
		      			<a target="_blank" href="https://php.net" class="header item">
				        	<img src="/img/PHP2.png" width="30" height="30">
				      	</a>
					</div>

					<div class="column">
						<a target="_blank" href="http://www.w3schools.com/html/html5_intro.asp" class="header item">
				        	<img src="/img/HTML5.png" width="30" height="30">
						</a> 
					</div>
					
					
					<div class="column">
		      			<a target="_blank" href="https://laravel.com" class="header item">
				        	<img src="/img/Laravel3.png" width="30" height="30">
				      	</a>
					</div>

					<div class="column">
						<a target="_blank" href="https://angularjs.org" class="header item">
							<img src="/img/angular2.png" width="30" height="30">
						</a>
					</div>

					<div class="column">
						<a target="_blank" href="https://semantic-ui.com" class="header item">
				        	<img src="/img/semantic.png" width="30" height="30">
				      	</a>
					</div>

					<div class="column">
		      			<a target="_blank" href="http://www.w3schools.com/css/default.asp" class="header item">
				        	<img src="/img/CSS.png" width="30" height="30">
				      	</a>
			      	</div>

			      	<div class="column">
		      			<a target="_blank" href="https://es.opensuse.org/openSUSE:Licencia" class="header item">
				        	<img src="/img/Source2.png" width="30" height="30">
				      	</a>
			      	</div>
				</div>
			</div>

			<div class=" ui grid centered">
				<small>Sistema Integrado para el Manego y Control de Inventario | Bajo la Licencia MIT | Derechos Reservados</small>
			</div>

			<div class="ui grid centered">
				<small> <b>SIMCI v1.0 | 2016</small>
			</div>
			
		</div>
	</div>

@stop


@section('js')
	<script>
		$(document).ready(function(){
			$('.ui.form').form(reglas_formulario_login);
		});
	</script>
@stop