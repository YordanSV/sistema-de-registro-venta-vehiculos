<!DOCTYPE html>
<html>

<head>
    <title>Ventas</title>
    <link rel="stylesheet" href="css/estilo.css">
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


        // Consulta para obtener todos los usuarios
        $query = "SELECT nombre_usuario, contrasena, tipo_usuario FROM Usuario";
        $result = $conn->query($query);

        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            echo "<h2>Listado de Usuarios:</h2>";
            echo "<table>";
            echo "<tr><th>Nombre de Usuario</th><th>Contraseña</th><th>Tipo de Usuario</th></tr>";

            // Recorrer los resultados y mostrarlos en una tabla
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["nombre_usuario"] . "</td>";
                echo "<td>" . $row["contrasena"] . "</td>";
                echo "<td>" . $row["tipo_usuario"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No se encontraron usuarios.";
        }

        // Cerrar conexión
        $conn->close();
    }
    ?>
</body>

</html>