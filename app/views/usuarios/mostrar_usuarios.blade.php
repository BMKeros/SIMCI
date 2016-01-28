<!--Bloque 1 -> Tabla Principal-->
<div class="ui two column doubling stackable grid container">
   <div class="ui container centered grid">
      <div class="column">
         <table class="ui selectable celled table capitalize" datatable="" dt-options="opciones_tabla_usuarios" dt-columns="columnas_tabla_usuarios" dt-instance='tabla_usuarios' width="100%"></table>
      </div>
   </div>
</div>

<!--Bloque 2 -> Modale Ver Usuario-->
<div class="ui modal font-tag-p-15px" id="modal_ver_usuario">
   <div class="header">Datos del Usuario</div>
      <div class="content">
         <table class="ui celled table">
            <tbody>
               <tr>
            		<td colspan="2">
               		<b>Primer Nombre:</b><br>
               		<p><% data_usuario.persona.primer_nombre | capitalize %></p>
               	</td>
               	<td colspan="2">
               		<b>Segundo Nombre:</b><br>
               		<p><% data_usuario.persona.segundo_nombre | capitalize %></p>
               	</td>
               	<td colspan="2">
               		<b>Primer Apellido:</b><br>
               		<p><% data_usuario.persona.primer_apellido | capitalize %></p>
               	</td>
               	<td colspan="2">
               		<b>Segundo Apellido: </b><br>
               		<p><% data_usuario.persona.segundo_apellido | capitalize %></p>
               	</td>
               </tr>

               <tr>
                  <td colspan="1">
                  	<b>Cedula:</b><br>
                  	<p><%data_usuario.persona.cedula%></p>
                  </td>
                  <td colspan="2">
                  	<b>Sexo:</b><br> 
                  	<p><% data_usuario.persona.data_sexo.descripcion%></p>
                  </td>
                  <td colspan="4">
                  	<b>Fecha de Nacimiento:</b><br>
                  	<p><% data_usuario.persona.fecha_nacimiento%></p>
                  </td>
               </tr>

               <tr>
                  <td colspan="4">
                  	<b>Usuario: </b><br>
                  	<p><% data_usuario.usuario.usuario | capitalize %></p>
                	</td>
                  
                  <td colspan="4">
                  	<b>Email:</b><br>
                  	<p><% data_usuario.usuario.email %> </p>
                  </td>
               </tr>

               <tr>
                  <td colspan="3"><b>Tipo Usuario:</b><br>
                  	<p><% data_usuario.usuario.data_tipo_usuario.descripcion %></p>
                  </td>
                  
                  <td colspan="5"><b>Permisos: </b> 
							<div class="ui label" ng-repeat="permiso in data_usuario.usuario.data_permisos">
								<% permiso.nombre %>
							</div>
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
<!--Bloque 3 -> Modal Modificar Usuario-->

<div class="ui modal" id="modal_modificar_usuario">
<div class="header">Actualizar datos del Usuario</div>
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
                     {{Form::select_permisos(array('name' => 'permisos', 'id' => 'permisos','ng-model'=>'data_usuario.usuario.data_permisos'))}}
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
      <button class="ui positive button">
         Actualizar
      </button>
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
        <i class="trash outline icon"></i>
      </div>
      <div class="description">
        <p>Esta seguro que desea eliminar este usuario?</p>
      </div>
   </div>
   <div class="actions">
      <div class="two fluid ui inverted buttons">
         <button class="ui red basic inverted button" ng-click="cerrar_modal_eliminar()">
            <i class="remove icon"></i>
            No
         </button>
         <button class="ui green basic inverted button" ng-click="procesar_eliminar()">
            <i class="checkmark icon"></i>
            Yes
         </button>
      </div>
   </div>
</div>
<!--Fin De Bloques-->

<script>
	$('ui.dropdown').dropdown();
</script>


