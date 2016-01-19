@extends('layouts.plantilla_master')
@section('contenido-body-master')
	<div class="ui centered grid">
	<div class="six wide tablet twelve wide computer column">
		<div class="ui form">
			<form class="ui form" id="formulario_crear_usuario">
				<h3 class="ui centered dividing header">Llenar Inventario</h3>
				<br>
				<div class="field">
					<div class="two fields">
						<div class="field">
				      		<label>Dimenciones del Producto</label>
							<select class="ui search dropdown">
								<option value="">Dimencion</option>
								<option value="C1">DimencionD1</option>
								<option value="C2">DimencionD2</option>
								<option value="C3">DimencionD3</option>
								<option value="C4">DimencionD4</option>
								<option value="C5">DimencionD5</option>
								<option value="C6">DimencionD6</option>
							</select>
			     		</div>

			     		<div class="field">
				      		<label>Sub-Dimenciones del Producto</label>
							<select class="ui search dropdown">
								<option value="">Sub-Dimencion</option>
								<option value="C1">Sub-DimencionD1</option>
								<option value="C2">Sub-DimencionD2</option>
								<option value="C3">Sub-DimencionD3</option>
								<option value="C4">Sub-DimencionD4</option>
								<option value="C5">Sub-DimencionD5</option>
								<option value="C6">Sub-DimencionD6</option>
							</select>
						</div>
		     		</div>
				</div>

				<div class="field">
					<div class="two fields">
						<div class="field">
				      		<label>Agrupaciones del Producto</label>
							<select class="ui search dropdown">
								<option value="">Agrupaciones</option>
								<option value="C1">AgrupacionesA1</option>
								<option value="C2">AgrupacionesA2</option>
								<option value="C3">AgrupacionesA3</option>
								<option value="C4">AgrupacionesA4</option>
								<option value="C5">AgrupacionesA5</option>
								<option value="C6">AgrupacionesA6</option>
							</select>
			     		</div>

			     		<div class="field">
				      		<label>Sub-agrupaciones del Producto</label>
							<select class="ui search dropdown">
								<option value="">Sub-Agrupaciones</option>
								<option value="C1">Sub-AgrupacionesA1</option>
								<option value="C2">Sub-AgrupacionesA2</option>
								<option value="C3">Sub-AgrupacionesA3</option>
								<option value="C4">Sub-AgrupacionesA4</option>
								<option value="C5">Sub-AgrupacionesA5</option>
								<option value="C6">Sub-AgrupacionesA6</option>
							</select>
						</div>

						<div class="field">
							<label>Tipo Objeto</label>
							<select>
								<option value="">Tipo de Obejeto</option>
								<option value="T1">TipoObjeto1</option>
								<option value="T2">TipoObjeto2</option>
								<option value="T3">TipoObjeto3</option>
								<option value="T4">TipoObjeto4</option>
								<option value="T5">TipoObjeto5</option>
								<option value="T6">TipoObjeto6</option>
								<option value="T7">TipoObjeto7</option>
							</select>
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
							<input type="number" name="numero_orden" placeholder="5">
						</div>

						<div class="field">
							<label>Recipientes Disponibles</label>
							<input type="number" name="recipientes_disponibles" placeholder="56">

						</div>
					</div>
					
					<div class="field">
						<div class="ui toggle checkbox">
						  	<input name="usa_recipiente" type="checkbox">
						  	<label>Usar Recipiente</label>
						</div>
					</div>
				</div>
			<div class="ui right floated submit button blue">Registrar</div>
			</form>
		</div>
	</div>
</div>
@stop