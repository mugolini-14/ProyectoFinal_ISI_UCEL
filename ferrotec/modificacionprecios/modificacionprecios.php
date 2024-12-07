<?php
  session_start();
  if(!$_SESSION['logged']){
    header("Location: ../login.php");
  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../images/favicon.png">
    <title>Ferr O' Tec</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body style="background-color: #f2f2f2">
    <div class="container-fluid align-items-center justify-content-center">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left;">Ferr O'Tec &nbsp;</h4>
                        <img style="float: left; margin-right: 20px;" width="30px" height="30px" src="../images/favicon.png">
                        <h4 style="float: left;">Modificacion de Precios &nbsp;</h4>
                        <h4 style="float: right;">
                            <label id="texto-fecha-hora"></label>
                            <a href="../logout/logout.php" class="btn btn-warning"> LOGOUT </a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form id="formulario-alta">
                            <div class="row md-12">
                                <div class="col-md-2" id="seleccione">
                                    <div class="form-group row">
                                        <label class="form-col-label">Seleccione:</label>
                                    </div>
                                </div>
                                <div class="col-md-2" id="fila-filtrado-datos">
                                    <div class="form-group row">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="seleccion-opcion" id="filtrar-tipo" value="tipo" checked>
                                            <label class="form-check-label" for="filtrar-tipo">Tipo</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="seleccion-opcion" id="filtrar-categoria" value="categoria">
                                            <label class="form-check-label" for="filtrar-categoria">Categoría</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="seleccion-opcion" id="filtrar-articulo" value="articulo">
                                            <label class="form-check-label" for="filtrar-articulo">Artículo</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3" id="fila-filtrado-datos2">
                                    <input type="text" class="form-control" id="seleccion-nombre" minlength="1" maxlength="30" placeholder="Ingrese Nombre">
                                </div>
                                <div class="col-md-3" id="fila-filtrado-datos2">
                                    <label class="form-col-label"> Porcentaje a Modificar (%):</label>
                                </div>
                                <div class="col-md-2" id="fila-filtrado-datos2">
                                    <input type="text" class="form-control" id="porcentual-modificacion" minlength="1" maxlength="3" placeholder="0-100">
                                </div>
                            </div>
                            <br>
                            <div class="row md-12">
                                <div class="col-4" id="fila-boton">
                                    <div class="text-center">
                                        <button onclick="fnBotonesGeneral('V')" type="button" class="btn btn-primary col-12">
                                            Volver
                                        </button>
                                    </div>
                                </div>
                                <div class="col-4" id="fila-boton">
                                    <div class="text-center">
                                        <button type="button" class="btn btn-success col-12" id="modificar-precios">
                                            Modificar Precios
                                        </button>
                                    </div>
                                </div>
                                <div class="col-4" id="fila-boton">
                                    <button onclick="fnBotonesGeneral('C')" type="button" class="btn btn-danger col-12">
                                            Cancelar
                                    </button>
                                </div>
                            </div>
                        </form>
                        <hr style="border: 2px solid gray;">
                        <div class="row-mt-4">
                            <table class="table table-striped" id="tabla-reportes">
                                <thead>
                                    <tr>
                                        <th><h5>Modificaciones realizadas:</h5></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Las filas del reporte que se agregarán  -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- JS Propios -->
    <script src="../Js/modificacionprecios/modificacionprecios.js"></script>
    <script type="text/javascript" src="../Js/fnBotonesGeneral.js"></script>
    <script src="../js/fnFechayHora.js"></script>

</body>
</html>