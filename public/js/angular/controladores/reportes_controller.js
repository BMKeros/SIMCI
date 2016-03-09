/// Controlador para reportes

simci.controller('ReportesController', [
  '$scope',
  '$http',
  '$log',
  '$timeout',
  '$route', 
  '$routeParams', 
  '$location',
  '$compile',
  'DTOptionsBuilder', 
  'DTColumnBuilder',
  'ToolsService',
  function ($scope, $http, $log ,$timeout, $route, $routeParams, $location, $compile,DTOptionsBuilder, DTColumnBuilder,ToolsService){
    $scope.modulo = {};

    $scope.DatosForm = {}; // Objeto para los datos de formulario
    $scope.data_global_user = ToolsService.get_data_user_localstorage();


    $scope.modulo.nombre = "Reportes";
    $scope.modulo.icono = {
      tipo: "file text outline",
      color: "violet"
    };

    $scope.modulo.opciones = [
      
      {
        nombre:"registrar reportes",
        descripcion: "Esta opcion le permitira crear nuevos reportes",
        url: "#/reportes/generar-reporte",
        icono: 'write',
        show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_ALMACENISTA, TIPO_USER_SUPERVISOR, TIPO_USER_PROFESOR]
      },
      
      {
        nombre:"mostrar reportes",
        descripcion: "Esta opcion le permitira ver los reportes generados",
        url: "#/reportes/ver/todos",
        icono: 'unhide',
        show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_ALMACENISTA, TIPO_USER_SUPERVISOR, TIPO_USER_PROFESOR]
      }

    ];

    if($location.$$url == '/reportes/ver/todos'){

        $scope.tabla_reportes = {};
        $scope.id_objeto_reportes = null;

        $scope.opciones_tabla_reportes = DTOptionsBuilder.newOptions()
          .withOption('ajax', {
           url: '/api/reportes/mostrar?type=paginacion',
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
      
        $scope.columnas_tabla_reportes = [
            DTColumnBuilder.newColumn(null).withTitle('Fecha')
            .notSortable(),
            
            DTColumnBuilder.newColumn('tipo de orden').withTitle('Tipo de Repote').notSortable(),

            DTColumnBuilder.newColumn('reportes aceptados').withTitle('Reportes Aceptados').notSortable(),
            
            DTColumnBuilder.newColumn(null).withTitle('Acciones').renderWith(
              function(data, type, full) {
                return '<div class="ui icon button blue spopup" data-content="Ver Reportes" ng-click="modal_ver_reportes('+data.id+')"><i class="unhide icon"></i></div>'+
                        '<div class="ui icon button green spopup"  data-content="Modificar Reportes" ng-click="modal_modificar_reportes('+data.id+')"><i class="edit icon"></i></div>'+ 
                        '<div class="ui icon button red spopup"  data-content="Eliminar Reportes" ng-click="modal_eliminar_reportes('+data.id+')"><i class="remove icon"></i></div>';
            }).withOption('width','17%')
        ];

      }//Fin de mostrar/reportes

  }]
);
