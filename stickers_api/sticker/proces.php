<?php

require 'conexion.php';


$name = $_POST["nombre"];
$portada = $_FILES["fileToUpload"]["name"];
//
$path = './res/';

$porpat = $path.$portada;



move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $path.$portada);

$query = "INSERT INTO packs (Nombre, Portada)
VALUES ('$name', '$porpat' )";

$conect->query($query);

$id_p = $conect->insert_id;

//echo "pack numero ".$id_p." Registrado";

echo $name." ".$portada;


/*




*/




?>