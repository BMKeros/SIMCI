<!DOCTYPE html>

<html>

<head lang="es">
    <title>Orden Cancelada</title>

    <style>
        #razon_cancelar {
            font-size: 18px;
        }
    </style>
</head>

<body>
<h2>Ordene Cancelada</h2>

<h2>Codigo de la orden: {{ $cod_orden }}</h2>

<p>
    <b>Su orden fue cancelada por el siguiente motivo: </b>
    <br>
    <site id="razon_cancelar">
        {{ ucfirst($razon_cancelar) }}
    </site>
</p>

<br>

<h3>Aqui va la tabla con todos sus pedidos</h3>


<hr>

<footer>
    <p align="center">Plantilla generada por SIMCI v1.0</p>

    <p align="center">
        <b>SISTEMA INTEGRADO PARA EL MANEJO Y CONTROL DE INVENTARIOS</b>
    </p>

</footer>
</body>

</html>