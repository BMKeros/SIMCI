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
        nombre:"generar orden",
        descripcion: "Esta opcion le permitira crear ordenes",
        url: "#/ordenes/generar-orden",
        icono: 'write',
        show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_PROFESOR]
      },
      
      {
        nombre:"mostrar ordenes",
        descripcion: "Esta opcion le permitira ver las ordenes existentes",
        url: "#/ordenes/ver/todos",
        icono: 'unhide',
        show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_ALMACENISTA]
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
            DTColumnBuilder.newColumn(null).withTitle('Nombre')
            .notSortable(),
            
            DTColumnBuilder.newColumn('fecha de actividad').withTitle('Fecha de la actividad').notSortable(),

            DTColumnBuilder.newColumn('laboratorio').withTitle('Laboratorio').notSortable(),
            
            DTColumnBuilder.newColumn(null).withTitle('Acciones').renderWith(
              function(data, type, full) {
                return '<div class="ui icon button blue spopup" data-content="Ver Ordenes" ng-click="modal_ver_ordenes('+data.id+')"><i class="unhide icon"></i></div>'+
                        '<div class="ui icon button green spopup"  data-content="Modificar Ordenes" ng-click="modal_modificar_ordenes('+data.id+')"><i class="edit icon"></i></div>'+ 
                        '<div class="ui icon button red spopup"  data-content="Eliminar Ordenes" ng-click="modal_eliminar_ordenes('+data.id+')"><i class="remove icon"></i></div>';
            }).withOption('width','17%')
        ];

      }

      if($location.$$url == '/ordenes/generar-orden') {
        $scope.procesar_generar_orden=function () {
          alertify.confirm("Esta seguro que desea generar esta Orden?", function() {
            alertify.success("Aceptar");
          }, function () {
            alertify.error("Cancelar");
          }).set("title", "Confirmar Accion!");
        }

          /*$scope.items_tabla_orden = []; //Aqui se guardaran todos los elementos que se agreguen con el btn plus
          $scope.select_laboratorio = ""; //Laboratorio seleccionado
          $scope.select_objeto = ""; //Objeto seleccionado
          $scope.cantidad = 0; //Cantidad del objeto seleccionado


          $scope.cantidad_disponible_inventario = 0;

          $scope.agregar_orden_tabla = function () {

              var formulario = $('#formulario_generar_ordenes');
              var is_valid_form = formulario.form(reglas_formulario_generar_ordenes).form('is valid');

              if ($scope.cantidad > $scope.cantidad_disponible_inventario) {
                  alertify.error("La cantidad ingresada es mayor a la disponible en inventario");
                  return false;
              }
              if (is_valid_form) {
                  $http({
                      method: 'GET',
                      url: '/api/laboratorio/verificar?type=existe_stock_laboratorio&cod_laboratorio=' + $scope.select_laboratorio + '&cod_objeto=' + $scope.select_objeto
                  }).then(
                      function (response) {

                          var existe = response.data.resultado;

                          if (!existe) {
                              $http({
                                  method: 'GET',
                                  url: '/api/laboratorio/mostrar?type=agregar_stock&cod_laboratorio=' + $scope.select_laboratorio + '&cod_objeto=' + $scope.select_objeto
                              }).then(
                                  function (data) {

                                      var data_item = data.data;

                                      //Verificamos que no se repita el elemento en la lista
                                      var existe = $scope.items_tabla_orden.findIndex(function (obj, index, array) {
                                          return (obj.cod_objeto == $scope.select_objeto) && (obj.cod_laboratorio == $scope.select_laboratorio);
                                      });

                                      //Si no existe el nuevo elemento el la lista lo agregamos
                                      if (existe === -1) {
                                          $scope.items_tabla_orden.push({
                                              id_item_stock: ToolsService.generar_id_unico(),
                                              nombre_laboratorio: data_item.nombre_laboratorio,
                                              cod_laboratorio: data_item.cod_laboratorio,
                                              cod_objeto: data_item.cod_objeto,
                                              nombre_objeto: data_item.nombre_objeto,
                                              cantidad: $scope.cantidad
                                          });
                                          console.log($scope.items_tabla_orden);
                                      }
                                      else {
                                          alertify.error("Ya agregaste un elemento igual a este en la lista");
                                      }
                                  },
                                  function (data_error) {
                                      ToolsService.generar_alerta_status(data_error);
                                  }
                              );
                          }
                          else {
                              alertify.error("Este elemento ya existe en la lista de Ordenes");
                          }
                      },
                      function (data_error) {
                          ToolsService.generar_alerta_status(data_error);
                      }
                  );
              }
          };*/
      }

  }]

);