<!DOCTYPE html>
<html>
<head>
    <title>Administrador</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <?php include 'includes/formRegister.php'; ?>

    <?php

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = $_POST["nombre_usuario"];
        $password = $_POST["contrasena"];
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
        $query = "Call InsertarUsuario('$username','$password','$type');";
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