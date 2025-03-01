<?php
session_start();

//Código que valida si existe una sesión abierta
if(isset ($_SESSION['user'])){
    header("Location: bienvenido.php");
    exit();
}

//Capturar el mensaje de error si existe
$error = '';
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']); // Limpiar el mensaje de error después de mostrarlo
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">  
   <!-- HOJA DE ESTILO DE BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- BoxIcons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  

</head>
<body>
    
    <!-- INICIO HEADER -->
    <?php
    include 'header.php';
    ?>
    <!-- FIN HEADER -->

    <div class="container text-center mt-4 mb-4">
        <h2>LOGIN</h2>
        <p>Ingresa tus datos para entrar al sistema</p>
    </div>

    <div class="container">
        <!-- Mostrar alerta si hay un error --> 
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger text-center">
                <p> <?php echo "$error"; ?> </p>
            </div>


        <?php endif; ?>


        <form action="process.php" method="POST" >

            <div class="form-group">
                <label class="col-form-label">Usuario:</label>
                <input name="user" class="form-control" type="text" required> 
            </div>

            <div class="form-group">
                <label class="col-form-label">Contraseña:</label>
                <input id="pass" name="pass" class="form-control" type="password" required>
                <div class="ojo">
                    <i class="bx bx-show-alt"></i>
                </div>
            </div>

            <div class="form-group mt-2 mb-2">
                <input type="checkbox">Recordar cuenta
            </div>

            <input class="btn btn-dark mt-2 mb-2" type="submit" value="Ingresar">

            <p class="text-center">¿Todavia no tienes una cuenta?? <strong> <ins> <a href="registro.php">¡Registrate Ahora!</a> </ins> </strong> </p>
    
        </form>
    </div>


    <!-- INICIO FOOTER -->
     <?php
    include 'footer.php';
    ?>
    <!-- FINI FOOTER -->


    <script>
        const pass = document.getElementById("pass"),
              icon = document.querySelector(".bx");
        icon.addEventListener("click", e => {
        if (pass.type === "password") {
            pass.type = "text";
            icon.classList.remove('bx-show-alt')
            icon.classList.add('bx-hide')
        } else{
            pass.type = "password";
            icon.classList.add('bx-show-alt')
            icon.classList.remove('bx-hide')
        }
        })

    </script>

    <!-- JS BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>  
</body>
</html>