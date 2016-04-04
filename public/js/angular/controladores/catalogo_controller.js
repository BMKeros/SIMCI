/// Controlador para catalogo

simci.controller('CatalogoController', [
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
    //Esta variable debe estar en todos los controladores
    //Contiene la data del usuario que esta logueado
    $scope.data_global_user = ToolsService.get_data_user_localstorage();

    $scope.modulo.nombre = "Catalogo";
    $scope.modulo.icono = {
      tipo: "book",
      color: "orange"

    };
    
    $scope.modulo.opciones = [
      {
        nombre:"registrar objeto",
        descripcion: "Esta opcion le permitira añadir nuevos objetos al catalogo",
        url: "#/catalogo/registrar-objeto",
        icono: 'write',
        show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_ALMACENISTA]
      },
      {
        nombre:"ver catalogo",
        descripcion: "Esta opcion le permitira ver, modificar o eliminar los objetos del catalogos",
        url: "#/catalogo/ver/todos",
        icono: 'eye',
        show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_ALMACENISTA, TIPO_USER_PROFESOR,TIPO_USER_SUPERVISOR]
      },
      {
        nombre:"registrar unidad",
        descripcion: "Esta opcion le permitira añadir nuevas unidades para objetos del catalogo",
        url: "#/catalogo/registrar-unidad",
        icono: 'write',
        show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_ALMACENISTA]
      },
      {
        nombre:"registrar clase",
        descripcion: "Esta opcion le permitira añadir nuevas clases para objetos del objetos",
        url: "#/catalogo/registrar-clase",
        icono: 'write',
        show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_ALMACENISTA]
      }
    ];
    
    $log.info($routeParams);
    $log.info($location);

    if($location.$$url == '/catalogo/registrar-objeto'){

        ToolsService.reload_template_cache($route,$templateCache);

        $scope.mostrar_mensaje = false;
        $scope.mostrar_mensaje_modificacion = false;

        $scope.registrar_objeto = ToolsService.registrar_dinamico($scope,$http,$timeout,{
          url: '/api/catalogo/registrar-objeto',
          formulario:{
            id:'formulario_crear_objeto',
            reglas: reglas_formulario_crear_objeto
          },
          exito:{
            titulo: 'Objeto creado con exito',
            mensajes: ['El Objeto ha sido agregado al catalogo.']
          }
        });

    
      }// If == '/catalogo/registrar-objeto'

      if($location.$$url == '/catalogo/ver/todos'){
        ToolsService.reload_template_cache($route,$templateCache);

        $scope.tabla_objetos = {};
        $scope.id_objeto_actual = null;

        $scope.opciones_tabla_objetos = DTOptionsBuilder.newOptions()
          .withOption('ajax', {
           url: '/api/catalogo/mostrar?type=paginacion',
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
      
        $scope.columnas_tabla_objetos = [
            DTColumnBuilder.newColumn(null).withTitle('#').renderWith(
              function(data, type, full){
                  return ToolsService.printf('<a class="ui tiny blue tag label">{0}</a>',data.id);
              }
            )
            .withOption('width','5%')
            .notSortable(),
            
            DTColumnBuilder.newColumn(null).withTitle('Nombre').renderWith(
            function(data, type, full) {
                if (data.nombre_clase_objeto.toLowerCase() == 'reactivo') {
                    return data.nombre + '<img class="ui spopup datasheet icono" src="/img/data.png" data-content="Mostrar DataSheet" ng-click="cargar_datasheet(' + data.id + ')">';
                } else {
                    return data.nombre;
                }
            })
            .withOption('width','30%')
            .notSortable(),

            DTColumnBuilder.newColumn(null).withTitle('Unidad').renderWith(
              function(data, type, full) {
                return data.nombre_unidad+' ('+data.abreviatura_unidad+')';
            })
            .withOption('width','12%')
            .notSortable(),

            DTColumnBuilder.newColumn(null).withTitle('Especificaciones').renderWith(
            function(data, type, full) {
                return ToolsService.cut_string(data.especificaciones,60);
            }).notSortable(),
            
            DTColumnBuilder.newColumn(null).withTitle('Acciones').renderWith(
              function(data, type, full) {
                return '<div class="ui icon button blue spopup" data-content="Ver Objeto" ng-click="modal_ver_objeto('+data.id+')"><i class="unhide icon"></i></div>'+
                        '<div class="ui icon button green spopup"  data-content="Modificar Objeto" ng-click="modal_modificar_objeto('+data.id+')"><i class="edit icon"></i></div>'+ 
                        '<div class="ui icon button red spopup"  data-content="Eliminar Objeto" ng-click="modal_eliminar_objeto('+data.id+')"><i class="remove icon"></i></div>';
              }).withOption('width', '15%')
        ];

        ///Funciones 
        $scope.modal_ver_objeto = function(id){
          $scope.data_objeto = {};

          $http({
            method: 'GET',
            url: '/api/catalogo/mostrar?type=objeto&id='+id,
            data: $scope.DatosForm
          }).then(function(data){
            
            $scope.data_objeto = data.data;

            //Mostramos la modal
            angular.element('#modal_ver_objeto').modal('show');
          },function(data_error){
            $log.info(data_error);
          });
        };

        $scope.modal_modificar_objeto = function(id){
          //Desactivamos los mensajes
          $scope.mostrar_mensaje = false;

          $scope.id_objeto_actual = id;
          
          $http({
            method: 'GET',
            url: '/api/catalogo/mostrar?type=objeto&id='+id,
          }).then(function(data){

            $scope.DatosForm = data.data;
            $scope.DatosForm.cod_clase_objeto = $scope.DatosForm.cod_clase_objeto.toString();
            $scope.DatosForm.cod_unidad = $scope.DatosForm.cod_unidad.toString();

            setTimeout(function(){
              //Setteamos los valores de los dropdown
              angular.element('#unidad').dropdown('set selected',$scope.DatosForm.cod_unidad);
              angular.element('#clase_objeto').dropdown('set selected',$scope.DatosForm.cod_clase_objeto);
              
              //Mostramos la modal
              angular.element('#modal_modificar_objeto').modal('show');

            },300);
            
          },function(data_error){
            $log.info(data_error);
          });
        };

        $scope.procesar_modificar = function(){
          var id_objeto = $scope.id_objeto_actual;

          ToolsService.loading_button('btn-modificar',true);

          $http({
            method: 'POST',
            url: '/api/catalogo/actualizar-objeto?id='+id_objeto,
            data: $scope.DatosForm
          }).then(function(data){
            if(data.data.resultado){

                $scope.mostrar_mensaje = true;
                
                $scope.mensaje_validacion = {
                  titulo: 'Objeto modificado con exito',
                  icono: 'checkmark',
                  color: 'green',
                  mensajes: []
                };

                //Desactivamos el loading
                ToolsService.loading_button('btn-modificar',false);

                setTimeout(function(){
                  ToolsService.reload_tabla($scope,'tabla_objetos',function(){});
                },500);

            }else{
              $scope.mostrar_mensaje = true;
                
              $scope.mensaje_validacion = {
                titulo: 'Error al modificar el objeto',
                icono: 'remove',
                color: 'red',
                mensajes: data.data.mensajes
              };

              //Desactivamos el loading
              ToolsService.loading_button('btn-modificar',false);
            }

            $log.info($scope.DatosForm);
            
          },function(data_error){
            $log.info(data_error);
            //Desactivamos el loading
            ToolsService.loading_button('btn-modificar',false);
          });

        };

        $scope.modal_eliminar_objeto = function(id){
          //Seteamos a la variable el id del objetos que se va a eliminar
          $scope.id_objeto_actual = id;

          angular.element('#modal_eliminar_objeto').modal('show');
        };

        $scope.cerrar_modal_eliminar = function(){
          angular.element('#modal_eliminar_objeto').modal('hide');
        }

        $scope.procesar_eliminar = function(){
          
          var id_objeto = $scope.id_objeto_eliminar;

          $http({
            method: 'POST',
            url: '/api/catalogo/eliminar?id='+id_objeto,
          }).then(function(data){
            
            if(data.data.resultado){
              
              //Cerramos la modal
              $scope.cerrar_modal_eliminar();

              //Recargamos la tabla
              setTimeout(function(){
                ToolsService.reload_tabla($scope,'tabla_objetos',function(){});
              }, 500);                         
            }
            else{
              $log.info(data);
            }
          },function(data_error){
            $log.info(data_error);
          });
        } // procesar eliminar
      }// If == '/catalogo/ver/todos


      if($location.$$url == '/catalogo/registrar-unidad'){

        $scope.mostrar_mensaje = false;
        $scope.DatosForm = {};

        $scope.registrar_unidad = function(){
        
          var formulario = $('#formulario_crear_unidad');
          var is_valid_form = formulario.form(reglas_formulario_crear_unidad).form('is valid');

          if(is_valid_form){
            
            //Activamos el loading
            ToolsService.loading_button('btn-registrar',true);

            $http({
              method: 'POST',
              url: '/api/catalogo/registrar-unidad',
              data: $scope.DatosForm
            }).then(function(data){

              if(data.data.resultado){
                
                $scope.mostrar_mensaje = true;
                $scope.mensaje_validacion = {
                  titulo: 'Unidad creada con exito',
                  icono: 'checkmark',
                  color: 'green',
                  mensajes: ['La unidad ha sido creada']
                };

                $timeout(function(){
                  //Desactivamos el loading
                  ToolsService.loading_button('btn-registrar',false);
                  formulario.form('clear');
                }, 0, false);

              }
              else{

                $scope.mostrar_mensaje = true;
                $scope.mensaje_validacion = {
                  titulo: 'Hubo un error al guardar la informacion',
                  icono: 'remove',
                  color: 'red',
                  mensajes: data.data.mensajes
                };
              }

              //Desactivamos el loading
              ToolsService.loading_button('btn-registrar',false);

            },function(data_error){

              console.log(data_error);

              //Desactivamos el loading
              ToolsService.loading_button('btn-registrar',false);
            });
            
          } //If condicional
        }
    
      }// If == '/catalogo/registrar-objeto'


      if($location.$$url == '/catalogo/registrar-clase'){
        $scope.mostrar_mensaje = false;
        $scope.DatosForm = {};

        $scope.registrar_objeto = function(){
        
          var formulario = $('#formulario_crear_clase_objeto');
          var is_valid_form = formulario.form(reglas_formulario_crear_clase_objeto).form('is valid');

          if(is_valid_form){
            
            //Activamos el loading
            ToolsService.loading_button('btn-registrar',true);

            $http({
              method: 'POST',
              url: '/api/catalogo/registrar-clase-objeto',
              data: $scope.DatosForm
            }).then(function(data){

              if(data.data.resultado){
                
                $scope.mostrar_mensaje = true;
                $scope.mensaje_validacion = {
                  titulo: 'Clase creada con exito',
                  icono: 'checkmark',
                  color: 'green',
                  mensajes: ['Nueva clase de objeto creada']
                };

                $timeout(function(){
                  //Desactivamos el loading
                  ToolsService.loading_button('btn-registrar',false);
                  formulario.form('clear');
                }, 0, false);

              }
              else{

                $scope.mostrar_mensaje = true;
                $scope.mensaje_validacion = {
                  titulo: 'Hubo un error al guardar la informacion',
                  icono: 'remove',
                  color: 'red',
                  mensajes: data.data.mensajes
                };
              }

              //Desactivamos el loading
              ToolsService.loading_button('btn-registrar',false);

            },function(data_error){

              console.log(data_error);

              //Desactivamos el loading
              ToolsService.loading_button('btn-registrar',false);
            });
            
          } //If condicional
        }
      }// If == '/catalogo/registrar-clase'

    
  }]
);