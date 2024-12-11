<?php
/*
    PHP:            generar_reporte_ventas.php
    Descripción:    Arma el PDF con los resultados del Reporte de Ventas
*/
    // Importar libreria TCPDF
    require('../TCPDF/tcpdf.php'); 

    // Setear la zona horaria por defecto para la fecha del reporte y del archivo
    date_default_timezone_set('America/Argentina/Buenos_Aires');

    // Leer el contenido de las variables del reporte y guardarlo en variables locales
    $fechaGeneracion = $_POST['fechaGeneracion'];
    $fechaDesde = $_POST['fechaDesde'];
    $fechaHasta = $_POST['fechaHasta'];
    $usuarios = $_POST['usuarios'];
    $articulos = $_POST['articulos'];
    $categorias = $_POST['categorias'];
    $tipos = $_POST['tipos'];
    $diasComputados = $_POST['diasComputados'];
    $cantidadArticulos = $_POST['cantidadArticulos'];
    $cantidadVentas = $_POST['cantidadVentas'];
    $montoTotal = $_POST['montoTotal'];
    $cantidadVentasPromedioDia = $_POST['cantidadVentasPromedioDia'];
    $cantidadArticulosPromedioDia = $_POST['cantidadArticulosPromedioDia'];
    $montoPromedioDia = $_POST['montoPromedioDia'];

    // Setear Fecha del Reporte y del archivo // Setear fecha Desde y Hasta
    $fecha_reporte_informe = date("d-m-Y H:i:s");
    $fecha_reporte_archivo = date("d-m-Y_H-i-s");

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
                $imagen_logo = '../images/img-logo-reportes.jpg';
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
    $pdf->SetTitle('Reporte de Ventas');
    $pdf->SetSubject('Reporte de Ventas');
    $pdf->SetKeywords('Ferrotec, Reportes, Ventas');

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
    // Cabecera
    $html_cabecera =
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
            <p style='float:left;'><b>Reporte de Ventas</b></p>
            <br>".$fechaGeneracion."
            <br>
            <table>
                <tr>
                    <td colspan='2'><H4><b>Datos Brindados:</b></H4></td>
                    <td></td>
                </tr>
                <tr>
                    <td>".$fechaDesde."</td> 
                    <td>".$fechaHasta."</td>
                </tr>
                <tr>
                    <td><b>Filtrado por Usuario:</b></td>
                    <td>".$usuarios."</td>
                </tr>
                <tr>
                    <td><b>Artículos Involucrados</b>:</td>
                    <td>".$articulos."</td>
                </tr>
                <tr>
                    <td><b>Categorías Involucradas</b>:</td>
                    <td>".$categorias."</td>
                </tr>
                <tr>
                    <td><b>Tipos Involucrados</b>:</td>
                    <td>".$tipos."</td>
                </tr>
            </table>
        </body>
    </html>";

    $html_detalle =
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
            <p style='float:left;'><b>Información del Reporte: </b></p>
            <br>
            Totales:
            <br>
            <table>
                <tr>
                    <td><b>Cantidad de dias Computados</b> (*):</td>
                    <td>".$diasComputados."</td>
                </tr>
                <tr>
                    <td><b>Cantidad de Mercadería Vendida:</b></td> 
                    <td>".$cantidadArticulos."</td>
                </tr>
                <tr>
                    <td><b>Cantidad de Ventas Realizadas</b> (**):</td>
                    <td>".$cantidadVentas."</td>
                </tr>
                <tr>
                    <td><b>Monto Total Cobrado (***)</b>:</td>
                    <td>".$montoTotal."</td>
                </tr>
            </table>
            <br>
                <p style='float:left;'><b>Medidas Estadísticas: </b></p>
            <br>
            <table>
                <tr>
                    <td><b>Cantidad de Ventas Realizadas Promedio por Día</b>:</td>
                    <td>".$cantidadVentasPromedioDia."</td>
                </tr>
                <tr>
                    <td><b>Cantidad de Unidades de Mercaderia Vendidas Promedio por Día</b>:</td>
                    <td>".$cantidadArticulosPromedioDia."</td>
                </tr>
                <tr>
                    <td><b>Monto Cobrado Promedio por Día</b>:</td>
                    <td>".$montoPromedioDia."</td>
                </tr>
            </table>
            <br>
            <H4>Referencias:</H4>
            <br>
            <p><b>(*)</b>:  Se consideran todos los días en el rango seleccionado inclusive feriados y fines de semana.</p>
            <p><b>(**)</b>: Se computan todas las ventas que contienen uno o varios artículos seleccionados, la venta es por cliente.
            <p><b>(***)</b>:  Se considera solamente el/los artículos seleccionados.
        </body>
    </html>";
    
    // ------------------------ IMPRESIÓN DEL PDF CON DATOS ----------------------------------------------------- //
    // Imprimir datos de Cabecera
    $pdf->writeHTMLCell(0, 0, '', '', $html_cabecera, 0, 1, 0, true, '', true);

    // Agregar página nueva
    $pdf->addPage();

    // Imprimir datos de Detalle
    $pdf->writeHTMLCell(0, 0, '', '', $html_detalle, 0, 1, 0, true, '', true);

    // ------------------------ GENERACIÓN DEL ARCHIVO PDF ----------------------------------------------------- //
    // Cabeceras para tipo de contenido binario
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="reporte_ventas_' . $fecha_reporte_archivo . '.pdf"');
    header('Cache-Control: max-age=0');

    // Grabar archivo con el reporte generado
    $pdf->Output('reporte_ventas_' . $fecha_reporte_archivo . '.pdf', 'D');

    // Display de Errores
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>