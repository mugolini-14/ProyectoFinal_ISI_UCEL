<?php
session_start();
if(!$_SESSION['logged']){
   header("Location: ../login.html");
   
}
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
		<style type="text/css" id="operaUserStyle"></style>
	</head>
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


    <body style="background-color: #f2f2f2" onload="getTime()">
        <div class="container-fluid justify-content-center">
            <div class="row justify-content-center">
                <div class="col-md-6 mt-5">
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
                                        <div class="accordion" id="accordion-index">
                                            <div class="accordion-item" id="modulo-ventas">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed bg-opacity-50 bg-primary" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-item-ventas" aria-expanded="true" aria-controls="accordion-item-ventas">
                                                        Ventas
                                                    </button>
                                                </h2>
                                                <div id="accordion-item-ventas" class="accordion-collapse collapse">
                                                    <div class="accordion-body bg-opacity-25 bg-primary">
                                                    <a href="../ventas/ventas.php"> Ventas de artículos </a>
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
                                                        Compra de mercaderia
                                                    </div>
                                                    <div class="accordion-body bg-opacity-25 bg-warning">
                                                        <a href="../abmproveedores/abmproveedores.php"> Abm de Proveedores </a>
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
                                                    <div class="accordion-body bg-opacity-25 bg-secondary">
                                                        <a href="../abmarticulos/abmarticulos.php"> Abm de Articulos </a>
                                                    </div>
                                                    <div class="accordion-body bg-opacity-25 bg-secondary">
                                                        <a href="../abmcategorias/abmcategorias.php"> Abm de Categorías de Artículos</a>
                                                    </div>
                                                    <div class="accordion-body bg-opacity-25 bg-secondary">
                                                        <a href="../abmtipos/abmtipos.php"> Abm de Tipos de Artículos </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item" id="modulo-informes">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed bg-opacity-50 bg-success" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-item-informes" aria-expanded="false" aria-controls="accordion-item-informes">
                                                        Informes
                                                    </button>
                                                </h2>
                                                <div id="accordion-item-informes" class="accordion-collapse collapse">
                                                    <div class="accordion-body bg-opacity-25 bg-success">
                                                        (Contenido Módulo Informes)
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
                                                    <div class="accordion-body bg-opacity-25 bg-danger">
                                                        (Contenido Módulo Consultas)
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
                                                        <a href="../abmusuarios/abmusuarios.php"> Abm de Usuarios </a>
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
                                    <div class="col">
                                        <i> Usuario: <label><?php echo $_SESSION['usu_nombre']." ".$_SESSION['usu_apellido']; ?></label></i> 
                                    </div>
                                    <div class="col align-items-center text-center">
                                        <a class="btn btn-primary" href="file:///G:/ProyectoFinal_ISI_UCEL/acercade.html"> Acerca De </a>
                                    </div>
                                    <div class="col align-items-end text-end">
                                        <i> Versión:  0.2-FRONTEND </i>
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
        <script src="../Js Propios/js-fechayhora.js"> </script>
	</body>
</html>