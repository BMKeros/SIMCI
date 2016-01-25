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
				<h3 class="ui centered dividing header">Crear Permisos</h3>

				<div class="field centered grid">
					<div class="two fields">
						<div class="field">
							<label>Permisos del Usuario</label>
							<input type="text" name="permiso"placeholder="Nombre del Permiso">
			        		
			        	</div>
			        	<div class="field">
				      		<label>Codigo</label>	
				        	<input type="text" name="cod_permiso" placeholder="Codigo del Permiso">
				      	</div>
				    </div>

				    <div class="field">
				    	<label>Descripcion de Permiso</label>
				    	<textarea "ng-modal Datos.Form.Descripcion" placeholder="Descripcion de Permiso"></textarea>
				    </div>
				</div>

				<div class="ui big right floated submit button green" ng-click="registrar_objeto()" id="btn-registrar"> Registrar
				</div>
			</form>
		</div>
	</div>
</div>