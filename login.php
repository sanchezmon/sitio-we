 <?php
 include "conexion.php";
 $matricula=$_POST['matricula'];    $contrasena=$_POST['contrasena'];  
if($dbh!=null)  //Se logró conectar
 {  $stmt = $dbh->prepare("SELECT matricula, nombre, apaterno, amaterno, tipousuario FROM 
usuarios WHERE matricula=:matricula AND contrasena=:contrasena");
 $stmt->bindParam(':matricula', $matricula);   $stmt->bindParam(':contrasena', $contrasena); 
// Ejemplo de FetchMode por asociación (Podemos dejar el ya especificado)
 $stmt->setFetchMode(PDO::FETCH_ASSOC);
 // Ejecutar la consulta 
$stmt->execute();
 $datos = $stmt->fetch();
 if($datos['matricula']!=NULL){    //Si obtuvo un registro
 $_SESSION["matricula"]=$datos["matricula"];   $_SESSION["nombre"]=$datos["nombre"];  
$_SESSION["apaterno"]=$datos["apaterno"];    $_SESSION["amaterno"]=$datos["amaterno"];  
$_SESSION["tipousuario"]=$datos["tipousuario"];
 if($_SESSION["tipousuario"]==‘A')   //Extrae la etiqueta de tipo de usuario
 $_SESSION["usuario"]=“CP";
 else
 $_SESSION["usuario"]="PP";
 echo "Logueo exitoso. Bienvenido ".$_SESSION["nombre"] ." ". $_SESSION["apaterno"] ." ". 
$_SESSION["amaterno"];
 echo "<br> Has iniciado sesión como ". $_SESSION["usuario"];
 echo "<br><br><a href='index.php'><img src='atras.jpg'></a>";
 //echo '<META HTTP-EQUIV="Refresh" CONTENT="1;URL=index.html">';
 } 
else   //No se obtuvo registro
 {   echo "Logueo erróneo. Identificador de usuario o contraseña incorrecta.";       
echo "<br><br><a href='index.php'><img src='atras.jpg'></a>";  
exit();  
}
 $dbh=null;  //Termina conexión
 }   
else     //No se logró conexión
 {
 echo "No hay conexión con la base de datos.";
 }
 ?>
