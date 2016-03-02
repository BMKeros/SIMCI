/// Controlador para catalogo

simci.controller('LaboratorioController', [
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


    $scope.modulo.nombre = "Laboratorio";
    $scope.modulo.icono = {
      tipo: "lab",
      color: "purple"
    };
    
    $scope.modulo.opciones = [
      {
        nombre:"registrar laboratorio",
        descripcion: "Esta opcion le permitira añadir nuevos laboratorios",
        url: "#/laboratorio/crear-laboratorio",
        icono: 'write',
        show_in:[TIPO_USER_ROOT, TIPO_USER_ALMACENISTA]
      },
      
      {
        nombre:"mostrar laboratorio",
        descripcion: "Esta opcion le permitira ver los nuevos laboratorios",
        url: "#/laboratorio/ver/laboratorios",
        icono: 'unhide',
        show_in:[TIPO_USER_ROOT, TIPO_USER_ALMACENISTA, TIPO_USER_SUPERVISOR, TIPO_USER_PROFESOR]
      },


      {
        nombre:"agregar stock",
        descripcion: "Esta opcion le permitira agregar nuevos stock al laboratorios",
        url: "#/laboratorio/registrar-stock",
        icono: 'plus',
        show_in:[TIPO_USER_ROOT, TIPO_USER_ALMACENISTA]
      },


      {
        nombre:"mostrar stock",
        descripcion: "Esta opcion le permitira ver los nuevos stock y moverlos a nuevos laboratorios",
        url: "#/laboratorio/mostrar-stock",
        icono: 'eye',
        show_in:[TIPO_USER_ROOT, TIPO_USER_ALMACENISTA, TIPO_USER_SUPERVISOR, TIPO_USER_PROFESOR]
      },

       {
        nombre:"mover stock",
        descripcion: "Esta opcion le permitira mover los stock del laboratorios y moverlos a nuevos laboratorios",
        url: "#/laboratorio/mover-stock",
        icono: 'external',
        show_in:[TIPO_USER_ROOT, TIPO_USER_ALMACENISTA]
      }

    ];

    $log.info($routeParams);
    $log.info($location);

    if($location.$$url == '/laboratorio/crear-laboratorio'){
        $scope.mostrar_mensaje = false;
        $scope.DatosForm = {};

        $scope.registrar_laboratorio = ToolsService.registrar_dinamico($scope,$http,$timeout,{
          url: '/api/laboratorio/registrar-laboratorio',

          formulario:{
            id:'formulario_crear_laboratorio',
            reglas: reglas_formulario_registrar_laboratorio
          },
          exito:{
            titulo: 'Laboratoiro creado con exito',
            mensajes: ['Nuevo Laboratorio registrado en la base de datos.']
          }///inventario/registrar-estante
        });

      }// If == '/laboratorio/crear-laboratorio'

      if($location.$$url == '/laboratorio/ver/laboratorios'){

        $scope.tabla_laboratorios = {};
        $scope.id_laboratorio_actual = null;

        $scope.opciones_tabla_laboratorios = DTOptionsBuilder.newOptions()
          .withOption('ajax', {
           url: '/api/laboratorio/mostrar?type=paginacion',
           type: 'GET'
        })
        .withDataProp('data')
        .withPaginationType('full_numbers')
        .withOption('processing', true)
        .withOption('serverSide', true)
        .withOption('createdRow', function(row, data, dataIndex) {
          $compile(angular.element(row).contents())($scope);
        });
      
        $scope.columnas_tabla_laboratorios = [
            DTColumnBuilder.newColumn('codigo').withTitle('Codigo').notSortable().withOption('width', '80px'),
            DTColumnBuilder.newColumn('nombre').withTitle('Nombre').notSortable(),
            DTColumnBuilder.newColumn('descripcion').withTitle('Descripcion').notSortable(),
            
            DTColumnBuilder.newColumn(null).withTitle('Acciones').renderWith(
              function(data, type, full) {
                return '<a class="ui icon button blue" data-content="Ver Laboratorio" ng-click="modal_ver_laboratorio(\''+data.codigo+'\')"><i class="unhide icon"></i></a>'+
                        '<a class="ui icon button green"  data-content="Modificar Laboratorio" ng-click="modal_modificar_laboratorio(\''+data.codigo+'\')"><i class="edit icon"></i></a>'+
                        '<a class="ui icon button red "  data-content="Eliminar Laboratorio" ng-click="modal_eliminar_laboratorio(\''+data.codigo+'\')"><i class="remove icon"></i></a>';
              })
              .withOption('width', '135px')
        ];
        
        ///Funciones 
        $scope.modal_ver_laboratorio = function(id){
          $scope.data_laboratorio = {};

          ToolsService.mostrar_modal_dinamico($scope,$http,{
            url: '/api/laboratorio/mostrar?type=laboratorio_full&id='+id,
            scope_data_save_success: 'data_laboratorio',
            id_modal: 'modal_ver_laboratorio'
          });
        };

        
        $scope.modal_eliminar_laboratorio = function(id){
          alertify.confirm('Seguro que desea eliminar este laboratorio!',
            //onok consulta para verificar si tiene relaciones con otras tablas
            function(){
              $http({
                method: 'POST',
                url: '/api/laboratorio/verificar?id='+id,
              }).then(function(data){
                //verificamos si el laboratorio tiene relacion en otras tablas
                if(data.data.resultado){
                  alertify.alert(data.data.mensajes);
                }
                else{
                  //sino tiene relaciones, que confirme para que elimine el laboratorio
                  alertify.confirm(data.data.mensajes, 
                    //onok para eliminar el usuairo
                    function(){
                      $http({
                        method: 'POST',
                        url: '/api/laboratorio/eliminar?id='+id,
                      }).then(function(data){
                        
                        if(data.data.resultado){

                          //Recargamos la tabla
                          setTimeout(function(){
                            ToolsService.reload_tabla($scope,'tabla_laboratorios',function(data){});
                          }, 500);                         
                        }
                        else{
                          $log.info(data);
                        }
                      },function(data_error){
                        $log.info(data_error);
                      });
                    }
                  ).set('title', '¡Alerta!');
                }
              },
              function(data_error){
                $log.info(data_error);
              });
            }
          ).set('title', '¡Alerta!');
        };//fin de la funcion eliminar de laboratorios


      }//fin del if de ver-laboratorios









    }]
);
    
 