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
        #tabla-body-cabecera-categorias {
            display: block;
            overflow-x: auto;
        }

        #tabla-body-cabecera-categorias tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        #tabla-body-categorias {
            display: block;
            max-height: 175px; /* Ajusta la altura según el tamaño de las filas */
            overflow-y: auto;
            scrollbar-width: none;
        }   

        #tabla-body-categorias tr {
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
                            <h4 style="float: left;">Consulta de Categorias &nbsp;</h4>
                            <h4 style="float: right;">
                                <label id="texto-fecha-hora"></label>
                                <a href="../../logout/logout.php" class="btn btn-warning"> LOGOUT </a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form id="formulario-consulta">
                                <div class="row md-12">
                                    <div class="col-md-6">
                                        <div class="form-group row col-sm-12">
                                            <div class="col-sm-2">
                                                <label for="nombre" class="col-sm-12 col-form-label">Categoria:</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control col-sm-12" id="nombre" minlength="1" maxlength="30" placeholder="Ingrese nombre de Categoría">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row col-sm-12">
                                            <div class="col-sm-2">
                                                <label for="descripcion" class="col-sm-12 col-form-label">Descripción:</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control col-sm-12" id="descripcion" placeholder="Ingrese Descripción">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row md-12">
                                    <div class="col-md-8">
                                        <div class="form-group row col-sm-12">
                                            <div class="col-sm-2">
                                                <label for="descripcion" class="col-sm-12 col-form-label">Depende del Tipo:</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control col-12" id="depende-tipo" placeholder="Ingrese Tipo Asociado">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row col-sm-12">
                                            <button onclick="fnConsultarCategorias()" class="btn btn-primary col-12"> Consultar </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr style="border: 2px solid gray;">
                            <table style="overflow-x: auto; overflow-y: auto;" class="table table-striped" id="tabla-body-cabecera-categorias">
                                <thead class="col md-12">
                                    <tr class="col md-12">
                                        <th>Nombre de la Categoría </th>
                                        <th>Descripción</th>
                                        <th>Tipo Asociado</th>
                                        <th>Activa</th>
                                    </tr>
                                </thead>
                                <tbody id="tabla-body-categorias">
                                    <!-- Las filas agregadas de la consulta van aca! -->
                                </tbody>
                            </table>
                            <hr style="border: 2px solid gray;">
                            <div class="row mt-12">
                                <div class="col-4">
                                    <button onclick="fnVolverCategorias()" class="btn btn-primary col-12"> Volver </button>
                                </div>
                                <div class="col-4">
                                    <button onclick="fnGenerarReporteCategorias()" class="btn btn-success col-12"> Generar Reporte </button>
                                </div>
                                <div class="col-4">
                                    <button onclick="fnLimpiarObjetosCategorias()" class="btn btn-danger col-12"> Limpiar </button>
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
        <script src="../../js/consultas/consulta_categorias/fnConsultarCategorias.js"></script>
        <script src="../../js/consultas/consulta_categorias/fnLimpiarObjetosCategorias.js"> </script>
        <script src="../../js/consultas/consulta_categorias/fnVolverCategorias.js"> </script>
        <script src="../../js/consultas/consulta_categorias/fnGenerarReporteCategorias.js"> </script>
        <script src="../../js/fnFechayHora.js"></script>

    </body>
</html>