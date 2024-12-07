<?php
/*
    PHP:            consultar_historial_categorias.php
    Descripción:    Consulta a la base de datos para traer los registros del historial de categorías con los críterios elegidos
*/
    // Conexión a la base de datos MySQL
    require('../../conectar/conectar.php');

    // Iniciar sesión si no está iniciada
    session_start();

    // Obtener los datos enviados desde JavaScript
    $fechaDesde = $_POST['fecha-desde'];
    $fechaHasta = $_POST['fecha-hasta'];
    $catAccion = $_POST['cat-accion'];
    $modificadoPor = $_POST['modificado-por'];
    $categoria = $_POST['categoria'];
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
    $consulta = "SELECT DATE_FORMAT(HC.histcat_fechahora, '%d/%m/%Y %H:%i:%s') AS histcat_fechahora, 
                CASE HC.histcat_accion
                    WHEN 'alta_cat'     THEN 'Alta'
                    WHEN 'baja_cat'   THEN 'Baja'
                    WHEN 'modif_cat'    THEN 'Modificación'
                END AS histcat_accion, 
                U.usu_username, 
                HC.histcat_nombre, T.tipos_nombre, HC.histcat_descripcion,
                CASE HC.histcat_activo
                    WHEN 0  THEN 'No'
                    WHEN 1  THEN 'Si'
                END AS histcat_activo
                FROM historial_categorias HC
                INNER JOIN usuarios U
                ON HC.histcat_id_usu = U.id
                INNER JOIN tipos T
                ON HC.histcat_id_tipos = T.id
                WHERE HC.histcat_fechahora >= '$fechaDesde' AND HC.histcat_fechahora <= '$fechaHasta'";

    // Lógica de la consulta según el contenido de las variables
    $condiciones_consulta = [];     // Inicializar el arreglo de las condiciones

    // Por cada variable controlar si no está vacía y agregar la condición al arreglo
    if($catAccion !== ''){
        $condiciones_consulta[] = "HC.histcat_accion = '$catAccion'";
    }
    
    if($modificadoPor !== ''){
        $condiciones_consulta[] = "U.usu_username LIKE '%$modificadoPor%'"; 
    }

    if($categoria !== ''){
        $condiciones_consulta[] = "HC.histcat_nombre LIKE '%$categoria%'"; 
    }

    if($tipo !== ''){
        $condiciones_consulta[] = "T.tipos_nombre LIKE '%$tipo%'"; 
    }

    if($descripcion !== ''){
        $condiciones_consulta[] = "HC.histcat_descripcion LIKE '%$descripcion%'"; 
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
    $consulta .= " ORDER BY HC.histcat_fechahora DESC";

    //Si se eligió una cantidad de registros determinada, le agrega a la consulta el límite
    if($cantRegistros !== ''){
        $consulta .= " LIMIT $cantRegistros";
    }

    //echo $consulta;

    // Generar consulta
    $resultado = $conexion->query($consulta);

    // Inicializo el Array de Response y Artículos
    $response = [];
    $historial_categorias_datos = [];

    if($resultado->num_rows > 0){       // Si encontró artículos
        while($fila = $resultado->fetch_assoc()){
            $historial_categorias_datos[] = [
                'fecha' => $fila['histcat_fechahora'],
                'cataccion' => $fila['histcat_accion'],
                'modificadopor' => $fila['usu_username'],
                'categoria' => $fila['histcat_nombre'],
                'tipo' => $fila['tipos_nombre'],
                'descripcion' => $fila['histcat_descripcion'],
                'activo' => $fila['histcat_activo']
            ];
        }
        $response = [
            'status' => 'success',
            'message' => 'Datos agregados correctamente',
            'data' => $historial_categorias_datos
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