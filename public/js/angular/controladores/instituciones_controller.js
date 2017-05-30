(function () {
    'use strict';

    angular
        .module('SIMCI')
        .controller('InstitucionesController', InstitucionesController);

    InstitucionesController.$injector = [
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

    function InstitucionesController($scope, $http, $log, $timeout, $route, $routeParams, $location, DTOptionsBuilder, DTColumnBuilder, $compile, ToolsService, $templateCache) {

        $scope.modulo = {};
        $scope.DatosForm = {}; // Objeto para los datos de formulario
        $scope.data_global_user = ToolsService.get_data_user_localstorage();


        $scope.modulo.nombre = "Instituciones";
        $scope.modulo.icono = {
            tipo: "building",
            color: "red"
        };

        $scope.modulo.opciones = [
            {
                nombre: "ministerio de defensa",
                descripcion: "El Ministerio del Poder Popular para la Defensa es el máximo órgano administrativo en materia de Defensa integral de la Nación, encargado de la formulación, adopción,   seguimiento y evaluación de las políticas, estrategias, planes, programas y proyectos del Sector Defensa.",
                url: "http://www.mindefensa.gob.ve/",
                icono: 'legal',
                show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_PROFESOR, TIPO_USER_SUPERVISOR, TIPO_USER_ESTUDIANTE, TIPO_USER_ALMACENISTA]
            },
            {
                nombre: "UPTAG",
                descripcion: "Institución Universitaria líder, con un perfil continuado de excelencia, egresados de preferencia en el mercado laboral; impulsadores de una sociedad productiva basada en principios de calidad, equidad, solidaridad y compromiso.",
                url: "http://iutag.org/",
                icono: 'university',
                show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_PROFESOR, TIPO_USER_SUPERVISOR, TIPO_USER_ESTUDIANTE, TIPO_USER_ALMACENISTA]
            },
            {
                nombre: "bomberos nacionales",
                descripcion: "Esta opcion le redireccionara al portal principal de los bomberos nacionales",
                url: "http://",
                icono: 'fire',
                show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_PROFESOR, TIPO_USER_SUPERVISOR, TIPO_USER_ESTUDIANTE, TIPO_USER_ALMACENISTA]
            },
            {
                nombre: "daex",
                descripcion: "Organizacion con el fin de recepcionar, almacenar, distribuir y asignar armas, municiones, explosivos, sustancias químicas, radioactivas; y afines, así como controlar la fabricación, el uso, manejo, transporte y comercialización de los mismos.",
                url: "http://www.daex.mil.ve/",
                icono: 'fire',
                show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_PROFESOR, TIPO_USER_SUPERVISOR, TIPO_USER_ESTUDIANTE, TIPO_USER_ALMACENISTA]
            },
            {
                nombre: "numero de emergencias nacionales",
                descripcion: "Esta opcion le redireccionara al portal principal de los bomberos nacionales",
                url: "http://www.ultimasnoticias.com.ve/noticias/ciudad/servicios-publicos/numeros-de-emergencia-en-todo-el-pais.aspx",
                icono: 'fire',
                show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_PROFESOR, TIPO_USER_SUPERVISOR, TIPO_USER_ESTUDIANTE, TIPO_USER_ALMACENISTA]
            }, {
                nombre: "cicpc",
                descripcion: "Cuerpo de Investigaciones Científicas, Penales y Criminalísticas. Institución que garantiza la eficiencia en la Investigación del delito, mediante su determinación científica, asegurando el ejercicio de la acción penal que conduzca a una sana administración de justicia.",
                url: "https://www.cicpc.gob.ve/",
                icono: 'fire',
                show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_PROFESOR, TIPO_USER_SUPERVISOR, TIPO_USER_ESTUDIANTE, TIPO_USER_ALMACENISTA]
            }
        ];
    }
})();
