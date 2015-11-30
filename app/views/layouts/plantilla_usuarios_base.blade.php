<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	@section('Usuario')
		<title>Usuario-SIMCI</title>
	@show

	<script src="js/jquery.min.js"></script>
	
  <link rel="stylesheet" href="/semantic/semantic.min.css">
	<link rel="stylesheet" type="text/css" href="/semantic/formulario_inicio_sesion.css">
	@section ('css-usuario')
	@show
</head>

<body>

@section('barra-usuario')
<header><!--Barra de navegacion usuario-profesor-->
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
</header><!--Fin barra de navegacion principal de usuario-profesor-->
@show

@section('menu-usuario')
<div class="ui grid" class="desplegable">
  <!--Menu Desplegable de Usuario-Profesor-->
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



  <div class="ui vertical animated button" tabindex="0" id="menu">
    <div class="hidden content">Menu</div>
    <div class="visible content">
      <i class="sidebar icon"></i>
    </div>
  </div>
</div>

@show
<script src="js/usuario.js"></script>
<script src="semantic/semantic.min.js"></script>	
@section('js')
@show	
</body>
</html>