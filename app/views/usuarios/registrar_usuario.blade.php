<div class="ui two column doubling stackable grid container">
	<div class="ui one column centered grid">
		<div class="column">
	    	<div class="ten wide column">
			  	<div class="column">

   			    	<form class="ui form" id="">
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
						
				      	<div class="field">
			        		<div class="ui left icon input">
			          			<input type="text" placeholder="Usuario" id="usuario" name="usuario" ng-model="M_usuario">
			          			<i class="user icon"></i>
			        		</div>
		      			</div>

				      	<div class="field">
			        		<div class="ui left icon input">
			          			<input type="text" placeholder="Email" id="email" name="email" ng-model="M_email">
			          			<i class="mail square icon"></i>
			        		</div>
		      			</div>
		      	
				      	<div class="field">
				        	<div class="ui left icon input">
				          		<input type="Password" placeholder="Password" id="password" name="password" ng-model="M_password">
				          		<i class="lock icon"></i>
				        	</div>
				      	</div>

				      	<div class="field">
				        	<div class="ui left icon input">
				          		<input type="password" placeholder="Confirmar Password" id="confirmar-password" name="confirmar-password" ng-model="M_repassword">
				          		<i class="lock icon"></i>
				        	</div>
				      	</div>
				    </form>
			  	</div>
			</div>
		</div>
	</div>
</div>