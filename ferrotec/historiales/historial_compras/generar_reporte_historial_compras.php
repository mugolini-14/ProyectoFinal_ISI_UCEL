<?php
/*
    PHP:            generar_reporte_historial_compras.php
    Descripción:    Arma el PDF con los resultados del historial de Compras
*/
    // Importar libreria TCPDF
    require('../../TCPDF/tcpdf.php'); 

    // Setear la zona horaria por defecto para la fecha del reporte y del archivo
    date_default_timezone_set('America/Argentina/Buenos_Aires');

    // Leer el contenido del JSON que viene en el cuerpo de la solicitud POST
    $json_string_compras = $_POST['JSON-historial-compras'];
    $json_string_compras_detalle = $_POST['JSON-historial-compras-detalle'];

    //echo $json_string_compras_detalle;

    // Decodificar los JSONs
    $filascompras = json_decode($json_string_compras,true);
    $filascomprasdetalle = json_decode($json_string_compras_detalle,true);

    // Setear Fecha del Reporte y del archivo // Setear fecha Desde y Hasta
    $fecha_reporte_informe = date("d-m-Y H:i:s");
    $fecha_reporte_archivo = date("d-m-Y_H-i-s");

    // Setear varible $html_filas para devolver elementos uno por uno
    $html_filas_compras = '';
    $html_filas_compras_detalle = '';

    // Para cada conjunto de elementos de compras de JSON, descompone cada uno en cada artibuto 
    // y lo agrega a la variable $html_filas
    foreach($filascompras as $rowcompras){
        $historial_compras_fecha_registro = $rowcompras['fecha-registro'];
        $historial_compras_compranro = $rowcompras['compranro'];
        $historial_compras_modificado_por = $rowcompras['modificado-por'];
        $historial_compras_montototal = $rowcompras['montototal'];
        $historial_compras_sucursal = $rowcompras['sucursal'];
        $historial_compras_proveedor = $rowcompras['proveedor'];
        $historial_compras_mododepago = $rowcompras['mododepago'];

        $html_filas_compras .=
        "<tr>
            <td>{$historial_compras_fecha_registro}</td>
            <td>{$historial_compras_compranro}</td>
            <td>{$historial_compras_modificado_por}</td>
            <td>{$historial_compras_montototal}</td>
            <td>{$historial_compras_sucursal}</td>
            <td>{$historial_compras_proveedor}</td>
            <td>{$historial_compras_mododepago}</td>
        </tr>
        ";
    } 

    foreach($filascomprasdetalle as $rowcomprasdetalle){
        $historial_compras_detalle_iddetalle = $rowcomprasdetalle['id-detalle'];
        $historial_compras_detalle_articulo = $rowcomprasdetalle['articulo'];
        $historial_compras_detalle_cantidad = $rowcomprasdetalle['cantidad'];
        $historial_compras_detalle_montodetalle = $rowcomprasdetalle['montodetalle'];

        $html_filas_compras_detalle .=
        "<tr>
            <td>{$historial_compras_detalle_iddetalle}</td>
            <td>{$historial_compras_detalle_articulo}</td>
            <td>{$historial_compras_detalle_cantidad}</td>
            <td>{$historial_compras_detalle_montodetalle}</td>
        </tr>
        ";
    } 

    // ------------------------ PREPARACIÓN DEL PDF ----------------------------------------------------- //
    // Extiende la clase TCPDF de la librería crear un encabezado personalizado
    class MYPDF extends TCPDF {

        // Variable que controla que el encabezado ya se mostró
        protected $showHeader = true;

        //Encabezado (header)
        public function Header() {

            // Pregunta si está activo el encabezado
            if($this->showHeader){
                // Imagen de Logo
                $imagen_logo = '../../images/img-logo-reportes.jpg';
                $this->Image($imagen_logo, 20, 10, 25, 25, 'JPG', '', 'T', false, 300, 'R', false, false, 0, false, false, false);
                
                $this->Ln(10);

                // Fuente
                $this->SetFont('helvetica', 'B', 16);
                
                // Titulo del header (cada línea es con enter al final)
                $this->Cell(0, 15, 'Ferr O`Tec ', 0, false, 'L', 0, '', 0, false, 'M', 'M');
            
                // Espacio 
                $this->Ln(10);

                $this->Cell(0, 15, 'Generación de Reportes Automáticos', 0, false, 'L', 0, '', 0, false, 'M', 'M');
                
                // Espacio 
                $this->Ln(8); 

                // Línea horizontal (simula un <hr>)
                $this->Line(10, $this->GetY(), 200, $this->GetY());

                // Desactiva el encabezado
                $this->showHeader = false;
            }
        }
    }

    // Crear el documento TCPDF a partir de la clase MYPDF
    $pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Setear información del documento
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Ferrotec');
    $pdf->SetTitle('Historial de Compras');
    $pdf->SetSubject('Historial de Compras');
    $pdf->SetKeywords('Ferrotec, Historiales, Compras');

    // Setear información del encabezado
    //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

    $pdf->setFooterData(array(0,0,0), array(0,0,0));

    // Setear letras de encabezado y pie de página
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // Setear fuente mono-espaciada por defecto
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // Setear Márgenes
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // Setear saltos de página automáticos
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // Setear escala de imagen por defecto
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // Habilitar por defecto el modo de sub-set de fuentes (font subsetting)
    $pdf->setFontSubsetting(true);

    // Setear Fuente Principal
    $pdf->SetFont('dejavusans', '', 14, '', true);

    // Agrega la página en blanco del documento
    $pdf->AddPage();

    // ------------------------ CONTENIDO DEL CUERPO DEL PDF ----------------------------------------------------- //

    $html_reporte_compras =
    "<html>
        <body>
            <style>
                table {
                    border-collapse: collapse;
                    width: 100%;
                    text-align: left;
                }
                th, td {
                    border: 1px solid black;
                    padding: 2px;
                    text-align: left;
                }
                th {
                    background-color: #f2f2f2;
                }
            </style>
            <br>
                <p style='float:left;'> <b> Historial de Compras </b> </p>
                <p style='float:right;'> <b> Fecha de Consulta: </b>" . $fecha_reporte_informe . "</p>" . "
                <p style='float:right;'> <b> Compras: </b> </p>" . "
            <br>
            <br>
            <table>
                <tr>
                    <td>Fecha Registro</td>
                    <td>Compra Nro.</td>
                    <td>Modificado Por</td>
                    <td>Monto Total</td>
                    <td>Sucursal</td>
                    <td>Proveedor</td>
                    <td>Modo de Pago</td>
                </tr>
                {$html_filas_compras}
            </table>
            <br>
        </body>
    </html>
    ";

    $html_reporte_compras_detalle =
    "<html>
        <body>
            <style>
                table {
                    border-collapse: collapse;
                    width: 100%;
                    text-align: left;
                }
                th, td {
                    border: 1px solid black;
                    padding: 2px;
                    text-align: left;
                }
                th {
                    background-color: #f2f2f2;
                }
            </style>       
            <p style='float:left;'> <b> Detalle de Compras: </b> </p>" . "
            <table>
                <tr>
                    <td>Compra Nro.</td>
                    <td>Artículo</td>
                    <td>Cantidad</td>
                    <td>Monto</td>
                </tr>
                {$html_filas_compras_detalle}
            </table>
        </body>
    </html>
    ";

    // ------------------------ IMPRESIÓN DEL PDF CON DATOS ----------------------------------------------------- //
    // Imprime las Compras
    $pdf->writeHTMLCell(0, 0, '', '', $html_reporte_compras, 0, 1, 0, true, '', true);

    // Salto de página para el detalle
    $pdf->AddPage();

    // Imprime el Detalle
    $pdf->writeHTMLCell(0, 0, '', '', $html_reporte_compras_detalle, 0, 1, 0, true, '', true);

    // ------------------------ GENERACIÓN DEL ARCHIVO PDF ----------------------------------------------------- //
    // Cabeceras para tipo de contenido binario
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="consulta_historial_compras_' . $fecha_reporte_archivo . '.pdf"');
    header('Cache-Control: max-age=0');

    // Grabar archivo con el reporte generado
    $pdf->Output('consulta_historial_compras_' . $fecha_reporte_archivo . '.pdf', 'D');

    // Display de Errores
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>