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
        Ferr O Tec 
    </title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <style type="text/css" id="operaUserStyle"></style></head>


    <body style="background-color: #f2f2f2" onload="fnFechayHora(); fnMostrarMenusSegunPermisos(idPermisos);">
        <div class="container-fluid justify-content-center">
            <div class="row justify-content-center">
                <div class="col-md-8 mt-5"> 
                    <div class="card">
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
                            <form class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="col-md-12 align-items-center" id="div-sin-permisos" style="display: none;">
                                            <h4 style="display: flex; align-items: center; justify-content: left; height: 275px; margin: 0;">
                                                Usted no tiene Permisos para acceder a las funciones del Sistema. 
                                                <br> 
                                                Por favor, contacte con el Administrador. 
                                            </H4>
                                        </div>
                                        <div class="col-md-12 align-items-center" id="div-permisos-desconocidos" style="display: none;">
                                            <h4 style="display: flex; align-items: center; justify-content: left; height: 275px; margin: 0;">
                                                Hay un Error con sus Permisos. 
                                                <br> 
                                                Por favor, contacte con el Administrador. 
                                            </H4>
                                        </div>
                                        <div class="accordion" id="accordion-index">    
                                            <div class="accordion-item" id="modulo-ventas">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed bg-opacity-50 bg-info" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-item-ventas" aria-expanded="true" aria-controls="accordion-item-ventas">
                                                        Ventas
                                                    </button>
                                                </h2>
                                                <div id="accordion-item-ventas" class="accordion-collapse collapse">
                                                    <div class="accordion-body bg-opacity-25 bg-info">
                                                        <a class="text-decoration-none link-dark btn btn-link" href="../ventas/ventas.php"> Ventas de Artículos </a>
                                                    </div>
                                                    <div id="accordion-item-deshacer-ventas" class="accordion-body bg-opacity-25 bg-info">
                                                        <a class="text-decoration-none link-dark btn btn-link" href="../deshacerventas/deshacerventas.php"> Deshacer Ventas de Artículos </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item" id="modulo-compras">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed bg-opacity-50 bg-warning" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-item-compras" aria-expanded="false" aria-controls="accordion-item-compras">
                                                    Compras
                                                    </button>
                                                </h2>
                                                <div id="accordion-item-compras" class="accordion-collapse collapse">
                                                    <div class="accordion-body bg-opacity-25 bg-warning">
                                                        <a class="text-decoration-none link-dark btn btn-link" href="../compras/compras.php"> Compras de Artículos </a>
                                                    </div>
                                                    <div class="accordion-body bg-opacity-25 bg-warning">
                                                        <a class="text-decoration-none link-dark btn btn-link" href="../deshacercompras/deshacercompras.php"> Deshacer Compras de Artículos </a>
                                                    </div>
                                                    <div class="accordion-body bg-opacity-25 bg-warning">
                                                        <a class="text-decoration-none link-dark btn btn-link" href="../abmproveedores/abmproveedores.php"> Abm de Proveedores </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item" id="modulo-articulos">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed bg-opacity-50 bg-primary" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-item-articulos" aria-expanded="true" aria-controls="accordion-item-articulos">
                                                        Artículos
                                                    </button>
                                                </h2>
                                                <div id="accordion-item-articulos" class="accordion-collapse collapse">
                                                    <div class="accordion-body bg-opacity-25 bg-primary">
                                                        <a class="text-decoration-none link-dark btn btn-link" href="../abmarticulos/abmarticulos.php"> Abm de Articulos </a>
                                                    </div>
                                                    <div class="accordion-body bg-opacity-25 bg-primary">
                                                        <a class="text-decoration-none link-dark btn btn-link" href="../abmcategorias/abmcategorias.php"> Abm de Categorías de Artículos</a>
                                                    </div>
                                                    <div class="accordion-body bg-opacity-25 bg-primary">
                                                        <a class="text-decoration-none link-dark btn btn-link" href="../abmtipos/abmtipos.php"> Abm de Tipos de Artículos </a>
                                                    </div>
                                                    <div class="accordion-body bg-opacity-25 bg-primary">
                                                        <a class="text-decoration-none link-dark btn btn-link" href="../modificacionprecios/modificacionprecios.php"> Modificacion de Precios de Articulos, por Categoría y Tipo </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item" id="modulo-reportes">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed bg-opacity-50 bg-success" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-item-reportes" aria-expanded="false" aria-controls="accordion-item-reportes">
                                                        Reportes
                                                    </button>
                                                </h2>
                                                <div id="accordion-item-reportes" class="accordion-collapse collapse">
                                                    <div class="accordion-body bg-opacity-25 bg-success">
                                                        <a class="text-decoration-none link-dark btn btn-link" href="../reporteventas/reporteventas.php"> Reporte de Ventas </a>
                                                    </div>
                                                    <div class="accordion-body bg-opacity-25 bg-success">
                                                        <a class="text-decoration-none link-dark btn btn-link" href="../reportecompras/reportecompras.php"> Reporte de Compras </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item" id="modulo-consultas">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed bg-opacity-50 bg-danger" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-item-consultas" aria-expanded="false" aria-controls="accordion-item-consultas">
                                                        Consultas
                                                    </button>
                                                </h2>
                                                <div id="accordion-item-consultas" class="accordion-collapse collapse">
                                                    <div id="accordion-item-consulta-articulos" class="accordion-body bg-opacity-25 bg-danger">
                                                        <a class="text-decoration-none link-dark btn btn-link" href="../consultas/consulta_articulos/consulta_articulos.php"> Consulta de Artículos </a>
                                                    </div>
                                                    <div id="accordion-item-consulta-proveedores" class="accordion-body bg-opacity-25 bg-danger">
                                                        <a class="text-decoration-none link-dark btn btn-link" href="../consultas/consulta_proveedores/consulta_proveedores.php"> Consulta de Proveedores </a>
                                                    </div>
                                                    <div id="accordion-item-consulta-tipos" class="accordion-body bg-opacity-25 bg-danger">
                                                        <a class="text-decoration-none link-dark btn btn-link" href="../consultas/consulta_tipos/consulta_tipos.php"> Consulta de Tipos </a>
                                                    </div>
                                                    <div id="accordion-item-consulta-categorias" class="accordion-body bg-opacity-25 bg-danger">
                                                        <a class="text-decoration-none link-dark btn btn-link" href="../consultas/consulta_categorias/consulta_categorias.php"> Consulta de Categorías </a>
                                                    </div>
                                                    <div id="accordion-item-consulta-usuarios" class="accordion-body bg-opacity-25 bg-danger">
                                                        <a class="text-decoration-none link-dark btn btn-link" href="../consultas/consulta_usuarios/consulta_usuarios.php"> Consulta de Usuarios </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item" id="modulo-historiales">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed bg-opacity-50 bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-item-historiales" aria-expanded="false" aria-controls="accordion-item-historiales">
                                                        Historiales
                                                    </button>
                                                </h2>
                                                <div id="accordion-item-historiales" class="accordion-collapse collapse">
                                                    <div id="accordion-item-historial-login" class="accordion-body bg-opacity-25 bg-light">
                                                        <a class="text-decoration-none link-dark btn btn-link" href="../historiales/historial_login/historial_login.php"> Historial de Actividad de Usuarios </a>
                                                    </div>
                                                    <div id="accordion-item-historial-usuarios" class="accordion-body bg-opacity-25 bg-light">
                                                        <a class="text-decoration-none link-dark btn btn-link" href="../historiales/historial_usuarios/historial_usuarios.php"> Historial de Modificaciones de Usuarios </a>
                                                    </div>
                                                    <div id="accordion-item-historial-articulos" class="accordion-body bg-opacity-25 bg-light">
                                                        <a class="text-decoration-none link-dark btn btn-link" href="../historiales/historial_articulos/historial_articulos.php"> Historial de Artículos </a>
                                                    </div>
                                                    <div id="accordion-item-historial-tipos" class="accordion-body bg-opacity-25 bg-light">
                                                        <a class="text-decoration-none link-dark btn btn-link" href="../historiales/historial_tipos/historial_tipos.php"> Historial de Tipos </a>
                                                    </div>
                                                    <div id="accordion-item-historial-categorias" class="accordion-body bg-opacity-25 bg-light">
                                                        <a class="text-decoration-none link-dark btn btn-link" href="../historiales/historial_categorias/historial_categorias.php"> Historial de Categorías </a>
                                                    </div>
                                                    <div id="accordion-item-historial-categorias" class="accordion-body bg-opacity-25 bg-light">
                                                        <a class="text-decoration-none link-dark btn btn-link" href="../historiales/historial_proveedores/historial_proveedores.php"> Historial de Proveedores </a>
                                                    </div>
                                                    <div id="accordion-item-historial-ventas" class="accordion-body bg-opacity-25 bg-light">
                                                        <a class="text-decoration-none link-dark btn btn-link" href="../historiales/historial_ventas/historial_ventas.php"> Historial de Ventas </a>
                                                    </div>
                                                    <div id="accordion-item-historial-compras" class="accordion-body bg-opacity-25 bg-light">
                                                        <a class="text-decoration-none link-dark btn btn-link" href="../historiales/historial_compras/historial_compras.php"> Historial de Compras </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item" id="modulo-usuarios">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed bg-opacity-50 bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-item-usuarios" aria-expanded="false" aria-controls="accordion-item-usuarios">
                                                        Usuarios
                                                    </button>
                                                </h2>
                                                <div id="accordion-item-usuarios" class="accordion-collapse collapse">
                                                    <div class="accordion-body bg-opacity-25 bg-secondary">
                                                        <a class="text-decoration-none link-dark btn btn-link" href="../abmusuarios/abmusuarios.php"> Abm de Usuarios </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 float-end">
                                        <img class="img-fluid" src="../images/img-logo.jpg">
                                    </div>
                                </div>
                                <br>
                                <div class="row justify-content-center">
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-6"> 
                                                <label class="col-form-label"><i>Usuario: </i><i><?php echo $_SESSION['usu_nombre']." ".$_SESSION['usu_apellido']; ?></i></label>
                                            </div>
                                            <div class="col-6 text-end">
                                                <label class="col-form-label" ><i>Tipo de Permiso: </i>
                                                    <i id="label-nombre-permisos" onload="fnMostrarNombreDePermisos(idPermisos);"> </i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label class="col-form-label"><i> Versión:  1.0.0-FINAL </i> </label>
                                            </div>
                                            <div class="col-6 text-end">
                                                <a class="btn btn-primary col-8" href="../acercade/acercade.php"> Acerca De </a>
                                            </div>
                                        </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="../bootstrap/js/bootstrap.min.js"> </script>

        <!-- JS Propios -->
        <script>
            var idPermisos = "<?php echo $id_permiso; ?>";
            document.addEventListener('DOMContentLoaded', function() {
                fnMostrarMenusSegunPermisos(idPermisos);
            });
        </script>
        <script>
            var idPermisos = "<?php echo $id_permiso; ?>";
            document.addEventListener('DOMContentLoaded', function() {
                fnMostrarNombreDePermisos(idPermisos);
            });
        </script>
        <script src="../js/index/fnMostrarMenusSegunPermisos.js"> </script>
        <script src="../js/index/fnMostrarNombreDePermisos.js"> </script>
        <script src="../js/fnFechayHora.js"> </script>

	</body>
</html>