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

// Comprobar si el formulario se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopila los datos del formulario
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $sexo = $_POST["sexo"];
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];
    $ubicacion = $_POST["ubicacion"];

    // Verificar si el correo ya existe
    $consulta_correo = "SELECT * FROM cliente WHERE correo = '$correo'";
    $resultado_correo = mysqli_query($conexion, $consulta_correo);

    if (mysqli_num_rows($resultado_correo) > 0) {
        echo '<script>
        alert("Correo electrónico ya registrado");
        window.location.href = "../createUsuario.php";
      </script>';
    } else {
        // Realiza la inserción en la base de datos
        $query = "INSERT INTO cliente (nombre, apellido, sexo, correo, contraseña, ubicacion) VALUES ('$nombre', '$apellido', '$sexo', '$correo', '$contrasena', '$ubicacion')";

        if (mysqli_query($conexion, $query)) {
            // Registro exitoso, redirige a index.php
            echo '<script>
            alert("Usuario Registrado con Éxito");
            window.location.href = "../index.php";
          </script>';
        } else {
            echo "Error al registrar: " . mysqli_error($conexion);
        }
    }

    // Cierra la conexión
    mysqli_close($conexion);
}
