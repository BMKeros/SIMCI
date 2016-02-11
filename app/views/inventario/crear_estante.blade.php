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

			<form class="ui form" id="formulario_crear_estante">
				<h3 class="ui centered dividing header">Crear Estante</h3>
				<br>
				<div class="field">
					<div class="two fields">
						<div class="field">
							<label>Codigo del Estante</label>
							<input type="text" name="cod_estante" placeholder="Codigo del Estante" ng-model="DatosForm.cod_estante">
						</div>
					</div>
				</div>
				
				<br>

				<div class="field">
					<div class="two fields">
						<div class="field">
							<label>Descripcion del Estante</label>
							<textarea name="descripcion" placeholder="Descripcion del Estante" ng-model="DatosForm.descripcion"></textarea>
						</div>
					</div>
				</div>
				<div class="ui right floated submit big button green" ng-click="registrar_estante()" id="btn-registrar">Registrar</div>
			</form>
		</div>
	</div>
</div>