
/// Controlador para usuarios

simci.controller('UsuariosController', ['$scope','$http','$log','$route', '$routeParams', '$location', 
  function ($scope, $http, $log , $route, $routeParams, $location){
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
        url: "#/usuarios/eliminar"
      },
      {
        nombre:"ver permisos",
        descripcion: "Opcion para Ver, Actualizar, Eliminar los permisos registrados en el sistema",
        url: "#/usuarios/modificar"
      },
      {
        nombre:"crear tipos de usuario",
        descripcion: "Opcion para Ver, Actualizar, Eliminar los permisos registrados en el sistema",
        url: "#/usuarios/modificar"
      },
    ];
    
    $log.info($routeParams);
    $log.info($location);

    $scope.registrar_usuario = function(){
    
      var is_valid_form = $('#formulario_crear_usuario')
      .form(reglas_formulario_crear_usuario)
      .form('is valid');

      if(is_valid_form){
        $log.info($scope.DatosForm);
        $http({
          method: 'POST',
          url: '/api/usuarios/crear-usuario-completo',
          data: $scope.DatosForm
        }).then(function(data){
          console.log(data.data);
        },function(data_error){
          console.log(data_error);
        });
      }
    }


  }]
);
    
    