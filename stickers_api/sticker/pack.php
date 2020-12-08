
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <?php

  require 'conexion.php';

  session_start();
    $id_p = $_GET["p"];


  echo '
  <div class="form-group form-check">
  	<label>Stickers</label>
  	<form action="pack.php?p='.$id_p.'" method="POST" enctype="multipart/form-data">
     <input name="stickers[]" type="file" class="form-control-file" id="exampleFormControlFile1"  multiple="multiple" >
     <button type="submit">subir</button>
	</form>
  </div>
  ';




  





if(isset($_FILES['stickers']['name'])){

	$stickers = count($_FILES['stickers']['name']);

for( $i=0 ; $i < $stickers ; $i++ ) {

	  	   


  //Get the temp file path
  $tmpFilePath = $_FILES['stickers']['tmp_name'][$i];
  $filename = $_FILES['stickers']['name'][$i];

;

  //Make sure we have a file path
  if ($tmpFilePath != ""){
    //Setup our new file path
    $newFilePath = "./res/". $filename;

    
   


    //Upload the file into the temp dir
    if(move_uploaded_file($tmpFilePath, $newFilePath)) {




      $query1 = "INSERT INTO stickers (link) VALUES ('$filename');";
      $conect->query($query1);

      $id_s = $conect->insert_id;

     //echo $_SESSION["id"]." - ".$id_s."<br>";

     $conect->query("INSERT INTO p_s (id_p,id_s) VALUES (".$id_p.",".$id_s.")");



    }
  }
}

}else { echo " "; } ?>


<div class="container">
	 <div class="row">


<?php

$result = $conect->query("SELECT * FROM p_s INNER JOIN packs ON p_s.id_p = packs.id INNER JOIN stickers ON p_s.id_s = stickers.id where packs.id = ".$id_p." ");

	while ($fila = mysqli_fetch_array($result)){
		echo '

		<div class="card col-md-4" style="width: 18rem;">
  <img src="./res/'.$fila["link"].'" width="600px" height="200px" class="card-img-top" alt="...">
  <div class="card-body">
    <a href="#" class="btn btn-block btn-primary">Go somewhere</a>
  </div>
</div><br>
		  
		';
	}


    ?>
</div>
 </div>