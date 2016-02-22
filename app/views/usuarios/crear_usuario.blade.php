<div class="ui centered grid espacio_buttom4">
	<div class="six wide tablet twelve wide computer column">
		<div class="ui form">

			<div ng-if="mostrar_mensaje">
				<div class="ui icon <% mensaje_validacion.color %> message">
					<i class="<% mensaje_validacion.icono %> icon"></i>
					<div class="content">
						<div class="header"><% mensaje_validacion.titulo %></div>
						<ul class="list">
							<li ng-repeat=" mensaje in mensaje_validacion.mensajes track by $index"><% mensaje | capitalize %></li>
						</ul>
					</div>
				</div>
				<br>
			</div>
			
			<form class="ui form" id="formulario_crear_usuario">
				<h3 class="ui centered dividing header">Datos de Usuario</h3>
				
				<div class="field">
					<div class="two fields">
						<div class="field">
							<label>Usuario</label>
			        		<input type="text" name="usuario" placeholder="Usuario" ng-model="DatosForm.usuario">
			        	</div>
			     		<div class="field">
			     			<label>Email</label>
							<input type="text" name="email" placeholder="Direccion Email" ng-model="DatosForm.email">
						</div>
				    </div>
				</div>

				<div class="field">
				    <div class="two fields">
						<div class="field">
							<label>Password</label>	
				        	<input type="password" name="password" placeholder="Password" ng-model="DatosForm.password">
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
							<label>Permisos</label>
					      	{{Form::select_permisos(array('name' => 'permisos', 'id' => 'permisos','ng-model'=>'DatosForm.permisos'))}}
						</div>

						<div class="field">
							<label>Tipo de usuario</label>
					      	{{Form::select_tipo_usuario(array('id' => 'tipo_usuario', 'name' => 'tipo_usuario', 'ng-model'=>'DatosForm.tipo_usuario'))}}
						</div>
					</div>
				</div>

				<div class="field">
					<div class="ui toggle checkbox">
						<label>Usuario activo</label>
						<input type="checkbox" name="activo" ng-model="DatosForm.activo" ng-init="DatosForm.activo = true">
					</div>
				</div>

				<div class="field">
					<input type="file" name="imagen" placeholder="" ng-model-file="DatosForm.imagen">
				</div>

				<br>
				<h3 class="ui centered dividing header">Datos Personales</h3>
				
				<h4 class="ui dividing header">Nombre completo</h4>
				
				<div class="field">
				    <div class="two fields">
				      	<div class="field">
				        	<input type="text" name="primer_nombre" placeholder="Primer Nombre" ng-model="DatosForm.primer_nombre">
				      	</div>
				      	<div class="field">
							<input type="text" name="segundo_nombre" placeholder="Segundo Nombre" ng-model="DatosForm.segundo_nombre">
						</div>
					</div>
				</div>

				<div class="field">
				    <div class="two fields">
						<div class="field">	
				        	<input type="text" name="primer_apellido" placeholder="Primer Apellido" ng-model="DatosForm.primer_apellido">
				        </div>

				      	<div class="field">
				        	<input type="text" name="segundo_apellido" placeholder="Segundo Apellido" ng-model="DatosForm.segundo_apellido">
				      	</div>
					</div>
				</div>

				<div class="field">
					<div class="three fields">
						<div class="field">
							<label>Cedula</label>
							<input type="text" name="cedula" placeholder="Cedula" ng-model="DatosForm.cedula">
						</div>

						<div class="field">
							<label>Fecha de nacimiento</label>
							<input type="text" name="fecha_nacimiento" id="fecha_nacimiento" placeholder="Fecha Nacimieto" ng-model="DatosForm.fecha_nacimiento">
						</div>

						<div class="field">
							<label>Sexo</label>
							{{Form::select_sexo(array('id' => 'sexo', 'name' => 'sexo','ng-model'=>'DatosForm.sexo'))}}
						</div>
					</div>
				</div>					
				<br>
				<div class="field">
					<div class="big positive ui right floated button" ng-click="registrar_usuario()" id="btn-registrar">Registrar</div>
				</div>
			</form>
		</div>
	</div>
</div>


<script>    
	$('.ui.dropdown').dropdown({
    	maxSelections: 3
  	});
  	$('.checkbox').checkbox();

  	var picker = new Pikaday({ 
		field: document.getElementById('fecha_nacimiento'),
		i18n: TOOLS_APP.lenguaje_pikaday,
	});
</script>
