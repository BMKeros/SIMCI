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

      $('#select_municipios').attr('class','ui loading dropdown disabled');
      $http({
        method: 'GET',
        url: '/api/consultas/obtener?type=municipio&id_estado='+cod_estado,
      }).then(
      function(data){
        var data_tmp = '<option value="">Municipio</option>';
        data.data.forEach(function(obj){
          data_tmp += ToolsService.printf('<option value="{0}">{1}</option>',obj.value, obj.name);
        });
        $('#select_municipios').html(data_tmp);
      },
      function(){

      });
      
    };


  }]
);