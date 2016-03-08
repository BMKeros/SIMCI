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

			<h3 class="ui centered dividing header">Agregar stock al laboratorio</h3>

			<br>

			<div class="field">
				<div class="two fields">
					<div class="seven wide field">
						<label>Seleccina un laboratorio</label>
						<select ng-model="select_laboratorio">
							<option value="LDA">Laboratorio de Agua</option>
							<option value="LDR">Laboratorio de Reactivos</option>
							<option value="LDS">Laboratorio de Sales</option>
							<option value="LDSS">Laboratorio de Sodio</option>
							<option value="LDG">Laboratorio de Gases</option>
						</select>
					</div>
				</div>

				<div class="field">
					<div class="two fields">
						<div class="seven wide field">
							<label>Selecciona un objeto</label>
							<select ng-model="select_objeto">
								<option value="ENCDR">Encubadora</option>
								<option value="PPT">Pipeta</option>
								<option value="CDE">Campana de Estraccion</option>
								<option value="PNZ">Pinzas</option>
								<option value="TDE">Tubo de ensayo</option>
							</select>
						</div>

						<div class="field">
						    <button class="ui icon large inverted green button" id="btn_agregar_items" ng-click="agregar_stock_laboratorio()"><i class="plus icon" ></i></button>

					    </div>
					</div>
				</div>
			</div>
        </div>

        <br>

        <br>

        <table class="ui celled striped table">
            <thead>
                <tr>
                    <th>
                        Codigo
                    </th>

                    <th>
                    	Nombre
                    </th>
                       
                    <th>
                    	Laboratorio
                    </th>
                </tr>
            </thead>
            <tbody>

            <tr ng-repeat="x in tabla_stock track by $index">
    		<td></td>
    		<td><%x.cod_objeto%></td>
    		<td><%x.cod_lab%></td>
            </tr>
            </tbody>
        </table>

        <br>

        <div class="action">
        	<div class="ui right floated positive button">
                Agregar
            </div>
        </div>
    </div>
</div>