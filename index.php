<?php
include "modelo/conexion.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link to Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/fc3e0c09ba.js" crossorigin="anonymous"></script>
    <title>Parking UAX</title>
    <style>
        .table thead {
            background-color: #001f3f;
            color: white;
        }

        .btn-primary {
            background-color: #001f3f;
            border-color: #001f3f;
        }

        .btn-primary:hover {
            background-color: #001030;
            border-color: #001030;
        }
    </style>
</head>

<body>
    <h1 class="text-center p-3">REGISTRO VEHICULOS PARKING UAX</h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form method="POST">
                    <h3 class="text-center p-3">VEHICULO</h3>
                    <div class="mb-3">
                        <label for="marca" class="form-label">Marca</label>
                        <input type="text" class="form-control" name="marca">
                    </div>
                    <div class="mb-3">
                        <label for="modelo" class="form-label">Modelo</label>
                        <input type="text" class="form-control" name="modelo">
                    </div>
                    <div class="mb-3">
                        <label for="matricula" class="form-label">Matricula</label>
                        <input type="text" class="form-control" name="matricula">
                    </div>
                    <div class="mb-3">
                        <label for="color" class="form-label">Color</label>
                        <input type="color" class="form-control form-control-sm" name="color">
                    </div>
                    <button type="button" class="btn btn-outline-primary" name="btnregistrar" value="ok">Registrar</button>
                    <?php
                        include "modelo/conexion.php";
                        include "controlador/registro_persona.php";
                    ?>
                </form>
            </div>
            <div class="col-md-8">
                <div class="p-4">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Marca</th>
                                <th scope="col">Modelo</th>
                                <th scope="col">Matricula</th>
                                <th scope="col">Color</th>
                                <th scope="col">Editar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = $conexion->query("SELECT * FROM vehiculos");
                            while($datos = $sql->fetch_object()) { ?>
                                <tr>
                                    <th scope="row"><?php echo $datos->id; ?></th>
                                    <td><?php echo $datos->marca; ?></td>
                                    <td><?php echo $datos->modelo; ?></td>
                                    <td><?php echo $datos->matricula; ?></td>
                                    <td><?php echo $datos->color; ?></td>
                                    <td>
                                        <a href="" class="btn btn-small btn-warning"><i class="fa-solid fa-user-pen"></i></a>
                                        <a href="" class="btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Link to Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
