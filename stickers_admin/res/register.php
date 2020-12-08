<?php
require '../conexion.php';

if ($conect->connect_errno) {
    printf("Falló la conexión: %s\n", $mysqli->connect_error);
    exit();
}
if ($conect->query("INSERT INTO user (id) VALUES (NULL)")){
	echo $conect->insert_id;
	exit();
}

echo 0;