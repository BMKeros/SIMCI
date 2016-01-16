<div class="ui two column doubling stackable grid container">
  <div class="ui container centered grid">
    <div class="column">
      <table class="ui compact celled definition table">
        <thead>
          <tr>
            <th></th>
            <th>usuario</th>
            <th>Direccion electronica</th>
            <th>permiso</th>
            <th>acciones</th>
           
          </tr>
        </thead>
        <tbody>
          <tr ng-repeat='x in [1]'>
            <td></td>
            <td>Daniel Bonalde</td>
            <td>jhlilk22@yahoo.com</td>
            <td> Tipo de Permiso</td>
            <td class="thre wide">
            
            <div class="ui icon button blue activar-popup mostrar"  data-content="Ver Usuario">
              <i class="unhide icon"></i>
              <div class="ui modal ver">
                <div class="header">Datos </div>
                <div class="content">
                  <table class="ui celled table">
                    <tbody>
                      <tr>
                        <td colspan="1"><b>Primer Nombre:</b>Daniels.</td>
                        <td><b>Segundo Nombre:</b> Moises.</td>
                        <td></b>Primer Apellido:</b> Bonalde.</td>
                        <td><b>Segundo Apellido:</b> Prado.</td>
                      </tr>

                      <tr>
                        <td colspan="1"><b>Cedula:</b> 23.674.783</td>
                        <td colspan="2"><b>Sexo:</b> Masculino.</td>
                        <td colspan="1"><b>Tipo De Usuario:</b> Administrador.</td>
                      </tr>

                      <tr>
                        <td colspan="4"><b>Fecha de Nacimiento:</b> DD/MMM/AAAA</td>
                      </tr>
                    </tbody>
                  </table>
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
            </div>

            <div class="ui icon button green activar-popup modificar"  data-content="Modificar Usuario">
              <i class="edit icon"></i>
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
            </div>    
            
            <div class="ui icon button red activar-popup eliminar"  data-content="Eliminar Usuario">
              <i class="remove icon"></i>
                <div class="ui modal eliminar">
                  <div class="header">Eliminar Usuario</div>
                  <div class="content">
                    <p>Esta Seguro que desea eliminar este usuario?</p>
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
            </div> 
    </div>
  </div>
</div>


<script>
$(document).ready(function(){
  $('.activar-popup').
      popup();

  $('.mostrar').on('click',function(){
    $('.ui.modal.ver')
      .modal('show');
  });

  $('.modificar').on('click',function(){
    $('.ui.modal.modificar')
      .modal('show');
  });

  $('.eliminar').on('click',function(){
    $('.ui.modal.eliminar')
      .modal('show');
  });
  
});
</script>