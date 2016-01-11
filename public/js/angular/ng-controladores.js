<<<<<<< HEAD
var simci = angular.module('SIMCI', ['ngRoute'], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
});

simci.controller('BuscarReactivoController',  ['$scope','$http','$log', function ($scope, $http, $log){
      		
}]);

//Ejemplo del controlador de las vistas de ng-route
simci.controller('PruebaController',  ['$scope','$http','$log', function ($scope, $http, $log){
    $log.info("algo");
}]);

//controlador para registrar usuarios
simci.controller('RegistroUsuario', ['$scope', '$http', function($scope, $http){
	$scope.hola = "algo";
	//funcion posible para hacer las consultas de todos los usuarios
	$scope.nuevo_usuario = function(){
		$http.post('NuevoUsuario').success(function(data){
			console.log(data);
		})
	}
}]);
=======
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
      }]
    );
    
  }
  else{

    throw new Error( "La app SIMCI no ha sido declarada en AngularJs" );
  }

})(typeof simci === 'undefined' ? undefined : simci);
>>>>>>> b18cf4cdcb43a85be42bf203c4452e794c4df557
