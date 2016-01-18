<!--Bloque 1 -> Tabla Principal-->
<div class="ui two column doubling stackable grid container">
   <div class="ui container centered grid">
      <div class="column">
         <table class="ui selectable celled table">
            <thead>
               <tr>
                  <th></th>
                  <th>Usuario</th>
                  <th>Direccion electronica</th>
                  <th>Permisos</th>
                  <th>Tipo Usuario</th>
                  <th>Acciones</th>
                 
               </tr>
            </thead>
         
            <tbody>
               <tr ng-repeat='x in [1]'>
                  <td></td>
                  <td>Daniel Bonalde</td>
                  <td>jhlilk22@yahoo.com</td>
                  <td> Tipo de Permiso</td>
                  <td>ROOT</td>
                  <td class="three wide" >
                  
                     <div class="ui icon button blueactivar-popup mostrar"  data-content="Ver Usuario">
                        <i class="unhide icon"></i>
                     </div>

                     <div class="ui icon button green activar-popup modificar"  data-content="Modificar Usuario">
                       <i class="edit icon"></i>
                     </div>    
                     
                     <div class="ui icon button red activar-popup eliminar"  data-content="Eliminar Usuario">
                       <i class="remove icon"></i>
                     </div>
                  </td>
               </tr>
            </tbody>
            <tfoot>
			    <tr>
				    <th colspan="6">
				      <div class="ui right floated pagination menu">
				        <a class="icon item">
				          <i class="left chevron icon"></i>
				        </a>
				        <a class="item">1</a>
				        <a class="item">2</a>
				        <a class="item">3</a>
				        <a class="item">4</a>
				        <a class="icon item">
				          <i class="right chevron icon"></i>
				        </a>
				      </div>
				    </th>
			  	</tr>
			</tfoot>
         </table>
      </div>
   </div>
</div>

<!--Bloque 2 -> Modale Ver Usuario-->
<div class="ui modal ver">
   <div class="header">Datos </div>
      <div class="content">
         <table class="ui celled table">
            <tbody>
               <tr>
                  <td colspan="2"><b>Primer Nombre:</b> Daniels.</td>
                  <td colspan="2"><b>Segundo Nombre:</b> Moises.</td>
                  <td colspan="2"><b>Primer Apellido:</b> Bonalde.</td>
                  <td colspan="2"><b>Segundo Apellido:</b> Prado.</td>
               </tr>

               <tr>
                  <td colspan="1"><b>Cedula:</b> 23.674.783</td>
                  <td colspan="2"><b>Sexo:</b> Masculino.</td>
                  <td colspan="1"><b>Tipo De Usuario:</b> Administrador.</td>
                  <td colspan="4"><b>Fecha de Nacimiento:</b> DD/MMM/AAAA</td>
               </tr>

               <tr>
                  <td colspan="4"><b>Usuario:</b> UserNuevoUser</td>
                  <td colspan="4"><b>Email:</b> DireccionElectronico@SIMCI.com</td>
               </tr>

               <tr>
                  <td colspan="3"><b>Tipo Usuario:</b>Administrador</td>
                  <td colspan="5"><b>Permisos</b> Activo</td>
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
<!--Bloque 3 -> Modal Modificar Usuario-->

<div class="ui modal modificar">
<div class="header">Actualizar</div>
   <div class="content">
      <div class="ui form">
        <form class="ui form" id="formulario_crear_usuario">

            <div class="field">
               <div class="two fields">
                 <div class="field">
                   <input type="text" name="usuario" placeholder="Usuario">
                 </div>

                  <div class="eight wide field">
                     <input type="text" name="email" placeholder="Direccion Email">
                  </div>
               </div>
            </div>

            <div class="field">
               <div class="two fields">
                  <div class="field">  
                     <input type="password" name="password" placeholder="Password">
                  </div>

                  <div class="two field">
                     <input type="password" name="password_confirmacion" placeholder="Confirmar Password">
                  </div>
               </div>
            </div>
         
            <div class="field">
               <div class="two fields">
                  <div class="field">
                     {{Form::select_permisos(array('name' => 'permisos', 'id' => 'permisos'))}}
                  </div>

                  <div class="eight wide field">
                     {{Form::select_tipo_usuario(array('id' => 'tipo_usuario', 'name' => 'tipo_usuario'))}}
                  </div>
               </div>
            </div>
         </form>
        
         <h4 class="ui dividing header">Datos Personales</h4>
         <form class="ui form">
            <div class="field">
               <div class="two fields">
                  <div class="field">
                     <input type="text" name="primer_nombre" placeholder="Primer Nombre">
                  </div>
                
                  <div class="two field">
                     <input type="text" name="segundo_nombre" placeholder="Segundo Nombre">
                  </div>
               </div>
            </div>

            <div class="field">
               <div class="two fields">
                  <div class="field">  
                     <input type="text" name="primer_apellido" placeholder="Primer Apellido">
                  </div>

                  <div class="two field">
                     <input type="text" name="segundo_apellido" placeholder="Segundo Apellido">
                  </div>
               </div>
            </div>

            <div class="field">
               <div class="two fields">
                  <div class="field">
                     <input type="text" name="cedula" placeholder="Cedula">
                  </div>

                  <div class="two field">
                     <input type="date" name="fecha_nacimiento" placeholder="Fecha Nacimieto">
                  </div>
               </div>
            </div>
          
            <div class="field">
               <div class="two fields">
                  <div class="field">
                     {{Form::select_sexo(array('id' => 'sexo', 'name' => 'sexo'))}}
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

<!--Bloque 4 -> Eliminar Usuario-->
<div class="ui basic modal eliminar">
   <i class="close icon"></i>
   <div class="header">
      Eliminar Usuario!
   </div>
   <div class="image content">
      <div class="image">
        <i class="archive icon"></i>
      </div>
      <div class="description">
        <p>Esta seguro que desea eliminar este usuario?</p>
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
