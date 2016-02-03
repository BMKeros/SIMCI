/// Controlador para catalogo

simci.controller('LaboratorioController', [
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

    $scope.modulo.nombre = "Laboratorio";
    $scope.modulo.icono = {
      tipo: "book",
      color: "red"
    };
    
    $scope.modulo.opciones = [
      {
        nombre:"registrar laboratorio",
        descripcion: "Esta opcion le permitira añadir nuevos laboratorios",
        url: "#/laboratorio/crear-laboratorio",
        icono: 'save'
      },
      
      {
        nombre:"mostrar laboratorio",
        descripcion: "Esta opcion le permitira ver los nuevos laboratorios",
        url: "#/laboratorio/ver/todos",
        icono: 'save'
      }

    ];


  }]
);
    
 