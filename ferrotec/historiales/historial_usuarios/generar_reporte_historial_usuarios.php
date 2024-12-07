<?php
/*
    PHP:            generar_reporte_historial_usuarios.php
    Descripción:    Arma el PDF con los resultados del historial de usuarios
*/
    // Importar libreria TCPDF
    require('../../TCPDF/tcpdf.php'); 

    // Setear la zona horaria por defecto para la fecha del reporte y del archivo
    date_default_timezone_set('America/Argentina/Buenos_Aires');

    // Leer el contenido del JSON que viene en el cuerpo de la solicitud POST
    $json_string = $_POST['JSON-historial-usuarios'];

    // Decodificar el JSON
    $filas = json_decode($json_string,true);

    // Setear Fecha del Reporte y del archivo // Setear fecha Desde y Hasta
    $fecha_reporte_informe = date("d-m-Y H:i:s");
    $fecha_reporte_archivo = date("d-m-Y_H-i-s");

    // Setear varible $html_filas para devolver elementos uno por uno
    $html_filas = '';

    // Para cada conjunto de elementos de artículos de JSON, descompone cada uno en cada artibuto 
    // y lo agrega a la variable $html_filas
    foreach($filas as $row){
        $historial_fecha_registro = $row['fecha-registro'];
        $historial_tipo_accion = $row['tipo-accion'];
        $historial_username = $row['username'];
        $historial_modificado_por = $row['modificado-por'];
        $historial_tipo_permiso = $row['tipo-permiso'];
        $historial_nombre = $row['nombre'];
        $historial_apellido = $row['apellido'];
        $historial_direccion = $row['direccion'];
        $historial_sucursal = $row['sucursal'];
        $historial_email = $row['email'];
        $historial_activo = $row['activo'];

        $html_filas .=
        "<tr>
            <td>{$historial_fecha_registro}</td>
            <td>{$historial_tipo_accion}</td>
            <td>{$historial_username}</td>
            <td>{$historial_modificado_por}</td>
            <td>{$historial_tipo_permiso}</td>
            <td>{$historial_nombre}</td>
            <td>{$historial_apellido}</td>
            <td>{$historial_direccion}</td>
            <td>{$historial_sucursal}</td>
            <td>{$historial_email}</td>
            <td>{$historial_activo}</td>
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
                $this->Line(10, $this->GetY(), 285, $this->GetY());

                // Desactiva el encabezado
                $this->showHeader = false;
            }
        }
    }

    // Crear el documento TCPDF a partir de la clase MYPDF
    $pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Setear información del documento
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Ferrotec');
    $pdf->SetTitle('Historial de Modificaciones del Usuario');
    $pdf->SetSubject('Historial de Modificaciones del Usuario');
    $pdf->SetKeywords('Ferrotec, Historiales, Usuarios');

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

    $html =
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
                <p style='float:left;'> <b> Historial de Modificaciones del Usuario </b> </p>
                <p style='float:right;'> <b> Fecha de Consulta: </b>" . $fecha_reporte_informe . "</p>" . "
            <br>
            <br>
            <table>
                <tr>
                    <td>Fecha Registro</td>
                    <td>Acción</td>
                    <td>Usuario</td>
                    <td>Modificado Por</td>
                    <td>Tipo Permiso</td>
                    <td>Nombre</td>
                    <td>Apellido</td>
                    <td>Dirección</td>
                    <td>Sucursal</td>
                    <td>E-mail</td>
                    <td>Activo</td>
                </tr>
                {$html_filas}
            </table>
        </body>
    </html>
    ";

    // ------------------------ IMPRESIÓN DEL PDF CON DATOS ----------------------------------------------------- //
    // Print text using writeHTMLCell()
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

    // ------------------------ GENERACIÓN DEL ARCHIVO PDF ----------------------------------------------------- //
    // Cabeceras para tipo de contenido binario
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="consulta_historial_usuarios_' . $fecha_reporte_archivo . '.pdf"');
    header('Cache-Control: max-age=0');

    // Grabar archivo con el reporte generado
    $pdf->Output('consulta_historial_usuarios_' . $fecha_reporte_archivo . '.pdf', 'D');

    // Display de Errores
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>