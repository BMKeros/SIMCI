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
