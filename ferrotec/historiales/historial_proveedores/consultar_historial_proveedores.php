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
    $provAccion = $_POST['prov-accion'];
    $modificadoPor = $_POST['modificado-por'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $direccion = $_POST['direccion'];
    $localidad = $_POST['localidad'];
    $telefono1 = $_POST['telefono1'];
    $telefono2 = $_POST['telefono2'];
    $email = $_POST['email'];
    $cuit = $_POST['cuit'];
    $cantRegistros = $_POST['cant-registros'];

    // Formateo de Fechas creando objetos
    $fechaDesdeFormato = new DateTime($fechaDesde);
    $fechaHastaFormato = new DateTime($fechaHasta);

    $fechaDesde = $fechaDesdeFormato->format('Y-m-d H:i:s');
    $fechaHasta = $fechaHastaFormato->format('Y-m-d H:i:s');

    // Consulta Inicial
    $consulta = "SELECT DATE_FORMAT(HP.histprov_fechahora, '%d/%m/%Y %H:%i:%s') AS histprov_fechahora, 
                CASE HP.histprov_accion
                    WHEN 'alta_prov'    THEN 'Alta'
                    WHEN 'baja_prov'    THEN 'Baja'
                    WHEN 'modif_prov'   THEN 'Modificación'
                END AS histprov_accion, 
                U.usu_username, 
                HP.histprov_nombre, HP.histprov_descripcion, HP.histprov_direccion,
                HP.histprov_localidad, HP.histprov_provincia, HP.histprov_tel1, HP.histprov_tel2,
                HP.histprov_email, HP.histprov_cuit, 
                CASE HP.histprov_activo 
                    WHEN 1      THEN 'Si'
                    WHEN 0      THEN 'No'
                END AS histprov_activo
                FROM historial_proveedores HP
                INNER JOIN usuarios U
                ON HP.histprov_id_usu = U.id
                INNER JOIN proveedores P
                ON HP.histprov_id_prov = P.id
                WHERE HP.histprov_fechahora >= '$fechaDesde' AND HP.histprov_fechahora <= '$fechaHasta'";

    // Lógica de la consulta según el contenido de las variables
    $condiciones_consulta = [];     // Inicializar el arreglo de las condiciones

    // Por cada variable controlar si no está vacía y agregar la condición al arreglo
    if($provAccion !== ''){
        $condiciones_consulta[] = "HP.histprov_accion = '$provAccion'";
    }
    
    if($modificadoPor !== ''){
        $condiciones_consulta[] = "U.usu_username LIKE '%$modificadoPor%'"; 
    }

    if($nombre !== ''){
        $condiciones_consulta[] = "HP.histprov_nombre LIKE '%$nombre%'"; 
    }

    if($descripcion !== ''){
        $condiciones_consulta[] = "HP.histprov_descripcion LIKE '%$descripcion%'"; 
    }

    if($direccion !== ''){
        $condiciones_consulta[] = "HP.histprov_direccion LIKE '%$direccion%'"; 
    }

    if($localidad !== ''){
        $condiciones_consulta[] = "HP.histprov_localidad = '$localidad'"; 
    }

    if($telefono1 !== ''){
        $condiciones_consulta[] = "HP.histprov_tel1 = '$telefono1'"; 
    }

    if($telefono2 !== ''){
        $condiciones_consulta[] = "HP.histprov_tel2 = '$telefono2'"; 
    }

    if($email !== ''){
        $condiciones_consulta[] = "HP.histprov_email = '$email'"; 
    }

    if($cuit !== ''){
        $condiciones_consulta[] = "HP.histprov_cuit = '$cuit'"; 
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
    $consulta .= " ORDER BY HP.histprov_fechahora DESC";

    //Si se eligió una cantidad de registros determinada, le agrega a la consulta el límite
    if($cantRegistros !== ''){
        $consulta .= " LIMIT $cantRegistros";
    }

    //echo $consulta;

    // Generar consulta
    $resultado = $conexion->query($consulta);

    // Inicializo el Array de Response y Artículos
    $response = [];
    $historial_proveedores_datos = [];

    if($resultado->num_rows > 0){       // Si encontró artículos
        while($fila = $resultado->fetch_assoc()){
            $historial_proveedores_datos[] = [
                'fecha' => $fila['histprov_fechahora'],
                'provaccion' => $fila['histprov_accion'],
                'modificadopor' => $fila['usu_username'],
                'proveedor' => $fila['histprov_nombre'],
                'descripcion' => $fila['histprov_descripcion'],
                'direccion' => $fila['histprov_direccion'],
                'localidad' => $fila['histprov_localidad'],
                'telefono1' => $fila['histprov_tel1'],
                'telefono2' => $fila['histprov_tel2'],
                'email' => $fila['histprov_email'],
                'cuit' => $fila['histprov_cuit'],
                'activo' => $fila['histprov_activo']
            ];
        }
        $response = [
            'status' => 'success',
            'message' => 'Datos agregados correctamente',
            'data' => $historial_proveedores_datos
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