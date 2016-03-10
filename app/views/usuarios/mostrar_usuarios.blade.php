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
   <div class="header">Datos del Usuario </div>
      <div class="content">
         <table class="ui celled table">
            <tbody>
               <tr>
            		<td colspan="2">
               		<b>Primer Nombre:</b><br>
               		<p><% data_usuario.primer_nombre | capitalize %></p>
               	</td>
               	<td colspan="2">
               		<b>Segundo Nombre:</b><br>
               		<p><% data_usuario.segundo_nombre | capitalize | default_value%></p>
               	</td>
               	<td colspan="2">
               		<b>Primer Apellido:</b><br>
               		<p><% data_usuario.primer_apellido | capitalize %></p>
               	</td>
               	<td colspan="2">
               		<b>Segundo Apellido: </b><br>
               		<p><% data_usuario.segundo_apellido | capitalize | default_value%></p>
               	</td>
               </tr>

               <tr>
                  <td colspan="1">
                  	<b>Cedula:</b><br>
                  	<p><% data_usuario.cedula%></p>
                  </td>
                  <td colspan="2">
                  	<b>Sexo:</b><br> 
                  	<p><% data_usuario.sexo %></p>
                  </td>
                  <td colspan="4">
                  	<b>Fecha de Nacimiento:</b><br>
                  	<p><% data_usuario.fecha_nacimiento | formato_fecha:"DD/MM/YY" %></p>
                  </td>
               </tr>

               <tr>
                  <td colspan="4">
                  	<b>Usuario: </b><br>
                  	<p><% data_usuario.usuario | capitalize %></p>
                	</td>
                  
                  <td colspan="4">
                  	<b>Email:</b><br>
                  	<p><% data_usuario.email %> </p>
                  </td>
               </tr>

               <tr>
                  <td colspan="3"><b>Tipo Usuario:</b><br>
                  	<p><% data_usuario.nombre_tipo_usuario %></p>
                  </td>
                  
                  <td colspan="5"><b>Permisos: </b> 
						<div class="ui label" ng-repeat="permiso in data_usuario.permisos">
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
<div class="header">Actualizar Usuario</div>
   <div class="content">
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

         <form class="ui form" id="formulario_crear_usuario">
             <h4 class="ui dividing header">Datos de Usuario</h4>
            <div class="field">
               <div class="two fields">
                 <div class="field">
                  <label>Usuario</label>
                   <input type="text" name="usuario" placeholder="Usuario" ng-model="DatosForm.usuario">
                 </div>

                  <div class="eight wide field">
                     <label>Direccion Email</label>
                     <input type="text" name="email" placeholder="Direccion Email" ng-model="DatosForm.email">
                  </div>
               </div>
            </div>

            <div class="field">
               <div class="two fields">
                  <div class="field">
                     <label>Password</label>  
                     <input type="password" name="password" placeholder="Password">
                  </div>

                  <div class="two field">
                     <label>Confirmar Password</label>
                     <input type="password" name="password_confirmacion" placeholder="Confirmar Password">
                  </div>
               </div>
            </div>
         
            <div class="field">
               <div class="two fields">
                  <div class="field">
                     <label>Tipo de Permiso</label>
                     {{Form::select_permisos(array('name' => 'permisos', 'id' => 'permisos','ng-model'=>'DatosForm.permisos'))}}
                  </div>

                  <div class="eight wide field">
                     <label>Tipo de Usuario</label>
                     {{Form::select_tipo_usuario(array('id' => 'tipo_usuario', 'name' => 'tipo_usuario','ng-model'=>'DatosForm.tipo_usuario'))}}
                  </div>
               </div>
               <div class="field">
                  <input type="file" name="imagen" placeholder="" ng-model-file="DatosForm.imagen">
               </div>
            </div>
         </form>
        
         <h4 class="ui dividing header">Datos Personales</h4>
         <form class="ui form">
            <div class="field">
               <div class="two fields">
                  <div class="field">
                     <label>Primer Nombre</label>
                     <input type="text" name="primer_nombre" placeholder="Primer Nombre" ng-model="DatosForm.primer_nombre">
                  </div>
                
                  <div class="two field">
                     <label>Segundo Nombre</label>
                     <input type="text" name="segundo_nombre" placeholder="Segundo Nombre" ng-model="DatosForm.segundo_nombre">
                  </div>
               </div>
            </div>

            <div class="field">
               <div class="two fields">
                  <div class="field">
                     <label>Primer Apellido</label>
                     <input type="text" name="primer_apellido" placeholder="Primer Apellido" ng-model="DatosForm.primer_apellido">
                  </div>

                  <div class="two field">
                     <label>Segundo Apellido</label>
                     <input type="text" name="segundo_apellido" placeholder="Segundo Apellido" ng-model="DatosForm.segundo_apellido">
                  </div>
               </div>
            </div>

            <div class="field">
               <div class="two fields">
                  <div class="field">
                     <label>Cedula</label>
                     <input type="text" name="cedula" placeholder="Cedula" ng-model="DatosForm.cedula">
                  </div>

                  <div class="two field">
                     <label>Fecha de Nacimiento</label>
                     <input type="text" name="fecha_nacimiento" id="fecha_nacimiento" placeholder="Fecha Nacimieto" ng-model="DatosForm.fecha_nacimiento">
                  </div>
               </div>
            </div>
          
            <div class="field">
               <div class="two fields">
                  <div class="field">
                  <label>Sexo</label>
                    {{Form::select_sexo(array('id' => 'sexo', 'name' => 'sexo','ng-model'=>"DatosForm.sexo"))}}
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
      <button class="ui positive button" ng-click="procesar_modificar()" id="btn-modificar">
         Actualizar
      </button>
      <div class="ui chackmark icon"></div>
   </div>
</div>

<!--Fin De Bloques-->

<script>
	$('.ui.dropdown').dropdown();

	var picker = new Pikaday({ 
		field: document.getElementById('fecha_nacimiento'),
		i18n: TOOLS_APP.lenguaje_pikaday
	});
</script>


