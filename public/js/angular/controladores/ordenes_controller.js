/// Controlador para Ordenes

simci.controller('OrdenesController', [
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
        '$window',
        function ($scope, $http, $log, $timeout, $route, $routeParams, $location, DTOptionsBuilder, DTColumnBuilder, $compile, ToolsService, $templateCache, $window) {

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
                    .withOption('createdRow', function (row, data, dataIndex) {
                        $compile(angular.element(row).contents())($scope);

                        $timeout(function () {
                            $('.ui.spopup').popup();
                        }, false, 0);
                    });

                $scope.columnas_tabla_ordenes = [
                    DTColumnBuilder.newColumn(null).withTitle('Nombre')
                        .notSortable(),

                    DTColumnBuilder.newColumn('fecha de actividad').withTitle('Fecha de la actividad').notSortable(),

                    DTColumnBuilder.newColumn('laboratorio').withTitle('Laboratorio').notSortable(),

                    DTColumnBuilder.newColumn(null).withTitle('Acciones').renderWith(
                        function (data, type, full) {
                            return '<div class="ui icon button blue spopup" data-content="Ver Ordenes" ng-click="modal_ver_ordenes(' + data.id + ')"><i class="unhide icon"></i></div>' +
                                '<div class="ui icon button green spopup"  data-content="Modificar Ordenes" ng-click="modal_modificar_ordenes(' + data.id + ')"><i class="edit icon"></i></div>' +
                                '<div class="ui icon button red spopup"  data-content="Eliminar Ordenes" ng-click="modal_eliminar_ordenes(' + data.id + ')"><i class="remove icon"></i></div>';
                        }).withOption('width', '17%')
                ];

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

                                    var data_item = data.data.datos;

                                    //Verificamos que no se repita el elemento en la lista
                                    var existe = $scope.items_tabla_pedidos.findIndex(function (obj, index, array) {
                                        return (obj.cod_dimension == data_item.cod_dimension) && (obj.cod_subdimension == data_item.cod_subdimension) && (obj.cod_agrupacion == data_item.cod_agrupacion) && (obj.cod_objeto == data_item.cod_objeto);
                                    });

                                    //Si no existe el nuevo elemento el la lista lo agregamos
                                    if (existe === -1) {

                                        var nuevo_elemento = {
                                            id_item: ToolsService.generar_id_unico(),
                                            nombre_objeto: data_item.nombre_objeto,
                                            cantidad: $scope.cantidad,
                                            cod_dimension: data_item.cod_dimension,
                                            cod_subdimension: data_item.cod_subdimension,
                                            cod_agrupacion: data_item.cod_agrupacion,
                                            cod_objeto: data_item.cod_objeto,
                                            numero_orden: data_item.numero_orden,
                                            unidad: data_item.unidad,
                                            clase_objeto: data_item.clase_objeto
                                        };

                                        $scope.items_tabla_pedidos.push(nuevo_elemento);
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
                                CallbackSuccess: function(){
                                    setTimeout(function(){
                                        $window.location.reload();
                                    },1000);
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


            }

        }
    ]
)
;