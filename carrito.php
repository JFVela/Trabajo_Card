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
</head>

<body>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">RESUMEN DE PEDIDO</h1>
                </div>
                <div class="modal-body">
                    <!-- FORMULARIO -->
                    <form method="post" action="config/procesar_pedido.php">

                        <!-- Agrega un campo oculto para enviar el ID del cliente -->
                        <input type="hidden" name="idCliente" value="<?php echo $idCliente; ?>">
                        <!-- FIN Agrega un campo oculto para enviar el ID del cliente -->

                        <div class="form-row">
                            <div class="col" style="margin-bottom: 5px;">
                                <input type="text" class="form-control" placeholder="Nombres" name="nombre" required>
                            </div>
                            <div class="col" style="margin-bottom: 5px;">
                                <input type="text" class="form-control" placeholder="Apellidos" name="apellido" required>
                            </div>
                            <div class="col" style="margin-bottom: 5px;">
                                <input type="text" class="form-control" placeholder="Localización" name="localizacion" required>
                            </div>
                            <div class="col" style="margin-bottom: 5px;">
                                <input type="email" class="form-control" id="email" placeholder="Correo Electrónico" name="correo" required>
                                <div class="invalid-feedback">
                                    Por favor, ingrese un correo electrónico válido.
                                </div>
                            </div>
                            <div class="col" style="margin-bottom: 5px;">
                                <input type="number" class="form-control" placeholder="Telefono" name="telefono" required>
                            </div>
                            <div class="col" style="margin-bottom: 5px;">
                                <select class="form-control" id="tipoEnvio" required>
                                    <option value="">Tipo de envío</option>
                                    <option value="1">Recoger en tienda</option>
                                    <option value="2">Delivery</option>
                                </select>

                            </div>

                            <div class="col" style="margin-bottom: 5px;">
                                <select class="form-control" id="paymentMethod" required>
                                    <option value="">Seleccione un medio de pago</option>
                                    <option value="1">BCP</option>
                                    <option value="2">PayPal</option>
                                    <option value="3">Visa</option>
                                </select>
                            </div>
                            <div class="col" style="margin-bottom: 5px; margin-right: 5px;">
                                <input type="text" class="form-control" id="cardName" placeholder="Nombre en la tarjeta" disabled required>
                            </div>
                            <div class="col" style="margin-bottom: 5px; margin-right: 5px;">
                                <input type="text" class="form-control" id="cardNumber" placeholder="Número de tarjeta de crédito" disabled required>
                            </div>

                        </div>
                        <!-- TOTAL A PAGAR -->
                        <div class="col" style="margin-bottom: 5px;">
                            <h6>Costo a Pagar S/: <span id="total_pagar_modal">0.00</span></h6>
                        </div>
                        <!-- Costo de envío -->
                        <div class="col" style="margin-bottom: 5px;">
                            <h6>Costo de envío: <span id="costo_envio">0.00</span></h6>
                        </div>
                        <!-- Costo Final -->
                        <div class="col" style="margin-bottom: 5px;">
                            <h6>Costo Final: <span id="costo_final">0.00</span></h6>
                        </div>
                        <div class="text-end"> <!-- Esto alinea el contenido a la derecha -->
                            <button type="submit" class="btn btn-primary">Finalizar Pedido</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN Modal -->

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
                <h1 class="display-4 fw-bolder">Carrito</h1>
                <p class="lead fw-normal text-white-50 mb-0">Tus Productos Agregados.</p>
            </div>
        </div>
    </header>
    <section class="py-5">
        <div class="container px-4 px-lg-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Number</th>
                                    <th>#</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Sub Total</th>
                                    <th>ACCION</th>
                                </tr>
                            </thead>
                            <tbody id="tblCarrito">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-5 ms-auto">
                    <h4>Total a Pagar S/: <span id="total_pagar">0.00</span></h4>

                    <!--Botones-->
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-success" style="margin-top: 5px;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Continuar Pedido</button>
                        <button class="btn btn-warning" type="button" id="btnVaciar">Vaciar Carrito</button>
                    </div>
                    <!--Fin de Botones-->


                    <!--Ventana Modal-->
                    <input type="checkbox" id="btn-modal">
                </div>
                <label for="btn-modal" class="cerrar-modal"></label>
            </div>
            <!--Fin de Ventana Modal-->

        </div>

        </div>
        </div>
    </section>
    <!-- Footer-->

    <?php include("admin/includes/footer.php"); ?>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Core theme JS-->
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script>
        function mostrarCarrito() {
            if (localStorage.getItem("productos") != null) {
                let array = JSON.parse(localStorage.getItem('productos'));
                if (array.length > 0) {
                    $.ajax({
                        url: 'ajax.php',
                        type: 'POST',
                        async: true,
                        data: {
                            action: 'buscar',
                            data: array
                        },
                        success: function(response) {
                            console.log(response);
                            const res = JSON.parse(response);
                            let html = '';

                            // Verificar si el array de productos no está vacío
                            if (res.datos.length > 0) {
                                res.datos.forEach((element, index) => {
                                    html += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${element.id}</td>
                            <td>${element.nombre}</td>
                            <td>${element.precio}</td>
                            <td>1</td>
                            <td>${element.precio}</td>
                            <td>
                                <button class="btn btn-danger btnEliminar" data-number="${index + 1}">Eliminar</button>
                            </td>
                        </tr>`;
                                });

                                $('#tblCarrito').html(html);
                                $('#total_pagar').text(res.total);
                                $('#total_pagar_modal').text(res.total); // Actualiza el Total a Pagar en el modal

                                // Volver a vincular eventos después de actualizar la tabla
                                $('.btnEliminar').on('click', function() {
                                    const productNumber = $(this).data('number');
                                    eliminarProducto(productNumber);
                                });
                            } else {
                                // Si el array de productos está vacío, limpiar el carrito
                                localStorage.removeItem('productos');
                                $('#tblCarrito').html('');
                                $('#total_pagar').text('0.00');
                                $('#total_pagar_modal').text('0.00'); // Actualiza el Total a Pagar en el modal
                            }

                            paypal.Buttons({
                                style: {
                                    color: 'blue',
                                    shape: 'pill',
                                    label: 'pay'
                                },
                                createOrder: function(data, actions) {
                                    return actions.order.create({
                                        purchase_units: [{
                                            amount: {
                                                value: res.total
                                            }
                                        }]
                                    });
                                },
                                onApprove: function(data, actions) {
                                    return actions.order.capture().then(function(details) {
                                        alert('Transaction completed by ' + details.payer.name.given_name);
                                    });
                                }
                            }).render('#paypal-button-container');
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                } else {
                    // Si el array de productos está vacío, limpiar el carrito
                    localStorage.removeItem('productos');
                    $('#tblCarrito').html('');
                    $('#total_pagar').text('0.00');
                }
            }
        }

        function eliminarProducto(number) {
            // Obtener el array actualizado de productos en el carrito
            let productosEnCarrito = JSON.parse(localStorage.getItem('productos')) || [];

            // Eliminar el producto del array utilizando el número de fila
            productosEnCarrito.splice(number - 1, 1);

            // Guardar el array actualizado en el localStorage
            localStorage.setItem('productos', JSON.stringify(productosEnCarrito));

            // Volver a cargar el carrito después de eliminar
            mostrarCarrito();
        }
        $(document).ready(function() {
            mostrarCarrito();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#paymentMethod').change(function() {
                if ($(this).val() !== '') {
                    $('#cardName, #cardNumber').prop('disabled', false);
                } else {
                    $('#cardName, #cardNumber').prop('disabled', true);
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#tipoEnvio').change(function() {
                // Obtener el valor seleccionado del tipo de envío
                var tipoEnvio = $(this).val();

                // Actualizar el costo de envío y el costo final según el tipo de envío
                var costoEnvio = tipoEnvio === '2' ? 15.00 : 0.00; // 2 representa Delivery
                var costoPagar = parseFloat($('#total_pagar_modal').text());
                var costoFinal = costoPagar + costoEnvio;

                // Actualizar los valores en el HTML
                $('#costo_envio').text(costoEnvio.toFixed(2));
                $('#costo_final').text(costoFinal.toFixed(2));
            });
        });
    </script>
</body>

</html>