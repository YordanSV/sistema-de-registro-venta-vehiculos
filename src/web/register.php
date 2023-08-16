<!DOCTYPE html>
<html>

<head>
    <title>Administrador</title>
    <link rel="stylesheet" href="css/estilo.css">
    <style>
        /* Estilos generales del formulario */
        form {
            width: 300px;
            margin: auto;
            padding: 40px;
            border: 1px solid #ccc;
            background-color: #f5f5f5;
            border-radius: 5px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 5px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            background-color: white;
            color: #333;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-top: 10px;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php include 'includes/formRegister.php'; ?>

    <?php

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = $_POST["nombre_usuario"];
        $password = $_POST["contrasena"];
        $phone = $_POST["telefono"];
        $address = $_POST["direccion"];
        $type = $_POST["tipo_usuario"];

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


        // Consulta para verificar el usuario y la contraseña
        $query = "Call InsertarUsuario('$username','$password', '$phone', '$address','$type');";
        if ($conn->query($query) === TRUE) {
            echo "Se ha registrado existosmente.";
        } else {
            echo "Error al ejecutar el procedimiento almacenado: " . $conn->error;
        }
        //$result = $conn->query($query);
        $conn->close();
    }
    ?>

</body>

</html>