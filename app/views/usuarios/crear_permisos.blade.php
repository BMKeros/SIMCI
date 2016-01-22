<div class="ui centered grid">
	<div class="six wide tablet twelve wide computer column">
		<div class="ui form">
			<form class="ui form" id="formulario_crear_permisos_usuarios">
				<h3 class="ui centered dividing header">Crear Permisos</h3>

				<div class="field centered grid">
					<div class="two fields">
						<div class="field">
							<label>Permisos del Usuario</label>
							<input type="text" name="permiso"placeholder="Nombre del Permiso">
			        		
			        	</div>
			        	<div class="field">
				      		<label>Codigo</label>	
				        	<input type="text" name="cod_permiso" placeholder="Codigo del Permiso">
				      	</div>
				    </div>

				    <div class="field">
				    	<label>Descripcion de Permiso</label>
				    	<textarea "ng-modal Datos.Form.Descripcion" placeholder="Descripcion de los Permisos"></textarea>
				    </div>
				</div>

				<div class="ui big right floated submit button blue" ng-click="registrar_objeto()" id="btn-registrar"> Aceptar
				</div>
			</form>
		</div>
	</div>
</div>