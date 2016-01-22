<div class="ui centered grid">
	<div class="six wide tablet twelve wide computer column">
		<div class="ui form">
			<form class="ui form" id="formulario_crear_objeto">
				<h3 class="ui centered dividing header">Registrar Objeto</h3>
				<br>
				<div class="field centered grid">
					<div class="three fields">
						<div class="field">
							<label>Nombre del Producto</label>
			        		<input type="text" name="nombre_pruducto" placeholder="Nombre">
			        	</div>
				    </div>
				</div>

				<div class="field">
					<div class="two fields">
			      		
						 	<div class="field">
						    	<label>Especificacion del Producto</label>
						    	<textarea></textarea>
						  	</div>
						  	
						  	<div class="field">
							    <label>Descripcion del Producto</label>
							    <textarea></textarea>
							</div>
						
				    </div>
				</div>

				<br>

				<div class="field">
				    <div class="two fields">
				      	<div class="field">
				      		<label>Unidad</label>
				      		{{ Form::select_unidades (array('name'=>'cod_unidad', 'id'=>'unidad','ng-modal'=>'unidad'))}}
			     		</div>

			     		<div class="field">
			     			<label>Tipo de Objeto</label>
			     			{{ Form::select_agrupacion(array('name'=>'cod_tipo_objeto', 'id'=>'tipo_objeto', 'ng-modal'=>'tipo_objeto')) }}
						</div>
				    </div>
				</div>
			
			<br>

			<button type="submit" class="ui big right floated submit button blue" class=" ng-click="registrar_objeto()"">Registrar</button>
			</form>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	$('#formulario_crear_objeto').form(reglas_formulario_crear_usuario)
	});
</script>
