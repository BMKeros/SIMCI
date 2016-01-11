<div class="espacio_buttom">
   
   <h3 class="ui center aligned icon header">
      <i class="circular inverted blue users icon"></i>
      Modulo <small>Usuarios</small>
      <div>
         <i>Seleccione una accion</i>
      </div>
   </h3>

   <div class="ui bottom piled segment">

      <div class="ui four column grid ">

         <div class="column" ng-repeat="opcion in opciones">
            
            <div class="ui fluid card">
               <div class="content">
                  <!--<img class="right floated mini ui image" src="/images/avatar/large/elliot.jpg">-->
                  <i class="right floated bordered user icon"></i>

                  <div class="header">
                  <% opcion.nombre %>
                  </div>
                  
                  <div class="meta">
                  Descripcion
                  </div>
                  
                  <div class="description">
                  Esta opcion podras ver todos los usuarios registrados en el sistema
                  </div>
               </div>
                  
               <div class="extra content">
                     <div class="ui two buttons">
                     <div class="ui basic green button">Entrar</div>
                     </div>
               </div>
            </div>

         </div>


      </div>

   </div>

</div>