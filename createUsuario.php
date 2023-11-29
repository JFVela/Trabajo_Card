<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>

<body>
    <!-- Section: Design Block -->
    <section class="text-center text-lg-start">
        <style>
            .cascading-right {
                margin-right: -50px;
            }

            @media (max-width: 900.98px) {
                .cascading-right {
                    margin-right: 0;
                }
            }
        </style>

        <!-- Jumbotron -->
        <div class="container py-4">
            <div class="row g-0 align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="card cascading-right" style="
            background: hsla(0, 0%, 100%, 0.55);
            backdrop-filter: blur(30px);
            ">
                        <div class="card-body p-5 shadow-5 text-center">
                            <!--BOTONES-->
                            <div class="d-grid gap-2 d-md-block">
                                <a href="index.php" class="btn btn-warning" type="button">Volver a inicio</a> 
                                <a href="login.php" class="btn btn-warning" type="button">Iniciar sección</a>
                            </div>
                            <h2 class="fw-bold mb-5">Create una cuenta ahora!</h2>
                            <form id="signupForm" action="config/create.php" method="post">
                                <!-- 2 column grid layout with text inputs for the first and last names -->
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="validationCustom01" class="form-label">Nombre</label>
                                        <input name="nombre" type="text" class="form-control" id="validationCustom01" value="" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="validationCustom02" class="form-label">Apellido</label>
                                        <input name="apellido" type="text" class="form-control" id="validationCustom02" value="" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>

                                <!-- genero input -->
                                <div class="form-outline mb-4">
                                    <label for="validationDefault03" class="form-label">Género</label>
                                    <select name="sexo" class="form-select" id="validationDefault03" required>
                                        <option selected disabled value="">Elije tu género...</option>
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                        <option value="Prefiero no decirlo">Otro</option>
                                    </select>
                                </div>

                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="validationDefault04">Correo Electrónico</label>
                                    <input name="correo" type="email" id="validationDefault04" class="form-control" value="" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="validationDefault05">Crear Contraseña</label>
                                    <input name="contrasena" type="password" id="validationDefault05" class="form-control" value="" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>

                                <!-- ubicacion input -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="validationDefault06">Ubicación</label>
                                    <input type="text" id="validationDefault06" class="form-control" name="ubicacion" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>

                                <!-- Checkbox -->
                                <div class="form-check d-flex justify-content-center mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                                        <label class="form-check-label" for="invalidCheck2">
                                            Acepto los terminos y condiciones
                                        </label>
                                    </div>
                                </div>

                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary btn-block mb-4">
                                    Aceptar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0">
                    <img src="https://th.bing.com/th/id/OIG..dajv1W3o4w2t43kkBu1?pid=ImgGn&w=1024&h=1024&rs=1" class="w-100 rounded-4 shadow-4" alt="" />
                </div>
            </div>
        </div>

        <!-- Jumbotron -->
    </section>
    <!-- Section: Design Block -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>