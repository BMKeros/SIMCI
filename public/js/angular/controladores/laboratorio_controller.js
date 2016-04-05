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
        function ($scope, $http, $log ,$timeout,$route, $routeParams, $location,DTOptionsBuilder,DTColumnBuilder,$compile,ToolsService,$templateCache,$filter){

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
                    nombre:"registrar laboratorio",
                    descripcion: "Esta opcion le permitira añadir nuevos laboratorios",
                    url: "#/laboratorio/crear-laboratorio",
                    icono: 'write',
                    show_in:[TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_ALMACENISTA]
                },

                {
                    nombre:"mostrar laboratorios",
                    descripcion: "Esta opcion le permitira ver los nuevos laboratorios",
                    url: "#/laboratorio/ver/todos",
                    icono: 'unhide',
                    show_in:[TIPO_USER_ROOT, TIPO_USER_ADMIN,  TIPO_USER_ALMACENISTA, TIPO_USER_SUPERVISOR, TIPO_USER_PROFESOR]
                },


                {
                    nombre:"agregar stock",
                    descripcion: "Esta opcion le permitira agregar nuevos stock al laboratorios",
                    url: "#/laboratorio/agregar-stock",
                    icono: 'plus',
                    show_in:[TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_ALMACENISTA]
                },


                {
                    nombre:"mostrar stock",
                    descripcion: "Esta opcion le permitira ver los nuevos stock y moverlos a nuevos laboratorios",
                    url: "#/laboratorio/ver/stock",
                    icono: 'eye',
                    show_in:[TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_ALMACENISTA, TIPO_USER_SUPERVISOR, TIPO_USER_PROFESOR]
                },

                {
                    nombre:"mover stock",
                    descripcion: "Esta opcion le permitira mover los stock del laboratorios y moverlos a nuevos laboratorios",
                    url: "#/laboratorio/mover-stock",
                    icono: 'external',
                    show_in:[TIPO_USER_ROOT, TIPO_USER_ADMIN, TIPO_USER_ALMACENISTA]
                }

            ];

            $log.info($routeParams);
            $log.info($location);

            if($location.$$url == '/laboratorio/crear-laboratorio'){
                $scope.mostrar_mensaje = false;
                $scope.DatosForm = {};

                $scope.registrar_laboratorio = ToolsService.registrar_dinamico($scope,$http,$timeout,{
                    url: '/api/laboratorio/registrar-laboratorio',

                    formulario:{
                        id:'formulario_crear_laboratorio',
                        reglas: reglas_formulario_registrar_laboratorio
                    },
                    exito:{
                        titulo: 'Laboratoiro creado con exito',
                        mensajes: ['Nuevo Laboratorio registrado en la base de datos.']
                    }///inventario/registrar-estante
                });

            }// If == '/laboratorio/crear-laboratorio'

            if($location.$$url == '/laboratorio/ver/todos'){

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
                    .withOption('createdRow', function(row, data, dataIndex) {
                        $compile(angular.element(row).contents())($scope);

                        $timeout(function(){
                            $('.ui.spopup').popup();
                        },false,0);
                    });

                $scope.columnas_tabla_laboratorios = [
                    DTColumnBuilder.newColumn(null).withTitle('Codigo').renderWith(
                        function(data,type, full){
                            return ToolsService.printf('<a class="ui tiny blue tag label">{0}</a>',data.codigo);
                        }
                    ).notSortable().withOption('width', '7%'),
                    DTColumnBuilder.newColumn('nombre').withTitle('Nombre').notSortable(),
                    DTColumnBuilder.newColumn('descripcion').withTitle('Descripcion').notSortable(),

                    DTColumnBuilder.newColumn(null).withTitle('Acciones').renderWith(
                        function(data, type, full) {
                            return '<a class="ui icon button blue spopup" data-content="Ver Laboratorio" ng-click="modal_ver_laboratorio(\''+data.codigo+'\')"><i class="unhide icon"></i></a>'+
                                '<a class="ui icon button green spopup"  data-content="Modificar Laboratorio" ng-click="modal_modificar_laboratorio(\''+data.codigo+'\')"><i class="edit icon"></i></a>'+
                                '<a class="ui icon button red spopup"  data-content="Eliminar Laboratorio" ng-click="modal_eliminar_laboratorio(\''+data.codigo+'\')"><i class="remove icon"></i></a>';
                        })
                        .withOption('width', '15%')
                ];

                ///Funciones
                $scope.modal_ver_laboratorio = function(id){
                    $scope.data_laboratorio = {};

                    ToolsService.mostrar_modal_dinamico($scope,$http,{
                        url: '/api/laboratorio/mostrar?type=laboratorio_full&id='+id,
                        scope_data_save_success: 'data_laboratorio',
                        id_modal: 'modal_ver_laboratorio'
                    });
                };

                $scope.modal_modificar_laboratorio = function(id){
                    //capturamos el id del laboratorio actual
                    $scope.id_lab_actual = id;

                    //Desactivamos los mensajes
                    $scope.mostrar_mensaje = false;

                    $http({
                        method: 'GET',
                        url: '/api/laboratorio/mostrar?type=laboratorio_full&id='+id,
                    }).then(function(data){

                        $scope.DatosForm = data.data;

                        setTimeout(function(){
                            //Mostramos la modal
                            angular.element('#modal_modificar_laboratorio').modal('show');

                        },300);

                    },function(data_error){
                        $log.info(data_error);
                    });
                };

                $scope.procesar_modificar = function(){
                    var id_usuario = $scope.id_lab_actual;

                    ToolsService.loading_button('btn-modificar',true);

                    $http({
                        method: 'POST',
                        url: '/api/laboratorio/actualizar-laboratorio?id='+id_usuario,
                        data: $scope.DatosForm
                    }).then(function(data){
                        if(data.data.resultado){

                            $scope.mostrar_mensaje = true;

                            $scope.mensaje_validacion = {
                                titulo: 'Laboratorio modificado con exito',
                                icono: 'checkmark',
                                color: 'green',
                                mensajes: []
                            };

                            //Desactivamos el loading
                            ToolsService.loading_button('btn-modificar',false);

                            setTimeout(function(){
                                ToolsService.reload_tabla($scope,'tabla_laboratorios',function(){});
                            },500);

                        }else{
                            $scope.mostrar_mensaje = true;

                            $scope.mensaje_validacion = {
                                titulo: 'Error al modificar el laboratorio',
                                icono: 'remove',
                                color: 'red',
                                mensajes: data.data.mensajes
                            };

                            //Desactivamos el loading
                            ToolsService.loading_button('btn-modificar',false);
                        }
                    },function(data_error){
                        //$log.info(data_error);
                        //Desactivamos el loading
                        ToolsService.loading_button('btn-modificar',false);
                    });

                };


                $scope.modal_eliminar_laboratorio = function(id){
                    alertify.confirm('Seguro que desea eliminar este laboratorio!',
                        //onok consulta para verificar si tiene relaciones con otras tablas
                        function(){
                            $http({
                                method: 'GET',
                                url: '/api/laboratorio/verificar?type=relacion_laboratorio&cod_laboratorio='+id
                            }).then(function(data){
                                    //verificamos si el laboratorio tiene relacion en otras tablas
                                    if(data.data.resultado){
                                        alertify.alert(data.data.mensajes);
                                    }
                                    else{
                                        //sino tiene relaciones, que confirme para que elimine el laboratorio
                                        alertify.confirm(data.data.mensajes,
                                            //onok para eliminar el usuairo
                                            function(){
                                                $http({
                                                    method: 'POST',
                                                    url: '/api/laboratorio/eliminar?id='+id,
                                                }).then(function(data){

                                                    if(data.data.resultado){

                                                        //Recargamos la tabla
                                                        setTimeout(function(){
                                                            ToolsService.reload_tabla($scope,'tabla_laboratorios',function(data){});
                                                        }, 500);
                                                    }
                                                    else{
                                                        $log.info(data);
                                                    }
                                                },function(data_error){
                                                    //$log.info(data_error);
                                                    ToolsService.generar_alerta_status(data_error);
                                                });
                                            }
                                        ).set('title', '¡Alerta!');
                                    }
                                },
                                function(data_error){
                                    $log.info(data_error);
                                });
                        }
                    ).set('title', '¡Alerta!');
                };//fin de la funcion eliminar de laboratorios


            }//fin del if de ver-laboratorios


            if($location.$$url == '/laboratorio/ver/stock'){

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
                    .withOption('createdRow', function(row, data, dataIndex) {
                        $compile(angular.element(row).contents())($scope);

                        $timeout(function(){
                            $('.ui.spopup').popup();
                        },false,0);
                    });

                $scope.columnas_tabla_stock = [
                    DTColumnBuilder.newColumn('nombre_objeto').withTitle('Nombre').notSortable(),
                    DTColumnBuilder.newColumn('cantidad')
                        .withTitle('Cantidad')
                        .withOption('width','10%')
                        .notSortable(),
                    DTColumnBuilder.newColumn('nombre_laboratorio').withTitle('Laboratorio').notSortable(),

                    DTColumnBuilder.newColumn(null).withTitle('Acciones').renderWith(
                        function(data, type, full) {
                            return '<div class="ui icon button blue spopup" data-content="Ver Stock" ng-click="modal_ver_stock('+data.id+')"><i class="unhide icon"></i></div>'+
                                '<div class="ui icon button green spopup"  data-content="Modificar Stock" ng-click="modal_modificar_stock('+data.id+')"><i class="edit icon"></i></div>'+
                                '<div class="ui icon button red spopup"  data-content="Eliminar Stock" ng-click="modal_eliminar_stock('+data.id+')"><i class="remove icon"></i></div>';
                        }).withOption('width','14%')
                ];

            }// If == '/laboratorio/ver/stock

            if($location.$$url == '/laboratorio/agregar-stock'){

                $scope.items_tabla_stock = []; //Aqui se guardaran todos los elementos que se agreguen con el btn plus
                $scope.select_laboratorio=""; //Laboratorio seleccionado
                $scope.select_objeto=""; //Objeto seleccionado
                $scope.cantidad = 0; //Cantidad del objeto seleccionado


                $scope.cantidad_disponible_inventario = 0;

                $scope.agregar_stock_tabla = function () {

                    var formulario = $('#formulario_registrar_stock');
                    var is_valid_form = formulario.form(reglas_formulario_agregar_stock).form('is valid');

                    if($scope.cantidad > $scope.cantidad_disponible_inventario){
                        alertify.error("La cantidad ingresada es mayor a la disponible en inventario");
                        return false;
                    }
                    if(is_valid_form){
                        $http({
                            method: 'GET',
                            url: '/api/laboratorio/mostrar?type=agregar_stock&cod_laboratorio=' + $scope.select_laboratorio + '&cod_objeto=' + $scope.select_objeto
                        }).then(
                            function (data) {

                                var data_item = data.data;

                                //Verificamos que no se repita el elemento en la lista
                                var existe = $scope.items_tabla_stock.findIndex(function (obj, index, array) {
                                    return (obj.cod_objeto == $scope.select_objeto) && (obj.cod_laboratorio == $scope.select_laboratorio);
                                });

                                //Si no existe el nuevo elemento el la lista lo agregamos
                                if (existe === -1) {
                                    $scope.items_tabla_stock.push({
                                        id_item_stock: ToolsService.generar_id_unico(),
                                        nombre_laboratorio: data_item.nombre_laboratorio,
                                        cod_laboratorio: data_item.cod_laboratorio,
                                        cod_objeto: data_item.cod_objeto,
                                        nombre_objeto: data_item.nombre_objeto,
                                        cantidad: $scope.cantidad
                                    });
                                    console.log($scope.items_tabla_stock);
                                }
                                else{
                                    alertify.error("Ya agregaste un stock igual a este en la lista");
                                }
                            },
                            function (data_error) {
                                ToolsService.generar_alerta_status(data_error);
                            }
                        );
                    }
                };

                $scope.procesar_agregar_stock = function(){

                    //Seteamos la data en la variable DatosForm para enviarla con el registro dinamico
                    $scope.DatosForm.items_stock = $scope.items_tabla_stock;

                    if($scope.items_tabla_stock.length != 0) {
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
                                });
                            }
                        })();
                    }
                    else{
                        alertify.error("Debes agregar al menos 1 elemento a la lista");
                    }
                };

                $scope.eliminar_stock_tabla = function (id_elemento) {

                    $scope.items_tabla_stock = $scope.items_tabla_stock.filter(function(obj) {
                        return obj.id_item_stock !== id_elemento;
                    });

                };

            }//Fin de agregar-stock

            if($location.$$url == '/laboratorio/mover-stock'){

                $scope.items_tabla_objetos_laboratorio = [];
                $scope.select_laboratorio_origen = null;
                $scope.select_laboratorio_destino = null;

                $scope.cargar_objetos_laboratorio = function(){

                    $http({
                            method: 'GET',

                            url: '/api/laboratorio/mostrar?type=stock_laboratorio&cod_laboratorio='+$scope.select_laboratorio_origen
                        }).then(
                            function(data){
                                //asi es como se va a mostrar
                                $scope.items_tabla_objetos_laboratorio = data.data;
                                $scope.items_tabla_objetos_laboratorio.forEach( function(element, index) {
                                    element.id_unico_item = ToolsService.generar_id_unico();
                                    element.cantidad_mover = 0;
                                });
                            },
                            function(data_error){
                                ToolsService.generar_alerta_status(data_error);
                            }
                    );
                };

                $scope.procesar_mover_stock = function(){
                    
                    $scope.items_tabla_objetos_laboratorio.forEach( function(element, index){
                        element.cod_laboratorio_origen = $scope.select_laboratorio_origen;
                        element.cod_laboratorio_destino = $scope.select_laboratorio_destino;
                    });

                    $scope.items_tabla_objetos_laboratorio = $scope.items_tabla_objetos_laboratorio.filter(function(element){
                            return !(element.cantidad_mover == 0);
                    });


                    if($scope.select_laboratorio_origen == null){
                        alertify.error("Aun no has seleccionado laboratorio origen");
                        return false;
                    }
                    else if($scope.select_laboratorio_destino == null){
                        alertify.error("Aun no has seleccionado laboratorio destino");
                        return false;
                    }
                    else if($scope.items_tabla_objetos_laboratorio.length == 0){
                        alertify.error("Aun no has seleccionado ningun objeto");
                        return false;
                    }
                    else{
                        $http({
                            method: 'POST',
                            url: '/api/laboratorio/mover-stock',
                            data: {
                                'data': $scope.items_tabla_objetos_laboratorio
                            }
                        }).then(
                            function(data){
                                if(data.data.resultado){
                                    $scope.items_tabla_objetos_laboratorio = []  
                                    $('#laboratorio_origen').dropdown('restore defaults');
                                    $('#laboratorio_destino').dropdown('restore defaults');
                                    alertify.notify('Objetos movido con exito!', 'success', 5, function(){  console.log('dismissed'); });
                                }
                            },
                            function(data_error){
                                ToolsService.generar_alerta_status(data_error);
                            }
                        );
                    }
                };

                $scope.validar_seleccion = function(){
                    if($scope.select_laboratorio_origen === $scope.select_laboratorio_destino){
                        $('#laboratorio_destino').dropdown('restore defaults');
                        $scope.select_laboratorio_destino = null;

                        alertify.error("No puedes mover el stock al mismo laboratorio");
                    }
                };

                $scope.seleccionar_item_tabla=function (_event) {
                    elemento = angular.element(_event.target);
                    elemento_hijo = angular.element(elemento.find('i.icon').get(0));
                    elemento_fila = angular.element('#'+elemento.attr('data-id-fila'));

                    campo_cantidad_mover = angular.element(elemento_fila.find('input').get(0));

                    campo_cantidad_mover.val(0).trigger('change');

                    if (elemento.hasClass('blue')) {
                        campo_cantidad_mover.removeAttr('disabled');
                        elemento.removeClass('blue').addClass('red');
                        elemento_hijo.removeClass('checkmark').addClass('remove');
                        elemento_fila.addClass('negative').removeClass('positive');
                    }
                    else {
                        campo_cantidad_mover.attr('disabled','');
                        elemento.removeClass('red').addClass('blue');
                        elemento_hijo.removeClass('remove').addClass('checkmark');
                        elemento_fila.removeClass('negative');
                    }

                }

            }//Fin de mover-stock

        }]
);
