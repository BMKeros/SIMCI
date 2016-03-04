/// Controlador para reportes

simci.controller('ReportesController', [
  '$scope',
  '$http',
  '$log',
  '$timeout',
  '$route', 
  '$routeParams', 
  '$location',
  '$compile',
  'DTOptionsBuilder', 
  'DTColumnBuilder',
  'ToolsService',
  function ($scope, $http, $log ,$timeout, $route, $routeParams, $location, $compile,DTOptionsBuilder, DTColumnBuilder,ToolsService){
    $scope.modulo = {};

    $scope.DatosForm = {}; // Objeto para los datos de formulario
    $scope.data_global_user = ToolsService.get_data_user_localstorage();


    $scope.modulo.nombre = "Reportes";
    $scope.modulo.icono = {
      tipo: "file text outline",
      color: "purple"
    };

    $scope.modulo.opciones = [
      
      {
        nombre:"registrar reportes",
        descripcion: "Esta opcion le permitira crear nuevos reportes",
        url: "#/reportes/generar-reporte",
        icono: 'write',
        show_in: [TIPO_USER_ROOT, TIPO_USER_ALMACENISTA, TIPO_USER_SUPERVISOR]
      },
      
      {
        nombre:"mostrar reportes",
        descripcion: "Esta opcion le permitira ver los reportes generados",
        url: "#/reportes/ver/todos",
        icono: 'unhide',
        show_in: [TIPO_USER_ROOT, TIPO_USER_ALMACENISTA, TIPO_USER_SUPERVISOR]
      }

    ];

  }]
);
