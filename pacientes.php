<?php

    $txtname = $_POST['txtname'];
    $txtlastname = $_POST['txtlastname'];
    $numedad = $_POST['numedad'];
    $txtsex = $_POST['txtsex'];
    $numalt = $_POST['numalt'];
    $numpeso = $_POST['numpeso'];
    $txtblood = $_POST['txtblood'];
    $txtExtra = $_POST['txtExtra'];
    $txtcorreo = $_POST['txtcorreo'];
    $telefono = $_POST['telefono'];

    if(!empty($txtname) || !empty($txtlastname) || !empty($numedad) || !empty($txtsex) || !empty($numalt) || !empty($numpeso) || !empty($txtblood) || !empty($txtExtra) || !empty($txtcorreo)) {
        $host = "localhost";
        $dbusername = "root";
        $dbpass = "";
        $dbname = "db_hadaf";

        $conn = new mysqli($host, $dbusername, $dbpass, $dbname);
        if(mysqli_connect_error()) {
            die('connect error('.mysqli_connect_errno().')'.mysqli_connect_error());
        }
        else {
            $SELECT = "SELECT telefono from tbl_pacientes where telefono = ? limit 1";
            $INSERT = "INSERT INTO tbl_pacientes (nombre,apellido,edad,sexo,altura,peso,sangre,extra,correo,telefono) values (?,?,?,?,?,?,?,?,?,?)";

            $stmt = $conn->prepare($SELECT);
            $stmt->bind_param("i", $telefono);
            $stmt->execute();
            $stmt->bind_result($telefono);
            $stmt->store_result();
            $rnum = $stmt->$num_rows;
            if($rnum == 0) {
                $stmt -> close();
                $stmt = $conn->prepare($INSERT);
                $stmt ->bind_param("ssisiisssi", $txtname, $txtlastname, $numedad, $txtsex, $numalt, $numpeso, $txtblood, $txtExtra, $txtcorreo, $telefono);
                $stmt->execute();
                echo "Registro completado";
            }
            else {
                echo "Alguien ya registro ese numero";
            }
            $stmt->close();
            $conn->close();
        }
    }
    else {
        echo "Todos los datos son obligatorios";
        die();
    }
?>
