<div class="ui centered grid">
    <div class="six wide tablet twelve wide computer column">
        <div class="ui form">
            <div class="ui form" id="reglas_formulas_enviar_correo">
                <h3 class="ui centered dividing header">Enviar Correo.</h3>

                <br>

                <div class="field">
                    <div class="two fields">
                        <div class="six wide field">
                            <label>Destinatario.</label>
                            {{ Form::select_personas(array('name'=>'responsable', 'id'=>'responsable','ng-model'=>'DatosForm.responsable'),null, 'Destinatario')}}
                        </div>
                    </div>

                    <br>

                    <div class="two fields">
                        <div class="five wide field">
                            <label>Asunto</label>
                            <input type="text" name="asunto" placeholder="Asunto" ng-model="DatosForm.asunto" >
                        </div>
                        <div class="one wide field" id="btn_adjuntar">
                            <input type="file" name="archivo">
                        </div>
                    </div>

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

            <button class="ui right floated big teal button">Enviar</button>
        </div>
    </div>
</div>

<script>
    $('.ui.dropdown').dropdown();
</script>
