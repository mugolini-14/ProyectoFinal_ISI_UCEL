<?php
/*
    PHP:            consultar_proveedores.php
    Descripción:    Consulta a la base de datos para traer los proveedores con los críterios elegidos
*/

    // Conexión a la base de datos MySQL
    require('../../conectar/conectar.php');

    // Iniciar sesión si no está iniciada
    session_start();

    // Obtener los datos enviados desde JavaScript
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $direccion = $_POST['direccion'];
    $localidad = $_POST['localidad'];
    $provincia = $_POST['provincia'];
    $tel1 = $_POST['telefono1'];
    $tel2 = $_POST['telefono2'];
    $email = $_POST ['email'];
    $cuit = $_POST['cuit'];

    // Consulta Inicial
    $consulta = "SELECT prov_nombre, prov_descripcion, prov_direccion, prov_localidad, prov_provincia,
                prov_tel1, prov_tel2, prov_email, prov_cuit,
                CASE prov_activo
                WHEN 1  THEN 'Si'
                WHEN 0  THEN 'No'
                END as prov_activo 
                FROM proveedores";
            
    // Lógica de la consulta según el contenido de las variables
    $condiciones_consulta = [];     // Inicializar el arreglo de las condiciones

    // Por cada variable controlar si no está vacía y agregar la condición al arreglo
    if($nombre !== ''){
        $condiciones_consulta[] = "prov_nombre LIKE '%$nombre%'"; 
    } 

    if($descripcion !== ''){
        $condiciones_consulta[] = "prov_descripcion LIKE '%$descripcion%'"; 
    } 

    if($direccion !== ''){
        $condiciones_consulta[] = "prov_direccion LIKE '%$direccion%'"; 
    } 

    if($localidad !== ''){
        $condiciones_consulta[] = "prov_localidad LIKE '%$localidad%'"; 
    } 

    if($provincia !== ''){
        $condiciones_consulta[] = "prov_provincia LIKE '%$provincia%'"; 
    } 
    
    if($tel1 !== ''){
        $condiciones_consulta[] = "prov_tel1 LIKE '%$tel1%'"; 
    } 

    if($tel2 !== ''){
        $condiciones_consulta[] = "prov_tel2 LIKE '%$tel2%'"; 
    } 

    if($email !== ''){
        $condiciones_consulta[] = "prov_email LIKE '%$email%'"; 
    } 
    
    if($cuit !== ''){
        $condiciones_consulta[] = "prov_cuit LIKE '%$cuit%'"; 
    } 

    // Controlar si las condiciones no están vacías y concatenarlas en la consulta
    if(!empty($condiciones_consulta)){
        $consulta .= " WHERE " . implode(' AND ' , $condiciones_consulta);
    }

    // Generar consulta
    $resultado = $conexion->query($consulta);

    // Inicializo el Array de Response y Artículos
    $response = [];
    $proveedores = [];

    if($resultado->num_rows > 0){       // Si encontró artículos
        while($fila = $resultado->fetch_assoc()){
            $proveedores[] = [
                'nombre' => $fila['prov_nombre'],
                'descripcion' => $fila['prov_descripcion'],
                'direccion' => $fila['prov_direccion'],
                'localidad' => $fila['prov_localidad'],
                'provincia' => $fila['prov_provincia'],
                'tel1' => $fila['prov_tel1'],
                'tel2' => $fila['prov_tel2'],
                'email' => $fila['prov_email'],
                'cuit' => $fila['prov_cuit'],
                'activo' => $fila['prov_activo']
            ];
        }
        $response = [
            'status' => 'success',
            'message' => 'Proveedores agregados correctamente',
            'data' => $proveedores
        ];
    }
    else{                               // Si no encontró artículos
        $response = [
            'status' => 'success',
            'message' => 'No hay proveedores con los criterios ingresados.',
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