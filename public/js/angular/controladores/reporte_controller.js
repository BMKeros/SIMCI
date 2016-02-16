/// Controlador para reportes

simci.controller('ReporteController', [
  '$scope',
  '$http',
  '$log',
  '$timeout',
  '$route', 
  '$routeParams', 
  '$location',
  'DTOptionsBuilder', 
  'DTColumnBuilder',
  '$compile',
  'ToolsService',
  '$templateCache',
  function ($scope, $http, $log ,$timeout,$route, $routeParams, $location,DTOptionsBuilder,DTColumnBuilder,$compile,ToolsService,$templateCache){
    
    $scope.modulo = {};
    $scope.DatosForm = {}; // Objeto para los datos de formulario
    $scope.data_global_user = ToolsService.get_data_user_localstorage();


    $scope.modulo.nombre = "Reporte";
    $scope.modulo.icono = {
      tipo: "file text outline",
      color: "red"
    };
    
    $scope.modulo.opciones = [
      {
        nombre:"crear reporte",
        descripcion: "Esta opcion le permitira crear reportes",
        url: "#/reporte/crear-reporte",
        icono: 'write',
        show_in:[TIPO_USER_ROOT, TIPO_USER_ALMACENISTA, TIPO_USER_SUPERVISOR, TIPO_USER_PROFESOR]
      },
      
      {
        nombre:"mostrar reporte",
        descripcion: "Esta opcion le permitira ver los reportes existentes",
        url: "#/reporte/ver/todos",
        icono: 'eye',
        show_in:[TIPO_USER_ROOT, TIPO_USER_ALMACENISTA, TIPO_USER_SUPERVISOR, TIPO_USER_PROFESOR]
      }

    ];


  }]
);
    
 