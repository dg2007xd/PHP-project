<?php
session_start();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<!-- Inicio Header -->
<?php
    include 'header.php';
    ?>

    <div class="container mt-4 mb-4">
        <h2>Horarios de atención</h2>
        <div class="card" style="width: 18rem;">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Lunes a sabados. 8am - 9pm</li>
                <li class="list-group-item">Domingo 8am - 5pm </li>
            </ul>   
        </div>
    </div>

    <div class="container mt-4 mb-4">
        <h2 class="mb-5">¿Problemas o dudas?, consulte aca :)</h2>
        <iframe class="img-fluid" style="min-height: 450px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3901.2692577547627!2d-77.05290427254499!3d-12.093710308158405!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c9aa6b702e0f%3A0x55c71153c8c3bda4!2sISIL%20-%20San%20Isidro!5e0!3m2!1ses!2spe!4v1728500745451!5m2!1ses!2spe" width="1300" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>


    <div class="container mt-4 mb-4 text-center">
        <h2 class="mb-5">Conoce alguno de nuestros locales</h2>

        <div class="row">

            <div class="col-md-4 ">
                <h3>Luna Store Lima</h3>
                <img class="img-fluid mb-3" src="img/imagenreferencia.jpg" alt="Perrito">
                <p>Av. Los Olivos 123, Lima</p>
                <p>LLamanos: 555123456</p>
                <a href="mailto:lima@lunastore.com">Escribenos al correo</a>
            </div>
            <div class="col-md-4">
                <h3>Luna Store Arequipa</h3>
                <img class="img-fluid mb-3" src="img/imagenreferencia2.jpg" alt="Gatito">
                <p>Av. Principal 456, Arequipa</p>
                <p>LLamanos: 555654321</p>
                <a href="mailto:arequipa@lunastore.com">Escribenos al correo</a>
            </div>
            <div class="col-md-4">
                <h3>Luna Store Cusco</h3>
                <img class="img-fluid mb-3" src="img/imagenreferencia3.jpg" alt="Perrita">
                <p>Calle Real 789, Cusco</p>
                <p>LLamanos: 555987654</p>
                <a href="mailto:cusco@lunastore.com">Escribenos al correo</a>
            </div>

        </div>
    </div>


    <!-- Inicio Footer -->
    <?php
    include 'footer.php';
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>