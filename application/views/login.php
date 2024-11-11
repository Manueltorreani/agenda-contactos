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
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1>Todo CI</h1>
                <?php
                if ($this->session->flashdata("OP")) {
                    switch ($this->session->flashdata("OP")) {
                        case "Inactivo":
                            ?>
                            <div class="alert alert-success" role="alert">El Usuario esta inactivo</div>
                            <?php
                            break;
                        case "Incorrecto":
                            ?>
                            <div class="alert alert-danger" role="alert">Usuario incorrecto</div>
                            <?php
                            break;
                        case "Salio":
                            ?>
                            <div class="alert alert-info" role="alert">Salio de su sesion</div>
                            <?php
                            break;
                        case "Prohibido":
                            ?>
                            <div class="alert alert-info" role="alert">Salio de su sesion</div>
                            <?php
                            break;
                    }



                }
                ?>

                <br>
                <div class="card">
                    <div class="card-body">
                        <?php echo validation_errors("<p>", "</p>"); ?>
                        <form method="post" action="<?php echo site_url("auth/login") ?>">
                            <!-- base_url para accerder a archivos, site_url para ejecutar -->
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Usuario:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    aria-describedby="emailHelp">
                            </div>
                            <button type="submit" class="btn btn-primary">Ingresar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>