/// Controlador para catalogo

simci.controller('ConsultaController', [
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

    $scope.modulo.nombre = "Consulta";
    $scope.modulo.icono = {
      tipo: "search",
      color: "olive"
    };
    
    $scope.modulo.opciones = [
      {
        nombre:"consulta",
        descripcion: "Esta opcion le permitira observar la disponibilidad del inventario y realizar busquedas",
        url: "#/consulta/realizar-consultas",
        icono: 'unhide'
      },
      

    ];

  }]
);
    
 