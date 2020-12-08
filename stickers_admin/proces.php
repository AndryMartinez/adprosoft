<?php

require 'conexion.php';


$name = $_POST["nombre"];
$publisher = $_POST["publisher"];
$id_app = $_POST["id_app"];
$portada = $_FILES["fileToUpload"]["name"];
$extension = explode(".",$portada);
$extension = $extension[count($extension)-1];
if($extension == "png"){


//
$directory ="res/";


$query = "INSERT INTO packs (id_app, Nombre, Portada, Publisher)
VALUES ($id_app,'$name', '$portada' ,'$publisher')";


if ($conect->connect_errno) {
    echo "Falló la conexión: ".$conect->connect_error."<br>";
    exit();
}

if(!$conect->query($query)){
	echo "Falló la conexión: ".$conect->errno."<br>";
  exit();
}

$folder = $conect->insert_id;

mkdir($directory.$folder);

move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $directory.$folder."/".$portada);


   echo '
    <script type="text/javascript">
   location.href="'.$server.'packs.php?app='.$id_app.'";
 </script>
    ';

}else{
	   echo '
    <script type="text/javascript">
   location.href="'.$server.'packs.php?app='.$id_app.'&error=Las portadas solo pueden ser archivos .png";
 </script>
    ';
    exit();
}


?>