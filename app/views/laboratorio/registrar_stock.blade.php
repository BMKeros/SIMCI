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

			<h3 class="ui centered dividing header">Agregar Objetos al Stock</h3>

			<br>

			<div class="field">
				<div class="two fields">
					<div class="seven wide field">
						<label>Seleccina un laboratorio</label>
						<select></select>
					</div>
				</div>

				<div class="field">
					<div class="two fields">
						<div class="seven wide field">
							<label>Selecciona un objeto</label>
							<select></select>
						</div>

						<div class="field">
						    <label>Agregar</label>
						        <button class="ui inverted green button"> <i class="plus icon"> </i></button>
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
            <tr>
               <td class="collapsing">
                    NFG32G
                </td>
                <td>Encubadora</td>
                <td>Laboratorio de agua</td>
            </tr>
            </tbody>
        </table>

        <br>

        <div class="action">
        	<div class="ui right floated positive button" ng-click="">
                Agregar
            </div>
        </div>
    </div>
</div>