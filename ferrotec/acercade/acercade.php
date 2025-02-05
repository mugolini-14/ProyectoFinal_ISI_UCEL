<?php

session_start();
if(!$_SESSION['logged']){
   header("Location: ../login.php");
}

$id_permiso = $_SESSION['usu_id_permisos'];
?>

<html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width" ,="" initial-scale="1.0">
    <link rel="icon" type="image/x-icon" href="../images/favicon.png">   <!-- Favicon descargado de icons8.com -->

    <!-- Open Graph -->
    <meta property="og:title" content="Ferr O&#39;Tec - Login">
    <meta property="og:type" content="article">
    <meta property="og:url" content="login.html">
    <meta property="og:image" content="">
    <meta property="og:description" content="Login">
    <title>
        Ferr O' Tec 
    </title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <style type="text/css" id="operaUserStyle"></style></head>
    <style>
        img {
            display: block;
            max-width: 100%;
            height: 100%;
        }
    </style>

    <body style="background-color: #f2f2f2" onload="fnFechayHora();">
        <div class="container-fluid justify-content-center">
            <div class="row justify-content-center">
                <div class="col-md-8 mt-5"> 
                    <div class="card col-12">
                        <div class="card-header">
                            <h4 style="float: left;">
                                Ferr O'Tec &nbsp;
                            </h4>
                                <img style="float: left;" width="30px" height="30px" src="../images/favicon.png">
                            <h4 style="float: right;">
                                <label id="texto-fecha-hora"> </label>
                                <a href="../logout/logout.php" class="btn btn-warning"> LOGOUT </a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="col-12">
                                <table class="table col-12">
                                    <tbody>
                                        <tr>
                                            <td class="align-middle">    
                                                <H3> Sistema Ferr O'Tec </H3>
                                                <br>
                                                <H5> Sistema desarrollado como parte del Proyecto Final para la Carrera de Ingeniería en Sistemas de Información (ISI) </H5>
                                            </td>
                                            <td> 
                                                <img class="rounded mx-auto d-block" src="../images/img-logo.jpg" width="200px" height="250px">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="accordion" id="accordion-index">    
                                    <div class="accordion-item" id="integrantes">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed bg-opacity-50" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-item-integrantes" aria-expanded="true" aria-controls="accordion-item-integrantes">
                                                Integrantes
                                            </button>
                                        </h2>
                                        <div id="accordion-item-integrantes" class="accordion-collapse collapse">
                                            <div class="accordion-body">
                                                <div class="form-group row align-items-center">
                                                    <div class="col-8 align-middle"> 
                                                        Fabricio Paulo Gallina Nizzo
                                                        <br>
                                                        Nro. Legajo: ?
                                                    </div>
                                                    <div class="col-4"> 
                                                        <img class="rounded float-end" src="../images/img-logo.jpg" width="100px" height="100px">
                                                    </div>
                                                </div>
                                                <div class="form-group row align-items-center">
                                                    <div class="col-8 align-middle"> 
                                                        Mauricio Germán Ugolini
                                                        <br>
                                                        Nro. Legajo: 18220
                                                    </div>
                                                    <div class="col-4"> 
                                                        <img class="rounded float-end" src="../images/img-alumno.jpg" width="100px" height="100px">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item" id="tecnologias-utilizadas">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed bg-opacity-50" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-item-tecno" aria-expanded="true" aria-controls="accordion-item-tecno">
                                                Tecnologías Utilizadas
                                            </button>
                                        </h2>
                                        <div id="accordion-item-tecno" class="accordion-collapse collapse">
                                            <div class="accordion-body">
                                                <ul>
                                                    <li>
                                                        <U> Frontend:</U> HTML / CCS / Javascript / 
                                                    </li>
                                                    <li>
                                                        <U> Backend:</U> PHP
                                                    </li>
                                                    <li>
                                                        <u> Base de Datos:</u> MySQL
                                                    </li>
                                                    <li>
                                                        <u> Librerías Adicionales:</u> Bootstrap, TCPDF, jQuery
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item" id="herramientas-utilizadas">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed bg-opacity-50" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-item-herramientas" aria-expanded="true" aria-controls="accordion-item-herramientas">
                                                Herramientas Utilizadas
                                            </button>
                                        </h2>
                                        <div id="accordion-item-herramientas" class="accordion-collapse collapse">
                                            <div class="accordion-body">
                                                <ul>
                                                    <li>
                                                        Microsoft Visual Studio Code 
                                                    </li>
                                                    <li>
                                                        Microsoft Visio 2016
                                                    </li>
                                                    <li>
                                                        Microsoft Word 2016
                                                    </li>
                                                    <li>
                                                        Microsoft Excel 2016
                                                    </li>
                                                    <li>
                                                        Microsoft PowerPoint 2016 
                                                    </li>
                                                    <li>
                                                        Microsoft Outlook 
                                                    </li>
                                                    <li>
                                                        Google Chrome 
                                                    </li>
                                                    <li>
                                                        XAMMP (Apache Server + PHP + phpmyadmin + SendMail + MySQL) 
                                                    </li>
                                                    <li>
                                                        Git 
                                                    </li>
                                                    <li>
                                                        GitHub 
                                                    </li>
                                                    <li>
                                                        Google Gmail 
                                                    </li>
                                                    <li>
                                                        Whatsapp 
                                                    </li>
                                                    <li>
                                                        MailJet 
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-4">
                                        <label class="col-form-label"><i>Usuario: </i><i><?php echo $_SESSION['usu_nombre']." ".$_SESSION['usu_apellido']; ?></i></label>
                                    </div>
                                    <div class="col-4 text-center">
                                        <label class="col-form-label"><i> Versión:  1.0.0-FINAL </i> </label>
                                    </div>
                                    <div class="col-4 text-end">
                                        <a class="btn btn-primary col-8" href="../index/index.php"> Volver </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="../bootstrap/js/bootstrap.min.js"> </script>

        <!-- JS Propios -->
        <script src="../js/fnFechayHora.js"> </script>

	</body>
</html>