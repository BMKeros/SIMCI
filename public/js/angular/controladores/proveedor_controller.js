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

    if($location.$$url == "/proveedores/registrar-proveedor"){

    }

    $scope.cargar_municipios =  function(cod_estado){

      setTimeout(function(){
        //Cargamos las ciudades tambien
        $scope.cargar_ciudades(cod_estado);

        $('#select_municipios').parent().dropdown('set selected',' ');

        $('#select_municipios').parent().addClass('loading');

        $http({
          method: 'GET',
          url: '/api/consultas/obtener?type=municipio&id_estado='+cod_estado,
        }).then(
        function(data){
          var data_tmp = '<option value=" ">Municipio</option>';
          data.data.forEach(function(obj){
            data_tmp += ToolsService.printf('<option value="{0}">{1}</option>',obj.value, obj.name);
          });
          $('#select_municipios').html(data_tmp);
          
          $('#select_municipios').parent().removeClass('loading disabled');
        });
      },500);

    };


    $scope.cargar_parroquias = function(cod_municipio){
      
      $('#select_parroquias').parent().dropdown('set selected',' '); 

      $('#select_parroquias').parent().addClass('loading');

      $http({
        method: 'GET',
        url: '/api/consultas/obtener?type=parroquia&id_municipio='+cod_municipio,
      }).then(
      function(data){
        var data_tmp = '<option value=" ">Parroquia</option>';
        data.data.forEach(function(obj){
          data_tmp += ToolsService.printf('<option value="{0}">{1}</option>',obj.value, obj.name);
        });
        $('#select_parroquias').html(data_tmp);
        
        $('#select_parroquias').parent().removeClass('loading disabled');
      });
    };

    $scope.cargar_ciudades = function(cod_estado){

      $('#select_ciudades').parent().dropdown('set selected',' '); 
      
      $('#select_ciudades').parent().addClass('loading');

      $http({
        method: 'GET',
        url: '/api/consultas/obtener?type=ciudad&id_estado='+cod_estado,
      }).then(
      function(data){
        var data_tmp = '<option value=" ">Ciudad</option>';
        data.data.forEach(function(obj){
          data_tmp += ToolsService.printf('<option value="{0}">{1}</option>',obj.value, obj.name);
        });
        $('#select_ciudades').html(data_tmp);
        
        $('#select_ciudades').parent().removeClass('loading disabled');
      });
    };


  }]
);