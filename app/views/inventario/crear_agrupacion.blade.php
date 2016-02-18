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

			<form class="ui form" id="reglas_formulario_registrar_agrupacion">
				<h3 class="ui centered dividing header">Agrupacion</h3>
				<br>
				<div class="field">
					<div class="two fields">
						<div class="field">
							<label>Nombre</label>
							<input type="text" name="nombre" placeholder="Nombre de la agrupacion" ng-model="DatosForm.agrupacion">
						</div>

						<div class="field">
							<label>Codigo</label>
							<input type="text" name="codigo" placeholder="Codigo para la agrupacion" ng-model="DatosForm.agrupacion">
						</div>
					</div>
				</div>
				
				<br>

				<div class="field">
					<div class="two fields">
						<div class="field">
							<label>Descripcion</label>
							<textarea name="descripcion" placeholder="Descripcion para la agrupacion" ng-model="DatosForm.agrupacion"></textarea>
						</div>
					</div>
				</div>
				<div class="ui right floated submit big button green" ng-click="registrar_agrupacion()" id="btn-registrar">Registrar</div>
			</form>
		</div>
	</div>
</div>