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
                          
                           <div class="ui floating labeled icon dropdown button" id="dropdown_acciones_menu">
                           		<i class="filter icon"></i>
							  	<span class="text">Seleccione una accion</span>
							  	<div class="menu">
							    	<div class="header">
							      		<i class="tags icon"></i>
							    	</div>
							    
							    	<div class="item" ng-repeat="opt in opcion.opciones_dropdown">
							      		<div class="ui red empty circular label"></div>
							      		<a href="<% opt.url %>"><% opt.nombre | capitalize %></a>
							    	</div>
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

<script>
	$(document).ready(function(){

		$("body").on("click", '#dropdown_acciones_menu', function (e, something) {
        	$('.ui.dropdown').dropdown();
    	});

	});
</script>