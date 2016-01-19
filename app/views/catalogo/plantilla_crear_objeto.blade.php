@extends('layouts.plantilla_master')
@section('contenido-body-master')
<div class="ui centered grid">
	<div class="six wide tablet twelve wide computer column">
		<div class="ui form">
			<form class="ui form" id="formulario_crear_usuario">
				<h3 class="ui centered dividing header">Llenar Catalogo</h3>
				<br>
				<div class="field centered grid">
					<div class="three fields">
						<div class="field">
							<label>Nombre del Producto</label>
			        		<input type="text" name="" placeholder="Nombre">
			        	</div>

			        	<div class="field">
				      		<label>Especificacion del Producto</label>	
				        	<input type="text" name="especificaciones" placeholder="Especificaciones">
				      	</div>

				      	<div class="field">
				        	<label>Descripcion del Producto</label>
							<input type="text" name="descripcion" placeholder="Descripcion">
				        </div>
				    </div>
				</div>

				<div class="field">
				    <div class="two fields">
				      	<div class="field">
				      		<label>Unidad</label>
							<select class="ui search dropdown">
    							<option value="">Codigos</option>
    							<option value="C1">CodigosP1</option>
    							<option value="C2">CodigosP2</option>
    							<option value="C3">CodigosP3</option>
    							<option value="C4">CodigosP4</option>
    							<option value="C5">CodigosP5</option>
    							<option value="C6">CodigosP6</option>
    						</select>
			     		</div>

			     		<div class="field">
			     			<label>Tipo de Objeto</label>
			     			<select class="ui search dropdown">
    							<option value="">Codigos</option>
    							<option value="C1">Codigos1</option>
    							<option value="C2">Codigos2</option>
    							<option value="C3">Codigos3</option>
    							<option value="C4">Codigos4</option>
    							<option value="C5">Codigos5</option>
    							<option value="C6">Codigos6</option>
    						</select>
						</div>
				    </div>
				</div>
			<div class="ui right floated submit button blue">Registrar</div>
			</form>
		</div>
	</div>
</div>
@stop