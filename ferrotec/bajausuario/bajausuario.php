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
    <body onload="fnHabilitarOpciones(0)" style="background-color: #f2f2f2">
        <div class="container align-items-center justify-content-center">
            <div class="row justify-content-center">
                <div class="col-md-6 mt-5">
                    <div class="card">
                        <div class="card-header" >
                            <h4 style="float: left;">
                                Baja de Usuario
                            </h4>
                            <img style="float: right;" width="30px" height="30px" src="images/favicon.png">
                        </div>
                        <div class="card-body">
                            <form id="formulario-baja">
                                <div class="row py-2" id="nombre-usuario-baja-fila">
                                <div class="col-4 justify-content-center align-content-center" id="nombre-usuario-titulo-baja">
                                    <h6 id="nombre-usuario-label-baja"> 
                                        Nombre De Usuario:
                                    </h6>
                                </div>
                                <div class="col-8 container-fluid justify-content-center align-content-center">
                                    <select class="form-select" id="seleccion-usuario-baja">
                                        <option id="seleccion-usuario-baja-seleccione" value="0"> Seleccione </option>
                                        <option id="seleccion-usuario-baja-usuario1" aria-required="true" value="1"> ListaUsuarios </option>
                                    </select>                          
                                </div>
                                </div>
                                <div class="row py-2" id="botones-baja-fila">
                                    <div class="col-4 justify-content-end align-content-end" id="botones-baja-volver">
                                    <button onclick="fnSinCambios('B','V')"  type="button" class="btn btn-primary col-12">
                                        Volver
                                    </button>
                                    </div>
                                    <div class="col-4 justify-content-end align-content-end" id="botones-baja-dardebaja">
                                    <button onclick="fnBajaUsuario()" type="submit" class="btn btn-success col-12">
                                        Dar de Baja
                                    </button>
                                    </div>
                                    <div class="col-4 justify-content-end align-content-end" id="botones-baja-cancelar">
                                    <button onclick="fnSinCambios('B','C')" type="button" class="btn btn-danger col-12">
                                        Cancelar
                                    </button>
                                    </div>
                                </div>
                                <div class="row py-2" id="fila-label" hidden>
                                    <div class="col-12 justify-content-end align-content-end" id="fila-label-columna">
                                    <label onchange="document.getElementbyId('fila-label').display = 'true';">
                                        <?
                                        error_reporting(E_ALL ^ E_NOTICE);
                                        if ($_GET['resultado']==0){
                                            ?>
                                            <label style="background-color:green;"> Usuario dado de Alta con Éxito. </label>
                                            <?
                                        }
                                        ?>
                                    </label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>