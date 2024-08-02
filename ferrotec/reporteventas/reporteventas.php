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
            <div class="col-md-12 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left;">Ferr O'Tec &nbsp;</h4>
                        <img style="float: left; margin-right: 20px;" width="30px" height="30px" src="../images/favicon.png">
                        <h4 style="float: left;">Reporte de Ventas &nbsp;</h4>
                        <h4 style="float: right;">
                            <label id="texto-fecha-hora"></label>
                            <a href="../logout/logout.php" class="btn btn-warning"> LOGOUT </a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form id="formulario-alta">
                            <div class="row py-2" id="seleccione">
                                <div class="col-md-3">
                                    <div class="form-group row">
                                        <label>Seleccione:</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row py-2" id="fila-filtrado-fecha">
                                <div class="col-md-3">
                                    <div class="form-group row">
                                        <label for="fecha-inicio">Fecha de inicio:</label>
                                        <div class="col-sm-8">
                                        <input type="date" id="fecha-inicio" name="fecha-inicio">
                                            <ul id="suggestions" class="list-group"></ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group row">
                                        <label for="fecha-fin">Fecha de fin:</label>
                                        <div class="col-sm-6">
                                            <input type="date" id="fecha-fin" name="fecha-fin">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row py-2" id="filtros-opcionales">
                                <div class="col-md-3">
                                    <div class="form-group row">
                                        <label>Filtros opcionales:</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row py-2" id="fila-filtrado-datos">
                                <div class="col-md-3">
                                    <div class="form-group row">
                                        <label for="filtrar-usuario" class="col-sm-4 col-form-label">Usuario:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="filtrar-usuario" minlength="1" maxlength="30" placeholder="Filtre por usuario">
                                            <ul id="suggestions" class="list-group"></ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="filtro-opcion" id="filtrar-tipo" value="tipo" checked>
                                    <label class="form-check-label" for="filtrar-tipo">Tipo</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="filtro-opcion" id="filtrar-categoria" value="categoria">
                                    <label class="form-check-label" for="filtrar-categoria">Categoría</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="filtro-opcion" id="filtrar-articulo" value="articulo">
                                    <label class="form-check-label" for="filtrar-articulo">Artículo</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="filtro-texto" minlength="1" maxlength="30" placeholder="Filtre por...">
                                </div>
                            </div>
                            <div class="row py-2" id="fila-boton">
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-success" id="generar-reporte-ventas">Generar Reporte</button>
                                </div>
                            </div>
                        </form>
                        <hr style="border: 2px solid gray;">
                        <div class="mt-4">
                            <table class="table table-striped" id="tabla-reportes">
                                <thead>
                                    <tr>
                                        <th>Reporte:</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Las filas del reporte que se agregarán  -->

                                </tbody>
                            </table>
                            <div class="row py-2">
                                <div class="col-4 text-center">
                                    <button onclick="fnBotonesventas('V')" type="button" class="btn btn-primary col-12">
                                    Volver
                                    </button>
                                </div>
                                <div class="col-4 justify-content-end align-content-end" id="botones-alta-volver">
                                    <button type="button" class="btn btn-success col-12" id="descargar-reporte">
                                    Descargar reporte
                                    </button>
                                </div>
                                <div class="col-4 justify-content-end align-content-end" id="botones-modificacion-cancelar">
                                    <button onclick="fnBotonesventas('C')" type="button" class="btn btn-danger col-12">
                                        Cancelar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- JS Propios -->
    <script src="../Js Propios/js-fechayhora.js"></script>
    <!-- JS -->
    <script src="../Js/reporteventas/reporteventas.js"></script>
    <script type="text/javascript" src="../Js/reporteventas/fnBotonesreporteventas.js"></script>
</body>
</html>