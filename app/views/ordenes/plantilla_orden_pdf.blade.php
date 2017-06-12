<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title></title>
    <style type="text/css">
        body {
            margin: 20px 30px 20px 30px;
            text-align: center;
            font-family: arial, helvetica, sans-serif;
            font-size: 10px;
        }

        #cod {
            padding: 10px;
            float: right;
            text-align: right;
        }

        #logo1 {
            width: 25%;
            height: 0%;
            position: absolute;
        }

        #logo2 {
            width: 180%;
            height: 0%;
            position: absolute;
        }

        #logo3 {
            width: 110%;
            height: 0%;
        }

        .obser {
            text-align: left;
        }

        .encabezado {
            text-align: center;
        }

        .dat {
            padding: 10px;
            float: left;
            width: 50%;
            text-align: left;
            margin: 0;
            font-size: 14px;
        }

        .lisreac {
            text-align: center;
        }

        h2 {
            text-align: right;
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
<br>
<br>
<br>

<table class="encabezado" width="100%">
    <tr>
        <td><strong>Universidad Politécnica Territorial de Falcón “Alonso Gamero”</strong></td>
    </tr>
    <tr>
        <td><strong>Departamento de Formación General PNF Química</strong></td>
    </tr>
    <tr>
        <td><strong>Sistema Integrado para el Manejo y Control de Inventariados Químicos</strong></td>
    </tr>
</table>
<br>

<h1>Orden {{ $codigo_orden }}</h1>
<table class="dat" width="100%">
    <tr>
        <td><br></td>
    </tr>
    <tr>
        <td colspan="2">Fec. de Solicitud: <b>{{ convertir_fecha($datos_orden->fecha). ' - '.$datos_orden->hora }}</b>
        </td>
    </tr>
    <tr>
        <td colspan="2">Nom. del Solicitante: <b>{{ $datos_orden->get_datos_solicitante() }}</b>
        </td>
    </tr>
    <tr>
        <td colspan="2">Nom. del Responsable: <b>{{ $datos_orden->get_datos_responsable() }}</b>
        </td>
    </tr>
    <tr>
        <td colspan="2">Lab. de Solicitud: <b>{{ $datos_orden->get_nombre_laboratorio() }}</b></td>
    </tr>
    <tr>
        <td colspan="2">Fec. de Actividad: <b>{{ convertir_fecha($datos_orden->fecha_actividad) }}</b></td>
    </tr>
    <tr>
        <td colspan="2">Estado: <b>{{ $datos_orden->get_estado_orden() }}</b></td>
    </tr>
</table>

<div id="cod"><img
            src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(180)->margin(0)->generate($codigo_orden)) }} ">
</div>

<table width="100%">
    <tr>
        <td><h2>[{{ $codigo_orden }}] - {{ $datos_orden->get_estado_orden() }}</h2></td>
    </tr>
</table>
<table class="lisreac" border=3 width="100%" bordercolor="orange">
    <tr>
        <td bgcolor="orange" width="100%"><h3>Lista de Pedidos</h3></td>
    </tr>
</table>

<Table border=3 width="100%" bordercolor="orange">
    <tr>
        <td><strong>N°</strong></td>
        <td><strong>Dimensión</strong></td>
        <td><strong>Sub <br>Dimensión</strong></td>
        <td><strong>Agrupación</strong></td>
        <td><strong>Sub <br>Agrupación</strong></td>
        <td><strong>Nombre</strong></td>
        <td><strong>Cantidad Solicitada</strong></td>
        <td><strong>Unidad</strong></td>
        <td><strong>Estado</strong></td>
    </tr>
    @foreach ($datos_orden->pedidos as $pedido)
        <tr>
            <td>*</td>
            <td>{{ $pedido->cod_dimension }}</td>
            <td>{{ $pedido->cod_subdimension }}</td>
            <td>{{ $pedido->cod_agrupacion }}</td>
            <td>{{ $pedido->cod_objeto }}</td>
            <td>{{ strtoupper($pedido->objeto->nombre) }}</td>
            <td>{{ $pedido->cantidad_solicitada }}</td>
            <td>{{ $pedido->objeto->unidad->nombre }}</td>
            <td>{{ strtoupper($pedido->condicion->nombre) }}</td>
        </tr>
    @endforeach
</Table>
<br>
<table class="obser" width="100%">
    <tr>
        <td><strong>Observación:</strong></td>
    </tr>
    <tr>
        <td>_______________________________________________________________________________________</td>
    </tr>
    <tr>
        <td>_______________________________________________________________________________________</td>
    </tr>
</table>
<br>
<br>
</body>
</html>