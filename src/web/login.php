<!DOCTYPE html>
<html>

<head>
    <title>Ventas</title>
    <link rel="stylesheet" href="css/estilo.css">
    <script>
        function redirigirRegistrar() {
            window.location.href = " http://localhost/sistema-de-registro-venta-vehiculos/src/web/register.php"; // Cambia la URL a la que deseas redirigir
        }
    </script>
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

        h1 {
            font-size: 20px;
            margin-bottom: 20px;
            color: #007bff;
            text-align: center;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"],
        button {
            width: 40%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin: 10px auto 0;
            /* Centro vertical y horizontalmente */
            font-weight: bold;
            display: block;
            /* Para ocupar todo el ancho disponible */
        }


        input[type="submit"]:hover,
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1>Bienvenido al Sistema de Registro y Venta de Vehículos</h1>
    <?php include 'includes/formLogin.php'; ?>

    <?php
    // Archivo login.php

    // Recibir datos del formulario de inicio de sesión
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];

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
        $query = "SELECT id, nombre_usuario, contrasena, tipo_usuario FROM Usuario WHERE nombre_usuario = '$username' AND contrasena = '$password'";
        $result = $conn->query($query);

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $tipo_usuario = $row["tipo_usuario"];
            $user_id = $row["id"];


            // Redirigir según el tipo de usuario
            if ($tipo_usuario === "Administrador") {
                header("Location: administrador.php?id=$user_id");
            } elseif ($tipo_usuario === "Cliente") {
                header("Location: cliente.php?id=$user_id");
            } else {
                echo "Tipo de usuario no reconocido.";
            }
        } else {
            //echo "Credenciales inválidas.";
        }

        $conn->close();
    }
    ?>
    <button onclick="redirigirRegistrar()">Registrate</button>
</body>

</html>