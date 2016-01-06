
if( typeof simci !== 'undefined'){
 
  simci.config(['$routeProvider',function($routeProvider) {
    //Esto es solo de prueba asi es que debe llevar el orden
    $routeProvider.
      when('/prueba', {
        templateUrl: '/views/usuarios/muestra',
        controller: 'PruebaController'
      }).
      otherwise({
        redirectTo: '/'
      });
  }]);

}
else{
  alert("La app SIMCI no ha sido declarada en AngularJs");
}