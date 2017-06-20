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
                                <label>Escribe el codigo de orden</label>

                                <div class="ui fluid category search">
                                    <div class="ui left icon input">
                                        <input class="prompt" placeholder="Buscar Numero de Orden"
                                               type="text"
                                               ng-model="codigo_orden_search">
                                        <i class="search icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <button class="ui icon large inverted green button" id="btn_agregar_items"
                                    ng-click="buscar_orden(codigo_orden_search)"><i class="qrcode icon"></i></button>
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
                <tr ng-if="items_busqueda.length != 0" ng-repeat="elemento in items_busqueda track by $index"
                    id="<% elemento.id_item_stock %>"
                    ng-animate="'animate'" class="animate-repeat">
                    <td><% elemento.codigo | uppercase | capitalize%></td>
                    <td><% elemento.nombre_completo_responsable %></td>
                    <td><% elemento.nombre_completo_solicitante | lowercase | capitalize %></td>
                    <td><% elemento.fecha_solicitud | formato_fecha%></td>
                    <td><% elemento.nombre_status | uppercase %></td>
                    <td>
                        <div class="ui small basic icon buttons">
                            <button class="ui button" data-content="Ver Orden"><i class="eye icon"></i></button>
                            <button class="ui button" data-content="Aceptar Orden"><i class="check icon"></i></button>
                            <button class="ui button" data-content="Cancelar Orden"><i class="remove icon"></i></button>
                        </div>
                    </td>
                </tr>

                <tr ng-if="items_busqueda.length == 0">
                    <td colspan="5">
                        <p align="center">No hay elementos para mostrar</p>
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

        </div>
    </div>
</div>