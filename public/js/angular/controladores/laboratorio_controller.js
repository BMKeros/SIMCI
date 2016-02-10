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
      tipo: "lab",
      color: "purple"
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
      },


      {
        nombre:"agregar stock",
        descripcion: "Esta opcion le permitira agregar nuevos stock al laboratorios",
        url: "#/laboratorio/registrar-stock",
        icono: 'save'
      },


      {
        nombre:"mostrar stock",
        descripcion: "Esta opcion le permitira ver los nuevos stock del laboratorios y moverlos a nuevos laboratorios",
        url: "#/laboratorio/mover-stock",
        icono: 'save'
      }

    ];


  }]
);
    
 