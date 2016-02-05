<!--Bloque 2. Mostrar Laboratorio-->
<div class="ui modal" id="modal_ver_laboratorio">
    <div class="header">Datos del Almacen</div>
        <div class="content">
            <table class="ui celled table capitalize">
                <tbody>
                    <tr>
                        <td>
                            <b>Nombre del Laboratorio:</b> Newlaboratorio.
                        </td>
                    </tr>
					
                    <tr>
                        <td colspan="2"><b>Descripcion</b>
							<p>Describir El laboratorio</p>
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



<!--Bloque 4 -> Eliminar Laboratorio-->
<div class="ui basic modal eliminado">
   <i class="close icon"></i>
   <div class="header">
      Eliminar Laboratorio!
   </div>
   <div class="image content">
      <div class="image">
        <i class="archive icon"></i>
      </div>
      <div class="description">
        <p>Esta seguro que desea eliminar este Laboratorio?</p>
      </div>
   </div>
   <div class="actions">
      <div class="two fluid ui inverted buttons">
         <div class="ui red basic inverted button">
            <i class="remove icon"></i>
            No
         </div>
         <div class="ui green basic inverted button">
            <i class="checkmark icon"></i>
            Yes
         </div>
      </div>
   </div>
</div>
<!--Fin De Bloques-->

