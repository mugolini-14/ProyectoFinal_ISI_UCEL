// Funcion: fnGenerarReporteArticulos
// Descripción: función que controla que haya artículos para generar un reporte y envía la información
//              a generar_reporte_articulos.php
//

function fnGenerarReporteArticulos() {
    if(document.getElementById('articulo-nombre')){     // Verifica que la tabla de artículos esté generada
        var elementosArticulos = document.querySelectorAll('#tabla-body-articulos tr'); // Obtiene todas las filas de la tabla
        console.log(elementosArticulos);
        var cantidadRegistrosArticulos = elementosArticulos.length;
    
        var datosArticulos = [];        // Inicializa arreglo de artículos
            for (var i = 0; i < cantidadRegistrosArticulos; i++) {  // Recorre las filas de la tabla
                var fila = elementosArticulos[i];                   // Accede a la fila actual
        
                var nombre = fila.querySelector('.articulo-nombre').innerHTML;
                var marca = fila.querySelector('.articulo-marca').innerHTML;
                var descripcion = fila.querySelector('.articulo-descripcion').innerHTML;
                var precio = fila.querySelector('.articulo-precio').innerHTML;
                var stock = fila.querySelector('.articulo-stock').innerHTML;
        
                datosArticulos.push({
                    'nombre': nombre, 
                    'marca': marca,
                    'descripcion': descripcion,
                    'precio': precio,
                    'stock': stock
                });
            }
        
        console.log(datosArticulos);
    
        var datosArticulosJSON = JSON.stringify(datosArticulos);    // Convierte a JSON el arreglo para enviar al php
    
        var formData = new FormData();
        formData.append('JSON-articulos', datosArticulosJSON);
    
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../consultas/generar_reporte_articulos.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert("Reporte Generado Exitosamente.");
            }
        };
        xhr.send(formData);
        
    }
    else{
        alert("No hay artículos para generar el reporte.");
    }
}