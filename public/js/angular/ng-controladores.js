(function(GlobalApp){

  if( typeof GlobalApp !== 'undefined'){

    simci.controller('BuscarReactivoController',  ['$scope','$http','$log', function ($scope, $http, $log){
          		
    }]);


    simci.controller('UsuariosController', ['$scope','$http','$log','$route', '$routeParams', '$location', 
      function ($scope, $http, $log , $route, $routeParams, $location){
        
        $scope.opciones = [
          {nombre:"Crear Usuarios"},
          {nombre:"Ver Usuarios"},
          {nombre:"Eliminar Usuarios"},
          {nombre:"Modificar Usuarios"},
          {nombre:"Actualizar Usuarios"}
        ];
        
        $log.info($routeParams);
        $log.info($location);


        $scope.registrar_nuevo_usuario = function(){
          $http({
            method: 'POST',
            url: '/usuarios/nuevo-usuario',
            usuario: '$scope.M_usuario',
            email: '$scope.M_email',
            password: '$scope.M_password'
          }).then(function success(data){
            console.log(data);
          },function error(data_error){
            console.log(data_error);
          });
        }
      }]
    );
    
  }
  else{

    throw new Error( "La app SIMCI no ha sido declarada en AngularJs" );
  }

})(typeof simci === 'undefined' ? undefined : simci);
