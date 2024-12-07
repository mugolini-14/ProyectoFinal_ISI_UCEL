<?php
/*
    PHP:            consultar_historial_tipos.php
    Descripción:    Consulta a la base de datos para traer los registros del historial de tipos con los críterios elegidos
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
    $tipo = $_POST['tipo'];
    $descripcion = $_POST['descripcion'];
    $cantRegistros = $_POST['cant-registros'];

    //echo $tipoActividad . "//" . $tipoPermiso . "//";

    // Formateo de Fechas creando objetos
    $fechaDesdeFormato = new DateTime($fechaDesde);
    $fechaHastaFormato = new DateTime($fechaHasta);

    $fechaDesde = $fechaDesdeFormato->format('Y-m-d H:i:s');
    $fechaHasta = $fechaHastaFormato->format('Y-m-d H:i:s');

    // Consulta Inicial
    $consulta = "SELECT DATE_FORMAT(HT.histtipos_fechahora, '%d/%m/%Y %H:%i:%s') AS histtipos_fechahora, 
                CASE HT.histtipos_accion
                    WHEN 'alta_tipo'     THEN 'Alta'
                    WHEN 'baja_tipo'   THEN 'Baja'
                    WHEN 'modif_tipo'    THEN 'Modificación'
                END AS histtipos_accion, 
                U.usu_username, 
                HT.histtipos_nombre, HT.histtipos_descripcion,
                CASE HT.histtipos_activo
                    WHEN 1  THEN 'Si'
                    WHEN 0  THEN 'No'
                END AS histtipos_activo
                FROM historial_tipos HT
                INNER JOIN usuarios U
                ON HT.histtipos_id_usu = U.id
                INNER JOIN tipos T
                ON HT.histtipos_id_tipos = T.id
                WHERE HT.histtipos_fechahora >= '$fechaDesde' AND HT.histtipos_fechahora <= '$fechaHasta'";

    // Lógica de la consulta según el contenido de las variables
    $condiciones_consulta = [];     // Inicializar el arreglo de las condiciones

    // Por cada variable controlar si no está vacía y agregar la condición al arreglo
    if($tipoAccion !== ''){
        $condiciones_consulta[] = "HT.histtipos_accion = '$tipoAccion'";
    }
    
    if($modificadoPor !== ''){
        $condiciones_consulta[] = "U.usu_username LIKE '%$modificadoPor%'"; 
    }

    if($tipo !== ''){
        $condiciones_consulta[] = "HT.histtipos_nombre LIKE '%$tipo%'"; 
    }

    if($descripcion !== ''){
        $condiciones_consulta[] = "HT.histtipos_descripcion LIKE '%$descripcion%'"; 
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
    $consulta .= " ORDER BY HT.histtipos_fechahora DESC";

    //Si se eligió una cantidad de registros determinada, le agrega a la consulta el límite
    if($cantRegistros !== ''){
        $consulta .= " LIMIT $cantRegistros";
    }

    //echo $consulta;

    // Generar consulta
    $resultado = $conexion->query($consulta);

    // Inicializo el Array de Response y Artículos
    $response = [];
    $historial_tipos_datos = [];

    if($resultado->num_rows > 0){       // Si encontró artículos
        while($fila = $resultado->fetch_assoc()){
            $historial_tipos_datos[] = [
                'fecha' => $fila['histtipos_fechahora'],
                'tipoaccion' => $fila['histtipos_accion'],
                'modificadopor' => $fila['usu_username'],
                'tipo' => $fila['histtipos_nombre'],
                'descripcion' => $fila['histtipos_descripcion'],
                'activo' => $fila['histtipos_activo']
            ];
        }
        $response = [
            'status' => 'success',
            'message' => 'Datos agregados correctamente',
            'data' => $historial_tipos_datos
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