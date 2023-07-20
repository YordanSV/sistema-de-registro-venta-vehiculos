<?php
// Paso 1: Establecer la conexión con la base de datos
$servername = "nombre_del_servidor";
$username = "nombre_de_usuario";
$password = "contraseña";
$database = "nombre_de_la_base_de_datos";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Paso 2: Preparar y ejecutar el procedimiento almacenado
// Supongamos que el procedimiento almacenado se llama "mi_procedimiento" y tiene un parámetro llamado "parametro1"

$parametro1 = "valor_del_parametro";

$sql = "CALL mi_procedimiento(?)"; // El signo de interrogación es un marcador de posición para el parámetro

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $parametro1); // "s" indica que el parámetro es de tipo string

$stmt->execute();

// Aquí puedes realizar acciones adicionales con los resultados del procedimiento almacenado, si los hay

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
