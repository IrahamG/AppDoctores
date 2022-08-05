<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "db_hadaf";

$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die("Conexion fallida: ".mysqli_connect_error());
}

$usuario = $_POST["usuario"];
$password = $_POST["password"];

$query = mysqli_query($conn, "SELECT * FROM tbl_usuarios WHERE usuario = '".$usuario."' and password = '".$password."'");
$nr = mysqli_num_rows($query);

if($nr >= 1) {
    header("Location: main.html");
} else if($nr == 0) {
    header("Location: index.html");
}

?>