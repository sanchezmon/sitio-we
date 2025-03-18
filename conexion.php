<?php
$host = 'localhost';  // Puede cambiarse si tu base de datos está en otro servidor.
$dbname = 'act2';     // Nombre de la base de datos.
$username = 'root';   // Tu usuario de la base de datos.
$password = '';       // Tu contraseña de la base de datos (vacía en XAMPP por defecto).

try {
    // Crear conexión usando PDO
    $dbh = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Establecer el modo de error para que sea lanzado un error si algo falla
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Si hay un error en la conexión, muestra el mensaje
    echo "Conexión fallida: " . $e->getMessage();
    exit(); // Detener ejecución si no se conecta
}
?>
