<?php
/*
    PHP:            consultar_usuarios.php
    Descripción:    Consulta a la base de datos para traer los usuarios con los críterios elegidos
*/
    // Conexión a la base de datos MySQL
    require('../../conectar/conectar.php');

    // Iniciar sesión si no está iniciada
    session_start();

    // Obtener los datos enviados desde JavaScript
    $id = $_POST['id'];
    $userName = $_POST['username'];
    $tipoPermiso = $_POST['tipo-permiso'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $sucursal = $_POST['sucursal'];
    $email = $_POST ['email'];

    // Consulta Inicial
    $consulta = "SELECT U.id, U.usu_username, P.perm_descripcion, U.usu_username, 
                U.usu_nombre, U.usu_apellido, U.usu_direccion, 
                S.sucs_nombre, U.usu_email,
                CASE U.usu_id_permisos
                    WHEN 1  THEN 'No'
                    ELSE 'Si'
                END AS usu_activo
                FROM usuarios U
                INNER JOIN permisos P
                ON U.usu_id_permisos = P.id
                INNER JOIN sucursales S
                ON U.usu_id_suc = S.id";
            
    // Lógica de la consulta según el contenido de las variables
    $condiciones_consulta = [];     // Inicializar el arreglo de las condiciones

    // Por cada variable controlar si no está vacía y agregar la condición al arreglo
    if($id !== ''){
        $condiciones_consulta[] = "U.id LIKE '%$id%'"; 
    } 

    if($userName !== ''){
        $condiciones_consulta[] = "U.usu_username LIKE '%$userName%'"; 
    } 

    if($tipoPermiso !== ''){
        $condiciones_consulta[] = "U.usu_id_permisos = '$tipoPermiso'"; 
    } 

    if($nombre !== ''){
        $condiciones_consulta[] = "U.usu_nombre LIKE '%$nombre%'"; 
    } 
    
    if($apellido !== ''){
        $condiciones_consulta[] = "U.usu_apellido LIKE '%$apellido%'"; 
    } 

    if($direccion !== ''){
        $condiciones_consulta[] = "U.usu_direccion LIKE '%$direccion%'"; 
    } 

    if($email !== ''){
        $condiciones_consulta[] = "U.usu_email LIKE '%$email%'"; 
    } 
    
    if($sucursal !== ''){
        $condiciones_consulta[] = "S.sucs_nombre LIKE '%$sucursal%'"; 
    } 

    // Controlar si las condiciones no están vacías y concatenarlas en la consulta
    if(!empty($condiciones_consulta)){
        $consulta .= " WHERE " . implode(' AND ' , $condiciones_consulta);
    }

    // Generar consulta
    $resultado = $conexion->query($consulta);       

    // Inicializo el Array de Response y Artículos
    $response = [];
    $usuarios = [];

    if($resultado->num_rows > 0){       // Si encontró artículos
        while($fila = $resultado->fetch_assoc()){
            $usuarios[] = [
                'id' => $fila['id'],
                'tipopermiso' => $fila['perm_descripcion'],
                'username' => $fila['usu_username'],
                'nombre' => $fila['usu_nombre'],
                'apellido' => $fila['usu_apellido'],
                'direccion' => $fila['usu_direccion'],
                'sucursal' => $fila['sucs_nombre'],
                'email' => $fila['usu_email'],
                'activo' => $fila['usu_activo']
            ];
        }
        $response = [
            'status' => 'success',
            'message' => 'Usuarios agregados correctamente',
            'data' => $usuarios
        ];
    }
    else{                               // Si no encontró artículos
        $response = [
            'status' => 'success',
            'message' => 'No hay usuarios con los criterios ingresados.',
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