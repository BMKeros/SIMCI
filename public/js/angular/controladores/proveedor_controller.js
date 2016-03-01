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

      $scope.mostrar_mensaje = false;
      $scope.DatosForm = {};
      
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
          url: '/api/consultas/obtener/parroquia?id_municipio='+cod_municipio
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

      $scope.registrar_proveedor = ToolsService.registrar_dinamico($scope,$http,$timeout,{
        url: '/api/proveedores/registrar-proveedor',

        formulario:{
          id:'formulario_crear_proveedor',
          reglas: reglas_formulario_registrar_proveedor
        },
        exito:{
          titulo: 'Proveedor registrado con exito',
          mensajes: ['Nuevo proveedor registrado en la base de datos.']
        }
      });
    }// If  === "/proveedores/registrar-proveedor"


    if($location.$$url == "/proveedores/ver/todos"){

      $scope.tabla_proveedores = {};
      $scope.id_proveedor_actual = null;

      $scope.opciones_tabla_proveedores = DTOptionsBuilder.newOptions()
        .withOption('ajax', {
         url: '/api/proveedores/mostrar?type=paginacion',
         type: 'GET'
      })
      .withDataProp('data')
      .withPaginationType('full_numbers')
      .withOption('processing', true)
      .withOption('serverSide', true)
      .withOption('createdRow', function(row, data, dataIndex) {
        $compile(angular.element(row).contents())($scope);
      });
    
      $scope.columnas_tabla_proveedores = [
          DTColumnBuilder.newColumn('codigo').withTitle('Codigo').withOption('width','7%').notSortable(),
          DTColumnBuilder.newColumn('razon_social').withTitle('Razon Social').notSortable(),
          DTColumnBuilder.newColumn('doc_identificacion').withTitle('Doc. Identificacion')
          .withOption('width','15%')
          .notSortable(),
          DTColumnBuilder.newColumn('email').withTitle('Email')
          .withOption('width','20%')
          .notSortable(),
          
          DTColumnBuilder.newColumn(null).withTitle('Telefonos').renderWith(
            function(data, type, full) {
              return "("+data.telefono_movil1+")("+data.telefono_fijo1+")";
            }
          )
          .withOption('width','13%')
          .notSortable(),
          DTColumnBuilder.newColumn(null).withTitle('Acciones').renderWith(
            function(data, type, full) {
              return '<div class="ui icon button blue pop" data-content="Ver Usuario" ng-click="modal_ver_proveedor('+data.codigo+')"><i class="unhide icon"></i></div>'+
                      '<div class="ui icon button green pop"  data-content="Modificar Usuario" ng-click="modal_modificar_objeto('+data.codigo+')"><i class="edit icon"></i></div>'+ 
                      '<div class="ui icon button red pop"  data-content="Eliminar Usuario" ng-click="modal_eliminar_objeto('+data.codigo+')"><i class="remove icon"></i></div>';
          }).withOption('width','14%')
      ];


      $scope.modal_ver_proveedor = function(id){
        $scope.data_proveedor = {};

        //hacer el modal dinamico
        /*ToolsService.mostrar_modal_dinamico($scope,$http,{
          url : '/api/usuarios/mostrar?type=usuario_full&id='+id,
          data_success: 'data_usuario',
          id_modal: 'modal_ver_usuario'
        });*/

      };
    }

    


  }]//Controller
);