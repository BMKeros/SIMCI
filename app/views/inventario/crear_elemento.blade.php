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
				<h3 class="ui centered dividing header">Registrar Elemento</h3>
				<br>
				<div class="field">
					<div class="two fields">
						<div class="field">
				      		<label>Almacen</label>
							{{  Form::select_dimension(array('name'=>'cod_dimension','id'=>'cod_dimension', 'ng-model'=>'cod_dimension')) }}
			     		</div>

			     		<div class="field">
				      		<label>Estantes</label>
								{{  Form::select_sub_dimension(array('name'=>'cod_sub_dimension','id'=>'cod_sub_dimension', 'ng-model'=>'cod_sub_dimension')) }}
						</div>
		     		</div>
				</div>

				<div class="field">
					<div class="two fields">
						<div class="field">
				      		<label>Agrupacion</label>
							{{-- Form::select_agrupacion(array('name'=>'cod_agrupacion', 'id'=>'cod_agrupacion', 'ng-model'=>'cod_agrupacion')) --}}
			     		</div>

			     		<div class="field">
				      		<label>Sub-agrupaciones del Producto</label>
							{{-- Form::select_sub_agrupacion(array('name'=>'cod_sub_agrupacion', 'id'=>'cod_sub_agrupacion', 'ng-model'=>'cod_sub_agrupacion')) --}}
						</div>

						<div class="field">
							<label>Objeto</label>

						</div>
		     		</div>
				</div>

				<br>

				<div class="field">
					<div class="three fields">
						<div class="field">
							<label>Numero de Organizacion</label>
							<input type="number" name="numero_orden" placeholder="Numero de organizacion">
						</div>

						<div class="field">
							<label>Objetos Disponibles</label>
							<input type="number" name="objetos_disponible" placeholder="5">
						</div>

						<div class="field">
							<label>Recipientes Disponibles</label>
							<input type="number" name="recipientes_disponibles" placeholder="56">

						</div>
					</div>
					
					<br>
					
					<div class="field">
						<div class="two fields">
							<div class="field">
								<div class="ui toggle checkbox">
								  	<input name="usa_recipiente" type="checkbox">
								  	<label>Usar Recipiente</label>
								</div>
							</div>

							<div class="field">
								<div class="ui toggle checkbox">
								  	<input name="usa_recipiente" type="checkbox">
								  	<label>Elemento Movible</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			<div class="ui right floated submit big button green">Registrar</div>
			</form>
		</div>
	</div>
</div>