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

    // Agregar la referencia
    $str = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyx123456789";
    $password = "";
    for ($i = 0; $i < 5; $i++) {
        $password .= substr($str, rand(0, 64), 1);
    }
    $referenciaPC = $password;

    $queryCliente = "INSERT INTO `card`.`pedido_cliente` (idCliente, referenciaPC, nombre, apellido, localizacion, correo, telefono) 
                     VALUES ('$idCliente', '$referenciaPC', '$nombre', '$apellido', '$localizacion', '$correo', '$telefono')";

    if (mysqli_query($conexion, $queryCliente)) {
        // Agregar la referencia
        $str1 = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyx123456789";
        $password1 = "";
        for ($i = 0; $i < 5; $i++) {
            $password1 .= substr($str1, rand(0, 64), 1);
        }
        $referenciaPD = $password1;


        foreach ($productos as $producto) {
            $idProducto = mysqli_real_escape_string($conexion, $producto["id"]);
            $cantidad = mysqli_real_escape_string($conexion, $producto["cantidad"]);
            $precio = mysqli_real_escape_string($conexion, $producto["precio"]);
            $total = mysqli_real_escape_string($conexion, $producto["total"]);

            $queryProductos = "INSERT INTO `card`.`pedido_datos` (idProductos, referenciaPD, cantPD, precioPD, totalPD) 
                               VALUES ('$idProducto', '$referenciaPD', '$cantidad', '$precio', '$total')";

            if (!mysqli_query($conexion, $queryProductos)) {
                echo "Error al insertar datos en pedido_datos: " . mysqli_error($conexion);
                exit();
            }

            // Muestra los valores de cada producto
            echo "Producto - ID: $idProducto, Referencia: $referenciaPD, Cantidad: $cantidad, Precio: $precio, Total: $total\n";
        }

        echo "EXITOSO";
        exit();
        echo "Producto - ID: $idProducto, Referencia: $referenciaPD, Cantidad: $cantidad, Precio: $precio, Total: $total\n";
        exit();
    } else {
        echo "Error al realizar el pedido: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
