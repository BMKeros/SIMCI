<div class="ui centered grid">
    <div class="six wide tablet twelve wide computer column">
        <div class="ui form">
            <div ng-if="mostrar_mensaje">
                <div class="ui icon <% mensaje_validacion.color %> message">
                    <i class="<% mensaje_validacion.icono %> icon"></i>

                    <div class="content">
                        <div class="header"><% mensaje_validacion.titulo %></div>
                        <ul class="list">
                            <li ng-repeat=" mensaje in mensaje_validacion.mensajes track by $index"><% mensaje |
                                capitalize %>
                            </li>
                        </ul>
                    </div>
                </div>
                <br>
            </div>

            <h3 class="ui centered dividing header">Buscar Orden</h3>

            <br>

            <form id="formulario_buscar_orden">
                <div class="field">
                    <div class="two fields">
                        <div class="seven wide field">
                            <div class="field">
                                <label>Escribe el numero de orden</label>

                                <div class="ui fluid category search">
                                    <div class="ui left icon input">
                                        <input class="prompt" placeholder="Buscar Numero de Orden" type="text"
                                               id="campo_search_orden">

                                        <input type="hidden" ng-model="select_orden" id="select_orden"
                                               name="select_orden" ng-update-hidden>
                                        <i class="search icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  Input que almacena los codigos del elemento -->
                        <input type="hidden" ng-model="codigos_orden" id="codigos_orden" ng-update-hidden>

                        <div class="field">
                            <button class="ui icon large inverted green button" id="btn_agregar_items"
                                    ng-click="agregar_stock_tabla()"><i class="qrcode icon"></i></button>
                        </div>
                    </div>
                </div>

                <qr-scanner ng-success="onSuccess(data)" ng-if="(data)" width="400" height="300"></qr-scanner>

            </form>
        </div>
    </div>


    <div class="ui centered grid">
        <div class="six wide tablet twelve wide computer column">

            <br>

            <br>

            <table class="ui celled striped table" width="100%">
                <thead>
                <tr>
                    <th width="15%">Codigo</th>
                    <th width="15%">Responsable</th>
                    <th width="15%">Solicitante</th>
                    <th width="20%">Fecha Solicitud</th>
                    <th width="15%">Estado</th>
                    <th width="5%">Accion</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="elemento in items_tabla_stock track by $index" id="<% elemento.id_item_stock %>"
                    ng-animate="'animate'" class="animate-repeat">
                    <td><% elemento.nombre_objeto | lowercase | capitalize%></td>
                    <td><% elemento.cantidad %></td>
                    <td><% elemento.nombre_laboratorio | lowercase | capitalize %></td>
                    <td>
                        <button class="ui  icon small button" id="btn_action_item"
                                ng-click="eliminar_stock_tabla(elemento.id_item_stock )">
                            <i class="trash outline icon"></i>
                        </button>
                    </td>
                </tr>

                <tr ng-if="items_tabla_stock.length == 0">
                    <td colspan="4">
                        <p align="center">No hay elementos para ser agregados</p>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="6">
                        <div class="ui right floated pagination menu">
                            <a class="icon item">
                                <i class="left chevron icon"></i>
                            </a>
                            <a class="item">1</a>
                            <a class="icon item">
                                <i class="right chevron icon"></i>
                            </a>
                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>

            <br>

            <div class="action">
                <div class="ui big right floated submit button green"
                     id="">
                    Aceptar
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.ui.dropdown').dropdown();
    </script>