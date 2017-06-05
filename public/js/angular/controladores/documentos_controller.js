/// Controlador para documentos

(function () {
    'use strict';

    angular
        .module('SIMCI')
        .controller('DocumentosController', DocumentosController);

    DocumentosController.$injector = [
        '$scope',
        '$http',
        '$log',
        '$timeout',
        '$route',
        '$routeParams',
        '$location',
        'DTOptionsBuilder',
        'DTColumnBuilder',
        '$compile',
        'ToolsService',
        '$templateCache'
    ];

    function DocumentosController($scope, $http, $log, $timeout, $route, $routeParams, $location, DTOptionsBuilder, DTColumnBuilder, $compile, ToolsService, $templateCache) {

        $scope.modulo = {};
        $scope.DatosForm = {}; // Objeto para los datos de formulario
        $scope.data_global_user = ToolsService.get_data_user_localstorage();

        $scope.modulo.nombre = "Documentos";
        $scope.modulo.icono = {
            tipo: "travel",
            color: "teal"
        };

        $scope.modulo.opciones = [

            {
                nombre: "enviar documentos",
                descripcion: "Esta opcion le permitira enviar email a contactos del sistema",
                url: "#/documentos/enviar-documento",
                icono: 'send',
                show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_ALMACENISTA, TIPO_USER_SUPERVISOR, TIPO_USER_PROFESOR]
            },

            {
                nombre: "mostrar documentos",
                descripcion: "Esta opcion le permitira mostrar los documentos enviados y recibidos",
                url: "#/documentos/ver/todos",
                icono: 'unhide',
                show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_ALMACENISTA, TIPO_USER_SUPERVISOR, TIPO_USER_PROFESOR]
            }

        ];


        if ($location.$$url == '/documentos/ver/todos') {


            $scope.tabla_documentos = {};
            $scope.id_objeto_documentos = null;

            $scope.opciones_tabla_documentos = DTOptionsBuilder.newOptions()
                .withOption('ajax', {
                    url: '/api/correos/mostrar?type=paginacion',
                    type: 'GET'
                })
                .withDataProp('data')
                .withPaginationType('full_numbers')
                .withOption('processing', true)
                .withOption('serverSide', true)
                .withOption('createdRow', function (row, data, dataIndex) {
                    $compile(angular.element(row).contents())($scope);

                    $timeout(function () {
                        $('.ui.spopup').popup();
                    }, false, 0);
                });

            $scope.columnas_tabla_documentos = [
                DTColumnBuilder.newColumn(null).withTitle('Fecha').notSortable().withOption('width', '15%'),
                DTColumnBuilder.newColumn('emisor').withTitle('Emisor').notSortable().withOption('width', '15%'),
                DTColumnBuilder.newColumn('asunto').withTitle('Asunto').notSortable().withOption('width', '20%'),
                DTColumnBuilder.newColumn('descripcion').withTitle('Descripcion').notSortable().withOption('width', '40%'),

                DTColumnBuilder.newColumn(null).withTitle('Acciones').renderWith(
                    function (data, type, full) {
                        return '<div class="ui icon button blue spopup" data-content="Ver Documentos" ng-click="modal_ver_documentos(' + data.id + ')"><i class="unhide icon"></i></div>' +
                            //'<div class="ui icon button green spopup"  data-content="Modificar Documentos" ng-click="modal_modificar_documentos(' + data.id + ')"><i class="edit icon"></i></div>' +
                            '<div class="ui icon button orange spopup"  data-content="Descargar Documentos" ng-click="modal_modificar_documentos(' + data.id + ')"><i class="download icon"></i></div>';
                    }).withOption('width', '10%')
            ];

        }//Fin de /mostrar/documentos


        if ($location.$$url == '/documentos/enviar-documento') {

            ToolsService.reload_template_cache($route, $templateCache);
            $scope.enviar_correo = ToolsService.registrar_dinamico($scope, $http, $timeout, {
                url: '/api/correos/enviar-correo',
                formulario: {
                    id: 'formulario_enviar_correo',
                    reglas: reglas_formulario_enviar_correo
                },
                exito: {
                    titulo: 'Correo enviado con exito',
                    mensajes: ['El correo ha sido enviado a los destinatarios.']
                },
                post_archivo: true
            });

        }//Fin de enviar-documento

    }
})();