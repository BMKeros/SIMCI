<!--Bloque 1 -> Tabla Principal-->
<div class="ui two column doubling stackable grid container">
   <div class="ui container centered grid">
      <div class="column">
         <table class="ui selectable celled table capitalize" datatable="" dt-options="opciones_tabla_usuarios" dt-columns="columnas_tabla_usuarios"  width="100%"></table>
      </div>
   </div>
</div>

<!--Bloque 2 -> Modale Ver Usuario-->
<div class="ui modal" id="modal_ver_usuario">
   <div class="header">Datos </div>
      <div class="content">
         <table class="ui celled table">
            <tbody>
               <tr>
                  <td colspan="2"><b>Primer Nombre:</b> <% data_usuario.persona.primer_nombre | capitalize %></td>
                  <td colspan="2"><b>Segundo Nombre:</b> <% data_usuario.persona.segundo_nombre | capitalize %></td>
                  <td colspan="2"><b>Primer Apellido:</b> <% data_usuario.persona.primer_apellido | capitalize %></td>
                  <td colspan="2"><b>Segundo Apellido:</b> <% data_usuario.persona.segundo_apellido | capitalize %></td>
               </tr>

               <tr>
                  <td colspan="1"><b>Cedula:</b> <%data_usuario.persona.cedula%></td>
                  <td colspan="2"><b>Sexo:</b> <% data_usuario.persona.data_sexo.descripcion%></td>
                  <td colspan="4"><b>Fecha de Nacimiento:</b> <% data_usuario.persona.fecha_nacimiento%></td>
               </tr>

               <tr>
                  <td colspan="4"><b>Usuario:</b> <% data_usuario.usuario.usuario | capitalize %></td>
                  <td colspan="4"><b>Email:</b> <% data_usuario.usuario.email %></td>
               </tr>

               <tr>
                  <td colspan="3"><b>Tipo Usuario:</b> <% data_usuario.usuario.cod_tipo_usuario %></td>
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

<div class="ui modal" id="modal_modificar_usuario">
<div class="header">Actualizar</div>
   <div class="content">
      <div class="ui form">
        <form class="ui form" id="formulario_crear_usuario">

            <div class="field">
               <div class="two fields">
                 <div class="field">
                   <input type="text" name="usuario" placeholder="Usuario" ng-model="data_usuario.usuario.usuario">
                 </div>

                  <div class="eight wide field">
                     <input type="text" name="email" placeholder="Direccion Email" ng-model="data_usuario.usuario.email">
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
                     {{Form::select_tipo_usuario(array('id' => 'tipo_usuario', 'name' => 'tipo_usuario','ng-model'=>'data_usuario.usuario.cod_tipo_usuario'))}}
                  </div>
               </div>
            </div>
         </form>
        
         <h4 class="ui dividing header">Datos Personales</h4>
         <form class="ui form">
            <div class="field">
               <div class="two fields">
                  <div class="field">
                     <input type="text" name="primer_nombre" placeholder="Primer Nombre" ng-model="data_usuario.persona.primer_nombre">
                  </div>
                
                  <div class="two field">
                     <input type="text" name="segundo_nombre" placeholder="Segundo Nombre" ng-model="data_usuario.persona.segundo_nombre">
                  </div>
               </div>
            </div>

            <div class="field">
               <div class="two fields">
                  <div class="field">  
                     <input type="text" name="primer_apellido" placeholder="Primer Apellido" ng-model="data_usuario.persona.primer_apellido">
                  </div>

                  <div class="two field">
                     <input type="text" name="segundo_apellido" placeholder="Segundo Apellido" ng-model="data_usuario.persona.segundo_apellido">
                  </div>
               </div>
            </div>

            <div class="field">
               <div class="two fields">
                  <div class="field">
                     <input type="text" name="cedula" placeholder="Cedula" ng-model="data_usuario.persona.cedula">
                  </div>

                  <div class="two field">
                     <input type="date" name="fecha_nacimiento" placeholder="Fecha Nacimieto" ng-model="data_usuario.persona.fecha_nacimiento">
                  </div>
               </div>
            </div>
          
            <div class="field">
               <div class="two fields">
                  <div class="field">
                    {{Form::select_sexo(array('id' => 'sexo', 'name' => 'sexo','ng-model'=>"data_usuario.persona.sexo.id"))}}
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
<div class="ui basic modal" id="modal_eliminar_usuario">
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
