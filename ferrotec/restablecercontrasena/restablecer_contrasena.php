<?php
  require('../conectar/conectar.php');
  session_start();
  $usu_email = $_SESSION['usu_email'];
  $usu_email_oculto = '';
  /*function mostrarMailOculto($correo){    // Función que oculta caracteres del correo para dar indicio del mail enviado
      list($nombre,$dominio) = explode('@',$correo);        // Separa el dominio del nombre del correo
      $longitudcadenanombre = strlen($nombre);
      for($i = 0;$i <= ($longitudcadenanombre - 3);$i++){   // Reemplaza hasta los últimos 3 caracteres del mail por "x"
        $nombre = str_replace($nombre[$i],"x",$nombre);
      }
      $visibleParteNombre = substr($nombre, -3);
      $ocultoParteNombre = str_repeat('x', $longitudCadenaNombre - 3);
      
      $nombreOculto = $ocultoParteNombre . $visibleParteNombre;
      $correoOculto = $nombreOculto . '@' . $dominio;
      return $correoOculto;
  }*/
  function mostrarMailOculto($correo) {
    list($nombre, $dominio) = explode('@', $correo);
    $longitudCadenaNombre = strlen($nombre);
    
    // Mantenemos los últimos 3 caracteres sin ocultar
    $visibleParteNombre = substr($nombre, -3);
    $ocultoParteNombre = str_repeat('x', $longitudCadenaNombre - 3);
    
    $nombreOculto = $ocultoParteNombre . $visibleParteNombre;
    $correoOculto = $nombreOculto . '@' . $dominio;
    return $correoOculto;
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width", initial-scale="1.0">
    <link rel="icon" type="image/x-icon" href="images/favicon.png">   <!-- Favicon descargado de icons8.com -->

    <!-- Open Graph -->
    <meta property="og:title" content="Ferr O'Tec - Login" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="login.html" />
    <meta property="og:image" content="" />
    <meta property="og:description" content="Login" />
    <title>
      Ferr O' Tec - Restablecer Contraseña
    </title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  </head>

  <body style="background-color: #f2f2f2">
    <div class="container align-items-center justify-content-center">
      <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
          <div class="card">
            <div class="card-header">
                <h4 style="float: left;">
                    Ferr O'Tec &nbsp;
                </h4>
                    <img style="float: left;" width="30px" height="30px" src="../images/favicon.png">
                <h4 style="float: right;">
                    <label id="texto-fecha-hora"> </label>
                </h4>
            </div>
            <div class="card-body">
              <form action="grabar_contrasena.php" method="POST">
                <div class="form-group">
                  Se le envió un correo con un código de Reestablecimiento de Contraseña al mail: 
                  <b> 
                      <?php $usu_email_oculto = mostrarMailOculto($usu_email); 
                      echo $usu_email_oculto; 
                      ?> 
                  </b>
                </div>
                <br>
                <div class="form-group">
                  <input type="text" class="form-control" id="codigo-aleatorio" name="codigo-aleatorio" placeholder="Introduzca el código aleatorio">
                </div>
                <br>
                <div class="form-group">
                  <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Nueva Contraseña">
                </div>
                <br>
                <div class="form-group">
                  <input type="password" class="form-control" id="repetir-contrasena" name="repetir-contrasena" placeholder="Repetir Contraseña">
                </div>
                <br>
                <div class="form-group">
                  <button onclick=fnValidarDatos() type="submit" class="btn btn-primary">
                      Enviar
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- JS Propios -->
    <script src="../Js Propios/js-fechayhora.js"></script>
    <script type="text/javascript" src="../js/restablecercontrasena/fnValidarDatos.js"></script>
  </body>

</html>