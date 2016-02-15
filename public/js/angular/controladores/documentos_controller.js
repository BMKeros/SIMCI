/// Controlador para catalogo

simci.controller('DocumentosController', [
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

    $scope.modulo.nombre = "Documentos";
    $scope.modulo.icono = {
      tipo: "travel",
      color: "teal"
    };
    
    $scope.modulo.opciones = [
      {
        nombre:"crear documentos",
        descripcion: "Esta opcion le permitira enviar documentos",
        url: "#/documentos/enviar-documentos",
        icono: 'write',
        show_in:[TIPO_USER_ROOT, TIPO_USER_ALMACENISTA, TIPO_USER_SUPERVISOR, TIPO_USER_PROFESOR]
      },

      {
        nombre:"mostrar documentos",
        descripcion: "Esta opcion le permitira mostrar los documentos enviados y recibidos",
        url: "#/documentos/recibir/mostrar-todos",
        icono: 'unhide',
        show_in:[TIPO_USER_ROOT, TIPO_USER_ALMACENISTA, TIPO_USER_SUPERVISOR, TIPO_USER_PROFESOR]
      }
      

    ];

  }]
);
    
 