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

			<h3 class="ui centered dividing header">Agregar stock a laboratorio</h3>
			
			<form id="formulario_registrar_stock">
			
				<div class="field">
					<div class="three fields">
						<div class="seven wide field">
							<div class="field">
								<label>Seleccione un elemento</label>

								<div class="ui fluid category search">
  									<div class="ui left icon input">
    									<input class="prompt" placeholder="Buscar elementos" type="text" id="campo_search_objeto">

    									<input type="hidden" ng-model="select_objeto" id="select_objeto" name="select_objeto" ng-update-hidden>
    								<i class="search icon"></i>
  									</div>
								</div>
							</div>
						</div>

					    <div class="four wide field">
						    <label>Cantidad</label>
						    <input type="number" name="cantidad" placeholder="Cantidad" ng-model="cantidad">
					    </div>
					</div>
				</div>

				<br>
			
				<div class="field">
					<div class="two fields">
						<div class="seven wide field">
							<label>Seleccione un laboratorio</label>
							{{ Form::select_laboratorios(array('name'=>'select_laboratorio', 'id'=>'laboratorio','ng-model'=>'select_laboratorio'))}}
						</div>
						<div class="field">
							<button class="ui icon large inverted green button" id="btn_agregar_items" ng-click="agregar_stock_tabla()"><i class="plus icon" ></i></button>
						</div>
					</div>
				</div>
			</form>
	    </div>
	
        <br>

        <br>

        <table class="ui celled striped table" width="100%">
            <thead>
                <tr>
                    <th width="40%">Nombre</th>
                    <th width="20%">Cantidad</th>
                    <th width="35%">Laboratorio</th>
					<th width="5%" align="center">Accion</th>
                </tr>
            </thead>
            <tbody>
            	<tr ng-repeat="elemento in items_tabla_stock track by $index" id="<% elemento.id_item_stock %>" ng-animate="'animate'" class="animate-repeat">
    				<td><% elemento.nombre_objeto | lowercase | capitalize%></td>
    				<td><% elemento.cantidad %></td>
    				<td><% elemento.nombre_laboratorio | lowercase | capitalize %></td>
    				<td>
						<button class="ui icon small button" ng-click="eliminar_stock_tabla(elemento.id_item_stock )">
  							<i class="trash outline icon"></i>
						</button>
					</td>
            	</tr>

            	<tr ng-if="items_tabla_stock.length == 0">
            		<td colspan="4">
            			<p align="center">No hay elementos para ser agregados</p>
            		</td>
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

<script>
	$('.ui.dropdown').dropdown();

	$('.ui.search').search({
		type          : 'category',
		minCharacters : 3,
		searchDelay: 300,
		onSelect: function(elem_select, response){
			//Guardamos el objeto seleccionado en el input hidden
			$('#select_objeto').val(elem_select.value).trigger('change');
			//Vaciamos el campo de busqueda
			$('#campo_search_objeto').val('');
		},
		apiSettings   : {
		  onResponse: function(_Response) {
		    var response = {
		        results : {}
		      };

		    $.each(_Response.results, function(index, item) {
		      var
		        clase_objeto   = item.nombre_clase_objeto || 'Desconocida',
		        maxResults = 8
		      ;
		      if(index >= maxResults) {
		        return false;
		      }

		      if(response.results[clase_objeto] === undefined) {
		        response.results[clase_objeto] = {
		          name    : clase_objeto,
		          results : []
		        };
		      }
		      
		      response.results[clase_objeto].results.push({
		        title       : item.nombre_objeto.toLowerCase(),
		        description : item.especificaciones_objeto,
		        value: item.cod_objeto
		      });
		    });
		    return response;
		  },
		  url: '/api/inventario/mostrar?type=search&query={query}'
		}
	});

	

</script>