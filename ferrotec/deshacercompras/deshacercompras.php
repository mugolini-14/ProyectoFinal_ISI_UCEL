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
            <div class="col-md-7 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left;">Ferr O'Tec &nbsp;</h4>
                            <img style="float: left; margin-right: 20px;" width="30px" height="30px" src="../images/favicon.png">
                        <h4 style="float: left;">Deshacer Compras &nbsp;</h4>
                        <h4 style="float: right;">
                            <label id="texto-fecha-hora"></label>
                                &nbsp;
                            <a href="../logout/logout.php" class="btn btn-warning"> LOGOUT </a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form id="formulario-alta">
                            <div class="row md-12" id="seleccione">
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-form-label" for="iddeshacer">ID de compra a deshacer:</label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="iddeshacer" minlength="1" maxlength="10" placeholder="ID">
                                </div>
                            </div>
                            <br>
                            <div class="row md-12" id="fila-boton">
                                <div class="col-4 text-center">
                                    <button onclick="fnBotonesGeneral('V')" type="button" class="btn btn-primary col-12">
                                        Volver
                                    </button>
                                </div>
                                <div class="col-4 text-center">
                                    <button onclick="fnDeshacerCompras()" type="button" class="btn btn-success col-12" id="deshacer-compra-btn">
                                        Deshacer Compra
                                    </button>
                                </div>
                                <div class="col-4 justify-content-end align-content-end" id="botones-modificacion-cancelar">
                                    <button onclick="fnBotonesGeneral('C')" type="button" class="btn btn-danger col-12">
                                        Cancelar
                                    </button>
                                </div>
                            </div>
                        </form>
                        <hr style="border: 2px solid gray;">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- JS Propios -->
    <script src="../Js/deshacercompras/fndeshacercompra.js"></script>
    <script type="text/javascript" src="../Js/fnBotonesGeneral.js"></script>
    <script src="../js/fnFechayHora.js"></script>
</body>
</html>