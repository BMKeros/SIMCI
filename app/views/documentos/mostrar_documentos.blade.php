<!--Bloque 1 -> Tabla Principal-->
<div class="ui two column doubling stackable grid container">
    <div class="ui container centered grid">
        <div class="column">
            <table class="ui selectable celled table capitalize" datatable="" dt-options="opciones_tabla_documentos"
                   dt-columns="columnas_tabla_documentos" dt-instance='tabla_documentos' width="100%"></table>
        </div>
    </div>
</div>

<div class="ui modal" id="modal_ver_correo">
    <div class="header">Datos del Objeto</div>
    <div class="content">
        <table class="ui celled table capitalize">
            <tbody>
            <tr>
                <td colspan="5"><b>Nombre del Objeto: </b><br> <% data_correo.nombre %></td>

            </tr>
            <tr>
                <td><b>Clase de Objeto: </b><br> <% data_correo.nombre_clase %>
                </td>
                <td colspan="2"><b>Unidad:</b><br><%data_correo.nombre_unidad %> (<%data_correo.abreviatura_unidad %>
                    )
                </td>
                <td colspan="3"><b>Especificaciones:</b><br>
                    <p><% data_correo.especificaciones | uppercase %></p>
                </td>
            </tr>
            <tr>
                <td colspan="5"><b>Descripcion:</b><br>
                    <p><% data_correo.descripcion | uppercase %></p>
                </td>
            </tr>
            <tr>
                <td colspan="2"><b>Creado:</b><br>
                    <p><% data_correo.created_at | formato_timestamps %></p>
                </td>
                <td colspan="2"><b>Actualizado:</b><br>
                    <p><% data_correo.updated_at | formato_timestamps %></p>
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

<script>
    $('.ui.dropdown').dropdown();
</script>

