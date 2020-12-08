<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <title>Whatsapp Stickers App Manager</title>
</head>

<body>

<?php
  require 'conexion.php';
  require 'notificaciones.php';

  $id_p = $_GET["p"];
  $id_app = $conect->real_escape_string($_GET['app']);
?>

  <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">
      <strong>Stickers Apps</strong> CMS
      <small><a href="<?=$server?>packs.php?app=<?=$id_app?>">
        &laquo; Packs
      </a></small>
    </h5>

  </div>

<?php
    if(isset($_GET["error"]) && ($_GET["error"]!="")){
?>
<div class="container">
  <div class="alert alert-danger" role="alert">
      <?=$_GET["error"]?>
  </div>
</div>
<?php
  }
?>



<?php

if(isset($_FILES['stickers']['name'])){
	$stickers = count($_FILES['stickers']['name']);
  $bool = true;
  for( $i=0 ; $i < $stickers ; $i++ ){
    $filename = $_FILES['stickers']['name'][$i];
    $extension = explode(".",$filename);
    $extension = $extension[count($extension)-1];
    if($extension != "webp"){
      $bool = false;
      break;
    }
  }
if($bool){
      $sq = "SELECT link FROM p_s INNER JOIN stickers ON stickers.id = p_s.id_s WHERE id_p = ".$id_p." ";
      $result2 = $conect->prepare($sq);
      $result2->execute();
      $result2->store_result();
      if($result2->num_rows<3){
        $publicado = false;
      }else{
        $publicado = true;
      }

for( $i=0 ; $i < $stickers ; $i++ ) {
    $tmpFilePath = $_FILES['stickers']['tmp_name'][$i];
    $filename = $_FILES['stickers']['name'][$i];
    if ($tmpFilePath != ""){
      $newFilePath = "res/";
      if(move_uploaded_file($tmpFilePath, $newFilePath.$id_p."/".$filename)) {
        $query1 = "INSERT INTO stickers (link) VALUES ('$filename');";
        $conect->query($query1);
        $id_s = $conect->insert_id;
       $conect->query("INSERT INTO p_s (id_p,id_s) VALUES (".$id_p.",".$id_s.")");
      }
    }
  }
$message;
if(!$publicado){
      $sq = "SELECT link FROM p_s INNER JOIN stickers ON stickers.id = p_s.id_s WHERE id_p = ".$id_p." ";
      $result2 = $conect->prepare($sq);
      $result2->execute();
      $result2->store_result();
      if($result2->num_rows>4){
        $sq = "SELECT * FROM app WHERE id =".$id_app." ";
        $resultado = $conect->query($sq);
        $app = $resultado->fetch_array();
        $response = sendMessage($app["idOneSignal"],$app["authorizationOneSignal"]);
            echo '
              <div class="container">
                  <div class="alert alert-success" role="alert">
                    El pack de stickers cumple con los requisitos y ha sido publicado.
                  </div>
              </div>
              <script type="text/javascript">
                console.log("id:'.$app["idOneSignal"].'");
                console.log("authorization:'.$app["authorizationOneSignal"].'");
                console.log("Response: '.$response.'");
              </script>

            ';
      }
}
}else{
       echo '
    <script type="text/javascript">
   location.href="'.$server.'pack.php?p='.$id_p.'&app='.$id_app.'&error=Los stickers solo pueden ser archivos .webp";
 </script>
    ';
}

}else { echo " "; } ?>
<div class="container">
  <div class="row">
    <div class="col-12 col-md-4">
      <div class="form-group form-check">
       <p><strong>Add Stickers</strong> to this pack</p>
        <form action="pack.php?p=<?=$id_p?>&app=<?=$id_app?>" method="POST" enctype="multipart/form-data">
          <input name="stickers[]" type="file" class="form-control-file form-control" id="exampleFormControlFile1"  multiple="multiple" >
          <p><small>Images must be: <strong>.webm</strong> and 512px by 512px</small></p>
        <button type="submit" class="btn btn btn-primary">Subir Stickers</button>

        <a href="<?=$server.'pack.php?p='.$id_p.'&deletePack'?>&app=<?=$id_app?>"
        class="btn btn-sm btn-outline-danger">Eliminar Pack</a>
        <hr>
        <br>
      </div>
      </form>
    </div>


<div class="col-12 col-md-8">
  <div class="row">
<?php

$result = $conect->query("SELECT * FROM p_s INNER JOIN packs ON p_s.id_p = packs.id INNER JOIN stickers ON p_s.id_s = stickers.id where packs.id = ".$id_p." ");

	while ($fila = mysqli_fetch_array($result)){
		echo '

		<div class="card col-md-4">
  <img src="res/'.$id_p.'/'.$fila["link"].'" width="600px" height="200px" class="card-img-top" alt="...">
  <div class="card-body">
      <a href="pack.php?p='.$id_p.'&app='.$id_app.'&delete='.$fila["id_s"].'" class="btn btn-block btn-danger">Eliminar</a>
  </div>
</div><br>

		';
	}

	  if (isset($_GET["delete"])) {

    $delete = $_GET["delete"];
    $newFilePath = "res/";
    $result = $conect->query("SELECT link FROM stickers WHERE id='$delete'");
    $nameFile = mysqli_fetch_row($result)[0];
    $conect->query("DELETE FROM p_s WHERE id_p='$id_p' AND id_s='$delete'");
    $conect->query("DELETE FROM stickers WHERE id='$delete'");
    unlink($newFilePath.$id_p."/".$nameFile);
    echo '
    <script type="text/javascript">
   location.href="'.$server.'pack.php?p='.$id_p.'&app='.$id_app.'";
 </script>
    ';
  }

      if (isset($_GET["deletePack"])) {


 $conect->query("DELETE FROM p_s WHERE id_p='$id_p'");
    $conect->query("DELETE FROM packs WHERE id='$id_p'");

    $newFilePath = "res/";
    function delTree($dir) {
      $files = array_diff(scandir($dir), array('.','..'));
      foreach ($files as $file) {
        (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
      }
      return rmdir($dir);
    }
    delTree($newFilePath.$id_p);
    echo '
    <script type="text/javascript">
   location.href="'.$server.'";
 </script>
    ';
  }


    ?></div>
</div>
 </div>