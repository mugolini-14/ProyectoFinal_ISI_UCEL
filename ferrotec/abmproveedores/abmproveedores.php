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
                  ABM Proveedores &nbsp;
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
                    <div class="row py-2" id="nombre-proveedor-alta-fila">
                        <div class="col-4 justify-content-center align-content-center" id="nombre-proveedor-alta-titulo">
                            <h6 id="nombre-proveedor-label"> 
                                Nombre / Razón Social:
                            </h6>
                        </div>
                        <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30"  id="nombre-proveedor-alta-input" placeholder="Ingrese Nombre de Proveedor" required></input>                            
                        </div>
                    </div>
                    <div class="row py-2" id="descripcion-proveedor-alta-fila">
                        <div class="col-4 justify-content-center align-content-center" id="descripcion-proveedor-alta-titulo">
                            <h6 id="descripcion-proveedor-label"> 
                                Descripción:
                            </h6>
                        </div>
                        <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="100"  id="descripcion-proveedor-alta-input" placeholder="Ingrese una Descripción" required></input>                            
                        </div>
                    </div>
                    <div class="row py-2" id="direccion-proveedor-alta-fila">
                        <div class="col-4 justify-content-center align-content-center" id="direccion-proveedor-alta-titulo">
                            <h6 id="direccion-proveedor-label"> 
                                Dirección:
                            </h6>
                        </div>
                        <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30"  id="direccion-proveedor-alta-input" placeholder="Ingrese Dirección" required></input>                            
                        </div>
                    </div>
                    <div class="row py-2" id="localidad-proveedor-alta-fila">
                        <div class="col-4 justify-content-center align-content-center" id="localidad-proveedor-alta-titulo">
                            <h6 id="localidad-proveedor-label"> 
                                Localidad:
                            </h6>
                        </div>
                        <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30"  id="localidad-proveedor-alta-input" placeholder="Ingrese Localidad" required></input>                            
                        </div>
                    </div>
                    <div class="row py-2" id="provincia-proveedor-alta-fila">
                        <div class="col-4 justify-content-center align-content-center" id="provincia-proveedor-alta-titulo">
                            <h6 id="provincia-proveedor-label"> 
                                Provincia:
                            </h6>
                        </div>
                        <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30"  id="provincia-proveedor-alta-input" placeholder="Ingrese Provincia" required></input>                            
                        </div>
                    </div>
                    <div class="row py-2" id="telefono1-proveedor-alta-fila">
                        <div class="col-4 justify-content-center align-content-center" id="telefono1-proveedor-alta-titulo">
                            <h6 id="telefono1-proveedor-label"> 
                                Teléfono 1:
                            </h6>
                        </div>
                        <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30"  id="telefono1-proveedor-alta-input" placeholder="Ingrese Teléfono 1" required></input>                            
                        </div>
                    </div>
                    <div class="row py-2" id="telefono2-proveedor-alta-fila">
                        <div class="col-4 justify-content-center align-content-center" id="telefono2-proveedor-alta-titulo">
                            <h6 id="telefono2-proveedor-label"> 
                                Teléfono 2:
                            </h6>
                        </div>
                        <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30"  id="telefono2-proveedor-alta-input" placeholder="Ingrese Teléfono 2"></input>                            
                        </div>
                    </div>
                    <div class="row py-2" id="email-proveedor-alta-fila">
                        <div class="col-4 justify-content-center align-content-center" id="email-proveedor-alta-titulo">
                            <h6 id="email-proveedor-label"> 
                                Correo Electrónico:
                            </h6>
                        </div>
                        <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30"  id="email-proveedor-alta-input" placeholder="Ingrese Correo" required></input>                            
                        </div>
                    </div>
                    <div class="row py-2" id="cuit-proveedor-alta-fila">
                        <div class="col-4 justify-content-center align-content-center" id="cuit-proveedor-alta-titulo">
                            <h6 id="cuit-proveedor-label"> 
                                CUIT:
                            </h6>
                        </div>
                        <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30"  id="cuit-proveedor-alta-input" placeholder="Ingrese CUIT" required></input>                            
                        </div>
                    </div>
                    <div class="row py-2" id="botones-alta-fila">
                      <div class="col-4 justify-content-end align-content-end" id="botones-alta-volver">
                        <button onclick="fnSinCambios('A','V')"  type="button" class="btn btn-primary col-12">
                          Volver
                        </button>
                      </div>
                      <div class="col-4 justify-content-end align-content-end" id="botones-alta-crear">
                        <button onclick="fnCrearProveedor()" type="button" class="btn btn-success col-12">
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
                  <div class="row py-2" id="nombre-proveedor-baja-fila">
                    <div class="col-4 justify-content-center align-content-center" id="nombre-proveedor-titulo-baja">
                        <h6 id="nombre-proveedor-label-baja"> 
                            Nombre Del Proveedor:
                        </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                          <input class="col-12 form-control" minlength="8" maxlength="30" id="nombre-proveedor-baja-input" placeholder="Ingrese Nombre" required></input>                            
                    </div>
                  </div>
                  <div class="row py-2" id="botones-baja-fila">
                      <div class="col-4 justify-content-end align-content-end" id="botones-baja-volver">
                        <button onclick="fnSinCambios('B','V')"  type="button" class="btn btn-primary col-12">
                          Volver
                        </button>
                      </div>
                      <div class="col-4 justify-content-end align-content-end" id="botones-baja-dardebaja">
                        <button onclick="fnBajaProveedor()" type="button" class="btn btn-success col-12">
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
                  <div class="row py-2" id="descripcion-proveedor-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="descripcion-proveedor-modificacion-titulo">
                        <h6 id="descripcion-proveedor-label"> 
                            Descripción:
                        </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                        <input class="col-12 form-control" minlength="8" maxlength="30"  id="descripcion-proveedor-modificacion-input" placeholder="Ingrese una Descripción" ></input>                            
                    </div>
                  </div>
                  <div class="row py-2" id="direccion-proveedor-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="direccion-proveedor-modificacion-titulo">
                        <h6 id="direccion-proveedor-label"> 
                            Dirección:
                        </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                        <input class="col-12 form-control" minlength="8" maxlength="30"  id="direccion-proveedor-modificacion-input" placeholder="Ingrese Dirección" ></input>                            
                    </div>
                  </div>
                  <div class="row py-2" id="localidad-proveedor-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="localidad-proveedor-modificacion-titulo">
                        <h6 id="localidad-proveedor-label"> 
                            Localidad:
                        </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                        <input class="col-12 form-control" minlength="8" maxlength="30"  id="localidad-proveedor-modificacion-input" placeholder="Ingrese Localidad" ></input>                            
                    </div>
                  </div>
                  <div class="row py-2" id="provincia-proveedor-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="provincia-proveedor-modificacion-titulo">
                        <h6 id="provincia-proveedor-label"> 
                            Provincia:
                        </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                        <input class="col-12 form-control" minlength="8" maxlength="30"  id="provincia-proveedor-modificacion-input" placeholder="Ingrese Provincia" ></input>                            
                    </div>
                  </div>
                  <div class="row py-2" id="telefono1-proveedor-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="telefono1-proveedor-modificacion-titulo">
                        <h6 id="telefono1-proveedor-label"> 
                            Teléfono 1:
                        </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                        <input class="col-12 form-control" minlength="8" maxlength="30"  id="telefono1-proveedor-modificacion-input" placeholder="Ingrese Teléfono 1" ></input>                            
                    </div>
                  </div>
                  <div class="row py-2" id="telefono2-proveedor-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="telefono2-proveedor-modificacion-titulo">
                        <h6 id="telefono2-proveedor-label"> 
                            Teléfono 2:
                        </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                        <input class="col-12 form-control" minlength="8" maxlength="30"  id="telefono2-proveedor-modificacion-input" placeholder="Ingrese Teléfono 2" ></input>                            
                    </div>
                  </div>
                  <div class="row py-2" id="email-proveedor-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="email-proveedor-modificacion-titulo">
                        <h6 id="email-proveedor-label"> 
                            Correo Electrónico:
                        </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                        <input class="col-12 form-control" minlength="8" maxlength="30"  id="email-proveedor-modificacion-input" placeholder="Ingrese Correo" ></input>                            
                    </div>
                  </div>
                  <div class="row py-2" id="cuit-proveedor-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="cuit-proveedor-modificacion-titulo">
                        <h6 id="cuit-proveedor-label"> 
                            CUIT:
                        </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                        <input class="col-12 form-control" minlength="8" maxlength="30"  id="cuit-proveedor-modificacion-input" placeholder="Ingrese CUIT" ></input>                            
                    </div>
                  </div>
                  <div class="row py-2" id="botones-modificacion-fila">
                    <div class="col-4 justify-content-end align-content-end" id="botones-modificacion-volver">
                      <button onclick="fnSinCambios('M','V')"  type="button" class="btn btn-primary col-12">
                        Volver
                      </button>
                    </div>
                    <div class="col-4 justify-content-end align-content-end" id="botones-modificacion-modificar">
                      <button onclick="fnModificarProveedor()" type="button" class="btn btn-success col-12">
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
    <script type="text/javascript" src=../../ferrotec/js/abmproveedores/fnHabilitarOpciones.js> </script>
    <script type="text/javascript" src=../../ferrotec/js/abmproveedores/fnSinCambios.js> </script>
    <script type="text/javascript" src=../../ferrotec/js/abmproveedores/fnCrearProveedor.js> </script>
    <script type="text/javascript" src=../../ferrotec/js/abmproveedores/fnBajaProveedor.js> </script>
    <script type="text/javascript" src=../../ferrotec/js/abmproveedores/fnModificarProveedor.js> </script>

    <!-- JS Propios -->
    <script src="../Js Propios/js-fechayhora.js"></script>
  </body>
</html>
