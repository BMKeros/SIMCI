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
				<h3 class="ui centered dividing header">Datos generales de proveedor</h3>
				
				<div class="field">
					<div class="two fields">
			     		<div class="field">
			     			<label>Razon social</label>
							<input type="text" name="razon_social" placeholder="Razon Social" ng-model="DatosForm.razon_social">
						</div>
				    </div>
				</div>

				<div class="field">
				    <div class="two fields">
						<div class="nine wide field">
							<label>Documento de Identificacion</label>	
				        	<input type="text" name="doc_identificacion" placeholder="Documento de Identificacion" ng-model="DatosForm.doc_identificacion">
				        </div>

				      	<div class="seven wide field">
				      		<label>Email</label>	
				        	<input type="email" name="email" placeholder="Direccion Electronica">
				      	</div>
				    </div>
				</div>

				<br>

				<div class="field">
				    <div class="four fields">
				        <div class="field">
							<label>Telefono movil 1</label>	
				        	<input type="text" name="telefono_movil1" placeholder="Telefono Movil 1" ng-model="DatosForm.telefono_movil1">
				        </div>

				      	<div class="field">
							<label>Telefono movil 2</label>	
				        	<input type="text" name="telefono_movil2" placeholder="Telefono Movil 2" ng-model="DatosForm.telefono_movil2">
				        </div>
						<div class="field">
							<label>Telefono fijo 1</label>	
				        	<input type="text" name="telefono_fijo1" placeholder="Telefono Fijo 1" ng-model="DatosForm.telefono_fijo1">
				        </div>

				      	<div class="field">
							<label>Telefono fijo 2</label>	
				        	<input type="text" name="telefono_fijo2" placeholder="Telefono Fijo 2" ng-model="DatosForm.telefono_fijo2">
				        </div>
				    </div>
				</div>

				<br>
				
				<h3 class="ui centered dividing header">Datos de Ubicacion</h3>				
				
				
				<br>

				<div class="field">
				    <div class="two fields">
						<div class="field">
							<label>Codigo del Estado</label>
							<select></select>
						</div>

						<div class="field">
							<label>Codido de la Ciudad</label>
							<select></select>
						</div>
					</div>	
				</div>

				<div class="field">
				    <div class="two fields">
						<div class="field">
							<label>Codigo del Municipio</label>
							<select></select>
						</div>

						<div class="field">
							<label>Codido de la Parroquia</label>
							<select></select>
						</div>
					</div>	
				</div>

				<div class="field">
					<div class="fields">
						<div class="fourteen wide field">
							<label>Direccion</label>
							<textarea name="descripcion" placeholder="Direccion del proveedor" ng-model="DatosForm.direccion" rows="2"></textarea>
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
