<?php  
require '../conexion.php';





$peticiion = $_GET["data"];


switch ($peticiion) {
	case 'packs':

	$result= $conect->query("SELECT * FROM packs");

	$fila= mysqli_fetch_array($result);

	$data = json_encode($fila);

	echo $data;


		
		break;

	case 'pack':

	$id_pack = $_GET["id"];

   
	   $sq = "SELECT link,id_s FROM p_s INNER JOIN packs ON p_s.id_p = packs.id INNER JOIN stickers ON p_s.id_s = stickers.id where packs.id = ".$id_pack." ";
   

   $result = $conect->query($sq); //si la conexión cancelar programa

    $rawdata = array(); //creamos un array

    //guardamos en un array multidimensional todos los datos de la consulta
    $i=0;

    while($row = mysqli_fetch_array($result))
    {
        $rawdata[$i] = $row;
        $i++;
    }

    echo json_encode($rawdata);
  	


		
		break;	
	default:
		# code...
		break;
}










?>