simci.controller('InstitucionesController', [
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


    $scope.modulo.nombre = "Instituciones";
    $scope.modulo.icono = {
      tipo: "building",
      color: "red"
    };
    
    $scope.modulo.opciones = [
      {
        nombre:"ministerio de defensa",
        descripcion: "Esta opcion le redireccionara al portal principal del Ministerio de defensa",
        url: "http://www.google.com",
        icono: 'legal',
        show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_PROFESOR, TIPO_USER_SUPERVISOR, TIPO_USER_ESTUDIANTE, TIPO_USER_ALMACENISTA]
      },
      {
        nombre:"DARFA",
        descripcion: "Esta opcion le redireccionara al portal principal del DARFA",
        url: "http://www.google.com",
        icono: 'lab',
        show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_PROFESOR, TIPO_USER_SUPERVISOR, TIPO_USER_ESTUDIANTE, TIPO_USER_ALMACENISTA]
      },
      {
        nombre:"UPTAG",
        descripcion: "Esta opcion le redireccionara al portal principal de Universidad Politecnica Tecnologica Alonso Gamero.",
        url: "http://www.google.com",
        icono: 'university',
        show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_PROFESOR, TIPO_USER_SUPERVISOR, TIPO_USER_ESTUDIANTE, TIPO_USER_ALMACENISTA]
      },
      {
        nombre:"bomberos nacionales",
        descripcion: "Esta opcion le redireccionara al portal principal de los bomberos nacionales",
        url: "http://www.google.com",
        icono: 'fire',
        show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_PROFESOR, TIPO_USER_SUPERVISOR, TIPO_USER_ESTUDIANTE, TIPO_USER_ALMACENISTA]
      },
      

    ];

  }]
);
    
