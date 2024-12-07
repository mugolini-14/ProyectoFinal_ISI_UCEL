<?php
/*
    PHP:            modificar_precios.php
    Descripción:    Consulta todos los artículos que se encuentren en un tipo y/o categoría determinados
                    Modifica los precios de los artículos según un porcentaje indicado
*/

// Conexión a la base de datos
require('../conectar/conectar.php');

// Iniciar sesión si no está iniciada
session_start();
$usuarioLogueado = $_SESSION['id'];

$seleccionOpcion = $_POST['seleccionOpcion'];
$seleccionNombre = $_POST['seleccionNombre'];
$porcentualModificacion = $_POST['porcentualModificacion'];
$variacionPrecio = 1.00 + ($porcentualModificacion / 100);

$nombres_lista_art = [];
$nombres_lista_cat = [];
$nombres_lista_tipos = [];

// Verificar si es una solicitud de confirmación preliminar
if (isset($_POST['preConfirm']) && $_POST['preConfirm'] == 'true') {
    if ($seleccionOpcion == 'tipo' && !empty($seleccionNombre)) {
        $consulta_id_tipo = "SELECT id, tipos_nombre FROM tipos WHERE tipos_nombre LIKE '%$seleccionNombre%' LIMIT 1";
        $resultado_id_tipo = $conexion->query($consulta_id_tipo);
        $id_tipos = [];
        $nombre_tipos = [];
        if ($resultado_id_tipo->num_rows > 0) {
            while ($row = $resultado_id_tipo->fetch_assoc()) {
                $id_tipos[] = $row['id'];
                $nombre_tipos[] = $row['tipos_nombre'];
            }
        } 
        else {
            $response = [
                'status' => 'error',
                'message' => 'El tipo ingresado no existe.'
            ];
            echo json_encode($response);
            exit;
        }

        if (!empty($id_tipos)) {
            $ids_lista_tipos = implode(",", $id_tipos);
            $nombres_lista_tipos = implode(",", $nombre_tipos);
            $consulta_id_cat = "SELECT id, cat_nombre FROM categorias WHERE cat_id_tipo IN ($ids_lista_tipos)";
            $resultado_id_cat = $conexion->query($consulta_id_cat);
            $id_categorias = [];
            $nombre_categorias = [];
            if ($resultado_id_cat->num_rows > 0) {
                while ($row = $resultado_id_cat->fetch_assoc()) {
                    $id_categorias[] = $row['id'];
                    $nombre_categorias[] = $row['cat_nombre'];
                }
            } 
            else {
                $response = [
                    'status' => 'error',
                    'message' => 'El tipo ingresado no tiene categorías asociadas.'
                ];
                echo json_encode($response);
                exit;
            }
        }
    }

    if ($seleccionOpcion == 'categoria' && !empty($seleccionNombre)) {
        $consulta_id_cat = "SELECT id, cat_nombre FROM categorias WHERE cat_nombre LIKE '%$seleccionNombre%' LIMIT 1";
        $resultado_id_cat = $conexion->query($consulta_id_cat);
        $id_categorias = [];
        $nombre_categorias = [];
        if ($resultado_id_cat->num_rows > 0) {
            while ($row = $resultado_id_cat->fetch_assoc()) {
                $id_categorias[] = $row['id'];
                $nombre_categorias[] = $row['cat_nombre'];
            }
        }
        else {
            $response = [
                'status' => 'error',
                'message' => 'La categoria ingresada no existe.'
            ];
            echo json_encode($response);
            exit;
        }
    }

    if (!empty($id_categorias)) {
        $ids_lista_cat = implode(",", $id_categorias);
        $nombres_lista_cat = implode(",", $nombre_categorias);
        $consulta_id_art = "SELECT id, art_nombre FROM articulos WHERE art_id_categoria IN ($ids_lista_cat)";
        $resultado_id_art = $conexion->query($consulta_id_art);
        $id_articulos = [];
        $nombre_articulos = [];
        if ($resultado_id_art->num_rows > 0) {
            while ($row = $resultado_id_art->fetch_assoc()) {
                $id_articulos[] = $row['id'];
                $nombre_articulos[] = $row['art_nombre'];
            }
        } 
        else {
            $response = [
                'status' => 'error',
                'message' => 'La categoría ingresada no tiene artículos asociados.'
            ];
            echo json_encode($response);
            exit;
        }
    }

    if ($seleccionOpcion == 'articulo' && !empty($seleccionNombre)) {
        $consulta_id_art = "SELECT id, art_nombre FROM articulos WHERE art_nombre LIKE '%$seleccionNombre%'";
        $resultado_id_art = $conexion->query($consulta_id_art);
        $id_articulos = [];
        $nombre_articulos = [];
        if ($resultado_id_art->num_rows > 0) {
            while ($row = $resultado_id_art->fetch_assoc()) {
                $id_articulos[] = $row['id'];
                $nombre_articulos[] = $row['art_nombre'];
            }
        } 
        else {
            $response = [
                'status' => 'error',
                'message' => 'El artículo ingresado no existe.'
            ];
            echo json_encode($response);
            exit;
        }
    }

    if (!empty($id_articulos)) {
        $nombres_lista_art = implode(",", $nombre_articulos);
        $response = [
            'articulos' => $nombres_lista_art,
            'categorias' => $nombres_lista_cat,
            'tipos' => $nombres_lista_tipos
        ];
        echo json_encode($response);
        exit;
    }
}

if ($seleccionOpcion == 'tipo' && !empty($seleccionNombre)) {
    $consulta_id_tipo = "SELECT id, tipos_nombre FROM tipos WHERE tipos_nombre LIKE '%$seleccionNombre%' LIMIT 1";
    $resultado_id_tipo = $conexion->query($consulta_id_tipo);
    $id_tipos = [];
    $nombre_tipos = [];
    if ($resultado_id_tipo->num_rows > 0) {
        while ($row = $resultado_id_tipo->fetch_assoc()) {
            $id_tipos[] = $row['id'];
            $nombre_tipos[] = $row['tipos_nombre'];
        }
    } 
    else {
        $response = [
            'status' => 'error',
            'message' => 'El tipo ingresado no existe.'
        ];
        echo json_encode($response);
        exit;
    }

    if (!empty($id_tipos)) {
        $ids_lista_tipos = implode(",", $id_tipos);
        $nombres_lista_tipos = implode(",", $nombre_tipos);
        $consulta_id_cat = "SELECT id, cat_nombre FROM categorias WHERE cat_id_tipo IN ($ids_lista_tipos)";
        $resultado_id_cat = $conexion->query($consulta_id_cat);
        $id_categorias = [];
        $nombre_categorias = [];
        if ($resultado_id_cat->num_rows > 0) {
            while ($row = $resultado_id_cat->fetch_assoc()) {
                $id_categorias[] = $row['id'];
                $nombre_categorias[] = $row['cat_nombre'];
            }
        } 
        else {
            $response = [
                'status' => 'error',
                'message' => 'El tipo ingresado no tiene categorías asociadas.'
            ];
            echo json_encode($response);
            exit;
        }
        // Saltar al siguiente bloque if
        goto check_categoria;
    }
}

if ($seleccionOpcion == 'categoria' && !empty($seleccionNombre)) {
    //Si se ingresó el dato de categoria, se busca en la tabla categoria el id y el nombre de la misma 
    $consulta_id_cat = "SELECT id, cat_nombre FROM categorias WHERE cat_nombre LIKE '%$seleccionNombre%' LIMIT 1";  
    $resultado_id_cat = $conexion->query($consulta_id_cat);
    $id_categorias = [];
    $nombre_categorias = [];
    if ($resultado_id_cat->num_rows > 0) {

        while($row = $resultado_id_cat->fetch_assoc()) {
            $id_categorias[] =$row['id'];
            $nombre_categorias[] =$row['cat_nombre'];
        }

    }
    else {
        $response = [
            'status' => 'error',
            'message' => 'La Categoria seleccionada es inexistente'
        ];
        echo json_encode($response);
        exit; // Detiene la ejecución del script PHP
    }  

    check_categoria:
    if (!empty($id_categorias)) {
        // Con el ID de las categorias vamos a realizar una lista.
        
        $ids_lista_cat = implode(",", $id_categorias); // Convertir el array de IDs a una lista separada por comas, mismo caso para el nombre
        $nombres_lista_cat = implode(",", $nombre_categorias);
        //echo "IDs de articulos dentro de la lista de fecha: $ids_lista<br> que son los articulos $nombres_lista";
        // Buscamos los IDs de la tabla ventas_detalle de las ventas que se realizaron con el ID de la lista de artículos

        $consulta_id_art = "SELECT id, art_nombre FROM articulos WHERE art_id_categoria IN ($ids_lista_cat)";  
        $resultado_id_art = $conexion->query($consulta_id_art);
        $id_articulos = [];
        $nombre_articulos = [];
        if ($resultado_id_art->num_rows > 0) {

            while($row = $resultado_id_art->fetch_assoc()) {
                $id_articulos[] =$row['id'];
                $nombre_articulos[] =$row['art_nombre'];
            }

        }
        else{
            $response = [
                'status' => 'error',
                'message' => 'La categoría ingresada no tiene artículos asociados.'
            ];
            echo json_encode($response);
            exit; // Detiene la ejecución del script PHP
        }  
        // Saltar al siguiente bloque if
        goto check_articulo;
    }
}

if ($seleccionOpcion == 'articulo' && !empty($seleccionNombre)) {
    //Si se ingresó el dato de articulo, se busca en la tabla articulos el id del articulo y el nombre completo
    $consulta_id_art = "SELECT id, art_nombre FROM articulos WHERE art_nombre LIKE '%$seleccionNombre%'";  
    $resultado_id_art = $conexion->query($consulta_id_art);
    $id_articulos = [];
    $nombre_articulos = [];
    if ($resultado_id_art->num_rows > 0) {

        while($row = $resultado_id_art->fetch_assoc()) {
            $id_articulos[] =$row['id'];
            $nombre_articulos[] =$row['art_nombre'];
        }

    } 
    else {
        $response = [
            'status' => 'error',
            'message' => 'El Articulo ingresado no existe.'
        ];
        echo json_encode($response);
        exit; // Detiene la ejecución del script PHP
    }  

    check_articulo:
    if (!empty($id_articulos)) {
        // Con el ID del artículo vamos a realizar una lista.
        
        $ids_lista_art = implode(",", $id_articulos); // Convertir el array de IDs a una lista separada por comas, mismo caso para el nombre
        $nombres_lista_art = implode(",", $nombre_articulos);
        //echo "IDs de articulos dentro de la lista de fecha que son los articulos $ids_lista_art";
        // Buscamos los IDs de la tabla historial_ventas_detalle de las ventas que se realizaron con el ID de la lista de artículos


        $consulta_id = "SELECT * FROM articulos WHERE id IN ($ids_lista_art)";
        $resultado_id = $conexion->query($consulta_id);

        // Verificar si se encontró alguna fila (es decir, si el nombre de articulo ya existe)
        // Verificar si se encontró alguna fila
        if ($resultado_id->num_rows > 0) {
            // Actualizar los precios de los artículos
            $actualizarArticulo = "UPDATE articulos SET art_precio = art_precio * $variacionPrecio WHERE id IN ($ids_lista_art)";
            if ($conexion->query($actualizarArticulo) === TRUE) {
                // Recorrer cada artículo y actualizar el historial
                while ($fila = $resultado_id->fetch_assoc()) {
                    $idArticulo_a_modif = $fila['id'];
                    $renombreArticulo = $fila['art_nombre'];
                    $marcaArticulo = $fila['art_marca']; // Asumiendo que tienes una columna art_marca
                    $descripcionArticulo = $fila['art_descripcion']; // Asumiendo que tienes una columna art_descripcion
                    $precioArticulo = $fila['art_precio'] * $variacionPrecio; // Asumiendo que tienes una columna art_precio
                    $id_cat = $fila['art_id_categoria']; // Asumiendo que tienes una columna art_id_categoria

                    // Inserción en el historial de modificaciones
                    $insertarHistorial = "INSERT INTO historial_articulos (histart_id_art, histart_accion, histart_id_usu, histart_id_categoria, histart_nombre, histart_marca, histart_descripcion, histart_precio) 
                                        VALUES ('$idArticulo_a_modif', 'modif_art', '$usuarioLogueado', '$id_cat', '$renombreArticulo', '$marcaArticulo', '$descripcionArticulo', '$precioArticulo')";
                    
                    if ($conexion->query($insertarHistorial) !== TRUE) {
                        echo "Error al insertar el historial del artículo ID $idArticulo_a_modif: " . $conexion->error;
                    }
                }
                $response = [
                    'articulos' => $nombres_lista_art,
                    'categorias' => $nombres_lista_cat,
                    'tipos' => $nombres_lista_tipos
                ];
                
                
                echo json_encode($response);
            } 
            else {
                echo "Error al actualizar los artículos: " . $conexion->error;
            }
        }
        else {
            $response = [
                'status' => 'error',
                'message' => 'Los articulos "'. $nombres_lista_art. '" no se incluyeron en ninguna venta realizada durante el periodo seleccionado.'
            ];
            echo json_encode($response);
            exit; // Detiene la ejecución del script PHP
        }
    }
}

?>