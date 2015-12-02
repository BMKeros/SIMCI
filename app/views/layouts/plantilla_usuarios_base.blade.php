<!DOCTYPE html>
<html>
	<head lang="es">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

		@section('titulo')
			<title>SIMCI - Usuarios</title>
		@show
		
	  	<link rel="stylesheet" href="/semantic/semantic.min.css">
		<link rel="stylesheet" type="text/css" href="/css/formulario_inicio_sesion.css">
		
		@section ('css')
		@show

	</head>

	<body>

	@section('barra-usuario')
		<header><!--Barra de navegacion usuario-profesor-->
  			<div class="ui attached stackable menu">
    			<a class="item"><i class="home icon"></i> SIMCI</a>
    			
    			<div class="right item "><!--Dropdown para notificaciones-->
      				<div class="ui floating labeled icon dropdown button" style="padding-left=20px; left:420px">
        				<i class="alarm icon"></i>
        				<span class="text">Notificaciones</span>
        				<div class="menu">
          					<div class="header">Buscar</div>
          					<div class="ui left icon input">
            					<i class="search icon"></i>
            					<input type="text" name="search" placeholder="Buscar . . .">
          					</div>
          					
          					<div class="header">
            					<i class="flag icon"></i>Todas las notificaciones
          					</div>
					        
					        <div class="item">

					            <div class="ui red empty circular label"></div>
					            Solicitudes
					            	<div class="ui small teal label">3</div>
					        </div>
					        
					        <div class="item">
					        	<div class="ui blue empty circular label"></div>
								Reportes
									<div class="ui small teal label">2</div>
					        </div>

					        <div class="item">
					        	<div class="ui black empty circular label"></div>
					        	Actualizaciones
					        		<div class="ui small teal label">4</div>
					        </div>
        				</div>
      				</div>
    			</div><!--Fin del Dropdown de Notificaciones-->

    			<div class="right item" style="padding-right: 80px; "><!--Css para ubicar dropdown-->
    				<div class="ui floating labeled icon dropdown button"><!--Dropdwn para ajustes-->
          				<i class="user icon"></i>
          				<span class="text">Usuario</span>
          				
          				<div class="menu">
            				<div class="header">
              					<i class="tags icon"></i>
              					Opciones
            				</div>
            				<div class="divider"></div>
            				
            				<div class="item">
              					<i class="plus icon"></i>
              					Empty
            				</div>
            				
            				<div class="item">
              					<i class="configure icon"></i>
              					Configuracion
            				</div>
            				
            				<div class="item">
              					<i class="sign out icon"></i>
              					Salir
            				</div>
          				</div>
        			</div><!--Fin del Dropdown Ajustes-->
    			</div>
  			</div>  
		</header><!--Fin barra de navegacion principal de usuario-profesor-->
	@show

	@section('menu-usuario')
		<div class="ui grid" id="desplegable">
	  		<!--Menu Desplegable de Usuario-Profesor-->
	  		<div class="eight column row">
	    		<div class="ui left vertical inverted labeled icon sidebar menu" id="usuario">
		    		<a class="item">
		      			<i class="home icon"></i>
		      			Home
		    		</a>
		    	
		    		<a class="item">
		      			<i class="block layout icon"></i>
		      			Topics
		    		</a>
		    	
		    		<a class="item">
		      			<i class="smile icon"></i>
		      			Friends
		    		</a>	
		    	
		    		<a class="item">
		      			<i class="calendar icon"></i>
		      			History
		    		</a>
		    	
		 	   		<a class="item">
		      			<i class="mail icon"></i>
		      			Messages
		    		</a>
		    	
		    		<a class="item">
		      			<i class="chat icon"></i>
		      			Discussions
		    		</a>
		    	
			    	<a class="item">
				      	<i class="trophy icon"></i>
				      	Achievements
			    	</a>
		    	
			    	<a class="item">
				      	<i class="shop icon"></i>
				      	Store
			    	</a>
		    	
			    	<a class="item">
				      	<i class="settings icon"></i>
				      	Settings
			    	</a>
	    		</div>

	    		<div class="ui animated fade big launch button" tabindex="1" id="menu">
	      			<div class="hidden content">
	        			<div id="botton">Menu</div>
	      			</div>
	      			<div class="visible content">
	        			<i class="sidebar icon"></i>
	      			</div>
	    		</div>
	  		</div>
		</div>
	@show
	
	<script src="js/jquery.min.js"></script>
	<script src="js/scripts_plantilla_usuario.js"></script>
	<script src="semantic/semantic.min.js"></script>	
	
	@section('js')
	@show	
</body>
</html>