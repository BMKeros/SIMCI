<div class="ui centered grid">
    <div class="six wide tablet twelve wide computer column">
        <div class="ui form">

            <div ng-if="mostrar_mensaje">
                <div class="ui icon <% mensaje_validacion.color %> message">
                    <i class="<% mensaje_validacion.icono %> icon"></i>

                    <div class="content">
                        <div class="header"><% mensaje_validacion.titulo %></div>
                        <ul class="list">
                            <li ng-repeat=" mensaje in mensaje_validacion.mensajes track by $index"><% mensaje | capitalize %></li>
                        </ul>
                    </div>
                </div>
                <br>
            </div>

            <h3 class="ui centered dividing header">Generar Orden</h3>

            <br>

            <form id="formulario_generar_orden">

                <div id="contenedor_datos_orden" ng-show="ver_contenedor_datos_orden">

                    <h4 class="ui horizontal divider header" style="padding: 10px 30px 25px 30px">
                        Paso 1 - Datos de la orden
                    </h4>

                    <div class="field">

                        <div class="fields">
                            <div class="ten wide field">
                                <div class="field">
                                    <label>Responsable:</label>
                                    {{ Form::select_personas(array('name'=>'responsable', 'id'=>'responsable','ng-model'=>'DatosForm.responsable'),null, 'Responsable')}}
                                </div>
                            </div>
                            <div class="four two field"></div>
                            <div class="four wide field">
                                <label>Fecha de la actividad</label>
                                <div class="ui left icon input">
                                    <input type="text" name="fecha_actividad" id="fecha_actividad"
                                       placeholder="Fecha de actividad" ng-model="DatosForm.fecha_actividad">
                                    <i class="calendar icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <div class="two fields">
                            <div class="six field">
                                <label>Seleccione un laboratorio</label>
                                {{ Form::select_laboratorios(array('name'=>'select_laboratorio', 'id'=>'laboratorio','ng-model'=>'select_laboratorio'))}}
                            </div>
                        </div>

                    </div>

                    <div class="field">
                        <div class="two fields">
                            <div class="eleven wide field">
                                <label>Observaciones</label>
                                <textarea name="observaciones" ng-model="DatosForm.observaciones"
                                          placeholder="Observaciones" rows="2"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="action">
                        <div class="ui large right floated submit button green"
                             ng-click="procesar_accion('ver_pedidos_orden')"
                             id="btn_continuar">
                            Continuar <i class="angle double right icon"></i>
                        </div>
                    </div>
                </div>

                <div id="contenedor_pedidos" ng-show="ver_contenedor_pedidos">

                    <h4 class="ui horizontal divider header" style="padding: 10px 30px 25px 30px">
                        Paso 2 - Seleccionar elementos para la orden
                    </h4>

                    <div class="three fields">
                        <div class="seven wide field">
                            <label>Seleccione un elemento</label>

                            <div class="ui fluid category search">
                                <div class="ui left icon input">
                                    <input class="prompt" placeholder="Buscar elementos" type="text"
                                           id="campo_search_objeto">

                                    <input type="hidden" ng-model="select_objeto" id="select_objeto"
                                           name="select_objeto" ng-update-hidden>
                                    <i class="search icon"></i>
                                </div>
                            </div>
                        </div>

                        <!--  Input que almacena los codigos del elemento -->
                        <input type="hidden" ng-model="codigos_elemento" id="codigos_elemento" ng-update-hidden>

                        <div class="four wide field">
                            <label>Cantidad</label>
                            <div class="ui right icon input">
                                <input type="text" name="cantidad" placeholder="Cantidad" ng-model="cantidad">
                                <i class="edit icon"></i>
                            </div>
                        </div>

                        <div class="field">
                            <button class="ui icon inverted blue button" id="btn_items_ordenes"
                                    ng-click="agregar_elemento_tabla()"><i class="plus icon"></i></button>
                        </div>

                    </div>

                    <table class="ui celled striped table" width="100%">
                        <thead>
                        <tr>
                            <th width="60%">Nombre del elemento</th>
                            <th width="10" class="ui center aligned">Tipo</th>
                            <th width="10%" class="ui center aligned">Cantidad</th>
                            <th width="15%" class="ui center aligned">Unidad</th>
                            <th width="5%" align="center">Accion</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="elemento in items_tabla_pedidos track by $index" id="<% elemento.id_item %>"
                            ng-animate="'animate'" class="animate-repeat">
                            <td><% elemento.nombre_objeto | lowercase | capitalize%></td>
                            <td class="ui center aligned"><div class="ui teal horizontal label"><% elemento.clase_objeto %></div></td>
                            <td class="ui center aligned"><% elemento.cantidad %></td>
                            <td><% elemento.unidad %></td>
                            <td>
                                <button class="ui  icon small button" id="btn_action_item_orden"
                                        ng-click="eliminar_item_tabla_orden(elemento.id_item )">
                                    <i class="trash outline icon"></i>
                                </button>
                            </td>
                        </tr>

                        <tr ng-if="items_tabla_pedidos.length == 0">
                            <td colspan="4">
                                <p align="center">No hay elementos en la tabla</p>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <br>

                    <div class="action">
                        <div class="ui large left floated submit button red"
                             ng-click="procesar_accion('ver_datos_orden')"
                             id="btn_continuar">
                            <i class="angle double left icon"></i> Atras
                        </div>

                        <div class="ui big right floated submit button green" ng-click="procesar_generar_orden()"
                             id="btn_generar">
                            Generar
                        </div>
                    </div>

                </div>


            </form>
        </div>

    </div>
</div>

<script>
    $('.ui.dropdown').dropdown();

    var picker = new Pikaday({
        field: document.getElementById('fecha_actividad'),
        i18n: TOOLS_APP.lenguaje_pikaday,
    });

    $('.ui.search').search({
        type: 'category',
        minCharacters: 3,
        searchDelay: 300,
        onSelect: function (elem_select, response) {
            //Guardamos el objeto seleccionado en el input hidden
            $('#select_objeto').val(elem_select.value).trigger('change');
            $('#codigos_elemento').val(elem_select.codigos_elemento).trigger('change');
        },
        apiSettings: {
            onResponse: function (_Response) {
                var response = {
                    results: {}
                };

                $.each(_Response.results, function (index, item) {
                    var
                            clase_objeto = item.nombre_clase_objeto || 'Desconocida',
                            maxResults = 8
                            ;
                    if (index >= maxResults) {
                        return false;
                    }

                    if (response.results[clase_objeto] === undefined) {
                        response.results[clase_objeto] = {
                            name: clase_objeto,
                            results: []
                        };
                    }

                    response.results[clase_objeto].results.push({
                        title: item.nombre_objeto.toLowerCase(),
                        description: item.especificaciones_objeto,
                        value: item.cod_objeto,
                        codigos_elemento: JSON.stringify({
                            cod_dimension: item.cod_dimension,
                            cod_subdimension: item.cod_subdimension,
                            cod_agrupacion: item.cod_agrupacion,
                            cod_objeto: item.cod_objeto
                        })
                    });
                });
                return response;
            },
            url: '/api/inventario/mostrar?type=search&query={query}'
        }
    });

</script>