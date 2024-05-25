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
                  ABM Usuarios &nbsp;
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
                    <div class="row py-2" id="nombre-usuario-alta-fila">
                        <div class="col-4 justify-content-center align-content-center" id="nombre-usuario-alta-titulo">
                            <h6 id="nombre-usuario-label"> 
                                Nombre De Usuario:
                            </h6>
                        </div>
                        <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30" onchange="fnHabilitarPerfilUsuario('A',1)" id="nombre-usuario-alta-input" placeholder="Ingrese Nombre de Usuario" ></input>                            
                        </div>
                    </div>
                    <div class="row py-2" id="nombrepila-usuario-alta-fila">
                        <div class="col-4 justify-content-center align-content-center" id="nombrepila-usuario-alta-titulo">
                            <h6 id="nombrepila-usuario-label"> 
                                Nombre/s:
                            </h6>
                        </div>
                        <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30" onchange="fnHabilitarPerfilUsuario('A',1)" id="nombrepila-usuario-alta-input" placeholder="Ingrese Nombre/s" ></input>                            
                        </div>
                    </div>
                    <div class="row py-2" id="apellido-usuario-alta-fila">
                        <div class="col-4 justify-content-center align-content-center" id="apellido-usuario-alta-titulo">
                            <h6 id="apellido-usuario-label"> 
                                Apellido/s:
                            </h6>
                        </div>
                        <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30" onchange="fnHabilitarPerfilUsuario('A',1)" id="apellido-usuario-alta-input" placeholder="Ingrese Apellido/s" ></input>                            
                        </div>
                    </div>
                    <div class="row py-2" id="direccion-usuario-alta-fila">
                        <div class="col-4 justify-content-center align-content-center" id="direccion-usuario-alta-titulo">
                            <h6 id="direccion-usuario-label"> 
                                Dirección:
                            </h6>
                        </div>
                        <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30" onchange="fnHabilitarPerfilUsuario('A',1)" id="direccion-usuario-alta-input" placeholder="Ingrese Dirección" ></input>                            
                        </div>
                    </div>
                    <div class="row py-2" id="email-usuario-alta-fila">
                        <div class="col-4 justify-content-center align-content-center" id="email-usuario-alta-titulo">
                            <h6 id="email-usuario-label"> 
                                Correo electrónico:
                            </h6>
                        </div>
                        <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30" onchange="fnHabilitarPerfilUsuario('A',1)" id="email-usuario-alta-input" placeholder="Ingrese Correo" ></input>                            
                        </div>
                    </div>
                    <div class="row py-2" id="perfil-acceso-alta-usuario">
                      <div class="col-4 justify-content-center align-content-center" id="acceso-ventas-alta-titulo">
                          <h6> 
                              Perfil de Usuario:
                          </h6>
                      </div>
                      <div class="col-8 container-fluid justify-content-center align-content-center">
                          <select onchange="fnPerfilesDeUsuario('A',value)" class="form-select" id="perfil-acceso-alta-usuario-opciones">
                            <option id="acceso-ventas-opcion-seleccione" value="0"> Seleccione </option>
                            <option id="perfil-usuario-alta-vendedor" aria-required="true" value="1"> Usuario Vendedor </option>
                            <option id="perfil-usuario-alta-contador" aria-required="true" value="2"> Usuario Contador </option>
                            <option id="perfil-usuario-alta-duenio" aria-required="true" value="3"> Usuario Dueño </option>
                            <option id="perfil-usuario-alta-admin" aria-required="true" value="4"> Usuario Administrador </option>
                            <option id="perfil-usuario-alta-personalizado" aria-required="true" value="5"> Usuario Personalizado </option>
                          </select>                            
                      </div>
                  </div>
                    <div class="row py-2" id="acceso-ventas-alta-fila">
                        <div class="col-4 justify-content-center align-content-center" id="acceso-ventas-alta-titulo">
                            <h6> 
                                Acceso a Módulo Ventas:
                            </h6>
                        </div>
                        <div class="col-8 container-fluid justify-content-center align-content-center">
                            <select class="form-select" id="acceso-ventas-alta-opciones">
                              <option id="acceso-ventas-opcion-seleccione" value="0"> Seleccione </option>
                              <option id="acceso-ventas-opcion-si" aria-required="true" value="1"> Si </option>
                              <option id="acceso-ventas-opcion-no" aria-required="true" value="2"> No </option>
                            </select>                            
                        </div>
                    </div>
                    <div class="row py-2" id="acceso-compras-alta-fila">
                        <div class="col-4 justify-content-center align-content-center" id="acceso-compras-alta-titulo">
                            <h6> 
                                Acceso a Módulo Compras:
                            </h6>
                        </div>
                        <div class="col-8 container-fluid justify-content-center align-content-center">
                            <select class="form-select" id="acceso-compras-alta-opciones">
                              <option id="acceso-compras-opcion-seleccione" value="0"> Seleccione </option>
                              <option id="acceso-compraS-opcion-si" aria-required="true" value="1"> Si </option>
                              <option id="acceso-Compras-opcion-no" aria-required="true" value="2"> No </option>
                            </select>                            
                        </div>
                    </div>
                    <div class="row py-2" id="acceso-informes-alta-fila">
                      <div class="col-4 justify-content-center align-content-center" id="acceso-informes-alta-titulo">
                          <h6> 
                              Acceso a Módulo Informes:
                          </h6>
                      </div>
                      <div class="col-8 container-fluid justify-content-center align-content-center">
                          <select class="form-select" id="acceso-informes-alta-opciones">
                            <option id="acceso-informes-opcion-seleccione" value="0"> Seleccione </option>
                            <option id="acceso-informes-opcion-si" aria-required="true" value="1"> Si </option>
                            <option id="acceso-informes-opcion-no" aria-required="true" value="2"> No </option>
                          </select>                            
                      </div>
                    </div>
                    <div class="row py-2" id="acceso-consultas-alta-fila">
                      <div class="col-4 justify-content-center align-content-center" id="acceso-consultas-alta-titulo">
                          <h6> 
                              Acceso a Módulo Consultas:
                          </h6>
                      </div>
                      <div class="col-8 container-fluid justify-content-center align-content-center">
                          <select class="form-select" id="acceso-consultas-alta-opciones">
                            <option id="acceso-consultas-opcion-seleccione" value="0"> Seleccione </option>
                            <option id="acceso-consultas-opcion-si" aria-required="true" value="1"> Si </option>
                            <option id="acceso-consultas-opcion-no" aria-required="true" value="2"> No </option>
                          </select>                            
                      </div>
                    </div>
                    <div class="row py-2" id="acceso-usuarios-alta-fila">
                      <div class="col-4 justify-content-center align-content-center" id="acceso-usuarios-alta-titulo">
                          <h6> 
                              Acceso a Módulo Usuarios:
                          </h6>
                      </div>
                      <div class="col-8 container-fluid justify-content-center align-content-center">
                          <select class="form-select" id="acceso-usuarios-alta-opciones">
                            <option id="acceso-usuarios-opcion-seleccione" value="0"> Seleccione </option>
                            <option id="acceso-usuarios-opcion-si" aria-required="true" value="1"> Si </option>
                            <option id="acceso-usuarios-opcion-no" aria-required="true" value="2"> No </option>
                          </select>                            
                      </div>
                    </div>
                    <div class="row py-2" id="botones-alta-fila">
                      <div class="col-4 justify-content-end align-content-end" id="botones-alta-volver">
                        <button onclick="fnSinCambios('A','V')"  type="button" class="btn btn-primary col-12">
                          Volver
                        </button>
                      </div>
                      <div class="col-4 justify-content-end align-content-end" id="botones-alta-crear">
                        <button onclick="fnCrearUsuario()" type="button" class="btn btn-success col-12">
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
                  <div class="row py-2" id="nombre-usuario-baja-fila">
                    <div class="col-4 justify-content-center align-content-center" id="nombre-usuario-titulo-baja">
                        <h6 id="nombre-usuario-label-baja"> 
                            Nombre De Usuario:
                        </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30" onchange="fnHabilitarPerfilUsuario('B',1)" id="nombre-usuario-baja-input" placeholder="Ingrese Nombre" ></input>                            
                        </div>
                  </div>
                  <div class="row py-2" id="botones-baja-fila">
                      <div class="col-4 justify-content-end align-content-end" id="botones-baja-volver">
                        <button onclick="fnSinCambios('B','V')"  type="button" class="btn btn-primary col-12">
                          Volver
                        </button>
                      </div>
                      <div class="col-4 justify-content-end align-content-end" id="botones-baja-dardebaja">
                        <button onclick="fnBajaUsuario()" type="button" class="btn btn-success col-12">
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
                  <div class="row py-2" id="nombre-usuario-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="nombre-usuario-titulo-baja">
                        <h6 id="nombre-usuario-label-baja"> 
                            Nombre De Usuario:
                        </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30" onchange="fnHabilitarPerfilUsuario('M',1)" id="nombre-usuario-modificacion-input" placeholder="Ingrese Nombre de Usuario" ></input>                            
                        </div>
                  </div>
                  <div class="row py-2" id="nombrepila-usuario-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="nombrepila-usuario-titulo-baja">
                      <h6 id="nombrepila-usuario-label-baja"> 
                        Nombre/s:
                      </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                      <input class="col-12 form-control" minlength="8" maxlength="30" onchange="fnHabilitarPerfilUsuario('M',1)" id="nombrepila-usuario-modificacion-input" placeholder="Ingrese Nombre/s" ></input>                            
                    </div>
                  </div>
                  <div class="row py-2" id="apellido-usuario-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="apellido-usuario-titulo-baja">
                      <h6 id="apellido-usuario-label-baja"> 
                        Apellido/s:
                      </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                      <input class="col-12 form-control" minlength="8" maxlength="30" onchange="fnHabilitarPerfilUsuario('M',1)" id="apellido-usuario-modificacion-input" placeholder="Ingrese Apellido/s" ></input>                            
                    </div>
                  </div>
                  <div class="row py-2" id="direccion-usuario-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="direccion-usuario-titulo-baja">
                      <h6 id="direccion-usuario-label-baja"> 
                        Dirección:
                      </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                      <input class="col-12 form-control" minlength="8" maxlength="30" onchange="fnHabilitarPerfilUsuario('M',1)" id="direccion-usuario-modificacion-input" placeholder="Ingrese Dirección" ></input>                            
                    </div>
                  </div>
                  <div class="row py-2" id="email-usuario-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="email-usuario-titulo-baja">
                      <h6 id="email-usuario-label-baja"> 
                        Correo electrónico:
                      </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                      <input class="col-12 form-control" minlength="8" maxlength="30" onchange="fnHabilitarPerfilUsuario('M',1)" id="email-usuario-modificacion-input" placeholder="Ingrese Correo" ></input>                            
                    </div>
                  </div>
                  <div class="row py-2" id="perfil-acceso-modificacion-usuario">
                    <div class="col-4 justify-content-center align-content-center" id="acceso-ventas-alta-titulo">
                        <h6> 
                            Perfil de Usuario:
                        </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                        <select onchange="fnPerfilesDeUsuario('M',value)" class="form-select" id="perfil-acceso-modificacion-usuario-opciones">
                          <option id="acceso-ventas-opcion-seleccione" value="0"> Seleccione </option>
                          <option id="perfil-usuario-modificacion-vendedor" aria-required="true" value="1"> Usuario Vendedor </option>
                          <option id="perfil-usuario-modificacion-contador" aria-required="true" value="2"> Usuario Contador </option>
                          <option id="perfil-usuario-modificacion-duenio" aria-required="true" value="3"> Usuario Dueño </option>
                          <option id="perfil-usuario-modificacion-admin" aria-required="true" value="4"> Usuario Administrador </option>
                          <option id="perfil-usuario-modificacion-personalizado" aria-required="true" value="5"> Usuario Personalizado </option>
                        </select>                            
                    </div>
                  </div>
                  <div class="row py-2" id="acceso-ventas-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="acceso-ventas-titulo">
                        <h6> 
                            Acceso a Módulo Ventas:
                        </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                        <select class="form-select" id="acceso-ventas-modificacion-opciones">
                          <option id="acceso-ventas-opcion-seleccione" value="0"> Seleccione </option>
                          <option id="acceso-ventas-opcion-si" aria-required="true" value="1"> Si </option>
                          <option id="acceso-ventas-opcion-no" aria-required="true" value="2"> No </option>
                        </select>                            
                    </div>
                  </div>
                  <div class="row py-2" id="acceso-compras-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="acceso-compras-modificacion-titulo">
                        <h6> 
                            Acceso a Módulo Compras:
                        </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                        <select class="form-select" id="acceso-compras-modificacion-opciones">
                          <option id="acceso-compras-opcion-seleccione" value="0"> Seleccione </option>
                          <option id="acceso-compraS-opcion-si" aria-required="true" value="1"> Si </option>
                          <option id="acceso-Compras-opcion-no" aria-required="true" value="2"> No </option>
                        </select>                            
                    </div>
                  </div>
                  <div class="row py-2" id="acceso-informes-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="acceso-informes-modificacion-titulo">
                        <h6> 
                            Acceso a Módulo Informes:
                        </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                        <select class="form-select" id="acceso-informes-modificacion-opciones">
                          <option id="acceso-informes-opcion-seleccione" value="0"> Seleccione </option>
                          <option id="acceso-informes-opcion-si" aria-required="true" value="1"> Si </option>
                          <option id="acceso-informes-opcion-no" aria-required="true" value="2"> No </option>
                        </select>                            
                    </div>
                  </div>
                  <div class="row py-2" id="acceso-consultas-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="acceso-consultas-modificacion-titulo">
                        <h6> 
                            Acceso a Módulo Consultas:
                        </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                        <select class="form-select" id="acceso-consultas-modificacion-opciones">
                          <option id="acceso-consultas-opcion-seleccione" value="0"> Seleccione </option>
                          <option id="acceso-consultas-opcion-si" aria-required="true" value="1"> Si </option>
                          <option id="acceso-consultas-opcion-no" aria-required="true" value="2"> No </option>
                        </select>                            
                    </div>
                  </div>
                  <div class="row py-2" id="acceso-usuarios-modificacion-fila">
                    <div class="col-4 justify-content-center align-content-center" id="acceso-usuarios-modificacion-titulo">
                        <h6> 
                            Acceso a Módulo Usuarios:
                        </h6>
                    </div>
                    <div class="col-8 container-fluid justify-content-center align-content-center">
                        <select class="form-select" id="acceso-usuarios-modificacion-opciones">
                          <option id="acceso-usuarios-opcion-seleccione" value="0"> Seleccione </option>
                          <option id="acceso-usuarios-opcion-si" aria-required="true" value="1"> Si </option>
                          <option id="acceso-usuarios-opcion-no" aria-required="true" value="2"> No </option>
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
                      <button onclick="fnModificarUsuario()" type="button" class="btn btn-success col-12">
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
    <script type="text/javascript" src="../js/abmusuarios/fnHabilitarOpciones.js"></script>
    <script type="text/javascript" src="../js/abmusuarios/fnAltaHabilitarPerfilUsuario.js"></script>
    <script type="text/javascript" src="../js/abmusuarios/fnModificacionHabilitarPerfilUsuario.js"></script>
    <script type="text/javascript" src="../js/abmusuarios/fnAltaPerfilesDeUsuario.js"></script>
    <script type="text/javascript" src="../js/abmusuarios/fnModificacionPerfilesDeUsuario.js"></script>
    <script type="text/javascript" src="../js/abmusuarios/fnSinCambios.js"></script>
    <script type="text/javascript" src="../js/abmusuarios/fnHabilitarPerfilUsuario.js"></script>
    <script type="text/javascript" src="../js/abmusuarios/fnPerfilesDeUsuario.js"></script>
    <script type="text/javascript" src="../js/abmusuarios/fnCrearUsuario.js"></script>
    <script type="text/javascript" src="../js/abmusuarios/fnBajaUsuario.js"></script>
    <script type="text/javascript" src="../js/abmusuarios/fnModificarUsuario.js"></script>
    <!-- JS Propios -->
    <script src="../../Js Propios/js-fechayhora.js"></script>
  </body>
</html>
