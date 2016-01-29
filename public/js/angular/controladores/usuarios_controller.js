
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
  function ($scope, $http, $log ,$timeout, $route, $routeParams, $location, $compile,DTOptionsBuilder, DTColumnBuilder){
    $scope.modulo = {};

    $scope.DatosForm = {}; // Objeto para los datos de formulario

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
        icono: 'user'
      },
      {
        nombre:"ver usuarios",
        descripcion: "Opcion para Ver, Actualizar, Eliminar los usuarios registrados en el sistema",
        url: "#/usuarios/ver/todos",
        icono: 'eye'
      },
      {
        nombre:"crear permisos",
        descripcion: "Opcion se podran crear nuevos permisos de usuarios para el sistema",
        url: "#/usuarios/crear/permiso",
        icono: 'user'
      },
      {
        nombre:"ver permisos",
        descripcion: "Opcion para Ver, Actualizar, Eliminar los permisos registrados en el sistema",
        url: "#/usuarios/mostrar/permisos",
        icono: 'eye'
      },
      {
        nombre:"crear tipos de usuario",
        descripcion: "Opcion para Ver, Actualizar, Eliminar los permisos registrados en el sistema",
        url: "#/usuarios/crear/tipo-usuario",
        icono: 'user'
      },
    ];
    
    $log.info($routeParams);
    $log.info($location);

    if($location.$$url == '/usuarios/crear'){
        
        $scope.mostrar_mensaje = false;

        $scope.registrar_usuario = function(){
        
          var formulario = $('#formulario_crear_usuario');
          var is_valid_form = formulario.form(reglas_formulario_crear_usuario).form('is valid');

          if(is_valid_form){
            
            //Activamos el loading
            $('#btn-registrar').addClass('loading').prop('disabled',true);

            $http({
              method: 'POST',
              url: '/api/usuarios/crear-usuario-completo',
              data: $scope.DatosForm
            }).then(function(data){

              if(data.data.resultado){
                
                $scope.mostrar_mensaje = true;
                $scope.mensaje_validacion = {
                  titulo: 'Usuario creado con exito',
                  icono: 'checkmark',
                  color: 'green',
                  mensajes: ['El usuario ha sido almacenado en la base de datos.']
                };

                $timeout(function(){
                  //Desactivamos el loading
                  $('#btn-registrar').removeClass('loading').prop('disabled',false);
                  formulario.form('clear');
                }, 0, false);

              }
              else{

                $scope.mostrar_mensaje = true;
                $scope.mensaje_validacion = {
                  titulo: 'Hubo un error al guardar el formulario',
                  icono: 'remove',
                  color: 'red',
                  mensajes: data.data.mensajes
                };
              }

              //Desactivamos el loading
              $('#btn-registrar').removeClass('loading').prop('disabled',false);

            },function(data_error){

              console.log(data_error);

              //Desactivamos el loading
              $('#btn-registrar').removeClass('loading').prop('disabled',false);
            });
            
          } //If condicional
        }
    
    }// If == '/usuarios/crear'

    if($location.$$url == '/usuarios/ver/todos'){

      $scope.tabla_usuarios = {};

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
        $http({
          method: 'GET',
          url: '/api/usuarios/mostrar?type=usuario_full&id='+id,
          data: $scope.DatosForm
        }).then(function(data){
          $log.info(data);
          $scope.data_usuario = data.data;

          /*$scope.DatosForm = {
            usuario: data.data.usuario.usuario,
            email: data.data.usuario.email,
            tipo_usuario: data.data.usuario.cod_tipo_usuario,
            permisos: data.data.usuario.data_permisos,
            activo: data.data.usuario.activo,
            primer_nombre: data.data.persona.primer_nombre,
            segundo_nombre: data.data.persona.segundo_nombre,
            primer_apellido: data.data.persona.primer_apellido,
            segundo_apellido: data.data.persona.segundo_apellido,
            cedula: data.data.persona.cedula,
            sexo: data.data.persona.sexo_id.toString(),
            fecha_nacimiento: data.data.persona.fecha_nacimiento,
          };*/

          //Mostramos la modal
          angular.element('#modal_modificar_usuario').modal('show');
        },function(data_error){
          $log.info(data_error);
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
              $scope.tabla_usuarios.reloadData(function(data){}, false);  
            }, 500);                         
          }
          else{
            $log.info(data);
          }
        },function(data_error){
          $log.info(data_error);
        });
      }

    }// If
    
  }]
);