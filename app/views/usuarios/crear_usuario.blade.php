@extends('layouts.plantilla_master')
<div class="ui two column doubling stackable grid container">
	<div class="ui one column centered grid">
		<div class="column">
	    	<div class="ten wide column">
			  	<div class="column">
					<div class="ui form">
						<form class="ui form">
						  	<h4 class="ui dividing header">Crear Usuario</h4>
							  	<div class="field">
								    <div class="fields">
								      	<div class="six wide field">
								        	<input type="text" name="usuario" placeholder="Usuario">
								      	</div>

								      	<div class="sixteen wide field">
											<input type="text" name="Email" placeholder="Direccion Email">
										</div>
								    </div>
						  		</div>

								<div class="field">
								    <div class="sixteen wide fields">
										<div class="field">	
								        	<input type="password" name="password" placeholder="Password">
								        </div>

								      	<div class="field">
								        	<input type="password" name="password" placeholder="Confirmar Password">
								      	</div>

								      	<div class="sixteen wide fields">
									      	<div class="field">
										      	<select name="gender" class="ui dropdown" id="select">
												  	<option value="">Tipo Usuario</option>
												  	<option value="tipo1">Primero</option>
												 	<option value="tipo2">Segundo</option>
												 	<option value="tipo2">Tercero</option>
												 	<option value="tipo4">Cuarto</option>
												</select>
											</div>
										</div>
								    </div>
								</div>
								<div class="field">
									<div class="sixteen wide fields">
										<div class="field">
									      	<select name="gender" class="ui dropdown" id="select">
											  	<option value="">Permisos</option>
											  	<option value="tipo1">PrimerASFASFASFAo</option>
											 	<option value="tipo2">SeguasdfbasdjkASDndo</option>
											 	<option value="tipo2">TercaSasfaserasfASFASo</option>
											 	<option value="tipo4">CuaASaSDASDAISJDAISJDOAISJdoAISJDOAIJSodiaJSODAJSoJDAOSIJDAOSIjdoAISJDOAISJdoaIJSDOAIJSDoaIJSDOAIJSdoIJASOsjdhakjsdbkajshdlkjahslkhsdlkaHSDLKAHSLDkjaHSLKDJHALSKJdhADFAYSaGDKAGHDIAULShdiALUSHDIAUShdIUASHDIAUSdrto</option>
											</select>
										</div>
									</div>
								</div>
						</form>
			  		</div>
				</div>
			</div>
		</div>
	</div>
</div>

