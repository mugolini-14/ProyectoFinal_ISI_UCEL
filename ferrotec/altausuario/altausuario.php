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
                    Alta de Usuario
                </h4>
                <img style="float: right;" width="30px" height="30px" src="images/favicon.png">
            </div>
            <div class="card-body">
                <form id="formulario-alta" method="post" action="./php/prueba.php">
                    <div class="row py-2" id="nombre-usuario-alta-fila">
                        <div class="col-4 justify-content-center align-content-center" id="nombre-usuario-alta-titulo">
                            <h6 id="nombre-usuario-label"> 
                                Nombre De Usuario:
                            </h6>
                        </div>
                        <div class="col-8 container-fluid justify-content-center align-content-center">
                            <input class="col-12 form-control" minlength="8" maxlength="30" onchange="fnHabilitarPerfilUsuario('A',1)" id="nombre-usuario-alta-input" name="nombre_usuario" placeholder="Ingrese Nombre" ></input>                            
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
                        <button onclick="fnCrearUsuario()" type="submit" class="btn btn-success col-12">
                          Crear
                        </button>
                      </div>
                      <div class="col-4 justify-content-end align-content-end" id="botones-alta-cancelar">
                        <button onclick="fnSinCambios('A','C')" type="button" class="btn btn-danger col-12">
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
</html>