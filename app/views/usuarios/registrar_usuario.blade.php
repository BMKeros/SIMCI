@extends('layouts.estudiante_base')
	@section('barra-usuarios')
	@parent
		<div class="ui ten column doubling stackable grid container">
			<div class="ui one column centered grid">
				<div class="ten wide column">
				<div class="column"> </div>
					<form class="ui form" id="formulario-registro-usuario">
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
								<input type="text" placeholder="Clave" id="clave" name="clave">
								<i class="hide icon"></i>
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

						<button class="short ui right floated blue submit button"  id="btn-inicio-sesion"><i class="checkmark icon"></i>Registrar</button>
			    	</form>
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