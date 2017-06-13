(function () {
    'use strict';

    angular
        .module('SIMCI')

        .filter('capitalize', function () {
            return function (input, all) {
                var reg = (all) ? /([^\W_]+[^\s-]*) */g : /([^\W_]+[^\s-]*)/;
                return (!!input) ? input.replace(reg, function (txt) {
                        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
                    }) : '';
            }
        })

        .filter('inArray', function () {
            return function (array, value) {
                return angular.isArray(array) && array.indexOf(value) !== -1;
            };
        })

        .filter('bool_humano', function () {
            return function (booleano) {
                return (!!booleano) ? (
                        (Boolean(booleano)) ? ('Si') : ('No')
                    ) : (
                        'Undefined'
                    );
            };
        })

        .filter('formato_fecha', function () {
            return function (input, formato) {
                if (input) {
                    switch (formato) {
                        case "DD/MM/YY":
                            return input.split('-').reverse().join('/');
                            break;

                        default:
                            return input;
                            break;
                    }
                }
                else {
                    return '';
                }
            };
        })

        .filter('formato_timestamps', function () {
            return function (value) {
                if (!!(value)) {
                    var tmp_timestamps = value.split('.')[0].split(" ");
                    var fecha_tmp = tmp_timestamps[0].split('-').reverse().join('/');
                    var hora_tmp = tmp_timestamps[1];

                    return fecha_tmp + ' - ' + hora_tmp;
                } else {
                    return ''
                }
            }
        })

        .filter('quitar_ceros_decimales', function (ToolsService, $timeout) {
            return function (input) {
                return (!isNaN(Number(input))) ? (Number(input)) : (null);
            };
        })

        .filter('default_value', function () {
            return function (input, mensaje) {
                return ((!!input) || input === 'null') ? (input) : ((!!mensaje) ? ( mensaje ) : ('No especificado'));
            }
        })

        .filter('cut_string', function (ToolsService) {
            return function (input, num_char) {
                return ToolsService.cut_string(input, num_char);
            }
        })

})();