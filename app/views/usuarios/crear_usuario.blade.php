<div class="ui centered grid espacio_buttom4">
	<div class="six wide tablet twelve wide computer column">
		<div class="ui form">
			<form class="ui form" id="formulario_crear_usuario">
				<h3 class="ui dividing header">Datos de usuario</h3>
				
				<div class="field">
					<div class="two fields">
						<div class="field">
							<label>Usuario</label>
			        		<input type="text" name="usuario[usuario]" placeholder="Usuario" ng-model="DatosForm.usuario.usuario">
			        	</div>
			     		<div class="field">
			     			<label>Email</label>
							<input type="text" name="usuario[email]" placeholder="Direccion Email" ng-model="DatosForm.usuario.email">
						</div>
				    </div>
				</div>

				<div class="field">
				    <div class="two fields">
						<div class="field">
							<label>Password</label>	
				        	<input type="password" name="password" placeholder="Password" ng-model="DatosForm.usuario.password">
				        </div>

				      	<div class="field">
				      		<label>Confirmar Password</label>	
				        	<input type="password" name="password_confirmacion" placeholder="Confirmar Password">
				      	</div>
				    </div>
				</div>

				<div class="field">
					<div class="two fields">
						<div class="field">
					      	{{Form::select_permisos(array('name' => 'permisos', 'id' => 'permisos'))}}
						</div>

						<div class="field">
					      	{{Form::select_tipo_usuario(array('id' => 'tipo_usuario', 'name' => 'tipo_usuario'))}}
						</div>
					</div>
				</div>

				<div class="field">
					<div class="ui toggle checkbox">
						<label>Usuario activo</label>
						<input type="checkbox" name="public">
					</div>
				</div>

				<div class="field">
					<input type="file" name="imagen" placeholder="">
				</div>

				<br>
				<h3 class="ui dividing header">Datos Personales</h3>
				
				<h4 class="ui dividing header">Nombre completo</h4>
				
				<div class="field">
				    <div class="two fields">
				      	<div class="field">
				        	<input type="text" name="primer_nombre" placeholder="Primer Nombre" ng-model="DatosForm.persona.primer_nombre">
				      	</div>
				      	<div class="field">
							<input type="text" name="segundo_nombre" placeholder="Segundo Nombre" ng-model="DatosForm.persona.segundo_nombre">
						</div>
					</div>
				</div>

				<div class="field">
				    <div class="two fields">
						<div class="field">	
				        	<input type="text" name="primer_apellido" placeholder="Primer Apellido" ng-model="DatosForm.persona.primer_apellido">
				        </div>

				      	<div class="field">
				        	<input type="text" name="segundo_apellido" placeholder="Segundo Apellido" ng-model="DatosForm.persona.segundo_apellido">
				      	</div>
					</div>
				</div>

				<div class="field">
					<div class="two fields">
						<div class="field">
							<label>Cedula</label>
							<input type="text" name="cedula" placeholder="Cedula" ng-model="DatosForm.persona.cedula">
						</div>

						<div class="field">
							<label>Fecha de nacimiento</label>
							<input type="date" name="fecha_nacimiento" placeholder="Fecha Nacimieto" ng-model="DatosForm.persona.fecha_nacimiento">
						</div>
					</div>
				</div>
										
				<div class="field">
					<div class="fields">
						<div class="field">
							{{Form::select_sexo(array('id' => 'sexo', 'name' => 'sexo'))}}
						</div>
					</div>
				</div>
				
				<div class="field">
					<button class="positive ui button">Positive Button</button>
				</div>
			</form>
		</div>
	</div>
</div>



<script>

	$('#formulario_crear_usuario').form(reglas_formulario_crear_usuario);

	$('.ui.dropdown').dropdown({
    	maxSelections: 3
  	});
</script>

