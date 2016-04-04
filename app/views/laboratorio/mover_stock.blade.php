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

            <h3 class="ui centered dividing header">Mover el stock de los laboratorios.</h3>

            <form id="formulario_mover_stock">

                <br>

                <div class="field">
                    <div class="two fields">
                        <div class="eight wide field">
                            <label>Seleccione un laboratorio</label>
                            {{ Form::select_laboratorios(array('name'=>'select_laboratorio_origen', 'id'=>'laboratorio_origen','ng-model'=>'select_laboratorio_origen', 'ng-change' => 'cargar_objetos_laboratorio()'))}}
                        </div>

                        <div class="eight wide field">
                            <label>Seleccione el laboratorio al que se movera el stock</label>
                            {{ Form::select_laboratorios(array('name'=>'select_laboratorio_destino', 'id'=>'laboratorio_destino','ng-model'=>'select_laboratorio_destino', 'ng-change'=>'validar_seleccion()'))}}
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
                <th width="6%" class="center aligned">Cantidad Disponible</th>
                <th width="6%" class="center aligned">Cantidad a Mover</th>
                <th width="2%" class="ui center aligned">Accion</th>
            </tr>
            </thead>

            <tbody>
            <tr ng-repeat="elemento in items_tabla_objetos_laboratorio track by $index"
                id="<% elemento.id_unico_item %>" ng-animate="'animate'" class="animate-repeat">
                <td><% elemento.nombre_objeto | lowercase | capitalize%></td>
                <td><% elemento.cantidad %></td>
                <td class="center aligned">
                    <div class="ui input">
                        <input type="text" disabled="disabled" size="5" ng-model="elemento.cantidad_mover" ng-only-number allow-decimal="false" allow-negative="false">
                    </div>
                </td>

                <td class="center aligned">
                    <button class="ui icon small inverted blue button" id="btn_actison_item"
                            ng-disabled="elemento.cantidad == 0"
                            ng-click="seleccionar_item_tabla($event)" data-id-fila='<% elemento.id_unico_item %>'>
                        <i class="checkmark icon"></i>
                    </button>
                </td>
            </tr>

            <tr ng-if="items_tabla_objetos_laboratorio.length == 0">
                <td colspan="4">
                    <p align="center">No hay elementos para ser movidos</p>
                </td>
            </tr>
            </tbody>
        </table>

        <br>

        <br>

        <div class="action">
            <div class="ui right floated positive button" ng-click="procesar_mover_stock();">
                Mover
            </div>
        </div>
    </div>
</div>


<script>
    $('.ui.dropdown').dropdown();

    $('.ui.search').search({
        type: 'category',
        minCharacters: 3,
        searchDelay: 300,
        onSelect: function (elem_select, response) {
            //Guardamos el objeto seleccionado en el input hidden
            $('#select_objeto').val(elem_select.value).trigger('change');
            //Vaciamos el campo de busqueda
            $('#campo_search_objeto').val('');
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
                        value: item.cod_objeto
                    });
                });
                return response;
            },
            url: '/api/inventario/mostrar?type=search&query={query}'
        }
    });


</script>

