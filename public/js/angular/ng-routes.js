(function(GlobalApp){

  if( typeof GlobalApp !== 'undefined'){
 
    GlobalApp.config(['$routeProvider','$locationProvider',function($routeProvider,$locationProvider) {
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

    throw new Error( "La app SIMCI no ha sido declarada en AngularJs" );

  }

})(typeof simci === 'undefined' ? undefined : simci);