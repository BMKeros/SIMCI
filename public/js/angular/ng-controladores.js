var simci = angular.module('SIMCI', [], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
});


simci.controller('BuscarReactivoController',  ['$scope','$http','$log', function ($scope, $http, $log){
    $scope.cambio = function(){

   		$http({
   			method: 'GET',
   			url: 'simci.bmkeros'
   		}).then(function success(response){
       $log.info(response);

   		}, function error(response){
        $log.info(response);

   		});

   }
		
}]);