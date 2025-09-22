// Generacion del PDF al hacer clic en boton
$('#btnReporteSocio').click(function () { //ahi llamo al id del  boton

  console.log("NO carga datos problema aqui");
  // Realziar la solicitud AJAX para obtener los datos 
  $.ajax({
    url: 'ajax/reportesGenerales/reporteTotalSocios/getRporteTotalSocios.php',
    method: 'GET',
    dataType: 'json',
    // si es exitoso me crea el pdf
    success: function (data) {
      console.log(data); // muestra mensaje por consola
      // aqui obtengo la cantidad de filas que tiene la tabla
      // si es 0 que me muuestre este mensaje
      if (data.length === 0) {
        return;
      }
      // caso contrario, generame el reporte
      try {
        const { jsPDF } = window.jspdf;  // carga la libreria jspdf
        // aqui menciono que quiero que mi reporte sea horizontal
        const doc = new jsPDF('landscape'); // Orientación horizontal (portrait es vertical)

        const logoUrl = './assets/icons/logo.png'; // url del logo

        // funcion para agregar la cabecera del reporte
        function addHeader(doc, totalRecords) {
          doc.setFontSize(9);
          doc.setFont('helvetica', 'normal');

          const fechaImpresion = new Date().toLocaleDateString(); //me va a mostrar la fecha del sistema
          const headerText2 = 'PADRON DE BENEFICIARIOS DEL CLUB DE MADRES DEL PVL (PERIODO 2025 - I)'; //texto de la cabecera
          const reportTitle = 'REPORTE TOTAL DE SOCIOS'; //titulo del reporte

          const pageWidth = doc.internal.pageSize.width; //esto es el ancho de la pagina
          const marginX = 10; //margen en x
          const marginY = 5; //margen en y
          const logoWidth = 25; //ancho del logo
          const logoHeight = 25; //altura del logo

          doc.addImage(logoUrl, 'PNG', marginX, marginY, logoWidth, logoHeight); //aqui agrego el logo, el formato en png, y las dimensiones
          // por eso es que se muestra justo para este lado

          doc.setFont('helvetica', 'bold'); //fuente en negrita
          doc.setFontSize(16); //tamaño de fuente
          const titleWidth = doc.getTextWidth(reportTitle); //el ancho del titulo del reporte quiero que este en negrita
          const titleX = (pageWidth - titleWidth) / 2; // aqui le pido que me centre el titulo en el medio de la pagina
          const titleY = 20; // y que me ubique a esa altura
          doc.text(reportTitle, titleX, titleY); //aqui pongo el titulo del reporte
          doc.setLineWidth(0.5); // esto es para generar un subrayado de ancho 0.5 de espesor
          doc.line(titleX, titleY + 1, titleX + titleWidth, titleY + 1); //y aqui ubico el subrayado debajo del titulo a 1 punto debajo

          // Agregar subtítulo cantidad de registros
          const subtitleText = `Cantidad de registros: ${totalRecords}`; //y ahi lo llamo para que me muestre la cantidad de registros
          doc.setFontSize(12); //quiero que tenga tamaño 12
          const subtitleWidth = doc.getTextWidth(subtitleText); // y que me muestre el ancho del subtitulo
          const subtitleX = (pageWidth - subtitleWidth) / 2; // que tambien lo centre en el documento
          const subtitleY = titleY + 8; // Ajuste de posición debajo del título
          doc.text(subtitleText, subtitleX, subtitleY); // igual que en la linea 19, agrego todos los parametros para mostrarlo

          // Esto es para la fecha de impresion
          doc.setFontSize(8); // y quiero que tenga tamaño 8
          doc.setFont('helvetica', 'normal'); // que sea tipo de fuente helvetica y normal
          const fechaText = `Fecha de impresión: ${fechaImpresion}`; //ahi lo llamo al parametro
          const headerText2Width = doc.getTextWidth(headerText2); //le doy un ancho
          const fechaTextWidth = doc.getTextWidth(fechaText); //ahi llama al parametro fecha text
          const headerText2X = pageWidth - marginX - headerText2Width; //aqui le estoy diciendo que me muestre mas a la derecha
          const fechaTextX = pageWidth - marginX - fechaTextWidth;
          const headerText2Y = marginY + logoHeight / 2;
          const fechaTextY = headerText2Y + 5; // y aqui le estoy diciendo que me muestre a la altura del texto mas 5 punto 

          doc.text(headerText2, headerText2X, headerText2Y);
          doc.text(fechaText, fechaTextX, fechaTextY);
        }
        // addHeader(doc);
        addHeader(doc, data.length);

        const titleY = 45;
        doc.setFont('helvetica', 'bold');
        doc.setFontSize(12);
        doc.text('Detalle de los socios:', 20, titleY);


        let item = 1; // Contador para item
        doc.autoTable({ //aqui viene la libreria que te mencione para el diseño de la tabla 
          startY: 35, // quiero que mi tabla se muestre a 35 pountos desde arriba hasta donde empieza
          margin: { left: 4, right: 10 },
          head: [['N°', 'CODIGO SOCIO', 'NOMBRE SOCIO', 'DIRECCION', 'DNI', 'BENEFICIARIO', 'DNI', 'ESTADO']], //mi cabecera de la tabla
          // aqui viene lo bueno que es el relleno de la tabla
          // estos datos son traidos de la consulta ajax que te mostre
          // lo que hago es mapear cada uno de los datos de la consulta ajax y lo nombro como reporte
          // creo el cuerpo (body) y mapeo cada uno de los datos de la consulta ajax y lo nombro como reporte
          body: data.map(reporte => [
            item++, //ese item es el contador que lo inicie en la linea 92, incremental en 1
            reporte.CodigoSocio, //go al sql
            reporte.NombresSocio,
            reporte.direccionSocio,
            reporte.dniSocio,
            reporte.nombreBeneficiario,
            reporte.dniBeneficiario,
            reporte.Estado
          ]),
          // aqui viene la mariconada, hay que ponerle los estilos a la tabla
          styles: {
            fontSize: 7, // pongo el tamaño de la fuente
            cellPadding: 2, // pongo el padding de la celda
            halign: 'center', // pongo la alineamiento de la celda central horizonal
            valign: 'middle' // pongo la alineamiento de la celda central vertical
          },
          headStyles: {
            fillColor: [9, 4, 6], // color de fondo de la cabecera los colores son el rgb
            textColor: [255, 255, 255], // color de texto de la cabecera blanco
            fontStyle: 'bold', // pongo el estilo de fuente bold en negrita
            halign: 'center' // pongo la alineamiento de la celda central horizonal
          },
          // aqui viene la columna de estilos,
          columnStyles: {
            0: { cellWidth: 8 }, // Ancho para la columna item
            1: { cellWidth: 25 }, // Ancho para la columna Número de incidencia
            2: { cellWidth: 17 }, // Ancho para la columna Fecha
            3: { cellWidth: 38 }, // Ancho para la columna Categoría
            4: { cellWidth: 40 }, // Ancho para la columna Asunto
            5: { cellWidth: 35 }, // Ancho para la columna Documento
            6: { cellWidth: 28 }, // Ancho para la columna codigo patrimonial
            7: { cellWidth: 30 }, // Ancho para la columna Área solicitante
          }
          // eso ya depende de tus datos que tengas, la cosa que tienes que ir cuadrando para que no salga de la hoja
        });

        // Función para agregar el pie de página

        function addFooter(doc, pageNumber, totalPages) {
          doc.setFontSize(8); // Tamaño de fuente 8
          doc.setFont('helvetica', 'italic'); // Fuente helvetica y estilo cursiva 
          const footerY = 200; // Ajuste la posición del pie de página en la orientación horizontal
          doc.setLineWidth(0.5);
          doc.line(10, footerY - 5, doc.internal.pageSize.width - 10, footerY - 5); //esta es la linea separadora

          const footerText = 'PROGRAMA VASO DE LECHE';
          const pageInfo = `Página ${pageNumber} de ${totalPages}`; // Página actual y total de páginas
          const pageWidth = doc.internal.pageSize.width; // Ancho de la página actual

          doc.text(footerText, 10, footerY);
          doc.text(pageInfo, pageWidth - 10 - doc.getTextWidth(pageInfo), footerY);
        }

        // Pie de pagina
        const totalPages = doc.internal.getNumberOfPages(); // Número total de páginas funcion auq ayuuda a contar el total de paginas que tenga segun el reporte
        for (let i = 1; i <= totalPages; i++) {
          doc.setPage(i);
          addFooter(doc, i, totalPages);
        }

        // aqui termina el footer y ya tienes tu reporte
        // Establecer las propiedades del documento
        doc.setProperties({
          title: "Reporte total de socios.pdf"
        })
        // Mostrar mensaje de exito de pdf generado
        // Retrasar la apertura del PDF y limpiar el campo de entrada
        setTimeout(() => {
          window.open(doc.output('bloburl'), '_blank');
        }, 2000);
      } catch (error) {
        console.error('Error al generar el PDF:', error.message);
      }
    },
    // si es rror me muestra mensaje que no se puede crear pdf
    error: function (xhr, status, error) {
      console.error('Error en AJAX:', xhr.responseText, 'Status:', status, 'Error:', error);
    }
  });
});
