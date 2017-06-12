<!--Bloque 1 -> Tabla Principal-->
<div class="ui two column doubling stackable grid container">
   <div class="ui container centered grid">
      <div class="column">
         <table class="ui selectable celled table capitalize" datatable="" dt-options="opciones_tabla_stock" dt-columns="columnas_tabla_stock" dt-instance='tabla_stock' width="100%"></table>
      </div>
   </div>
</div>


<!--Bloque 2. Mostrar elemento-->
<div class="ui modal" id="modal_ver_elemento_stock">
    <div class="header">Datos del Elemento</div>
    <div class="content">
        <table class="ui celled table capitalize">
            <tbody>
            <tr>
                <td colspan="1">
                    <b>Nombre Del Elemento:</b><br>
                    <p><% data_elemento_stock.nombre_objeto | uppercase %></p>
                </td>
                <td>
                    <b>Almacen:</b><br>
                    <p>[<% data_elemento_stock.cod_dimension %>] - <% data_elemento_stock.descripcion_dimension | uppercase %></p>
                </td>
                <td colspan="1">
                    <b>Numero de Orden</b><br>
                    <p><% data_elemento_stock.numero_orden %></p>
                </td>
            </tr>

            <tr>
                <td>
                    <b>Sub Dimension: </b><br>
                    <p>[<% data_elemento_stock.cod_subdimension %>] - <% data_elemento_stock.descripcion_subdimension | uppercase %></p>
                </td>

                <td>
                    <b>Agrupacion: </b><br>
                    <p>[<% data_elemento_stock.cod_agrupacion %>] - <% data_elemento_stock.nombre_agrupacion | uppercase %></p>
                </td>

                <td >
                    <b>Sub Agrupacion:</b><br>
                    <div ng-if="data_elemento_stock.cod_subagrupacion">
                        <p>[<% data_elemento_stock.cod_subagrupacion %>] - <% data_elemento_stock.nombre_subagrupacion | uppercase %></p>
                    </div>

                    <div ng-if="!data_elemento_stock.cod_subagrupacion">
                        <p>No especificado</p>
                    </div>
                </td>

            </tr>

            <tr>
                <td colspan="2">
                    <b>Laboratorio:</b><br>                
                    <p>[<% data_elemento_stock.cod_laboratorio %>] - <% data_elemento_stock.nombre_laboratorio | uppercase %></p>
                </td>
                <td>
                    <b>Cantidad:</b><br>
                    <p><% data_elemento_stock.cantidad %></p>
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