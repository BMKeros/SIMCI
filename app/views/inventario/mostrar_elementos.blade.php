<!--Bloque 1 -> Tabla Principal-->
<div class="ui two column doubling stackable grid container">
   <div class="ui container centered grid">
      <div class="column">
         {{--  <table class="ui selectable celled table capitalize" datatable="" dt-options="opciones_tabla_elemento" dt-columns="columnas_tabla_elemento" dt-instance='tabla_elemento' width="100%"></table>--}}
      </div>
   </div>
</div>

<!--Bloque 2. Mostrar Elemento-->
<div class="ui modal" id="modal_ver_elemento">
    <div class="header">Datos </div>
        <div class="content">
            <table class="ui celled table capitalize">
                <tbody>
                    <tr>
                        <td colspan="2">
                            <b>Nombre del Elemento:</b><br/>
                            <p>Elemento Nuevo</p>
                        </td>
                        <td colspan="1"><b>Almacen:</b> Almacen 2</td>
                        <td colspan="1"><b>Estante:</b>A213DC</td>
                    </tr>

                    <tr>
                        <td colspan="2"><b>Agrupacion</b></td> 
                        <td colspan="2"><b>Sub-Agrupacion</b></td> 
                    </tr>
                    
                    <tr>
                        <td colspan="2"><b>Objeto</b> Objeto</td>
                        <td colspan="2"><b>Numero de Organizacion</b>2344234</td>   
                    </tr>

                    <tr>
                        <td colspan="2"><b>Objetos Disponibles</b> 60</td>
                        <td colspan="2"><b>Recipientes Disponibles</b> 20</td>
                    </tr>
                </tbody>    
            </table>
        </div>
        <div class="actions">
            <div class="ui negative button">
                Atras
            </div>
        </div>
    </div>
 
<!--Bloque 3 -> Modal Modificar Elemento-->

<div class="ui modal" id='modal_modificar_elemento'>
<div class="header">Actualizar</div>
   <div class="content">
      <div class="ui form">
            <form class="ui form" id="formulario_crear_elemento">
                <div class="field">
                    <div class="two fields">
                        <div class="field">
                            <label>Almacen</label>
                            {{  Form::select_dimension(array('name'=>'cod_dimension','id'=>'cod_dimension', 'ng-model'=>'cod_dimension')) }}
                        </div>

                        <div class="field">
                            <label>Estantes</label>
                                {{  Form::select_sub_dimension(array('name'=>'cod_sub_dimension','id'=>'cod_sub_dimension', 'ng-model'=>'cod_sub_dimension')) }}
                        </div>
                    </div>
                </div>

                <div class="field">
                    <div class="two fields">
                        <div class="field">
                            <label>Agrupacion</label>
                            {{-- Form::select_agrupacion(array('name'=>'cod_agrupacion', 'id'=>'cod_agrupacion', 'ng-model'=>'cod_agrupacion')) --}}
                        </div>

                        <div class="field">
                            <label>Sub-agrupaciones del Producto</label>
                            {{-- Form::select_sub_agrupacion(array('name'=>'cod_sub_agrupacion', 'id'=>'cod_sub_agrupacion', 'ng-model'=>'cod_sub_agrupacion')) --}}
                        </div>

                        <div class="field">
                            <label>Objeto</label>

                        </div>
                    </div>
                </div>

                <br>

                <div class="field">
                    <div class="three fields">
                        <div class="field">
                            <label>Numero de Organizacion</label>
                            <input type="number" name="numero_orden" placeholder="Numero de organizacion">
                        </div>

                        <div class="field">
                            <label>Objetos Disponibles</label>
                            <input type="number" name="numero_orden" placeholder="5">
                        </div>

                        <div class="field">
                            <label>Recipientes Disponibles</label>
                            <input type="number" name="recipientes_disponibles" placeholder="56">

                        </div>
                    </div>
                    
                    <br>
                    
                    <div class="field">
                        <div class="two fields">
                            <div class="field">
                                <div class="ui toggle checkbox">
                                    <input name="usa_recipiente" type="checkbox">
                                    <label>Usar Recipiente</label>
                                </div>
                            </div>

                            <div class="field">
                                <div class="ui toggle checkbox">
                                    <input name="usa_recipiente" type="checkbox">
                                    <label>Elemento Movible</label>
                                </div>
                            </div>
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



<!--Bloque 4 -> Eliminar Elemento-->
<div class="ui basic modal eliminar">
   <i class="close icon"></i>
   <div class="header">
      Eliminar Elemento!
   </div>
   <div class="image content">
      <div class="image">
        <i class="archive icon"></i>
      </div>
      <div class="description">
        <p>Esta seguro que desea eliminar este Elemento?</p>
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

