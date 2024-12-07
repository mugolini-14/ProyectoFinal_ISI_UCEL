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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="../../images/favicon.png">
        <title>Ferr O' Tec</title>
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    </head>
    <style>
        #tabla-body-cabecera-articulos {
            display: block;
            overflow-x: auto;
        }

        #tabla-body-cabecera-articulos tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        #tabla-body-articulos {
            display: block;
            max-height: 175px; /* Ajusta la altura según el tamaño de las filas */
            overflow-y: auto;
            scrollbar-width: none;
        }   

        #tabla-body-articulos tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }
    </style>
    <body style="background-color: #f2f2f2">
        <div class="container-fluid align-items-center justify-content-center">
            <div class="row justify-content-center">
                <div class="col-md-12 mt-5">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="float: left;">Ferr O'Tec &nbsp;</h4>
                            <img style="float: left; margin-right: 20px;" width="30px" height="30px" src="../../images/favicon.png">
                            <h4 style="float: left;">
                                Consulta de Artículos &nbsp;
                            </h4>
                            <h4 style="float: right;">
                                <label id="texto-fecha-hora"> </label>
                                &nbsp;
                                <a href="../../logout/logout.php" class="btn btn-warning"> LOGOUT </a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form id="formulario-consulta">
                                <div class="row md-12" id="articulo-marca-fila">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="articulo" class="col-sm-2 col-form-label">Articulo:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="articulo" minlength="1" maxlength="30" placeholder="Ingrese  nombre de Artículo">
                                                <ul id="suggestions" class="list-group"></ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="marca" class="col-sm-2 col-form-label">Marca:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="marca" placeholder="Ingrese Marca">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row md-12">
                                    <div class="col md-1">
                                        <label for="descripcion" class="col-form-label col-12">Descripción:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control col-12" id="descripcion" placeholder="Ingrese Descripción">
                                    </div>
                                    <div class="col-md-2">
                                        <button onclick="fnConsultarArticulos()" class="btn btn-primary col-12"> Consultar </button>
                                    </div>
                                </div>
                            </form>
                            <hr style="border: 2px solid gray;">
                                <table style="overflow-x: auto; overflow-y: auto;" class="table table-striped" id="tabla-body-cabecera-articulos">
                                    <thead class="col md-12">
                                        <tr class="col md-12">
                                            <th>Nombre del Artículo</th>
                                            <th>Marca</th>
                                            <th>Descripción</th>
                                            <th>Precio Unitario</th>
                                            <th>Cant. Stock</th>
                                            <th>Activo</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabla-body-articulos">
                                        <!-- Las filas agregadas de la consulta van aca! -->
                                    </tbody>
                                </table>
                            <hr style="border: 2px solid gray;">
                            <div class="row mt-12">
                                <div class="col-4">
                                    <button onclick="fnVolverArticulos()" class="btn btn-primary col-12"> Volver </button>
                                </div>
                                <div class="col-4">
                                    <button onclick="fnGenerarReporteArticulos()" class="btn btn-success col-12"> Generar Reporte </button>
                                </div>
                                <div class="col-4">
                                    <button onclick="fnLimpiarObjetosArticulos()" class="btn btn-danger col-12"> Limpiar </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- JS Propios -->
        <script src="../../js/consultas/consulta_articulos/fnConsultarArticulos.js"></script>
        <script src="../../js/consultas/consulta_articulos/fnLimpiarObjetosArticulos.js"> </script>
        <script src="../../js/consultas/consulta_articulos/fnVolverArticulos.js"> </script>
        <script src="../../js/consultas/consulta_articulos/fnGenerarReporteArticulos.js"> </script>
        <script src="../../js/fnFechayHora.js"></script>
    </body>
</html>