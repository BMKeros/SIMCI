(function(GlobalApp){

  if( typeof GlobalApp !== 'undefined'){
 
    GlobalApp.config(['$routeProvider','$locationProvider',function($routeProvider,$locationProvider) {
      
      //Rutas para usuarios
      $routeProvider.
        when('/usuarios', {
          templateUrl: '/views/layouts/layout_main_modulos',
          controller: 'UsuariosController'
        }).
        when('/usuarios/crear', {
          templateUrl: '/views/usuarios/crear_usuario',
          controller: 'UsuariosController'
        }).
        when('/usuarios/ver/todos', {
          templateUrl: '/views/usuarios/mostrar_usuarios',
          controller: 'UsuariosController'
        }).
        when('/usuarios/eliminar/:idUsuario', {
          templateUrl: '/views/usuarios/principal_usuarios',
          controller: 'UsuariosController'
        }).
        when('/usuarios/modificar/:idUsuario', {
          templateUrl: '/views/usuarios/principal_usuarios',
          controller: 'UsuariosController'
        }).

        when('/usuarios/crear/permiso', {
          templateUrl: '/views/usuarios/crear_permisos',
          controller: 'UsuariosController'
        }).

        when('/usuarios/mostrar/permisos', {
          templateUrl: '/views/usuarios/mostrar_permisos',
          controller: 'UsuariosController'
        }).

        when('/usuarios/crear/tipo-usuario', {
          templateUrl: '/views/usuarios/crear_tipo_usuario',
          controller: 'UsuariosController'
        }).

        //Rutas para inventario
        when('/inventario', {
          templateUrl: '/views/layouts/layout_main_modulos',
          controller: 'InventarioController'
        }).

        when('/inventario/ver/todos', {
          templateUrl: '/views/inventario/mostrar_elementos',
          controller: 'InventarioController'
        }).

        when('/inventario/registrar-elemento', {
          templateUrl: '/views/inventario/crear_elemento',
          controller: 'InventarioController'
        }).

        when('/inventario/crear-almacen', {
          templateUrl: '/views/inventario/crear_almacen',
          controller: 'InventarioController'
        }).

         when('/inventario/registrar-estante', {
          templateUrl: '/views/inventario/crear_estante',
          controller: 'InventarioController'
        }).


        //Rutas para catalogo
        when('/catalogo', {
          templateUrl: '/views/layouts/layout_main_modulos',
          controller: 'CatalogoController'
        }).
        when('/catalogo/registrar-objeto', {
          templateUrl: '/views/catalogo/crear_objeto',
          controller: 'CatalogoController'
        }).
        when('/catalogo/ver/todos', {
          templateUrl: '/views/catalogo/mostrar_catalogo',
          controller: 'CatalogoController'
        }).
        when('/catalogo/registrar-unidad', {
          templateUrl: '/views/catalogo/registrar_unidad',
          controller: 'CatalogoController'
        }).
        when('/catalogo/registrar-clase', {
          templateUrl: '/views/catalogo/registrar_clase_objeto',
          controller: 'CatalogoController' 
        }).

        //Rutas laboratorio
        when('/laboratorio', {
          templateUrl: '/views/layouts/layout_main_modulos',
          controller: 'LaboratorioController'
        }).
        when('/laboratorio/crear-laboratorio', {
          templateUrl: '/views/laboratorio/crear_laboratorio',
          controller: 'LaboratorioController' 
        }).
        when('/laboratorio/ver/todos', {
          templateUrl: '/views/laboratorio/mostrar_laboratorio',
          controller: 'LaboratorioController' 
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