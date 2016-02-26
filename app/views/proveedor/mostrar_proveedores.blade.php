<!--Bloque 1 -> Tabla Principal-->
<div class="ui two column doubling stackable grid container">
   <div class="ui container centered grid">
      <div class="column">
         <table class="ui selectable celled table capitalize" datatable="" dt-options="opciones_tabla_proveedores" dt-columns="columnas_tabla_proveedores" dt-instance='tabla_proveedores' width="100%"></table>
      </div>
   </div>
</div>

<!--Bloque 2. Mostrar elemento-->
<div class="ui modal" id="modal_ver_proveedores">
    <div class="header">Datos del proveedor</div>
        <div class="content">
            <table class="ui celled table capitalize">
                <tbody>
                    <tr>
                        <td>
                            <b>Responsable:</b>
                              <p>Nombre de Responsable</p>
                        </td>
                        
                    </tr>
					
                    <tr>
                        <td colspam="2">
                            <b>Primer auxiliar:</b>
                                <p>Nombre de auxiliar</p>
                        </td>

                        <td colspam="2">
                            <b>Segundo auxiliar:</b>
                                <p>Nombre de auxiliar.</p>
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
 
<!--Bloque 3 -> Modal Modificar proveedor-->

<div class="ui modal" id='modal_modificar_proveedores'>
<div class="header">Datos generales del proveedor</div>
   <div class="content">
      <div class="ui form">
         <form class="ui form" id="formulario_crear_proveedor">
            <h3 class="ui centered dividing header">Actualizar datos del proveedor</h3>
            <div class="field">
               <div class="two fields">
                  <div class="field">
                     <label>Razon social</label>
                     <input type="text" name="razon_social" placeholder="Razon Social" ng-model="DatosForm.razon_social">
                  </div>
                </div>
            </div>

            <div class="field">
                <div class="two fields">
                  <div class="nine wide field">
                     <label>Documento de Identificacion</label>   
                     <input type="text" name="doc_identificacion" placeholder="Documento de Identificacion" ng-model="DatosForm.doc_identificacion">
                    </div>

                     <div class="seven wide field">
                        <label>Email</label> 
                     <input type="email" name="email" placeholder="Direccion Electronica">
                     </div>
                </div>
            </div>

            <br>

            <div class="field">
                <div class="four fields">
                    <div class="field">
                     <label>Telefono movil 1</label>  
                     <input type="text" name="telefono_movil1" placeholder="Telefono Movil 1" ng-model="DatosForm.telefono_movil1">
                    </div>

                     <div class="field">
                     <label>Telefono movil 2</label>  
                     <input type="text" name="telefono_movil2" placeholder="Telefono Movil 2" ng-model="DatosForm.telefono_movil2">
                    </div>
                  <div class="field">
                     <label>Telefono fijo 1</label>   
                     <input type="text" name="telefono_fijo1" placeholder="Telefono Fijo 1" ng-model="DatosForm.telefono_fijo1">
                    </div>

                     <div class="field">
                     <label>Telefono fijo 2</label>   
                     <input type="text" name="telefono_fijo2" placeholder="Telefono Fijo 2" ng-model="DatosForm.telefono_fijo2">
                    </div>
                </div>
            </div>

            <br>
            
            <h3 class="ui centered dividing header">Datos de Ubicacion</h3>            
            
            <div class="field">
               <div class="fields">
                  <div class="fourteen wide field">
                     <label>Direccion</label>
                     <textarea name="descripcion" placeholder="Direccion del proveedor" ng-model="DatosForm.direccion" rows="2"></textarea>
                  </div>
               </div>
            </div>      
            
            <br>

            <div class="field">
                <div class="two fields">
                  <div class="field">
                     <label>Codigo del Estado</label>
                     <select></select>
                  </div>

                  <div class="field">
                     <label>Codido de la Ciudad</label>
                     <select></select>
                  </div>
               </div>   
            </div>

            <div class="field">
                <div class="two fields">
                  <div class="field">
                     <label>Codigo del Municipio</label>
                     <select></select>
                  </div>

                  <div class="field">
                     <label>Codido de la Parroquia</label>
                     <select></select>
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
<!--Fin De Bloques-->