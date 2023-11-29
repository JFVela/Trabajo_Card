<?php
require_once "../config/conexion.php";
?>
<?php
session_start();
// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Realizar una consulta SQL para verificar el correo y la contraseña en la base de datos
    $query = "SELECT id_cliente, nombre, apellido FROM cliente WHERE correo = ? AND contraseña = ?";
    $stmt = mysqli_prepare($conexion, $query);
    
    // Bind de los parámetros
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);
    
    // Ejecución de la consulta preparada
    mysqli_stmt_execute($stmt);
    
    // Obtención de los resultados
    mysqli_stmt_store_result($stmt);
    
    // Verificar si se encontró un registro que coincida
    if (mysqli_stmt_num_rows($stmt) > 0) {
        // Inicio de sesión exitoso
        $_SESSION["loggedin"] = true;
        
        // Obtener los datos del usuario
        mysqli_stmt_bind_result($stmt, $id_cliente, $nombre, $apellido);
        mysqli_stmt_fetch($stmt);

        // Almacenar información del usuario en la sesión
        $_SESSION["id_cliente"] = $id_cliente;
        $_SESSION["nombre"] = $nombre;
        $_SESSION["apellido"] = $apellido;

        header("Location: ../index.php");
    } else {
        $_SESSION['error_message'] = "Correo o contraseña no encontrada.";
        header("Location: ../login.php");
    }
    mysqli_stmt_close($stmt);
}
?>
