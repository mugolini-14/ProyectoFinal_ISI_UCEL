<?php
/*
    PHP:            consultar_historial_usuarios.php
    Descripción:    Consulta a la base de datos para traer los registros del historial de usuarios con los críterios elegidos
*/
    // Conexión a la base de datos MySQL
    require('../../conectar/conectar.php');

    // Iniciar sesión si no está iniciada
    session_start();

    // Obtener los datos enviados desde JavaScript
    $fechaDesde = $_POST['fecha-desde'];
    $fechaHasta = $_POST['fecha-hasta'];
    $tipoAccion = $_POST['tipo-accion'];
    $modificadoPor = $_POST['modificado-por'];
    $tipoPermiso = $_POST['tipo-permiso'];
    $usuarioNombre = $_POST['usuario-nombre'];
    $sucursal = $_POST['sucursal'];
    $email = $_POST['email'];
    $cantRegistros = $_POST['cant-registros'];

    //echo $tipoActividad . "//" . $tipoPermiso . "//";

    // Formateo de Fechas creando objetos
    $fechaDesdeFormato = new DateTime($fechaDesde);
    $fechaHastaFormato = new DateTime($fechaHasta);

    $fechaDesde = $fechaDesdeFormato->format('Y-m-d H:i:s');
    $fechaHasta = $fechaHastaFormato->format('Y-m-d H:i:s');

    // Consulta Inicial
    $consulta = "SELECT DATE_FORMAT(HU.histusu_fechahora, '%d/%m/%Y %H:%i:%s') AS histusu_fechahora, 
                CASE HU.histusu_accion
                    WHEN 'alta_usu'     THEN 'Alta'
                    WHEN 'baja_usu'   THEN 'Baja'
                    WHEN 'modif_usu'    THEN 'Modificación'
                END AS histusu_accion, 
                U.usu_username, 
                U2.usu_username AS histusu_modificadopor, 
                P.perm_descripcion, HU.histusu_nombre, HU.histusu_apellido, 
                HU.histusu_direccion, S.sucs_nombre, HU.histusu_email,
                CASE HU.histusu_id_permisos
                    WHEN 1 Then 'No'
                    ELSE 'Si'
                END AS histusu_id_permisos
            FROM historial_usuarios HU
            INNER JOIN usuarios U
            ON HU.histusu_id_usu = U.id
            LEFT JOIN usuarios U2
            ON HU.histusu_id_usumodif = U2.id
            INNER JOIN sucursales S
            ON HU.histusu_id_suc = S.id
            INNER JOIN permisos P
            ON HU.histusu_id_permisos = P.id
            WHERE HU.histusu_fechahora >= '$fechaDesde' AND HU.histusu_fechahora <= '$fechaHasta'";

    // Lógica de la consulta según el contenido de las variables
    $condiciones_consulta = [];     // Inicializar el arreglo de las condiciones

    // Por cada variable controlar si no está vacía y agregar la condición al arreglo
    if($tipoAccion !== '' && $tipoAccion !== 'S'){
        $condiciones_consulta[] = "HU.histusu_accion = '$tipoAccion'";
    }
    
    if($modificadoPor !== ''){
        $condiciones_consulta[] = "U2.usu_username LIKE '%$modificadoPor%'"; 
    }

    if($tipoPermiso !== '' && $tipoPermiso !== 'S'){
        $condiciones_consulta[] = "HU.histusu_id_permisos = '$tipoPermiso'"; 
    } 

    if($usuarioNombre !== ''){
        $condiciones_consulta[] = "U.usu_username LIKE '%$usuarioNombre%'";
    } 

    if($sucursal !== ''){
        $condiciones_consulta[] = "S.sucs_nombre LIKE '%$sucursal%'"; 
    }

    if($email !== ''){
        $condiciones_consulta[] = "HU.histusu_email LIKE '%$email%'"; 
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
    $consulta .= " ORDER BY HU.histusu_fechahora DESC";

    //Si se eligió una cantidad de registros determinada, le agrega a la consulta el límite
    if($cantRegistros !== ''){
        $consulta .= " LIMIT $cantRegistros";
    }

    //echo $consulta;

    // Generar consulta
    $resultado = $conexion->query($consulta);

    // Inicializo el Array de Response y Artículos
    $response = [];
    $historial_usuarios_datos = [];

    if($resultado->num_rows > 0){       // Si encontró artículos
        while($fila = $resultado->fetch_assoc()){
            $historial_usuarios_datos[] = [
                'fecha' => $fila['histusu_fechahora'],
                'tipoaccion' => $fila['histusu_accion'],
                'username' => $fila['usu_username'],
                'modificadopor' => $fila['histusu_modificadopor'],
                'tipopermiso' => $fila['perm_descripcion'],
                'nombre' => $fila['histusu_nombre'],
                'apellido' => $fila['histusu_apellido'],
                'direccion' => $fila['histusu_direccion'],
                'sucursal' => $fila['sucs_nombre'],
                'email' => $fila['histusu_email'],
                'activo' => $fila['histusu_id_permisos']
            ];
        }
        $response = [
            'status' => 'success',
            'message' => 'Datos agregados correctamente',
            'data' => $historial_usuarios_datos
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