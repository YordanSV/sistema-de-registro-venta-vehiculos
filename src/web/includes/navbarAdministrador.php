<?php

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


$queryNombre = "SELECT nombre from Usuario u
where u.id = $usuario_id;";
$queryNombre = "SELECT nombre_usuario from Usuario u WHERE u.id = $usuario_id;";
$resultNombre = $conn->query($queryNombre);
$rowNombre = $resultNombre->fetch_row();
echo '<nav>';
echo '<h1 id=h1_>Bienvenido ' . $rowNombre[0] . '</h1>';
echo '<ul id = ul_>';
echo "<li id=li_><a id=a_ href=administrador.php?id=".$usuario_id.">Lista de Vehículos</a></li>";
echo "<li id=li_><a id=a_ href=addVehiculo.php?id=".$usuario_id.">Agregar Vehículo</a></li>";
echo '<li id=li_><a id=a_ href="login.php">Cerrar sesión</a></li>';
echo '</ul>';
echo '</nav>';

?>