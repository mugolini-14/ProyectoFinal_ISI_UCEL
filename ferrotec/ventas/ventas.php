<!DOCTYPE html>
<html lang="en">
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
                        <h4 style="float: left;">Ventas &nbsp;</h4>
                        <h4 style="float: right;">
                            <label id="texto-fecha-hora"></label>
                            <a href="../logout/logout.php" class="btn btn-warning"> LOGOUT </a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form id="formulario-alta">
                            <div class="row py-2" id="nombre-tipo-alta-fila">
                                <div class="col-md-3">
                                    <div class="form-group row">
                                        <label for="busqueda-articulo" class="col-sm-4 col-form-label">Articulo:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="busqueda-articulo" minlength="1" maxlength="30" placeholder="Ingrese Artículo">
                                            <ul id="suggestions" class="list-group"></ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group row">
                                        <label for="valor-unitario" class="col-sm-6 col-form-label">Valor Unit.:</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="valor-unitario" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group row">
                                        <label for="stock" class="col-sm-6 col-form-label">Stock disp:</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="stock" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group row">
                                        <label for="cantidad" class="col-sm-6 col-form-label">Cantidad:</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="cantidad" placeholder="Cantidad">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group row">
                                        <label for="total-articulo" class="col-sm-6 col-form-label">Total artículo:</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="total-articulo" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row py-2">
                                    <div class="form-group row">
                                        <label for="descripcion" class="col-sm-2 col-form-label">Descripcion:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="descripcion" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-success" id="agregar-articulo">Agregar</button>
                                </div>
                            </div>
                        </form>
                        <hr style="border: 2px solid gray;">
                        <div class="mt-4">
                            <table class="table table-striped" id="tabla-articulos">
                                <thead>
                                    <tr>
                                    <th></th>
                                        <th>Artículo</th>
                                        <th>Valor Unitario</th>
                                        <th>Cantidad</th>
                                        <th>Sub-total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Las filas de artículos que se agregarán  -->

                                </tbody>
                            </table>
                            <div class="row py-3">
                                <div class="col-4 align-content-end">
                                    <label for="modo-de-pago" class="col-sm-6 col-form-label">Modo de Pago:</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" id="modo-de-pago">
                                            <option value="">Seleccione un método</option>
                                            <option value="1">Efectivo</option>
                                            <option value="2">Tarjeta</option>
                                            <option value="3">Transferencia</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row py-2 justify-content-end">
                                <div class="col-2 align-content-end">
                                    <h5>Total: $<span id="total-general">0.00</span>
                                    </h5>
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="col-4 text-center">
                                    <button onclick="fnBotonesventas('V')" type="button" class="btn btn-primary col-12">
                                    Volver
                                    </button>
                                </div>
                                <div class="col-4 justify-content-end align-content-end" id="botones-alta-volver">
                                    <button type="button" class="btn btn-success col-12" id="generar-venta">
                                    Generar Venta
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
    <script src="../Js/ventas/ventas.js"></script>
    <script type="text/javascript" src="../Js/ventas/fnBotonesventas.js"></script>
</body>
</html>