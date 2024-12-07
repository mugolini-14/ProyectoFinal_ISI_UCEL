<?php
  session_start();
  if(!$_SESSION['logged']){
    header("Location: ../login.php");
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
            <div class="card-header" >
              <h4 style="float: left;">
                  Acerca De
              </h4>
              <img style="float: right;" width="30px" height="30px" src="images/favicon.png">
            </div>
            <div class="card-body">
                <div class="row justify-content-center align-items-center">
                    <div class="col-8 text-center">
                        <h5>
                            Ferr O' Tec <br>
                            Sistema Web programado para poder aprobar el Proyecto Final <br>
                            Para la carrera de Ingeniería en Sistemas de Información (ISI)
                        </h5>
                        <br>
                    </div>
                    <div class="col-4 justify-content-center align-items-center text-center">
                        <img class="img-fluid" src="images/img-alumno.jpg">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <div class="accordion" id="accordion-acercade">
                            <div class="accordion-item" id="accordion-item-datosalumno">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed bg-opacity-25 bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-item-datosdelalumno" aria-expanded="true" aria-controls="accordion-item-datosdelalumno">
                                        Datos del Alumno
                                    </button>
                                </h2>
                                <div id="accordion-item-datosdelalumno" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <ul>
                                            <li><I> Nombre: </I> <I> <B> Mauricio Germán Ugolini </B> </I> </li>
                                            <li><I> Nro. Legajo: </I> <I> <B> 18220 </B> </I> </li>
                                            <li><I> Curso: </I> <I> <B> 5to S2 (Convenios) </B> </I> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed bg-opacity-25 bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-item-tecnologiasutilizadas" aria-expanded="true" aria-controls="accordion-item-tecnologiasutilizadas">
                                        Tecnologías Utilizadas
                                    </button>
                                </h2>
                                <div id="accordion-item-tecnologiasutilizadas" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <ul>
                                            <li><I> Frontend: </I> <I> <B> HTML5 / CSS3 </B> </I> </li>
                                            <li><I> Funciones Frontend: </I> <I> <B> JavaScript </B> </I> </li>
                                            <li><I> Backend Servidor: </I> <I> <B> PHP / MySQL </B> </I> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed bg-opacity-25 bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-item-herramientasutilizadas" aria-expanded="true" aria-controls="accordion-item-herramientasutilizadas">
                                        Herramientas Utilizadas
                                    </button>
                                </h2>
                                <div id="accordion-item-herramientasutilizadas" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <ul>
                                            <li><I> IDEFrontend: </I> <I> <B> Visual Studio Code </B> </I> </li>
                                            <li><I> Librerías Frontend: </I> <I> <B> Bootstrap v. 5.3 </B> </I> </li>
                                            <li><I> Backend Servidor: </I> <I> <B> XAMPP / PHPmyAdmin </B> </I> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col text-center">
                        <a class="btn bg-opacity-25 bg-primary" href="index.html"> Volver </a>
                    </div>
                </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>

</html>
