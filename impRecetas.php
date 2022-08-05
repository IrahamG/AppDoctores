<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imprimir Recetas</title>
    <link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Basic&display=swap" rel="stylesheet">
    <style>
        body {
            text-align: center;
        }
    </style>
</head>
<body>
    <header class="encabezado">
        <h1>Imprimir Recetas</h1>
    </header>
    <main>
        <div class="contenedor-busqueda">
           <form action="impRecetas.php" method="post">
                <label for="search">Busqueda por ID:</label>
                <input type="text" name="search">
                <input type="submit">
            </form>       
        </div>
        <div class="boton-contenedor">
            <a href="recetasmain.html" class="boton-regresar">Regresar</a>
        </div>
        <p>
            <?php
                $search = $_POST['search'];

                $conn = mysqli_connect("localhost", "root", "", "db_hadaf");
                if ($conn-> connect_error) {
                    die("Conexion fallida: ".$conn->connect_error);
                }

                $sql = "SELECT tbl_pacientes.*, tbl_recetas.* FROM tbl_pacientes, tbl_recetas WHERE (tbl_recetas.id LIKE '%$search%') AND (tbl_recetas.pacienteid = tbl_pacientes.id)";
                $result = $conn-> query($sql);

                // Lo siguiente genera la receta médica basada en las bases de datos de la receta y del paciente.
                // También se puede usar la base de datos de los usuarios para escribir el nombre y los datos del medico
                if ($result-> num_rows > 0) {
                    while ($row = $result-> fetch_assoc()) {
                        echo "<br><br> RECETA MÉDICA <br>
                        Dr. Victor Morbius <br>
                        Ced. Prof. 18922 1672 <br>
                        Universidad Autonoma de Chihuahua <br><br>
                        Fecha: ".$row['fecha']." <br>
                        Av. Independencia no. 3418, Santa Rosa, 31187 <br>
                        Tel. 614 3782 278 <br>
                        ---------------------------------------------------------------------------------------------------------------------------------------------------------------- <br> Nombre del paciente: ".$row['nombre']." ".$row['apellido']."<br> Edad: ".$row['edad']." &nbsp;&nbsp; Altura: ".$row['altura']."cm &nbsp;&nbsp; Peso: ".$row['peso']."kg <br>";
                        echo "<br><br> Diagnostico Médico <br>".$row['diag']."<br><br> Tratamiento <br>".$row['trat']."<br>";
                    }
                    echo "</p>";
                }
                else {
                    echo "Sin resultados";
                }

                $conn-> close();
            ?>
        </p>
        <button>Imprimir</button>
    </main>
</body>
</html>