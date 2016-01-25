<div class="ui two column doubling stackable grid container">
	<div class="ui one column centered grid">
		<div class="column">
	    	<div class="ten wide column">
			  	<div class="column">
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
						<form class="ui form">
						  	<h4 class="ui dividing header">Actualizacion de Datos</h4>
							  	<div class="field">
								    <div class="fields">
								      	<div class="six wide field">
								        	<input type="text" name="usuario" placeholder="Usuario">
								      	</div>

								      	<div class="nine wide field">
											<input type="text" name="Email" placeholder="Direccion Email">
										</div>
								    </div>
						  		</div>

								<div class="field">
								    <div class="two wide fields">
										<div class="field">	
								        	<input type="password" name="password" placeholder="Password">
								        </div>

								      	<div class="field">
								        	<input type="password" name="password" placeholder="Confirmar Password">
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
 