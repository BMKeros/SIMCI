<!--Bloque 1 -> Tabla Principal-->
<div class="ui two column doubling stackable grid container">
   <div class="ui container centered grid">
      <div class="column">
         <table class="ui selectable celled table capitalize" datatable="" dt-options="opciones_tabla_laboratorios" dt-columns="columnas_tabla_laboratorios" dt-instance='tabla_laboratorios' width="100%"></table>
      </div>
   </div>
</div>

<!--Bloque 2. Mostrar Laboratorio-->
<div class="ui modal" id="modal_ver_laboratorio">
    <div class="header">Datos del Laboratorio</div>
        <div class="content">
            <table class="ui celled table capitalize">
                <tbody>
                    <tr>
                        <td>
                            <b>Nombre del Laboratorio: </b> <%data_laboratorio.nombre%>
                        </td>
                    </tr>
					
                    <tr>
                        <td colspan="2"><b>Descripcion: </b> <%data_laboratorio.descripcion%>
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
 
<!--Bloque 3 -> Modal Modificar Laboratorio-->

<div class="ui modal" id='modal_modificar_laboratorio'>
<div class="header">Actualizar datos del laboratorio</div>
  <div class="content">
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
    <div class="ui form">
      <form class="ui form" id="formulario_crear_laboratorio">
  			
  			<div class="field">
  				<div class=" two fields">
  					<div class="field">
  						<label>Nombre del Laboratorio</label>
  	        		<input type="text" name="nombre" placeholder="Nombre del Laboratorio" ng-model="DatosForm.nombre">
  		        	</div>
  			    </div>
  				</div>
  			  <br>
          <div class="field">
  		      <div class="nine wide field ui form">
  					  <div class="field">
  				     	<label>Descripcion de Laboratorio</label>
  					  	<textarea name="descripcion" placeholder="Descripcion de Laboratorio" ng-model="DatosForm.descripcion" rows="4"></textarea>
  					  </div>
  					</div>
  		    </div>    
        </form>
      </div>
   </div>
   <div class="actions">
      <div class="ui negative button">
        Cerrar
      </div>
      <div class="ui positive button" ng-click="procesar_modificar()" id="btn-modificar">
        Actualizar
      </div>
      <div class="ui chackmark icon"></div>
   </div>
</div>
