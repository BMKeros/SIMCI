<div class="ui centered grid">
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
			
			<form class="ui form" id="formulario_crear_permisos_usuarios">
				<h3 class="ui centered dividing header">Crear Tipo de Usuario</h3>

				<div class="field">
					<div class="six wide field">
						<div class="field">
							<label>Codigo</label>
			        		<input type="text" name="tipo_usuario" value="" placeholder="Tipo de Usuario">
			        	</div>
			        </div>
		        </div>

		        <div class="field">
		        	<div class="nine wide field ui form">
					  	<div class="field">
					    	<label>Descripcion</label>
					    		<textarea placeholder="Descripcion"></textarea>
					  	</div>
					</div>
		        </div>
	        <div class="ui big right floated submit button blue" ng-click="registrar_objeto()" id="btn-registrar"> Registrar
			</div>
			</form>
		</div>
	</div>
</div>
	