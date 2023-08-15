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
                    Modificación de Usuario
                </h4>
                <img style="float: right;" width="30px" height="30px" src="images/favicon.png">
            </div>
            <div class="card-body">
                <form id="formulario-modificacion">
                    <div class="row py-2" id="nombre-usuario-modificacion-fila">
                        <div class="col-4 justify-content-center align-content-center" id="nombre-usuario-titulo-baja">
                            <h6 id="nombre-usuario-label-baja"> 
                                Nombre De Usuario:
                            </h6>
                        </div>
                        <div class="col-8 container-fluid justify-content-center align-content-center">
                            <select class="form-select" onchange="fnHabilitarPerfilUsuario('M',value);" id="seleccion-usuario-modificacion">
                                <option id="seleccion-usuario-baja-seleccione" value="0"> Seleccione </option>
                                <option id="seleccion-usuario-baja-usuario1" aria-required="true" value="1"> ListaUsuarios </option>
                            </select>                          
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
                            <button onclick="modificar()" type="submit" class="btn btn-success col-12">
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
            </div>
        </div>
    </div>
</html>