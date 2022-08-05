<?php

    $id = $_POST['id'];
    $fecha = $_POST['fecha'];
    $diagnostico = $_POST['diagnostico'];
    $tratamiento = $_POST['tratamiento'];

    
    if(!empty($id) || !empty($fecha) || !empty($diagnostico) || !empty($tratamiento)) {
        $host = "localhost";
        $dbusername = "root";
        $dbpass = "";
        $dbname = "db_hadaf";

        $conn = new mysqli($host, $dbusername, $dbpass, $dbname);
        if(mysqli_connect_error()) {
            die('connect error('.mysqli_connect_errno().')'.mysqli_connect_error());
        }
        else {

            //Buscar e imprimir datos del paciente para comprobar que se obtienen bien los datos y que se pueden usar.
            //Verificar si los datos se pueden almacenar en una variable para poder ser usada en las recetas.
            $pacienteQuery = "SELECT * FROM tbl_pacientes WHERE id LIKE '%$id%'";
            $paciente = $conn->query ($pacienteQuery);
            while ($row = $paciente-> fetch_assoc()) {
                echo print_r($row);
            }

            /*$SELECT = "SELECT telefono from tbl_pacientes where telefono = ? limit 1";*/
            $INSERT = "INSERT INTO tbl_recetas (diag,fecha,trat,pacienteid) values (?,?,?,?)";

            //$stmt = $conn->prepare($SELECT);
            //$stmt->bind_param("i", $telefono);
            //$stmt->execute();
            //$stmt->bind_result($telefono);
            //$stmt->store_result();
            //$rnum = $stmt->$num_rows;
            //if($rnum == 0) {
                //$stmt -> close();
            $stmt = $conn->prepare($INSERT);
            $stmt ->bind_param("sssi", $diagnostico, $fecha, $tratamiento, $id);
            $stmt->execute();

            echo "Receta guardada";

            $stmt->close();
            $conn->close();
        }
    }
    else {
        echo "Todos los datos son obligatorios";
        die();
    }
?>