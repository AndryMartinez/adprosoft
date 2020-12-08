<?php
require '../conexion.php';

if ($conect->connect_errno) {
    printf("Falló la conexión: %s\n", $mysqli->connect_error);
    exit();
}

if (isset($_GET["rating"]) && isset($_GET["pack"]) && isset($_GET["user"]) && ($_GET["rating"]<=5) && ($_GET["rating"]>0)) {

	$pack = $conect->real_escape_string($_GET["pack"]);

	$sql = "SELECT * FROM packs WHERE id = ".$pack." ";

	if ($result = $conect->query($sql)) {

		if($result->num_rows>0){

			$rating = $conect->real_escape_string($_GET["rating"]);

			$user = $conect->real_escape_string($_GET["user"]);

			$sql = "SELECT * FROM user WHERE id = ".$user." ";

			if ($result = $conect->query($sql)) {

				if($result->num_rows>0){

					$sql = "SELECT id FROM rating WHERE id_u = ".$user." AND id_p = ".$pack." ";

					if ($result = $conect->query($sql)) {

						if($result->num_rows>0){

							$id = $result->fetch_row()[0];

							if ($conect->query("UPDATE rating SET value = ".$rating." WHERE id = ".$id." ")) {
							    echo 1;
							    exit();
							}

						}else{

							if ($conect->query("INSERT INTO rating (id_p,id_u,value) VALUES (".$pack.",".$user.",".$rating.")")) {
							    echo 1;
							    exit();
							}

						}

					}


				}

			}

		}
	}
}
echo 0;