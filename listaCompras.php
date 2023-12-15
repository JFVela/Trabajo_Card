<?php require_once "config/conexion.php";
require_once "config/config.php";
?>
<?php
session_start();
if (!isset($_SESSION['id_cliente'])) {
    header("Location: login.php");
    exit();
}
$nombreCliente = $_SESSION['nombre'];
$idCliente = $_SESSION['id_cliente'];

// Consulta 1
$sql1 = "SELECT referenciaPC, nombre, apellido, localizacion, telefono, correo FROM pedido_cliente WHERE idCliente = $idCliente";
$result1 = mysqli_query($conexion, $sql1);

// Consulta 2
$sql2 = "SELECT p.idpedido, p.referenciaPC, p.referenciaPD, p.medioPago, p.TotalFinal, p.tipoEnvio, p.fechaPedido FROM pedido p JOIN pedido_cliente pc ON p.referenciaPC = pc.referenciaPC WHERE pc.idCliente = $idCliente";
$result2 = mysqli_query($conexion, $sql2);

// Consulta 3
$sql3 = "SELECT pr.nombre, pd.referenciaPD, pd.cantPD, pd.precioPD, pd.totalPD FROM pedido_datos pd JOIN pedido p ON pd.referenciaPD = p.referenciaPD JOIN pedido_cliente pc ON p.referenciaPC = pc.referenciaPC JOIN productos pr ON pd.idProductos = pr.id WHERE pc.idCliente = $idCliente";
$result3 = mysqli_query($conexion, $sql3);
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
            background-color: gold;
            padding: 15px;
            /* Aumenta el espacio alrededor del texto */
            text-align: center;
            /* Alinea el texto al centro */
            font-family: 'Arial', sans-serif;
            /* Cambia la fuente del texto */
            font-size: 18px;
            /* Cambia el tamaño del texto */
            color: #333;
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
    <!-- Navigation-->
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="./">TechBox</a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <span class="navbar-text">
                                Bienvenido <?php echo $nombreCliente; ?> (ID: <?php echo $idCliente; ?>)
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">PEDIDO REALIZADOS</h1>
            </div>
        </div>
    </header>

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
        <?php while ($row = mysqli_fetch_assoc($result2)) : ?>
            <tr>
                <td><?= $row['idpedido'] ?></td>
                <td><?= $row['referenciaPC'] ?></td>
                <td><?= $row['referenciaPD'] ?></td>
                <td><?= $row['medioPago'] ?></td>
                <td><?= $row['TotalFinal'] ?></td>
                <td><?= $row['tipoEnvio'] ?></td>
                <td><?= $row['fechaPedido'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
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
        <?php while ($row = mysqli_fetch_assoc($result1)) : ?>
            <tr>
                <td><?= $row['referenciaPC'] ?></td>
                <td><?= $row['nombre'] ?></td>
                <td><?= $row['apellido'] ?></td>
                <td><?= $row['localizacion'] ?></td>
                <td><?= $row['telefono'] ?></td>
                <td><?= $row['correo'] ?></td>
            </tr>
        <?php endwhile; ?>
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
        <?php while ($row = mysqli_fetch_assoc($result3)) : ?>
            <tr>
                <td><?= $row['nombre'] ?></td>
                <td><?= $row['referenciaPD'] ?></td>
                <td><?= $row['cantPD'] ?></td>
                <td><?= $row['precioPD'] ?></td>
                <td><?= $row['totalPD'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <!-- Footer-->
    <?php include("admin/includes/footer.php"); ?>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Core theme JS-->
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>