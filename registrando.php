<?php
require 'db.php';
session_start();

//Obtener los datos enviados a través del FORM con POST
$user = $_POST['user']; 
$email = $_POST['email'];
$pass = $_POST['pass']; 

//Verificar si existe el correo y/o usuario
$sqlVerificar = "SELECT * FROM users WHERE username = '$user' OR email='$email' ";
$resultVerificar = $conn->query($sqlVerificar);

if($resultVerificar -> num_rows > 0){
    //Usuario o datos incorrectos
    $_SESSION['error'] = "EL usuario y/o la contraseña ya se encuentran registrados";
    header("Location: registro.php");
} else{
    //No existe usuario ni correo registrado
    $sqlInsertar = "INSERT INTO users (username, email, password) VALUES ('$user', '$email', '$pass')";
    $resultInsertar = $conn->query($sqlInsertar);

    if($resultInsertar === TRUE){
        //Se registro con exito
        echo "
        <script>
        window.location.href='gracias.php';
        </script>";
    } else {
        //Problema al crear la cuenta
        echo "No se pudo crear tu cuenta";
    }
}

?>