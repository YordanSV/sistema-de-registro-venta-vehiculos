<!DOCTYPE html>
<html>

<head>
    <title>Administrador</title>
    <style>
        article {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 20px;
            background-color: #f9f9f9;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        p {
            font-size: 16px;
            margin: 5px 0;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
        }

        #filter-form {
            width: 1100px;
            margin: 0 auto;
        }

        #filter-form label {
            display: inline-block;
            width: 120px;
            font-weight: bold;
        }

        #filter-form input {
            width: 220px;
            padding: 5px;
            margin-bottom: 10px;
        }

        #button_filter {
            width: auto;
            background-color: #007BFF;
            color: white;
            cursor: pointer;
        }

        nav {
            background-color: black;
            color: white;
            padding: 20px;
            text-align: center;
        }

        #h1_ {
            margin: 0;
        }

        #ul_ {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }

        #li_ {
            display: inline;
            margin: 0 15px;
        }

        #a_ {
            color: white;
            text-decoration: none;
        }
    </style>
    <link rel="stylesheet" href="css/estilo.css">
</head>

<body>
    <?php include 'includes/formFilter.php'; ?>

    <?php

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $marca = $_POST["marca"];
        $modelo = $_POST["modelo"];
        $transmision = $_POST["transmision"];
        $combustible = $_POST["combustible"];
        $precioMin = $_POST["precio_min"];
        $precioMax = $_POST["precio_max"];
        $anioMin = $_POST["anio_min"];
        $anioMax = $_POST["anio_max"];
        if (empty($marca)) {
            $marca = null;
        }
        if (empty($modelo)) {
            $modelo = null;
        }
        if (empty($transmision)) {
            $transmision = null;
        }
        if (empty($combustible)) {
            $combustible = null;
        }
        if (empty($precioMax)) {
            $precioMax = null;
        }
        if (empty($precioMin)) {
            $precioMin = null;
        }
        if (empty($anioMax)) {
            $anioMax = null;
        }
        if (empty($anioMin)) {
            $anioMin = null;
        }
        // Conexión a la base de datos 
        $servername = "localhost";
        $username_db = "root";
        $password_db = "1234";
        $database = "mysql";

        // Crear conexión
        $conn = new mysqli($servername, $username_db, $password_db, $database);

        // Verificar la conexión
        if ($conn->connect_error) {
            echo "Error de conexión";
            die("Error de conexión: " . $conn->connect_error);
        }


        isset($_GET['id']);
        $usuario_id = $_GET['id'];
        //include 'includes/navbar.php';



        echo '<p  style="text-align: center;">Lista de vehiculos en venta</p>';


        // Consulta para obtener los vehículos del usuario
        // Consulta para obtener los vehículos del usuario
        $query = "CALL ObtenerVehiculosFiltrados('$marca', '$modelo', '$transmision',
        '$combustible', $precioMin, $precioMax, $anioMin, $anioMax)";

        //$query = "Select * From Vehiculo;";

        echo "<p> marca es:" . $marca . "</p>";



        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                echo '<article>';
                echo "<h1> Numero de Placa: "  . $row["placa"] . "</h1>";
                echo "<h1> Precio: "  . $row["precio"] . "</h1>";

                echo '<p>Descripción o características del artículo.</p>';

                $vehiculo_id = $row["id"];
                $imagenesQuery = "SELECT url FROM ImagenesXauto WHERE vehiculo_id = $vehiculo_id";
                $imagenesResult = $conn->query($imagenesQuery);

                if ($imagenesResult->num_rows > 0) {
                    echo '<h2>Imágenes:</h2>';
                    echo '<div class="imagenes-container">';
                    while ($imagenRow = $imagenesResult->fetch_assoc()) {
                        echo "<img src=" . $imagenRow["url"] . " alt='Imagen del vehículo'>";
                    }
                    echo '</div>';
                }

                echo '<h2>Características:</h2>';
                echo '<ul>';
                echo "<li> Placa: "  . $row["placa"] . "</li>";
                echo "<li> Numero de motor: " . $row["num_motor"] . "</li>";
                echo "<li> Año: "  . $row["anio"] . "</li>";
                echo "<li> Marca: " . $row["marca"] . "</li>";
                echo "<li> Modelo: "  . $row["modelo"] . "</li>";
                echo "<li> Kilometraje: "  . $row["kilometraje"] . "</li>";
                echo "<li> Cilindraje: " . $row["cilindraje"] . "</li>";
                echo "<li> Transmision: "  . $row["transmision"] . "</li>";
                echo "<li> Combustible: " . $row["combustible"] . "</li>";
                echo "<li> Color Exterior: "  . $row["color_exterior"] . "</li>";
                echo "<li> Color Interior: " . $row["color_interior"] . "</li>";
                echo "<li> Fecha Registrado: "  . $row["fecha_registro"] . "</li>";
                echo '</ul>';

                echo '</article>';
            }
            echo "</ul>";
        } else {
            echo "No se encontraron vehículos para este usuario.";
        }

        $conn->close();
    }
    ?>


</body>

</html>