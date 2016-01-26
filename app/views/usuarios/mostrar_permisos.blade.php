<!--Bloque 1. Tabla Para Mostrar Permisos-->
<div class="ui two column doubling stackable grid container">
    <div class="ui container centered grid">
        <div class="column">
            <table class="ui selectable celled table">
	            <thead>
	               <tr>
	                  <th></th>
	                  <th>Nombre</th>
	                  <th>Permiso</th> 
	                  <th>Acciones</th> 
	               </tr>
	            </thead>
         
	            <tbody>
	                <tr ng-repeat='x in [1]'>
	                  	<td></td>
	                  	<td>Nuevo Usuario</td> 
	                  	<td>ROOT</td> 
	                  	<td class="three wide" >
			                <div class="ui icon button blue activar-popup ver"  data-content="Ver Permiso">
			                    <i class="unhide icon"></i>
			                </div>    
			                  
			                <div class="ui icon button green activar-popup modificar"  data-content="Modificar Permiso">
			                    <i class="edit icon"></i>
			                </div>    
			                     
			                <div class="ui icon button red activar-popup remover"  data-content="Eliminar Permiso">
			                    <i class="remove icon"></i>
			                </div>
	                    </td>
	                </tr>
	            </tbody>
            </table>
        </div>
    </div>
</div>
<!--Fin del Bloque 1-->


<!--Bloque 2. Modal para Ver Permiso-->
<div class="ui modal" id="modal_ver_permiso">
   	<div class="header">Permisos</div>
    <div class="content">
        <table class="ui celled table">
            <tbody>
               	<tr>
                  	<td><b>Permiso del Usuario:</b> </td>
                  	<td><b>Codigo del Usuario:</b> </td>
               	</tr>

               	<tr>
                  	<td colspan="2"><b>Descripcion del Permiso:</b></td>
               	</tr>
            </tbody>
        </table>
    </div>
    <div class="actions">
        <div class="ui negative button">
          Atras
        </div>
        <div class="ui positive button">
          Aceptar
        </div>
        <div class="ui chackmark icon"></div>
    </div>
</div>
<!--Fin del Bloque 2-->

<!--Bloque 3. Modificar Permiso-->
<div class="ui modal" id="modal_modificar_permiso">
   	<div class="header">Permisos</div>
    <div class="content">
    	<div class="ui form">
			<form class="ui form" id="formulario_modificar_permisos_usuarios">
				<h3 class="ui centered dividing header">Modificar Permisos</h3>
				<div class="field centered grid">
					<div class="two fields">
						<div class="field">
							<label>Permisos del Usuario</label>
							<input type="text" name="permiso"placeholder="Nombre del Permiso">
			        		
			        	</div>
			        	<div class="field">
				      		<label>Codigo</label>	
				        	<input type="text" name="cod_permiso" placeholder="Codigo del Permiso">
				      	</div>
				    </div>

				    <div class="field">
				    	<label>Descripcion de Permiso</label>
				    	<textarea "ng-model Datos.Form.Descripcion" placeholder="Descripcion de Permiso"></textarea>
				    </div>
				</div>
			</form>
		</div>
	</div>
	<div class="actions">
      <div class="ui negative button">
         No
      </div>
      <div class="ui positive button">
         Si
      </div>
      <div class="ui chackmark icon"></div>
   </div>
</div>
<!--Fin del Bloque 3-->

<!--Bloque 4. ELiminar Permiso-->
<div class="ui basic modal" id="modal_eliminar_permiso">
   <i class="close icon"></i>
   <div class="header">
      Eliminar Permisos de este Usuario!
   </div>
   <div class="image content">
      <div class="image">
        <i class="archive icon"></i>
      </div>
      <div class="description">
        <p>Esta seguro que desea eliminar el permiso de este usuario?</p>
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
<!--Fin del Bloque 4-->

<script>
$('document').ready(function() {
	$('.ui.button')
  		.popup();
  	
  	$('.ver').on ('click', function(){
  		$('#modal_ver_permiso').modal('show')
  	})

  	$('.modificar').on ('click', function(){
  		$('#modal_modificar_permiso').modal('show')
  	})

  	$('.remove').on ('click', function(){
  		$('#modal_eliminar_permiso').modal('show')
  	})
  	
});
</script>
