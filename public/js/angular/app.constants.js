(function () {
    'use strict';

    // CONSTANTES GLOBALES
    angular.module('SIMCI')
        .constant('CONSTANTES', {
            'ORDEN_ACTIVA': 'C01',
            'ORDEN_PENDIENTE': 'C02',
            'ORDEN_CANCELADA': 'C03',
            'ORDEN_COMPLETADA': 'C04'
        });
})();