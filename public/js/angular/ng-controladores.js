var myapp = angular.module('SIMCI', [], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
});

myapp.controller('buscar_reactivoController', function ($scope, $http){
   $scope.cambio =function(){

   		$http({
   			method: 'GET',
   			url: 'simci.bmkeros'
   		}).then(function success(response){
       $log.info(response);

   		}, function error(response){
        $log.info(response);

   		});

   }
		
});