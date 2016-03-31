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

            <h3 class="ui centered dividing header">Generar Ordenes</h3>

            <br>

            <form id="formulario_generar_ordenes">

                <div class="field">
                    <div class="two fields">
                        <div class="field">
                            <label>Responsable:</label>
                        </div>
                        <div class="four wide field">
                            <label>Fecha de la actividad</label>
                            <input type="text" name="fecha_actividad" id="fecha_actividad" placeholder="Fecha de actividad" ng-model="DatosForm.fecha_actividad">
                        </div>
                    </div>
                </div>

                <br>

                <div class="field">
                    <div class="two fields">
                        <div class="six field">
                            <label>Seleccione un laboratorio</label>
                            {{ Form::select_laboratorios(array('name'=>'select_laboratorio', 'id'=>'laboratorio','ng-model'=>'select_laboratorio'))}}
                        </div>
                    </div>

                    <br>

                    <div class="two fields">
                        <div class="seven wide field">
                            <label>Seleccione un elemento</label>
                            <div class="ui fluid category search">
                                <div class="ui left icon input">
                                    <input class="prompt" placeholder="Buscar elementos" type="text" id="campo_search_objeto">

                                    <input type="hidden" ng-model="select_objeto" id="select_objeto" name="select_objeto" ng-update-hidden>
                                    <i class="search icon"></i>
                                </div>
                            </div>
                        </div>

                        <div class="four wide field">
                            <label>Cantidad</label>
                            <input type="number" name="cantidad" placeholder="Cantidad" ng-model="cantidad">
                            <input type="hidden" id="cantidad_disponible_inventario" ng-model="cantidad_disponible_inventario" ng-update-hidden>
                        </div>

                    </div>
                </div>

                <br>

                <div class="field">
                    <div class="two fields">
                        <div class="eleven wide field">
                            <label>Observaciones</label>
                            <textarea name="observaciones" ng-model="DatosForm.observacones" placeholder="Observaciones" rows="2"></textarea>
                        </div>

                        <div class="field">
                            <button class="ui icon large inverted blue button" id="btn_items_ordenes" ng-click="generar_items_orden()"><i class="plus icon" ></i></button>
                        </div>
                    </div>
                </div>



            </form>
        </div>

        <br>

        <br>

        <table class="ui celled striped table" width="100%">
            <thead>
            <tr>
                <th width="40%">Nombre</th>
                <th width="20%">Cantidad</th>
                <th width="35%">Laboratorio</th>
                <th width="5%" align="center">Accion</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="elemento in items_tabla_orden track by $index" id="<% elemento.id_item_orden %>" ng-animate="'animate'" class="animate-repeat">
                <td><% elemento.nombre_objeto | lowercase | capitalize%></td>
                <td><% elemento.cantidad %></td>
                <td><% elemento.nombre_laboratorio | lowercase | capitalize %></td>
                <td>
                    <button class="ui  icon small button" id="btn_action_item_orden" ng-click="eliminar_item_tabla_orden(elemento.id_item_orden )">
                        <i class="trash outline icon"></i>
                    </button>
                </td>
            </tr>

            <tr ng-if="items_tabla_orden.length == 0">
                <td colspan="4">
                    <p align="center">No hay elementos para ser agregados</p>
                </td>
            </tr>
            </tbody>
        </table>

        <br>

        <div class="action">
            <div class="ui big right floated submit button green" ng-click="procesar_generar_orden()" id="btn_generar">
                Generar
            </div>
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
        type          : 'category',
        minCharacters : 3,
        searchDelay: 300,
        onSelect: function(elem_select, response){
            //Guardamos el objeto seleccionado en el input hidden
            $('#select_objeto').val(elem_select.value).trigger('change');
            $('#cantidad_disponible_inventario').val(elem_select.cantidad_disponible).trigger('change');
        },
        apiSettings   : {
            onResponse: function(_Response) {
                var response = {
                    results : {}
                };

                $.each(_Response.results, function(index, item) {
                    var
                            clase_objeto   = item.nombre_clase_objeto || 'Desconocida',
                            maxResults = 8
                            ;
                    if(index >= maxResults) {
                        return false;
                    }

                    if(response.results[clase_objeto] === undefined) {
                        response.results[clase_objeto] = {
                            name    : clase_objeto,
                            results : []
                        };
                    }

                    response.results[clase_objeto].results.push({
                        title       : item.nombre_objeto.toLowerCase(),
                        description : item.especificaciones_objeto,
                        value: item.cod_objeto,
                        cantidad_disponible: item.cantidad_disponible
                    });
                });
                return response;
            },
            url: '/api/inventario/mostrar?type=search&query={query}'
        }
    });

</script>