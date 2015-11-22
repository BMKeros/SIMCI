<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	@section('titulo-principal') 
	<title>SIMCI</title>
	@show
	
	<script src="/semantic/jquery.js"></script>
	<link rel="stylesheet" href="/semantic/semantic.min.css">
	<link rel="stylesheet" type="text/css" href="/semantic/formulario_inicio_sesion.css">
	@section ('css')
	@show

</head>
<body>

@section('barra-principal')
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
@show

@section('inicio-sesion')
<div class="ui segment" id="panel">
	<div class="formulario" id="inicio_sesion">
	<div class="nombre-panel">
		<label>Iniciar Sesion</label>
	</div>	
		<div class="img" id="img-formulario">
			<div class="ui small image">
	  			<img src="/semantic/themes/default/assets/images/atom.gif">
			</div>
		</div>
		<div class="ui two column middle aligned very relaxed stackable grid">
		  	<div class="column">
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
@show

								<!--Escript mas sus blade-->

<script src="semantic/semantic.min.js"></script>	
@section('js')
@show	

</body>
</html>