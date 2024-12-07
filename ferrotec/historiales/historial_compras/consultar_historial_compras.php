<?php
/*
    PHP:            consultar_historial_compras.php
    Descripción:    Consulta a la base de datos para traer los registros del historial de compras con los críterios elegidos
*/
    // Conexión a la base de datos MySQL
    require('../../conectar/conectar.php');

    // Iniciar sesión si no está iniciada
    session_start();

    // Obtener los datos enviados desde JavaScript
    $fechaDesde = $_POST['fecha-desde'];
    $fechaHasta = $_POST['fecha-hasta'];
    $tipoCompra = $_POST['tipo-compra'];
    $mododePago = $_POST['modo-pago'];
    $monto = $_POST['monto'];
    $montoNumero = $_POST['monto-numero'];
    $sucursal = $_POST['sucursal'];
    $proveedor = $_POST['proveedor'];
    $modificadoPor = $_POST['modificado-por'];
    $cantRegistros = $_POST['cant-registros'];

    // Formateo de Fechas creando objetos
    $fechaDesdeFormato = new DateTime($fechaDesde);
    $fechaHastaFormato = new DateTime($fechaHasta);

    $fechaDesde = $fechaDesdeFormato->format('Y-m-d H:i:s');
    $fechaHasta = $fechaHastaFormato->format('Y-m-d H:i:s');

    // Consulta Inicial
    // En este historial se usa una consulta u otra según lo elegido en el campo "Tipo de Venta"
    if($tipoCompra == 'CR'){         // Compras Realizadas
        $consulta = "SELECT DATE_FORMAT(HC.histcompras_fechahora, '%d/%m/%Y %H:%i:%s') AS histcompras_fechahora, 
                    HC.id,
                    U.usu_username,
                    HC.histcompras_monto, 
                    S.sucs_nombre,
                    P.prov_nombre,
                    MP.modpa_nombre
                    FROM historial_compras HC 
                    INNER JOIN modopago MP
                    ON HC.histcompras_id_modopago = MP.id
                    INNER JOIN usuarios U
                    ON HC.histcompras_id_usuario = U.id
                    INNER JOIN sucursales S
                    ON HC.histcompras_suc = S.id
                    INNER JOIN proveedores P
                    ON HC.histcompras_id_prov = P.id
                    WHERE HC.histcompras_fechahora >= '$fechaDesde' AND HC.histcompras_fechahora <= '$fechaHasta'";
    }

    if($tipoCompra == 'CC'){         // Compras Canceladas (Deshacer Compras)
        $consulta = "SELECT DATE_FORMAT(HCE.histcompraselim_fechahora, '%d/%m/%Y %H:%i:%s') AS histcompras_fechahora,
                    HCE.histcompras_id, 
                    U.usu_username, 
                    HCE.histcompras_monto,  
                    S.sucs_nombre, 
                    P.prov_nombre,
                    MP.modpa_nombre 
                    FROM historial_compras_eliminados HCE
                    INNER JOIN modopago MP
                    ON HCE.histcompras_id_modopago = MP.id
                    INNER JOIN usuarios U
                    ON HCE.histcompraselim_userid = U.id
                    INNER JOIN sucursales S
                    ON HCE.histcompras_suc = S.id
                    INNER JOIN proveedores P
                    ON HCE.histcompras_id_prov = P.id
                    WHERE HCE.histcompraselim_fechahora >= '$fechaDesde' AND HCE.histcompraselim_fechahora <= '$fechaHasta'";
    }

    // Lógica de la consulta según el contenido de las variables
    $condiciones_consulta = [];     // Inicializar el arreglo de las condiciones

    // Por cada variable controlar si no está vacía y agregar la condición al arreglo
    // En estas condiciones se debe preguntar según el tipo de consulta
    
    if($tipoCompra == 'CR'){         // Ventas Realizadas
        if($modificadoPor !== ''){
            $condiciones_consulta[] = "U.usu_username LIKE '%$modificadoPor%'"; 
        }
    
        if($mododePago !== 'S' && $mododePago !== ''){
            $condiciones_consulta[] = "MP.id = '$mododePago'"; 
        }
    
        if($monto !== ''){
            $condiciones_consulta[] = "HC.histcompras_monto $monto '$montoNumero'";
        }
    
        if($proveedor !== ''){
            $condiciones_consulta[] = "P.prov_nombre LIKE '%$proveedor%'"; 
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
        $consulta .= " ORDER BY HC.histcompras_fechahora DESC";
    
        //Si se eligió una cantidad de registros determinada, le agrega a la consulta el límite
        if($cantRegistros !== ''){
            $consulta .= " LIMIT $cantRegistros";
        }
    
    }

    if($tipoCompra == 'CC'){         // Ventas Canceladas
        if($modificadoPor !== ''){
            $condiciones_consulta[] = "U.usu_username LIKE '%$modificadoPor%'"; 
        }
    
        if($mododePago !== 'S' && $mododePago !== ''){
            $condiciones_consulta[] = "MP.id = '$mododePago'"; 
        }
    
        if($monto !== ''){
            $condiciones_consulta[] = "HCE.histcompras_monto $monto '$montoNumero'";
        }
    
        if($proveedor !== ''){
            $condiciones_consulta[] = "P.prov_nombre LIKE '%$proveedor%'"; 
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
        $consulta .= " ORDER BY HCE.histcompraselim_fechahora DESC";
    
        //Si se eligió una cantidad de registros determinada, le agrega a la consulta el límite
        if($cantRegistros !== ''){
            $consulta .= " LIMIT $cantRegistros";
        }
    
    }

    // Generar consulta
    $resultado = $conexion->query($consulta);

    $idscompras = []; // Array para almacenar los IDs de las compras encontradas

    // Guardado de compras en arreglo para evitar que se pierda
    // Guardado de IDs de las compras para usarlos en el Detalle
    $compras = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $compras[] = $fila;
        if($tipoCompra == 'CR'){
            $idscompras[] = $fila['id']; // Almacena los IDs en el array
        }
        if($tipoCompra == 'CC'){
            $idscompras[] = $fila['histcompras_id']; // Almacena los IDs en el array
        }
    }

    // Se convierte el arreglo de IDs en una cadena separada por comas
    $idcomprascadena = implode(',',$idscompras);

    // Salida en JSON maestro
    // Inicializo el Array de Response y Compras
    $responsecompras = [];
    $responsecompras_detalle = [];
    $historial_compras_datos = [];
    $historial_compras_datos_detalle = [];

    if($resultado->num_rows > 0){       // Si encontró ventas

        // Generación de JSON de compras / compras eliminadas
       foreach($compras as $fila){
            if($tipoCompra == 'CR'){
                $historial_compras_datos[] = [
                    'fecha' => $fila['histcompras_fechahora'],
                    'compranro' => $fila['id'],
                    'modificadopor' => $fila['usu_username'],
                    'montototal' => $fila['histcompras_monto'],
                    'sucursal' => $fila['sucs_nombre'],
                    'proveedor' => $fila['prov_nombre'],
                    'mododepago' => $fila['modpa_nombre']
                ];
            }
            elseif($tipoCompra == 'CC'){
                $historial_compras_datos[] = [
                    'fecha' => $fila['histcompras_fechahora'],
                    'compranro' => $fila['histcompras_id'],
                    'modificadopor' => $fila['usu_username'],
                    'montototal' => $fila['histcompras_monto'],
                    'sucursal' => $fila['sucs_nombre'],
                    'proveedor' => $fila['prov_nombre'],
                    'mododepago' => $fila['modpa_nombre']
                ];
            }
        }        
        $responsecompras = [
            'status' => 'success',
            'message' => 'Datos agregados correctamente',
            'data' => $historial_compras_datos
        ];

        // Armar consulta para detalle
        if($tipoCompra == 'CR'){         // Compras Realizadas
            $consulta_detalle = "SELECT HCD.histcomdet_id_compra,
                                A.art_nombre,
                                HCD.histcomdet_cantidad,
                                HCD.histcomdet_monto
                                FROM historial_compras_detalle HCD
                                INNER JOIN articulos A
                                ON HCD.histcomdet_id_art = A.id
                                WHERE HCD.histcomdet_id_compra IN (" . $idcomprascadena . ") 
                                ORDER BY HCD.histcomdet_id_compra DESC";
        }
        
        if($tipoCompra == 'CC'){         // Compras Canceladas
            $consulta_detalle = "SELECT HCDE.histcomdetelim_id_compra,
                                A.art_nombre,
                                HCDE.histcomdetelim_cantidad,
                                HCDE.histcomdetelim_monto
                                FROM historial_compras_detalle_eliminados HCDE
                                INNER JOIN articulos A
                                ON HCDE.histcomdetelim_id_art = A.id
                                WHERE HCDE.histcomdetelim_id_compra IN (" . $idcomprascadena . ") 
                                ORDER BY HCDE.histcomdetelim_id_compra DESC";
        }

        // Generar consulta para detalle
        $resultadodetalle = $conexion->query($consulta_detalle);

        while($filadetalle = $resultadodetalle->fetch_assoc()){
            if($tipoCompra == 'CR'){
                $historial_compras_datos_detalle[] = [
                    'compranro' => $filadetalle['histcomdet_id_compra'],
                    'articulo' => $filadetalle['art_nombre'],
                    'cantidad' => $filadetalle['histcomdet_cantidad'],
                    'montoporarticulo' => $filadetalle['histcomdet_monto']
                ];
            } 
            elseif($tipoCompra == 'CC'){
                $historial_compras_datos_detalle[] = [
                    'compranro' => $filadetalle['histcomdetelim_id_compra'],
                    'articulo' => $filadetalle['art_nombre'],
                    'cantidad' => $filadetalle['histcomdetelim_cantidad'],
                    'montoporarticulo' => $filadetalle['histcomdetelim_monto']
                ];
            }
        }        
        $responsecompras_detalle = [
            'status' => 'success',
            'message' => 'Datos agregados correctamente',
            'data' => $historial_compras_datos_detalle
        ];
    }
    else{                               // Si no encontró compras
        $responsecompras = [
            'status' => 'success',
            'message' => 'No hay datos con los criterios ingresados.',
            'data' => []
        ];
        $responsecompras_detalle = [
            'status' => 'success',
            'message' => 'No hay datos con los criterios ingresados.',
            'data' => []
        ];        
    }

    // Envía los datos al JavaScript en formato JSON
    $response = [
        'compras' => $responsecompras,
        'comprasdetalle' => $responsecompras_detalle
    ];

    header('Content-Type: application/json');
    echo json_encode($response);

    // Cerrar la Conexión PHP
    $conexion->close();
?>