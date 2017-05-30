/// Controlador para dashboard

(function () {
    'use strict';

    angular
        .module('SIMCI')
        .controller('DashboardController', DashboardController);

    DashboardController.$injector = [
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

    function DashboardController($scope, $http, $log, $timeout, $route, $routeParams, $location, DTOptionsBuilder, DTColumnBuilder, $compile, ToolsService, $templateCache) {

        $scope.DatosForm = {}; // Objeto para los datos de formulario
        //Esta variable debe estar en todos los controladores
        //Contiene la data del usuario que esta logueado
        $scope.data_global_user = ToolsService.get_data_user_localstorage();


        $scope.indicadores = [
            {
                color: "orange",
                label_primario: "Usuarios registrados",
                label_secundario: "",
                icono: "users icon",
                value: 0
            },
            {
                color: "blue",
                label_primario: "objetos en catalogo",
                label_secundario: "",
                icono: "book icon",
                value: 0
            },
            {
                color: "grey",
                label_primario: "objetos en inventario",
                label_secundario: "",
                icono: "bullseye icon",
                value: 0
            },
            {
                color: "green",
                label_primario: "ordenes activas",
                label_secundario: "",
                icono: "check icon",
                value: 0
            },
            {
                color: "yellow",
                label_primario: "ordenes en espera",
                label_secundario: "",
                icono: "wait icon",
                value: 0
            }
        ];

        //Consultamos al servidor las estadisticas
        $http({
            method: 'GET',
            url: '/estadisticas'
        }).then(function (response) {
            $timeout(function () {
                $scope.indicadores[0].value = response.data.indicadores.total_usuarios;
                $scope.indicadores[1].value = response.data.indicadores.total_objetos;
                $scope.indicadores[2].value = response.data.indicadores.total_elementos;
                $scope.indicadores[3].value = response.data.indicadores.total_ordenes_activas;
                $scope.indicadores[4].value = response.data.indicadores.total_ordenes_pendientes;
            });
        }, function (data_error) {
            ToolsService.generar_alerta_status(data_error);
        });


        $scope.labels_grafica_1 = ["January", "February", "March", "April", "May", "June", "July"];
        $scope.series_grafica_1 = ['Series A', 'Series B'];
        $scope.data_grafica_1 = [
            [65, 59, 80, 81, 56, 55, 40],
            [28, 48, 40, 19, 86, 27, 90]
        ];

        $scope.labels_grafica_2 = ['2006', '2007', '2008', '2009', '2010', '2011', '2012'];
        $scope.series_grafica_2 = ['Series A', 'Series B'];

        $scope.data_grafica_2 = [
            [65, 59, 80, 81, 56, 55, 40],
            [28, 48, 40, 19, 86, 27, 90]
        ];


        $scope.labels_grafica_3 = ["Download Sales", "In-Store Sales", "Mail-Order Sales"];
        $scope.data_grafica_3 = [300, 500, 100];


        $scope.labels_grafica_5 = ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"];

    }
})();