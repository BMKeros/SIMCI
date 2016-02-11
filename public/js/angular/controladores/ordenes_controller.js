/// Controlador para Ordenes

simci.controller('OrdenesController', [
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

    $scope.modulo.nombre = "Ordenes";
    $scope.modulo.icono = {
      tipo: "edit",
      color: "yellow"
    };
    
    $scope.modulo.opciones = [
      {
        nombre:"generar ordenes",
        descripcion: "Esta opcion le permitira crear ordenes",
        url: "#/ordenes/crear-ordenes",
        icono: 'save'
      },
      
      {
        nombre:"mostrar ordenes",
        descripcion: "Esta opcion le permitira ver las ordenes existentes",
        url: "#/ordenes/ver/todos",
        icono: 'save'
      }

    ];


  }]
);