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


<div class="ui long modal" id="modal_completar_orden">
    <i class="close icon"></i>

    <div class="header ui centered">
        Completar la orden
    </div>
    <div class="content">
    </div>
    <div class="actions">
        <div class="ui negative button">
            Cerrar
        </div>
    </div>
</div>
<!--- Fin Bloque -->
