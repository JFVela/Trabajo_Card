<?php
require_once "config/conexion.php";

if (isset($_POST['action']) && $_POST['action'] == 'buscar' && isset($_POST['data'])) {
    $array['datos'] = array();
    $total = 0;

    foreach ($_POST['data'] as $producto) {
        $id = intval($producto['id']);

        // Validación de datos
        if ($id > 0) {
            $query = mysqli_query($conexion, "SELECT * FROM productos WHERE id = $id");

            if ($query && $result = mysqli_fetch_assoc($query)) {
                $data['id'] = $result['id'];
                $data['precio'] = $result['precio_rebajado'];
                $data['nombre'] = $result['nombre'];
                $total += $result['precio_rebajado'];
                $array['datos'][] = $data;
            } else {
                // Manejo de error si la consulta falla
                $array['error'] = "Error al obtener detalles del producto.";
            }
        } else {
            // Manejo de error si el ID del producto no es válido
            $array['error'] = "ID de producto no válido.";
        }
    }

    $array['total'] = $total;
    echo json_encode($array);
    die();
} else {
    // Manejo de error si no se reciben datos esperados
    echo json_encode(['error' => 'Datos no válidos recibidos.']);
    die();
}
?>
