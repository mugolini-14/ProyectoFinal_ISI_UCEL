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
        #tabla-body-cabecera-historial-categorias {
            display: block;
            overflow-x: auto;
        }

        #tabla-body-cabecera-historial-categorias tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        #tabla-body-historial-categorias {
            display: block;
            max-height: 100px; /* Ajusta la altura según el tamaño de las filas */
            overflow-y: auto;
            scrollbar-width: none;
        }   

        #tabla-body-historial-categorias tr {
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
                            <h4 style="float: left;">Historial de Categorias &nbsp;</h4>
                            <h4 style="float: right;">
                                <label id="texto-fecha-hora"></label>
                                <a href="../../logout/logout.php" class="btn btn-warning"> LOGOUT </a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form id="formulario-consulta">
                                <div class="row md-12">
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label for="fecha-desde" class="col-form-label"> Fecha de Inicio: </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="datetime-local" class="form-control" id="fecha-desde"> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label for="fecha-hasta" class="col-form-label"> Fecha de Fin: </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="datetime-local" class="form-control" id="fecha-hasta"> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                <label for="categoria" class="col-form-label"> Categoria: </label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="categoria" placeholder="Ingrese Categoría"> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row md-12">
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                        <div class="col-sm-4">
                                                <label for="tipo-accion" class="col-form-label"> Acción: </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <select class="form-select" id="cat-accion">
                                                    <option id="cat-accion" value=""> Todas </option>
                                                    <option id="cat-accion" value="alta_cat"> Altas </option>
                                                    <option id="cat-accion" value="baja_cat"> Bajas </option>
                                                    <option id="cat-accion" value="modif_cat"> Modificaciones </option>
                                                </select>    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                        <div class="col-sm-3">
                                                <label for="descripcion" class="col-form-label"> Descripción: </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="descripcion" placeholder="Ingrese Descripción"> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                <label for="modificado-por" class="col-form-label"> Usuario: </label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="modificado-por" placeholder="Ingrese Usuario"> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row md-12">
                                    <div class="col-sm-4">      
                                        <div class="form-group row">
                                            
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label for="tipo" class="col-form-label"> Tipo: </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="tipo" placeholder="Ingrese Tipo"> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label for="cant-registros" class="col-form-label col-12"> Cant. Registros: </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <select class="form-select col-12" id="cant-registros">
                                                    <option id="cant-registros" value=""> Todos </option>
                                                    <option id="cant-registros" value=10> 10 </option>
                                                    <option id="cant-registros" value=50> 50 </option>
                                                    <option id="cant-registros" value=100> 100 </option>
                                                    <option id="cant-registros" value=500> 500 </option>
                                                </select>    
                                            </div>
                                            <div class="col-sm-4">
                                                <button onclick="fnConsultarHistorialCategorias()" class="btn btn-primary col-12"> Consultar </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row md-12">
                                    <div class="col-sm-4">
                                        <div class="form-group row">
                                            
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group row">
                                            
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr style="border: 2px solid gray;">
                            <div class="row md-12">
                                <table style="overflow-x: auto; overflow-y: auto;" class="table table-striped" id="tabla-body-cabecera-historial-categorias">
                                    <thead class="col md-12">
                                        <tr class="col md-12">
                                            <th>Fecha Registro</th>
                                            <th>Tipo de Acción</th>
                                            <th>Modificado Por</th>
                                            <th>Categoría</th>
                                            <th>Tipo Asociado</th>
                                            <th>Descripcion</th>
                                            <th>Activa</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table table-striped" id="tabla-body-historial-categorias" class="col md-12">
                                        <!-- Las filas del historial de artículos que se agregarán  -->

                                    </tbody>
                                </table>
                            </div>
                            <hr style="border: 2px solid gray;">
                            <div class="row mt-12">
                                <div class="col-4">
                                    <button onclick="fnVolverHistorialCategorias()" class="btn btn-primary col-12"> Volver </button>
                                </div>
                                <div class="col-4">
                                    <button onclick="fnGenerarReporteHistorialCategorias()" class="btn btn-success col-12"> Generar Reporte </button>
                                </div>
                                <div class="col-4">
                                    <button onclick="fnLimpiarObjetosHistorialCategorias()" class="btn btn-danger col-12"> Limpiar </button>
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
        <script src="../../js/historiales/historial_categorias/fnConsultarHistorialCategorias.js"></script>
        <script src="../../js/historiales/historial_categorias/fnLimpiarObjetosHistorialCategorias.js"> </script>
        <script src="../../js/historiales/historial_categorias/fnVolverHistorialCategorias.js"> </script>
        <script src="../../js/historiales/historial_categorias/fnGenerarReporteHistorialCategorias.js"> </script>
        <script src="../../js/fnFechayHora.js"></script>

    </body>
</html>