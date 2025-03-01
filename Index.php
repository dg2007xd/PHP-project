<?php require 'db.php'; 
session_start();
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Markazi+Text:wght@400..700&family=Reddit+Sans:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
    <title>LUNA-STORE</title>
    <link rel="stylesheet" href="css/styles.css">  
</head>
<body>

    <!-- header.php -->
    <?php include 'header.php'; ?>

    <!-- CAROUSEL -->
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="img/banner1.jpg" class="d-block w-100 h-75" alt="Primer banner">
          </div>
          <div class="carousel-item">
            <img src="img/banner2.jpg" class="d-block w-100 h-75" alt="Segundo banner">
          </div>
          <div class="carousel-item">
            <img src="img/banner3.jpg" class="d-block w-100 h-75" alt="Tercer banner">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

    <!-- MAIN-TEXT -->
    <div class="container mt-4 mb-4" style="font-family: Reddit Sans">
        <h1>¡¡Bienvenidooos!!</h1>
        <h3>Tu tienda online de confianza para consentir a tu mascota.</h3>
        <p>En Luna-Store sabemos lo importante que es el bienestar de tu mejor amigo. Por eso, ofrecemos una amplia variedad de productos de alta calidad para que tu mascota disfrute de lo mejor: desde alimentos nutritivos, juguetes divertidos, hasta accesorios cómodos y seguros. ¡Todo lo que necesitas para hacer feliz a tu mascota está aquí!</p>
        
        
    </div>

    <div class="container mt-4 mb-4 text-center" style="font-family: Reddit Sans">
        <h2 class="mb-5">Buscas adoptar??</h2>

        <div class="row">

            <div class="col-md-4 ">
                <h3>Max</h3>
                <img class="img-fluid mb-3" src="img/perro1.jpg" alt="Perrito">
                <p>Este precioso machito de raza Husky, de solo 7 meses, está buscando un hogar responsable en Cercado de Lima. Ya está vacunado y desparasitado, listo para ser parte de una familia que lo ame y lo cuide.</p>
                <a href="https://www.facebook.com/groups/484216362974105/permalink/1550288889700175/"><button class="btn btn-info"><b>Contáctate</b></button></a>
            </div>
            <div class="col-md-4">
                <h3>Niebla</h3>
                <img class="img-fluid mb-3" src="img/gato.jpg" alt="Gatito">
                <p>Esta preciosa gatita, necesita urgentemente una familia que la ame y la cuide. Su dueña ya no puede hacerse cargo de ella, y corre el riesgo de quedarse sin un hogar. Es muy dócil y ya está acostumbrada a comer de todo, lista para adaptarse a un nuevo entorno.</p>
                <a href="https://www.facebook.com/groups/600758388278080/permalink/875052814181968/"><button class="btn btn-info"><b>Contáctate</b></button></a>
            </div>
            <div class="col-md-4">
                <h3>Luna</h3>
                <img class="img-fluid mb-3" src="img/perro2.jpg" alt="Perrita">
                <p>Esta hermosa perrita fue encontrada el lunes y necesita tu ayuda. Es una hembra con un precioso pelaje de tonos mostaza, marrón y negro. Su carácter es dulce y muy tranquila, siempre buscando cariño y compañía. A pesar de su bondad, se encuentra en una situación delicada: está flaquita y necesita cuidados.</p>
                <a href="https://www.facebook.com/groups/484216362974105/permalink/1548778729851191/"><button class="btn btn-info"><b>Contáctate</b></button></a>
            </div>

        </div>
    </div>

    <!-- footer.php -->
    <?php include 'footer.php'; ?>
    <?php
    //Cerrar la conexion
    $conn -> close();
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>