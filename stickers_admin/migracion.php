<?php
require 'conexion.php';
//$result= $conect->query("ALTER TABLE packs ADD Publisher varchar(255)") or die("Alter Error: ".mysql_error());

$result= $conect->query("SELECT * FROM packs");

$i = 0;
while ($row = mysqli_fetch_array($result)) {
	$sq = "SELECT link FROM p_s INNER JOIN stickers ON 
	stickers.id = p_s.id_s WHERE id_p = ".$row["id"]." ";
	$result2 = $conect->prepare($sq);
	$result2->execute();
	$result2->store_result();
	echo "<br>".$row["id"]."<br>";
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
		for ($o=0; $o < count($stickers); $o++) { 
			echo $stickers[$o]["image_file"]."<br>";
		}
		$pack[$i]["stickers"] = $stickers;
			++$i;
	}
}

$packs["sticker_packs"] = $pack;


$data = json_encode($packs);

//echo $data;

?>