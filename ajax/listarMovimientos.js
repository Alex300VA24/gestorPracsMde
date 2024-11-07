$(document).ready(function () {

    function listarMovimientos(codigo, descripcion) {
        $.ajax({
            url: './controllers/movimientos/listarMovimientos.php',
            method: 'GET',
            dataType: 'json',
            data: {codigo, descripcion},
            success: function (response) {
                const {code, message, info, data} = response;

                if (code === 200) {
                    let row = '';
                    if (data && Array.isArray(data) && data.length > 0) {
                        row = data.map(({
                                            codMovimiento, codProducto, descripcion,fechaMovimiento, cantidad, unidadMedida,
                                            precioUnitario, precioTotal, documento, codTipoMovimiento, descripcionTipoMov
                                        }) => {
                            return `
                                <tr>
                                    <td>${codMovimiento}</td>
                                    <td hidden="hidden">${codProducto}</td>
                                    <td>${descripcion}</td>
                                    <td>${fechaMovimiento.split(' ')[0]}</td> 
                                    <td>${documento}</td>                                                                     
                                    <td>${unidadMedida}</td>
                                    <td>${cantidad}</td>
                                    <td>${precioUnitario}</td>
                                    <td>${precioTotal}</td>
                                    <td hidden="hidden">${codTipoMovimiento}</td>
                                    <td hidden="hidden">${descripcionTipoMov}</td>

                                    <td>
                                        <div class="actions actions_productos">
                             
                                <img id="btnEditarMovimiento" class="action" src="./assets/icons/action_edit.svg">
                                        </div>
                                    </td>
                                </tr>
                            `
                        })
                        $("#listaMovimientos").html(row)
                    } else {
                        row = `<tr><td colspan="10">Aún no existen movimientos en el sistema</td></tr>`
                    }
                    $("#listaMovimientos").html(row)
                }

                if (code === 500) {
                    showErrorInternalServer(message, info)
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error listarMovimientos.js: ', textStatus, errorThrown);
            }
        })
    }

    listarMovimientos();

// nuevo movimiento - abrir modal
    $(document).off("click", "#nuevoMovimiento").on("click", "#nuevoMovimiento", function(e) {
        e.preventDefault();
        let modalRegistrar = $("#modalRegistrarMovimiento");
        $("#registrarMovimientoForm").trigger("reset");
    
        modalRegistrar.modal({
            backdrop: 'static',
            keyboard: false
        });
    
        modalRegistrar.modal('show');
    
        modalRegistrar.one('shown.bs.modal', function() {
            $("#cboproducto").focus();
        });
    });

// registrar movimiento

    $(document).off("submit", "#registrarMovimientoForm").on('submit', '#registrarMovimientoForm', function(e) {
        e.preventDefault();
        const producto = $.trim($('#cboProducto').val());
        const tipoMovimiento = $.trim($('#cboTipoMovimiento').val());
        const fechaMovimiento = $.trim($('#fechaMovimiento').val());
        const documento = $.trim($('#documento').val());
        const cantidad = $.trim($('#cantidad').val());
        const precioUnitario = $.trim($('#precioUnitario').val());
        //console.log({producto, tipoMovimiento, fechaMovimiento, documento, cantidad, precioUnitario})

        if (isFiledsValid(producto, tipoMovimiento, fechaMovimiento, documento, cantidad, precioUnitario)){
            $.ajax({
                url: './controllers/movimientos/registrarMovimientos.php',
                method: 'POST',
                dataType: 'json',
                data: {producto, tipoMovimiento, fechaMovimiento, documento, cantidad, precioUnitario},
                success: function (response) {
                    console.log(response)
                    const {code, message, info, data} = response;

                    if (code == 200) {
                        showSuccessAlert(message)
                    }

                    if (code === 500) {
                        showErrorInternalServer(message, info)
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error listarMovimientos.js: ', textStatus, errorThrown);
                }
            })

        }
    })

// editar movimientos - abrir modal
    $(document).off("click", "#btnEditarMovimiento").on("click", "#btnEditarMovimiento", function(e) {
        e.preventDefault();
        let modalEditar = $("#modalEditarMovimiento");
        let fila = $(this).closest("tr");
        let codMovimiento = fila.find('td:eq(0)').text();
        let codProducto = fila.find('td:eq(1)').text();
        let fechaMovimiento = fila.find('td:eq(3)').text();
        let documento = fila.find('td:eq(4)').text();
        let cantidad = fila.find('td:eq(6)').text();
        let precioUnitario = fila.find('td:eq(7)').text();
        let codTipoMovimiento = fila.find('td:eq(9)').text();

        console.log({codMovimiento, codProducto, precioUnitario})

        $("#codMovimiento").val(codMovimiento.trim());
        $("#cboProductoEdit").val(codProducto);
        $("#fechaMovimientoEdit").val(fechaMovimiento.trim());
        $("#cantidadEdit").val(cantidad.trim());
        $("#precioUnitarioEdit").val(precioUnitario.trim());
        $("#documentoEdit").val(documento.trim());
        $("#cboTipoMovimientoEdit").val(codTipoMovimiento);

        modalEditar.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalEditar.modal('show');

        modalEditar.one('shown.bs.modal', function() {
            $("#cboProductoEdit").focus();
        });
    });

// Actualizar movimientos
    $(document).off("submit", "#editarMovimientoForm").on('submit', '#editarMovimientoForm', function(e) {
        e.preventDefault();
        const codMovimiento = $.trim($('#codMovimiento').val());
        const producto = $.trim($('#cboProductoEdit').val());
        const tipoMovimiento = $.trim($('#cboTipoMovimientoEdit').val());
        const fechaMovimiento = $.trim($('#fechaMovimientoEdit').val());
        const documento = $.trim($('#documentoEdit').val());
        const cantidad = $.trim($('#cantidadEdit').val());
        const precioUnitario = $.trim($('#precioUnitarioEdit').val());

        console.log({codMovimiento, producto, tipoMovimiento, fechaMovimiento, documento, cantidad, precioUnitario})

        if (isFiledsValid(producto, tipoMovimiento, fechaMovimiento, documento, cantidad, precioUnitario)){
            $.ajax({
                url: './controllers/movimientos/actualizar.php',
                method: 'POST',
                dataType: 'json',
                data: {codMovimiento, producto, tipoMovimiento, fechaMovimiento, documento, cantidad, precioUnitario},
                success: function (response) {
                    console.log(response)
                    const {code, message, info, data} = response;

                    if (code === 200) {
                        showSuccessAlertUpdate(message)
                    }

                    if (code === 500) {
                        showErrorInternalServer(message, info)
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error listarMovimientos.js: ', textStatus, errorThrown);
                }
            })
        }
    })

    function isFiledsValid(producto, tipoMovimiento, fechaMovimiento, documento, cantidad, precioUnitario) {
        if (producto === '' || producto === 0 || tipoMovimiento == '' || tipoMovimiento == 0 || fechaMovimiento === '' || documento == '' || cantidad == '' || precioUnitario === '') {
            Swal.fire({
                title: "¡Advertencia!",
                text: 'Campos incompletos',
                icon: "warning",
                width: "350px",
                confirmButtonColor: "#13252E",
            });
            return false;
        }
        return true;
    }

    function showErrorInternalServer(message, info) {
        Swal.fire({
            title: "¡Error!",
            text: message + ' {' + info + '}',
            icon: "error",
            width: "350px",
            confirmButtonColor: "#13252E",
        });
    }

    function showSuccessAlert(message){
        Swal.fire({
            icon: "success",
            title: "Registro Exitoso",
            text: message
        }).then(() => {
            $('#modalRegistrarMovimiento').modal('hide');
            listarMovimientos();
        });
    }

    function showSuccessAlertUpdate(message){
        Swal.fire({
            icon: "success",
            title: "Actualización Exitoso",
            text: message
        }).then(() => {
            $('#modalEditarMovimiento').modal('hide');
            listarMovimientos();
        });
    }



})
