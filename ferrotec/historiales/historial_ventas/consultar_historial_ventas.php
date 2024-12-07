<?php
/*
    PHP:            consultar_historial_ventas.php
    Descripción:    Consulta a la base de datos para traer los registros del historial de ventas con los críterios elegidos
*/
    // Conexión a la base de datos MySQL
    require('../../conectar/conectar.php');

    // Iniciar sesión si no está iniciada
    session_start();

    // Obtener los datos enviados desde JavaScript
    $fechaDesde = $_POST['fecha-desde'];
    $fechaHasta = $_POST['fecha-hasta'];
    $tipoVenta = $_POST['tipo-venta'];
    $mododePago = $_POST['modo-pago'];
    $monto = $_POST['monto'];
    $montoNumero = $_POST['monto-numero'];
    $sucursal = $_POST['sucursal'];
    $modificadoPor = $_POST['modificado-por'];
    $cantRegistros = $_POST['cant-registros'];

    // Formateo de Fechas creando objetos
    $fechaDesdeFormato = new DateTime($fechaDesde);
    $fechaHastaFormato = new DateTime($fechaHasta);

    $fechaDesde = $fechaDesdeFormato->format('Y-m-d H:i:s');
    $fechaHasta = $fechaHastaFormato->format('Y-m-d H:i:s');

    // Consulta Inicial
    // En este historial se usa una consulta u otra según lo elegido en el campo "Tipo de Venta"
    if($tipoVenta == 'VR'){         // Ventas Realizadas
        $consulta = "SELECT DATE_FORMAT(HV.histventas_fechahora, '%d/%m/%Y %H:%i:%s') AS histventas_fechahora, 
                    HV.id,
                    U.usu_username,
                    HV.histventas_monto, 
                    S.sucs_nombre,
                    MP.modpa_nombre
                    FROM historial_ventas HV 
                    INNER JOIN modopago MP
                    ON HV.histventas_id_modopago = MP.id
                    INNER JOIN usuarios U
                    ON HV.histventas_id_usuario = U.id
                    INNER JOIN sucursales S
                    ON HV.histventas_suc = S.id
                    WHERE HV.histventas_fechahora >= '$fechaDesde' AND HV.histventas_fechahora <= '$fechaHasta'";
    }

    if($tipoVenta == 'VC'){         // Ventas Canceladas (Deshacer Ventas)
        $consulta = "SELECT DATE_FORMAT(HVE.histventas_fechahora, '%d/%m/%Y %H:%i:%s') AS histventas_fechahora,
                    HVE.histventas_id, 
                    U.usu_username, 
                    HVE.histventas_monto,  
                    S.sucs_nombre, 
                    MP.modpa_nombre 
                    FROM historial_ventas_eliminados HVE
                    INNER JOIN modopago MP
                    ON HVE.histventas_id_modopago = MP.id
                    INNER JOIN usuarios U
                    ON HVE.histventaselim_userid = U.id
                    INNER JOIN sucursales S
                    ON HVE.histventas_suc = S.id
                    WHERE HVE.histventas_fechahora >= '$fechaDesde' AND HVE.histventas_fechahora <= '$fechaHasta'";
    }

    // Lógica de la consulta según el contenido de las variables
    $condiciones_consulta = [];     // Inicializar el arreglo de las condiciones

    // Por cada variable controlar si no está vacía y agregar la condición al arreglo
    // En estas condiciones se debe preguntar según el tipo de consulta
    
    if($tipoVenta == 'VR'){         // Ventas Realizadas
        if($modificadoPor !== ''){
            $condiciones_consulta[] = "U.usu_username LIKE '%$modificadoPor%'"; 
        }
    
        if($mododePago !== 'S' && $mododePago !== ''){
            $condiciones_consulta[] = "MP.id = '$mododePago'"; 
        }
    
        if($monto !== ''){
            $condiciones_consulta[] = "HV.histventas_monto $monto '$montoNumero'";
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
        $consulta .= " ORDER BY HV.histventas_fechahora DESC";
    
        //Si se eligió una cantidad de registros determinada, le agrega a la consulta el límite
        if($cantRegistros !== ''){
            $consulta .= " LIMIT $cantRegistros";
        }
    
    }

    if($tipoVenta == 'VC'){         // Ventas Canceladas
        if($modificadoPor !== ''){
            $condiciones_consulta[] = "U.usu_username LIKE '%$modificadoPor%'"; 
        }
    
        if($mododePago !== 'S' && $mododePago !== ''){
            $condiciones_consulta[] = "MP.id = '$mododePago'"; 
        }
    
        if($monto !== ''){
            $condiciones_consulta[] = "HVE.histventas_monto $monto '$montoNumero'";
        }
    
        if($sucursal !== ''){
            $condiciones_consulta[] = "S.sucs_nombre = '$sucursal'"; 
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
        $consulta .= " ORDER BY HVE.histventas_fechahora DESC";
    
        //Si se eligió una cantidad de registros determinada, le agrega a la consulta el límite
        if($cantRegistros !== ''){
            $consulta .= " LIMIT $cantRegistros";
        }
    
    }

    // Generar consulta
    $resultado = $conexion->query($consulta);

    $idsventas = []; // Array para almacenar los IDs de las ventas encontradas

    // Guardado de ventas en arreglo para evitar que se pierda
    // Guardado de IDs de las ventas para usarlos en el Detalle
    $ventas = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $ventas[] = $fila;
        if($tipoVenta == 'VR'){
            $idsventas[] = $fila['id']; // Almacena los IDs en el array
        }
        if($tipoVenta == 'VC'){
            $idsventas[] = $fila['histventas_id']; // Almacena los IDs en el array
        }
    }

    // Se convierte el arreglo de IDs en una cadena separada por comas
    $idventascadena = implode(',',$idsventas);

    // Salida en JSON maestro
    // Inicializo el Array de Response y Ventas
    $responseventas = [];
    $responseventas_detalle = [];
    $historial_ventas_datos = [];
    $historial_ventas_datos_detalle = [];

    if($resultado->num_rows > 0){       // Si encontró ventas

        // Generación de JSON de ventas / ventas eliminadas
       foreach($ventas as $fila){
            if($tipoVenta == 'VR'){
                $historial_ventas_datos[] = [
                    'fecha' => $fila['histventas_fechahora'],
                    'ventanro' => $fila['id'],
                    'modificadopor' => $fila['usu_username'],
                    'montototal' => $fila['histventas_monto'],
                    'sucursal' => $fila['sucs_nombre'],
                    'mododepago' => $fila['modpa_nombre']
                ];
            }
            elseif($tipoVenta == 'VC'){
                $historial_ventas_datos[] = [
                    'fecha' => $fila['histventas_fechahora'],
                    'ventanro' => $fila['histventas_id'],
                    'modificadopor' => $fila['usu_username'],
                    'montototal' => $fila['histventas_monto'],
                    'sucursal' => $fila['sucs_nombre'],
                    'mododepago' => $fila['modpa_nombre']
                ];
            }
        }        
        $responseventas = [
            'status' => 'success',
            'message' => 'Datos agregados correctamente',
            'data' => $historial_ventas_datos
        ];

        // Armar consulta para detalle
        if($tipoVenta == 'VR'){         // Ventas Realizadas
            $consulta_detalle = "SELECT HVD.histvendet_id_venta,
                                A.art_nombre,
                                HVD.histvendet_cantidad,
                                HVD.histvendet_monto
                                FROM historial_ventas_detalle HVD
                                INNER JOIN articulos A
                                ON HVD.histvendet_id_art = A.id
                                WHERE HVD.histvendet_id_venta IN (" . $idventascadena . ") 
                                ORDER BY HVD.histvendet_id_venta DESC";
        }
        
        if($tipoVenta == 'VC'){         // Ventas Canceladas
            $consulta_detalle = "SELECT HVDE.histvendetelim_id_venta,
                                A.art_nombre,
                                HVDE.histvendetelim_cantidad,
                                HVDE.histvendetelim_monto
                                FROM historial_ventas_detalle_eliminados HVDE
                                INNER JOIN articulos A
                                ON HVDE.histvendetelim_id_art = A.id
                                WHERE HVDE.histvendetelim_id_venta IN (" . $idventascadena . ") 
                                ORDER BY HVDE.histvendetelim_id_venta DESC";
        }

        // Generar consulta para detalle
        $resultadodetalle = $conexion->query($consulta_detalle);

        while($filadetalle = $resultadodetalle->fetch_assoc()){
            if($tipoVenta == 'VR'){
                $historial_ventas_datos_detalle[] = [
                    'ventanro' => $filadetalle['histvendet_id_venta'],
                    'articulo' => $filadetalle['art_nombre'],
                    'cantidad' => $filadetalle['histvendet_cantidad'],
                    'montoporarticulo' => $filadetalle['histvendet_monto']
                ];
            } 
            elseif($tipoVenta == 'VC'){
                $historial_ventas_datos_detalle[] = [
                    'ventanro' => $filadetalle['histvendetelim_id_venta'],
                    'articulo' => $filadetalle['art_nombre'],
                    'cantidad' => $filadetalle['histvendetelim_cantidad'],
                    'montoporarticulo' => $filadetalle['histvendetelim_monto']
                ];
            }
        }        
        $responseventas_detalle = [
            'status' => 'success',
            'message' => 'Datos agregados correctamente',
            'data' => $historial_ventas_datos_detalle
        ];
    }
    else{                               // Si no encontró ventas
        $responseventas = [
            'status' => 'success',
            'message' => 'No hay datos con los criterios ingresados.',
            'data' => []
        ];
        $responseventas_detalle = [
            'status' => 'success',
            'message' => 'No hay datos con los criterios ingresados.',
            'data' => []
        ];        
    }

    // Envía los datos al JavaScript en formato JSON
    $response = [
        'ventas' => $responseventas,
        'ventasdetalle' => $responseventas_detalle
    ];

    header('Content-Type: application/json');
    echo json_encode($response);

    // Cerrar la Conexión PHP
    $conexion->close();
?>