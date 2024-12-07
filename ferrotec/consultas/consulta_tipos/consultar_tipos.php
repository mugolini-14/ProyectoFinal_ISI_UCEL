<?php
/*
    PHP:            consultar_tipos.php
    Descripción:    Consulta a la base de datos para traer los tipos con los críterios elegidos
*/
    // Conexión a la base de datos MySQL
    require('../../conectar/conectar.php');

    // Iniciar sesión si no está iniciada
    session_start();

    // Obtener los datos enviados desde JavaScript
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    // Consulta Inicial
    $consulta = "SELECT tipos_nombre, tipos_descripcion,
                CASE tipos_activo
                WHEN 1  THEN 'Si'
                WHEN 0  THEN 'No'
                END AS tipos_activo 
                FROM tipos";

    // Lógica de la consulta según el contenido de las variables
    $condiciones_consulta = [];     // Inicializar el arreglo de las condiciones

    // Por cada variable controlar si no está vacía y agregar la condición al arreglo
    if($nombre !== ''){
        $condiciones_consulta[] = "tipos_nombre LIKE '%$nombre%'"; 
    } 

    if($descripcion !== ''){
        $condiciones_consulta[] = "tipos_descripcion LIKE '%$descripcion%'"; 
    } 

    // Controlar si las condiciones no están vacías y concatenarlas en la consulta
    if(!empty($condiciones_consulta)){
        $consulta .= " WHERE " . implode(' AND ' , $condiciones_consulta);
    }

    // Generar consulta
    $resultado = $conexion->query($consulta);

    // Inicializo el Array de Response y Artículos
    $response = [];
    $tipos = [];

    if($resultado->num_rows > 0){       // Si encontró artículos
        while($fila = $resultado->fetch_assoc()){
            $tipos[] = [
                'nombre' => $fila['tipos_nombre'],
                'descripcion' => $fila['tipos_descripcion'],
                'activo' => $fila['tipos_activo']
            ];
        }
        $response = [
            'status' => 'success',
            'message' => 'Tipos agregados correctamente',
            'data' => $tipos
        ];
    }
    else{                               // Si no encontró artículos
        $response = [
            'status' => 'success',
            'message' => 'No hay tipos con los criterios ingresados.',
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