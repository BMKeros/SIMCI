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
        nombre:"enviar documentos",
        descripcion: "Esta opcion le permitira enviar documentos",
        url: "#/documentos/enviar-documentos",
        icono: 'write',
        show_in:[TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_ALMACENISTA, TIPO_USER_SUPERVISOR, TIPO_USER_PROFESOR]
      },

      {
        nombre:"subir documentos",
        descripcion: "Esta opcion le permitira mostrar los documentos enviados y recibidos",
        url: "#/documentos/subir-documentos",
        icono: 'unhide',
        show_in:[TIPO_USER_ROOT,TIPO_USER_ADMIN, TIPO_USER_ALMACENISTA, TIPO_USER_SUPERVISOR, TIPO_USER_PROFESOR]
      },

      {
        nombre:"mostrar documentos",
        descripcion: "Esta opcion le permitira mostrar los documentos enviados y recibidos",
        url: "#/documentos/ver/todos",
        icono: 'unhide',
        show_in:[TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_ALMACENISTA, TIPO_USER_SUPERVISOR, TIPO_USER_PROFESOR]
      }
      

    ];


    if($location.$$url == '/documentos/ver/todos'){

        $scope.tabla_documentos = {};
        $scope.id_objeto_documentos = null;

        $scope.opciones_tabla_documentos = DTOptionsBuilder.newOptions()
          .withOption('ajax', {
           url: '/api/documentos/mostrar?type=paginacion',
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
      
        $scope.columnas_tabla_documentos = [
            DTColumnBuilder.newColumn(null).withTitle('Fecha')
            .notSortable(),
            
            DTColumnBuilder.newColumn('documentos_enviados').withTitle('Documentos Enviados').notSortable(),

            DTColumnBuilder.newColumn('documentos_respondidos').withTitle('Documentos Respondidos').notSortable(),
            
            DTColumnBuilder.newColumn(null).withTitle('Acciones').renderWith(
              function(data, type, full) {
                return '<div class="ui icon button blue spopup" data-content="Ver Documentos" ng-click="modal_ver_documentos('+data.id+')"><i class="unhide icon"></i></div>'+
                        '<div class="ui icon button green spopup"  data-content="Modificar Documentos" ng-click="modal_modificar_documentos('+data.id+')"><i class="edit icon"></i></div>'+ 
                        '<div class="ui icon button red spopup"  data-content="Eliminar Documentos" ng-click="modal_eliminar_documentos('+data.id+')"><i class="remove icon"></i></div>';
            }).withOption('width','17%')
        ];

      }//Fin de /mostrar/documentos

  }]
);
    
 