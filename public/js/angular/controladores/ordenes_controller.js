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
    $scope.data_global_user = ToolsService.get_data_user_localstorage();


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
        icono: 'write',
        show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_ALMACENISTA, TIPO_USER_SUPERVISOR, TIPO_USER_PROFESOR]
      },
      
      {
        nombre:"mostrar ordenes",
        descripcion: "Esta opcion le permitira ver las ordenes existentes",
        url: "#/ordenes/ver/todos",
        icono: 'unhide',
        show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_ALMACENISTA, TIPO_USER_SUPERVISOR, TIPO_USER_PROFESOR]
      }

    ];

    if($location.$$url == '/ordenes/ver/todos'){

        $scope.tabla_ordenes = {};
        $scope.id_objeto_ordenes = null;

        $scope.opciones_tabla_ordenes = DTOptionsBuilder.newOptions()
          .withOption('ajax', {
           url: '/api/ordenes/mostrar?type=paginacion',
           type: 'GET'
        })
        .withDataProp('data')
        .withPaginationType('full_numbers')
        .withOption('processing', true)
        .withOption('serverSide', true)
        .withOption('createdRow', function(row, data, dataIndex) {
          $compile(angular.element(row).contents())($scope);

          $timeout(function(){
            $('.ui.spopup').popup();
        },false,0);
        });
      
        $scope.columnas_tabla_ordenes = [
            DTColumnBuilder.newColumn(null).withTitle('Fecha')
            .notSortable(),
            
            DTColumnBuilder.newColumn('tipo de orden').withTitle('Tipo de Orden').notSortable(),

            DTColumnBuilder.newColumn('ordenes hechas').withTitle('Ordenes Hechas').notSortable(),
            
            DTColumnBuilder.newColumn(null).withTitle('Acciones').renderWith(
              function(data, type, full) {
                return '<div class="ui icon button blue spopup" data-content="Ver Ordenes" ng-click="modal_ver_ordenes('+data.id+')"><i class="unhide icon"></i></div>'+
                        '<div class="ui icon button green spopup"  data-content="Modificar Ordenes" ng-click="modal_modificar_ordenes('+data.id+')"><i class="edit icon"></i></div>'+ 
                        '<div class="ui icon button red spopup"  data-content="Eliminar Ordenes" ng-click="modal_eliminar_ordenes('+data.id+')"><i class="remove icon"></i></div>';
            }).withOption('width','17%')
        ];

      }


  }]
);