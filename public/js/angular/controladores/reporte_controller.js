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
        icono: 'save'
      },
      
      {
        nombre:"mostrar reporte",
        descripcion: "Esta opcion le permitira ver los reportes existentes",
        url: "#/reporte/ver/todos",
        icono: 'save'
      }

    ];


  }]
);
    
 