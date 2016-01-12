(function(GlobalApp){

  if( typeof GlobalApp !== 'undefined'){
 
    GlobalApp.config(['$routeProvider','$locationProvider',function($routeProvider,$locationProvider) {
      //Esto es solo de prueba asi es que debe llevar el orden
      $routeProvider.
        when('/usuarios', {
          templateUrl: '/views/usuarios/principal_usuarios',
          controller: 'UsuariosController'
        }).
        otherwise({
          redirectTo: function(){

            return '/';
          }
        });

        //$locationProvider.hashPrefix('/'); //Este es usado para darle un pefijo a # de angular
        //$locationProvider.html5Mode(true);
        
    }]);

  }
  else{

    throw new Error( "La app SIMCI no ha sido declarada en AngularJs" );

  }

})(typeof simci === 'undefined' ? undefined : simci);