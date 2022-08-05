<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Pacientes</title>
    <link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Basic&display=swap" rel="stylesheet">
</head>
<body>
    <header class="encabezado">
        <h1>Consultar Pacientes</h1>
    </header>
    <main>
        <div class="contenedor-busqueda">
           <form action="consPaciente.php" method="post">
                <input type="text" name="search" placeholder="1">
                <select name="column" id="">
                    <option value="id">ID</option>
                    <option value="nombre">Nombre</option>
                    <option value="telefono">Telefono</option>
                </select>
                <input type="submit">
            </form>       
        </div>
        <div class="boton-contenedor">
            <a href="pacientesmain.html" class="boton-regresar">Regresar</a>
        </div>
        <table class="tabla-pacientes">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Edad</th>
                <th>Sexo</th>
                <th>Altura</th>
                <th>Peso</th>
                <th>Sangre</th>
                <th>Comentarios</th>
                <th>Correo</th>
                <th>Telefono</th>
            </tr>
            <?php
                $search = $_POST['search'];
                $column = $_POST['column'];

                $conn = mysqli_connect("localhost", "root", "", "db_hadaf");
                if ($conn-> connect_error) {
                    die("Conexion fallida: ".$conn->connect_error);
                }

                // ~~ Como idea, se puede implementar hacer clic en cierto query para abrir más datos. ~~
                // No borrar lo siguiente, puede ser util si necesitamos otro query:
                //$sql = "SELECT id, nombre, apellido, edad, sexo, altura, peso, sangre, extra, correo, telefono from tbl_pacientes";
                $sql = "SELECT * FROM tbl_pacientes WHERE $column LIKE '%$search%'";
                $result = $conn-> query($sql);

                if ($result-> num_rows > 0) {
                    while ($row = $result-> fetch_assoc()) {
                        echo "<tr><td>".$row["id"]."</td><td>".$row["nombre"]."</td><td>".$row["apellido"]."</td><td>".$row["edad"]."</td><td>".$row["sexo"]."</td><td>".$row["altura"]."</td><td>".$row["peso"]."</td><td>".$row["sangre"]."</td><td>".$row["extra"]."</td><td>".$row["correo"]."</td><td>".$row["telefono"]."</td></tr>";
                    }
                    echo "</table>";
                }
                else {
                    echo "Sin resultados";
                }

                $conn-> close();
            ?>
        </table>
    </main>

</body>
</html>