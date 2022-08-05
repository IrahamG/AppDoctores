<?php

    $txtname = $_POST['txtname'];
    $txtlastname = $_POST['txtlastname'];
    $fecha = $_POST['fecha'];
    $column = $_POST['column'];
    $txtcorreo = $_POST['txtcorreo'];
    $telefono = $_POST['telefono'];

    if(!empty($txtname) || !empty($txtlastname) || !empty($fecha) || !empty($column) || !empty($txtcorreo)) {
        $host = "localhost";
        $dbusername = "root";
        $dbpass = "";
        $dbname = "db_hadaf";

        $conn = new mysqli($host, $dbusername, $dbpass, $dbname);
        if(mysqli_connect_error()) {
            die('connect error('.mysqli_connect_errno().')'.mysqli_connect_error());
        }
        else {
            $SELECT = "SELECT telefono from tbl_consultas where telefono = ? limit 1";
            $INSERT = "INSERT INTO tbl_consultas (nombre,apellido,fecha,tipo,correo,telefono) values (?,?,?,?,?,?)";

            $stmt = $conn->prepare($SELECT);
            $stmt->bind_param("i", $telefono);
            $stmt->execute();
            $stmt->bind_result($telefono);
            $stmt->store_result();
            $rnum = $stmt->$num_rows;
            if($rnum == 0) {
                $stmt -> close();
                $stmt = $conn->prepare($INSERT);
                $stmt ->bind_param("sssssi", $txtname, $txtlastname, $fecha, $column, $txtcorreo, $telefono);
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
