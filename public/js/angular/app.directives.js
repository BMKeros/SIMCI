(function () {
    'use strict';

    angular
        .module('SIMCI')

        .directive("ngModelFile", ['$parse', function ($parse) {
            return {
                restrict: 'A',
                link: function(scope, element, attrs) {
                    var model = $parse(attrs.ngModelFile);
                    var modelSetter = model.assign;

                    element.bind('change', function(_changeEvent){
                        scope.$apply(function(){
                            modelSetter(scope, _changeEvent.target.files[0]);
                        });
                    });
                }
            };

            /*return {
                scope: {
                    ngModelFile: "="
                },
                link: function (scope, element, attributes) {
                    element.bind("change", function (changeEvent) {
                        var reader = new FileReader();
                        reader.onload = function (loadEvent) {
                            scope.$apply(function () {
                                //scope.ngModelFile = loadEvent.target.result;
                                scope.ngModelFile = {
                                    lastModified: changeEvent.target.files[0].lastModified,
                                    lastModifiedDate: changeEvent.target.files[0].lastModifiedDate,
                                    name: changeEvent.target.files[0].name,
                                    size: changeEvent.target.files[0].size,
                                    type: changeEvent.target.files[0].type,
                                    data: loadEvent.target.result
                                };
                            });
                        };
                        reader.readAsDataURL(changeEvent.target.files[0]);
                        //reader.readAsArrayBuffer(changeEvent.target.files[0]);
                    });
                }
            }*/
        }])

        .directive('ngUpdateHidden', [function () {
            return {
                restrict: 'AE', //attribute or element
                scope: {},
                replace: true,
                require: 'ngModel',
                link: function ($scope, elemento, attr, ngModel) {
                    $scope.$watch(ngModel, function (nuevo_val) {
                        elemento.val(nuevo_val);
                    });
                    elemento.change(function () { //bind the change event to hidden input
                        $scope.$apply(function () {
                            ngModel.$setViewValue(elemento.val());
                        });
                    });
                }
            };
        }])

        .directive('inputCheckCantidad', ['$timeout', function ($timeout) {
            return {
                restrict: 'E', //attribute or element
                require: 'ngModel',
                replace: true,
                link: function (scope, elemento, attrs, ngModel) {
                    scope.$watch(attrs.ngModel, function (nuevo_val, viejo_val) {

                        if (!isNaN(nuevo_val)) {

                            var _max = Number(attrs.maxValue);

                            if (nuevo_val > _max) {
                                ngModel.$setViewValue(0);

                                if (angular.isDefined(attrs.messageErrorMaxValue)) {

                                    $timeout(function () {
                                        alert(attrs.messageErrorMaxValue);
                                    });
                                }
                            }
                            else {
                                ngModel.$setViewValue(Number(nuevo_val));
                            }
                            ngModel.$render();
                        }
                    });
                },
                template: '<input type="text" />'
            };
        }])

        .directive('ngOnlyNumber', function () {
            return {
                restrict: 'EA',
                require: 'ngModel',
                link: function (scope, element, attrs, ngModel) {
                    scope.$watch(attrs.ngModel, function (newValue, oldValue) {
                        var spiltArray = String(newValue).split("");

                        if (attrs.allowNegative == "false") {
                            if (spiltArray[0] == '-') {
                                newValue = newValue.replace("-", "");
                                ngModel.$setViewValue(newValue);
                                ngModel.$render();
                            }
                        }

                        if (attrs.allowDecimal == "false" && spiltArray.length > 1) {
                            newValue = newValue.replace(".", "");
                            ngModel.$setViewValue(newValue);
                            ngModel.$render();
                        }

                        if (spiltArray.length === 0) return;
                        if (spiltArray.length === 1 && (spiltArray[0] == '-' || spiltArray[0] === '.' )) return;
                        if (spiltArray.length === 2 && newValue === '-.') return;

                        if (isNaN(newValue)) {
                            ngModel.$setViewValue(oldValue);
                            ngModel.$render();
                        }
                    });
                }
            };
        })

        .directive('ngShowProgressLoading', ['$rootScope', function ($rootScope) {
            return {
                restrict: 'AE',
                link: function ($scope, $element) {

                    function ocultarProgress() {
                        $rootScope.progressbar.complete();
                    }

                    $scope.$on('$routeChangeStart', function () {
                        $rootScope.progressbar.start();
                    });
                    $scope.$on('$routeChangeSuccess', ocultarProgress);
                    $scope.$on('$routeChangeError', ocultarProgress);
                    // Initially element is hidden
                    ocultarProgress();
                }
            }
        }])

        .directive('ngListenNotificaciones', ['$rootScope', 'ngAudio', '$http', function ($rootScope, ngAudio, $http) {
            return {
                restrict: 'AE',
                link: function ($scope, $element) {

                    $rootScope.$on('evento_verificar_notificaciones', function (event, data) {

                        if (data.estado) {

                            var data_user = $rootScope.data_global_user;
                            var sound = ngAudio.load('/sonidos/sound-noti1.wav');

                            $http({
                                method: 'GET',
                                url: '/api/notificaciones/mostrar',
                                params: {
                                    id_usuario: data_user.id_usuario,
                                    contar: true
                                }
                            }).then(
                                function (data_ajax) {
                                    var response = data_ajax.data_user;

                                    if (response.datos != 0) {

                                        //cambiamos el estilo del icono
                                        $('#icono_barra_notificaciones')
                                            .removeClass('empty')
                                            .addClass('inverted');

                                        //cambiamos el color de las notificaciones
                                        $("#label_numero_notificaciones")
                                            .removeClass('empty')
                                            .removeClass('blue')
                                            .addClass('red');

                                        //Ejecutamos el sonido
                                        sound.play();
                                    } else {
                                        $('#icono_barra_notificaciones').removeClass('inverted').addClass('empty');
                                        $("#label_numero_notificaciones")
                                            .removeClass('red')
                                            .addClass('empty')
                                            .addClass('blue')
                                    }
                                    //Seteamos el numero de notificaciones que viene del backend
                                    $rootScope.notificaciones.setCount(response.datos);
                                }
                            );
                        }

                    });
                }
            }
        }])

})();
