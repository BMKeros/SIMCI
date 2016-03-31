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

			<form class="ui form" id="formulario_crear_unidad">
				<h3 class="ui centered dividing header">Registrar Unidades</h3>
				
				<br>

				<div class="field">
					<div class="two fields">
						<div class="field">
							<label>Nombre de la unidad</label>
							<input type="text" name="nombre" placeholder="Nombre de la Unidad" ng-model="DatosForm.nombre">
						</div>

						<div class="field">
							<label>Abreviatura</label>
							<input type="text" name="abreviatura" placeholder="Abreviatura de la Unidad" ng-model="DatosForm.abreviatura">
						</div>

						<div class="field">
							<label>Tipo Unidad</label>
							{{  Form::select_tipo_unidad(array('name'=>'tipo_unidad','id'=>'tipo_unidad', 'ng-model'=>'DatosForm.tipo_unidad')) }}
						</div>
					</div>
				</div>
				
				<br>

				<div class="ui big right floated submit button green" ng-click="registrar_unidad()" id="btn-registrar">Registrar
				</div>
			</form>
		</div>
	</div>
</div>	

<script>
	$('.ui.dropdown').dropdown();
</script>
