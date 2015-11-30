<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		
		<title>SIMCI</title>
		
		<script src="/semantic/jquery.js"></script>
		<link rel="stylesheet" href="/semantic/semantic.min.css">
		<link rel="stylesheet" type="text/css" href="/css/formulario_inicio_sesion.css">
	</head>
	
	<body>
		<header><!--Barra de navegacion principal-->
			<div class="barra-nav" id="barra">
				<div class="ui attached stackable menu">
				  	<div class="ui container">
				    	<a class="item"><i class="home icon"></i> SIMCI</a>
				    	<div class="right item">
				    	<div class="ui input"><input type="text" placeholder="Search..."></div>
				    	</div>
				  	</div>
				</div>
			</div>
		</header><!--Fin barra de navegacion principal-->

	
		<div class="ui two column centered grid">
			<div class="column">
			<div class="formulario" id="inicio_sesion">
		    	<div class="ten wide column">
		    		<div class="ui two column middle aligned very relaxed stackable grid">
					  	<div class="column">
					  		<div class="ui blue message">
					  			<div id="ident"> <p> Inicio Sesion</p> </div>
					  		</div>
		   			    	<div class="ui form">
					      		<div class="field">
					        		<label>Usuario</label>
					        		<div class="ui left icon input">
					          			<input type="text" placeholder="Usuario">
					          			<i class="user icon"></i>
					        		</div>
					      		</div>
					      	
					      	<div class="field">
					        	<label>Password</label>
					        	<div class="ui left icon input">
					          		<input type="password" placeholder="Password">
					          		<i class="lock icon"></i>
					        	</div>
					      	</div>
					      	
					      	<div class="ui blue submit button">Login</div>
					    	
					    	</div>
					 	</div>
					</div>
				</div>
			</div>
			</div>
		</div>

		<script src="semantic/semantic.min.js"></script>	
	</body>
</html>