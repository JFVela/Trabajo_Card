<?php
$host = "localhost";
$user = "root";
$clave = "";
$bd = "card";
$conexion = mysqli_connect($host, $user, $clave, $bd);

if (mysqli_connect_errno()) {
    echo "No se pudo conectar a la base de datos";
    exit();
}

mysqli_select_db($conexion, $bd) or die("No se encuentra la base de datos");
mysqli_set_charset($conexion, "utf8");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idCliente = mysqli_real_escape_string($conexion, $_POST["idCliente"]);
    $nombre = mysqli_real_escape_string($conexion, $_POST["nombre"]);
    $apellido = mysqli_real_escape_string($conexion, $_POST["apellido"]);
    $localizacion = mysqli_real_escape_string($conexion, $_POST["localizacion"]);
    $correo = mysqli_real_escape_string($conexion, $_POST["correo"]);
    $telefono = mysqli_real_escape_string($conexion, $_POST["telefono"]);
    $productos = json_decode($_POST["productos"], true);

    // Agregar la referencia para pedido_cliente
    $referenciaPC = generarReferenciaAleatoria();

    $queryCliente = "INSERT INTO `card`.`pedido_cliente` (idCliente, referenciaPC, nombre, apellido, localizacion, correo, telefono) 
                     VALUES ('$idCliente', '$referenciaPC', '$nombre', '$apellido', '$localizacion', '$correo', '$telefono')";

    if (mysqli_query($conexion, $queryCliente)) {

        // Agregar la referencia para pedido_datos
        $referenciaPD = generarReferenciaAleatoria();

        // Inicializar el acumulador de TotalFinal
        $totalFinal = 0;

        // Insertar detalles del pedido en la tabla pedido_datos
        foreach ($productos as $producto) {
            $idProducto = mysqli_real_escape_string($conexion, $producto["idProducto"]);
            $cantidadPedida = mysqli_real_escape_string($conexion, $producto["cantidad"]);
            $precio = mysqli_real_escape_string($conexion, $producto["precio"]);
            $subtotal = mysqli_real_escape_string($conexion, $producto["subtotal"]);

            // Verificar el stock disponible
            $queryStock = "SELECT cantidad FROM `productos` WHERE id = '$idProducto'";
            $resultadoStock = mysqli_query($conexion, $queryStock);

            if ($filaStock = mysqli_fetch_assoc($resultadoStock)) {
                $stockDisponible = $filaStock["cantidad"];

                // Calcular la cantidad a restar al stock (mínimo entre cantidadPedida y stockDisponible)
                $cantidadRestar = min($cantidadPedida, $stockDisponible);

                if ($cantidadRestar > 0) {
                    // Actualizar el stock en la tabla productos
                    $queryActualizarStock = "UPDATE `productos` SET cantidad = cantidad - $cantidadRestar WHERE id = '$idProducto'";
                    mysqli_query($conexion, $queryActualizarStock);

                    // Insertar detalles del pedido en la tabla pedido_datos
                    $queryProductos = "INSERT INTO `card`.`pedido_datos` (idProductos, referenciaPD, cantPD, precioPD, totalPD) 
                                       VALUES ('$idProducto', '$referenciaPD', '$cantidadRestar', '$precio', '$subtotal')";

                    if (!mysqli_query($conexion, $queryProductos)) {
                        echo "Error al insertar detalles del pedido: " . mysqli_error($conexion);
                        // Puedes agregar lógica para revertir el pedido_cliente si falla la inserción de detalles del pedido
                    }

                    // Acumular el subtotal al TotalFinal
                    $totalFinal += $subtotal;
                }
            }
        }

        // Obtener el medio de pago y tipo de envío del formulario
        $medioPago = mysqli_real_escape_string($conexion, $_POST["medioPago"]);
        $tipoEnvio = mysqli_real_escape_string($conexion, $_POST["tipoEnvio"]);

        // Agregar monto adicional por envío si el tipo de envío es "Delivery"
        if ($tipoEnvio == "Delivery") {
            $totalFinal += 15;
        }

        // Insertar en la tabla pedido
        $queryPedido = "INSERT INTO `card`.`pedido` (referenciaPC, referenciaPD, medioPago, TotalFinal, tipoEnvio) 
                        VALUES ('$referenciaPC', '$referenciaPD', '$medioPago', '$totalFinal', '$tipoEnvio')";

        if (!mysqli_query($conexion, $queryPedido)) {
            echo "Error al insertar datos del pedido: " . mysqli_error($conexion);
        }
    } else {
        echo "Error al insertar datos del cliente: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}

function generarReferenciaAleatoria()
{
    $str = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyx123456789";
    $password = "";
    for ($i = 0; $i < 5; $i++) {
        $password .= substr($str, rand(0, 64), 1);
    }
    return $password;
}
// Limpiar el carrito en el localStorage
echo "<script>
        localStorage.removeItem('productos');
        window.location.href = '../index.php?cartCleared=true';
      </script>";
exit();
?>
