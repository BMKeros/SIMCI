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