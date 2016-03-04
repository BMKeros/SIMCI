<div class="ui centered grid espacio_buttom4">
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
			
			<form class="ui form" id="formulario_crear_proveedor">
				<h3 class="ui centered dividing header">Datos generales</h3>
				
				<div class="field">
					<div class="two fields">
			     		<div class="nine wide field">
			     			<label>Razon social</label>
							<input type="text" name="razon_social" placeholder="Razon Social" ng-model="DatosForm.razon_social">
						</div>
				    </div>
				</div>

				<div class="field">
				    <div class="two fields">
						<div class="five wide field">
							<label>Documento de Identificacion</label>	
				        	<input type="text" name="doc_identificacion" placeholder="Documento de Identificacion" ng-model="DatosForm.doc_identificacion">
				        </div>

				      	<div class="seven wide field">
				      		<label>Email</label>	
				        	<input type="email" name="email" placeholder="Direccion Electronica" ng-model="DatosForm.email">
				      	</div>
				    </div>
				</div>

				<br>

				<div class="field">
				    <div class="four fields">
				        <div class="field">
							<label>Telefono movil</label>	
				        	<input type="text" name="telefono_movil1" placeholder="Telefono Movil" ng-model="DatosForm.telefono_movil1">
				        </div>

				      	<div class="field">
							<label>Telefono movil (Opcional)</label>	
				        	<input type="text" name="telefono_movil2" placeholder="Telefono Movil" ng-model="DatosForm.telefono_movil2">
				        </div>
						<div class="field">
							<label>Telefono fijo</label>	
				        	<input type="text" name="telefono_fijo1" placeholder="Telefono Fijo" ng-model="DatosForm.telefono_fijo1">
				        </div>

				      	<div class="field">
							<label>Telefono fijo (Opcional)</label>	
				        	<input type="text" name="telefono_fijo2" placeholder="Telefono Fijo" ng-model="DatosForm.telefono_fijo2">
				        </div>
				    </div>
				</div>

				<br>
				
				<h3 class="ui centered dividing header">Datos de Ubicacion</h3>				
				<br>

				<div class="field">
				    <div class="two fields">
						<div class="field">
							<label>Estado</label>
							{{ Form::select_estados(array('id'=>"select_estados",'ng-model'=>"DatosForm.cod_estado",'ng-change' => "cargar_municipios(DatosForm.cod_estado);")) }}
						</div>

						<div class="field">
							<label>Ciudad</label>
							<div class="ui disabled selection dropdown" id="select_ciudades">
	  							<input name="gender" type="hidden" ng-model="DatosForm.cod_ciudad" ng-update-hidden>
	  							<i class="dropdown icon"></i>
	  							<div class="default text">Ciudad</div>
	  							<div class="menu"></div>
							</div>
						</div>
						
					</div>	
				</div>

				<div class="field">
				    <div class="two fields">
						<div class="field">
							<label>Municipio</label>
							<div class="ui disabled selection dropdown"  id="select_municipios">
	  							<input name="cod_municipio" type="hidden" ng-model="DatosForm.cod_municipio" ng-change="cargar_parroquias(DatosForm.cod_municipio);" ng-update-hidden>

	  							<i class="dropdown icon"></i>
	  							<div class="default text">Municipio</div>
	  							<div class="menu"></div>
							</div>
						</div>

						<div class="field">
							<label>Parroquia</label>
							<div class="ui disabled selection dropdown" id="select_parroquias">
	  							<input name="gender" type="hidden" ng-model="DatosForm.cod_parroquia" ng-update-hidden>
	  							<i class="dropdown icon"></i>
	  							<div class="default text">Parroquia</div>
	  							<div class="menu"></div>
							</div>
						</div>
					</div>	
				</div>

				<div class="field">
					<div class="fields">
						<div class="fourteen wide field">
							<label>Direccion</label>
							<textarea name="direccion" placeholder="Direccion del proveedor" ng-model="DatosForm.direccion" rows="2"></textarea>
						</div>
					</div>
				</div>		
				
				<div class="field">
					<div class="big positive ui right floated button" ng-click="registrar_proveedor()" id="btn-registrar">Registrar</div>
				</div>
			</form>
		</div>
	</div>
</div>


<script type="text/javascript">
	$('.ui.dropdown').dropdown();
</script>
