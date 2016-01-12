(function(GlobalApp){

  if( typeof GlobalApp !== 'undefined'){

    simci.controller('BuscarReactivoController',  ['$scope','$http','$log', function ($scope, $http, $log){
          		
    }]);


    simci.controller('UsuariosController', ['$scope','$http','$log','$route', '$routeParams', '$location', 
      function ($scope, $http, $log , $route, $routeParams, $location){
        $scope.modulo = {};

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


        $scope.registrar_nuevo_usuario = function(){
          $http({
            method: 'POST',
            url: '/usuarios/nuevo-usuario',
            {
              usuario: '$scope.M_usuario',
              email: '$scope.M_email',
              password: '$scope.M_password'
            }
          }).then(function success(data){
            console.log(data);
          },function error(data_error){
            console.log(data_error);
          });
        }
      }]
    );


    simci.controller('InventarioController', ['$scope','$http','$log','$route', '$routeParams', '$location', 
      function ($scope, $http, $log , $route, $routeParams, $location){
        
        $scope.modulo = {};

        $scope.modulo.nombre = "Inventario";
        $scope.modulo.icono = {
          tipo: "archive",
          color: "green"
        };
        
        $scope.modulo.opciones = [
          {
            nombre:"crear almacen",
            descripcion: "Opcion para crear nuevos usuarios en el sistema",
            url: "#/usuarios/crear"
          },
        ];
        
        $log.info($routeParams);
        $log.info($location);


        
      }]
    );
    
  }
  else{

    throw new Error( "La app SIMCI no ha sido declarada en AngularJs" );
  }

})(typeof simci === 'undefined' ? undefined : simci);
