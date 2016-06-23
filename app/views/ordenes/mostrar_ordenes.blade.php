<!--Bloque 1 -> Tabla Principal-->
<div class="ui two column doubling stackable grid container">
   <div class="ui container centered grid">
      <div class="column">
         <table class="ui selectable celled table capitalize" datatable="" dt-options="opciones_tabla_ordenes" dt-columns="columnas_tabla_ordenes" dt-instance='tabla_ordenes' width="100%"></table>
      </div>
   </div>
</div>




<div class="ui long fullscreen basic modal" id="modal_mostrar_orden">
    <i class="close icon"></i>
    <div class="header ui centered">
        Detalles de la orden
    </div>
    <div class="content" id="contenedor_modal_orden">
    </div>
    <div class="actions">
        <div class="ui negative button">
            Cerrar
        </div>
    </div>
</div>
<!--- Fin Bloque -->


<div class="ui long modal" id="modal_preaceptar_orden">
    <i class="close icon"></i>

    <div class="header ui centered">
        Lista de pedidos que sera procesada
    </div>

    <div class="content">
        <table class="ui celled table">
            <thead>
                <tr>
                    <th>Dimension</th>
                    <th>Subdimension</th>
                    <th>Agrupacion</th>
                    <th>Objeto</th>
                    <th>Numero Orden</th>
                    <th>Cantidad Solicitada</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="pedido in datos_pedidos_aceptar">
                    <td><% pedido.cod_dimension %></td>
                    <td><% pedido.cod_subdimension %></td>
                    <td><% pedido.cod_agrupacion %></td>
                    <td><% pedido.cod_objeto %></td>
                    <td><% pedido.numero_orden %></td>
                    <td><% pedido.cantidad_solicitada | quitar_ceros_decimales %></td>
                    <td ng-if="pedido.disponible" class="positive"><i class="icon checkmark"></i> DISPONIBLE</td>
                    <td ng-if="!pedido.disponible" class="negative"><i class="icon close"></i> NO DISPONIBLE</td>
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
