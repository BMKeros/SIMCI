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

		@section('css')
		@show

		<link rel="icon" href="favicon.ico" type="image/x-icon" />

	</head>

	<body>

		@yield('contenido-body')

		<script src="/js/jquery.min.js"></script>
		<script src="/semantic/semantic.min.js"></script>
		<script src="/js/angular/angular.min.js"></script>	

		<script src="/js/angular/ng-controladores.js"></script>
		
		@section('js')
		@show	
	</body>
</html>