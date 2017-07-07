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

            <form class="ui form" id="formulario_crear_tipo_usuario">
                <h3 class="ui centered dividing header">Generar Consulta</h3>

                <div class="field">
                    <div class="six wide field">
                        <div class="field">
                            <label>Nombre</label>
                            <input type="text" name="nombre" placeholder="Nombre consulta" ng-model="DatosForm.nombre">
                        </div>
                    </div>
                </div>

                <div class="field">
                    <div class="nine wide field ui form">
                        <div class="field">
                            <label>Consulta</label>
                            <textarea name="descripcion" placeholder="Aca va la consulta en SQL"
                                      ng-model="DatosForm.descripcion" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <div class="ui big right floated submit button green" ng-click="generar_consulta()"
                     id="btn-registrar"> Procesar
                </div>
            </form>
        </div>
    </div>
</div>