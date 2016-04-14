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

			<form class="ui form" id="formulario_registrar_elemento">
				<h3 class="ui centered dividing header">Registrar Elemento</h3>
				<br>
				<div class="field">
					<div class="two fields">
						<div class="field">
				      		<label>Almacen</label>
							{{  Form::select_dimension(array('name'=>'cod_dimension','id'=>'cod_dimension', 'ng-model'=>'DatosForm.cod_dimension')) }}
			     		</div>

			     		<div class="field">
				      		<label>Sub Dimension</label>
								{{  Form::select_sub_dimension(array('name'=>'cod_sub_dimension','id'=>'cod_sub_dimension', 'ng-model'=>'DatosForm.cod_sub_dimension')) }}
						</div>
		     		</div>
				</div>

				<div class="field">
					<div class="three fields">
						<div class="field">
				      		<label>Agrupacion</label>
							{{ Form::select_agrupacion(array('name'=>'cod_agrupacion', 'id'=>'cod_agrupacion', 'ng-model'=>'DatosForm.cod_agrupacion')) }}
			     		</div>

			     		<div class="field">
				      		<label>Sub Agrupacion</label>
							{{ Form::select_sub_agrupacion(array('name'=>'cod_sub_agrupacion', 'id'=>'cod_sub_agrupacion', 'ng-model'=>'DatosForm.cod_sub_agrupacion')) }}
						</div>

						<div class="field">
							<label>Objeto</label>
							<div class="ui search selection dropdown capitalize buscar_objeto">
				             	<input type="hidden" ng-model="DatosForm.cod_objeto" name="cod_objeto" ng-update-hidden>
				             	<div class="text">Buscar objeto</div>
				              	<i class="dropdown icon"></i>
				              	<input tabindex="0" class="search" type="text">
							</div>
						</div>
		     		</div>
				</div>

				<br>

				<div class="field">
					<div class="three fields">
						<div class="field">
							<label>Numero de Organizacion</label>
							<input type="number" name="numero_orden" placeholder="0" min="1" ng-model="DatosForm.numero_orden">
						</div>

						<div class="field">
							<label>Cantidad Disponible</label>
							<input type="number" name="cantidad_disponible" placeholder="0" min="1" ng-model="DatosForm.cantidad_disponible">
						</div>
					</div>
					
					<br>
					
					<div class="field">
						<div class="two fields">

							<div class="field">
								<div class="ui toggle checkbox">
								  	<input name="elemento_movible" type="checkbox" ng-model="DatosForm.elemento_movible" ng-init="DatosForm.elemento_movible = true">
								  	<label>Elemento Movible</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			<div class="ui right floated submit big button green" id="btn-registrar" ng-click="registrar_elemento()">Registrar</div>
			</form>
		</div>
	</div>
</div>

<script>
$('.ui.dropdown').dropdown();

$('.buscar_objeto').dropdown({
	apiSettings: {
	  	method: 'GET',
	  	dataType: 'JSON',
	  	url: '/api/catalogo/mostrar?type=query&query={query}',
  	},
  	saveRemote:false
});

</script>