
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
        show_in:[TIPO_USER_ROOT]
      },
      {
        nombre:"ver usuarios",
        descripcion: "Opcion para Ver, Actualizar, Eliminar los usuarios registrados en el sistema",
        url: "#/usuarios/ver/todos",
        icono: 'eye',
        show_in:[TIPO_USER_ROOT, TIPO_USER_SUPERVISOR, TIPO_USER_PROFESOR]
      },
      
      {
        nombre:"crear tipos de usuario",
        descripcion: "Opcion para crear nuevos tipos de usuarios",
        url: "#/usuarios/crear/tipo-usuario",
        icono: 'user',
        show_in:[TIPO_USER_ROOT]
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
      .withColumnFilter({
            aoColumns: [{
                type: 'number'
            }, {
                type: 'text',
                bRegex: true,
                bSmart: true
            }, {
                type: 'select',
                bRegex: false,
                values: ['Yoda', 'Titi', 'Kyle', 'Bar', 'Whateveryournameis']
            }]
      })
      .withPaginationType('full_numbers')
      .withOption('processing', true)
      .withOption('serverSide', true)
      .withOption('createdRow', function(row, data, dataIndex) {
        $compile(angular.element(row).contents())($scope);

        // 5 Celda de acciones en la tabla
        angular.element($('td',row).eq(5).get(0)).css({'width':'135px'});
      });
    
      $scope.columnas_tabla_usuarios = [
          DTColumnBuilder.newColumn('id').withTitle('ID').notSortable(),
          DTColumnBuilder.newColumn('usuario').withTitle('Usuario').notSortable(),
          DTColumnBuilder.newColumn('email').withTitle('Email').notSortable(),
          
          DTColumnBuilder.newColumn('data_permisos').withTitle('Permisos').renderWith(
            function(data, type, full) {
              var x = '';
              data.map(function(obj){
                x += '['+obj.nombre.toUpperCase()+']';
              });
              return x;
          }).notSortable(),
          
          DTColumnBuilder.newColumn('data_tipo_usuario.descripcion').withTitle('Tipo de Usuario').notSortable(),
          DTColumnBuilder.newColumn(null).withTitle('Acciones').renderWith(
            function(data, type, full) {
              return '<a class="ui icon button blue" data-content="Ver Usuario" ng-click="modal_ver_usuario('+data.id+')"><i class="unhide icon"></i></a>
                      <a class="ui icon button green"  data-content="Modificar Usuario" ng-click="modal_modificar_usuario('+data.id+')"><i class="edit icon"></i></a>  
                      <a class="ui icon button red "  data-content="Eliminar Usuario" ng-click="modal_eliminar_usuario('+data.id+')"><i class="remove icon"></i></a>';
          })

      ];


      ///Funciones 
      $scope.modal_ver_usuario = function(id){
        $scope.data_usuario = {};

        $http({
          method: 'GET',
          url: '/api/usuarios/mostrar?type=usuario_full&id='+id
        }).then(function(data){
          $log.info(data);
          $scope.data_usuario = data.data;
          
          //Mostramos la modal
          angular.element('#modal_ver_usuario').modal('show');
        },function(data_error){
          $log.info(data_error);
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

          $scope.DatosForm = {
            usuario: data.data.usuario.usuario,
            email: data.data.usuario.email,
            tipo_usuario: data.data.usuario.cod_tipo_usuario,
            permisos: data.data.usuario.data_permisos.map(function(objeto){
              return objeto.codigo;
            }),
            activo: data.data.usuario.activo,
          };

          //Si posee datos personale se le agregan
          if(data.data.persona){
            $scope.DatosForm.primer_nombre =  data.data.persona.primer_nombre || null;
            $scope.DatosForm.segundo_nombre = data.data.persona.segundo_nombre || null;
            $scope.DatosForm.primer_apellido = data.data.persona.primer_apellido || null;
            $scope.DatosForm.segundo_apellido = data.data.persona.segundo_apellido || null;
            $scope.DatosForm.cedula = data.data.persona.cedula || null;
            $scope.DatosForm.sexo = data.data.persona.sexo_id.toString() || null;
            $scope.DatosForm.fecha_nacimiento = data.data.persona.fecha_nacimiento || null;
          }

          $timeout(function(){
            //Setteamos los dropdown con sus respectivos valores
            angular.element('#permisos').dropdown('set selected',$scope.DatosForm.permisos);
            angular.element('#tipo_usuario').dropdown('set selected',$scope.DatosForm.tipo_usuario);
            angular.element('#sexo').dropdown('set selected',$scope.DatosForm.sexos);
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
        //Seteamos a la variable el id del usuario que se va a eliminar
        $scope.id_usuario_eliminar = id;

        angular.element('#modal_eliminar_usuario').modal('show');
      };

      $scope.cerrar_modal_eliminar = function(){
        angular.element('#modal_eliminar_usuario').modal('hide');
      }

      $scope.procesar_eliminar = function(){
        
        var id_usuario = $scope.id_usuario_eliminar;

        $http({
          method: 'POST',
          url: '/api/usuarios/eliminar?id='+id_usuario,
        }).then(function(data){
          
          if(data.data.resultado){
            
            //Cerramos la modal
            $scope.cerrar_modal_eliminar();

            //Recargamos la tabla
            setTimeout(function(){
              ToolsService.reload_tabla($scope,'tabla_usuarios',function(data){});
            }, 500);                         
          }
          else{
            $log.info(data);
          }
        },function(data_error){
          $log.info(data_error);
        });
      }// Procesar eliminar

    }// If

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