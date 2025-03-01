<?php
//Configuracion de la conexion a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "luna_store";

//Crear conexion
$conn = new mysqli($servername, $username, $password, $dbname);

//Verificar conexion
if ($conn -> connect_error){
  die("Conexion fallida" . $conn -> connect_error);
}

//Consulta SQL para obtener los nombres, puestos y telefono de los empleados
$sql = "SELECT nombre, puesto, telefono FROM empleados";
$result = $conn -> query($sql);


//Consulta SQL para obtener el nombre, precio y descripcion de los productos
$sql2 = "SELECT nombre, precio, descripcion FROM productos";
$result2 = $conn -> query($sql2);


//Consulta SQL para obtener el nombre, direccion, telefono y email de las sucursales
$sql3 = "SELECT nombre, direccion, telefono, email FROM sucursales";
$result3 = $conn -> query($sql3);


?>
