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
	  	<link rel="stylesheet" href="/bower_components/datatables/media/css/jquery.dataTables.min.css">
	  	<link rel="stylesheet" href="/bower_components/pikaday/css/pikaday.css">
	  	<!-- AlertifyJs Css -->
	  	<link rel="stylesheet" href="/bower_components/alertifyjs/css/alertify.min.css">
	  	<link rel="stylesheet" href="/bower_components/alertifyjs/css/themes/semantic.min.css">

	  	<script>
	  		if(typeof(Storage) === "undefined") {
	  			alert("Su navegador no soporta algunos complementos de esta aplicacion \nPorfavor actualice su navegador para continuar");
			}	
	  	</script>
		
		@section('css')
		@show

		<link rel="icon" href="/img/logo.png" type="image/x-icon" />
	</head>

	<body>
		
		<div id="contenedorPadre">
			@yield('contenido-body-master')
		</div>


		<script src="/bower_components/jquery/jquery.min.js"></script>
		<script src="/semantic/semantic.min.js"></script>
		<script src="/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
		<script src="/bower_components/angular/angular.min.js"></script>	
		<script src="/bower_components/angular-route/angular-route.min.js"></script>
		<script src="/bower_components/angular-datatables/dist/angular-datatables.min.js"></script>
		<script src="/bower_components/angular-datatables/dist/plugins/columnfilter/angular-datatables.columnfilter.min.js"></script>
		<script src="/bower_components/datatables/plugins/columnfilter/angular-datatables.columnfilter.min.js"></script>
		<!-- alertifyJs -->
		<script src="/bower_components/alertifyjs/alertify.min.js"></script>
		
		<script src="/js/moment-with-locales.min.js"></script>
		<script src="/bower_components/pikaday/pikaday.js"></script>
		<script src="/bower_components/howler.js/howler.min.js"></script>

		<script src="/js/scripts_app.js"></script>
		<script src="/js/scripts_formularios.js"></script>
		<script src="/js/angular/ng-app.js"></script>
		<script src="/js/angular/ng-controladores.js"></script>
		<script src="/js/angular/ng-routes.js"></script>
		
		
		
		<script>
			localStorage.setItem('data_usuario','{{ (empty($data_usuario))?(null):($data_usuario) }}');

			$(document).ready(function(){
				TOOLS_APP.ver_reloj();
				TOOLS_APP.listen_notificaciones();
			});
		</script>

		@section('js')
		@show	
	</body>
</html>