<?php
/*
session_start();
if(!$_SESSION['logged']){
   header("Location: ../login.html");
   exit;
}elseif($_SESSION['usu_id_permisos'] <= 2){
  header("Location: ../index/index.php");
  exit;
}
*/
?>
<!DOCTYPE html>
<html lang="en">

  <head>
  <script>
    window.addEventListener('load', function() {
        // Código que deseas ejecutar después de que la página se haya cargado completamente
        fnHabilitarOpciones(0);
    });
  </script>

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
    <!-- Llamada a funciones de javascript -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <a href="../logout/logout.php" class="btn btn-primary">Logout</a>
  </head>
  <body style="background-color: #f2f2f2">
    <div class="container align-items-center justify-content-center">
      <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
          <div class="card">
            <div class="card-header" >
              <h4 style="float: left;">
                  ABM Tipos &nbsp;
              </h4>
              <h4 style="float: right;">
                  <label id="texto-fecha-hora"> </label>
              </h4>
                  <img style="float: right;" width="30px" height="30px" src="../../images/favicon.png">
            </div>
            <div class="card-body">
                <div class="row py-2">
                    <div class="col-4 justify-content-center">
                        <h5>
                            Acción:
                        </h5>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                      <select onchange="fnHabilitarOpciones(value)"class="form-select" id="acciones">
                        <option id="acciones-seleccione" value="0"> Seleccione </option>
                        <option id="acciones-alta" value="1"> Alta </option>
                        <option id="acciones-baja" value="2"> Baja </option>
                        <option id="acciones-modificacion" value="3"> Modificación </option>
                      </select>                            
                  </div>
                </div>
                <div class="row py-2" id="botones-principal-volver-fila">
                  <div class="col-12 justify-content-center">
                      <button onclick="fnSinCambios('P','V')" id="botones-principal-volver" type="button" class="btn btn-primary col-12">
                        Volver
                      </button>
                  </div>
                </div>
                <form id="formulario-alta">
                    <div class="row py-2" id="nombre-tipo-alta-fila">
                        <div class="col-4 justify-content-center align-content-center" id="nombre-tipo-alta-titulo">
                            <h6 id="nombre-tipo-label"> 
                                Nombre De tipo:
                            </h6>
                        </div>
                        <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30" onchange="fnHabilitarPerfiltipo('A',1)" id="nombre-tipo-alta-input" placeholder="Ingrese Nombre de tipo" ></input>                            
                        </div>
                    </div>
                    <div class="row py-2" id="descripcion-tipo-alta-fila">
                        <div class="col-4 justify-content-center align-content-center" id="descripcion-tipo-alta-titulo">
                            <h6 id="descripcion-tipo-label"> 
                                Descripcion:
                            </h6>
                        </div>
                        <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="100" onchange="fnHabilitarPerfiltipo('A',1)" id="descripcion-tipo-alta-input" placeholder="Ingrese descripción" ></input>                            
                        </div>
                    </div>
                    <div class="row py-2" id="botones-alta-fila">
                      <div class="col-4 justify-content-end align-content-end" id="botones-alta-volver">
                        <button onclick="fnSinCambios('A','V')"  type="button" class="btn btn-primary col-12">
                          Volver
                        </button>
                      </div>
                      <div class="col-4 justify-content-end align-content-end" id="botones-alta-crear">
                        <button onclick="fnCreartipo()" type="button" class="btn btn-success col-12">
                          Crear
                        </button>
                      </div>
                      <div class="col-4 justify-content-end align-content-end" id="botones-alta-cancelar">
                        <button onclick="fnSinCambios('A','C')" type="button" class="btn btn-danger col-12">
                          Cancelar
                        </button>
                      </div>
                    </div>
                </form>
                <!-- FIN SECCIÓN ALTA 
                      FIN SECCIÓN ALTA            
                -->
                <!-- EMPIEZA SECCIÒN BAJA 
                     EMPIEZA SECCIÒN BAJA            
                -->
                <form id="formulario-baja">
                  <div class="row py-2" id="nombre-tipo-baja-fila">
                    <div class="col-4 justify-content-center align-content-center" id="nombre-tipo-titulo-baja">
                        <h6 id="nombre-tipo-label-baja"> 
                            Nombre De tipo:
                        </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30" onchange="fnHabilitarPerfiltipo('B',1)" id="nombre-tipo-baja-input" placeholder="Ingrese Nombre" ></input>                            
                    </div>
                  </div>
                  <div class="row py-2" id="botones-baja-fila">
                      <div class="col-4 justify-content-end align-content-end" id="botones-baja-volver">
                        <button onclick="fnSinCambios('B','V')"  type="button" class="btn btn-primary col-12">
                          Volver
                        </button>
                      </div>
                      <div class="col-4 justify-content-end align-content-end" id="botones-baja-dardebaja">
                        <button onclick="fnBajatipo()" type="button" class="btn btn-success col-12">
                          Dar de Baja
                        </button>
                      </div>
                      <div class="col-4 justify-content-end align-content-end" id="botones-baja-cancelar">
                        <button onclick="fnSinCambios('B','C')" type="button" class="btn btn-danger col-12">
                          Cancelar
                        </button>
                      </div>
                  </div>
                </form>
                <!-- FIN SECCIÓN BAJA 
                      FIN SECCIÓN BAJA            
                -->
                <!-- EMPIEZA SECCIÒN MODIFICACIÓN 
                     EMPIEZA SECCIÒN MODIFICACIÓN            
                -->
                <form id="formulario-modificacion">
                  <div class="row py-2" id="nombre-tipo-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="nombre-tipo-titulo-baja">
                        <h6 id="nombre-tipo-label-baja"> 
                            Nombre De tipo:
                        </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30" onchange="fnHabilitarPerfiltipo('M',1)" id="nombre-tipo-modificacion-input" placeholder="Ingrese Nombre de tipo" ></input>                            
                        </div>
                  </div>
                  <div class="row py-2" id="renombre-tipo-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="renombre-tipo-titulo-baja">
                        <h6 id="renombre-tipo-label-baja"> 
                            Renombrar Nombre De tipo:
                        </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30" onchange="fnHabilitarPerfiltipo('M',1)" id="renombre-tipo-modificacion-input" placeholder="Ingrese el nuevo Nombre de tipo" ></input>                            
                        </div>
                  </div>
                  <div class="row py-2" id="descripcion-tipo-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="descripcion-tipo-titulo-baja">
                      <h6 id="descripcion-tipo-label-baja"> 
                        Descripción:
                      </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                      <input class="col-12 form-control" minlength="8" maxlength="100" onchange="fnHabilitarPerfiltipo('M',1)" id="descripcion-tipo-modificacion-input" placeholder="Ingrese descripción" ></input>                            
                    </div>
                  </div>
                  <div class="row py-2" id="botones-modificacion-fila">
                    <div class="col-4 justify-content-end align-content-end" id="botones-modificacion-volver">
                      <button onclick="fnSinCambios('M','V')"  type="button" class="btn btn-primary col-12">
                        Volver
                      </button>
                    </div>
                    <div class="col-4 justify-content-end align-content-end" id="botones-modificacion-modificar">
                      <button onclick="fnModificartipo()" type="button" class="btn btn-success col-12">
                        Modificar
                      </button>
                    </div>
                    <div class="col-4 justify-content-end align-content-end" id="botones-modificacion-cancelar">
                      <button onclick="fnSinCambios('M','C')" type="button" class="btn btn-danger col-12">
                        Cancelar
                      </button>
                    </div>
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Funciones Propias JS -->
    <script type="text/javascript" src="../js/abmtipos/fnHabilitarOpciones.js"></script>
    <script type="text/javascript" src="../js/abmtipos/fnAltaHabilitarPerfiltipo.js"></script>
    <script type="text/javascript" src="../js/abmtipos/fnModificacionHabilitarPerfiltipo.js"></script>
    <script type="text/javascript" src="../js/abmtipos/fnAltaPerfilesDetipo.js"></script>
    <script type="text/javascript" src="../js/abmtipos/fnModificacionPerfilesDetipo.js"></script>
    <script type="text/javascript" src="../js/abmtipos/fnSinCambios.js"></script>
    <script type="text/javascript" src="../js/abmtipos/fnHabilitarPerfiltipo.js"></script>
    <script type="text/javascript" src="../js/abmtipos/fnPerfilesDetipo.js"></script>
    <script type="text/javascript" src="../js/abmtipos/fnCreartipo.js"></script>
    <script type="text/javascript" src="../js/abmtipos/fnBajatipo.js"></script>
    <script type="text/javascript" src="../js/abmtipos/fnModificartipo.js"></script>
    <!-- JS Propios -->
    <script src="../../Js Propios/js-fechayhora.js"></script>
  </body>
</html>
