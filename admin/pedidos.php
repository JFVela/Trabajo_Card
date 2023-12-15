<?php
require_once "../config/conexion.php";

if (isset($_POST)) {
    if (!empty($_POST)) {
        $nombre = $_POST['nombre'];
        $query = mysqli_query($conexion, "INSERT INTO categorias(categoria) VALUES ('$nombre')");
        if ($query) {
            header('Location: categorias.php');
        }
    }
}

include("includes/header.php");

// Consulta 1
$sql1 = "SELECT referenciaPC, nombre, apellido, localizacion, telefono, correo FROM pedido_cliente";
$result1 = mysqli_query($conexion, $sql1);

// Consulta 2
$sql2 = "SELECT p.idpedido, p.referenciaPC, p.referenciaPD, p.medioPago, p.TotalFinal, p.tipoEnvio, p.fechaPedido FROM pedido p JOIN pedido_cliente pc ON p.referenciaPC = pc.referenciaPC";
$result2 = mysqli_query($conexion, $sql2);
$rows2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);

// Calcular la Venta Total
$ventaTotal = array_sum(array_column($rows2, 'TotalFinal'));

// Consulta 3
$sql3 = "SELECT pr.nombre, pd.referenciaPD, pd.cantPD, pd.precioPD, pd.totalPD FROM pedido_datos pd JOIN pedido p ON pd.referenciaPD = p.referenciaPD JOIN pedido_cliente pc ON p.referenciaPC = pc.referenciaPC JOIN productos pr ON pd.idProductos = pr.id";
$result3 = mysqli_query($conexion, $sql3);
$rows3 = mysqli_fetch_all($result3, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Carrito de Compras</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/techbocx.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="assets/css/styles.css" rel="stylesheet" />
    <link href="assets/css/estilos.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/button.css">
    <style>
        table {
            margin: 35px auto;
            border-collapse: collapse;
            width: 80%;
        }

        th,
        td {
            border: 1px solid black;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: chartreuse;
            padding: 15px;
            /* Aumenta el espacio alrededor del texto */
            text-align: center;
            /* Alinea el texto al centro */
            font-family: 'Arial', sans-serif;
            /* Cambia la fuente del texto */
            font-size: 18px;
            /* Cambia el tamaño del texto */
            color: darkblue;
            /* Cambia el color del texto */
            text-transform: uppercase;
            /* Convierte el texto a mayúsculas */
        }

        tr:nth-child(even) {
            background-color: aqua;
        }
    </style>
</head>

<body>
    <!-- Resultado de la Consulta 2 -->
    <h2 style="margin: 15px auto; text-align: center; font-family: 'Arial', sans-serif; font-size: 24px; color: #333; text-transform: uppercase;">Referencia de Pedido</h2>
    <table>
        <tr>
            <th>ID Pedido</th>
            <th>COD-Cliente</th>
            <th>COD-Datos</th>
            <th>Medio de Pago</th>
            <th>Monto Final</th>
            <th>Tipo de Envío</th>
            <th>Fecha del Pedido</th>
        </tr>
        <?php foreach ($rows2 as $row) : ?>
            <tr>
                <td><?= $row['idpedido'] ?></td>
                <td><?= $row['referenciaPC'] ?></td>
                <td><?= $row['referenciaPD'] ?></td>
                <td><?= $row['medioPago'] ?></td>
                <td><?= $row['TotalFinal'] ?></td>
                <td><?= $row['tipoEnvio'] ?></td>
                <td><?= $row['fechaPedido'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <!-- Venta Total -->
    <div style="margin: 30px auto; text-align: center;">
        <strong>Venta Total: S/ <?= number_format($ventaTotal, 2) ?></strong>
    </div>
    <hr>
    <hr>
    <!-- Resultado de la Consulta 1 -->
    <h2 style="margin: 15px auto; text-align: center; font-family: 'Arial', sans-serif; font-size: 24px; color: #333; text-transform: uppercase;">Referencia del Cliente</h2>
    <table>
        <tr>
            <th>COD-Cliente</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Ubicación</th>
            <th>Teléfono</th>
            <th>Correo electrónico</th>
        </tr>
        <?php foreach ($result1 as $row) : ?>
            <tr>
                <td><?= $row['referenciaPC'] ?></td>
                <td><?= $row['nombre'] ?></td>
                <td><?= $row['apellido'] ?></td>
                <td><?= $row['localizacion'] ?></td>
                <td><?= $row['telefono'] ?></td>
                <td><?= $row['correo'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <hr>
    <hr>
    <!-- Resultado de la Consulta 3 -->
    <h2 style="margin: 15px auto; text-align: center; font-family: 'Arial', sans-serif; font-size: 24px; color: #333; text-transform: uppercase;">Referencia de Productos</h2>
    <table>
        <tr>
            <th>Nombre del producto</th>
            <th>COD-Datos</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Total</th>
        </tr>
        <?php foreach ($rows3 as $row) : ?>
            <tr>
                <td><?= $row['nombre'] ?></td>
                <td><?= $row['referenciaPD'] ?></td>
                <td><?= $row['cantPD'] ?></td>
                <td><?= $row['precioPD'] ?></td>
                <td><?= $row['totalPD'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/js/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>
    <script src="../assets/js/all.min.js"></script>
    <script src="../assets/js/scripts.js"></script>

</body>
</html>