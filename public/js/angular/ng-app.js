(function(){
  var simci = angular.module('SIMCI', ['ngRoute'], function($interpolateProvider) {
          $interpolateProvider.startSymbol('<%');
          $interpolateProvider.endSymbol('%>');
  });

   
  //Seteamos de manera global la app simci
  window.simci = simci;

  return simci;
})();