<?php require 'conexion.php';


if(
	!isset($_POST["nombre"])
	|| !isset($_POST["idOS"])
	|| !isset($_POST["authOS"])
	|| !isset($_FILES["fileToUpload"])
){
	   echo '
    <script type="text/javascript">
   location.href="'.$server.'?error=No se recibieron los parámetros necesarios para registrar la app";
 </script>
    ';
    exit();
}


$name = $_POST["nombre"];
$idOS = $_POST["idOS"];
$authOS = $_POST["authOS"];
$icon = $_FILES["fileToUpload"]["name"];
$extension = explode(".",$icon);
$extension = $extension[count($extension)-1];


$directory ="res/app/";

$query = "INSERT INTO app (name, idOneSignal, authorizationOneSignal, img)
VALUES ('$name', '$idOS', '$authOS', '$icon')";

if ($conect->connect_errno) {
    echo "Falló la conexión: ".$conect->connect_error."<br>";
    exit();
}

if(!$conect->query($query)){
	echo "Falló la consulta: ".$conect->errno."<br>";
	exit();
}


$folder = $conect->insert_id;

mkdir($directory.$folder);

move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $directory.$folder."/".$icon);
   echo '
    <script type="text/javascript">
   location.href="'.$server.'";
 </script>
    ';