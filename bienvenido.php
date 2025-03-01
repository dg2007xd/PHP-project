<?php
session_start();

//Código que valida si existe una sesión abierta
if(!isset ($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>  

    <!-- INICIO HEADER -->
    <?php
    include 'header.php';
    ?>
    <!-- FIN HEADER -->

    <div class="container">
    <h2>¡Hola, <?php echo ($_SESSION['user']); ?>!</h2>

        <p>¡Es bueno verte otra vez :), ten un buen dia!</p>
        
    </div>

    <div class="row text-center mt-4 mb-4">

        <div class="col-4">
            <img src="img/empleados.png" class="img-fluid" width="100" alt="">
            <h3><a href="gestionar_empleados.php">Gestionar Empleados</a></h3>
        </div>

        <div class="col-4">
            <img src="img/proyectos.png" class="img-fluid" width="100" alt="">
            <h3><a href="gestionar_productos.php">Gestionar Productos</a></h3>
        </div>

        <div class="col-4">
            <img src="img/departamentos.png" class="img-fluid" width="100" alt="">
            <h3><a href="gestionar_sucursales.php">Gestionar Sucursales</a></h3>
        </div>

    </div>


    <!-- INICIO FOOTER -->
    <?php
    include 'footer.php';
    ?>
    <!-- FINI FOOTER -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>  
</body>
</html>