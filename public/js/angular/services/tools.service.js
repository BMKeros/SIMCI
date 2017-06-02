(function () {
    'use strict';

    angular
        .module('SIMCI')
        .factory('ToolsService', ToolsService);

    ToolsService.$injector = ['$http', '$timeout', 'CONSTANTES'];

    function ToolsService($http, $timeout, CONSTANTES) {
        return {
            tools_input: {
                //Para convertir el valor de los input en mayuscula
                upper: function (_event) {
                    var input = angular.element(_event.currentTarget);
                    var value_upper = input.val().toUpperCase();
                    input.val(value_upper);
                }
            },
            //Funcion para formatear string
            printf: function (formato) {
                var args = Array.prototype.slice.call(arguments, 1);
                return formato.replace(/{(\d+)}/g, function (match, number) {
                    return typeof args[number] != 'undefined' ? args[number] : match;
                });
            },
            //Funcion para cortar el string dependiendo del numero de caracteres por parametros
            cut_string: function (string, num_char) {
                var infin = ((string.length > num_char) ? '....' : '');
                return string.substring(0, num_char) + infin;
            },
            //Funcion para quitar decimales si son ceros
            quitar_ceros_decimales: function (numero) {
                var decimal = Number(numero);
                return ( !isNaN(decimal) ) ? (numero) : (null);
            },
            //Funcion para mostrar el loading
            loading_button: function (id_button, activado) {
                if (activado) {
                    $('#' + id_button).addClass('loading').prop('disabled', true);
                }
                else {
                    $('#' + id_button).removeClass('loading').prop('disabled', false);
                }
            },
            //Funcion para recargar el cache que causa el ng-route
            reload_template_cache: function ($ROUTE, $TEMPLATE_CACHE) {
                var URLTemplate = $ROUTE.current.loadedTemplateUrl;
                $TEMPLATE_CACHE.remove(URLTemplate);
            },
            //Funcion para recargar las tablas de datatables
            reload_tabla: function ($SCOPE, NOMBRE_TABLA, CALLBACK) {
                $SCOPE[NOMBRE_TABLA].reloadData(CALLBACK, false);
            },
            //Funcion para añadir a los parametros las comillas para que asi la funcion los reciba como string
            anadir_comillas_params: function () {
                var params = Array.prototype.slice.call(arguments, 0);
                var string = params.join("\',\'");
                return this.printf('\'{0}\'', string);
            },
            //Funcion para obtener la clase css para el estatus de una orden
            get_class_status_orden: function (status_code) {
                var clase = "";
                switch (status_code) {
                    case CONSTANTES.ORDEN_ACTIVA:
                        clase = 'color-info'; //activo
                        break;
                    case CONSTANTES.ORDEN_PENDIENTE:
                        clase = 'color-warning'; //pendiente
                        break;
                    case CONSTANTES.ORDEN_CANCELADA:
                        clase = 'color-error'; //cancelada
                        break;
                    case CONSTANTES.ORDEN_COMPLETADA:
                        clase = 'color-success'; // completada
                        break;
                }
                return clase;
            },
            //Funcion para devolver el mensaje con respecto al codigo http
            get_mensaje_fail_http: function (data_ajax) {
                var objeto = {};
                var data_mensajes = '';
                if (data_ajax.data.hasOwnProperty('error')) {
                    data_mensajes = [data_ajax.data.error.message];
                }
                else {
                    data_mensajes = data_ajax.data.mensajes;
                }

                switch (data_ajax.status) {
                    case 401:
                        objeto = {
                            titulo: "Upss, Acceso no autorizado, inicie sesion porfavor. Estado[" + data_ajax.status + "]",
                            icono: 'ban',
                            color: 'red',
                            mensajes: data_mensajes
                        };
                        break;
                    case 403:
                        objeto = {
                            titulo: "Upss, Hubo un problema con sus permisos. Estado[" + data_ajax.status + "]",
                            icono: 'ban',
                            color: 'red',
                            mensajes: data_mensajes
                        };
                        break;
                    case 500:
                        objeto = {
                            titulo: "Upss, Ocurrio un error en el servidor. Estado[" + data_ajax.status + "]",
                            icono: 'remove',
                            color: 'red',
                            mensajes: data_mensajes
                        };
                        break;
                }

                return objeto;
            },
            //Funcion para extender los atributos de un objeto
            extender_atributos_objeto: function (_objeto, _objeto_atributos) {
                if (typeof _objeto === "object" && typeof _objeto_atributos === "object") {
                    for (key in _objeto_atributos) {
                        if (typeof _objeto_atributos[key] !== "function") {
                            _objeto[key] = _objeto_atributos[key];
                        }
                    }
                }
            },
            //Funcion  para eliminar algun objeto o elemento de un arreglo
            //@ retorna el elemento eliminado
            eliminar_elemento_array: function (_array, _callback) {
                //Buscamos al elemento seleccionado en el arreglo
                var index_elemento = _array.findIndex(_callback);

                //Verificamos que existe en el arreglo
                if (index_elemento !== -1) {
                    var tmp = _array.splice(index_elemento, 1);
                    return tmp[0];
                }
                return null;

            },
            //Funcion para generar un alertify un mensaje dependiendo del status
            generar_alerta_status: function (data) {
                var mensaje = this.printf('Ha ocurrido un error al realizar la operacion. Estado[{0}]', data.status);
                alertify.error(mensaje);
            },
            //Funcion para obtener la data del usuario guardada en el localstorage
            get_data_user_localstorage: function () {
                return JSON.parse(localStorage.getItem('data_usuario'));
            },
            //Funcion para generar el codigo de los elementos del alamacen
            generar_codigo_elemento: function (obj_codigos, tipo, exclude) {

                if (tipo.toLowerCase() === 'label') {
                    var tmp = '';
                    if (exclude.indexOf('cod_dimension') == -1) {
                        tmp += '<div class="ui small green label spopup" data-content="Dimension">' + obj_codigos.cod_dimension + '</div>';
                    }
                    if (exclude.indexOf('cod_subdimension') == -1) {
                        tmp += '<div class="ui small blue label spopup" data-content="SubDimension">' + obj_codigos.cod_subdimension + '</div>';
                    }
                    if (exclude.indexOf('cod_agrupacion') == -1) {
                        tmp += '<div class="ui small teal  label spopup" data-content="Agrupacion">' + obj_codigos.cod_agrupacion + '</div>';
                    }
                    if (obj_codigos.cod_subagrupacion && exclude.indexOf('cod_subagrupacion') == -1) {
                        tmp += '<div class="ui small red label spopup" data-content="SubAgrupacion">' + obj_codigos.cod_subagrupacion + '</div>';
                    }
                    if (exclude.indexOf('numero_orden') == -1) {
                        tmp += '<div class="ui small gray label spopup" data-content="Numero de orden">' + obj_codigos.numero_orden + '</div>';
                    }

                    return tmp;
                }
            },
            //Funcion para generar id unicos
            generar_id_unico: function () {
                var text = "";
                var posible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
                for (var i = 0; i < 6; i++) {
                    text += posible.charAt(Math.floor(Math.random() * posible.length));
                }

                function get_code() {
                    return Math.floor((1 + Math.random()) * 0x10000)
                        .toString(16)
                        .substring(1);
                }

                for (i = 0; i < 8; i++) {
                    text += get_code();
                }

                return text;
            },
            //Funcion para mostrar modal dinamico
            mostrar_modal_dinamico: function ($_SCOPE, $_HTTP, opciones) {
                var this_root = this;
                $_HTTP({
                    method: 'GET',
                    url: opciones.url
                }).then(function (data) {

                    $_SCOPE[opciones.scope_data_save_success] = data.data;

                    if (opciones.callbackSuccess) {
                        opciones.callbackSuccess();
                    }

                    //Mostramos la modal
                    setTimeout(function () {
                        angular.element('#' + opciones.id_modal).modal('show');
                    }, 100);

                }, function (data_error) {
                    //$log.info(data_error);
                    this_root.generar_alerta_status(data_error);
                });

            },

            //Funcion para el hacer un modal dinamico con alertify para eliminar
            eliminar_elemento_dinamico: function (_SCOPE, opciones_modal) {

                var this_root = this;
                var config = {
                    titulo_confirm: {
                        principal: opciones_modal.titulo_confirm.principal || '¡Alerta!',
                        secundario: opciones_modal.titulo_confirm.secundario || 'Confirme su respuesta'
                    },
                    mensajes: {
                        principal: {
                            mensaje_confirmacion: opciones_modal.mensajes.principal.mensaje_confirmacion || 'mensaje_confirmacion_defualt',
                            error: opciones_modal.mensajes.principal.error || 'mensaje_error_principal_default'
                        },
                        secundario: {
                            mensaje_confirmacion: opciones_modal.mensajes.secundario.mensaje_confirmacion || 'mensaje_confirmacion_defualt',
                            success: opciones_modal.mensajes.secundario.success || "Eliminacion realizada con exito",
                            error: opciones_modal.mensajes.secundario.error || "Ha ocurrido un error al realizar la operacion"
                        }
                    },
                    urls: {
                        verificacion: opciones_modal.urls.verificacion,
                        eliminacion: opciones_modal.urls.eliminacion
                    },
                    nombre_tabla: opciones_modal.nombre_tabla || undefined
                };

                alertify.confirm(config.mensajes.principal.mensaje_confirmacion,
                    //onok consulta para verificar si tiene relaciones con otras tablas
                    function () {
                        $http({
                            method: 'POST',
                            url: config.urls.verificacion
                        }).then(function (data) {
                                //verificamos si tiene relacion en otras tablas
                                if (data.data.resultado) {
                                    alertify.alert(opciones_modal.mensajes.principal.error).set('title', 'Atencion!');
                                }
                                else {
                                    //sino tiene relaciones, que confirme para que elimine
                                    alertify.confirm(config.mensajes.secundario.mensaje_confirmacion,
                                        //onok para eliminar
                                        function () {
                                            $http({
                                                method: 'POST',
                                                url: config.urls.eliminacion
                                            }).then(function (data) {

                                                if (data.data.resultado) {
                                                    //Recargamos la tabla
                                                    setTimeout(function () {
                                                        this_root.reload_tabla(_SCOPE, config.nombre_tabla, function (data) {
                                                        });
                                                    }, 500);

                                                    alertify.success(config.mensajes.secundario.success);
                                                }
                                                else {
                                                    //$log.info(data.data);
                                                    alertify.error(config.mensajes.secundario.error);
                                                }
                                            }, function (data_error) {
                                                //$log.info(data_error);
                                                this_root.generar_alerta_status(data_error);
                                            });
                                        }
                                    ).set('title', config.titulo_confirm.secundario);
                                }
                            },
                            function (data_error) {
                                //$log.info(data_error);
                                this_root.generar_alerta_status(data_error);
                            });
                    }
                ).set('title', config.titulo_confirm.principal);
            },
            //Funcion para el registro dinamico de todos los controladores
            registrar_dinamico: function ($_SCOPE, $_HTTP, $_TIMEOUT, opciones) {
                var global_this = this;

                if (angular.isUndefined(opciones.id_btn_accion)) {
                    opciones.id_btn_accion = 'btn-registrar';
                }

                return function () {
                    var is_valid_form = true;
                    //Si no existe la opcion de formulario seteamos is_valid_form  = trues

                    if (opciones.formulario) {
                        var formulario = $('#' + opciones.formulario.id);
                        is_valid_form = formulario.form(opciones.formulario.reglas).form('is valid');
                    }

                    if (is_valid_form) {

                        //Activamos el loading
                        global_this.loading_button(opciones.id_btn_accion, true);

                        var config_http = {};

                        if (opciones.post_archivo) {

                            var data_enviar = new FormData();

                            for (var _key in $_SCOPE.DatosForm) {
                                if ($_SCOPE.DatosForm.hasOwnProperty(_key)) {
                                    data_enviar.append(_key, $_SCOPE.DatosForm[_key]);
                                }
                            }

                            config_http = {
                                method: 'POST',
                                url: opciones.url,
                                data: data_enviar,
                                transformRequest: angular.identity,
                                headers: {'Content-Type': undefined}
                            };

                        } else {

                            config_http = {
                                method: 'POST',
                                url: opciones.url,
                                data: $_SCOPE.DatosForm
                            };
                        }

                        $http(config_http).then(function (data) {

                            if (data.data.resultado) {

                                $_SCOPE.mostrar_mensaje = true;
                                $_SCOPE.mensaje_validacion = {
                                    titulo: opciones.exito.titulo,
                                    icono: opciones.exito.icono || 'checkmark',
                                    color: opciones.exito.color || 'green',
                                    mensajes: opciones.exito.mensajes
                                };

                                $timeout(function () {
                                    //Desactivamos el loading
                                    global_this.loading_button(opciones.id_btn_accion, false);

                                    if (opciones.formulario) {
                                        formulario.form('clear');
                                    }
                                    if (opciones.callbackSuccess) {
                                        opciones.callbackSuccess($_SCOPE);
                                    }
                                }, 0, false);

                            }
                            else {

                                $_SCOPE.mostrar_mensaje = true;
                                $_SCOPE.mensaje_validacion = {
                                    titulo: 'Hubo un error al guardar el formulario',
                                    icono: 'remove',
                                    color: 'red',
                                    mensajes: data.data.mensajes
                                };
                            }

                            //Desactivamos el loading
                            global_this.loading_button(opciones.id_btn_accion, false);

                        }, function (data_error) {
                            $_SCOPE.mostrar_mensaje = true;
                            $_SCOPE.mensaje_validacion = global_this.get_mensaje_fail_http(data_error);

                            //Desactivamos el loading
                            global_this.loading_button(opciones.id_btn_accion, false);
                        });
                    }
                }
            }
        }
    }
})();
