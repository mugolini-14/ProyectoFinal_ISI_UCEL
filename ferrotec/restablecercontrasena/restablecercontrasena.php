<?php

// Conexión a la base de datos MySQL
require('../conectar/conectar.php');

// Iniciar sesión si no está iniciada
session_start();

// Datos del Usuario
$id = $_SESSION['id'];
$usu_email = $_SESSION['usu_email'];
$usuario = $_SESSION['usu_username'];
$codigoAleatorioGenerado = $_SESSION['numeroAleatorio'];

function mostrarMailOculto($correo){    // Función que oculta caracteres del correo para dar indicio del mail enviado
    list($nombre,$dominio) = explode('@',$correo);        // Separa el dominio del nombre del correo
    $longitudcadenanombre = strlen($nombre);
    $nombreoculto = '';
    for ($i = 0; $i < $longitudcadenanombre; $i++) {
      if ($i < $longitudcadenanombre - 3) {
          $nombreoculto .= 'x';
      } 
      else {
          $nombreoculto .= $nombre[$i];
      }
    } 
    $correoOculto = $nombreoculto . '@' . $dominio;
    return $correoOculto;
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width", initial-scale="1.0">
    <link rel="icon" type="image/x-icon" href="../images/favicon.png">   <!-- Favicon descargado de icons8.com -->

    <!-- Open Graph -->
    <meta property="og:title" content="Ferr O'Tec - Login" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="login.php" />
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
            <form id="restablecer-contrasena-form">
              <table>
                <tr>
                  <td colspan="3">
                    <div class="form-group col-12">
                      Se le envió un correo con un código de Reestablecimiento de Contraseña al mail: 
                      <?php $mail_oculto = mostrarMailOculto($usu_email); 
                        echo "<b>" . $mail_oculto . "</b>";
                      ?>
                    </div>
                  </td>
                  <td>
                  </td>
                </tr>
                <tr>
                  <td rowspan="1" class="col-6" >
                    <div class="form-group col-12">
                      <input type="text" class="form-control col-12" id="codigo-aleatorio" name="codigo-aleatorio" placeholder="Introduzca el Código" >
                      <br>
                      <input type="password" class="form-control col-12" id="contrasena" name="contrasena" placeholder="Nueva Contraseña">
                      <br>
                      <input type="password" class="form-control col-12" id="repetir-contrasena" name="repetir-contrasena" placeholder="Repetir Contraseña">
                      <br>
                    </div>
                  </td>
                  <td class="col-1">

                  </td>
                  <td rowspan="1" class="col-5">
                    <div class="form-group col-12">
                      <label class="form-col-label"> La contraseña debe cumplir con las siguientes políticas: </label>
                      <ul>
                        <li>
                          Debe tener entre 8 y 12 caracteres de largo
                        </li>
                        <li>
                          Debe tener al menos una mayúscula
                        </li>
                        <li>
                          Debe tener al menos una minúscula
                        </li>
                        <li>
                          Debe tener al menos un número
                        </li>
                        <li>
                          Debe tener al menos un símbolo
                        </li>
                      </ul>
                    </div>
                  </td>
                </tr>
              </table>
              </form>
              <div class="form-group">
                  <div class="form-group row">
                    <div class="col-sm-4 d-flex align-items-center" style="float:left;" id="usuario-restablecer" class="form-group">
                      <label class="form-col-label"> 
                        <?php 
                          echo "<i> Usuario: " . $usuario . "</i>";
                        ?>
                      </label>
                    </div>
                    <div class="col-sm-4">
                      <button class="btn btn-primary col-12" onclick="fnVolverRestablecerContrasena()" type="submit">
                          Volver
                      </button>
                    </div>
                    <div class="col-sm-4">
                      <button class="btn btn-success col-12" onclick="fnValidarDatos(codigoAleatorioGenerado)" type="submit">
                          Enviar
                      </button>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    <!-- Bootstrap JS -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- JS Propios -->
    <script src="../js/restablecercontrasena/fnValidarDatos.js"></script>
    <script src="../js/restablecercontrasena/fnVolverRestablecerContrasena.js"></script>
    <script>
      var codigoAleatorioGenerado = "<?php echo $codigoAleatorioGenerado; ?>";
    </script>
    <script src="../js/fnFechayHora.js"></script>
  </body>

</html>