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
    <link rel="icon" type="image/x-icon" href="../images/favicon.png">   <!-- Favicon descargado de icons8.com -->

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
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  </head>
  <body style="background-color: #f2f2f2">
    <div class="container align-items-center justify-content-center">
      <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
          <div class="card">
            <div class="card-header">
                <h4 style="float: left;">
                  Ferr O'Tec &nbsp;
                </h4>
                    <img style="float: left; margin-right: 20px;" width="30px" height="30px" src="../images/favicon.png">
                <h4 style="float: left;">
                  ABM Articulos &nbsp;
                </h4>
                <h4 style="float: right;">
                    <label id="texto-fecha-hora"> </label>
                    <a href="../logout/logout.php" class="btn btn-warning"> LOGOUT </a>
                </h4>
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
                        <option id="tipo-actividad" value="0"> Seleccione... </option>
                        <option id="tipo-actividad" value="1"> Alta </option>
                        <option id="tipo-actividad" value="2"> Baja </option>
                        <option id="tipo-actividad" value="3"> Modificación </option>
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
                                Nombre De Artículo:
                            </h6>
                        </div>
                        <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30"  id="nombre-articulo-alta-input" placeholder="Ingrese Nombre" ></input>                            
                        </div>
                    </div>
                    <div class="row py-2" id="marca-articulo-alta-fila">
                        <div class="col-4 justify-content-center align-content-center" id="marca-articulo-alta-titulo">
                            <h6 id="marca-articulo-label"> 
                                Marca:
                            </h6>
                        </div>
                        <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30"  id="marca-articulo-alta-input" placeholder="Ingrese Nombre de la Marca" ></input>                            
                        </div>
                    </div>
                    <div class="row py-2" id="descripcion-articulo-alta-fila">
                        <div class="col-4 justify-content-center align-content-center" id="descripcion-articulo-alta-titulo">
                            <h6 id="descripcion-articulo-label"> 
                                Descripción:
                            </h6>
                        </div>
                        <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="100"  id="descripcion-articulo-alta-input" placeholder="Ingrese Descripcion" ></input>                            
                        </div>
                    </div>
                    <div class="row py-2" id="precio-articulo-alta-fila">
                        <div class="col-4 justify-content-center align-content-center" id="precio-articulo-alta-titulo">
                            <h6 id="precio-articulo-label"> 
                                Precio:
                            </h6>
                        </div>
                        <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="20"  id="precio-articulo-alta-input" placeholder="Ingrese Precio Unitario" ></input>                            
                        </div>
                    </div>
                    <div class="row py-2" id="cat-articulo-alta-fila">
                        <div class="col-4 justify-content-center align-content-center" id="cat-articulo-alta-titulo">
                            <h6 id="email-articulo-label"> 
                                Categoría de Artículo:
                            </h6>
                        </div>
                        <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30"  id="cat-articulo-alta-input" placeholder="Ingrese Categoría" ></input>                            
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
                            Nombre De Artículo:
                        </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30" id="nombre-articulo-baja-input" placeholder="Ingrese Nombre" ></input>                            
                        </div>
                  </div>
                  <div class="row py-2" id="botones-baja-fila">
                      <div class="col-4 justify-content-end align-content-end" id="botones-baja-volver">
                        <button onclick="fnSinCambios('B','V')"  type="button" class="btn btn-primary col-12">
                          Volver
                        </button>
                      </div>
                      <div class="col-4 justify-content-end align-content-end" id="botones-baja-dardebaja">
                        <button onclick="fnBajaArticulo()" type="button" class="btn btn-success col-12">
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
                            Nombre De Artículo a Modificar:
                        </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30" id="nombre-articulo-modificacion-input" placeholder="Ingrese Nombre" ></input>                            
                        </div>
                  </div>
                  <div class="row py-2" id="renombre-articulo-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="renombre-articulo-titulo-baja">
                        <h6 id="renombre-articulo-label-baja"> 
                            Nuevo Nombre De Artículo:
                        </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30" id="renombre-articulo-modificacion-input" placeholder="Ingrese el Nuevo Nombre" ></input>                            
                        </div>
                  </div>
                  <div class="row py-2" id="marca-articulo-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="marca-articulo-titulo-baja">
                      <h6 id="marca-articulo-label-baja"> 
                        Marca:
                      </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                      <input class="col-12 form-control" minlength="8" maxlength="30" id="marca-articulo-modificacion-input" placeholder="Ingrese Marca" ></input>                            
                    </div>
                  </div>
                  <div class="row py-2" id="descripcion-articulo-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="descripcion-articulo-titulo-baja">
                      <h6 id="descripcion-articulo-label-baja"> 
                        Descripción:
                      </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                      <input class="col-12 form-control" minlength="8" maxlength="100" id="descripcion-articulo-modificacion-input" placeholder="Ingrese Descripción" ></input>                            
                    </div>
                  </div>
                  <div class="row py-2" id="precio-articulo-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="precio-articulo-titulo-baja">
                      <h6 id="precio-articulo-label-baja"> 
                        Precio:
                      </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                      <input class="col-12 form-control" minlength="8" maxlength="20" id="precio-articulo-modificacion-input" placeholder="Ingrese Precio Unitario" ></input>                            
                    </div>
                  </div>
                  <div class="row py-2" id="cat-articulo-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="cat-articulo-titulo-baja">
                      <h6 id="cat-articulo-label-baja"> 
                        Categoría de Artículo:
                      </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                      <input class="col-12 form-control" minlength="8" maxlength="30" id="cat-articulo-modificacion-input" placeholder="Ingrese Categoría" ></input>                            
                    </div>
                  </div>
                  <div class="row py-2" id="estado-articulo-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="estado-articulo-modificacion-select">
                      <h6 id="estado-articulo-modificacion-label-baja"> 
                        Activo:
                      </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                      <select class="form-select" id="acciones-estado-modificacion-articulo">
                        <option id="acciones-estado-modificacion-articulo" value=""> Seleccione... </option>
                        <option id="acciones-estado-modificacion-articulo" value="1"> Si </option>
                        <option id="acciones-estado-modificacion-articulo" value="0"> No </option>
                      </select>                 
                    </div>
                  </div>
                  <div class="row py-2" id="botones-modificacion-fila">
                    <div class="col-4 justify-content-end align-content-end" id="botones-modificacion-volver">
                      <button onclick="fnSinCambios('M','V')"  type="button" class="btn btn-primary col-12">
                        Volver
                      </button>
                    </div>
                    <div class="col-4 justify-content-end align-content-end" id="botones-modificacion-modificar">
                      <button onclick="fnModificarArticulo()" type="button" class="btn btn-success col-12">
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
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Funciones Propias JS -->
    <script type="text/javascript" src="../js/abmarticulos/fnHabilitarOpciones.js"></script>
    <script type="text/javascript" src="../js/abmarticulos/fnSinCambios.js"></script>
    <script type="text/javascript" src="../js/abmarticulos/fnCrearArticulo.js"></script>
    <script type="text/javascript" src="../js/abmarticulos/fnBajaArticulo.js"></script>
    <script type="text/javascript" src="../js/abmarticulos/fnModificarArticulo.js"></script>
    <script src="../js/fnFechayHora.js"></script>
    <script>
      window.addEventListener('load', function() {
          fnHabilitarOpciones(0);
      });
  </script>
  </body>
</html>
