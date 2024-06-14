<?php
include "modelo/conexion.php";
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

// Mostrar todos los errores de PHP para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = $marca = $modelo = $matricula = $color = "";
$editing = false;

// Manejar la solicitud de edición
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $conexion->query("SELECT * FROM vehiculos WHERE id=$id") or die($conexion->error);
    if ($result->num_rows) {
        $row = $result->fetch_array();
        $marca = $row['marca'];
        $modelo = $row['modelo'];
        $matricula = $row['matricula'];
        $color = $row['color'];
        $editing = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/fc3e0c09ba.js" crossorigin="anonymous"></script>
    <title>Parking UAX</title>
    <style>
        body {
            background-color: #e7b806;
        }
        .nav-tabs .nav-link.active {
            background-color: #007bff;
            color: white;
        }
        .header {
            text-align: center;
            margin-top: 20px;
        }
        .bg-light-yellow {
            background-color: #fffde7;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .color-box {
            width: 20px;
            height: 20px;
            display: inline-block;
            border: 1px solid #000;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center p-3">REGISTRO VEHICULOS PARKING UAX</h1>
        <div class="row justify-content-center">
            <div class="col-md-4 bg-light-yellow">
                <?php
                if (isset($_SESSION['error'])) {
                    echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                    unset($_SESSION['error']); // Borrar el mensaje después de mostrarlo
                }
                if (isset($_SESSION['success'])) {
                    echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
                    unset($_SESSION['success']); // Borrar el mensaje después de mostrarlo
                }
                ?>
                <form class="" method="POST" action="<?= $editing ? 'controlador/modificar_vehiculo.php' : 'controlador/registro_vehiculo.php' ?>">
                    <h3 class="text-center p-3"><?= $editing ? 'ACTUALIZAR' : 'REGISTRAR' ?> VEHICULO</h3>
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="mb-3">
                        <label for="marca" class="form-label">Marca</label>
                        <input type="text" class="form-control" name="marca" value="<?= $marca ?>">
                    </div>
                    <div class="mb-3">
                        <label for="modelo" class="form-label">Modelo</label>
                        <input type="text" class="form-control" name="modelo" value="<?= $modelo ?>">
                    </div>
                    <div class="mb-3">
                        <label for="matricula" class="form-label">Matricula</label>
                        <input type="text" class="form-control" name="matricula" value="<?= $matricula ?>">
                    </div>
                    <div class="mb-3">
                        <label for="color" class="form-label">Color</label>
                        <input type="color" class="form-control form-control-sm" name="color" value="<?= $color ?>">
                    </div>
                    <button type="submit" class="btn btn-outline-primary" name="<?= $editing ? 'btn_actualizar' : 'registrar' ?>" value="ok">
                        <?= $editing ? 'Actualizar' : 'Registrar' ?>
                    </button>
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
                            while ($datos = $sql->fetch_object()) { ?>
                                <tr>
                                    <th scope="row"><?php echo $datos->id; ?></th>
                                    <td><?php echo $datos->marca; ?></td>
                                    <td><?php echo $datos->modelo; ?></td>
                                    <td><?php echo $datos->matricula; ?></td>
                                    <td><div class="color-box" style="background-color: <?php echo $datos->color; ?>;"></div></td>
                                    <td>
                                        <a href="index.php?edit=<?php echo $datos->id; ?>" class="btn btn-small btn-warning"><i class="fa-solid fa-user-pen"></i></a>
                                        <a href="controlador/eliminar_vehiculo.php?id=<?php echo $datos->id; ?>" class="btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>
</html>
