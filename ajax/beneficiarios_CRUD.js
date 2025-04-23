$(document).ready(function () {

    let dniOApellidosNombres;
    let codAsociacion;
    let edadMinima;
    let edadMaxima;
    let pesoTallaHmgFiltro;

    listarBeneficiarios(dniOApellidosNombres, codAsociacion, edadMinima, edadMaxima);

    function listarBeneficiarios(dniOApellidosNombres, codAsociacion,  edadMinima, edadMaxima) {
        $.ajax({
            url: './controllers/beneficiario/listar.php',
            method: 'GET',
            dataType: 'json',
            data: {dni_apellidos_nombres: dniOApellidosNombres, codAsociacion, edadMinima, edadMaxima},
            success: function (response) {
                console.log(response)
                const {code, message, info, data} = response;

                if (code === 200) {
                    let row = '';
                    if (data && Array.isArray(data) && data.length > 0) {
                        row = data.map(({codBeneficiario, codPersona, nombres, apellidoPaterno,
                                            apellidoMaterno, sexo, fechaNacimiento, codSectorZona,
                                            codTipoBeneficio, tipoBeneficio, peso, talla, hmg,
                                            direccion, aniosNacido, dni, observaciones, codAsociacion,
                                            nombreAsociacion, cargo, fechaInicio, fechaFin, abreviatura, estado,
                                            codMotivoInhabilitacion, motivoInhabilitacion
                                        }) => {
                            return `
                                <tr>
                                    <td>${codBeneficiario}</td>
                                    <td hidden="hidden">${codPersona}</td>
                                    <td>${apellidoPaterno + ' ' + apellidoMaterno + ' ' + nombres}</td>                                   
                                    <td hidden="hidden">${sexo}</td>
                                    <td hidden="hidden">${fechaNacimiento}</td>
                                    <td hidden="hidden">${codSectorZona}</td>
                                    <td hidden="hidden">${direccion}</td>
                                    <td>${aniosNacido}</td>                                                                                                       
                                    <td>${dni}</td>                                                                                                       
                                    <td hidden="hidden">${codTipoBeneficio}</td>                                                                                                       
                                    <td>${tipoBeneficio}</td>                                                                                                       
                                    <td>${peso ? peso : ''}</td>                                                                                                       
                                    <td>${talla ? talla : ''}</td>                                                                                                       
                                    <td>${hmg ? hmg : ''}</td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                                    <td>
                                        <span class="estado ${abreviatura === "a" ? 'active' : abreviatura === 'v' ? 'vencido' : 'inactive'}">
                                            ${estado}
                                        </span>
                                    </td>
                                    <td hidden="hidden">${codMotivoInhabilitacion}</td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                                    <td>${motivoInhabilitacion ? motivoInhabilitacion : ''}</td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                                    <td>
                                        <div class="actions actions_beneficiarios">     
                                            ${abreviatura == 'a' ?
                                            ` <div class="tooltip-container">
                                                <img id="btnEditarAsociacion" class="action" src="./assets/icons/action_edit.svg">
                                                <span class="custom-tooltip">Editar beneficiario</span>
                                            </div>

                                            <div class="tooltip-container">
                                                <img id="" class="action" src="./assets/icons/action_ver_detalle.svg">
                                                <span class="custom-tooltip">Detalle de beneficiario</span>
                                            </div>
                                            
                                            <div class="tooltip-container">
                                                <img id="" class="action" src="./assets/icons/action_ver_beneficiarios.svg">
                                                <span class="custom-tooltip">Ver beneficiario</span>
                                            </div>

                                            <div class="tooltip-container">
                                                <img id="" class="action" src="./assets/icons/action_cambiar_beneficio.svg">
                                                <span class="custom-tooltip">Cambiar beneficiario</span>
                                            </div>

                                            <div class="tooltip-container">
                                                <img id="btnDeshabilitarBeneficiario" class="action" src="./assets/icons/action_deshabilitar.svg">
                                                <span class="custom-tooltip">Deshabilitar beneficiario</span>
                                            </div>
                                            ` : ''}       
                                            
                                            ${abreviatura == 'i' ?
                                            `
                                            <div class="tooltip-container">
                                                        <img id="btnHabilitarBeneficiario" class="action" src="./assets/icons/action_habilitar.svg">
                                                <span class="custom-tooltip">Habilitar beneficiario</span>
                                            </div>

                                            ` : ''}   
                                        </div>
                                    </td>
                                </tr>
                            `
                        })
                        $("#listaBeneficiarios").html(row)
                    } else {
                        row = `<tr><td colspan="10">Aún no existen beneficiarios en el sistema</td></tr>`
                    }
                    $("#listaBeneficiarios").html(row)
                }

                if (code === 500) {
                    showErrorInternalServer(message, info)
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error reconocimientos_CRUD.js: ', textStatus, errorThrown);
            }
        })
    }

    //Editar un beneficiario






    //
    
   // Desvincula cualquier evento click previo y vincula un nuevo evento click al botón #btnEditarBeneficiario
$(document).off("click", "#btnEditarBeneficiario").on("click", "#btnEditarBeneficiario", function (e) {
    // Previene el comportamiento por defecto del botón (por ejemplo, enviar un formulario)
    e.preventDefault();

    // Selecciona el modal de edición
    let modalEditar = $("#modalEditarBeneficiario");

    // Obtiene la fila más cercana al botón que se ha hecho clic
    let fila = $(this).closest("tr");

    // Recolecta los datos de las celdas de la fila
    let codBeneficiario = fila.find('td:eq(0)').text(); // Código del beneficiario
    let codPersona = fila.find('td:eq(1)').text(); // Código de la persona
    let sexo = fila.find('td:eq(3)').text(); // Sexo
    let dni = fila.find('td:eq(8)').text(); // DNI
    let nombres = fila.find('td:eq(15)').text(); // Nombres
    let apellidoPaterno = fila.find('td:eq(16)').text(); // Apellido paterno
    let apellidoMaterno = fila.find('td:eq(17)').text(); // Apellido materno
    let telefono = fila.find('td:eq(18)').text(); // Teléfono
    let celular = fila.find('td:eq(19)').text(); // Celular
    let fechaNacimiento = fila.find('td:eq(4)').text(); // Fecha de nacimiento
    let edad = fila.find('td:eq(7)').text(); // Edad
    let direccion = fila.find('td:eq(6)').text(); // Dirección
    let numeroFinca = fila.find('td:eq(20)').text(); // Número de finca
    let asociacion = fila.find('td:eq(10)').text(); // Asociación
    let zonaSector = fila.find('td:eq(5)').text(); // Zona o sector
    let observaciones = fila.find('td:eq(9)').text(); // Observaciones

    // Asigna los valores recolectados a los campos del modal de edición
    $("#codBeneEditar").val(codBeneficiario); // Código del beneficiario
    $("#codPersonaEditarBeneficiario").val(codPersona); // Código de la persona
    $("#dniBeneficiarioEditar").val(dni.trim()); // DNI (elimina espacios en blanco)
    $("#nombresBeneficiarioEditar").val(nombres.trim()); // Nombres (elimina espacios en blanco)
    $("#apellidoPaternoBeneficiarioEditar").val(apellidoPaterno.trim()); // Apellido paterno (elimina espacios en blanco)
    $("#apellidoMaternoBeneficiarioEditar").val(apellidoMaterno.trim()); // Apellido materno (elimina espacios en blanco)
    $("#sexoBeneficiarioEditar").val(sexo); // Sexo
    $("#telefonoBeneficiarioEditar").val(telefono.trim()); // Teléfono (elimina espacios en blanco)
    $("#celularBeneficiarioEditar").val(celular.trim()); // Celular (elimina espacios en blanco)
    $("#fechaNacimientoBeneficiarioEditar").val(fechaNacimiento); // Fecha de nacimiento
    $("#edadBeneficiarioEditar").val(edad.trim()); // Edad (elimina espacios en blanco)
    $("#direccionBeneficiarioEditar").val(direccion.trim()); // Dirección (elimina espacios en blanco)
    $("#numeroFincaBeneficiarioEditar").val(numeroFinca != 0 ? numeroFinca : ''); // Número de finca (si es 0, se deja vacío)
    $("#cboClubDeMadresActivosEditar").val(asociacion.trim()); // Asociación (elimina espacios en blanco)
    $("#cboSectorZonaEditarBeneficiario").val(zonaSector); // Zona o sector
    $("#observacionBeneficiarioEditar").val(observaciones); // Observaciones

    // Configura el modal para que no se cierre al hacer clic fuera o presionar Esc
    modalEditar.modal({
        backdrop: 'static', // No se cierra al hacer clic fuera del modal
        keyboard: false // No se cierra al presionar la tecla Esc
    });

    // Muestra el modal
    modalEditar.modal('show');

    // Enfoca el campo DNI cuando el modal se muestra completamente
    modalEditar.one('shown.bs.modal', function () {
        $("#dniBeneficiarioEditar").focus();
    });
});


//actualizar beneficiario
$(document).off("submit", "#editarBeneficiarioForm").on('submit', '#editarBeneficiarioForm', function (e) {
    e.preventDefault();
    const codBeneficiario = Number($.trim($('#codBeneEditar').val()));
    const codPersona = Number($.trim($('#codPersonaEditarBeneficiario').val()));
    const dni = $.trim($('#dniBeneficiarioEditar').val());
    const nombre = $.trim($('#nombresBeneficiarioEditar').val());
    const apellidoPaterno = $.trim($('#apellidoPaternoBeneficiarioEditar').val());
    const apellidoMaterno = $.trim($('#apellidoMaternoBeneficiarioEditar').val());
    const sexo = $.trim($('#sexoBeneficiarioEditar').val());
    const asociacion = Number($.trim($('#cboClubDeMadresActivosEditar').val()));
    const sectorZona = Number($.trim($('#cboSectorZonaEditarBeneficiario').val()));
    const telefono = $.trim($('#telefonoBeneficiarioEditar').val());
    const celular = $.trim($('#celularBeneficiarioEditar').val());
    const fechaNacimiento = $.trim($('#fechaNacimientoBeneficiarioEditar').val());
    const edad = $.trim($('#edadBeneficiarioEditar').val());
    const direccion = $.trim($('#direccionBeneficiarioEditar').val()).toUpperCase();
    const numeroFinca = $.trim($('#numeroFincaBeneficiarioEditar').val());
    const observacion = $.trim($('#observacionBeneficiarioEditar').val());

    if (losCamposBeneficiarioSonValidos(dni, nombre, apellidoPaterno, apellidoMaterno, sexo,
        telefono, celular, fechaNacimiento, edad, sectorZona, direccion, numeroFinca, asociacion)) {
        $.ajax({
            url: './controllers/beneficiario/actualizar.php',
            method: 'POST',
            dataType: 'json',
            data: {
                codBeneficiario, codPersona, dni, nombre, apellidoPaterno, apellidoMaterno, sexo, asociacion,
                sectorZona, telefono, celular, fechaNacimiento, direccion, numeroFinca, observacion
            },
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
                console.error('Error beneficiarios_CRUD.js: ', textStatus, errorThrown);
            }
        })
    }
})

//Detalle del beneficiario





// Ver detalle socio
$(document).off("click", "#btnDetalleBeneficiario").on("click", "#btnDetalleBeneficiario", function (e) {
    e.preventDefault();
    let modalEditar = $("#modalDetalleBeneficiario");
    let fila = $(this).closest("tr");

    let sexo = fila.find('td:eq(3)').text();
    let dni = fila.find('td:eq(8)').text();
    let nombres = fila.find('td:eq(15)').text();
    let apellidoPaterno = fila.find('td:eq(16)').text();
    let apellidoMaterno = fila.find('td:eq(17)').text();
    let telefono = fila.find('td:eq(18)').text();
    let celular = fila.find('td:eq(19)').text();
    let fechaNacimiento = fila.find('td:eq(4)').text();
    fechaNacimientoActual = fila.find('td:eq(4)').text();
    let edad = fila.find('td:eq(7)').text();
    edadActual = fila.find('td:eq(7)').text();
    let direccion = fila.find('td:eq(6)').text();
    let numeroFinca = fila.find('td:eq(20)').text();
    let asociacion = fila.find('td:eq(10)').text();
    let zonaSector = fila.find('td:eq(5)').text();
    let observaciones = fila.find('td:eq(9)').text();
    let abreviaturaEstado = fila.find('td:eq(21)').text();
    


    $("#dniBeneficiarioDetalle").val(dni.trim());
    $("#nombresBeneficiarioDetalle").val(nombres.trim());
    $("#apellidoPaternoBeneficiarioDetalle").val(apellidoPaterno.trim());
    $("#apellidoMaternoBeneficiarioDetalle").val(apellidoMaterno.trim());
    $("#sexoBeneficiarioDetalle").val(sexo);
    $("#telefonoBeneficiarioDetalle").val(telefono.trim());
    $("#celularBeneficiarioDetalle").val(celular.trim());
    $("#fechaNacimientoBeneficiarioDetalle").val(fechaNacimiento);
    $("#edadBeneficiarioDetalle").val(edad.trim());
    $("#direccionBeneficiarioDetalle").val(direccion.trim());
    $("#numeroFincaBeneficiarioDetalle").val(numeroFinca != 0 ? numeroFinca : '');
    $("#cboClubDeMadresActivosDetalle").val(asociacion.trim());
    $("#cboSectorZonaDetalleBeneficiario").val(zonaSector);
    $("#observacionBeneficiarioDetalle").val(observaciones);

    $("#estadoBeneficiarioDetalle").text(abreviaturaEstado == 'a' ? 'Activo' : 'Inactivo')
    $("#estadoBeneficiarioDetalle").addClass(abreviaturaEstado == 'a' ? 'active' : 'inactive')


    modalEditar.modal({
        backdrop: 'static',
        keyboard: false
    });

    modalEditar.modal('show');

    modalEditar.one('shown.bs.modal', function () {
        $("#dniBeneficiarioEditar").focus();
    });
});





    // Deshabilitar un beneficiario
    $(document).off("click", "#btnDeshabilitarBeneficiario").on("click", "#btnDeshabilitarBeneficiario", function (e) {
        e.preventDefault();
        let fila = $(this).closest("tr");
        let nombres = fila.find('td:eq(2)').text();

        Swal.fire({
            icon: "warning",
            title: "¡Advertencia!",
            text: "¿Seguro que desea inhabilitar al beneficiario " + nombres + "?",
            width: "350px",
            showCancelButton: true,
            confirmButtonColor: "#13252E",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí",
            cancelButtonText: "No"
        }).then((result) => {
            if (result.isConfirmed) {
                let fila = $(this).closest("tr");
                let codBeneficiario = Number(fila.find('td:eq(0)').text());
                console.log(codBeneficiario);

                $.ajax({
                    url: './controllers/beneficiario/inhabilitar.php',
                    method: 'POST',
                    dataType: 'json',
                    data: {codBeneficiario},
                    success: function (response) {
                        console.log(response)
                        const {code, message, info, data} = response;

                        if (code === 200) {
                            Swal.fire({
                                icon: "success",
                                title: "¡Éxito!",
                                text: message
                            }).then(() => {
                                listarBeneficiarios()
                            });
                        }

                        if (code === 500) {
                            showErrorInternalServer(message, info)
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error('Error beneficiarios_CRUD.js: ', textStatus, errorThrown);
                    }
                })
            }

        })

    });

    

    // Habilitar un beneficiario
    $(document).off("click", "#btnHabilitarBeneficiario").on("click", "#btnHabilitarBeneficiario", function (e) {
        e.preventDefault();
        let fila = $(this).closest("tr");
        let nombres = fila.find('td:eq(2)').text();

        Swal.fire({
            icon: "warning",
            title: "¡Advertencia!",
            text: "¿Seguro que desea habilitar al beneficiario " + nombres + "?",
            width: "350px",
            showCancelButton: true,
            confirmButtonColor: "#13252E",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí",
            cancelButtonText: "No"
        }).then((result) => {
            if (result.isConfirmed) {
                let fila = $(this).closest("tr");
                let codBeneficiario = Number(fila.find('td:eq(0)').text());
                console.log(codBeneficiario);

                $.ajax({
                    url: './controllers/beneficiario/habilitar.php',
                    method: 'POST',
                    dataType: 'json',
                    data: {codBeneficiario},
                    success: function (response) {
                        console.log(response)
                        const {code, message, info, data} = response;

                        if (code === 200) {
                            Swal.fire({
                                icon: "success",
                                title: "¡Éxito!",
                                text: message
                            }).then(() => {
                                listarBeneficiarios()
                            });
                        }

                        if (code === 500) {
                            showErrorInternalServer(message, info)
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error('Error beneficiarios_CRUD.js: ', textStatus, errorThrown);
                    }
                })
            }

        })

    });
})