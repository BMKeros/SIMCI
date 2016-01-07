
if( typeof simci !== 'undefined'){
 
  simci.config(['$routeProvider','$locationProvider',function($routeProvider,$locationProvider) {
    //Esto es solo de prueba asi es que debe llevar el orden
    $routeProvider.
      when('/prueba', {
        templateUrl: '/views/usuarios/registrar_usuario',
        controller: 'PruebaController'
      }).
      otherwise({
        redirectTo: '/'
      });

      //$locationProvider.html5Mode(true);
  }]);

}
else{
  alert("La app SIMCI no ha sido declarada en AngularJs");
}