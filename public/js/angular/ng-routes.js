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
        when('/usuarios/crear/tipo-usuario', {
          templateUrl: '/views/usuarios/crear_tipo_usuario',
          controller: 'UsuariosController'
        }).

        //Rutas para inventario
        when('/inventario', {
          templateUrl: '/views/layouts/layout_main_modulos',
          controller: 'InventarioController'
        }).

        when('/inventario/registrar-elemento', {
          templateUrl: '/views/inventario/crear_elemento',
          controller: 'InventarioController'  
        }).

         when('/inventario/ver/todos', {
          templateUrl: '/views/inventario/mostrar_elementos',
          controller: 'InventarioController'
        }).

        when('/inventario/registrar-almacen', {
          templateUrl: '/views/inventario/crear_almacen',
          controller: 'InventarioController'
        }).

         when('/inventario/registrar-sub-dimension', {
          templateUrl: '/views/inventario/crear_sub_dimension',
          controller: 'InventarioController'
        }).

        when('/inventario/registrar-agrupacion', {
          templateUrl: '/views/inventario/crear_agrupacion',
          controller: 'InventarioController'
        }).

        when('/inventario/registrar-sub-agrupacion', {
          templateUrl: '/views/inventario/crear_sub_agrupacion',
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
         when('/laboratorio/registrar-stock', {
          templateUrl: '/views/laboratorio/registrar_stock',
          controller: 'LaboratorioController' 
        }).
          when('/laboratorio/mover-stock', {
          templateUrl: '/views/laboratorio/mover_stock',
          controller: 'LaboratorioController' 
        }).

        //Rutas Reportes
        when('/reporte', {
          templateUrl: '/views/layouts/layout_main_modulos',
          controller: 'ReporteController'
        }).
        when('/reporte/crear-reporte', {
          templateUrl: '/views/reportes/crear_reportes',
          controller: 'ReporteController'
        }).
        when('/reporte/ver/todos', {
          templateUrl: '/views/reportes/mostrar_reportes',
          controller: 'ReporteController'
        }).

 		//Rutas Consulta
        when('/consulta', {
          templateUrl: '/views/layouts/layout_main_modulos',
          controller: 'ConsultaController'
        }).
        when('/consulta/realizar-consultas', {
          templateUrl: '/views/consultas/crear_consultas',
          controller: 'ConsultaController'
        }).

        //Rutas Ordenes
        when('/ordenes', {
          templateUrl: '/views/layouts/layout_main_modulos',
          controller: 'OrdenesController'
        }).
        when('/ordenes/crear-ordenes', {
          templateUrl: '/views/ordenes/generar_ordenes',
          controller: 'OrdenesController'
        }).
        when('/ordenes/ver/todos', {
          templateUrl: '/views/ordenes/mostrar_ordenes',
          controller: 'OrdenesController'
        }).

        //Rutas Documentos
        when('/documentos', {
          templateUrl: '/views/layouts/layout_main_modulos',
          controller: 'DocumentosController'
        }).
        when('/documentos/enviar-documentos', {
          templateUrl: '/views/documentos/enviar_documentos',
          controller: 'DocumentosController'
        }).
        when('/ordenes/recibir/subir-documentos', {
          templateUrl: '/views/documentos/subir_documentos',
          controller: 'DocumentosController'
        }).       
        when('/ordenes/recibir/mostrar/todos', {
          templateUrl: '/views/documentos/mostrar_documentos',
          controller: 'DocumentosController'
        }).

        //Rutas Proveedores
        when('/proveedores', {
          templateUrl: '/views/layouts/layout_main_modulos',
          controller: 'ProveedoresController'
        }).
        when('/proveedores/registrar-proveedores', {
          templateUrl: '/views/proveedor/crear_proveedores',
          controller: 'ProveedorController'
        }).
        when('/proveedores/ver/todos', {
          templateUrl: '/views/proveedor/mostrar_proveedores',
          controller: 'ProveedorController'
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