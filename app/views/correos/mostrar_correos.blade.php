<!--Bloque 1 -> Tabla Principal-->
<div class="ui two column doubling stackable grid container">
    <div class="ui container centered grid">
        <div class="column">
            <table class="ui selectable celled table capitalize" datatable="" dt-options="opciones_tabla_correos"
                   dt-columns="columnas_tabla_correos" dt-instance='tabla_correos' width="100%"></table>
        </div>
    </div>
</div>

<div class="ui modal" id="modal_ver_correo">
    <div class="header">Datos de correo</div>
    <div class="content">
        <table class="ui celled table capitalize">
            <tbody  >
            <tr>
                <td colspan="5"><b>Nombre del Emisor: </b><br> <% data_correo.emisor %></td>

            </tr>
            <tr>
                <td colspan="2"><b>Enviado:</b><br>
                    <p><% data_correo.created_at %></p>
                </td>
                <td colspan="4"><b>Tipo de asunto:</b><br>
                    <p><% data_correo.asunto | uppercase %></p>
                </td>
            </tr>
            <tr>
                <td colspan="5"><b>Descripcion:</b><br>
                    <p><% data_correo.descripcion | uppercase %></p>
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

