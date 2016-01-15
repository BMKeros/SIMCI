<div class="ui two column doubling stackable grid container">
	<div class="ui one column centered grid">
		<h4 class="ui dividing header">Crear Usuario</h4>
			<div class="column">
		    	<div class="ten wide column">
				  	<div class="column">
						<div class="ui form">
							<form class="ui form" id="formulario_crear_usuario">
							  	<div class="field">
								    <div class="fields">
								      	<div class="eight wide field">
								        	<input type="text" name="usuario" placeholder="Usuario">
								      	</div>

								      	<div class="sixteen wide field">
											<input type="text" name="email" placeholder="Direccion Email">
										</div>
								    </div>
						  		</div>

								<div class="field">
								    <div class="fields">
										<div class="eight wide field">	
								        	<input type="password" name="password" placeholder="Password">
								        </div>

								      	<div class="eight wide field">
								        	<input type="password" name="password_confirmacion" placeholder="Confirmar Password">
								      	</div>
								    </div>
								</div>
								

								<div class="field">
									<div class="fields">
										<div class="eight wide field">
									      	{{Form::select_permisos(array('name' => 'permisos', 'id' => 'permisos'))}}
										</div>

										<div class="eight wide field">
									      	{{Form::select_tipo_usuario(array('id' => 'tipo_usuario', 'name' => 'tipo_usuario'))}}
										</div>
									</div>
									<div class="field">
										<div class="ui toggle checkbox">
											<label>Usuario activo</label>
											<input type="checkbox" name="public">
										</div>
									</div>

									<div class="field">
										<input type="file" name="imagen" placeholder="">
									</div>
								</div>
							</form>
				  		</div>
					</div>
				</div>
			</div>
			
		<h4 class="ui dividing header">Datos Personales</h4>
		<div class="column">
	    	<div class="ten wide column">
			  	<div class="column">
					<div class="ui form">
						<form class="ui form">
							  	<div class="field">
								    <div class="fields">
								      	<div class="eight wide field">
								        	<input type="text" name="primer_nombre" placeholder="Primer Nombre">
								      	</div>

								      	<div class="eight wide field">
											<input type="text" name="segundo_nombre" placeholder="Segundo Nombre">
										</div>
								    </div>
						  		</div>

								<div class="field">
								    <div class="fields">
										<div class="eight wide field">	
								        	<input type="text" name="primer_apellido" placeholder="Primer Apellido">
								        </div>

								      	<div class="eight wide field">
								        	<input type="text" name="segundo_apellido" placeholder="Segundo Apellido">
								      	</div>
									</div>
								</div>

								<div class="field">
									<div class="fields">
										<div class="nine wide field">
											<input type="text" name="cedula" placeholder="Cedula">
										</div>

										<div class="nine wide field">
											<input type="date" name="fecha_nacimiento" placeholder="Fecha Nacimieto">
										</div>
									</div>
								</div>
								
								<div class="field">
									<div class="fields">
										<div class="eight wide field">
											{{Form::select_sexo(array('id' => 'sexo', 'name' => 'sexo'))}}
										</div>
									</div>
								</div>
							<button class=" ui mediun right floated teal submit button"  id="btn-inicio-sesion"><i class="check circle icon"></i>Registrar</button>
						</form>
			  		</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$('#formulario_crear_usuario').form(reglas_formulario_crear_usuario);
</script>

<script>
$('.ui.dropdown')
  .dropdown({
    maxSelections: 3
  })
;


$('.max.example .ui.normal.dropdown')
  .dropdown({
    maxSelections: 3
  })
;
</script>

