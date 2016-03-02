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
    <div class="header">Datos del Almacen</div>
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
<div class="header">Actualizar datos del Laboratorio</div>
   <div class="content">
      <div class="ui form">
            <form class="ui form" id="formulario_crear_laboratorio">
				<h3 class="ui centered dividing header">Registrar Laboratorio</h3>
				<br>
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
      <button class="ui positive button">
        Actualizar
      </button>
      <div class="ui chackmark icon"></div>
   </div>
</div>
