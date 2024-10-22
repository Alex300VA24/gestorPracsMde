$(document).ready(function () {

    function listarAsociaciones(nombreAsociacion, codSector) {
        $.ajax({
            url: './controllers/asociacion/listarAsociaciones.php',
            method: 'GET',
            dataType: 'json',
            data: {nombreAsociacion, codSector},
            success: function (response) {
                const {code, message, info, data} = response;

                if (code === 200) {
                    let row = '';
                    if (data && Array.isArray(data) && data.length > 0) {
                        row = data.map(({
                                            codAsociacion, nombreAsociacion, codSectorZona,
                                            sector, direccion, presidenta, cantidadBeneficiarios,
                                            documento, abreviatura, estado, numeroFinca, observaciones, codTipoLocal
                                        }) => {
                            return `
                                <tr>
                                    <td>${codAsociacion}</td>
                                    <td>${nombreAsociacion}</td>                                   
                                    <td hidden="hidden">${codSectorZona}</td>
                                    <td>${sector}</td>                                   
                                    <td>${direccion}</td>
                                    <td>${presidenta}</td>
                                    <td>${cantidadBeneficiarios}</td>
                                    <td>${documento ? documento : ''}</td>
                                    <td>
                                        <span class="estado ${abreviatura === "a" ? 'active' : abreviatura === 'pr' ? 'pendingResolution' : 'inactive'}">
                                            ${estado}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="actions actions_asociaciones">
                                        
                                            ${abreviatura == 'i' ?
                                `<img class="action action_habilitar" src="./assets/icons/action_habilitar.svg">` : ''}
                                            
                                            ${(abreviatura == 'a' || abreviatura == 'pr') ?
                                `<img id="btnEditarAsociacion" class="action" src="./assets/icons/action_edit.svg">` : ''}    
                                            
                                            ${abreviatura == 'a' ?
                                `<img class="action" src="./assets/icons/action_ver_detalle.svg">
                                            <img class="action" src="./assets/icons/action_deshabilitar.svg">` : ''}                                            
                                        </div>
                                    </td>
                                    <td hidden="hidden">${numeroFinca}</td>
                                    <td hidden="hidden">${observaciones}</td>
                                    <td hidden="hidden">${codTipoLocal}</td>
                                </tr>
                            `
                        })
                        $("#listaAsociaciones").html(row)
                    } else {
                        row = `<tr><td colspan="10">Aún no existen club de madres en el sistema</td></tr>`
                    }
                    $("#listaAsociaciones").html(row)
                }

                if (code === 500) {
                    showErrorInternalServer(message, info)
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error asociacionesCRUD.js: ', textStatus, errorThrown);
            }
        })
    }

    listarAsociaciones();

//     nueva asociacion - abrir modal
    $(document).off("click", "#nuevaAsociacion").on("click", "#nuevaAsociacion", function(e) {
        e.preventDefault();
        let modalRegistrar = $("#modalRegistrarAsociacion");
        $("#registrarAsociacionForm").trigger("reset");

        modalRegistrar.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalRegistrar.modal('show');

        modalRegistrar.one('shown.bs.modal', function() {
            $("#nombresNuevo").focus();
        });
    });

//     registrar asociacion
    $(document).off("submit", "#registrarAsociacionForm").on('submit', '#registrarAsociacionForm', function(e) {
        e.preventDefault();
        const nombre = $.trim($('#nombreAsociacion').val());
        const sector = Number($.trim($('#cboSectoresZonas').val()));
        const direccion = $.trim($('#direccion').val()).toUpperCase();
        const tipoLocal = Number($.trim($('#cboTiposLocales').val()));
        const numeroFinca = $.trim($('#numeroFinca').val());
        const observacion = $.trim($('#obervacionAsociacion').val());

        if (isFiledsValid(nombre, sector, direccion, tipoLocal)){
            $.ajax({
                url: './controllers/asociacion/registrar.php',
                method: 'POST',
                dataType: 'json',
                data: {nombre, sector, direccion, tipoLocal, numeroFinca, observacion},
                success: function (response) {
                    const {code, message, info, data} = response;

                    if (code === 200) {
                        showSuccessAlert(message)
                    }

                    if (code === 500) {
                        showErrorInternalServer(message, info)
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error asociacionesCRUD.js: ', textStatus, errorThrown);
                }
            })
        }
    })

//     editar asociacion - abrir modal
    $(document).off("click", "#btnEditarAsociacion").on("click", "#btnEditarAsociacion", function(e) {
        e.preventDefault();
        let modalEditar = $("#modalEditarAsociacion");
        let fila = $(this).closest("tr");
        let codAsociacion = fila.find('td:eq(0)').text();
        let nombreAsociacion = fila.find('td:eq(1)').text();
        let codSectorZona = fila.find('td:eq(2)').text();
        let direccion = fila.find('td:eq(4)').text();
        let numeroFinca = fila.find('td:eq(10)').text();
        let observaciones = fila.find('td:eq(11)').text();
        let tipoLocal = fila.find('td:eq(12)').text();

        console.log({codAsociacion, nombreAsociacion})


        $("#codAsociacion").val(codAsociacion.trim());
        $("#nombreAsociacionEdit").val(nombreAsociacion.trim());
        $("#cboSectoresZonasEdit").val(codSectorZona);
        $("#cboTiposLocalesEdit").val(tipoLocal);
        $("#direccionEdit").val(direccion.trim());
        $("#numeroFincaEdit").val(numeroFinca.trim() === '0' ? '' : numeroFinca.trim());
        $("#obervacionAsociacionEdit").val(observaciones.trim());

        modalEditar.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalEditar.modal('show');

        modalEditar.one('shown.bs.modal', function() {
            $("#nombreAsociacionEdit").focus();
        });
    });

    // Actualizar asociacion
    $(document).off("submit", "#editarAsociacionForm").on('submit', '#editarAsociacionForm', function(e) {
        e.preventDefault();
        const codAsociacion = $.trim($('#codAsociacion').val());
        const nombre = $.trim($('#nombreAsociacionEdit').val());
        const sector = Number($.trim($('#cboSectoresZonasEdit').val()));
        const direccion = $.trim($('#direccionEdit').val()).toUpperCase();
        const tipoLocal = Number($.trim($('#cboTiposLocalesEdit').val()));
        const numeroFinca = $.trim($('#numeroFincaEdit').val());
        const observacion = $.trim($('#obervacionAsociacionEdit').val());

        console.log({codAsociacion, nombre, sector, direccion, direccion, tipoLocal, numeroFinca, observacion})

        if (isFiledsValid(nombre, sector, direccion, tipoLocal)){
            $.ajax({
                url: './controllers/asociacion/actualizar.php',
                method: 'POST',
                dataType: 'json',
                data: {codAsociacion, nombre, sector, direccion, tipoLocal, numeroFinca, observacion},
                success: function (response) {
                    const {code, message, info, data} = response;

                    if (code === 200) {
                        showSuccessAlertUpdate(message)
                    }

                    if (code === 500) {
                        showErrorInternalServer(message, info)
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error asociacionesCRUD.js: ', textStatus, errorThrown);
                }
            })
        }
    })


    function isFiledsValid(nombre, sector, direccion, tipoLocal) {
        if (nombre === '' || sector == '' || sector === 0 || direccion == '' || tipoLocal == '' || tipoLocal === 0) {
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
            $('#modalRegistrarAsociacion').modal('hide');
            listarAsociaciones();
        });
    }

    function showSuccessAlertUpdate(message){
        Swal.fire({
            icon: "success",
            title: "Actualización Exitoso",
            text: message
        }).then(() => {
            $('#modalEditarAsociacion').modal('hide');
            listarAsociaciones();
        });
    }

})