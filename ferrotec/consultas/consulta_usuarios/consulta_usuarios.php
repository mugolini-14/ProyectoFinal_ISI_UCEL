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
        #tabla-body-cabecera-usuarios {
            display: block;
            overflow-x: auto;
        }

        #tabla-body-cabecera-usuarios tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        #tabla-body-usuarios {
            display: block;
            max-height: 100px; /* Ajusta la altura según el tamaño de las filas */
            overflow-y: auto;
            scrollbar-width: none;
        }   

        #tabla-body-usuarios tr {
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
                            <h4 style="float: left;">Consulta de Usuarios &nbsp;</h4>
                            <h4 style="float: right;">
                                <label id="texto-fecha-hora"></label>
                                <a href="../../logout/logout.php" class="btn btn-warning"> LOGOUT </a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form id="formulario-consulta">
                                <div class="row md-12">
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label for="username" class="col-sm-3 col-form-label">Usuario:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="username" minlength="1" maxlength="30" placeholder="Ingrese nombre de Usuario">
                                                <ul id="suggestions" class="list-group"></ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <label for="tipo-permiso" class="col-form-label"> Permisos: </label>
                                    </div>
                                    <div class="col-sm-2">
                                        <select class="form-select" id="tipo-permiso">
                                            <option id="tipo-permiso" value=""> Todos </option>
                                            <option id="tipo-permiso" value="1"> Inactivo </option>
                                            <option id="tipo-permiso" value="2"> Vendedor </option>
                                            <option id="tipo-permiso" value="3"> Supervisor </option>
                                            <option id="tipo-permiso" value="4"> Administrador </option>
                                        </select>    
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label for="nombre" class="col-sm-3 col-form-label">Nombre:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="nombre" placeholder="Ingrese Nombre">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label for="apellido" class="col-sm-3 col-form-label">Apellido:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="apellido" placeholder="Ingrese Apellido">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row md-12">
                                    <div class="col-md-1">
                                        <div class="form-group row">
                                            <label for="id" class="col-sm-5 col-form-label">ID:</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" id="id">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label for="direccion" class="col-sm-3 col-form-label">Dirección:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="direccion" placeholder="Ingrese Dirección">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label for="sucursal" class="col-sm-4 col-form-label">Sucursal:</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="sucursal" placeholder="Ingrese Sucursal">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-3 col-form-label">E-mail:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="email" placeholder="Ingrese E-mail">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row md-12">
                                    <div class="col-sm-9">

                                    </div>
                                    <div class="col-sm-3">
                                        <button class="btn btn-primary col-12" onclick="fnConsultarUsuarios()"> Consultar </button>
                                    </div>
                                </div>
                                </form>
                            </form>
                            <hr style="border: 2px solid gray;">
                            <div class="row md-12">
                                <table style="overflow-x: auto; overflow-y: auto;" class="table table-striped" id="tabla-body-cabecera-usuarios">
                                    <thead class="col md-12">
                                        <tr class="col md-12">
                                            <th>ID</th>
                                            <th>Usuario</th>
                                            <th>Tipo Permiso</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Dirección</th>
                                            <th>Sucursal</th>
                                            <th>E-mail</th>
                                            <th>Activo</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table table-striped" id="tabla-body-usuarios" class="col md-12">
                                        <!-- Las filas de usuarios que se agregarán  -->

                                    </tbody>
                                </table>
                            </div>
                            <hr style="border: 2px solid gray;">
                            <div class="row mt-12">
                                <div class="col-4">
                                    <button onclick="fnVolverUsuarios()" class="btn btn-primary col-12"> Volver </button>
                                </div>
                                <div class="col-4">
                                    <button onclick="fnGenerarReporteUsuarios()" class="btn btn-success col-12"> Generar Reporte </button>
                                </div>
                                <div class="col-4">
                                    <button onclick="fnLimpiarObjetosUsuarios()" class="btn btn-danger col-12"> Limpiar </button>
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
        <script src="../../js/consultas/consulta_usuarios/fnConsultarUsuarios.js"></script>
        <script src="../../js/consultas/consulta_usuarios/fnLimpiarObjetosUsuarios.js"> </script>
        <script src="../../js/consultas/consulta_usuarios/fnVolverUsuarios.js"> </script>
        <script src="../../js/consultas/consulta_usuarios/fnGenerarReporteUsuarios.js"> </script>
        <script src="../../js/fnFechayHora.js"></script>

    </body>
</html>