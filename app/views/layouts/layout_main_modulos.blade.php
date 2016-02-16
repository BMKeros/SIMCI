<div class="espacio_buttom">
   
   <h3 class="ui center aligned icon header">
      <i class="circular inverted <% modulo.icono.color %> <% modulo.icono.tipo%> icon"></i>
      Modulo <small><% modulo.nombre %></small>
      <div>
         <i>Seleccione una accion</i>
      </div>
   </h3>

   <div class="ui bottom piled segment">

      <div class="ui four column grid ">

         <div class="column" ng-repeat="opcion in modulo.opciones" ng-if="opcion.show_in | inArray: data_global_user.tipo_usuario">
            <div class="ui fluid card">
            	
               <div class="content">
                  <i class="right floated bordered <% opcion.icono %> icon"></i>

                  <div class="header">
                  <% opcion.nombre | capitalize:true%>
                  </div>
                  
                  <div class="meta">
                     <small>Descripcion</small>
                  </div>
                  
                  <div class="description">
                     <% opcion.descripcion %>
                  </div>
               </div>
                  <div class="extra content" ng-if="opcion.ver_dropdown">
                     <div class="ui two buttons">
                        <div class="ui compact menu">
                           <div class="ui simple dropdown item">
                              Opciones
                              <i class="dropdown icon"></i>
                              <div class="menu">
                                 <a href="<% opt.url %>" class="item" ng-repeat="opt in opcion.opciones_dropdown"> <%opt.nombre | filter:capitalize%>
                                 </a>
                              </div>
                           </div>
                        </div>   
                     </div>
                  </div>
                  <!--Este mostrara el bottun acceder normal-->
                   <div class="extra content" ng-if="!opcion.ver_dropdown">
                        <div class="ui two buttons">
                           <a class="ui basic green button" href="<% opcion.url %>">Acceder</a>
                        </div>
                  </div>
            </div>
         </div>


      </div>

   </div>

</div>