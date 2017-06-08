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

            <div class="ui form" id="formulario_enviar_correo">
                <h3 class="ui centered dividing header">Enviar Correo.</h3>

                <br>

                <div class="field">
                    <div class="one fields">
                        <div class="eleven wide field">
                            <label>Destinatario</label>
                            {{ Form::select_destinatarios(array('name'=>'destinatarios', 'id'=>'destinatarios','ng-model'=>'DatosForm.destinatarios'),null, 'Destinatarios')}}
                        </div>
                    </div>

                    <br>

                    <div class="two field">
                        <div class="ten wide field">
                            <label>Asunto</label>
                            <input type="text" name="asunto" placeholder="Asunto" ng-model="DatosForm.asunto">
                        </div>
                    </div>

                    <br>

                    <div class="two fields">
                        <div class="field">
                            <input type="file" name="archivo" ng-model-file="DatosForm.archivo">

                            <p style="padding-top: 5px;">Si quiere enviar mas de un archivo debe crear un archivo
                                comprimido .zip o .rar</p>
                        </div>
                    </div>

                    <br>

                    <div class="two fields">
                        <div class="eleven wide field">
                            <label>Descripcion</label>
                            <textarea name="descripcion" placeholder="Descripcion" ng-model="DatosForm.descripcion" rows="4"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <br>

            <button class="ui right floated big teal button" id="btn-registrar" ng-click="enviar_correo()">Enviar
            </button>
        </div>
    </div>
</div>

<script>
    $('.ui.dropdown').dropdown({
        maxSelections: 10
    });
</script>
