<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title></title>
    <style type="text/css">
        body {
            text-align: center;
            font-family: arial, helvetica, sans-serif;
        }

        #logo1 {
            width: 25%;
            height: 0;
            position: absolute;
        }

        #logo2 {
            width: 180%;
            height: 0;
            position: absolute;
        }

        #logo3 {
            width: 110%;
            height: 0;
        }

        .dat {
            font-size: 13px;
        }

        .firm {
            font-size: 13px;
        }

        p {
            text-align: left;
            font-size: 12px;
        }

        .reactivo {
            text-align: center;
        }

        .titulo-reactivo {
            border-radius: 3px;
            border-color: orange;
            z-index: 3;
            text-align: center;
        }

        .tabla-materiales {
            text-align: center;
        }
    </style>
</head>
<body>
<div id="logo1">{{ tag_img_base64(public_path('/img/logos/logo_uptag.png')) }}</div>
<div id="logo2">{{ tag_img_base64(public_path('/img/logos/logo_sencillo_simciq.png')) }}</div>
<div id="logo3">{{ tag_img_base64(public_path('/img/logos/logo_departamento_quimica.png')) }}</div>

<br>
<br>
<br>
<br>

<h3>SOLICITUD DE REACTIVOS Y MATERIALES</h3>

<table class="dat" width="100%">
    <tr rowspam="3">
        <td>Laboratorio: {{ Laboratorio::get_nombre($datos_orden->cod_laboratorio) }}</td>
        <td>Docente Responsable: {{ $responsable->nombre_completo }}</td>
        <td>Solicitado por: {{ $solicitante->nombre_completo }}</td>
    </tr>

    <tr rowspam="3">
        <td>Fecha Solicitud: {{ $datos_orden->fecha }}</td>
        <td>Hora: {{ $datos_orden->hora }}</td>
    </tr>
    <tr>
        <td>Actividad a Realizar: {{ strtoupper($datos_orden->observaciones) }}</td>
    </tr>
</table>

<br>

<table class="titulo-reactivo" border=3 width="100%">
    <tr>
        <td bgcolor="orange" width="100%">Reactivo</td>
    </tr>
</table>
<table class="reactivo" border=1 width="100%">
    <tr>
        <td bgcolor="orange" width="5%">N°</td>
        <td bgcolor="orange">Nombre</td>
        <td bgcolor="orange">Dimension</td>
        <td bgcolor="orange">SubDimension</td>
        <td bgcolor="orange">Agrupacion</td>
        <td bgcolor="orange">Codigo objeto</td>
        <td bgcolor="orange">Numero de orden</td>
        <td bgcolor="orange">Cantidad Solicitada</td>
    </tr>
    @forelse($data_pedidos as $pedido)
        @if(ElementoInventario::verificar_is_clase_objeto(REACTIVO, $pedido['cod_objeto']))
            <tr>
                <td bgcolor="orange" width="5%"> *</td>
                <td width="">{{ ElementoInventario::get_nombre_objeto($pedido['cod_objeto']) }}</td>
                <td width="">{{ $pedido['cod_dimension'] }}</td>
                <td width="">{{ $pedido['cod_subdimension'] }}</td>
                <td width="">{{ $pedido['cod_agrupacion'] }}</td>
                <td width="">{{ $pedido['cod_objeto'] }}</td>
                <td width="">{{ $pedido['numero_orden'] }}</td>
                <td width="">{{ $pedido['cantidad_solicitada'] }}</td>
            </tr>
        @endif
    @empty
        <tr>
            <td colspan="8">No fue seleccionado ningun reactivo</td>
        </tr>
        @end
    @endforelse
</table>

<br>

<table class="titulo-reactivo" border=3 width="100%">
    <tr>
        <td bgcolor="orange" width="100%">Materiales y Equipos</td>
    </tr>
</table>
<div class="tabla-materiales">
    <table border=1 width="100%">
        <tr>
            <td bgcolor="orange" width="5%">N°</td>
            <td bgcolor="orange">Nombre</td>
            <td bgcolor="orange">Dimension</td>
            <td bgcolor="orange">SubDimension</td>
            <td bgcolor="orange">Agrupacion</td>
            <td bgcolor="orange">Codigo objeto</td>
            <td bgcolor="orange">Numero de orden</td>
            <td bgcolor="orange">Cantidad Solicitada</td>
        </tr>
        @forelse($data_pedidos as $pedido)
            @if(!ElementoInventario::verificar_is_clase_objeto(REACTIVO, $pedido['cod_objeto']))
                <tr>
                    <td bgcolor="orange" width="5%"> *</td>
                    <td width="">{{ ElementoInventario::get_nombre_objeto($pedido['cod_objeto']) }}</td>
                    <td width="">{{ $pedido['cod_dimension'] }}</td>
                    <td width="">{{ $pedido['cod_subdimension'] }}</td>
                    <td width="">{{ $pedido['cod_agrupacion'] }}</td>
                    <td width="">{{ $pedido['cod_objeto'] }}</td>
                    <td width="">{{ $pedido['numero_orden'] }}</td>
                    <td width="">{{ $pedido['cantidad_solicitada'] }}</td>
                </tr>
            @endif
        @empty
            <tr>
                <td colspan="8">No fue seleccionado ningun equipo o instrumento</td>
            </tr>
        @endforelse
    </table>
</div>

<br>

<table class="firm" width=100%>
    <tr>
        <td>_________________________</td>
        <td></td>
        <td>______________________________</td>
        <td></td>
        <td>__________________</td>
        <td></td>
        <td>__________________</td>
    </tr>
    <tr>
        <td>V/B DOCENTE RESPONSABLE</td>
        <td></td>
        <td>V/B COORD. DE LABORATORIO</td>
        <td></td>
        <td>V/B JEFE DPTO.</td>
        <td></td>
        <td>RECIBIDO POR</td>
    </tr>
</table>

<p>
    Observación:
    Únicamente cuando el Solicitante sea un estudiante, éste deberá colocar cédula y firma.
    Este documento con todas las firmas Correspondiente es condición única e imprescindible
    para la solicitud de reactivos y materiales.
</p>
</body>
</html>