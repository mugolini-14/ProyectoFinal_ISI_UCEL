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
      Ferr O' Tec 
    </title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
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
                    <img style="float: left;" width="30px" height="30px" src="images/favicon.png">
                <h4 style="float: right;">
                    <label id="texto-fecha-hora"> </label>
                </h4>
            </div>
            <div class="card-body">
              <form action="login/login_ingreso.php" method="POST">
                <div class="form-group">
                  <input onchange=fnCopiarUsuarioParaRecuperar() type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" required>
                </div>
                <br>
                <div class="form-group">
                  <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Contraseña">
                </div>
                <br>
                <div class="form-group">
                  <button style="float: left;" type="submit" class="btn btn-primary col-4">
                      Ingresar
                  </button>
                </div>
              </form>
              <form action="login/login_restablecer.php" method="POST">
                <div class="form-group"> 
                  <input type="text" class="form-control" id="usuario-restablecer" name="usuario-restablecer" placeholder="usuario-restablecer" hidden>
                </div>
                <div class="form-group">
                  <button style="float: right;" type="submit" class="btn btn-primary col-4">
                      Restablecer Contraseña
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
    <script src="js/fnFechayHora.js"></script>
    <script>
         document.getElementById('usuario').addEventListener('click', function(){
         document.getElementById('usuario-restablecer').value = this.value;
          });

        document.getElementById('usuario').addEventListener('input', function(){
        document.getElementById('usuario-restablecer').value = this.value;
        });
    </script>
  </body>

</html>







