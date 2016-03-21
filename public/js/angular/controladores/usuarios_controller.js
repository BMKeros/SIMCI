
/// Controlador para usuarios

simci.controller('UsuariosController', [
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


    $scope.modulo.nombre = "Usuarios";
    $scope.modulo.icono = {
      tipo: "users",
      color: "blue"
    };

    $scope.modulo.opciones = [
      {
        nombre:"crear usuarios",
        descripcion: "Opcion para crear nuevos usuarios en el sistema",
        url: "#/usuarios/crear",
        icono: 'user',
        show_in:[TIPO_USER_ROOT, TIPO_USER_ADMIN]
      },
      {
        nombre:"ver usuarios",
        descripcion: "Opcion para Ver, Actualizar, Eliminar los usuarios registrados en el sistema",
        url: "#/usuarios/ver/todos",
        icono: 'eye',
        show_in:[TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_SUPERVISOR, TIPO_USER_PROFESOR]
      },
      
      {
        nombre:"crear tipos de usuario",
        descripcion: "Opcion para crear nuevos tipos de usuarios",
        url: "#/usuarios/crear/tipo-usuario",
        icono: 'user',
        show_in:[TIPO_USER_ROOT, TIPO_USER_ADMIN]
      },
    ];
    
    $log.info($routeParams);
    $log.info($location);

    if($location.$$url == '/usuarios/crear'){
        
        $scope.mostrar_mensaje = false;

        $scope.registrar_usuario = ToolsService.registrar_dinamico($scope,$http,$timeout,{
          url: '/api/usuarios/crear-usuario-completo',
          formulario:{
            id:'formulario_crear_usuario',
            reglas: reglas_formulario_crear_usuario
          },
          exito:{
            titulo: 'Usuario creado con exito',
            mensajes: ['El usuario ha sido almacenado en la base de datos.']
          }
        });
    
    }// If == '/usuarios/crear'

    if($location.$$url == '/usuarios/ver/todos'){

      $scope.tabla_usuarios = {};
      $scope.id_objeto_actual = null;
      
      //Variable que mantiene el id de usuario que se va a eliminar
      $scope.id_usuario_eliminar = null;

      $scope.opciones_tabla_usuarios = DTOptionsBuilder.newOptions()
        .withOption('ajax', {
         url: '/api/usuarios/mostrar?type=paginacion',
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
    
      $scope.columnas_tabla_usuarios = [
          DTColumnBuilder.newColumn(null).withTitle('ID').renderWith(
            function(data, type, full){
              return ToolsService.printf('<a class="ui tiny blue tag label">{0}</a>',data.id);
            }
          )
          .withOption('width','5%')
          .notSortable(),
          
          DTColumnBuilder.newColumn('usuario').withTitle('Usuario')
          .withOption('width','15%')
          .notSortable(),
          
          DTColumnBuilder.newColumn('email').withTitle('Email')
          .withOption('width','25%')
          .notSortable(),
          
          DTColumnBuilder.newColumn('permisos').withTitle('Permisos').renderWith(
            function(data, type, full) {
              var x = '';
              data = JSON.parse(data);
              if(data){
                data.map(function(obj){
                  x += '['+obj.nombre.toUpperCase()+']';
                });
              }
              return x;
          }).notSortable(),
          
          DTColumnBuilder.newColumn('nombre_tipo_usuario').withTitle('Tipo de Usuario')
          .withOption('width','15%')
          .notSortable(),

          DTColumnBuilder.newColumn(null).withTitle('Acciones').renderWith(
            function(data, type, full) {
              return '<a class="ui icon button blue spopup" data-content="Ver Usuario" ng-click="modal_ver_usuario('+data.id+')"><i class="unhide icon"></i></a>'+
                      '<a class="ui icon button green spopup"  data-content="Modificar Usuario" ng-click="modal_modificar_usuario('+data.id+')"><i class="edit icon"></i></a>'+
                      '<a class="ui icon button red spopup"  data-content="Eliminar Usuario" ng-click="modal_eliminar_usuario('+data.id+')"><i class="remove icon"></i></a>';
          })
          .withOption('width','15%')
          .notSortable()
      ];

      ///Funciones 
      $scope.modal_ver_usuario = function(id){
        $scope.data_usuario = {};

        ToolsService.mostrar_modal_dinamico($scope,$http,{
          url : '/api/usuarios/mostrar?type=usuario_full&id='+id,
          scope_data_save_success: 'data_usuario',
          id_modal: 'modal_ver_usuario',
          callbackSuccess: function(){
            $scope['data_usuario']['permisos'] = (!!$scope['data_usuario']['permisos'])?(JSON.parse($scope['data_usuario']['permisos'])):([]);  
          }
        });
      };

      $scope.modal_modificar_usuario = function(id){

        $scope.id_usuario_actual = id;

        $http({
          method: 'GET',
          url: '/api/usuarios/mostrar?type=usuario_full&id='+id,
          data: $scope.DatosForm
        }).then(function(data){
          $scope.data_usuario = data.data;

          //Parseamos los permisos que vienen en JSON
          data.data.permisos = (!!data.data.permisos)?(JSON.parse(data.data.permisos)):([]);

          $scope.DatosForm = {
            usuario: data.data.usuario,
            email: data.data.email,
            tipo_usuario: data.data.cod_tipo_usuario,
            permisos: data.data.permisos.map(function(objeto){
              return objeto.cod_permiso;
            }),
            activo: data.data.activo,
          };

          $scope.DatosForm.primer_nombre =  data.data.primer_nombre || null;
          $scope.DatosForm.segundo_nombre = data.data.segundo_nombre || null;
          $scope.DatosForm.primer_apellido = data.data.primer_apellido || null;
          $scope.DatosForm.segundo_apellido = data.data.segundo_apellido || null;
          $scope.DatosForm.cedula = data.data.cedula || null;
          $scope.DatosForm.sexo = (!!data.data.sexo_id)?(data.data.sexo_id.toString()):(null);
          $scope.DatosForm.fecha_nacimiento = data.data.fecha_nacimiento || null;
          

          $timeout(function(){
            //Setteamos los dropdown con sus respectivos valores
            angular.element('#permisos').dropdown('set selected',$scope.DatosForm.permisos);
            angular.element('#tipo_usuario').dropdown('set selected',$scope.DatosForm.tipo_usuario);
            angular.element('#sexo').dropdown('set selected',$scope.DatosForm.sexo);
          },0,false);
          
          //Mostramos la modal
          angular.element('#modal_modificar_usuario').modal('show');
        },function(data_error){
          $log.info(data_error);
        });
      };

      $scope.procesar_modificar = function(){
          var id_usuario = $scope.id_usuario_actual;

          ToolsService.loading_button('btn-modificar',true);

          $http({
            method: 'POST',
            url: '/api/usuarios/actualizar-usuario-completo?id='+id_usuario,
            data: $scope.DatosForm
          }).then(function(data){
            if(data.data.resultado){

                $scope.mostrar_mensaje = true;
                
                $scope.mensaje_validacion = {
                  titulo: 'Usuario modificado con exito',
                  icono: 'checkmark',
                  color: 'green',
                  mensajes: []
                };

                //Desactivamos el loading
                ToolsService.loading_button('btn-modificar',false);

                setTimeout(function(){
                  ToolsService.reload_tabla($scope,'tabla_usuarios',function(){});
                },500);

            }else{
              $scope.mostrar_mensaje = true;
                
              $scope.mensaje_validacion = {
                titulo: 'Error al modificar el usuario',
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

      $scope.modal_eliminar_usuario = function(id){
    
        alertify.confirm('Seguro que desea eliminar este usuario!',
          //onok consulta para verificar si tiene relaciones con otras tablas
          function(){
            $http({
              method: 'POST',
              url: '/api/usuarios/verificar?id='+id,
            }).then(function(data){
              //verificamos si el usuario tiene relacion en otras tablas
              if(data.data.resultado){
                alertify.alert('No puede eliminar este usuario debido que mantiene relaciones con otras entidades. Verifique para proceder con la accion.');
              }
              else{
                //sino tiene relaciones, que confirme para que elimine el usuario
                alertify.confirm("Confirme si desea eliminar", 
                  //onok para eliminar el usuairo
                  function(){
                    $http({
                      method: 'POST',
                      url: '/api/usuarios/eliminar?id='+id,
                    }).then(function(data){
                      
                      if(data.data.resultado){
                        //Recargamos la tabla
                        setTimeout(function(){
                          ToolsService.reload_tabla($scope,'tabla_usuarios',function(data){});
                        }, 500);                         
                      }
                      else{
                        //$log.info(data.data);
                        alertify.error("Ha ocurrido un error al realizar la operacion");
                      }
                    },function(data_error){
                      //$log.info(data_error);
                      alertify.error("Ha ocurrido un error al realizar la operacion");
                    });
                  }
                ).set('title', '¡Alerta!');
              }
            },
            function(data_error){
              //$log.info(data_error);
              ToolsService.generar_alerta_status(data_error);
            });
          }
        ).set('title', '¡Alerta!');
      };
    }// If == '/usuarios/ver-todos'

      if($location.$$url == '/usuarios/crear/tipo-usuario'){
        $scope.mostrar_mensaje = false;
        $scope.DatosForm = {};

        $scope.registrar_tipo_usuario = ToolsService.registrar_dinamico($scope,$http,$timeout,{
          url: '/api/usuarios/registrar-tipo-usuario',
          formulario:{
            id:'formulario_crear_tipo_usuario',
            reglas: reglas_formulario_crear_tipo_usuario
          },
          exito:{
            titulo: 'Tipo de usuario creado con exito',
            mensajes: ['Tipo de usuario guardado en la base de datos.']
          }
        });
      }// If == '/catalogo/registrar-clase'

    
  }]
);