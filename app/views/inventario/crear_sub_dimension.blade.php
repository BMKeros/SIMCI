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

			<form class="ui form" id="reglas_formulario_registrar_sub_dimension">
				<h3 class="ui centered dividing header">Crear Sub dimension</h3>
				<br>
				<div class="field">
					<div class="fields">
						<div class="four wide field">
							<label>Codigo</label>
							<input type="text" name="codigo" placeholder="Codigo subdimencion" ng-model="DatosForm.codigo" ng-keyup="tools_input.upper($event)">
						</div>
					</div>
				</div>
				
				<br>

				<div class="field">
					<div class="fields">
						<div class="fourteen wide field">
							<label>Descripcion</label>
							<textarea name="descripcion" placeholder="Descripcion de sub dimencion" ng-model="DatosForm.sub_dimencion" rows="4"></textarea>
						</div>
					</div>
				</div>
				<div class="ui right floated submit big button green" ng-click="registrar_sub_dimension()" id="btn-registrar">Registrar</div>
			</form>
		</div>
	</div>
</div>