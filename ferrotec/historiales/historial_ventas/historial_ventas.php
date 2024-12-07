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
        #tabla-body-cabecera-historial-ventas {
            display: block;
            overflow-x: auto;
        }

        #tabla-body-cabecera-historial-ventas tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        #tabla-body-historial-ventas {
            display: block;
            max-height: 100px; /* Ajusta la altura según el tamaño de las filas */
            overflow-y: auto;
            scrollbar-width: none;
        }   

        #tabla-body-historial-ventas tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        #tabla-body-cabecera-historial-ventas-detalle {
            display: block;
            overflow-x: auto;
        }

        #tabla-body-cabecera-historial-ventas-detalle tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        #tabla-body-historial-ventas-detalle {
            display: block;
            max-height: 100px; /* Ajusta la altura según el tamaño de las filas */
            overflow-y: auto;
            scrollbar-width: none;
        }   

        #tabla-body-historial-ventas-detalle tr {
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
                            <h4 style="float: left;">Historial de Ventas &nbsp;</h4>
                            <h4 style="float: right;">
                                <label id="texto-fecha-hora"></label>
                                    &nbsp;
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
                                                <label for="tipo-venta" class="col-form-label"> Ventas: </label>
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="col-sm-12">
                                                    <select class="form-select" id="tipo-venta">
                                                        <option id="tipo-venta" value="S"> Seleccione... </option>
                                                        <option id="tipo-venta" value="VR"> Realizadas </option>
                                                        <option id="tipo-venta" value="VC"> Canceladas </option>
                                                    </select>    
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row md-12">
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label for="modo-pago" class="col-form-label"> Modo de Pago: </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="col-sm-12">
                                                    <select class="form-select" id="modo-pago">
                                                        <option id="modo-pago" value=""> Todos </option>
                                                        <option id="modo-pago" value="2"> Efectivo </option>
                                                        <option id="modo-pago" value="3"> Débito </option>
                                                        <option id="modo-pago" value="4"> Crédito </option>
                                                        <option id="modo-pago" value="1"> No Especificado </option>
                                                    </select>    
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label for="monto" class="col-form-label"> Monto: </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="col-sm-12">
                                                    <select class="form-select" onchange="fnHabilitarMontoVentas()" id="monto">
                                                        <option id="monto" value=""> Todos </option>
                                                        <option id="monto" value=">"> Mayor que... </option>
                                                        <option id="monto" value="<"> Menor que... </option>
                                                        <option id="monto" value="="> Igual a... </option>
                                                    </select>    
                                                </div> 
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" value="0" id="monto-numero" placeholder="0" disabled> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                <label for="sucursal" class="col-form-label"> Sucursal: </label>
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="sucursal" placeholder="Ingrese Sucursal"> 
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row md-12">
                                    <div class="col-sm-4">      
                                        
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label for="modificado-por" class="col-form-label"> Usuario: </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="modificado-por" placeholder="Ingrese Usuario"> 
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
                                                <button onclick="fnConsultarHistorialVentas()" class="btn btn-primary col-12"> Consultar </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </form>
                            <hr style="border: 2px solid gray;">
                            <div class="row md-12">
                                <label class="col-form-label col-12"> Ventas </label>
                                <table style="overflow-x: auto; overflow-y: auto;" class="table table-striped" id="tabla-body-cabecera-historial-ventas">
                                    <thead class="col md-12">
                                        <tr class="col md-12">
                                            <th>Fecha Registro</th>
                                            <th>Venta Nro.</th>
                                            <th>Realizada Por</th>
                                            <th>Monto Total</th>
                                            <th>Sucursal</th>
                                            <th>Modo de Pago</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table table-striped" id="tabla-body-historial-ventas" class="col md-12">
                                        <!-- Las filas del historial de artículos que se agregarán  -->

                                    </tbody>
                                </table>
                                <br>
                                <label class="col-form-label col-12"> Detalle de Ventas </label>
                                <table style="overflow-x: auto; overflow-y: auto;" class="table table-striped" id="tabla-body-cabecera-historial-ventas-detalle">
                                    <thead class="col md-12">
                                        <tr class="col md-12">
                                            <th>Venta Nro.</th>
                                            <th>Artículo</th>
                                            <th>Cantidad</th>
                                            <th>Monto</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table table-striped" id="tabla-body-historial-ventas-detalle" class="col md-12">
                                        <!-- Las filas del historial de artículos que se agregarán  -->

                                    </tbody>
                                </table>
                            </div>
                            <hr style="border: 2px solid gray;">
                            <div class="row mt-12">
                                <div class="col-4">
                                    <button onclick="fnVolverHistorialVentas()" class="btn btn-primary col-12"> Volver </button>
                                </div>
                                <div class="col-4">
                                    <button onclick="fnGenerarReporteHistorialVentas()" class="btn btn-success col-12"> Generar Reporte </button>
                                </div>
                                <div class="col-4">
                                    <button onclick="fnLimpiarObjetosHistorialVentas()" class="btn btn-danger col-12"> Limpiar </button>
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
        <script src="../../js/historiales/historial_ventas/fnConsultarHistorialVentas.js"></script>
        <script src="../../js/historiales/historial_ventas/fnLimpiarObjetosHistorialVentas.js"> </script>
        <script src="../../js/historiales/historial_ventas/fnVolverHistorialVentas.js"> </script>
        <script src="../../js/historiales/historial_ventas/fnGenerarReporteHistorialVentas.js"> </script>
        <script src="../../js/historiales/historial_ventas/fnHabilitarMontoVentas.js"> </script>
        <script src="../../js/fnFechayHora.js"></script>

    </body>
</html>