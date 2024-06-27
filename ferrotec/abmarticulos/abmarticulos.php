<?php
/*
session_start();
if(!$_SESSION['logged']){
   header("Location: ../login.php");
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
    <meta property="og:url" content="login.php" />
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
                  ABM Artículos &nbsp;
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
                    <div class="row py-2" id="nombre-articulo-alta-fila">
                        <div class="col-4 justify-content-center align-content-center" id="nombre-articulo-alta-titulo">
                            <h6 id="nombre-articulo-label"> 
                                Nombre De articulo:
                            </h6>
                        </div>
                        <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30" onchange="fnHabilitarPerfilArticulo('A',1)" id="nombre-articulo-alta-input" placeholder="Ingrese Nombre de articulo" ></input>                            
                        </div>
                    </div>
                    <div class="row py-2" id="marca-articulo-alta-fila">
                        <div class="col-4 justify-content-center align-content-center" id="marca-articulo-alta-titulo">
                            <h6 id="marca-articulo-label"> 
                                Marca:
                            </h6>
                        </div>
                        <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30" onchange="fnHabilitarPerfilArticulo('A',1)" id="marca-articulo-alta-input" placeholder="Ingrese Nombre de la marca del articulo" ></input>                            
                        </div>
                    </div>
                    <div class="row py-2" id="descripcion-articulo-alta-fila">
                        <div class="col-4 justify-content-center align-content-center" id="descripcion-articulo-alta-titulo">
                            <h6 id="descripcion-articulo-label"> 
                                Descripcion:
                            </h6>
                        </div>
                        <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="100" onchange="fnHabilitarPerfilArticulo('A',1)" id="descripcion-articulo-alta-input" placeholder="Ingrese descripcion del articulo" ></input>                            
                        </div>
                    </div>
                    <div class="row py-2" id="precio-articulo-alta-fila">
                        <div class="col-4 justify-content-center align-content-center" id="precio-articulo-alta-titulo">
                            <h6 id="precio-articulo-label"> 
                                Precio:
                            </h6>
                        </div>
                        <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="20" onchange="fnHabilitarPerfilArticulo('A',1)" id="precio-articulo-alta-input" placeholder="Ingrese precio individual del articulo" ></input>                            
                        </div>
                    </div>
                    <div class="row py-2" id="cat-articulo-alta-fila">
                        <div class="col-4 justify-content-center align-content-center" id="cat-articulo-alta-titulo">
                            <h6 id="email-articulo-label"> 
                                Categoría de artículo:
                            </h6>
                        </div>
                        <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30" onchange="fnHabilitarPerfilArticulo('A',1)" id="cat-articulo-alta-input" placeholder="Ingrese Categoría" ></input>                            
                        </div>
                    </div>
                    <div class="row py-2" id="botones-alta-fila">
                      <div class="col-4 justify-content-end align-content-end" id="botones-alta-volver">
                        <button onclick="fnSinCambios('A','V')"  type="button" class="btn btn-primary col-12">
                          Volver
                        </button>
                      </div>
                      <div class="col-4 justify-content-end align-content-end" id="botones-alta-crear">
                        <button onclick="fnCrearArticulo()" type="button" class="btn btn-success col-12">
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
                  <div class="row py-2" id="nombre-articulo-baja-fila">
                    <div class="col-4 justify-content-center align-content-center" id="nombre-articulo-titulo-baja">
                        <h6 id="nombre-articulo-label-baja"> 
                            Nombre De articulo:
                        </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30" onchange="fnHabilitarPerfilArticulo('B',1)" id="nombre-articulo-baja-input" placeholder="Ingrese Nombre" ></input>                            
                        </div>
                  </div>
                  <div class="row py-2" id="botones-baja-fila">
                      <div class="col-4 justify-content-end align-content-end" id="botones-baja-volver">
                        <button onclick="fnSinCambios('B','V')"  type="button" class="btn btn-primary col-12">
                          Volver
                        </button>
                      </div>
                      <div class="col-4 justify-content-end align-content-end" id="botones-baja-dardebaja">
                        <button onclick="fnBajaarticulo()" type="button" class="btn btn-success col-12">
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
                <div class="row py-2" id="nombre-articulo-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="nombre-articulo-titulo-baja">
                        <h6 id="nombre-articulo-label-baja"> 
                            Nombre De articulo a modificar:
                        </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30" onchange="fnHabilitarPerfilArticulo('M',1)" id="nombre-articulo-modificacion-input" placeholder="Ingrese Nombre de articulo" ></input>                            
                        </div>
                  </div>
                  <div class="row py-2" id="renombre-articulo-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="renombre-articulo-titulo-baja">
                        <h6 id="reombre-articulo-label-baja"> 
                            Nuevo nombre De articulo:
                        </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30" onchange="fnHabilitarPerfilArticulo('M',1)" id="renombre-articulo-modificacion-input" placeholder="Ingrese Nombre de articulo" ></input>                            
                        </div>
                  </div>
                  <div class="row py-2" id="marca-articulo-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="marca-articulo-titulo-baja">
                      <h6 id="marca-articulo-label-baja"> 
                      Marca:
                      </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                      <input class="col-12 form-control" minlength="8" maxlength="30" onchange="fnHabilitarPerfilArticulo('M',1)" id="marca-articulo-modificacion-input" placeholder="Ingrese Marca del Artículo" ></input>                            
                    </div>
                  </div>
                  <div class="row py-2" id="descripcion-articulo-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="descripcion-articulo-titulo-baja">
                      <h6 id="descripcion-articulo-label-baja"> 
                      Descripcion:
                      </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                      <input class="col-12 form-control" minlength="8" maxlength="100" onchange="fnHabilitarPerfilArticulo('M',1)" id="descripcion-articulo-modificacion-input" placeholder="Ingrese una descripción del Artículo" ></input>                            
                    </div>
                  </div>
                  <div class="row py-2" id="precio-articulo-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="precio-articulo-titulo-baja">
                      <h6 id="precio-articulo-label-baja"> 
                      Precio:
                      </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                      <input class="col-12 form-control" minlength="8" maxlength="20" onchange="fnHabilitarPerfilArticulo('M',1)" id="precio-articulo-modificacion-input" placeholder="Ingrese precio del artículo" ></input>                            
                    </div>
                  </div>
                  <div class="row py-2" id="cat-articulo-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="cat-articulo-titulo-baja">
                      <h6 id="cat-articulo-label-baja"> 
                      Categoría de artículo::
                      </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                      <input class="col-12 form-control" minlength="8" maxlength="30" onchange="fnHabilitarPerfilArticulo('M',1)" id="cat-articulo-modificacion-input" placeholder="Ingrese categoría de artículo" ></input>                            
                    </div>
                  </div>
                  <div class="row py-2" id="botones-modificacion-fila">
                    <div class="col-4 justify-content-end align-content-end" id="botones-modificacion-volver">
                      <button onclick="fnSinCambios('M','V')"  type="button" class="btn btn-primary col-12">
                        Volver
                      </button>
                    </div>
                    <div class="col-4 justify-content-end align-content-end" id="botones-modificacion-modificar">
                      <button onclick="fnModificararticulo()" type="button" class="btn btn-success col-12">
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
    <script type="text/javascript" src="../js/abmarticulos/fnHabilitarOpciones.js"></script>
    <script type="text/javascript" src="../js/abmarticulos/fnAltaHabilitarPerfilarticulo.js"></script>
    <script type="text/javascript" src="../js/abmarticulos/fnModificacionHabilitarPerfilarticulo.js"></script>
    <script type="text/javascript" src="../js/abmarticulos/fnAltaPerfilesDearticulo.js"></script>
    <script type="text/javascript" src="../js/abmarticulos/fnModificacionPerfilesDearticulo.js"></script>
    <script type="text/javascript" src="../js/abmarticulos/fnSinCambios.js"></script>
    <script type="text/javascript" src="../js/abmarticulos/fnHabilitarPerfilArticulo.js"></script>
    <script type="text/javascript" src="../js/abmarticulos/fnPerfilesDearticulo.js"></script>
    <script type="text/javascript" src="../js/abmarticulos/fnCreararticulo.js"></script>
    <script type="text/javascript" src="../js/abmarticulos/fnBajaarticulo.js"></script>
    <script type="text/javascript" src="../js/abmarticulos/fnModificararticulo.js"></script>
    <!-- JS Propios -->
    <script src="../../Js Propios/js-fechayhora.js"></script>
  </body>
</html>
