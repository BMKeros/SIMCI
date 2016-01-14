<!DOCTYPE html>
<html ng-app="SIMCI">
	<head lang="es">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

		@section('titulo')
			<title>SIMCI</title>
		@show
		
	  	<link rel="stylesheet" href="/semantic/semantic.min.css" />
	  	<link rel="stylesheet" href="/css/styles.css" />

		@section('css')
		@show

		<link rel="icon" href="/img/logo.png" type="image/x-icon" />
	</head>

	<body>

		@yield('contenido-body-master')


		<script src="/bower_components/jquery/jquery.min.js"></script>
		<script src="/semantic/semantic.min.js"></script>
		<script src="/bower_components/angular/angular.min.js"></script>	
		<script src="/bower_components/angular-route/angular-route.min.js"></script>
		<script src="/js/moment-with-locales.min.js"></script>
		
		<script src="/js/scripts_app.js"></script>
		<script src="/js/scripts_formularios.js"></script>
		<script src="/js/angular/ng-app.js"></script>
		<script src="/js/angular/ng-controladores.js"></script>
		<script src="/js/angular/ng-routes.js"></script>
		
		<script>

			$(document).ready(function(){
				TOOLS_APP.ver_reloj();			
			});
			
		</script>

		@section('js')
		@show	
	</body>
</html>