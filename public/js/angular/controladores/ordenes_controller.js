/// Controlador para Ordenes

simci.controller('OrdenesController', [
        '$scope',
        '$http',
        '$filter',
        '$timeout',
        '$route',
        '$routeParams',
        '$location',
        'DTOptionsBuilder',
        'DTColumnBuilder',
        '$compile',
        'ToolsService',
        '$templateCache',
        '$window',
        'ngAudio',
        'CONSTANTES',
        function ($scope, $http, $filter, $timeout, $route, $routeParams, $location, DTOptionsBuilder, DTColumnBuilder, $compile, ToolsService, $templateCache, $window, ngAudio, CONSTANTES) {

            $scope.modulo = {};
            $scope.DatosForm = {}; // Objeto para los datos de formulario
            $scope.data_global_user = ToolsService.get_data_user_localstorage();


            $scope.modulo.nombre = "Ordenes";
            $scope.modulo.icono = {
                tipo: "edit",
                color: "yellow"
            };

            $scope.modulo.opciones = [
                {
                    nombre: "generar orden",
                    descripcion: "Esta opcion le permitira crear ordenes",
                    url: "#/ordenes/generar-orden",
                    icono: 'write',
                    show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_PROFESOR]
                },

                {
                    nombre: "mostrar ordenes",
                    descripcion: "Esta opcion le permitira ver las ordenes existentes",
                    url: "#/ordenes/ver/todos",
                    icono: 'unhide',
                    show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_ALMACENISTA]
                },
                {
                    nombre: "buscar orden",
                    descripcion: "Esta opcion le permitira buscar una orden por el codigo",
                    url: "#/ordenes/buscar-orden",
                    icono: 'search',
                    show_in: [TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_ALMACENISTA]
                }

            ];

            if ($location.$$url == '/ordenes/ver/todos') {

                $scope.tabla_ordenes = {};
                $scope.id_objeto_ordenes = null;

                $scope.opciones_tabla_ordenes = DTOptionsBuilder.newOptions()
                    .withOption('ajax', {
                        url: '/api/ordenes/mostrar?type=paginacion',
                        type: 'GET'
                    })
                    .withDataProp('data')
                    .withPaginationType('full_numbers')
                    .withOption('processing', true)
                    .withOption('serverSide', true)
                    .withOption('createdRow', function (row, data) {

                        //Buscamos la clase correspondiente al codigo de la orden
                        clase_celda = ToolsService.get_class_status_orden(data.status);
                        //Asignamos la clase
                        row.cells[5].className = clase_celda;

                        $compile(angular.element(row).contents())($scope);

                        $timeout(function () {
                            $('.ui.spopup').popup();
                            $('.dropdown').dropdown();
                        }, false, 0);
                    });

                $scope.columnas_tabla_ordenes = [

                    DTColumnBuilder.newColumn(null).renderWith(
                        function (data, type, full) {
                            return ToolsService.printf('<a class="ui tiny blue tag label">{0}</a>', data.id);
                        }
                    ).withTitle('#').withOption('width', '2%').notSortable(),

                    DTColumnBuilder.newColumn('codigo').withTitle('Codigo').withOption('width', '11%').notSortable(),

                    DTColumnBuilder.newColumn('nombre_completo_responsable').withTitle('Responsable').notSortable(),

                    DTColumnBuilder.newColumn('nombre_completo_solicitante').withTitle('Solicitante').notSortable(),

                    DTColumnBuilder.newColumn(null).renderWith(
                        function (data, type, full, config) {

                            return $filter('formato_fecha')(data.fecha_actividad, 'DD/MM/YY');
                        }
                    ).withTitle('Fecha Actividad').withOption('width', '10%').notSortable(),

                    DTColumnBuilder.newColumn('nombre_status').withTitle('Estado').withOption('width', '10%').notSortable(),

                    DTColumnBuilder.newColumn(null).withTitle('Acciones').renderWith(
                        function (data, type, full) {

                            html = '<div class="ui blue buttons">';
                            html += '<div class="ui button" ng-click="mostrar_orden(\'' + data.codigo + '\')"><i class="eye icon"></i>Ver</div>';
                            html += '<div class="ui floating dropdown icon button">';
                            html += '<i class="dropdown icon"></i>';
                            html += '<div class="menu">';

                            switch (data.status) {
                                case CONSTANTES.ORDEN_ACTIVA:
                                    html += '<div class="item" ng-click="pre_completar_orden(\'' + data.codigo + '\')"><i class="edit icon"></i>Completar orden</div>';
                                    break;
                                case CONSTANTES.ORDEN_PENDIENTE:
                                    html += '<div class="item" ng-click="pre_aceptar_orden(\'' + data.codigo + '\')"><i class="check icon"></i>Aceptar orden</div>';
                                    html += '<div class="item" ng-click="cancelar_orden(\'' + data.codigo + '\')"><i class="remove icon"></i>Cancelar orden</div>';
                                    break;
                                default:
                                    break;
                            }

                            html += '</div></div></div>';

                            return html;

                        }).withOption('width', '13%').notSortable()
                ];

                $scope.mostrar_orden = function (codigo_orden) {

                    var altura_modal = screen.height * .6 + 'px';
                    var ancho = '100%';

                    var contenedor_modal = document.getElementById('contenedor_modal_orden');

                    //Vaciamos el contenido del modal
                    contenedor_modal.innerHTML = '';
                    contenedor_modal.style.padding = '0'; //Quitamos el padding del modal
                    contenedor_modal.style.minHeight = altura_modal;

                    //Creamos el iframe
                    var iframe = document.createElement('iframe');
                    //iframe.frameBorder = "no";
                    iframe.width = ancho;
                    //Le colocamos al iframe el heigth del modal
                    iframe.height = altura_modal;
                    iframe.setAttribute('allowfullscreen', true);
                    iframe.setAttribute('webkitallowfullscreen', true);

                    //Asignamos el src para cargar el pdf
                    iframe.src = '/bower_components/viewerjs/ViewerJS/index.html?zoom=page-width#../../../datasheet/generar-pdf/' + codigo_orden;

                    //Asignamos el nuevo iframe al modal
                    contenedor_modal.appendChild(iframe);

                    angular.element('#modal_mostrar_orden').modal('show');

                };

                $scope.pre_aceptar_orden = function (_codigo) {
                    $http({
                        method: 'POST',
                        url: '/api/ordenes/procesar-orden',
                        data: {
                            accion_orden: 'pre_aceptar',
                            codigo_orden: _codigo
                        }
                    }).then(
                        function (data) {

                            var response = data.data;

                            if (response.resultado) {

                                $timeout(function(){
                                    $scope.datos_pedidos_aceptar = response.datos;

                                    //Variable usada para pasarla a la vista, especificamente al boton de aceptar orden
                                    $scope.cod_orden_actual = _codigo;
                                });

                                $timeout(function () {
                                    angular.element('#modal_preaceptar_orden').modal('show');
                                });

                            }
                            else {
                                alertify.error(data.data.mensajes[0]);
                            }
                        },
                        function (data_error) {
                            ToolsService.generar_alerta_status(data_error);
                        }
                    );
                };

                $scope.aceptar_orden = function (_codigo) {
                    alertify.confirm("Seguro que desea aceptar la orden.", function () {
                        $http({
                            method: 'POST',
                            url: '/api/ordenes/procesar-orden',
                            data: {
                                accion_orden: 'aceptar',
                                codigo_orden: _codigo
                            }
                        }).then(
                            function (data) {

                                if (data.data.resultado) {
                                    ToolsService.reload_tabla($scope, 'tabla_ordenes', function () {
                                        alertify.success('Orden ' + _codigo + ' procesada con exito.');
                                    });
                                }
                                else {
                                    alertify.error(data.data.mensajes[0]);
                                }
                            },
                            function (data_error) {
                                ToolsService.generar_alerta_status(data_error);
                            }
                        );
                    }).set('title', '¡Atencion!');
                };

                $scope.cancelar_orden = function (_codigo) {
                    alertify.prompt("Seguro que desea cancelar la orden? <br> Escriba una razon por la cual cancelara la orden", '', function (_event, value_campo) {

                        $http({
                            method: 'POST',
                            url: '/api/ordenes/procesar-orden',
                            data: {
                                accion_orden: 'cancelar',
                                codigo_orden: _codigo,
                                razon_cancelar: value_campo
                            }
                        }).then(
                            function (data) {

                                if (data.data.resultado) {
                                    ToolsService.reload_tabla($scope, 'tabla_ordenes', function () {
                                        alertify.success('Orden ' + _codigo + ' cancelada con exito.');
                                    });
                                }
                                else {
                                    alertify.error(data.data.mensajes[0]);
                                }
                            },
                            function (data_error) {
                                ToolsService.generar_alerta_status(data_error);
                            }
                        );
                    }).set('title', '¡Atencion!');
                };


                $scope.pre_completar_orden = function (_codigo) {
                    $http({
                        method: 'POST',
                        url: '/api/ordenes/procesar-orden',
                        data: {
                            accion_orden: 'pre_completar',
                            codigo_orden: _codigo
                        }
                    }).then(
                        function (data) {

                            var response = data.data;

                            if (response.resultado) {

                                $timeout(function () {
                                    $scope.datos_pedidos_aceptar = response.datos;

                                    //Variable usada para pasarla a la vista, especificamente al boton de completar orden
                                    $scope.cod_orden_actual = _codigo;
                                });

                                $timeout(function () {
                                    angular.element('#modal_pre_completar_orden').modal('show');
                                });

                            }
                            else {
                                alertify.error(data.data.mensajes[0]);
                            }
                        },
                        function (data_error) {
                            ToolsService.generar_alerta_status(data_error);
                        }
                    );
                };

                $scope.completar_orden = function (_codigo) {
                    var retornos_valor_cero = 0;

                    //ESTA ES LA FUNCION PARA EJECUTAR LA ACCION DE COMPLETAR ORDEN

                    function accion_completar_orden(_codigo_orden) {
                        $http({
                            method: 'POST',
                            url: '/api/ordenes/procesar-orden',
                            data: {
                                accion_orden: 'completar',
                                codigo_orden: _codigo_orden,
                                data_pedido: $scope.datos_pedidos_aceptar
                            }
                        }).then(
                            function (data) {

                                var response = data.data;

                                if (response.resultado) {
                                    //console.log(response);
                                    ToolsService.reload_tabla($scope, 'tabla_ordenes');
                                }
                                else {
                                    alertify.error(data.data.mensajes[0]);
                                }
                            },
                            function (data_error) {
                                ToolsService.generar_alerta_status(data_error);
                            }
                        );
                    }

                    $scope.datos_pedidos_aceptar.forEach(function (item) {
                        if (item.cantidad_retornada === 0) {
                            retornos_valor_cero++;
                        }
                    });

                    if (retornos_valor_cero > 0) {
                        alertify.confirm("Hay ordenes que no tienen cantidad retornada, desea continuar de igual manera?",
                            function () {
                                accion_completar_orden(_codigo);
                            }
                        ).set("title", "Confirmar Accion!");
                    }
                    else {
                        accion_completar_orden(_codigo);
                    }
                };
            }

            if ($location.$$url == '/ordenes/generar-orden') {

                $scope.items_tabla_pedidos = [];
                $scope.select_laboratorio = ""; //Laboratorio seleccionado
                $scope.select_objeto = ""; //Objeto seleccionado
                $scope.cantidad = 0; //Cantidad del objeto seleccionado
                $scope.codigos_elemento = ''; // Mantiene un json string de los codigos del elemento que debe ser convertido con JSON.parse

                $scope.ver_contenedor_datos_orden = true;
                $scope.ver_contenedor_pedidos = false;

                $scope.procesar_accion = function (accion) {
                    if (accion == undefined || accion == null) {
                        return null;
                    }

                    switch (accion) {
                        case 'ver_pedidos_orden':

                            var form_is_valid = $('#formulario_generar_orden').form(reglas_formulario_datos_orden).form('is valid');

                            if (form_is_valid) {

                                $scope.ver_contenedor_datos_orden = false;
                                $scope.ver_contenedor_pedidos = true;
                            }

                            break;

                        case 'ver_datos_orden':
                            $scope.ver_contenedor_datos_orden = true;
                            $scope.ver_contenedor_pedidos = false;

                            break;
                    }

                };

                $scope.agregar_elemento_tabla = function () {

                    //var formulario = $('#formulario_registrar_stock');
                    var is_valid_form = true;//formulario.form(reglas_formulario_agregar_stock).form('is valid');

                    if ($scope.codigos_elemento.length === 0 || $scope.codigos_elemento.trim() === '') {
                        alertify.error("Error, No has seleccionado un elemento del inventario");
                        return false;
                    }
                    if (is_valid_form) {

                        var parametros = {
                            type: 'agregar_elemento',
                            cantidad_solicitada: $scope.cantidad
                        };

                        // Agregamos los nuevos attributos
                        //Se convierte los codigos elemento a objeto porque vienen en formato string
                        var temp_codigos = angular.fromJson($scope.codigos_elemento);

                        //Agregamos los codigos a la variable parametros
                        ToolsService.extender_atributos_objeto(parametros, temp_codigos);

                        $http({
                            method: 'GET',
                            url: '/api/ordenes/mostrar',
                            params: parametros
                        }).then(
                            function (data) {

                                if (data.data.resultado) {

                                    var data_items = data.data.datos;

                                    //Verificamos que no se repita el elemento en la lista
                                    var existe = 0;

                                    $scope.items_tabla_pedidos.forEach(function (obj, index, array) {
                                        data_items.forEach(function (item) {
                                            if ((obj.cod_dimension == item.cod_dimension) && (obj.cod_subdimension == item.cod_subdimension) && (obj.cod_agrupacion == item.cod_agrupacion) && (obj.cod_objeto == item.cod_objeto)) {
                                                existe++;
                                                return;
                                            }
                                        });
                                    });

                                    //Si no existe el nuevo elemento el la lista lo agregamos
                                    if (existe === 0) {

                                        var cantidad_solicitada = $scope.cantidad; // cantidad solicitada por el usuario
                                        var cantidad_real_solicitada = 0; // cantidad real que se solicita en caso que sean dos reactivos
                                        var cantidad_restante = 0; // cantidad restante del procedimiento cuando son dos reactivos

                                        data_items.forEach(function (item) {

                                            if (data_items.length > 1) {
                                                cantidad_restante = Number(cantidad_solicitada) - Number(item.cantidad_disponible);
                                                if (cantidad_restante > 0) {
                                                    cantidad_real_solicitada = Number(item.cantidad_disponible);
                                                    cantidad_solicitada = cantidad_restante;
                                                } else {
                                                    cantidad_real_solicitada = cantidad_solicitada;
                                                }

                                            } else {
                                                cantidad_real_solicitada = cantidad_solicitada;
                                            }

                                            nuevo_elemento = {
                                                id_item: ToolsService.generar_id_unico(),
                                                nombre_objeto: item.nombre_objeto,
                                                cantidad_solicitada: cantidad_real_solicitada,
                                                cod_dimension: item.cod_dimension,
                                                cod_subdimension: item.cod_subdimension,
                                                cod_agrupacion: item.cod_agrupacion,
                                                cod_objeto: item.cod_objeto,
                                                numero_orden: item.numero_orden,
                                                unidad: item.unidad,
                                                clase_objeto: item.clase_objeto
                                            };

                                            $scope.items_tabla_pedidos.push(nuevo_elemento);

                                        });

                                    }
                                    else {
                                        alertify.error("Ya agregaste un elemento igual a este en la lista");
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

                $scope.eliminar_item_tabla_pedidos = function (id_elemento) {
                    $scope.items_tabla_pedidos = $scope.items_tabla_pedidos.filter(function (obj) {
                        return obj.id_item !== id_elemento;
                    });
                };


                $scope.procesar_generar_orden = function () {

                    alertify.confirm("Esta seguro que desea generar esta Orden?", function () {

                        $scope.DatosForm.data_elementos_pedidos = $scope.items_tabla_pedidos;
                        $scope.DatosForm.laboratorio = $scope.select_laboratorio;

                        if ($scope.items_tabla_pedidos.length != 0) {

                            return ToolsService.registrar_dinamico($scope, $http, $timeout, {
                                url: '/api/ordenes/generar-orden',
                                exito: {
                                    titulo: 'Orden generada con exito',
                                    mensajes: ['La orden ha sido agregada a la cola de ordenes']
                                },
                                callbackSuccess: function (_scope) {
                                    $timeout(function () {
                                        _scope.items_tabla_pedidos = [];
                                        _scope.select_laboratorio = null;
                                        _scope.select_objeto = "";
                                        _scope.cantidad = 0;
                                        _scope.codigos_elemento = '';

                                        $('#formulario_generar_orden').form('clear'); // limpiamos el formulario

                                        _scope.procesar_accion('ver_datos_orden'); // Mostramos el formulario de datos orden
                                    });

                                }
                            })();
                        }
                        else {
                            alertify.error("Debes agregar al menos 1 elemento a la lista");
                        }
                    }, function () {
                        alertify.error("Cancelar");
                    }).set("title", "Confirmar Accion!");
                };


            }// If generar-orden

            if ($location.$$url == '/ordenes/buscar-orden') {
                $scope.opcion_busqueda = 'busqueda_orden_normal';

                $scope.verificar_opcion = function () {
                    alert($scope.opcion_busqueda);
                };

                $scope.onSuccess = function (data) {
                    //console.log(error);
                };
                $scope.onError = function (error) {
                    //console.log(error);
                };
                $scope.onVideoError = function (error) {
                    console.log(error);
                };

            }

        }
    ]
)
;