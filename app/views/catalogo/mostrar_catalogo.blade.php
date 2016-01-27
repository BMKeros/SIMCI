<!--Bloque 1 -> Tabla Principal-->
<div class="ui two column doubling stackable grid container">
   <div class="ui container centered grid">
      <div class="column">
         <table class="ui selectable celled table capitalize" datatable="" dt-options="opciones_tabla_objetos" dt-columns="columnas_tabla_objetos" dt-instance="tabla_objetos" width="100%"></table>
      </div>
   </div>
</div>
  

<div class="ui modal" id="modal_ver_objeto">
   <div class="header">Datos del Objeto</div>
      <div class="content">
         <table class="ui celled table capitalize">
            <tbody>
               <tr>
                  <td colspan="3"><b>Nombre del Objeto: </b> <% data_objeto.nombre %></td>
                  <td colspan="1">
                  	<b>Tipo de Objeto: </b> <% data_objeto.data_tipo_objeto.nombre %>
                  </td>
               </tr>
               <tr>
                  <td colspan="4"><b>Descripcion:</b><br>
                      <p><% data_objeto.descripcion | uppercase %></p>
                  </td>
               </tr>

               <tr>
                  <td colspan="4"><b>Especificacion:</b><br>
                 	<p><% data_objeto.especificaciones | uppercase %></p>
                  </td>
               </tr>  
            </tbody>  
        </table>
      </div>
      <div class="actions">
         <div class="ui negative button">
              Atras
         </div>
      </div>
   </div>
 
<!--Bloque 3 -> Modal Modificar -->

<div class="ui modal" id='modal_modificar_objeto'>
<div class="ui centered dividing header">Actualizar datos del Objeto</div>
   <div class="content">
      <div class="ui form">
        <form class="ui form" id="formulario_actualizar_objeto">
          <br>
            <div class="field centered grid">
               <div class="three fields">
                  <div class="field">
                     <label>Nombre del Producto</label>
                     <input type="text" name="nombre" placeholder="Nombre" ng-model="DatosForm.nombre">
                  </div>
                </div>
            </div>

            <div class="field">
               <div class="two fields">
                     
                     <div class="field">
                        <label>Especificacion del Producto</label>
                        <textarea ng-model="DatosForm.especificaciones"></textarea>
                     </div>
                     
                     <div class="field">
                         <label>Descripcion del Producto</label>
                         <textarea ng-model="DatosForm.descripcion"></textarea>
                     </div>
                  
                </div>
            </div>

            <br>

            <div class="field">
                <div class="two fields">
                     <div class="field">
                        <label>Unidad</label>
                        {{ Form::select_unidades (array('name'=>'cod_unidad', 'id'=>'unidad','ng-model'=>'DatosForm.cod_unidad'))}}
                  </div>

                  <div class="field">
                     <label>Tipo de Objeto</label>
                     {{ Form::select_agrupacion(array('name'=>'cod_tipo_objeto', 'id'=>'tipo_objeto','ng-model'=>'DatosForm.cod_tipo_objeto')) }}
                  </div>
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



<!--Bloque 4 -> Eliminar -->
<div class="ui basic modal" id="modal_eliminar_objeto">
   <i class="close icon"></i>
   <div class="header">
      Eliminar Objeto!
   </div>
   <div class="image content">
      <div class="image">
        <i class="trash outline icon"></i>
      </div>
      <div class="description">
        <p>Esta seguro que desea eliminar este Objeto?</p>
      </div>
   </div>
   <div class="actions">
      <div class="two fluid ui inverted buttons">
         <div class="ui red basic inverted button" ng-click="cerrar_modal_eliminar()">
            <i class="remove icon"></i>
            No
         </div>
         <div class="ui green basic inverted button" ng-click="procesar_eliminar()">
            <i class="checkmark icon"></i>
            Yes
         </div>
      </div>
   </div>
</div>
<!--Fin De Bloques-->

<script>

</script>
