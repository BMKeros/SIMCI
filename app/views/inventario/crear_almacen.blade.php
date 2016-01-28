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

			<form class="ui form" id="formulario_crear_usuario">
				<h3 class="ui centered dividing header">Crear Almacen</h3>
				<br>
				<div class="field">
					<div class="two fields">
						<div class="field">
							<label>Codigo del Almacen</label>
							<input type="text" name="cod_almacen" placeholder="Codigo del Almacen">
						</div>

						<div class="field">
							<label>Responsable</label>
							<input type="text" name="responsable" placeholder="Aqui va es un Select">
						</div>
					</div>
				</div>
				
				<br>

				<div class="field">
					<div class="two fields">	
						<div class="field">
							<label>Primer Auxiliar</label>
							<input type="text" placeholder="Aqui va es un Select">
						</div>

						<div class="field">
							<label>Segundo Auxiliar</label>
							<input type="text" placeholder="Aqui va es un Select">
						</div>
					</div>
				</div>

				<br>

				<div class="field">
					<div class="one fields">
						<div class="ten wide field">
							<label>Descripcion</label>
							<textarea name="descripcion_almacen" placeholder="Descripcion Del Almacen"></textarea>
						</div>
					</div>
				</div>
				<div class="ui right floated submit big button green">Registrar</div>
			</form>
		</div>
	</div>
</div>