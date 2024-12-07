<?php
/*
    PHP:            consultar_historial_articulos.php
    Descripción:    Consulta a la base de datos para traer los registros del historial artículos con los críterios elegidos
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
    $articulo = $_POST['articulo'];
    $marca = $_POST['marca'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $cantRegistros = $_POST['cant-registros'];

    //echo $tipoActividad . "//" . $tipoPermiso . "//";

    // Formateo de Fechas creando objetos
    $fechaDesdeFormato = new DateTime($fechaDesde);
    $fechaHastaFormato = new DateTime($fechaHasta);

    $fechaDesde = $fechaDesdeFormato->format('Y-m-d H:i:s');
    $fechaHasta = $fechaHastaFormato->format('Y-m-d H:i:s');

    // Consulta Inicial
    $consulta = "SELECT DATE_FORMAT(HA.histart_fechahora, '%d/%m/%Y %H:%i:%s') AS histart_fechahora, 
                CASE HA.histart_accion
                    WHEN 'alta_art'     THEN 'Alta'
                    WHEN 'baja_art'   THEN 'Baja'
                    WHEN 'modif_art'    THEN 'Modificación'
                    WHEN 'modifpre_art' THEN 'Modificación'
                END AS histart_accion, 
                U.usu_username, 
                HA.histart_nombre, HA.histart_marca, HA.histart_descripcion, 
                C.cat_nombre, HA.histart_precio, 
                CASE HA.histart_activo
                    WHEN 1  THEN 'Si'
                    WHEN 0  THEN 'No'
                END AS histart_activo
                FROM historial_articulos HA
                INNER JOIN usuarios U
                ON HA.histart_id_usu = U.id
                INNER JOIN articulos A
                ON HA.histart_id_art = A.id
                INNER JOIN categorias C
                ON HA.histart_id_categoria = C.id
                WHERE HA.histart_fechahora >= '$fechaDesde' AND HA.histart_fechahora <= '$fechaHasta'";

    // Lógica de la consulta según el contenido de las variables
    $condiciones_consulta = [];     // Inicializar el arreglo de las condiciones

    // Por cada variable controlar si no está vacía y agregar la condición al arreglo
    if($tipoAccion !== '' && $tipoAccion !== 'S'){
        $condiciones_consulta[] = "HA.histart_accion = '$tipoAccion'";
    }
    
    if($modificadoPor !== ''){
        $condiciones_consulta[] = "U.usu_username LIKE '%$modificadoPor%'"; 
    }

    if($articulo !== ''){
        $condiciones_consulta[] = "HA.histart_nombre LIKE '%$articulo%'"; 
    }

    if($marca !== ''){
        $condiciones_consulta[] = "HA.histart_marca LIKE '%$marca%'"; 
    }

    if($descripcion !== ''){
        $condiciones_consulta[] = "HA.histart_descripcion LIKE '%$descripcion%'"; 
    }

    if($precio !== ''){
        $condiciones_consulta[] = "HA.histart_precio = '$precio'"; 
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
    $consulta .= " ORDER BY HA.histart_fechahora DESC";

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
                'fecha' => $fila['histart_fechahora'],
                'tipoaccion' => $fila['histart_accion'],
                'modificadopor' => $fila['usu_username'],
                'articulo' => $fila['histart_nombre'],
                'marca' => $fila['histart_marca'],
                'descripcion' => $fila['histart_descripcion'],
                'categoria' => $fila['cat_nombre'],
                'precio' => $fila['histart_precio'],
                'activo' => $fila['histart_activo']
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