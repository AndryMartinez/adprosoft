<?php  
require '../conexion.php';

if(!isset($_GET["app"])){
	$id_app = "1";
}else{
	$id_app = $conect->real_escape_string($_GET["app"]);
}

$result= $conect->query("SELECT * FROM packs WHERE id_app=".$id_app);

	$i = 0;
	while ($row = mysqli_fetch_array($result)) {
		$sq = "SELECT link FROM p_s INNER JOIN stickers ON stickers.id = p_s.id_s WHERE id_p = ".$row["id"]." ";
   		$result2 = $conect->prepare($sq);
   		$result2->execute();
   		$result2->store_result();
   		if($result2->num_rows>2){
			$pack[$i]["identifier"] = $row["id"]; 
			$pack[$i]["name"] = $row["Nombre"]; 
			$pack[$i]["publisher"] = $row["Publisher"]; 
			$pack[$i]["tray_image_file"] = $row["Portada"];
			$result2 = $conect->query($sq);
	   		$u=0;
	   		$stickers = null;
			while($row2 = $result2->fetch_row())
			{
			    $stickers[$u] = ["image_file"=>$row2[0]];
			    $u++;
			}
		$pack[$i]["stickers"] = $stickers;
		++$i;
   		}
	}
	$packs["sticker_packs"] = $pack;

	$data = json_encode($packs);

	echo $data;

?>
