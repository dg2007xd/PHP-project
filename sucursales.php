<?php
require 'db.php';
session_start();

    //Variable para la busqueda
    $search = isset($_GET['search']) ? $_GET['search']: '';

    //Consulta SQL para obtener los empleados mediante el form de busqueda
    $sql = "SELECT nombre, direccion, telefono, email FROM sucursales WHERE nombre LIKE '%$search%' OR direccion LIKE '%$search%'";
    $result = $conn->query($sql);

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucursales</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<!-- Inicio Header -->
<?php
    include 'header.php';
    ?>

    <!-- Inicio Buscador Empleados -->
    <div class="container mt-4">
        <form class="d-flex">
            <input class="form-control me-2" type="search" name="search" method="GET"
            placeholder="Ingresa el nombre o dirección de la sucursal que buscas"
            value="<?php echo $search ?>">
            <input class="btn btn-outline-dark" type="submit" value="Buscar">
        </form>
    </div>
    <!-- Fin Buscador -->

    <!-- INICIO TABLA SUCURSALES -->
<div class="container mt-3">
<h2>Tabla de Sucursales</h2>

    <?php if ($result -> num_rows > 0 ) {  ?>

        <table class="table table-striped">
            
            <thead>
                <tr>
                    <th>Nombre de la Sucursal</th>
                    <th>Dirección de la Sucursal</th>
                    <th>Teléfono de la Sucursal</th>
                    <th>Email de la Sucursal</th>
                </tr>
            </thead>

            <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td> <?php echo $row["nombre"]?></td>
                    <td> <?php echo $row["direccion"]?></td>
                    <td> <?php echo $row["telefono"]?></td>
                    <td> <?php echo $row["email"]?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

    <?php  } else {
        echo "No se encontraron sucursales con los criterios de búsqueda ingresados.";
    }
    ?>

</div>
<!-- FIN TABLA SUCURSALES -->


    <!-- Inicio Footer -->
    <?php
    include 'footer.php';
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>