/// Controlador para Ordenes

simci.controller('ProveedorController', [
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


    $scope.modulo.nombre = "Proveedores";
    $scope.modulo.icono = {
      tipo: "shop",
      color: "brown"
    };
    
    $scope.modulo.opciones = [
      {
        nombre:"registrar proveedor",
        descripcion: "Esta opcion le permitira crear nuevos proveedores",
        url: "#/proveedores/registrar-proveedor",
        icono: 'write',
        show_in: [TIPO_USER_ROOT, TIPO_USER_ALMACENISTA, TIPO_USER_SUPERVISOR, TIPO_USER_PROFESOR]
      },
      
      {
        nombre:"mostrar provedores",
        descripcion: "Esta opcion le permitira ver proveedores registrados",
        url: "#/proveedores/ver/todos",
        icono: 'unhide',
        show_in: [TIPO_USER_ROOT, TIPO_USER_ALMACENISTA, TIPO_USER_SUPERVISOR, TIPO_USER_PROFESOR]
      }

    ];

    $scope.cargar_municipios =  function(cod_estado){

      var s_municipios = angular.element('#select_municipios');
      var s_ciudades = angular.element('#select_ciudades');
      var s_parroquias = angular.element('#select_parroquias');


      $timeout(function(){
        s_municipios.dropdown('clear')
        s_ciudades.dropdown('clear');
        s_parroquias.dropdown('clear');
      });

      setTimeout(function(){
        //Cargamos las ciudades tambien
        $scope.cargar_ciudades(cod_estado);

        //Se agrega la clase loading para mostrar el icono de cargando
        s_municipios.addClass('loading');

        $http({
          method: 'GET',
          url: '/api/consultas/obtener/municipio?id_estado='+cod_estado,
        }).then(
        function(data){
          var opciones = '';
          data.data.forEach(function(obj){
            opciones += ToolsService.printf('<div class="item" data-value="{0}">{1}</div>',obj.value, obj.name);
          });
          
          s_municipios.find('.menu').html(opciones);
          
          s_municipios.removeClass('loading disabled');

        });
      },500);

    };


    $scope.cargar_parroquias = function(cod_municipio){

      var SELECT = $('#select_parroquias');
      
      SELECT.addClass('loading');

      $http({
        method: 'GET',
        url: '/api/consultas/obtener/parroquia?id_municipio='+cod_municipio,
      }).then(
      function(data){
        var data_tmp = '';
        data.data.forEach(function(obj){
          data_tmp += ToolsService.printf('<div class="item" data-value="{0}">{1}</div>',obj.value, obj.name);
        });
        
        SELECT.find('.menu').html(data_tmp);
        
        SELECT.removeClass('loading disabled');
      });
    };

    $scope.cargar_ciudades = function(cod_estado){

      var SELECT = $('#select_ciudades');

      SELECT.addClass('loading');

      $http({
        method: 'GET',
        url: '/api/consultas/obtener/ciudad?id_estado='+cod_estado,
      }).then(
      function(data){
        var opciones = '';
        data.data.forEach(function(obj){
          opciones += ToolsService.printf('<div class="item" data-value="{0}">{1}</div>',obj.value, obj.name);
        });

        SELECT.find('.menu').html(opciones);
        
        SELECT.removeClass('loading disabled');
      });
    };


  }]
);