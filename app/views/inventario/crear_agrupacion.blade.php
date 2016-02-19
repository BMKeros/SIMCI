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
				<h3 class="ui centered dividing header">Crear agrupacion</h3>
				<br>
				<div class="field">
					<div class="fields">
						<div class="four wide field">
							<label>Codigo</label>
							<input type="text" name="codigo" placeholder="Codigo para la agrupacion" ng-model="DatosForm.codigo">
						</div>
						<div class="ten wide field">
							<label>Nombre</label>
							<input type="text" name="nombre" placeholder="Nombre de la agrupacion" ng-model="DatosForm.nombre">
						</div>
					</div>
				</div>
				
				<br>

				<div class="field">
					<div class="fields">
						<div class="fourteen wide field">
							<label>Descripcion</label>
							<textarea name="descripcion" placeholder="Descripcion para la agrupacion" ng-model="DatosForm.descripcion" rows="4"></textarea>
						</div>
					</div>
				</div>
				<div class="ui right floated submit big button green" ng-click="registrar_agrupacion()" id="btn-registrar">Registrar</div>
			</form>
		</div>
	</div>
</div>