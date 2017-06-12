/// Controlador para Correos

(function () {
    'use strict';

    angular
        .module('SIMCI')
        .controller('CorreosController', CorreosController);

    CorreosController.$injector = [
        '$filter',
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

    function CorreosController($filter, $scope, $http, $log, $timeout, $route, $routeParams, $location, DTOptionsBuilder, DTColumnBuilder, $compile, ToolsService, $templateCache) {

        $scope.modulo = {};
        $scope.DatosForm = {}; // Objeto para los datos de formulario
        $scope.data_global_user = ToolsService.get_data_user_localstorage();

        $scope.modulo.nombre = "Correos";
        $scope.modulo.icono = {
            tipo: "travel",
            color: "teal"
        };

        $scope.modulo.opciones = [

            {
                nombre: "enviar correos",
                descripcion: "Esta opcion le permitira enviar correos a contactos del sistema",
                url: "#/correos/enviar-correo",
                icono: 'send',
                show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_ALMACENISTA, TIPO_USER_SUPERVISOR, TIPO_USER_PROFESOR]
            },

            {
                nombre: "mostrar correos",
                descripcion: "Esta opcion le permitira mostrar los correos enviados y recibidos",
                url: "#/correos/ver/todos",
                icono: 'unhide',
                show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_ALMACENISTA, TIPO_USER_SUPERVISOR, TIPO_USER_PROFESOR]
            }

        ];


        if ($location.$$url == '/correos/ver/todos') {


            $scope.tabla_correos = {};
            $scope.id_objeto_correos = null;

            $scope.opciones_tabla_correos = DTOptionsBuilder.newOptions()
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

            $scope.columnas_tabla_correos = [
                DTColumnBuilder.newColumn(null).renderWith(
                    function (data, type, full, config) {
                        var fecha = data.fecha_recibido.split(" ");
                        return $filter('formato_fecha')(fecha[0], 'DD/MM/YY');
                    }
                ).withTitle('Fecha').withOption('width', '10%').notSortable(),
                 DTColumnBuilder.newColumn(null).withTitle('Unidad').renderWith(
                    function (data, type, full) {
                        return data.nombre_emisor + ' ' + data.apellido_emisor + ' (' + data.usuario_emisor + ')';
                    }
                )
                    .notSortable()
                    .withOption('width', '15%'),

                DTColumnBuilder.newColumn('asunto').withTitle('Asunto').notSortable().withOption('width', '20%'),
                DTColumnBuilder.newColumn('descripcion').withTitle('Descripcion').notSortable().withOption('width', '40%'),

                DTColumnBuilder.newColumn(null).withTitle('Acciones').renderWith(
                    function (data, type, full) {
                        var clase_btn_descargar = '';

                        if (!!(data.ruta_descargar_archivo) && !!(data.nombre_original_archivo)) {
                            clase_btn_descargar = 'ui icon button orange spopup';
                        }
                        else {
                            clase_btn_descargar = 'ui disabled icon button orange spopup';
                        }

                        return '<div class="ui icon button blue spopup" data-content="Ver Detalles" ng-click="modal_ver_correo(' + data.id + ')"><i class="unhide icon"></i></div>' +
                            '<div class="' + clase_btn_descargar + '"  data-content="Descargar Correo" ng-click="descargar_archivo_adjunto(' + ToolsService.anadir_comillas_params(data.ruta_descargar_archivo, data.nombre_original_archivo) + ')"><i class="download icon"></i></div>';
                    }).withOption('width', '10%')
            ];

            ///Funciones
            $scope.modal_ver_correo = function (id) {
                $scope.data_correo = {};
                ToolsService.mostrar_modal_dinamico($scope, $http, {
                    url: '/api/correos/mostrar?type=correo&id=' + id,
                    scope_data_save_success: 'data_correo',
                    id_modal: 'modal_ver_correo'
                });
            };

            $scope.descargar_archivo_adjunto = function (_url_archivo, _nombre_archivo) {
                var url = _url_archivo;
                var a = document.createElement('a');
                a.href = url;
                a.download = _nombre_archivo;
                a.target = '_blank';
                a.click();
            }

        }//Fin de /mostrar/correos

        if ($location.$$url == '/correos/enviar-correo') {

            ToolsService.reload_template_cache();
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

        }//Fin de enviar-correo

    }
})();