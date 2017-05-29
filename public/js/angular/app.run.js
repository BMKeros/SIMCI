(function () {
    'use strict';

    angular
        .module('SIMCI')
        .run(function ($rootScope, DTDefaultOptions, ToolsService, ngProgressFactory, $http, $interval) {

            $rootScope.notificaciones = {

                num_notificaciones: 0,
                data_notificaciones: [],
                bandera_loading: true,
                bandera_mostrar: false,
                intervalo: 600000,
                //Para obtener todas data de las notificaciones
                getAllData: function () {
                    return this.data_notificaciones
                },
                //Para asignar las notificacinoes al objeto
                setData: function (_data) {
                    this.data_notificaciones = _data;
                },
                //Obtiene el numero de notificaciones, Es usada para solo el numero que se muestra
                getCount: function () {
                    return this.num_notificaciones;
                },
                //Asigna el numero de notificaciones
                setCount: function (_total) {
                    this.num_notificaciones = _total;
                },
                //Retorna el estado del loading si se muestra o no
                showLoading: function () {
                    return this.bandera_loading;
                },
                //Retorna el estado para poder mostrar la lista de notificaciones o no
                showNotificaciones: function () {
                    return this.bandera_mostrar;
                },
                //Asignar el estado para poder mostrar el loading
                setStatusLoading: function (_estado) {
                    this.bandera_loading = _estado;
                },
                //Asignar el estado para poder mostrar la lista de notificaciones
                setStatusMostrar: function (_estado) {
                    this.bandera_mostrar = _estado;
                },
                //Obtiene el numero total de notificaciones
                getTotal: function () {
                    return this.data_notificaciones.length;
                },
                //Obtener el intervalo de verificacion de notificaciones
                getIntervaloVerificacion: function () {
                    return this.intervalo;
                }
            };

            //Intervalo de verificacion
            $interval(function () {
                $rootScope.$broadcast('evento_verificar_notificaciones', {estado: true});
            }, $rootScope.notificaciones.getIntervaloVerificacion());

            //Guardamos la informacion del usuario logueado
            $rootScope.data_global_user = ToolsService.get_data_user_localstorage();

            //Configuracion de semantic
            $.fn.search.settings.error = {
                noResults: 'No se encontraron resultados'
            };

            $.fn.dropdown.settings.message = {
                noResults: 'No se encontraron resultados'
            };

            //Config para alertify
            alertify.defaults.transition = "zoom";
            alertify.defaults.theme.ok = "ui positive button";
            alertify.defaults.theme.cancel = "ui gray button";
            alertify.defaults.glossary.ok = 'Aceptar';
            alertify.defaults.glossary.cancel = 'Cancelar';

            //Lenguaje español para datatable
            DTDefaultOptions.setLanguageSource('/spanish.json');

            //Asignar funciones en el scope global
            $rootScope.tools_input = ToolsService.tools_input;

            //Configuracion para el NgProgressBar
            $rootScope.progressbar = ngProgressFactory.createInstance();
            $rootScope.progressbar.setHeight('5px');
            $rootScope.progressbar.setColor('orange');


            $rootScope.cargar_notificaciones = function () {
                if (!angular.element('#item_menu_notificaciones').hasClass('active')) {

                    $http({
                        method: 'GET',
                        url: '/api/notificaciones/mostrar',
                        params: {
                            type: 'todas',
                            id_usuario: $rootScope.data_global_user.id_usuario
                        }
                    }).then(function (data) {
                        $rootScope.notificaciones.setData(data.data.datos);
                        //Para mostrar el loading de notificaciones
                        $rootScope.notificaciones.setStatusLoading(false);
                        //Para mostrar la lista de notificaciones
                        $rootScope.notificaciones.setStatusMostrar(true);

                    }, function (data_error) {
                        ToolsService.generar_alerta_status(data_error);
                    });
                }
            };

            //Funcion global para mostrar el modal de los datasheet
            $rootScope.cargar_datasheet = function (id_objeto) {
                return alertify.DataSheetDialog(id_objeto);
            };

        });
})();