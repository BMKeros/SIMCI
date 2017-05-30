/// Controlador para catalogo

(function () {
    'use strict';

    angular
        .module('SIMCI')
        .controller('ConsultaController', ConsultaController);

    ConsultaController.$injector = [
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

    function ConsultaController($scope, $http, $log, $timeout, $route, $routeParams, $location, DTOptionsBuilder, DTColumnBuilder, $compile, ToolsService, $templateCache) {

        $scope.modulo = {};
        $scope.DatosForm = {}; // Objeto para los datos de formulario
        $scope.data_global_user = ToolsService.get_data_user_localstorage();


        $scope.modulo.nombre = "Consulta";
        $scope.modulo.icono = {
            tipo: "search",
            color: "olive"
        };

        $scope.modulo.opciones = [
            {
                nombre: "consulta",
                descripcion: "Esta opcion le permitira observar la disponibilidad del inventario y realizar busquedas",
                url: "#/consulta/ver/todos",
                icono: 'unhide',
                show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_PROFESOR, TIPO_USER_SUPERVISOR, TIPO_USER_ESTUDIANTE, TIPO_USER_ALMACENISTA]
            }

        ];

        $log.info($routeParams);
        $log.info($location);


        if ($location.$$url == '/consulta/ver/todos') {

            $scope.tabla_laboratorios = {};
            $scope.id_laboratorio_actual = null;

            $scope.opciones_tabla_consultas = DTOptionsBuilder.newOptions()
                .withOption('ajax', {
                    url: '/api/consultas/mostrar?type=paginacion',
                    type: 'GET'
                })
                .withDataProp('data')
                .withPaginationType('full_numbers')
                .withOption('processing', true)
                .withOption('serverSide', true)
                .withOption('createdRow', function (row, data, dataIndex) {
                    $compile(angular.element(row).contents())($scope);
                });

            $scope.columnas_tabla_consultas = [
                DTColumnBuilder.newColumn(null).withTitle('Codigo').renderWith(
                    function (data, type, full) {
                        return ToolsService.printf('<a class="ui tiny blue tag label">{0}</a>', data.codigo);
                    }
                ).notSortable().withOption('width', '7%'),
                DTColumnBuilder.newColumn('nombre').withTitle('Nombre').notSortable(),
                DTColumnBuilder.newColumn('disponibilidad').withTitle('Disponibilidad').notSortable(),
                DTColumnBuilder.newColumn('descripcion').withTitle('Descripcion').notSortable()
            ];


        }//fin del if de ver-laboratorios

    }
})();