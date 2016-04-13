<!--Bloque 1 -> Tabla Principal-->
<div class="ui two column doubling stackable grid container">
    <div class="ui container centered grid">
        <div class="column">
            <table class="ui selectable celled table capitalize" datatable="" dt-options="opciones_tabla_objetos"
                   dt-columns="columnas_tabla_objetos" dt-instance="tabla_objetos" width="100%"></table>
        </div>
    </div>
</div>


<div class="ui modal" id="modal_ver_objeto">
    <div class="header">Datos del Objeto</div>
    <div class="content">
        <table class="ui celled table capitalize">
            <tbody>
            <tr>
                <td colspan="5"><b>Nombre del Objeto: </b><br> <% data_objeto.nombre %></td>

            </tr>
            <tr>
                <td><b>Clase de Objeto: </b><br> <% data_objeto.nombre_clase %>
                </td>
                <td colspan="2"><b>Unidad:</b><br><%data_objeto.nombre_unidad %> (<%data_objeto.abreviatura_unidad %>
                    )
                </td>
                <td colspan="3"><b>Especificaciones:</b><br>
                    <p><% data_objeto.especificaciones | uppercase %></p>
                </td>
            </tr>
            <tr>
                <td colspan="5"><b>Descripcion:</b><br>
                    <p><% data_objeto.descripcion | uppercase %></p>
                </td>
            </tr>
            <tr>
                <td colspan="2"><b>Creado</b><br>
                    <p>2016/02/13</p>
                </td>
                <td colspan="2"><b>Actualizado</b><br>
                    <p>2016/04/19</p>
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

<!--Bloque 3 -> Modal Modificar -->

<div class="ui modal" id='modal_modificar_objeto'>
    <div class="ui centered dividing header">Actualizar datos del Objeto</div>

    <div class="content">

        <div ng-if="mostrar_mensaje">
            <div class="ui icon <% mensaje_validacion.color %> message">
                <i class="<% mensaje_validacion.icono %> icon"></i>

                <div class="content">
                    <div class="header"><% mensaje_validacion.titulo %></div>
                    <ul class="list">
                        <li ng-repeat=" mensaje in mensaje_validacion.mensajes track by $index"><% mensaje | capitalize
                            %>
                        </li>
                    </ul>
                </div>
            </div>
            <br>
        </div>

        <div class="ui form">
            <form class="ui form" id="formulario_actualizar_objeto">
                <br>

                <div class="field centered grid">
                    <div class="three fields">
                        <div class="field">
                            <label>Nombre del Producto</label>
                            <input type="text" name="nombre" placeholder="Nombre" ng-model="DatosForm.nombre">
                        </div>
                    </div>
                </div>

                <div class="field">
                    <div class="two fields">

                        <div class="field">
                            <label>Especificacion del Producto</label>
                            <textarea ng-model="DatosForm.especificaciones"></textarea>
                        </div>

                        <div class="field">
                            <label>Descripcion del Producto</label>
                            <textarea ng-model="DatosForm.descripcion"></textarea>
                        </div>

                    </div>
                </div>

                <br>

                <div class="field">
                    <div class="two fields">
                        <div class="field">
                            <label>Unidad</label>
                            {{ Form::select_unidades (array('name'=>'cod_unidad', 'id'=>'unidad','ng-model'=>'DatosForm.cod_unidad'))}}
                        </div>

                        <div class="field">
                            <label>Clase de Objeto</label>
                            {{ Form::select_clase_objeto(array('name'=>'cod_clase_objeto', 'id'=>'clase_objeto','ng-model'=>"DatosForm.cod_clase_objeto")) }}
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
        <button class="ui positive button" ng-click="procesar_modificar();" id="btn-modificar">
            Actualizar
        </button>
        <div class="ui chackmark icon"></div>
    </div>
</div>

<script>
    $('.ui.dropdown').dropdown();
</script>
