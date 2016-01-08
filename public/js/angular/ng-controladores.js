(function(){

  var simci = angular.module('SIMCI', ['ngRoute'], function($interpolateProvider) {
          $interpolateProvider.startSymbol('<%');
          $interpolateProvider.endSymbol('%>');
  });

  simci.controller('BuscarReactivoController',  ['$scope','$http','$log', function ($scope, $http, $log){
        		
  }]);

  //Ejemplo del controlador de las vistas de ng-route

  simci.controller('PruebaController', ['$scope','$http','$log','$route', '$routeParams', '$location', 
    function ($scope, $http, $log , $route, $routeParams, $location){
      $log.info($routeParams);
      $log.info($location);
    }]
  );

  
  //Seteamos de manera global la app simci
  window.simci = simci;

  return simci;

})();