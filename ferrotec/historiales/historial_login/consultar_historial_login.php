<?php
/*
    PHP:            consultar_historial_login.php
    Descripción:    Consulta a la base de datos para traer los registros del historial de login con los críterios elegidos
*/
    // Conexión a la base de datos MySQL
    require('../../conectar/conectar.php');

    // Iniciar sesión si no está iniciada
    session_start();

    // Obtener los datos enviados desde JavaScript
    $fechaDesde = $_POST['fecha-desde'];
    $fechaHasta = $_POST['fecha-hasta'];
    $usuarioNombre = $_POST['usuario-nombre'];
    $tipoActividad = $_POST['tipo-actividad'];
    $tipoPermiso = $_POST['tipo-permiso'];
    $email = $_POST['email'];
    $sucursal = $_POST['sucursal'];
    $cantRegistros = $_POST['cant-registros'];

    //echo $tipoActividad . "//" . $tipoPermiso . "//";

    // Formateo de Fechas creando objetos
    $fechaDesdeFormato = new DateTime($fechaDesde);
    $fechaHastaFormato = new DateTime($fechaHasta);

    $fechaDesde = $fechaDesdeFormato->format('Y-m-d H:i:s');
    $fechaHasta = $fechaHastaFormato->format('Y-m-d H:i:s');

    // Consulta Inicial
    $consulta = "SELECT DATE_FORMAT(HL.histlogin_fecha, '%d/%m/%Y %H:%i:%s') AS histlogin_fecha, 
                CASE HL.histlogin_in_out
                    WHEN 'in' THEN 'Ingreso'
                    WHEN 'out' THEN 'Egreso'
                    WHEN 'ree' THEN 'Rest. Contraseña'
                END AS histlogin_in_out, 
                U.usu_username  
                FROM historial_login HL
                INNER JOIN usuarios U
                ON HL.histlogin_usu_id = U.id
                INNER JOIN sucursales S
                ON U.usu_id_suc = S.id
                WHERE HL.histlogin_fecha >= '$fechaDesde' AND HL.histlogin_fecha <= '$fechaHasta'";
            
    // Lógica de la consulta según el contenido de las variables
    $condiciones_consulta = [];     // Inicializar el arreglo de las condiciones

    // Por cada variable controlar si no está vacía y agregar la condición al arreglo
    if($usuarioNombre !== ''){
        $condiciones_consulta[] = "U.usu_username LIKE '%$usuarioNombre%'"; 
    } 

    if($tipoActividad !== '' && $tipoActividad !== 'S'){
        $condiciones_consulta[] = "HL.histlogin_in_out = '$tipoActividad'"; 
    } 

    if($tipoPermiso !== '' && $tipoPermiso !== 'S'){
        $condiciones_consulta[] = "U.usu_id_permisos = '$tipoPermiso'"; 
    } 
    
    if($email !== ''){
        $condiciones_consulta[] = "U.usu_email LIKE '%$email%'"; 
    } 

    if($sucursal !== ''){
        $condiciones_consulta[] = "S.sucs_nombre LIKE '%$sucursal%'"; 
    } 

    // Arreglo del primer AND (para consultas en SQL con una instrucción anterior)
    if(count($condiciones_consulta) > 0){
        $consulta .= " AND ";
    }

    // Controlar si las condiciones no están vacías y concatenarlas en la consulta
    if(!empty($condiciones_consulta)){
        $consulta .= implode(' AND ' , $condiciones_consulta);
    }

    // Orden Descendiente
    $consulta .= " ORDER BY HL.histlogin_fecha DESC";

    //Si se eligió una cantidad de registros determinada, le agrega a la consulta el límite
    if($cantRegistros !== ''){
        $consulta .= " LIMIT $cantRegistros";
    }

    //echo $consulta;

    // Generar consulta
    $resultado = $conexion->query($consulta);

    // Inicializo el Array de Response y Artículos
    $response = [];
    $historial_login_datos = [];

    if($resultado->num_rows > 0){       // Si encontró artículos
        while($fila = $resultado->fetch_assoc()){
            $historial_login_datos[] = [
                'fecharegistro' => $fila['histlogin_fecha'],
                'tipoactividad' => $fila['histlogin_in_out'],
                'usuarionombre' => $fila['usu_username'],
            ];
        }
        $response = [
            'status' => 'success',
            'message' => 'Datos agregados correctamente',
            'data' => $historial_login_datos
        ];
    }
    else{                               // Si no encontró artículos
        $response = [
            'status' => 'success',
            'message' => 'No hay datos con los criterios ingresados.',
            'data' => []
        ];    
    }
    //ECHO "$response";
    // Envía los datos al JavaScript en formato JSON
    header('Content-Type: application/json');
    echo json_encode($response);

    // Cerrar la Conexión PHP
    $conexion->close();
?>