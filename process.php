<?php
require 'db.php';
session_start();

//Obtener los datos enviados a través del FORM con POST
$user = $_POST['user']; 
$pass = $_POST['pass']; 

//Crear la consulta a la BD
$sql = "SELECT username, password FROM users WHERE username='$user' AND password='$pass' ";
$result = $conn->query($sql);

//Validar los consulta de usuarios
if ($result-> num_rows > 0){
    //Usuario existe
    $_SESSION['user'] = $user;
    header("Location: bienvenido.php");
} else {
    //Usuario o datos incorrectos
    $_SESSION['error'] = "EL usuario y/o la contraseña ingresada son incorrectos";
    header("Location: login.php");
}

//Cerrar la conexión a la base de datos
$conn = close();

?>