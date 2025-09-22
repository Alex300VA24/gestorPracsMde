$(document).ready(function () {

    let fechaActual = new Date();
    let fechaFormateada = fechaActual.toISOString().split('T')[0];

    let tableBody = document.getElementById("tableProductosDetalles"); // Cuerpo de la tabla
    let productosSeleccionados = [];


    listarPecosas(codPecosa);

    function listarPecosas(fechaReparto){
        $.ajax({
            url: './controllers/pecosa/listarPecosa.php',
            method: 'GET',
            dataType: 'json',
            data: {fechaReparto},
            success: function (response)  {
                const {code, message, info, data} = response;

                if (code === 200) {
                    let row = '';
                    if (data && Array.isArray(data) && data.length > 0) {
                        row = data.map(({
                                            codPecosa, nombreAsociado, presidenta, observacion, fechaReparto, 
                                        }) => {
                            return `
                                <tr>
                                    <td>${codPecosa}</td>
                                    <td>${nombreAsociado}</td>                            
                                    <td>${presidenta}</td>
                                    <td>${observacion}</td>
                                    <td>${fechaReparto.split(' ')[0]}</td>
                                    

                                    <td> 
                                        <div class="actions actions_productos">
                            
                                <img id="btnEditarMovimiento" class="action" src="./assets/icons/action_edit.svg">
                                <img id="btnEliminarMovimiento" class="action" src="./assets/icons/action_delete.svg">
                                        </div>
                                    </td>
                                </tr>
                            `
                        })
                    }
                }

            }
        })

    }

// nuva pecosa - abrir modal
    $(document).off("click", "#nuevaPecosa").on("click", "#nuevaPecosa", function(e) {
        e.preventDefault();
        let modalRegistrar = $("#modalRegistrarPecosa");
        $("#registrarPecosaForm").trigger("reset");
        $("#fechaReparto").val(fechaFormateada)
        $("#fechaDesde").val(fechaFormateada)

        modalRegistrar.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalRegistrar.modal('show');

        modalRegistrar.one('shown.bs.modal', function() {
            $("#comite").focus();
        });
    });

    // registrar pecosa
    $(document).off("submit", "#registrarPecosaForm").on('submit', '#registrarPecosaForm', function(e) {
        e.preventDefault();
    
        // Obtener los valores del formulario
        const numero = $.trim($('#numero').val());
        const clubMadres = $.trim($('#cboClubMadres').val());
        const presidenta = $.trim($('#codSocioPresidenta').val());
        const fechaReparto = $.trim($('#fechaReparto').val());
        const observacion = $.trim($('#observacion').val());
    
        console.log({numero, clubMadres, presidenta, fechaReparto, observacion});
        console.log({productosSeleccionados}); // Verifica que los productos estén en el arreglo
    
        $.ajax({
            url: './controllers/pecosa/registrarPecosas.php',
            method: 'POST',
            dataType: 'json', // Asegúrate de que sea 'json'
            data: {
                numero,
                clubMadres,
                presidenta,
                fechaReparto,
                observacion,
                productosSeleccionados: JSON.stringify(productosSeleccionados)// Convertir productosSeleccionados a JSON

            },
            success: function(response) {
                console.log(response); // Ver la respuesta del servidor
                const { code, message, info, data } = response;
    
                if (code == 200) {
                    showSuccessAlert(message); // Mostrar éxito
                }
    
                if (code === 500) {
                    showErrorInternalServer(message, info); // Mostrar error
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error registrarPecosa.js: ', textStatus, errorThrown);
            }
        });
    });
    

    // Evento para agregar productos a la tabla
    $(document).off("click", "#btnAgregarProducto").on("click", "#btnAgregarProducto", function (e) {
        e.preventDefault();

        // Obtener valores de los campos del formulario
        const cboProducto = document.getElementById("cboProducto");
        const idProducto = cboProducto.value; // ID del producto (value del select)
        const descripcionProducto = cboProducto.options[cboProducto.selectedIndex].text; // Nombre del producto

        const prioridad = document.getElementById("cboPrioridad").value;
        const fechaDesde = document.getElementById("fechaDesde").value;
        const fechaHasta = document.getElementById("fechaHasta").value;
        const cantidad = document.getElementById("cantidad").value;
        const precioUnitario = document.getElementById("precioUnitario").value;

        // Validar que los campos obligatorios estén llenos
        if (!idProducto || !prioridad || !fechaDesde || !fechaHasta || !cantidad || !precioUnitario) {
            alert("Por favor, complete todos los campos obligatorios.");
            return;
        }

        // Crear una nueva fila en la tabla
        const newRow = document.createElement("tr");
        newRow.innerHTML = `
            <td>${idProducto}</td>
            <td>${descripcionProducto}</td>
            <td>${prioridad}</td>
            <td>${fechaDesde}</td>
            <td>${fechaHasta}</td>
            <td>${cantidad}</td>
            <td>${precioUnitario}</td>
            <td><button class="btn btn-danger btn-sm btnEliminar">Eliminar</button></td>
        `;

        // Agregar la fila al cuerpo de la tabla
        tableBody.appendChild(newRow);

        // Agregar los datos al arreglo
        productosSeleccionados.push({
            idProducto: idProducto,
            prioridad: prioridad,
            fechaDesde: fechaDesde,
            fechaHasta: fechaHasta,
            cantidad: cantidad,
            precioUnitario: precioUnitario,
            

        });

        console.log("Productos seleccionados:", productosSeleccionados);
    });

    // Evento para eliminar una fila
    $(document).off("click", ".btnEliminar").on("click", ".btnEliminar", function (e) {
        e.preventDefault();

        const row = e.target.closest("tr"); // Fila a eliminar
        const idProducto = row.cells[0].textContent; // ID del producto (columna 1)

        // Remover la fila de la tabla
        row.remove();

        // Eliminar del arreglo
        productosSeleccionados = productosSeleccionados.filter(item => item.idProducto !== idProducto);

        console.log("Productos seleccionados tras eliminación:", productosSeleccionados);
    });
})