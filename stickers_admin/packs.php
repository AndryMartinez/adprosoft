<?php if(!isset($_GET['app'])){exit();} require 'conexion.php';?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <title>Whatsapp Stickers App Manager</title>
 
     <style media="screen">
	/* Extra small devices (phones, 600px and down) */
	@media only screen and (max-width: 600px) {
		h5.text-responsive {
		  font-size: 10px;
		}
	}
	
	/* Small devices (portrait tablets and large phones, 600px and up) */
	@media only screen and (min-width: 600px) {
		h5.text-responsive {
		  font-size: 11px;
		}		
	}
	
	/* Medium devices (landscape tablets, 768px and up) */
	@media only screen and (min-width: 768px) 
		h5.text-responsive {
		  font-size: 20px;
		}		
	}
	
	/* Large devices (laptops/desktops, 992px and up) */
	@media only screen and (min-width: 992px) {
		h5.text-responsive {
		  font-size: 20px;
		}		
	}
	
	/* Extra large devices (large laptops and desktops, 1200px and up) */
	@media only screen and (min-width: 1200px) {
		h5.text-responsive {
		  font-size: 20px;
		}		
	}
    </style>
 
</head>

<body>
  <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">
      <strong>Stickers Apps</strong> CMS
      <small><a href="<?=$server?>">&laquo; Home</a></small>
    </h5>
  </div>
  <?php
  if (isset($_GET["error"]) && ($_GET["error"] != "")) {
    echo '<div class="alert alert-danger" role="alert">
        ' . $_GET["error"] . '
      </div>';
  }
  ?>

  <div class="container">
    <div class="row">
      <div class="col-12 col-md-4">
        <div class="">
          <h3>Crear Pack</h3>
          <hr>
          <form action="proces.php" enctype="multipart/form-data" method="POST">
            <input type="hidden" id="id_app" name="id_app" value="<?=$conect->real_escape_string($_GET['app'])?>">
            <div class="form-group">
              <label for="exampleInputEmail1">Nombre</label>
              <input type="text" name="nombre" class="form-control">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Publicado por</label>
              <input type="text" name="publisher" class="form-control">
            </div>
            <div class="form-group">
              <label for="exampleFormControlFile1">Portada <small>PNG 96x96</small></label>
              <input type="file" name="fileToUpload" class="form-control-file" id="exampleFormControlFile1">
            </div>
            <hr>
            <br>
            <button type="submit" class="btn btn-primary">Crear</button>
            <hr>
            <br>
          </form>
        </div>
      </div>

      <div class="col-12 col-md-8">
        <div class="">
          <!-- <ul class="list-unstyled"> -->
          <ul class="row mr-3">
            <?php
            $result = $conect->query("SELECT * FROM packs WHERE id_app =".$conect->real_escape_string($_GET['app']));
            while ($fila = mysqli_fetch_array($result)) {

              echo '
            <a href="pack.php?p='.$fila["id"].'&app='.$conect->real_escape_string($_GET['app']).'" style="text-align: center;" 
            	class="media list-group-item col-6 col-md-4 px-3 py-4"
            >
              <img src="res/'. $fila['id'].'/'.$fila["Portada"].'" class="mr-3"
              	style="width:75%; height: 75%;"
              >
              <div class="media-body">
                <h5 class="mt-0 text-responsive">'.$fila["Nombre"].'</h5>
              </div>
            </a>
              ';
            }
            ?>
          </ul>
        </div>
      </div>
    </div>
  </div>



  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>