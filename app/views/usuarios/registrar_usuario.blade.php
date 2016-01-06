@extends('layouts.plantilla_usuarios_base')
	@section('barra-usuarios')
	@parent
		<div class="ui two column doubling stackable grid container">
			<div class="ui one column centered grid">
				<div class="column">
					<div class="formulario" id="inicio_sesion">
				    	<div class="ten wide column">
						  	<div class="column">

			   			    	<form class="ui form" id="form-inicio-sesion" action="/autenticacion/login" method="POST">
							      	<div class="field">
						        		<div class="ui left icon input">
						          			<input type="text" placeholder="Usuario" id="usuario" name="usuario">
						          			<i class="user icon"></i>
						        		</div>
					      			</div>

							      	<div class="field">
						        		<div class="ui left icon input">
						          			<input type="text" placeholder="Email" id="email" name="usuario">
						          			<i class="mail square icon"></i>
						        		</div>
					      			</div>
					      	
							      	<div class="field">
							        	<div class="ui left icon input">
							          		<input type="Password" placeholder="Password" id="password" name="password">
							          		<i class="lock icon"></i>
							        	</div>
							      	</div>

							      	<div class="field">
							        	<div class="ui left icon input">
							          		<input type="password" placeholder="Confirmar Password" id="confirmar-password" name="password">
							          		<i class="lock icon"></i>
							        	</div>
							      	</div>
							    </form>
						  	</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endsection
	
	<script src="js/jquery.min.js"></script>
	<script src="js/scripts_plantilla_usuario.js"></script>
	<script src="semantic/semantic.min.js"></script>	
	@section('js')
	@stop