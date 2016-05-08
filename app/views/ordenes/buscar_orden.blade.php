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

            <h3 class="ui centered dividing header">Buscar Orden</h3>

            <br>

            <form id="formulario_buscar_orden">

                <div class="ui form">
                    <div class="inline fields">
                        <label>Como desea buscar la orden?</label>

                        <div class="ui selection dropdown">
                            <input name="gender" type="hidden">
                            <i class="dropdown icon"></i>

                            <div class="default text">Seleccione una opcion</div>
                            <div class="menu">
                                <div class="item" data-value="1">Codigo normal</div>
                                <div class="item" data-value="0">Codigo QR</div>
                            </div>
                        </div>
                    </div>
                </div>

                <qr-scanner ng-success="onSuccess(data)" width="400" height="300"></qr-scanner>

            </form>
        </div>

    </div>
</div>

<script>
    $('.ui.dropdown').dropdown();
</script>