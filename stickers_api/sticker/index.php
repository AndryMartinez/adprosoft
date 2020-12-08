<?php require 'conexion.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body style="padding: 5%" >
<div class="card" style="width: 28rem;padding: 5%">
	<h3>Crear Pack</h3>
	<hr>
  <form action="proces.php"  enctype="multipart/form-data" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre</label>
    <input type="text" name="nombre">
  </div>
  <div class="form-group">
    <label for="exampleFormControlFile1">Portada</label>
    <input type="file" name="fileToUpload" class="form-control-file" id="exampleFormControlFile1">
  </div><hr>
  <!--
  <div class="form-group form-check">
  	<label>Stickers</label>
    <input name="stickers[]" type="file" class="form-control-file" id="exampleFormControlFile1"  multiple="multiple" >
  </div>
-->
  <br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
<br>

<div class="card" >
	<ul class="list-unstyled">
	<?php  
	$result = $conect->query("SELECT * FROM packs");
	while ($fila = mysqli_fetch_array($result)){
		echo '
		  <a href="pack.php?p='.$fila["id"].'" class="media list-group-item list-group-item-action" style="padding:%5;">
    <img src="'.$fila["Portada"].'" class="mr-2" alt="..." width="100px" height="70px">
    <div class="media-body">
      <h5 class="mt-0 mb-1">'.$fila["Nombre"].'</h5>
    </div>
  </a>
		';
	}
	?>
</ul>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>