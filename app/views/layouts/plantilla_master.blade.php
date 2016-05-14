<!DOCTYPE html>
<html ng-app="SIMCI">
<head lang="es">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    @section('titulo')
        <title>SIMCI</title>
    @show

    <link rel="stylesheet" href="/semantic/semantic.min.css"/>
    <link rel="stylesheet" href="/css/styles.css"/>
    <link rel="stylesheet" href="/bower_components/datatables/media/css/dataTables.semanticui.min.css">
    <link rel="stylesheet" href="/bower_components/pikaday/css/pikaday.css">
    <!-- AlertifyJs Css -->
    <link rel="stylesheet" href="/bower_components/alertify-js/build/css/alertify.min.css">
    <link rel="stylesheet" href="/bower_components/alertify-js/build/css/themes/semantic.min.css">
    <!-- Ng Progress -->
    <link rel="stylesheet" href="/bower_components/ngprogress/ngProgress.css">
    <!-- Ng chart -->
    <link rel="stylesheet" href="/bower_components/angular-chart.js/dist/angular-chart.css">

    <script>
        if (typeof(Storage) === "undefined") {
            alert("Su navegador no soporta algunos complementos de esta aplicacion \nPorfavor actualice su navegador para continuar");
        }
    </script>

    @section('css')
    @show

    <link rel="icon" href="/img/logo.png" type="image/x-icon"/>
</head>

<body ng-show-progress-loading ng-listen-notificaciones>

<div id="contenedorPadre">
    @yield('contenido-body-master')
</div>


<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/semantic/semantic.min.js"></script>
<script src="/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="/bower_components/datatables/media/js/dataTables.semanticui.min.js"></script>
<script src="/bower_components/Chart.js/Chart.min.js"></script>
<script src="/bower_components/angular/angular.min.js"></script>
<script src="/bower_components/angular-route/angular-route.min.js"></script>
<script src="/bower_components/angular-datatables/dist/angular-datatables.min.js"></script>
<script src="/bower_components/angular-animate/angular-animate.min.js"></script>
<script src="/bower_components/angular-chart.js/dist/angular-chart.min.js"></script>
<script src="/bower_components/angularUtils-pagination/dirPagination.js"></script>
<script src="/bower_components/angular-qr-scanner/qr-scanner.js"></script>
<script src="/bower_components/angular-qr-scanner/src/jsqrcode-combined.min.js"></script>
<script src="/bower_components/angular-audio/app/angular.audio.js"></script>

<!-- plugins datatables -->

<!-- alertifyJs -->
<script src="/bower_components/alertify-js/build/alertify.min.js"></script>

<!-- Ng progress -->
<script src="/bower_components/ngprogress/build/ngprogress.min.js"></script>

<script src="/bower_components/moment/min/moment-with-locales.min.js"></script>
<script src="/bower_components/pikaday/pikaday.js"></script>
<script src="/bower_components/howler.js/howler.min.js"></script>


<script src="/js/scripts_app.js"></script>
<script src="/js/scripts_formularios.js"></script>
<script src="/js/dialogos_app.js"></script>

<!-- Script APP SIMCI ANGULAR JS -->
<script src="/js/angular/ng-app.js"></script>
<script src="/js/angular/ng-controladores.js"></script>
<script src="/js/angular/ng-directivas.js"></script>
<script src="/js/angular/ng-routes.js"></script>


<script>
    localStorage.setItem('data_usuario', '{{ (empty($data_usuario))?(null):($data_usuario) }}');

    $(document).ready(function () {
        TOOLS_APP.ver_reloj();
        TOOLS_APP.listen_notificaciones();
    });
</script>

@section('js')
@show
</body>
</html>