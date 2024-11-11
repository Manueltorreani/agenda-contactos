<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contactos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <?php
    $this->load->view("menu");
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <br>
                <?php
                if ($this->session->flashdata("OP")) {
                    switch ($this->session->flashdata("OP")) {
                        case "Agregado":
                            ?>
                            <div class="alert alert-success" role="alert">Contacto agregado</div>
                            <?php
                            break;
                        case "Borrado":
                            ?>
                            <div class="alert alert-danger" role="alert">Contacto borrado</div>
                            <?php
                            break;
                        case "Actualizado":
                            ?>
                            <div class="alert alert-info" role="alert">Contacto actualizado</div>
                            <?php
                            break;
                    }
                }
                ?>
                <br>
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="<?php echo site_url("contactos/agregar") ?>">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="apellido" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" required>
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Número de Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar Contacto</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <?php if (count($contactos)) { ?>
                    <ul class="list-group">
                        <?php foreach ($contactos as $c) { ?>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <span class="fw-bold"><?php echo $c["nombre"] . " " . $c["apellido"]; ?></span>
                                    <div><i class="bi bi-telephone-fill"></i> <?php echo $c["telefono"]; ?></div>
                                    <div><i class="bi bi-envelope-fill"></i> <?php echo $c["email"]; ?></div>
                                </div>
                                <a href="<?php echo site_url("contactos/borrar/" . $c["contacto_id"]); ?>"
                                    class="btn btn-danger btn-sm borrar" title="Borrar"><i class="bi bi-trash3-fill"></i></a>
                                <a href="<?php echo site_url("contactos/modificar/" . $c["contacto_id"]); ?>"
                                    class="btn btn-info btn-sm" title="Editar"><i class="bi bi-pencil-fill"></i></a>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } else { ?>
                    <div class="alert alert-primary" role="alert">
                        <strong>Info: </strong> No hay contactos registrados
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js"
        integrity="sha512-oVbWSv2O4y1UzvExJMHaHcaib4wsBMS5tEP3/YkMP6GmkwRJAa79Jwsv+Y/w7w2Vb/98/Xhvck10LyJweB8Jsw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(".borrar").click(function (e) {
            e.preventDefault();
            var dir = $(this).prop("href"); 
            bootbox.confirm('¿Estás seguro de que deseas borrar este contacto?',
                function (resultado) {
                    if (resultado) {
                        location.href = dir;
                    }
                });
        });
    </script>
</body>

</html>
