<?php
include "inc/inc.php";
login();

$error = "";

if(isset($_POST["enviar"])){
  $correo=$_POST["correo"];
  $contraseña=$_POST["password"];
  $passencriptada=md5($contraseña);

  $consulta = $conexion->prepare("SELECT * FROM usuarios where correo_usuario = :correo and contraseña_usuario = :password");
  $consulta->execute(array(":correo"=>$correo, ":password"=>$passencriptada));
  $datos = $consulta->fetch(PDO::FETCH_OBJ);

  if (!preg_match("/^[a-zA-Z0-9.-]+@[a-zA-Z0-9.-]+.([a-zA-Z]{2,4})+$/",$correo)){
    $error = "El Correo Electrónico es incorrecto.";
  }else if(empty($contraseña)){
    $error = "La contraseña no puede ser vacia.";
  }else{
    if($consulta->rowCount()==1){
      $_SESSION["logeado"] = true;
      $_SESSION["correo"] = $datos->correo_usuario;
      header("location: modulos/inicio.php");
    }else{
      $error = "Usuario y/o contraseña incorrecta";
    }
  }
}
?>

<!doctype html>
<html lang="es">
<head>
  <title>SIGEST-Iniciar Sesion</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- Material Kit CSS -->
  <link href="assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
  <script src="assets/js/login-register.js" type="text/javascript"></script>
</head>

<body class="dark-edition">
  <div class="wrapper ">
    <div class="content">
      <br><br><br><br><br>
      <center>
      <h1 class="display-4 text-white">SIGEST || Sistema de Gestion Academica</h1>
          <br><br>
          
          <?php if($error !== ""){ ?>
          <div class="alert alert-danger" id= "alert" style="width: 20rem;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <?php echo $error; ?>
          </div>
          <?php } ?>

          <div class="card" style="width: 20rem;">
            <img class="card-img-top" src="..." alt="">
            <div class="card-body">
              <form  method="POST" onsubmit="return ValidarLogin();">
                <div class="form-group">
                  <label>CORREO ELECTRONICO</label>
                  <input type="email" class="form-control" id="correo" name="correo" placeholder="email@example.com">
                </div>
                <div class="form-group">
                  <label>CONTRASEÑA</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="contraseña">
                </div>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="dropdownCheck2">
                </div>
                <button type="submit" name="enviar" class="btn btn-primary" >Iniciar Sesion</button>  
              </form>    
          </div>
        </div>
    </div>
		<br>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <nav class="float-left">
            <ul>
              <li>
                <a href="https://www.ipf.edu.ar/">
                  Instituto Politecnico Formosa
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, creado con <i class="material-icons">favorite</i> por
            <a href="https://www.creative-tim.com" target="_blank">Ditter Federico</a>
          </div>
          <!-- your footer here -->
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="assets/js/main.js"></script>

</body>

</html>