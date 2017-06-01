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
                'ngAudio',
                'LocalStorageModule'
            ], function ($interpolateProvider) {
                $interpolateProvider.startSymbol('<%');
                $interpolateProvider.endSymbol('%>');
            }
        );
})();