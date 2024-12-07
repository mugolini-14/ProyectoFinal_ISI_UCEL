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
        #tabla-body-cabecera-tipos {
            display: block;
            overflow-x: auto;
        }

        #tabla-body-cabecera-tipos tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        #tabla-body-tipos {
            display: block;
            max-height: 175px; /* Ajusta la altura según el tamaño de las filas */
            overflow-y: auto;
            scrollbar-width: none;
        }   

        #tabla-body-tipos tr {
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
                            <h4 style="float: left;">Consulta de Tipos &nbsp;</h4>
                            <h4 style="float: right;">
                                <label id="texto-fecha-hora"></label>
                                <a href="../../logout/logout.php" class="btn btn-warning"> LOGOUT </a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form id="formulario-consulta">
                                <div class="row md-12" id="tipo-marca-fila">
                                    <div class="col-md-4">
                                        <div class="form-group row col-sm-12">
                                            <div class="col-sm-2">
                                                <label for="nombre" class="col-sm-12 col-form-label">Tipo:</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="nombre" minlength="1" maxlength="30" placeholder="Ingrese nombre de Tipo">
                                                <ul id="suggestions" class="list-group"></ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row col-sm-12">
                                            <div class="col-sm-2">
                                                <label for="descripcion" class="col-sm-12 col-form-label">Descripción:</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="descripcion" placeholder="Ingrese Descripción">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group row col-sm-12">
                                            <button onclick="fnConsultarTipos()" class="btn btn-primary col-12"> Consultar </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr style="border: 2px solid gray;">
                            <table style="overflow-x: auto; overflow-y: auto;" class="table table-striped" id="tabla-body-cabecera-tipos">
                                <thead class="col md-12">
                                    <tr class="col md-12">
                                        <th>Nombre del Tipo</th>
                                        <th>Descripción</th>
                                        <th>Activo</th>
                                    </tr>
                                </thead>
                                <tbody id="tabla-body-tipos">
                                    <!-- Las filas agregadas de la consulta van aca! -->
                                </tbody>
                            </table>
                            <hr style="border: 2px solid gray;">
                            <div class="row mt-12">
                                <div class="col-4">
                                    <button onclick="fnVolverTipos()" class="btn btn-primary col-12"> Volver </button>
                                </div>
                                <div class="col-4">
                                    <button onclick="fnGenerarReporteTipos()" class="btn btn-success col-12"> Generar Reporte </button>
                                </div>
                                <div class="col-4">
                                    <button onclick="fnLimpiarObjetosTipos()" class="btn btn-danger col-12"> Limpiar </button>
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
        <script src="../../js/consultas/consulta_tipos/fnConsultarTipos.js"></script>
        <script src="../../js/consultas/consulta_tipos/fnLimpiarObjetosTipos.js"> </script>
        <script src="../../js/consultas/consulta_tipos/fnVolverTipos.js"> </script>
        <script src="../../js/consultas/consulta_tipos/fnGenerarReporteTipos.js"> </script>
        <script src="../../js/fnFechayHora.js"></script>
    </body>
</html>