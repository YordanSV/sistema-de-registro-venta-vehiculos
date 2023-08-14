<!DOCTYPE html>
<html>

<head>
    <title>Administrador</title>
    <link rel="stylesheet" href="css/estilo.css">
    <style>
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

        /* Estilos generales del formulario */
        form {
            width: 80%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f5f5f5;
            border-radius: 5px;
        }

        h2 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <?php include 'includes/navbarAdministrador.php'; ?>
    <?php include 'includes/formAddVehiculo.php'; ?>

    <?php

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $placa = $_POST["placa"];
        $num_motor = $_POST["num_motor"];
        $anio = $_POST["anio"];
        $marca = $_POST["marca"];
        $modelo = $_POST["modelo"];
        $precio = $_POST["precio"];
        $kilometraje = $_POST["kilometraje"];
        $cilindraje = $_POST["cilindraje"];
        $transmision = $_POST["transmision"];
        $combustible = $_POST["combustible"];
        $color_exterior = $_POST["color_exterior"];
        $color_interior = $_POST["color_interior"];
        $fecha_registro = $_POST["fecha_registro"];
        $url1 = $_POST['url1'];
        $url2 = $_POST['url2'];
        $url3 = $_POST['url3'];

        // Conexión a la base de datos (reemplaza estos valores con los de tu servidor)
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


        $query = "Call AgregarVehiculoYPropietario('$placa','$num_motor', '$anio', '$marca',
        '$modelo', '$precio','$kilometraje', '$cilindraje', '$transmision',
        '$combustible', '$color_exterior','$color_interior', '$fecha_registro', '$usuario_id', '$url1', '$url2', '$url3');";
        if ($conn->query($query) === TRUE) {
            echo "Se ha registrado existosmente.";
        } else {
            echo "Error al ejecutar el procedimiento almacenado: " . $conn->error;
        }
    }
    ?>

</body>

</html>