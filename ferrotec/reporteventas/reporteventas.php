<d?php
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
            <div class="col-md-9 mt-5">
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
                            <div class="row-md-12">
                                <div class="col-md-12" id="seleccione">
                                    <div class="form-group row">
                                        <div class="col-3"> 
                                            <label for="fecha-inicio" class="col-form-label">Fecha de Inicio:</label>
                                        </div>
                                        <div class="col-3"> 
                                            <input type="date" class="form-control" id="fecha-inicio" name="fecha-inicio">
                                        </div>
                                        <div class="col-3"> 
                                            <label for="fecha-fin" class="col-form-label">Fecha de Fin:</label>
                                        </div>
                                        <div class="col-3"> 
                                            <input type="date" class="form-control" id="fecha-fin" name="fecha-fin">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row-md-12">
                                <div class="col-sm-12" id="filtros-opcionales">
                                    <div class="form-group row">
                                        <div class="col-2">
                                            <label class="col-form-label"><i>Filtros opcionales:</i></label>
                                        </div>
                                        <div class="col-1">
                                            <label for="filtrar-usuario" class="col-form-label">Usuario:</label>
                                        </div>
                                        <div class="col-3">
                                            <input type="text" class="form-control" id="filtrar-usuario" minlength="1" maxlength="30" placeholder="Ingrese Usuario">
                                        </div>
                                        <div class="col-3">
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
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" id="filtro-texto" minlength="1" maxlength="30" placeholder="Ingrese Nombre">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row-md-12" id="fila-filtrado-datos3">                            
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <div class="col-2">
                                                <label for="filtrar-pago col-form-label">Método de pago:</label>
                                            </div>
                                            <div class="form-check form-check-inline col-1">
                                                <input class="form-check-input" type="radio" name="filtro-opcion-pago" id="filtrar-todos" value="0" checked>
                                                <label class="form-check-label" for="filtrar-todos">Todos</label>
                                            </div>
                                            <div class="form-check form-check-inline col-1">
                                                <input class="form-check-input" type="radio" name="filtro-opcion-pago" id="filtrar-efectivo" value="2">
                                                <label class="form-check-label" for="filtrar-efectivo">Efectivo</label>
                                            </div>
                                            <div class="form-check form-check-inline col-1">
                                                <input class="form-check-input" type="radio" name="filtro-opcion-pago" id="filtrar-debito" value="3">
                                                <label class="form-check-label" for="filtrar-debito">Débito</label>
                                            </div>
                                            <div class="form-check form-check-inline col-1">
                                                <input class="form-check-input" type="radio" name="filtro-opcion-pago" id="filtrar-credito" value="4">
                                                <label class="form-check-label" for="filtrar-credito">Crédito</label>
                                            </div>
                                            <div class="form-check form-check-inline col-3">
                                                <input class="form-check-input" type="radio" name="filtro-opcion-pago" id="filtrar-noespecificado" value="1">
                                                <label class="form-check-label" for="filtrar-credito">Págo No Especificado</label>
                                            </div>
                                            <div class="col text-end">
                                                <button type="button" class="btn btn-success col-12" id="generar-reporte-ventas">Generar Reporte</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr style="border: 2px solid gray;">
                        <div class="row-md-12">
                            <table class="table table-striped" id="tabla-reportes">
                                <thead>
                                    
                                </thead>
                                <tbody>
                                    <!-- Las filas del reporte que se agregarán  -->
                                </tbody>
                            </table>
                        </div>
                        <div class="row-md-12">
                            <div class="form-group row">
                                <div class="col-4 text-center">
                                    <button onclick="fnBotonesGeneral('V')" type="button" class="btn btn-primary col-12">
                                    Volver
                                    </button>
                                </div>
                                <div class="col-4 justify-content-end align-content-end" id="botones-alta-volver">
                                    <button type="button" class="btn btn-success col-12" id="descargar-reporte">
                                        Descargar Reporte
                                    </button>
                                </div>
                                <div class="col-4 justify-content-end align-content-end" id="botones-modificacion-cancelar">
                                    <button onclick="fnBotonesGeneral('C')" type="button" class="btn btn-danger col-12">
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
    <script src="../Js/reporteventas/reporteventas.js"></script>
    <script type="text/javascript" src="../Js/fnBotonesGeneral.js"></script>
    <script src="../js/fnFechayHora.js"></script>

</body>
</html>