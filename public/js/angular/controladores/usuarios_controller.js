
/// Controlador para usuarios

simci.controller('UsuariosController', ['$scope','$http','$log','$timeout','$route', '$routeParams', '$location','$compile','DTOptionsBuilder', 'DTColumnBuilder',
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
        url: "#/usuarios/crear"
      },
      {
        nombre:"ver usuarios",
        descripcion: "Opcion para Ver, Actualizar, Eliminar los usuarios registrados en el sistema",
        url: "#/usuarios/ver/todos"
      },
      {
        nombre:"crear permisos",
        descripcion: "Opcion se podran crear nuevos permisos de usuarios para el sistema",
        url: "#/usuarios/crear/permiso"
      },
      {
        nombre:"ver permisos",
        descripcion: "Opcion para Ver, Actualizar, Eliminar los permisos registrados en el sistema",
        url: "#/usuarios/modificar"
      },
      {
        nombre:"crear tipos de usuario",
        descripcion: "Opcion para Ver, Actualizar, Eliminar los permisos registrados en el sistema",
        url: "#/usuarios/crear/tipo-usuario"
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
        $log.info(row);
        $log.info(dataIndex);
      });
    
      $scope.columnas_tabla_usuarios = [
          DTColumnBuilder.newColumn('id').withTitle('ID').notSortable(),
          DTColumnBuilder.newColumn('usuario').withTitle('Usuario').notSortable(),
          DTColumnBuilder.newColumn('email').withTitle('Email').notSortable(),
          DTColumnBuilder.newColumn('attr_permisos').withTitle('Permiso').notSortable(),
          DTColumnBuilder.newColumn('cod_tipo_usuario').withTitle('Tipo de Usuario').notSortable(),
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
          url: '/api/usuarios/mostrar?type=usuario_full&id='+id,
          data: $scope.DatosForm
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

          //Mostramos la modal
          angular.element('#modal_modificar_usuario').modal('show');
        },function(data_error){
          $log.info(data_error);
        });
      };

      $scope.modal_eliminar_usuario = function(id){
        angular.element('#modal_eliminar_usuario').modal('show');
      };

    }// If
    
  }]
);