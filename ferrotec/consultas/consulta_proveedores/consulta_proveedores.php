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
        #tabla-body-cabecera-proveedores {
            display: block;
            overflow-x: auto;
        }

        #tabla-body-cabecera-proveedores tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        #tabla-body-proveedores {
            display: block;
            max-height: 100px; /* Ajusta la altura según el tamaño de las filas */
            overflow-y: auto;
            scrollbar-width: none;
        }   

        #tabla-body-proveedores tr {
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
                            <h4 style="float: left;">Consulta de Proveedores &nbsp;</h4>
                            <h4 style="float: right;">
                                <label id="texto-fecha-hora"></label>
                                <a href="../../logout/logout.php" class="btn btn-warning"> LOGOUT </a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form id="formulario-consulta">
                                <div class="row md-12" id="articulo-marca-fila">
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label for="nombre" class="col-sm-3 col-form-label">Nombre:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="nombre" minlength="1" maxlength="30" placeholder="Ingrese nombre de Proveedor">
                                                <ul id="suggestions" class="list-group"></ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group row">
                                            <label for="descripcion" class="col-sm-2 col-form-label">Descripción:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="descripcion" placeholder="Ingrese Descripción">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row md-12">
                                    <div class="col md-2">
                                        <label for="direccion" class="col-form-label col-12">Dirección:</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control col-12" id="direccion" placeholder="Ingrese Dirección">
                                    </div>
                                    <div class="col md-2">
                                        <label for="localidad" class="col-form-label col-12">Localidad:</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control col-12" id="localidad" placeholder="Ingrese Localidad">
                                    </div>
                                </div>
                                <br>
                                <div class="row md-12">
                                    <div class="col md-1">
                                        <label for="provincia" class="col-form-label col-12">Provincia:</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control col-12" id="provincia" placeholder="Ingrese Provincia">
                                    </div>
                                    <div class="col md-1">
                                        <label for="telefono1" class="col-form-label col-12">Teléfono 1:</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control col-12" id="telefono1" placeholder="Ingrese Teléfono 1">
                                    </div>
                                    <div class="col md-1">
                                        <label for="telefono2" class="col-form-label col-12">Teléfono 2:</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control col-12" id="telefono2" placeholder="Ingrese Teléfono 2">
                                    </div>
                                </div>
                                <br>
                                <div class="row md-12">
                                    <div class="col md-2">
                                        <label for="email" class="col-form-label col-12">E-mail:</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control col-12" id="email" placeholder="Ingrese E-mail">
                                    </div>
                                    <div class="col md-2">
                                        <label for="cuit" class="col-form-label col-12">CUIT:</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control col-12" id="cuit" placeholder="Ingrese CUIT">
                                    </div>
                                    <div class="col md-2">
                                        <button onclick="fnConsultarProveedores()" class="btn btn-primary col-12"> Consultar </button>
                                    </div>
                                </div>
                            </form>
                            <hr style="border: 2px solid gray;">
                            <div class="row md-12">
                                <table style="overflow-x: auto; overflow-y: auto;" class="table table-striped" id="tabla-body-cabecera-proveedores">
                                    <thead class="col md-12">
                                        <tr class="col md-12">
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Dirección</th>
                                            <th>Localidad</th>
                                            <th>Provincia</th>
                                            <th>Telefono 1</th>
                                            <th>Telefono 2</th>
                                            <th>E-mail</th>
                                            <th>CUIT</th>
                                            <th>Activo</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table table-striped" id="tabla-body-proveedores" class="col md-12">
                                        <!-- Las filas de proveedores que se agregarán  -->

                                    </tbody>
                                </table>
                            </div>
                            <hr style="border: 2px solid gray;">
                            <div class="row mt-12">
                                <div class="col-4">
                                    <button onclick="fnVolverProveedores()" class="btn btn-primary col-12"> Volver </button>
                                </div>
                                <div class="col-4">
                                    <button onclick="fnGenerarReporteProveedores()" class="btn btn-success col-12"> Generar Reporte </button>
                                </div>
                                <div class="col-4">
                                    <button onclick="fnLimpiarObjetosProveedores()" class="btn btn-danger col-12"> Limpiar </button>
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
        <script src="../../js/consultas/consulta_proveedores/fnConsultarProveedores.js"></script>
        <script src="../../js/consultas/consulta_proveedores/fnLimpiarObjetosProveedores.js"> </script>
        <script src="../../js/consultas/consulta_proveedores/fnVolverProveedores.js"> </script>
        <script src="../../js/consultas/consulta_proveedores/fnGenerarReporteProveedores.js"> </script>
        <script src="../../js/fnFechayHora.js"></script>
    </body>
</html>