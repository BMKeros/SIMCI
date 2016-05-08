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


            </form>
        </div>

    </div>
</div>