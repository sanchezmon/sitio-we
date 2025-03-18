<?php
// Incluir la conexión a la base de datos
include "conexion.php";

// Recibir los datos del formulario
$nombre = $_POST['nombre'];
$apaterno = $_POST['apaterno'];
$amaterno = $_POST['amaterno'];
$edad = $_POST['edad'];
$sexo = $_POST['sexo'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$tipousuario = $_POST['tipousuario'];  // Suponiendo que este campo es parte del formulario
$contrasena = $_POST['contrasena'];
$confirma = $_POST['confirma'];

// Validar que los campos no estén vacíos
if (empty($nombre) || empty($apaterno) || empty($amaterno) || empty($edad) || empty($sexo) || empty($email) || empty($telefono) || empty($contrasena) || empty($confirma)) {
    echo "Todos los campos son obligatorios. Por favor, complete el formulario.";
    echo "<br><br><a href='registro.php'><img src='atras.jpg'></a>";
    exit();  // Detener la ejecución si falta algún campo
}

// Validar que las contraseñas coincidan
if ($contrasena !== $confirma) {
    echo "Las contraseñas no coinciden. Intenta nuevamente.";
    echo "<br><br><a href='registro.php'><img src='atras.jpg'></a>";
    exit();  // Detener la ejecución si las contraseñas no coinciden
}

// Validar que la contraseña tenga al menos 8 caracteres (puedes personalizar esto)
if (strlen($contrasena) < 8) {
    echo "La contraseña debe tener al menos 8 caracteres.";
    echo "<br><br><a href='registro.php'><img src='atras.jpg'></a>";
    exit();  // Detener la ejecución si la contraseña es demasiado corta
}

// Encriptar la contraseña
$contrasena_encriptada = password_hash($contrasena, PASSWORD_DEFAULT);

// Verificar conexión con la base de datos
if ($dbh != null) {
    // Preparar la consulta SQL para insertar los datos en la tabla `usuarios`
    $stmt = $dbh->prepare("INSERT INTO usuarios (nombre, apaterno, amaterno, edad, sexo, email, telefono, tipousuario, contrasena) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Vincular los parámetros a la consulta
    $stmt->bindParam(1, $nombre);
    $stmt->bindParam(2, $apaterno);
    $stmt->bindParam(3, $amaterno);
    $stmt->bindParam(4, $edad);
    $stmt->bindParam(5, $sexo);
    $stmt->bindParam(6, $email);
    $stmt->bindParam(7, $telefono);
    $stmt->bindParam(8, $tipousuario);
    $stmt->bindParam(9, $contrasena_encriptada);
    
    // Ejecutar la consulta
    $stmt->execute();

    echo "El registro del usuario $nombre $apaterno $amaterno se realizó con éxito.";
    echo "<br><br><a href='index.php'><img src='atras.jpg'></a>";
    
    // Cerrar la conexión a la base de datos
    $dbh = null;
} else {
    // Si no hay conexión a la base de datos
    echo "No hay conexión con la base de datos.";
    echo "<br><br><a href='index.php'><img src='atras.jpg'></a>";
}
?>
