<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Todo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <?php
    $this->load->view("menu");
    ?>
    <br>
    <br>
    <div class="container">
        <div class="d-md-flex justify-content-md-end">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregarModel">Agregar</button>

            <!-- Modal -->
           <div class="modal fade" id="agregarModel" tabindex="-1" aria-labelledby="agregarModelLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="agregarModelLabel">Agregar Nuevo Usuario</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Formulario para agregar usuario -->
                        <form action="<?= site_url('usuarios/nuevo'); ?>" method="POST" id="agregarUsuarioForm">
                            <div class="modal-body">
                                <!-- Campo Nombre -->
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>

                                <!-- Campo Contraseña -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password2" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" id="password2" required>
                                </div>

                                <!-- Campo Rol -->
                                <div class="mb-3">
                                    <label for="rol" class="form-label">Rol</label>
                                    <select class="form-select" id="rol" name="rol" required>
                                        <option value="1">Admin</option>
                                        <option value="2">Usuario</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Botones del Modal -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <table class="table table-hover table-striped ">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Estado</th>
                    <th scope="col">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario) { ?>
                    <tr>
                        <td><?= $usuario['usuario_id']; ?></td>
                        <td><?= $usuario['nombre']; ?></td>
                        <td>
                            <?php if ($usuario['rol_id'] == 1) {
                                echo ("Admin");
                            } else {
                                echo ("Usuario");
                            } ?>
                        </td>
                        <td>
                            <?php if ($usuario['estado'] == 0) {
                                echo ("Inactivo");
                            } else {
                                echo ("Activo");
                            } ?>
                        </td>
                        <td>
                            <?php if ($usuario['estado'] == 0) { ?>
                                <a href="<?= site_url("usuarios/reactivar/" . $usuario['usuario_id']) ?>"><i class="bi bi-arrow-up-square"></i></a>
                            <?php } else { ?>
                                <a href="<?= site_url("usuarios/borrar/" . $usuario['usuario_id']) ?>"> <i class="bi bi-trash"></i></a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js"
        integrity="sha512-oVbWSv2O4y1UzvExJMHaHcaib4wsBMS5tEP3/YkMP6GmkwRJAa79Jwsv+Y/w7w2Vb/98/Xhvck10LyJweB8Jsw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            // Capturar el evento de envío del formulario
            $("#agregarUsuarioForm").on('submit',function(e) {
                e.preventDefault(); // Evitar el envío del formulario tradicional

                // Obtener los valores de las contraseñas
                var password = $("#password").val();
                var password2 = $("#password2").val();

                // Verificar que ambas contraseñas sean iguales
                if (password !== password2) {
                    // Mostrar alerta con Bootbox si las contraseñas no coinciden
                    bootbox.alert({
                        title: "Error",
                        message: "Las contraseñas no coinciden. Por favor, verifica e intenta de nuevo.",
                        backdrop: true
                    });
                } else {
                    this.submit();
                }
            });
        });
    </script>

</body>

</html>