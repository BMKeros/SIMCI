(function () {
    'use strict';

    angular
        .module('SIMCI')
        .config(Routes);

    Routes.$injector = ['$routeProvider'];

    function Routes($routeProvider) {

        $routeProvider

            //Rutas para el dashboard
            .when('/', {
                templateUrl: '/views/dashboard/main_dashboard',
                controller: 'DashboardController'
            })
            //Rutas para usuarios
            .when('/usuarios', {
                templateUrl: '/views/layouts/layout_main_modulos',
                controller: 'UsuariosController'
            })
            .when('/usuarios/crear', {
                templateUrl: '/views/usuarios/crear_usuario',
                controller: 'UsuariosController'
            })
            .when('/usuarios/ver/todos', {
                templateUrl: '/views/usuarios/mostrar_usuarios',
                controller: 'UsuariosController'
            })
            .when('/usuarios/eliminar/:idUsuario', {
                templateUrl: '/views/usuarios/principal_usuarios',
                controller: 'UsuariosController'
            })
            .when('/usuarios/modificar/:idUsuario', {
                templateUrl: '/views/usuarios/principal_usuarios',
                controller: 'UsuariosController'
            })
            .when('/usuarios/crear/tipo-usuario', {
                templateUrl: '/views/usuarios/crear_tipo_usuario',
                controller: 'UsuariosController'
            })

            //Rutas para inventario
            .when('/inventario', {
                templateUrl: '/views/layouts/layout_main_modulos',
                controller: 'InventarioController'
            })
            .when('/inventario/registrar-elemento', {
                templateUrl: '/views/inventario/crear_elemento',
                controller: 'InventarioController'
            })
            .when('/inventario/ver/elementos', {
                templateUrl: '/views/inventario/mostrar_elementos',
                controller: 'InventarioController'
            })
            .when('/inventario/ver/almacenes', {
                templateUrl: '/views/inventario/mostrar_almacenes',
                controller: 'InventarioController'
            })
            .when('/inventario/registrar-almacen', {
                templateUrl: '/views/inventario/crear_almacen',
                controller: 'InventarioController'
            })
            .when('/inventario/registrar-sub-dimension', {
                templateUrl: '/views/inventario/crear_sub_dimension',
                controller: 'InventarioController'
            })
            .when('/inventario/registrar-agrupacion', {
                templateUrl: '/views/inventario/crear_agrupacion',
                controller: 'InventarioController'
            })
            .when('/inventario/registrar-sub-agrupacion', {
                templateUrl: '/views/inventario/crear_sub_agrupacion',
                controller: 'InventarioController'
            })
            .when('/inventario/entrada-salida', {
                templateUrl: '/views/inventario/entrada_salida',
                controller: 'InventarioController'
            })

            //Rutas para catalogo
            .when('/catalogo', {
                templateUrl: '/views/layouts/layout_main_modulos',
                controller: 'CatalogoController'
            })
            .when('/catalogo/registrar-objeto', {
                templateUrl: '/views/catalogo/crear_objeto',
                controller: 'CatalogoController'
            })
            .when('/catalogo/ver/todos', {
                templateUrl: '/views/catalogo/mostrar_catalogo',
                controller: 'CatalogoController'
            })
            .when('/catalogo/registrar-unidad', {
                templateUrl: '/views/catalogo/registrar_unidad',
                controller: 'CatalogoController'
            })
            .when('/catalogo/registrar-clase', {
                templateUrl: '/views/catalogo/registrar_clase_objeto',
                controller: 'CatalogoController'
            })

            //Rutas laboratorio
            .when('/laboratorio', {
                templateUrl: '/views/layouts/layout_main_modulos',
                controller: 'LaboratorioController'
            })
            .when('/laboratorio/crear-laboratorio', {
                templateUrl: '/views/laboratorio/crear_laboratorio',
                controller: 'LaboratorioController'
            })
            .when('/laboratorio/ver/todos', {
                templateUrl: '/views/laboratorio/mostrar_laboratorios',
                controller: 'LaboratorioController'
            })
            .when('/laboratorio/agregar-stock', {
                templateUrl: '/views/laboratorio/registrar_stock',
                controller: 'LaboratorioController'
            })
            .when('/laboratorio/ver/stock', {
                templateUrl: '/views/laboratorio/mostrar_stock',
                controller: 'LaboratorioController'
            })
            .when('/laboratorio/mover-stock', {
                templateUrl: '/views/laboratorio/mover_stock',
                controller: 'LaboratorioController'
            })
            .//Rutas Reportes
            when('/reportes', {
                templateUrl: '/views/layouts/layout_main_modulos',
                controller: 'ReportesController'
            })
            .when('/reportes/generar-reporte', {
                templateUrl: '/views/reportes/crear_reportes',
                controller: 'ReportesController'
            })
            .when('/reportes/ver/todos', {
                templateUrl: '/views/reportes/mostrar_reportes',
                controller: 'ReportesController'
            })

            //Rutas Consulta
            .when('/consulta', {
                templateUrl: '/views/layouts/layout_main_modulos',
                controller: 'ConsultaController'
            })
            .when('/consulta/ver/todos', {
                templateUrl: '/views/consultas/ver_consultas',
                controller: 'ConsultaController'
            })

            //Rutas Ordenes
            .when('/ordenes', {
                templateUrl: '/views/layouts/layout_main_modulos',
                controller: 'OrdenesController'
            })
            .when('/ordenes/generar-orden', {
                templateUrl: '/views/ordenes/generar_ordenes',
                controller: 'OrdenesController'
            })
            .when('/ordenes/ver/todos', {
                templateUrl: '/views/ordenes/mostrar_ordenes',
                controller: 'OrdenesController'
            })
            .when('/ordenes/buscar-orden', {
                templateUrl: '/views/ordenes/buscar_orden',
                controller: 'OrdenesController'
            })

            //Rutas Correos
            .when('/correos', {
                templateUrl: '/views/layouts/layout_main_modulos',
                controller: 'CorreosController'
            })
            .when('/correos/ver/todos', {
                templateUrl: '/views/correos/mostrar_correos',
                controller: 'CorreosController'
            })
            .when('/correos/enviar-correo', {
                templateUrl: '/views/correos/enviar_correo',
                controller: 'CorreosController'
            })

            //Rutas Proveedores
            .when('/proveedores', {
                templateUrl: '/views/layouts/layout_main_modulos',
                controller: 'ProveedorController'
            })
            .when('/proveedores/registrar-proveedor', {
                templateUrl: '/views/proveedor/crear_proveedor',
                controller: 'ProveedorController'
            })
            .when('/proveedores/ver/todos', {
                templateUrl: '/views/proveedor/mostrar_proveedores',
                controller: 'ProveedorController'
            })

            //Rutas Instituciones
            .when('/instituciones', {
                templateUrl: '/views/layouts/layout_main_modulos',
                controller: 'InstitucionesController'
            })
            .when('/instituciones/ver/todos', {
                templateUrl: '/views/instituciones/instituciones',
                controller: 'InstitucionesController'
            })

            .otherwise({
                redirectTo: function () {
                    return '/';
                }
            });
    }
})();