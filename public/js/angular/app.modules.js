(function () {

    'use strict';

    angular
        .module('SIMCI', [
                'ngRoute',
                'datatables',
                'ngProgress',
                'ngAnimate',
                'chart.js',
                'angularUtils.directives.dirPagination',
                'qrScanner',
                'ngAudio'
            ], function ($interpolateProvider) {
                $interpolateProvider.startSymbol('<%');
                $interpolateProvider.endSymbol('%>');
            }
        );
})();