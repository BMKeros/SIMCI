/// Controlador para catalogo

simci.controller('LaboratorioController', [
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
        '$templateCache',
        '$filter',
        function ($scope, $http, $log, $timeout, $route, $routeParams, $location, DTOptionsBuilder, DTColumnBuilder, $compile, ToolsService, $templateCache, $filter) {

            $scope.modulo = {};
            $scope.DatosForm = {}; // Objeto para los datos de formulario
            $scope.data_global_user = ToolsService.get_data_user_localstorage();


            $scope.modulo.nombre = "Laboratorio";
            $scope.modulo.icono = {
                tipo: "lab",
                color: "purple"
            };

            $scope.modulo.opciones = [
                {
                    nombre: "registrar laboratorio",
                    descripcion: "Esta opcion le permitira añadir nuevos laboratorios",
                    url: "#/laboratorio/crear-laboratorio",
                    icono: 'write',
                    show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_ALMACENISTA]
                },

                {
                    nombre: "mostrar laboratorios",
                    descripcion: "Esta opcion le permitira ver los nuevos laboratorios",
                    url: "#/laboratorio/ver/todos",
                    icono: 'unhide',
                    show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_ALMACENISTA, TIPO_USER_SUPERVISOR, TIPO_USER_PROFESOR]
                },


                {
                    nombre: "agregar stock",
                    descripcion: "Esta opcion le permitira agregar nuevos stock al laboratorios",
                    url: "#/laboratorio/agregar-stock",
                    icono: 'plus',
                    show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_ALMACENISTA]
                },


                {
                    nombre: "mostrar stock",
                    descripcion: "Esta opcion le permitira ver los nuevos stock y moverlos a nuevos laboratorios",
                    url: "#/laboratorio/ver/stock",
                    icono: 'eye',
                    show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_ALMACENISTA, TIPO_USER_SUPERVISOR, TIPO_USER_PROFESOR]
                },

                {
                    nombre: "mover stock",
                    descripcion: "Esta opcion le permitira mover los stock del laboratorios y moverlos a nuevos laboratorios",
                    url: "#/laboratorio/mover-stock",
                    icono: 'external',
                    show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_ALMACENISTA]
                }

            ];

            $log.info($routeParams);
            $log.info($location);

            if ($location.$$url == '/laboratorio/crear-laboratorio') {
                $scope.mostrar_mensaje = false;
                $scope.DatosForm = {};

                $scope.registrar_laboratorio = ToolsService.registrar_dinamico($scope, $http, $timeout, {
                    url: '/api/laboratorio/registrar-laboratorio',

                    formulario: {
                        id: 'formulario_crear_laboratorio',
                        reglas: reglas_formulario_registrar_laboratorio
                    },
                    exito: {
                        titulo: 'Laboratoiro creado con exito',
                        mensajes: ['Nuevo Laboratorio registrado en la base de datos.']
                    }///inventario/registrar-estante
                });

            }// If == '/laboratorio/crear-laboratorio'

            if ($location.$$url == '/laboratorio/ver/todos') {

                $scope.tabla_laboratorios = {};
                $scope.id_laboratorio_actual = null;

                $scope.opciones_tabla_laboratorios = DTOptionsBuilder.newOptions()
                    .withOption('ajax', {
                        url: '/api/laboratorio/mostrar?type=paginacion',
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

                $scope.columnas_tabla_laboratorios = [
                    DTColumnBuilder.newColumn(null).withTitle('Codigo').renderWith(
                        function (data, type, full) {
                            return ToolsService.printf('<a class="ui tiny blue tag label">{0}</a>', data.codigo);
                        }
                    ).notSortable().withOption('width', '7%'),
                    DTColumnBuilder.newColumn('nombre').withTitle('Nombre').notSortable(),
                    DTColumnBuilder.newColumn('descripcion').withTitle('Descripcion').notSortable(),

                    DTColumnBuilder.newColumn(null).withTitle('Acciones').renderWith(
                        function (data, type, full) {
                            return '<a class="ui icon button blue spopup" data-content="Ver Laboratorio" ng-click="modal_ver_laboratorio(\'' + data.codigo + '\')"><i class="unhide icon"></i></a>' +
                                '<a class="ui icon button green spopup"  data-content="Modificar Laboratorio" ng-click="modal_modificar_laboratorio(\'' + data.codigo + '\')"><i class="edit icon"></i></a>' +
                                '<a class="ui icon button red spopup"  data-content="Eliminar Laboratorio" ng-click="modal_eliminar_laboratorio(\'' + data.codigo + '\')"><i class="remove icon"></i></a>';
                        })
                        .withOption('width', '15%')
                ];

                ///Funciones
                $scope.modal_ver_laboratorio = function (id) {
                    $scope.data_laboratorio = {};

                    ToolsService.mostrar_modal_dinamico($scope, $http, {
                        url: '/api/laboratorio/mostrar?type=laboratorio_full&id=' + id,
                        scope_data_save_success: 'data_laboratorio',
                        id_modal: 'modal_ver_laboratorio'
                    });
                };

                $scope.modal_modificar_laboratorio = function (id) {
                    //capturamos el id del laboratorio actual
                    $scope.id_lab_actual = id;

                    //Desactivamos los mensajes
                    $scope.mostrar_mensaje = false;

                    $http({
                        method: 'GET',
                        url: '/api/laboratorio/mostrar?type=laboratorio_full&id=' + id,
                    }).then(function (data) {

                        $scope.DatosForm = data.data;

                        setTimeout(function () {
                            //Mostramos la modal
                            angular.element('#modal_modificar_laboratorio').modal('show');

                        }, 300);

                    }, function (data_error) {
                        $log.info(data_error);
                    });
                };

                $scope.procesar_modificar = function () {
                    var id_usuario = $scope.id_lab_actual;

                    ToolsService.loading_button('btn-modificar', true);

                    $http({
                        method: 'POST',
                        url: '/api/laboratorio/actualizar-laboratorio?id=' + id_usuario,
                        data: $scope.DatosForm
                    }).then(function (data) {
                        if (data.data.resultado) {

                            $scope.mostrar_mensaje = true;

                            $scope.mensaje_validacion = {
                                titulo: 'Laboratorio modificado con exito',
                                icono: 'checkmark',
                                color: 'green',
                                mensajes: []
                            };

                            //Desactivamos el loading
                            ToolsService.loading_button('btn-modificar', false);

                            setTimeout(function () {
                                ToolsService.reload_tabla($scope, 'tabla_laboratorios', function () {
                                });
                            }, 500);

                        } else {
                            $scope.mostrar_mensaje = true;

                            $scope.mensaje_validacion = {
                                titulo: 'Error al modificar el laboratorio',
                                icono: 'remove',
                                color: 'red',
                                mensajes: data.data.mensajes
                            };

                            //Desactivamos el loading
                            ToolsService.loading_button('btn-modificar', false);
                        }
                    }, function (data_error) {
                        //$log.info(data_error);
                        //Desactivamos el loading
                        ToolsService.loading_button('btn-modificar', false);
                    });

                };


                $scope.modal_eliminar_laboratorio = function (id) {
                    alertify.confirm('Seguro que desea eliminar este laboratorio!',
                        //onok consulta para verificar si tiene relaciones con otras tablas
                        function () {
                            $http({
                                method: 'GET',
                                url: '/api/laboratorio/verificar?type=relacion_laboratorio&cod_laboratorio=' + id
                            }).then(function (data) {
                                    //verificamos si el laboratorio tiene relacion en otras tablas
                                    if (data.data.resultado) {
                                        alertify.alert(data.data.mensajes);
                                    }
                                    else {
                                        //sino tiene relaciones, que confirme para que elimine el laboratorio
                                        alertify.confirm(data.data.mensajes,
                                            //onok para eliminar el usuairo
                                            function () {
                                                $http({
                                                    method: 'POST',
                                                    url: '/api/laboratorio/eliminar?id=' + id,
                                                }).then(function (data) {

                                                    if (data.data.resultado) {

                                                        //Recargamos la tabla
                                                        setTimeout(function () {
                                                            ToolsService.reload_tabla($scope, 'tabla_laboratorios', function (data) {
                                                            });
                                                        }, 500);
                                                    }
                                                    else {
                                                        $log.info(data);
                                                    }
                                                }, function (data_error) {
                                                    //$log.info(data_error);
                                                    ToolsService.generar_alerta_status(data_error);
                                                });
                                            }
                                        ).set('title', '¡Alerta!');
                                    }
                                },
                                function (data_error) {
                                    $log.info(data_error);
                                });
                        }
                    ).set('title', '¡Alerta!');
                };//fin de la funcion eliminar de laboratorios


            }//fin del if de ver-laboratorios


            if ($location.$$url == '/laboratorio/ver/stock') {

                $scope.tabla_stock = {};
                $scope.id_objeto_stock = null;

                $scope.opciones_tabla_stock = DTOptionsBuilder.newOptions()
                    .withOption('ajax', {
                        url: '/api/laboratorio/mostrar?type=paginacion_stock',
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

                $scope.columnas_tabla_stock = [
                    DTColumnBuilder.newColumn('nombre_objeto')
                        .withTitle('Nombre')
                        .withOption('width', '40%')
                        .notSortable(),
                    DTColumnBuilder.newColumn('cantidad')
                        .withTitle('Cantidad')
                        .withOption('width', '10%')
                        .notSortable(),
                    DTColumnBuilder.newColumn('nombre_laboratorio')
                        .withTitle('Laboratorio')
                        .withOption('width', '30%')
                        .notSortable(),

                    DTColumnBuilder.newColumn(null).withTitle('Acciones').renderWith(
                        function (data, type, full) {
                            return '<div class="ui icon button blue spopup" data-content="Ver Stock" ng-click="modal_ver_stock(\'' + data.cod_laboratorio + '\',\'' + data.cod_dimension + '\',\'' + data.cod_subdimension + '\',\'' + data.cod_agrupacion + '\',' + data.cod_objeto + ')"><i class="unhide icon"></i></div>' +
                                '<div class="ui icon button orange spopup" data-content="Retornar Stock" ng-click="retornar_stock(' + data.id + ','+ data.cantidad+')"><i class="sign out icon"></i></div>';
                        }).withOption('width', '11%')
                        .withClass('center aligned')
                ];

                ///Funciones
                $scope.modal_ver_stock = function (cod_laboratorio, cod_dimension, cod_subdimension, cod_agrupacion, cod_objeto) {
                    $scope.data_elemento_stock = {};

                    ToolsService.mostrar_modal_dinamico($scope, $http, {
                        url: '/api/laboratorio/mostrar?type=stock_full&cod_laboratorio=' + cod_laboratorio + '&cod_dimension=' + cod_dimension + '&cod_subdimension=' + cod_subdimension + '&cod_agrupacion=' + cod_agrupacion + '&cod_objeto=' + cod_objeto,
                        scope_data_save_success: 'data_elemento_stock',
                        id_modal: 'modal_ver_elemento_stock'
                    });
                };

                $scope.retornar_stock = function (id, _cantidad_existente) {

                    alertify.prompt('Escriba la cantidad que desea retornar', '',
                        function (evt, cantidad_a_retornar) {
                            if(cantidad_a_retornar > _cantidad_existente){
                                alertify.notify('No puedes retornar una cantidad mayor a la existente', 'error', 5);
                            }
                            else{
                                $http({
                                    method: 'POST',
                                    url: '/api/laboratorio/retornar-stock',
                                    data: {
                                        'id': id,
                                        'cantidad_retornar': cantidad_a_retornar
                                    }
                                }).then(
                                    function (data) {
                                        if (data.data.resultado) {
                                            alertify.notify('Cantidad retornada al inventario con exito', 'success', 5);

                                            ToolsService.reload_tabla($scope,'tabla_stock',function(){});
                                        }
                                        else{
                                            alertify.notify('Ha ocurrido un error al realizar la operacion', 'error', 5);
                                        }
                                    },
                                    function (data_error) {
                                        ToolsService.generar_alerta_status(data_error);
                                    }
                                );
                            }
                        }
                    ).set('title', "Retornar al inventario");

                }

            }// If == '/laboratorio/ver/stock

            if ($location.$$url == '/laboratorio/agregar-stock') {

                $scope.items_tabla_stock = []; //Aqui se guardaran todos los elementos que se agreguen con el btn plus
                $scope.select_laboratorio = ""; //Laboratorio seleccionado
                $scope.select_objeto = ""; //Objeto seleccionado
                $scope.cantidad = 0; //Cantidad del objeto seleccionado

                $scope.codigos_elemento = ''; // Mantiene un json string de los codigos del elemento que debe ser convertido con JSON.parse

                $scope.agregar_stock_tabla = function () {

                    var formulario = $('#formulario_registrar_stock');
                    var is_valid_form = formulario.form(reglas_formulario_agregar_stock).form('is valid');

                    if ($scope.codigos_elemento.length === 0 || $scope.codigos_elemento.trim() === '') {
                        alertify.error("Error, No has seleccionado un elemento del inventario");
                        return false;
                    }
                    if (is_valid_form) {

                        var parametros = {
                            type: 'agregar_stock',
                            cod_laboratorio: $scope.select_laboratorio,
                            cantidad_solicitada: $scope.cantidad
                        };

                        // Agregamos los nuevos attributos
                        //Se convierte los codigos elemento a objeto porque vienen en formato string
                        var temp_codigos = JSON.parse($scope.codigos_elemento);

                        //Agregamos los atributos al nuevo_elemento
                        ToolsService.extender_atributos_objeto(parametros, temp_codigos);

                        $http({
                            method: 'GET',
                            url: '/api/laboratorio/mostrar',
                            params: parametros
                        }).then(
                            function (data) {

                                if (data.data.resultado) {

                                    var data_item = data.data.datos;

                                    //Verificamos que no se repita el elemento en la lista
                                    var existe = $scope.items_tabla_stock.findIndex(function (obj, index, array) {
                                        return (obj.cod_objeto == data_item.cod_objeto) && (obj.cod_laboratorio == $scope.select_laboratorio);
                                    });

                                    //Si no existe el nuevo elemento el la lista lo agregamos
                                    if (existe === -1) {

                                        var nuevo_elemento = {
                                            id_item_stock: ToolsService.generar_id_unico(),
                                            nombre_laboratorio: data_item.nombre_laboratorio,
                                            cod_laboratorio: data_item.cod_laboratorio,
                                            nombre_objeto: data_item.nombre_objeto,
                                            cantidad: $scope.cantidad,
                                            cod_dimension: data_item.cod_dimension,
                                            cod_subdimension: data_item.cod_subdimension,
                                            cod_agrupacion: data_item.cod_agrupacion,
                                            cod_objeto: data_item.cod_objeto,
                                            numero_orden: data_item.numero_orden
                                        };


                                        $scope.items_tabla_stock.push(nuevo_elemento);
                                    }
                                    else {
                                        alertify.error("Ya agregaste un stock igual a este en la lista");
                                    }

                                }
                                else {
                                    alertify.error("No hay disponibilidad de este elemento, Intenta con una cantidad menor");
                                }


                            },
                            function (data_error) {
                                ToolsService.generar_alerta_status(data_error);
                            }
                        );
                    }
                };

                $scope.procesar_agregar_stock = function () {

                    //Seteamos la data en la variable DatosForm para enviarla con el registro dinamico
                    $scope.DatosForm.items_stock = $scope.items_tabla_stock;

                    if ($scope.items_tabla_stock.length != 0) {
                        return ToolsService.registrar_dinamico($scope, $http, $timeout, {
                            url: '/api/laboratorio/agregar-stock',
                            exito: {
                                titulo: 'Stock registrado con exito',
                                mensajes: ['El stock ha sido agregado al laboratorio con exito']
                            },
                            callbackSuccess: function (_scope) {
                                _scope.$apply(function () {
                                    _scope.items_tabla_stock = [];
                                    _scope.select_laboratorio = "";
                                    _scope.select_objeto = "";
                                    _scope.cantidad = 0;
                                    _scope.codigos_elemento = "";

                                    $('.ui.dropdown.selection').removeClass('disabled');
                                });
                            }
                        })();
                    }
                    else {
                        alertify.error("Debes agregar al menos 1 elemento a la lista");
                    }
                };

                $scope.eliminar_stock_tabla = function (id_elemento) {

                    $scope.items_tabla_stock = $scope.items_tabla_stock.filter(function (obj) {
                        return obj.id_item_stock !== id_elemento;
                    });

                };

            }//Fin de agregar-stock

            if ($location.$$url == '/laboratorio/mover-stock') {

                $scope.items_tabla_objetos_laboratorio = [];
                $scope.select_laboratorio_origen = null;
                $scope.select_laboratorio_destino = null;
                $scope.items_tabla_seleccionados = [];

                $scope.cargar_objetos_laboratorio = function () {

                    $http({
                        method: 'GET',
                        url: '/api/laboratorio/mostrar?type=stock_laboratorio&cod_laboratorio=' + $scope.select_laboratorio_origen
                    }).then(
                        function (data) {
                            //asi es como se va a mostrar
                            $scope.items_tabla_objetos_laboratorio = data.data;
                            $scope.items_tabla_objetos_laboratorio.forEach(function (element, index) {
                                element.id_unico_item = ToolsService.generar_id_unico();
                                element.cantidad_mover = 0;
                            });
                        },
                        function (data_error) {
                            ToolsService.generar_alerta_status(data_error);
                        }
                    );
                };


                $scope.procesar_mover_stock = function () {

                    var formulario = $('#formulario_mover_stock');
                    var is_valid_form = formulario.form(reglas_formulario_mover_stock).form('is valid');

                    if (is_valid_form) {

                        if ($scope.items_tabla_seleccionados.length == 0) {
                            alertify.error("Aun no has seleccionado ningun objeto");
                        }
                        else {

                            $http({
                                method: 'POST',
                                url: '/api/laboratorio/mover-stock',
                                data: {
                                    'data': $scope.items_tabla_seleccionados,
                                    'laboratorio_origen': $scope.select_laboratorio_origen,
                                    'laboratorio_destino': $scope.select_laboratorio_destino
                                }
                            }).then(
                                function (data) {
                                    if (data.data.resultado) {
                                        $scope.items_tabla_objetos_laboratorio = [];
                                        $scope.items_tabla_seleccionados = [];

                                        $('#laboratorio_origen').dropdown('restore defaults');
                                        $('#laboratorio_destino').dropdown('restore defaults');

                                        alertify.notify('Objetos movido con exito!', 'success', 5, function () {
                                            console.log('dismissed');
                                        });

                                    }
                                },
                                function (data_error) {
                                    ToolsService.generar_alerta_status(data_error);
                                }
                            );
                        }
                    }

                };

                $scope.validar_seleccion = function () {
                    if ($scope.select_laboratorio_origen === $scope.select_laboratorio_destino) {
                        $('#laboratorio_destino').dropdown('restore defaults');
                        $scope.select_laboratorio_destino = null;

                        alertify.error("No puedes mover el stock al mismo laboratorio");

                        return false;
                    }
                };

                $scope.seleccionar_item_tabla = function (id_item_fila) {

                    //Angular element short
                    var _AE = angular.element;

                    //representa la poscion de la columna estado ubicada en la tabla
                    var columna_estado = 1;

                    //Fila del item
                    fila_item = _AE('#' + id_item_fila);

                    //Boton seleccionar
                    btn_seleccionar = _AE(fila_item.find('button[name="btn_action_seleccionar"]').get(0));

                    icon_btn_seleccionar = _AE(btn_seleccionar.children().get());

                    //Boton confirmar
                    btn_confirmar = _AE(fila_item.find('button[name="btn_action_confirmar"]').get(0));

                    //input cantidad mover
                    input_cantidad_mover = _AE(fila_item.find('input[name="input_cantidad_mover"]').get(0));

                    //Icono del estado del item
                    icon_estado_item = _AE(_AE(fila_item.find('td').get(columna_estado))).children();

                    //Seteamos 0 cada vez que se active
                    input_cantidad_mover.val(0).trigger('change');


                    if (btn_seleccionar.hasClass('blue')) {

                        input_cantidad_mover.removeAttr('disabled');
                        btn_confirmar.removeAttr('disabled');

                        btn_seleccionar.removeClass('blue').addClass('red');
                        icon_btn_seleccionar.removeClass('plus').addClass('remove');
                        fila_item.addClass('negative').removeClass('positive');

                        //Removemos todas las clases de la columna estado y agregamos las de seleccionado                        
                        icon_estado_item.removeClass();
                        icon_estado_item.addClass('large green checkmark icon');
                    }
                    else {
                        input_cantidad_mover.attr('disabled', '');
                        btn_confirmar.attr('disabled', '');

                        btn_seleccionar.removeClass('red').addClass('blue');
                        icon_btn_seleccionar.removeClass('remove').addClass('plus');
                        fila_item.removeClass('negative');

                        //Removemos todas las clases de la columna estado y agregamos las de deseleccionado                        
                        icon_estado_item.removeClass();
                        icon_estado_item.addClass('large green minus icon');
                    }
                };

                $scope.confirmar_seleccion = function (id_item_fila) {

                    alertify.confirm('Esta seguro que \
                        desea seleccionar este elemento para ser movido? \n\
                        le recordamos que luego que seleccione NO podra deseleccionar nuevamente', function () {

                        var fila = angular.element('#' + id_item_fila);

                        var input_hidden = fila.find('input[type="hidden"][name="data_hidden"]').get(0);

                        var data_item = angular.element(input_hidden).val();

                        //convertimos la data con angular.fromJson para luego agregarla al arreglo
                        elemento_seleccionado = angular.fromJson(data_item);

                        if (elemento_seleccionado.cantidad_mover <= 0) {
                            alertify.warning('Debes especificar la cantidad que va a mover');
                        }
                        else {
                            //Agregamos el item seleccionado al arreglo
                            $scope.items_tabla_seleccionados.push(elemento_seleccionado);

                            //Desactivamos toda la fila para que no pueda ser modificada
                            fila.addClass('active').find('button').addClass('disabled');
                            fila.find('input').attr('disabled', '');
                        }

                    }, function () {
                        alertify.warning('Accion cancelada');
                    })
                        .set('title', 'Mensaje de confirmacion');
                };

            }//Fin de mover-stock

        }]
);
