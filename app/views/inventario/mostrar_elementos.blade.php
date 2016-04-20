<!--Bloque 1 -> Tabla Principal-->
<div class="ui two column doubling stackable grid container">
    <div class="ui container centered grid">
        <div class="column">
            <table class="ui selectable celled table capitalize" datatable="" dt-options="opciones_tabla_elementos"
                   dt-columns="columnas_tabla_elementos" dt-instance='tabla_elementos' width="100%"></table>
        </div>
    </div>
</div>

<!-- Bloque 1. para listar elementos -->
<div class="ui fullscreen modal" id="modal_listar_elementos">
    <i class="close icon"></i>
    <div class="header ui centered">
        Elementos
    </div>
    <div class="content">

        <table class="ui celled striped table" width="100%">
            <thead>
            <tr>
                <th width="18%">Codigo del elemento</th>
                <th width="">Nombre del objeto</th>
                <th width="10%">Disponibilidad</th>
                <th width="15%">Unidad</th>
                <th width="6%" class="center aligned">Acciones</th>
            </tr>
            </thead>

            <tbody>
            <tr dir-paginate="elemento in lista_elementos | itemsPerPage: ElementosPerPage" total-items="totalElementos"
                current-page="pagination.current">
                <td><% elemento.cod_dimension +' '+ elemento.cod_subdimension+' '+ elemento.cod_agrupacion +' '+ elemento.cod_subagrupacion +' '+ elemento.numero_orden %></td>
                <td><% elemento.nombre_objeto %></td>
                <td><% elemento.cantidad_disponible %></td>
                <td><% elemento.nombre_unidad +"("+ elemento.abreviatura +")" %></td>
                <td>
                    <button class="ui blue small button"
                            ng-click="modal_ver_elemento(elemento.cod_dimension, elemento.cod_subdimension,elemento.cod_agrupacion,elemento.cod_objeto,elemento.numero_orden)"><i class="unhide icon"></i>

                    </button>
                </td>
            </tr>
            </tbody>


        </table>

    </div>
    <div class="actions">
        <div class="ui negative button">
            Cerrar
        </div>
    </div>
</div>
<!--- Fin Bloque -->

<!--Bloque 2. Mostrar elemento-->
<div class="ui modal" id="modal_ver_elemento">
    <div class="header">Datos del Elemento</div>
    <div class="content">
        <table class="ui celled table capitalize">
            <tbody>
            <tr>
                <td colspan="2">
                    <b>Nombre Del Elemento:</b><br>
                    <p><% data_elemento.nombre_objeto | uppercase %></p>
                </td>
                <td>
                    <b>Almacen:</b><br>
                    <p>[<% data_elemento.cod_dimension %>] - <% data_elemento.nombre_dimension | uppercase %></p>
                </td>
            </tr>

            <tr>
                <td>
                    <b>Sub Dimension: </b><br>
                    <p>[<% data_elemento.cod_subdimension %>] - <% data_elemento.nombre_subdimension | uppercase %></p>
                </td>

                <td>
                    <b>Agrupacion: </b><br>
                    <p>[<% data_elemento.cod_agrupacion %>] - <% data_elemento.nombre_agrupacion | uppercase %></p>
                </td>

                <td>
                    <b>Sub Agrupacion:</b><br>
                    <div ng-if="data_elemento.cod_subagrupacion">
                        <p>[<% data_elemento.cod_subagrupacion %>] - <% data_elemento.nombre_subagrupacion | uppercase
                            %></p>
                    </div>

                    <div ng-if="!data_elemento.cod_subagrupacion">
                        <p>No especificado</p>
                    </div>
                </td>

            </tr>

            <tr>
                <td>
                    <b>Nro Organizacion:</b><br>
                    <p><% data_elemento.numero_orden %></p>
                </td>
                <td>
                    <b>Elemento Movible:</b><br>
                    <p><% data_elemento.elemento_movible | bool_humano %></p>
                </td>
                <td>
                    <b>Cantidad Disponible:</b><br>

                    <p><% data_elemento.cantidad_disponible %></p>
                </td>
            </tr>

            <tr ng-if="data_elemento.usa_recipientes">
                <td>
                    <b>Usa Recipientes: </b><br>

                    <p><% data_elemento.usa_recipientes | bool_humano%></p>
                </td>
                <td colspan="2">
                    <b>Recipientes Disponibles:</b><br>

                    <p><% data_elemento.recipientes_disponibles %></p>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <b>Creado:</b><br>
                    <p><% data_elemento.created_at | formato_timestamps %></p>
                </td>
                <td colspan="4">
                    <b>Actualizado:</b><br>
                    <p><% data_elemento.updated_at | formato_timestamps %></p>
                </td>
            </tr>

            </tbody>
        </table>
    </div>
    <div class="actions">
        <div class="ui negative button"
             ng-click="cerrar_modal_ver_elemento(data_elemento.cod_dimension, data_elemento.cod_subdimension, data_elemento.cod_agrupacion, data_elemento.cod_objeto)">
            Cerrar
        </div>
    </div>
</div>

<!--Bloque 3 -> Modal Modificar elemento-->

<div class="ui modal" id='modal_modificar_elemento'>
    <div class="header">Actualizar datos del elemento</div>
    <div class="content">
        <div class="ui form">
            <form class="ui form" id="formulario_registrar_elemento">
                <h3 class="ui centered dividing header">Modificar Datos</h3>
                <br>
                <div class="field">
                    <div class="two fields">
                        <div class="field">
                            <label>Almacen</label>
                            {{  Form::select_dimension(array('name'=>'cod_dimension','id'=>'cod_dimension', 'ng-model'=>'DatosForm.cod_dimension')) }}
                        </div>

                        <div class="field">
                            <label>Sub Dimension</label>
                            {{  Form::select_sub_dimension(array('name'=>'cod_sub_dimension','id'=>'cod_sub_dimension', 'ng-model'=>'DatosForm.cod_sub_dimension')) }}
                        </div>
                    </div>
                </div>

                <div class="field">
                    <div class="three fields">
                        <div class="field">
                            <label>Agrupacion</label>
                            {{ Form::select_agrupacion(array('name'=>'cod_agrupacion', 'id'=>'cod_agrupacion', 'ng-model'=>'DatosForm.cod_agrupacion')) }}
                        </div>

                        <div class="field">
                            <label>Sub Agrupacion</label>
                            {{ Form::select_sub_agrupacion(array('name'=>'cod_sub_agrupacion', 'id'=>'cod_sub_agrupacion', 'ng-model'=>'DatosForm.cod_sub_agrupacion')) }}
                        </div>

                        <div class="field">
                            <label>Objeto</label>
                            <div class="ui search selection dropdown capitalize buscar_objeto">
                                <input type="hidden" ng-model="DatosForm.cod_objeto" name="cod_objeto" ng-update-hidden>
                                <i class="dropdown icon"></i>
                                <input tabindex="0" class="search" type="text">
                                <div class="text"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <br>

                <div class="field">
                    <div class="three fields">
                        <div class="field">
                            <label>Numero de Organizacion</label>
                            <input type="number" name="numero_orden" placeholder="0" min="1"
                                   ng-model="DatosForm.numero_orden">
                        </div>

                        <div class="field">
                            <label>Cantidad Disponible</label>
                            <input type="number" name="cantidad_disponible" placeholder="0" min="1"
                                   ng-model="DatosForm.cantidad_disponible">
                        </div>

                        <div class="field" ng-show="DatosForm.usa_recipientes">
                            <label>Recipientes Disponibles</label>
                            <input type="number" name="recipientes_disponibles" placeholder="0" min="1"
                                   ng-model="DatosForm.recipientes_disponibles">

                        </div>
                    </div>

                    <br>

                    <div class="field">
                        <div class="two fields">
                            <div class="field">
                                <div class="ui toggle checkbox">
                                    <input name="usa_recipientes" type="checkbox" ng-model="DatosForm.usa_recipientes"
                                           ng-init="DatosForm.usa_recipientes = false">
                                    <label>Usar Recipiente</label>
                                </div>
                            </div>

                            <div class="field">
                                <div class="ui toggle checkbox">
                                    <input name="elemento_movible" type="checkbox" ng-model="DatosForm.elemento_movible"
                                           ng-init="DatosForm.elemento_movible = true">
                                    <label>Elemento Movible</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="actions">
        <div class="ui negative button">
            Cerrar
        </div>
        <button class="ui positive button">
            Actualizar
        </button>
        <div class="ui chackmark icon"></div>
    </div>
</div>
<!--Fin De Bloques-->
