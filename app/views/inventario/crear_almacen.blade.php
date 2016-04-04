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


			<form class="ui form" id="formulario_registrar_almacen">
				<h3 class="ui centered dividing header">Registrar Almacen</h3>
				<br>
				<div class="field">
					<div class="two fields">
						<div class="field">
							<label>Responsable</label>
							{{ Form::select_personas(array('name'=>'responsable', 'id'=>'responsable','ng-model'=>'DatosForm.responsable'),null, 'Responsable')}}
						</div>
					</div>
				</div>

				<div class="field">
					<div class="two fields">	
						<div class="field">
							<label>Primer Auxiliar</label>
							{{ Form::select_personas(array('name'=>'primer_auxiliar', 'id'=>'primer_auxiliar','ng-model'=>'DatosForm.primer_auxiliar'),null, 'Primer Auxiliar')}}
						</div>

						<div class="field">
							<label>Segundo Auxiliar</label>
							{{ Form::select_personas(array('name'=>'segundo_auxiliar', 'id'=>'segundo_auxiliar','ng-model'=>'DatosForm.segundo_auxiliar'),null, 'Segundo  Auxiliar')}}
						</div>
					</div>
				</div>

				<div class="field">
					<div class="one fields">
						<div class="ten wide field">
							<label>Descripcion</label>
							<textarea name="descripcion" placeholder="Descripcion del Almacen" rows="4" ng-model="DatosForm.descripcion"></textarea>
						</div>
					</div>
				</div>
				<div class="ui right floated submit big button green" ng-click="registrar_almacen()" id="btn-registrar">Registrar</div>
			</form>
		</div>
	</div>
</div>

<script>
	$('.ui.dropdown').dropdown();
</script>
