<?php
/*
    PHP:            generar_reporte_compras.php
    Descripción:    Consulta todas las compras bajo los criterios elegidos y hace un consolidado de los datos
*/

// Conexión a la base de datos
require('../conectar/conectar.php');
// Iniciar sesión si no está iniciada
session_start();
$usuarioLogueado = $_SESSION['id'];


$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];
$usuario = $_POST['usuario'];
$filtroOpcion = $_POST['filtroOpcion'];
$filtroTexto = $_POST['filtroTexto'];
$filtroOpcionPago = $_POST['filtroOpcionPago'];
$nombres_lista_art = [];
$nombres_lista_cat = [];
$nombres_lista_tipos = [];

// Calcular el número de días seleccionados
$datetime1 = new DateTime($fecha_inicio);
$datetime2 = new DateTime($fecha_fin);
$datetime2->modify('+1 day'); // Añadir un día al final, porque al tener formato fecha+horas, las horas hacen que no incluya el último día seleccionado
$fecha_fin = $datetime2->format('Y-m-d H:i:s'); 
$interval = $datetime1->diff($datetime2);
$dias_seleccionados = $interval->days; // Agregar +1 si es necesario incluir el primer día


// Crear consulta SQL

$consulta_id_compras_fecha = "SELECT id 
                              FROM historial_compras 
                              WHERE histcompras_fechahora >= '$fecha_inicio' 
                              AND histcompras_fechahora <= '$fecha_fin'";

$resultado_id_compras_fecha = $conexion->query($consulta_id_compras_fecha);
$id_compras_fecha = [];

if ($resultado_id_compras_fecha->num_rows > 0) {

    while($row = $resultado_id_compras_fecha->fetch_assoc()) {
        $id_compras_fecha[] =$row['id'];
    }

}else{
    $response = [
        'status' => 'error',
        'message' => 'No se realizo ninguna compra durante el periodo seleccionado',
		'data' => []			
    ];
	header('Content-Type: application/json');										 
    echo json_encode($response);
    exit; // Detiene la ejecución del script PHP
}

if (!empty($id_compras_fecha)) {
    // Convertir el array de IDs a una lista separada por comas
    $ids_lista_compras_fecha = implode(",", $id_compras_fecha);

    //echo "IDs Lista de fechas: $ids_lista_compras_fecha<br>";


    $consulta_sum_cant_art = "SELECT SUM(histcomdet_cantidad) as suma_cant_art 
                              FROM historial_compras_detalle 
                              WHERE histcomdet_id_compra IN ($ids_lista_compras_fecha)";

    $consulta_sum = "SELECT SUM(histcomdet_monto) as suma 
                     FROM historial_compras_detalle 
                     WHERE histcomdet_id_compra IN ($ids_lista_compras_fecha)";

    $consulta_sum_cant_compras = "SELECT COUNT(id) as suma_cant_compras 
                                  FROM historial_compras 
                                  WHERE id IN ($ids_lista_compras_fecha)";

    if (!empty($usuario)) {
        //Si se ingresó el dato de usuario, se busca en la tabla usuarios el id del usuario
        $consulta_id_usu = "SELECT id FROM usuarios WHERE usu_username = '$usuario' LIMIT 1";
        $resultado_id_usu = $conexion->query($consulta_id_usu);
        if ($resultado_id_usu->num_rows > 0) {
            $row_id_usu = $resultado_id_usu->fetch_assoc();
            $id_usu = $row_id_usu['id'];
            //echo "ID de usuario: $id_usu<br>";
            //Con  el ID del usuario, se buscan los IDs de las compras realizadas
            $consulta_compras_usu = "SELECT id 
                                     FROM historial_compras 
                                     WHERE histcompras_id_usuario  = $id_usu";
                                     
            $resultado_compras_usu = $conexion->query($consulta_compras_usu);
            $id_compras_usu=[];

            if ($resultado_compras_usu->num_rows > 0) {
                while($row = $resultado_compras_usu->fetch_assoc()) {
                    $id_compras_usu[] =$row['id'];
                }
            }else {
                $response = [
                    'status' => 'error',
                    'message' => 'El usuario todavía no realizó ninguna compra'
                ];
				header('Content-Type: application/json');										 
                echo json_encode($response);
                exit; // Detiene la ejecución del script PHP
            }
        
            if (!empty($id_compras_usu)) {
                
                $ids_compras_usu_lista = implode(",", $id_compras_usu);// Convertir el array de IDs de compras a una lista separada por comas
                //echo "ID de las compras realizadas por el usuario: $ids_compras_usu_lista<br>";
                // Buscamos los IDs de la tabla compras_detalle de las compras que se realizaron con el ID de la compra
                $consulta_comdet_usu = "SELECT id FROM historial_compras_detalle WHERE histcomdet_id_compra IN ($ids_compras_usu_lista)";
                $resultado_comdet_usu = $conexion->query($consulta_comdet_usu);
                $id_compras_detalle_usu = [];
                if ($resultado_comdet_usu->num_rows > 0) {
                    while ($row = $resultado_comdet_usu->fetch_assoc()) {
                        $id_compras_detalle_usu[] = $row['id'];
                    }
                }else {
                    $response = [
                        'status' => 'error',
                        'message' => 'No hay ninguna entrada de detalle de compras asociado a una compra realizada por el usuario en el período seleccionado'
                    ];
					header('Content-Type: application/json');										 
                    echo json_encode($response);
                    exit; // Detiene la ejecución del script PHP
                }
            
                if (!empty($id_compras_detalle_usu)) {
                    
                    $ids_compras_usu_lista = implode(",", $id_compras_detalle_usu);// Convertir el array de IDs de compras a una lista separada por comas

                    //echo "Lista de IDs de detalle_compra segun el filtro de usuarios:: $ids_compras_usu_lista<br>";
                    // Añadir la condición de los IDs de compras al query
                    $consulta_sum_cant_art .= " AND id IN ($ids_compras_usu_lista)";
                    $consulta_sum .= " AND id IN ($ids_compras_usu_lista)";

                    // Selecciono los ID de las compras de la tabla compras_detalle para posteriormente buscarlos en la tabla compras

                    $consulta_com_id = "SELECT histcomdet_id_compra FROM historial_compras_detalle WHERE id IN ($ids_compras_usu_lista)";
                    $resultado_com_id = $conexion->query($consulta_com_id);
                    $id_compras = [];
                    if ($resultado_com_id->num_rows > 0) {
                        while ($row = $resultado_com_id->fetch_assoc()) {
                            $id_compras[] = $row['histcomdet_id_compra'];
                        }
                    }else {
                        $response = [
                            'status' => 'error',
                            'message' => 'El usuario no realizó ninguna compra en el período seleccionado'
                        ];
						header('Content-Type: application/json');										 
                        echo json_encode($response);
                        exit; // Detiene la ejecución del script PHP
                    }
                
                    if (!empty($id_compras)) {
                        
                        $ids_compras_lista = implode(",", $id_compras);// Convertir el array de IDs de compras a una lista separada por comas
    
                        //echo "Lista de IDs de las compras de detalle_compra segun el filtro de usuarios: $ids_compras_lista<br>";
                        // Añadir la condición de los IDs de compras al query
    
                        $consulta_sum_cant_compras .= " AND id IN ($ids_compras_lista)";
                    }
                }
            }
        }else {
            $response = [
                'status' => 'error',
                'message' => 'El usuario no se encuentra en la base de datos',
				'data' => []			
            ];
			header('Content-Type: application/json');										 
            echo json_encode($response);
            exit; // Detiene la ejecución del script PHP
        }
    }



    if ($filtroOpcionPago > 0) {
        $consulta_com_pago = "SELECT id FROM historial_compras WHERE histcompras_id_modopago = $filtroOpcionPago";
        $resultado_com_pago = $conexion->query($consulta_com_pago);
        $id_compras_pago = [];
        if ($resultado_com_pago->num_rows > 0) {
            while ($row = $resultado_com_pago->fetch_assoc()) {
                $id_compras_pago[] = $row['id'];
            }
        }else {
            $response = [
                'status' => 'error',
                'message' => 'No se realizó ninguna compra con el método seleccionado de pago',
				'data' => []			
            ];
			header('Content-Type: application/json');										 
            echo json_encode($response);
            exit; // Detiene la ejecución del script PHP
        }
    
        if (!empty($id_compras_pago)) {
            
            $ids_compras_pago_lista = implode(",", $id_compras_pago);// Convertir el array de IDs de compras a una lista separada por comas

            //echo "Lista de IDs de compras segun el filtro de pago seleccionado: $ids_compras_pago_lista<br>";
            // Añadir la condición de los IDs de compras al query
            $consulta_sum_cant_compras .= " AND id IN ($ids_compras_pago_lista)";

            $consulta_comdet_pago = "SELECT id FROM historial_compras_detalle WHERE histcomdet_id_compra IN ($ids_compras_pago_lista)";
            $resultado_comdet_pago = $conexion->query($consulta_comdet_pago);
            $id_compras_detalle_pago = [];
            if ($resultado_comdet_pago->num_rows > 0) {
                while ($row = $resultado_comdet_pago->fetch_assoc()) {
                    $id_compras_detalle_pago[] = $row['id'];
                }
            }else {
                $response = [
                    'status' => 'error',
                    'message' => '-ERROR-No hay ninguna entrada en la tabla compra detalle relacionada a una compra realzada con el método seleccionado de pago'
                ];
				 header('Content-Type: application/json');										 
                echo json_encode($response);
                exit; // Detiene la ejecución del script PHP
            }
    
            if (!empty($id_compras_detalle_pago)) {
                
                $ids_compras_detalle_pago_lista = implode(",", $id_compras_detalle_pago);// Convertir el array de IDs de compras a una lista separada por comas

                //echo "Lista de IDs de detalle_compra segun el filtro de articulos: $ids_compras_detalle_pago_lista<br>";
                // Añadir la condición de los IDs de compras al query
                $consulta_sum_cant_art .= " AND id IN ($ids_compras_detalle_pago_lista)";
                $consulta_sum .= " AND id IN ($ids_compras_detalle_pago_lista)";
            }
        }
    }


    if ($filtroOpcion == 'tipo' && !empty($filtroTexto)) {
        //Si se ingresó el dato de tipo, se busca en la tabla tipos el id y el nombre del mismo
        $consulta_id_tipo = "SELECT id, tipos_nombre FROM tipos WHERE tipos_nombre LIKE '%$filtroTexto%'";  
        $resultado_id_tipo = $conexion->query($consulta_id_tipo);
        $id_tipos = [];
        $nombre_tipos = [];
        if ($resultado_id_tipo->num_rows > 0) {
            while($row = $resultado_id_tipo->fetch_assoc()) {
                $id_tipos[] =$row['id'];
                $nombre_tipos[] =$row['tipos_nombre'];
            }
        }else {
            $response = [
                'status' => 'error',
                'message' => 'El Tipo filtrado es inexistente',
				'data' => []			
            ];
			header('Content-Type: application/json');										 
            echo json_encode($response);
            exit; // Detiene la ejecución del script PHP
        }  

        if (!empty($id_tipos)) {
            // Con el ID de los tipos vamos a realizar una lista.
            
            $ids_lista_tipos = implode(",", $id_tipos); // Convertir el array de IDs a una lista separada por comas, mismo caso para el nombre
            $nombres_lista_tipos = implode(",", $nombre_tipos);
            //echo "IDs de articulos dentro de la lista de fecha: $ids_lista_tipos<br> que son los articulos $nombres_lista_tipos";
            // Buscamos los IDs de la tabla categorias de los tipos de articulos con el ID de la lista de categorias

            $consulta_id_cat = "SELECT id, cat_nombre FROM categorias WHERE cat_id_tipo IN ($ids_lista_tipos)";  
            $resultado_id_cat = $conexion->query($consulta_id_cat);
            $id_categorias = [];
            $nombre_categorias = [];
            if ($resultado_id_cat->num_rows > 0) {

                while($row = $resultado_id_cat->fetch_assoc()) {
                    $id_categorias[] =$row['id'];
                    $nombre_categorias[] =$row['cat_nombre'];
                }

            }else{
                $response = [
                    'status' => 'error',
                    'message' => 'El/Los Tipo/s seleccionado/s : "'. $nombres_lista_tipos. '" no tienen articulos que se hayan incluido en alguna compra durante el periodo seleccionado'
                ];
				 header('Content-Type: application/json');
                echo json_encode($response);
                exit; // Detiene la ejecución del script PHP
            } 
            // Saltar al siguiente bloque if
            goto check_categoria;
        }
    }    


    if ($filtroOpcion == 'categoria' && !empty($filtroTexto)) {
        //Si se ingresó el dato de categoria, se busca en la tabla categoria el id y el nombre de la misma 
        $consulta_id_cat = "SELECT id, cat_nombre FROM categorias WHERE cat_nombre LIKE '%$filtroTexto%'";  
        $resultado_id_cat = $conexion->query($consulta_id_cat);
        $id_categorias = [];
        $nombre_categorias = [];
        if ($resultado_id_cat->num_rows > 0) {

            while($row = $resultado_id_cat->fetch_assoc()) {
                $id_categorias[] =$row['id'];
                $nombre_categorias[] =$row['cat_nombre'];
            }

        }else {
            $response = [
                'status' => 'error',
                'message' => 'La Categoria filtrada es inexistente',
				'data' => []			
            ];
			 header('Content-Type: application/json');										 
            echo json_encode($response);
            exit; // Detiene la ejecución del script PHP
        }  
  
        check_categoria:
        if (!empty($id_categorias)) {
            // Con el ID de las categorias vamos a realizar una lista.
            
            $ids_lista_cat = implode(",", $id_categorias); // Convertir el array de IDs a una lista separada por comas, mismo caso para el nombre
            $nombres_lista_cat = implode(",", $nombre_categorias);
            //echo "IDs de articulos dentro de la lista de fecha: $ids_lista<br> que son los articulos $nombres_lista";
            // Buscamos los IDs de la tabla compras_detalle de las compras que se realizaron con el ID de la lista de artículos

            $consulta_id_art = "SELECT id, art_nombre FROM articulos WHERE art_id_categoria IN ($ids_lista_cat)";  
            $resultado_id_art = $conexion->query($consulta_id_art);
            $id_articulos = [];
            $nombre_articulos = [];
            if ($resultado_id_art->num_rows > 0) {

                while($row = $resultado_id_art->fetch_assoc()) {
                    $id_articulos[] =$row['id'];
                    $nombre_articulos[] =$row['art_nombre'];
                }

            }else{
                $response = [
                    'status' => 'error',
                    'message' => 'La/s Categoria/s seleccionada/s : "'. $nombres_lista_cat. '" no tienen articulos que se hayan incluido en alguna compra durante el periodo seleccionado'
                ];
				header('Content-Type: application/json');										 
                echo json_encode($response);
                exit; // Detiene la ejecución del script PHP
            }  
            // Saltar al siguiente bloque if
            goto check_articulo;
        }
    }

    if ($filtroOpcion == 'articulo' && !empty($filtroTexto)) {
        //Si se ingresó el dato de articulo, se busca en la tabla articulos el id del articulo y el nombre completo
        $consulta_id_art = "SELECT id, art_nombre FROM articulos WHERE art_nombre LIKE '%$filtroTexto%'";  
        $resultado_id_art = $conexion->query($consulta_id_art);
        $id_articulos = [];
        $nombre_articulos = [];
        if ($resultado_id_art->num_rows > 0) {

            while($row = $resultado_id_art->fetch_assoc()) {
                $id_articulos[] =$row['id'];
                $nombre_articulos[] =$row['art_nombre'];
            }

        } else {
            $response = [
                'status' => 'error',
                'message' => 'El Articulo filtrado es inexistente',
				'data' => []			
            ];
			header('Content-Type: application/json');
            echo json_encode($response);
            exit; // Detiene la ejecución del script PHP
        }  

        check_articulo:
        if (!empty($id_articulos)) {
            // Con el ID del artículo vamos a realizar una lista.
            
            $ids_lista_art = implode(",", $id_articulos); // Convertir el array de IDs a una lista separada por comas, mismo caso para el nombre
            $nombres_lista_art = implode(",", $nombre_articulos);
            //echo "IDs de articulos dentro de la lista de fecha que son los articulos $nombres_lista_art";
            // Buscamos los IDs de la tabla compras_detalle de las compras que se realizaron con el ID de la lista de artículos
            $consulta_comdet = "SELECT id FROM historial_compras_detalle WHERE histcomdet_id_art IN ($ids_lista_art)";
            $resultado_comdet = $conexion->query($consulta_comdet);
            $id_compras_detalle = [];
            if ($resultado_comdet->num_rows > 0) {
                while ($row = $resultado_comdet->fetch_assoc()) {
                    $id_compras_detalle[] = $row['id'];
                }
            }else {
                $response = [
                    'status' => 'error',
                    'message' => 'El/los articulos "'. $nombres_lista_art. '" no se incluyeron en ninguna compra'
                ];
				header('Content-Type: application/json');										 
                echo json_encode($response);
                exit; // Detiene la ejecución del script PHP
            }
        
            if (!empty($id_compras_detalle)) {
                
                $ids_compras_detalle_lista = implode(",", $id_compras_detalle);// Convertir el array de IDs de compras a una lista separada por comas

                //echo "Lista de IDs de detalle_compra segun el filtro de articulos: $ids_compras_detalle_lista<br>";
                // Añadir la condición de los IDs de compras al query
                $consulta_sum_cant_art .= " AND id IN ($ids_compras_detalle_lista)";
                $consulta_sum .= " AND id IN ($ids_compras_detalle_lista)";

                // Selecciono los ID de las compras de la tabla compras_detalle para posteriormente buscarlos en la tabla compras

                $consulta_com_id = "SELECT histcomdet_id_compra FROM historial_compras_detalle WHERE id IN ($ids_compras_detalle_lista)";
                $resultado_com_id = $conexion->query($consulta_com_id);
                $id_compras = [];
                if ($resultado_com_id->num_rows > 0) {
                    while ($row = $resultado_com_id->fetch_assoc()) {
                        $id_compras[] = $row['histcomdet_id_compra'];
                    }
                }else {
                    $response = [
                        'status' => 'error',
                        'message' => 'El/los articulos "'. $nombres_lista_art. '" no se incluyeron en ninguna compra realizada durante el periodo seleccionado'
                    ];
					header('Content-Type: application/json');										 
                    echo json_encode($response);
                    exit; // Detiene la ejecución del script PHP
                }
            
                if (!empty($id_compras)) {
                    
                    $ids_compras_lista = implode(",", $id_compras);// Convertir el array de IDs de compras a una lista separada por comas

                    //echo "Lista de IDs de las compras de detalle_compra segun el filtro de articulos: $ids_compras_lista<br>";
                    // Añadir la condición de los IDs de compras al query

                    $consulta_sum_cant_compras .= " AND id IN ($ids_compras_lista)";
                }

            }
        }
    }



    $resultado_sum_cant_art = $conexion->query($consulta_sum_cant_art);
    $resultado_sum = $conexion->query($consulta_sum);
    $resultado_sum_cant_compras = $conexion->query($consulta_sum_cant_compras);

}

$response = [
    'dias_seleccionados' => $dias_seleccionados,
    'suma_cant_art' => 0,
    'suma_cant_art_prom' => 0,
    'suma' => 0,
    'suma_prom' => 0,
    'suma_cant_compras' => 0,
    'suma_cant_compras_prom' => 0,
    'articulos' => $nombres_lista_art,
    'categorias' => $nombres_lista_cat,
    'tipos' => $nombres_lista_tipos
];

if ($resultado_sum_cant_art && $resultado_sum && $resultado_sum_cant_compras) {

    if ($resultado_sum_cant_art->num_rows > 0) {
        $row_sum_cant_art = $resultado_sum_cant_art->fetch_assoc();
        $response['suma_cant_art'] = $row_sum_cant_art['suma_cant_art'];
        $response['suma_cant_art_prom'] = round($response['suma_cant_art']/$response['dias_seleccionados'],2);
    }

    if ($resultado_sum->num_rows > 0) {
        $row_sum = $resultado_sum->fetch_assoc();
        $response['suma'] = $row_sum['suma'];
        $response['suma_prom'] = round($response['suma']/$response['dias_seleccionados'],2);
    }

    if ($resultado_sum_cant_compras->num_rows > 0) {
        $row_sum_cant_compras = $resultado_sum_cant_compras->fetch_assoc();
        $response['suma_cant_compras'] = $row_sum_cant_compras['suma_cant_compras'];
        $response['suma_cant_compras_prom'] = round($response['suma_cant_compras']/$response['dias_seleccionados'],2);
    }
}
header('Content-Type: application/json');
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);						 
echo json_encode($response);
?>