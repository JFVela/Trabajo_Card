<?php
// Iniciar la sesión
session_start();

// Desconfigurar todas las variables de sesión
$_SESSION = array();

// Destruir la sesión
session_destroy();

// Redireccionar a la página de inicio o a donde desees después de cerrar sesión
// Limpiar el carrito en el localStorage
echo "<script>
        localStorage.removeItem('productos');
        window.location.href = '../index.php?cartCleared=true';
      </script>";
?>
