<?php require 'conexion.php';?>
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
    <h5 class="my-0 mr-md-auto font-weight-normal"><strong>Stickers Apps</strong> CMS</h5>
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
          <h3>Crear Aplicación</h3>
          <hr>
          <form action="registerApp.php" enctype="multipart/form-data" method="POST">
            <div class="form-group">
              <label for="exampleInputEmail1">Nombre de la aplicación</label>
              <input type="text" name="nombre" class="form-control">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">AppId de One Signal</label>
              <input type="text" name="idOS" class="form-control">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Autorización del servidor de One Signal</label>
              <input type="text" name="authOS" class="form-control">
            </div>
            <div class="form-group">
              <label for="exampleFormControlFile1">Ícono de la aplicación</label>
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
            $sql = "SELECT * FROM app";
            $result = $conect->query($sql);
            while ($fila = $result->fetch_array()) {
            	echo '
            <a href="packs.php?app='.$fila["id"].'" style="text-align: center;" class="media list-group-item col-6 col-md-4 py-4">
              <img src="res/app/'.$fila['id'].'/'.$fila["img"].'"
              style="width:75%; height: 75%;">
              <div class="media-body">
                <h5 class="mt-0 text-responsive">'.$fila["name"].'</h5>
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