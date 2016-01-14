@extends('layouts.plantilla_master')
@section ('contenido-body-master')
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
              <tr ng-repeat='x in [1,2,3,4,5,6,7,8,9,10]'>
                <td></td>
                <td>Daniel Bonalde</td>
                <td>jhlilk22@yahoo.com</td>
                <td> Tipo de Permiso</td>
                <td class="thre wide">
                  <div class="ui icon button blue prueba"  data-content="Ver Usuario">
                      <i class="unhide icon"></i>
                  </div>
                  <div class="ui icon button green prueba"  data-content="Modificar Usuario">
                      <i class="edit icon"></i>
                  </div>
                  <div class="ui icon button red prueba"  data-content="Eliminar Usuario">
                      <i class="remove icon"></i>
                  </div>
                </td>
              </tr>
            </tbody>
          </table> 
      </div>
    </div>
  </div>
  @stop

@section('js')
<script>
$(document).ready(function(){
$('.prueba')
    .popup();
});
  

</script>
@stop