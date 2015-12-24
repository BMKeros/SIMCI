var simci = angular.module('SIMCI', [], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
});


simci.controller('BuscarReactivoController',  ['$scope','$http','$log', function ($scope, $http, $log){
    
    

    $scope.cambio = function(){

   		$http({
   			method: 'GET',
   			url: '/busquedas/busqueda/{$scope.palabras}',
   		}).then(function success(response){
       //console.log(response);
       $scope.reactivos = response;

   		}, function error(response){
        

   		});

   }
		
}]);
