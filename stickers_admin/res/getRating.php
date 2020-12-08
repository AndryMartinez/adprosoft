<?php
require '../conexion.php';

if ($conect->connect_errno) {
    printf("Falló la conexión: %s\n", $mysqli->connect_error);
    exit();
}

if (!isset($_GET["user"])) {
	if (isset($_GET["pack"])) {

		$pack = $conect->real_escape_string($_GET["pack"]);

		$sql = "SELECT rating.value FROM packs 
				INNER JOIN rating ON packs.id = rating.id_p
				WHERE packs.id = ".$pack." ";

		$result= $conect->query($sql);

		if ($result->num_rows > 0) {

			$suma = 0;
			$cantidad = 0;
			while ($row = $result->fetch_row()) {

				$suma = $suma + $row[0];
				++$cantidad;
				
			}

			echo $suma/$cantidad;
			exit();
		}
	}
	
}else{
	$user = $conect->real_escape_string($_GET["user"]);
	if (isset($_GET["pack"])) {
		$pack = $conect->real_escape_string($_GET["pack"]);
		$sql = "SELECT rating.value FROM packs 
				INNER JOIN rating ON packs.id = rating.id_p
				WHERE packs.id = ".$pack." AND 
				rating.id_u = ".$user." ";
		$result= $conect->query($sql);
		if ($result->num_rows > 0) {
			echo $result->fetch_row()[0];
			exit();
		}
		
	}
}
echo 0;