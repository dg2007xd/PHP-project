<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-info p-3">
    <div class="container-fluid">
        <a class="navbar-brand" href="#" style="font-family: Pacifico; font-size: 25px">Luna-Store</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="index.php"><b>Inicio</b></a>
                <a class="nav-link" href="empleados.php"><b>Empleados</b></a>
                <a class="nav-link" href="productos.php"><b>Productos</b></a>
                <a class="nav-link" href="sucursales.php"><b>Sucursales</b></a>
                <a class="nav-link" href="contacto.php"><b>Contacto</b></a>
                <a class="nav-link text-danger" href="login.php"><b>Cuenta</b></a>
            </div>
        </div>

        <!-- Seccion de Usuario conectado -->
        <?php if (isset($_SESSION['user'])): ?>
        <img class="avatar" src="img/avatar.png" alt="">
        <span >Bienvenido, <?php echo ($_SESSION['user']); ?> - </span>
        <span style="padding-left: 5px"> <a href="logout.php">Cerrar sesion</a> </span>

        <?php endif; ?>

    </div>
</nav>
