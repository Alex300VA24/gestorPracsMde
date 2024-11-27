$(document).ready(function () {

    let dniOApellidosNombres;
    let codAsociacion;

    let optionSelected = 0

    let tiposBeneficio = [];

    let beneficiarios = [];

    let fechaNacimientoActual;
    let edadActual;

    const inputFechaSocio = document.querySelector('#fechaNacimientoSocioRegistro');
    const inputFechaBeneficiario = document.querySelector('#fechaNacimientoBeneficiarioRegistro');
    const fechaActual = new Date();
    // fechaActual.setHours(fechaActual.getHours() - 5);
    const fechaFormateada = fechaActual.toISOString().split('T')[0]; // Formatea la fecha como 'YYYY-MM-DD'
    inputFechaSocio.setAttribute('max', fechaFormateada);
    inputFechaBeneficiario.setAttribute('max', fechaFormateada);

    listarSocios(dniOApellidosNombres, codAsociacion);

    function listarSocios(dniOApellidosNombres, codAsociacion) {
        $.ajax({
            url: './controllers/socio/listar.php',
            method: 'GET',
            dataType: 'json',
            data: {dniOApellidosNombres, codAsociacion},
            success: function (response) {
                console.log(response)
                const {code, message, info, data} = response;

                if (code === 200) {
                    let row = '';
                    if (data && Array.isArray(data) && data.length > 0) {
                        row = data.map(({
                                            codSocio, codPersona, nombres, apellidoPaterno,
                                            apellidoMaterno, sexo, fechaNacimiento, codSectorZona,
                                            telefono, celular, numeroFinca,
                                            direccion, aniosNacido, dni, observaciones, codAsociacion,
                                            nombreAsociacion, cargo, fechaInicio, fechaFin, abreviatura, estado
                                        }) => {
                            return `
                                <tr>
                                    <td>${codSocio}</td>
                                    <td hidden="hidden">${codPersona}</td>
                                    <td>${apellidoPaterno + ' ' + apellidoMaterno + ' ' + nombres}</td>                                   
                                    <td hidden="hidden">${sexo}</td>                                   
                                    <td hidden="hidden">${fechaNacimiento}</td>                                   
                                    <td hidden="hidden">${codSectorZona}</td>                                   
                                    <td hidden="hidden">${direccion}</td>                                                                                                       
                                    <td>${aniosNacido}</td>                                                                                                       
                                    <td>${dni}</td>                                                                                                       
                                    <td hidden="hidden">${observaciones}</td>                                                                                                       
                                    <td hidden="hidden">${codAsociacion}</td>                                                                                                       
                                    <td >${nombreAsociacion}</td>                                                                                                       
                                    <td >${cargo ? cargo : ''}</td>                                                                                                       
                                    <td >${fechaInicio.split(' ')[0]}</td>                                                                                                                                                                                                                                                 
                                    <td >${fechaFin ? fechaFin.split(' ')[0] : ''}</td>                                   
                                    <td hidden="hidden">${nombres}</td>                                   
                                    <td hidden="hidden">${apellidoPaterno}</td>                                   
                                    <td hidden="hidden">${apellidoMaterno}</td>                                   
                                    <td hidden="hidden">${telefono}</td>                                   
                                    <td hidden="hidden">${celular}</td>                                   
                                    <td hidden="hidden">${numeroFinca}</td>                                   
                                    <td hidden="hidden">${abreviatura}</td>                                   
                                    <td>
                                        <span class="estado ${abreviatura === "a" ? 'active' : 'inactive'}">
                                            ${estado}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="actions actions_socios">     
                                            ${abreviatura == 'a' ?
                                `<img id="btnEditarSocio" class="action" src="./assets/icons/action_edit.svg">
                                            <img id="btnDetalleSocio" class="action" src="./assets/icons/action_ver_detalle.svg">
                                            <img id="btnBeneficiariosSocio" class="action" src="./assets/icons/action_ver_beneficiarios.svg">
                                            <img class="action" src="./assets/icons/action_agregar_beneficiario.svg">
                                            <img class="action" src="./assets/icons/action_deshabilitar.svg">
                                            ` : ''}                                            
                                        </div>
                                    </td>
                                </tr>
                            `
                        })
                        $("#listaSocios").html(row)
                    } else {
                        row = `<tr><td colspan="10">Aún no existen socios en el sistema</td></tr>`
                    }
                    $("#listaSocios").html(row)
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


    //     nuevo socio y beneficiarios - abrir modal
    $(document).off("click", "#btnNuevoSocio").on("click", "#btnNuevoSocio", function (e) {
        e.preventDefault();
        beneficiarios = []
        let modalRegistrar = $("#modalRegistrarSocioYBeneficiarios");
        $("#registrarSocioYBeneficiarioForm").trigger("reset");
        $("#fechaInicioSocioRegistro").val(fechaFormateada)

        modalRegistrar.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalRegistrar.modal('show');

        modalRegistrar.one('shown.bs.modal', function () {
            $("#dniSocioRegistro").focus();
        });
    });

    //     registrar socios y beneficiarios
    $(document).off("submit", "#registrarSocioYBeneficiarioForm").on('submit', '#registrarSocioYBeneficiarioForm', function (e) {
        e.preventDefault();
        const dniSocio = $.trim($('#dniSocioRegistro').val());
        const nombresSocio = $.trim($('#nombresSocioRegistro').val());
        const apellidoPaternoSocio = $.trim($('#apellidoPaternoSocioRegistro').val());
        const apellidoMaternoSocio = $.trim($('#apellidoMaternoSocioRegistro').val());
        const sexoSocio = $.trim($('#sexoSocioRegistro').val());
        const telefonoSocio = $.trim($('#telefonoSocioRegistro').val());
        const celularSocio = $.trim($('#celularSocioRegistro').val());
        const fechaNacimientoSocio = $.trim($('#fechaNacimientoSocioRegistro').val());
        const edadSocio = $.trim($('#edadSocioRegistro').val());
        const sectorZonaSocio = $.trim($('#cboSectorZonaRegistroSocio').val());
        const direccionSocio = $.trim($('#direccionSocioRegistro').val());
        const numeroFincaSocio = $.trim($('#numeroFincaSocioRegistro').val());
        const asociacionSocio = $.trim($('#cboClubDeMadresActivos').val());
        const observacionesSocio = $.trim($('#observacionSocioRegistro').val());
        const esSocioBeneficiario = parseInt($('input[name="optionSocioBeneficiario"]:checked').val());

        let parentesco
        let tipoBeneficio
        let talla
        let peso
        let hmg
        let fechaUltimaMestruacion
        let fechaProbableParto
        let fechaParto
        let fechaFinLactancia


        if (losCamposSocioSonValidos(dniSocio, nombresSocio, apellidoPaternoSocio, apellidoMaternoSocio, sexoSocio, telefonoSocio,
            celularSocio, fechaNacimientoSocio, edadSocio, sectorZonaSocio, direccionSocio, numeroFincaSocio, asociacionSocio,
            observacionesSocio)) {

            if (beneficiarios.length == 0) {
                Swal.fire({
                    title: "¡Advertencia!",
                    text: 'El socio debe contar con beneficiarios o él mismo debe ser un beneficiario.',
                    icon: "warning",
                    width: "350px",
                    confirmButtonColor: "#13252E",
                });
                return;
            }

            if (esSocioBeneficiario === 1) {
                beneficiarios = beneficiarios.filter(beneficiario => {
                    if (beneficiario.dni === dniSocio) {
                        parentesco = beneficiario.parentesco
                        tipoBeneficio = beneficiario.tipoBeneficio
                        talla = beneficiario.talla
                        peso = beneficiario.peso
                        hmg = beneficiario.hmg
                        fechaUltimaMestruacion = beneficiario.fechaUltimaMestruacion
                        fechaProbableParto = beneficiario.fechaProbableParto
                        fechaParto = beneficiario.fechaParto
                        fechaFinLactancia = beneficiario.fechaFinLactancia
                    }

                    return beneficiario.dni != dniSocio
                })
            }

            $.ajax({
                url: './controllers/socio/registrarSocioYBeneficiarios.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    dniSocio,
                    nombresSocio,
                    apellidoPaternoSocio,
                    apellidoMaternoSocio,
                    sexoSocio,
                    telefonoSocio,
                    celularSocio,
                    fechaNacimientoSocio,
                    sectorZonaSocio,
                    direccionSocio,
                    numeroFincaSocio,
                    asociacionSocio,
                    observacionesSocio,
                    esSocioBeneficiario,
                    parentesco,
                    tipoBeneficio,
                    talla,
                    peso,
                    hmg,
                    fechaUltimaMestruacion,
                    fechaProbableParto,
                    fechaParto,
                    fechaFinLactancia,
                    beneficiarios
                },
                success: function (response) {
                    console.log(response)
                    const {code, message, info, data} = response;

                    if (code === 200) {
                        showSuccessAlert(message);
                    }

                    if (code === 500) {
                        showErrorInternalServer(message, info)
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error socios_CRUD.js: ', textStatus, errorThrown);
                }
            })
        }
    })

    // editar socio
    $(document).off("click", "#btnEditarSocio").on("click", "#btnEditarSocio", function (e) {
        e.preventDefault();
        let modalEditar = $("#modalEditarSocio");
        let fila = $(this).closest("tr");

        let codSocio = fila.find('td:eq(0)').text();
        let codPersona = fila.find('td:eq(1)').text();
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


        $("#codSocioEditar").val(codSocio);
        $("#codPersonaEditarSocio").val(codPersona);

        $("#dniSocioEditar").val(dni.trim());
        $("#nombresSocioEditar").val(nombres.trim());
        $("#apellidoPaternoSocioEditar").val(apellidoPaterno.trim());
        $("#apellidoMaternoSocioEditar").val(apellidoMaterno.trim());
        $("#sexoSocioEditar").val(sexo);
        $("#telefonoSocioEditar").val(telefono.trim());
        $("#celularSocioEditar").val(celular.trim());
        $("#fechaNacimientoSocioEditar").val(fechaNacimiento);
        $("#edadSocioEditar").val(edad.trim());
        $("#direccionSocioEditar").val(direccion.trim());
        $("#numeroFincaSocioEditar").val(numeroFinca != 0 ? numeroFinca : '');
        $("#cboClubDeMadresActivosEditar").val(asociacion.trim());
        $("#cboSectorZonaEditarSocio").val(zonaSector);
        $("#observacionSocioEditar").val(observaciones);

        modalEditar.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalEditar.modal('show');

        modalEditar.one('shown.bs.modal', function () {
            $("#dniSocioEditar").focus();
        });
    });

    // Actualizar socio
    $(document).off("submit", "#editarSocioForm").on('submit', '#editarSocioForm', function (e) {
        e.preventDefault();
        const codSocio = Number($.trim($('#codSocioEditar').val()));
        const codPersona = Number($.trim($('#codPersonaEditarSocio').val()));
        const dni = $.trim($('#dniSocioEditar').val());
        const nombre = $.trim($('#nombresSocioEditar').val());
        const apellidoPaterno = $.trim($('#apellidoPaternoSocioEditar').val());
        const apellidoMaterno = $.trim($('#apellidoMaternoSocioEditar').val());
        const sexo = $.trim($('#sexoSocioEditar').val());
        const asociacion = Number($.trim($('#cboClubDeMadresActivosEditar').val()));
        const sectorZona = Number($.trim($('#cboSectorZonaEditarSocio').val()));
        const telefono = $.trim($('#telefonoSocioEditar').val());
        const celular = $.trim($('#celularSocioEditar').val());
        const fechaNacimiento = $.trim($('#fechaNacimientoSocioEditar').val());
        const edad = $.trim($('#edadSocioEditar').val());
        const direccion = $.trim($('#direccionSocioEditar').val()).toUpperCase();
        const numeroFinca = $.trim($('#numeroFincaSocioEditar').val());
        const observacion = $.trim($('#observacionSocioEditar').val());

        if (losCamposSocioSonValidos(dni, nombre, apellidoPaterno, apellidoMaterno, sexo,
            telefono, celular, fechaNacimiento, edad, sectorZona, direccion, numeroFinca, asociacion)) {
            $.ajax({
                url: './controllers/socio/actualizar.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    codSocio, codPersona, dni, nombre, apellidoPaterno, apellidoMaterno, sexo, asociacion,
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
                    console.error('Error socios_CRUD.js: ', textStatus, errorThrown);
                }
            })
        }
    })

    // Ver detalle socio
    $(document).off("click", "#btnDetalleSocio").on("click", "#btnDetalleSocio", function (e) {
        e.preventDefault();
        let modalEditar = $("#modalDetalleSocio");
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


        $("#dniSocioDetalle").val(dni.trim());
        $("#nombresSocioDetalle").val(nombres.trim());
        $("#apellidoPaternoSocioDetalle").val(apellidoPaterno.trim());
        $("#apellidoMaternoSocioDetalle").val(apellidoMaterno.trim());
        $("#sexoSocioDetalle").val(sexo);
        $("#telefonoSocioDetalle").val(telefono.trim());
        $("#celularSocioDetalle").val(celular.trim());
        $("#fechaNacimientoSocioDetalle").val(fechaNacimiento);
        $("#edadSocioDetalle").val(edad.trim());
        $("#direccionSocioDetalle").val(direccion.trim());
        $("#numeroFincaSocioDetalle").val(numeroFinca != 0 ? numeroFinca : '');
        $("#cboClubDeMadresActivosDetalle").val(asociacion.trim());
        $("#cboSectorZonaDetalleSocio").val(zonaSector);
        $("#observacionSocioDetalle").val(observaciones);

        $("#estadoSocioDetalle").text(abreviaturaEstado == 'a' ? 'Activo' : 'Inactivo')
        $("#estadoSocioDetalle").addClass(abreviaturaEstado == 'a' ? 'active' : 'inactive')


        modalEditar.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalEditar.modal('show');

        modalEditar.one('shown.bs.modal', function () {
            $("#dniSocioEditar").focus();
        });
    });

    // Ver Beneficiarios del socio
    $(document).off("click", "#btnBeneficiariosSocio").on("click", "#btnBeneficiariosSocio", function (e) {
        e.preventDefault();

        let fila = $(this).closest("tr");

        let codSocio = fila.find('td:eq(0)').text();

        $.ajax({
            url: './controllers/socio/buscarBeneficiarios.php',
            method: 'GET',
            dataType: 'json',
            data: {codSocio},
            success: function (response) {
                const {code, message, info, data} = response;

                $("#nombreSocioVerBeneficiarios").text(data[0]['apellidoPaternoSocio'] + ' ' + data[0]['apellidoMaternoSocio'] + ' ' + data[0]['nombresSocio'])
                $("#dniSocioVerBeneficiarios").text(data[0]['dniSocio'])

                if (code === 200) {

                    console.log(data)
                    let cardBeneficiario = data.map(beneficiario => {

                        const { dniBeneficiario, nombresBeneficiario, apellidoPaternoBeneficiario,
                            apellidoMaternoBeneficiario, aniosNacidoBeneficiario, prioridadBeneficiario,
                            parentescoBeneficiario, tallaBeneficiario, pesoBeneficiario, hmgBeneficiario,
                            estadoAbreviatura, tipoBeneficioBeneficiario, sexoBeneficiario } = beneficiario;

                        return `
                        <div class="card-beneficiario ${
                            tipoBeneficioBeneficiario.includes("niño") && sexoBeneficiario == 'm' ? 'card-boy' :
                                tipoBeneficioBeneficiario.includes("niño") && sexoBeneficiario == 'f' ? 'card-girl'
                                    : parentescoBeneficiario.includes("Socio") ? 'card-socio' : ''
                        } card-girl">
                        
                            ${tipoBeneficioBeneficiario.includes('niño') && sexoBeneficiario == 'f' ?
                            `<img src="./assets/icons/icon_girl.svg">`
                            : ``}
                        
                            ${tipoBeneficioBeneficiario.includes('niño') && sexoBeneficiario == 'm' ?
                             `<img src="./assets/icons/icon_boy.svg">`
                                : ``}
                            
                            ${tipoBeneficioBeneficiario.includes('mayor') && sexoBeneficiario == 'm' ?
                            `<img src="./assets/icons/icon_old-man.svg">`
                            : ``}
                            
                            ${tipoBeneficioBeneficiario.includes('mayor') && sexoBeneficiario == 'f' ?
                            `<img src="./assets/icons/icon-old-woman.svg">`
                            : ``}
                            
                            ${tipoBeneficioBeneficiario.includes('madre') ?
                            `<img src="./assets/icons/icon-woman.svg">`
                            : ``}
                            
                            <div class="data">
                                <div>
                                    <span>DNI:</span>
                                    <span>${dniBeneficiario}</span>
                                </div>
                                <div>
                                    <span>Nombres:</span>
                                    <span>${apellidoPaternoBeneficiario + ' ' + apellidoMaternoBeneficiario + ' ' + nombresBeneficiario }</span>
                                </div>
                                <div>
                                    <span>Edad:</span>
                                    <span>${aniosNacidoBeneficiario}</span>
                                </div>                                
                                <div>
                                    <span>Tipo de Beneficio:</span>
                                    <span>${tipoBeneficioBeneficiario}</span>
                                </div>
                                <div>
                                    <span>Prioridad:</span>
                                    <span>${prioridadBeneficiario == 1 ? 'primera' : 'segunda'}</span>
                                </div>
                                <div>
                                    <span>Parentesco:</span>
                                    <span>${parentescoBeneficiario}</span>
                                </div>
                                <div class="datos-salud">
                                    <div>
                                        <span>Talla:</span>
                                        <span>${tallaBeneficiario ? tallaBeneficiario + 'cm'  : ''}</span>
                                    </div>
                                    <div>
                                        <span>Peso:</span>
                                        <span>${pesoBeneficiario ? pesoBeneficiario + 'kg' : ''}</span>
                                    </div>
                                    <div>
                                        <span>Hmg:</span>
                                        <span>${hmgBeneficiario ? hmgBeneficiario : ''}</span>
                                    </div>
                                </div>
                                <div class="card-estado">
                                    <span>Estado:</span>
                                    <span class="estado estadoDetalle ${estadoAbreviatura === 'a' ? 'active' : 'inactive'}" >
                                     ${estadoAbreviatura === "a" ? 'activo' : 'inactivo'}
                                    </span>
                                </div>
                            </div>
                        </div>
                        `
                    })

                    $("#beneficiarios").html(cardBeneficiario)
                }

                if (code === 500) {
                    showErrorInternalServer(message, info)
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error socios_CRUD.js: ', textStatus, errorThrown);
            }
        })


        let modalEditar = $("#modalBeneficiariosSocio");


        modalEditar.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalEditar.modal('show');
    });

    $(document).off("input", "#dniSocioRegistro").on("input", "#dniSocioRegistro", function (e) {
        if (optionSelected === 1) {
            $("#dniBeneficiarioRegistro").val($(this).val());
        }
    })

    $(document).off("input", "#dniSocioRegistro").on("input", "#dniSocioRegistro", function (e) {
        if (optionSelected === 1) {
            $("#dniBeneficiarioRegistro").val($(this).val());
        }
    })

    $(document).off("input", "#nombresSocioRegistro").on("input", "#nombresSocioRegistro", function (e) {
        if (optionSelected === 1) {
            $("#nombresBeneficiarioRegistro").val($(this).val());
        }
    })

    $(document).off("input", "#apellidoPaternoSocioRegistro").on("input", "#apellidoPaternoSocioRegistro", function (e) {
        if (optionSelected === 1) {
            $("#apellidoPaternoBeneficiarioRegistro").val($(this).val());
        }
    })

    $(document).off("input", "#apellidoMaternoSocioRegistro").on("input", "#apellidoMaternoSocioRegistro", function (e) {
        if (optionSelected === 1) {
            $("#apellidoMaternoBeneficiarioRegistro").val($(this).val());
        }
    })

    $(document).off("input", "#sexoSocioRegistro").on("input", "#sexoSocioRegistro", function (e) {
        if (optionSelected === 1) {
            $("#sexoBeneficiarioRegistro").val($(this).val());
        }
    })

    $(document).off("input", "#telefonoSocioRegistro").on("input", "#telefonoSocioRegistro", function (e) {
        if (optionSelected === 1) {
            $("#telefonoBeneficiarioRegistro").val($(this).val());
        }
    })

    $(document).off("input", "#celularSocioRegistro").on("input", "#celularSocioRegistro", function (e) {
        if (optionSelected === 1) {
            $("#celularBeneficiarioRegistro").val($(this).val());
        }
    })

    $(document).off("input", "#fechaNacimientoSocioRegistro").on("input", "#fechaNacimientoSocioRegistro", function (e) {

        let edad = calcularEdad($(this).val(), fechaActual)
        $("#edadSocioRegistro").val(edad);

        if (optionSelected === 1) {
            $("#fechaNacimientoBeneficiarioRegistro").val($(this).val());
            $("#edadBeneficiarioRegistro").val($("#edadSocioRegistro").val());
        }
    })

    // calcular edad para editar un socio
    $(document).off("input", "#fechaNacimientoSocioEditar").on("input", "#fechaNacimientoSocioEditar", function (e) {
        let edad = calcularEdad($(this).val(), fechaActual)
        console.log(edad)
        if (edad >= 18) {
            $("#edadSocioEditar").val(edad);
        } else {
            Swal.fire({
                title: "¡Advertencia!",
                text: 'Edad no válida, el socio debe ser mayor de edad',
                icon: "warning",
                width: "350px",
                confirmButtonColor: "#13252E",
            });

            $("#fechaNacimientoSocioEditar").val(fechaNacimientoActual)
            $("#edadSocioEditar").val(edadActual)
        }
    })

    $(document).off("input", "#cboSectorZonaRegistroSocio").on("input", "#cboSectorZonaRegistroSocio", function (e) {
        if (optionSelected === 1) {
            $("#cboSectorZonaRegistroBeneficiario").val($(this).val());
        }
    })

    $(document).off("input", "#direccionSocioRegistro").on("input", "#direccionSocioRegistro", function (e) {
        if (optionSelected === 1) {
            $("#direccionBeneficiarioRegistro").val($(this).val());
        }
    })

    $(document).off("input", "#numeroFincaSocioRegistro").on("input", "#numeroFincaSocioRegistro", function (e) {
        if (optionSelected === 1) {
            $("#numeroFincaBeneficiarioRegistro").val($(this).val());
        }
    })

    // Socio es beneficiario
    $("input[name=optionSocioBeneficiario]").change(function () {
        optionSelected = $(this).val();
        optionSelected = Number(optionSelected)

        if (optionSelected === 0) { // no es socio y beneficiario
            llenarCboTiposBeneficioBeneficiario()

            //     Ocultar inputs de madres
            $(".boxFum").prop("hidden", true)
            $(".boxFechaProbableParto").prop("hidden", true)

            $(".boxFechaParto").prop("hidden", true)
            $(".boxFechaFin").prop("hidden", true)

            //limpiar campos
            $("#dniBeneficiarioRegistro").val("");
            $("#nombresBeneficiarioRegistro").val("");
            $("#apellidoPaternoBeneficiarioRegistro").val("");
            $("#apellidoMaternoBeneficiarioRegistro").val("");
            $("#sexoBeneficiarioRegistro").val(0);
            $("#telefonoBeneficiarioRegistro").val("");
            $("#celularBeneficiarioRegistro").val("");
            $("#fechaNacimientoBeneficiarioRegistro").val("");
            $("#cboSectorZonaRegistroBeneficiario").val(0);
            $("#direccionBeneficiarioRegistro").val("");
            $("#numeroFincaBeneficiarioRegistro").val("");
            $("#cboParentescoRegistroBeneficiario").val(0);


            // habilitar campos
            $("#dniBeneficiarioRegistro").prop("disabled", false).removeClass("colorDisable")
            $("#nombresBeneficiarioRegistro").prop("disabled", false).removeClass("colorDisable")
            $("#apellidoPaternoBeneficiarioRegistro").prop("disabled", false).removeClass("colorDisable")
            $("#apellidoMaternoBeneficiarioRegistro").prop("disabled", false).removeClass("colorDisable")
            $("#sexoBeneficiarioRegistro").prop("disabled", false).removeClass("colorDisable")
            $("#telefonoBeneficiarioRegistro").prop("disabled", false).removeClass("colorDisable")
            $("#celularBeneficiarioRegistro").prop("disabled", false).removeClass("colorDisable")
            $("#fechaNacimientoBeneficiarioRegistro").prop("disabled", false).removeClass("colorDisable")
            $("#cboSectorZonaRegistroBeneficiario").prop("disabled", false).removeClass("colorDisable")
            $("#direccionBeneficiarioRegistro").prop("disabled", false).removeClass("colorDisable")
            $("#numeroFincaBeneficiarioRegistro").prop("disabled", false).removeClass("colorDisable")
            $("#cboParentescoRegistroBeneficiario").prop("disabled", false).removeClass("colorDisable")


        } else { // es socio y beneficiario
            llenarCboTiposBeneficioSocio()

            // duplicar campos de socio a beneficiario
            $("#dniBeneficiarioRegistro").val($("#dniSocioRegistro").val());
            $("#nombresBeneficiarioRegistro").val($("#nombresSocioRegistro").val());
            $("#apellidoPaternoBeneficiarioRegistro").val($("#apellidoPaternoSocioRegistro").val());
            $("#apellidoMaternoBeneficiarioRegistro").val($("#apellidoMaternoSocioRegistro").val());
            $("#sexoBeneficiarioRegistro").val($("#sexoSocioRegistro").val());
            $("#telefonoBeneficiarioRegistro").val($("#telefonoSocioRegistro").val());
            $("#celularBeneficiarioRegistro").val($("#celularSocioRegistro").val());
            $("#fechaNacimientoBeneficiarioRegistro").val($("#fechaNacimientoSocioRegistro").val());
            $("#edadBeneficiarioRegistro").val($("#edadSocioRegistro").val());
            $("#cboSectorZonaRegistroBeneficiario").val($("#cboSectorZonaRegistroSocio").val());
            $("#direccionBeneficiarioRegistro").val($("#direccionSocioRegistro").val());
            $("#numeroFincaBeneficiarioRegistro").val($("#numeroFincaSocioRegistro").val());
            $("#cboParentescoRegistroBeneficiario option").each(function () {
                if ($(this).text() === "socio" || $(this).text() === "Socio") {
                    $(this).prop("selected", true);
                }
            });


            // deshabilitar input de beneficiarios
            $("#dniBeneficiarioRegistro").prop("disabled", true).addClass("colorDisable")
            $("#nombresBeneficiarioRegistro").prop("disabled", true).addClass("colorDisable")
            $("#apellidoPaternoBeneficiarioRegistro").prop("disabled", true).addClass("colorDisable")
            $("#apellidoMaternoBeneficiarioRegistro").prop("disabled", true).addClass("colorDisable")
            $("#sexoBeneficiarioRegistro").prop("disabled", true).addClass("colorDisable")
            $("#telefonoBeneficiarioRegistro").prop("disabled", true).addClass("colorDisable")
            $("#celularBeneficiarioRegistro").prop("disabled", true).addClass("colorDisable")
            $("#fechaNacimientoBeneficiarioRegistro").prop("disabled", true).addClass("colorDisable")
            $("#cboSectorZonaRegistroBeneficiario").prop("disabled", true).addClass("colorDisable")
            $("#direccionBeneficiarioRegistro").prop("disabled", true).addClass("colorDisable")
            $("#numeroFincaBeneficiarioRegistro").prop("disabled", true).addClass("colorDisable")
            $("#cboParentescoRegistroBeneficiario").prop("disabled", true).addClass("colorDisable")

            //     Ocultar inputs de madres
            $(".boxFum").prop("hidden", true)
            $(".boxFechaProbableParto").prop("hidden", true)

            $(".boxFechaParto").prop("hidden", true)
            $(".boxFechaFin").prop("hidden", true)
        }

        // });
    });

    function llenarCboTiposBeneficioSocio() {
        if (tiposBeneficio.length == 0) {
            $("#cboTipoBeneficioRegistroBeneficiario option").each(function () {
                tiposBeneficio.push({value: $(this).val(), text: $(this).text()});
            })
        }

        const optionsSocio = tiposBeneficio.filter(tipo => {
            return !tipo.text.includes('niño')
        })

        let optionsSelect = optionsSocio.map(option => {
            return `<option value="${option.value}">${option.text}</option>`
        })

        $("#cboTipoBeneficioRegistroBeneficiario").html(optionsSelect)
    }


    function llenarCboTiposBeneficioBeneficiario() {
        if (tiposBeneficio.length == 0) {
            $("#cboTipoBeneficioRegistroBeneficiario option").each(function () {
                tiposBeneficio.push({value: $(this).val(), text: $(this).text()});
            })
        }
        //
        //     const optionsBeneficiario = tiposBeneficio.filter(tipo => {
        //         console.log(!tipo.text.includes('madre'))
        //         return !tipo.text.includes('madre') && !tipo.text.includes('adulto')
        //     })
        //
        //     let optionsSelect = optionsBeneficiario.map(option => {
        let optionsSelect = tiposBeneficio.map(option => {
            return `<option value="${option.value}">${option.text}</option>`
        })
        //
        $("#cboTipoBeneficioRegistroBeneficiario").html(optionsSelect)
    }

    $(document).off("input", "#fechaNacimientoBeneficiarioRegistro").on("input", "#fechaNacimientoBeneficiarioRegistro", function (e) {
        let edad = calcularEdad($(this).val(), fechaActual)
        $("#edadBeneficiarioRegistro").val(edad);
    })

    $(document).on('selectTiposBeneficioLlenado', function () {
        llenarCboTiposBeneficioBeneficiario();
    });

    // Mostrar inputs en base al Tipo de beneficio (madre gestante y madre lactante)
    $(document).off("input", "#cboTipoBeneficioRegistroBeneficiario").on("input", "#cboTipoBeneficioRegistroBeneficiario", function (e) {
        let optionBeneficio = $(this).find("option:selected").text();

        if (optionBeneficio.includes("gestante")) {
            $("#fumBeneficiarioRegistro").val('')
            $("#fechaProbableDePartoBeneficiarioRegistro").val('')

            $(".boxFum").prop("hidden", false)
            $(".boxFechaProbableParto").prop("hidden", false)
        } else {
            $(".boxFum").prop("hidden", true)
            $(".boxFechaProbableParto").prop("hidden", true)
        }

        if (optionBeneficio.includes("lactante")) {
            $("#fechaPartoBeneficiarioRegistro").val('')
            $("#fechaFinBeneficiarioRegistro").val('')

            $(".boxFechaParto").prop("hidden", false)
            $(".boxFechaFin").prop("hidden", false)
        } else {
            $(".boxFechaParto").prop("hidden", true)
            $(".boxFechaFin").prop("hidden", true)
        }
    })


    // cambiar fecha de parto probable
    $(document).off("change", "#fumBeneficiarioRegistro").on("change", "#fumBeneficiarioRegistro", function (e) {
        calculateFechaProbableParto()
    })

    // cambiar fecha de fin de madre lactante
    $(document).off("change", "#fechaPartoBeneficiarioRegistro").on("change", "#fechaPartoBeneficiarioRegistro", function (e) {
        calculateFechaFinMadreLactante()
    })

    // Calcular fecha probable de parto
    function calculateFechaProbableParto() {
        let fechaDeUltimaMestruacion = new Date($("#fumBeneficiarioRegistro").val());
        let fechaProbableDeParto = new Date(fechaDeUltimaMestruacion);
        fechaProbableDeParto.setMonth(fechaProbableDeParto.getMonth() + 9);
        fechaProbableDeParto = fechaProbableDeParto.toISOString().split('T')[0];
        $("#fechaProbableDePartoBeneficiarioRegistro").val(fechaProbableDeParto);
    }

    // calcular fecha fin de madre lactante (cuando el niño cumple 2 años)
    function calculateFechaFinMadreLactante() {
        let fechaParto = new Date($("#fechaPartoBeneficiarioRegistro").val());
        fechaParto.setFullYear(fechaParto.getFullYear() + 2);
        fechaParto = fechaParto.toISOString().split('T')[0];
        $("#fechaFinBeneficiarioRegistro").val(fechaParto);
    }


    function calcularEdad(fechaNacimiento, fechaActual) {
        const fechaNac = new Date(`${fechaNacimiento}T00:00:00`);

        let edad = fechaActual.getFullYear() - fechaNac.getFullYear();
        const mes = fechaActual.getMonth() - fechaNac.getMonth();

        if (mes < 0 || (mes === 0 && fechaActual.getDate() < fechaNac.getDate())) {
            edad--;
        }

        return edad;
    }

//     agregar beneficiarios al detalle
    $(document).off("click", "#btnAgregarBeneficiario").on("click", "#btnAgregarBeneficiario", function (e) {
        let dni = $("#dniBeneficiarioRegistro").val();
        let nombres = $("#nombresBeneficiarioRegistro").val();
        let apellidoPaterno = $("#apellidoPaternoBeneficiarioRegistro").val();
        let apellidoMaterno = $("#apellidoMaternoBeneficiarioRegistro").val();
        let sexo = $("#sexoBeneficiarioRegistro").val();
        let telefono = $("#telefonoBeneficiarioRegistro").val();
        let celular = $("#celularBeneficiarioRegistro").val();
        let fechaNacimiento = $("#fechaNacimientoBeneficiarioRegistro").val();
        let edad = $("#edadBeneficiarioRegistro").val();
        let sectorYZona = $("#cboSectorZonaRegistroBeneficiario").val();
        let direccion = $("#direccionBeneficiarioRegistro").val();
        let numeroFinca = $("#numeroFincaBeneficiarioRegistro").val();
        let parentesco = $("#cboParentescoRegistroBeneficiario").val();
        let parentescoTexto = $("#cboParentescoRegistroBeneficiario option:selected").text();
        let tipoBeneficio = Number($("#cboTipoBeneficioRegistroBeneficiario").val());

        let fechaUltimaMestruacion = $("#fumBeneficiarioRegistro").val();
        let fechaProbableParto = $("#fechaProbableDePartoBeneficiarioRegistro").val();

        let fechaParto = $("#fechaPartoBeneficiarioRegistro").val();
        let fechaFinLactancia = $("#fechaFinBeneficiarioRegistro").val();

        let tipoBeneficioTexto = $("#cboTipoBeneficioRegistroBeneficiario option:selected").text();

        let asociacion = $("#cboClubDeMadresActivos").val();

        let peso = $("#pesoBeneficiarioRegistro").val();
        let talla = $("#tallaBeneficiarioRegistro").val();
        let hmg = $("#hmgBeneficiarioRegistro").val();

        if (losCamposBeneficiarioSonValidos(dni, nombres, apellidoMaterno, apellidoPaterno, sexo, telefono, celular,
            fechaNacimiento, edad, sectorYZona, direccion, numeroFinca, parentesco, tipoBeneficio, tipoBeneficioTexto,
            fechaUltimaMestruacion, fechaProbableParto, fechaParto, fechaFinLactancia, peso, talla, hmg, asociacion)) {

            beneficiarios = [...beneficiarios, {
                dni, nombres, apellidoPaterno, apellidoMaterno, sexo, telefono, celular,
                fechaNacimiento, edad, sectorYZona, direccion, numeroFinca, parentesco, parentescoTexto,
                tipoBeneficio, tipoBeneficioTexto, fechaUltimaMestruacion, fechaProbableParto, fechaParto,
                fechaFinLactancia, peso, talla, hmg
            }]

            limpiarFormularioBeneficiario()


            mostrarDatosDetalleBeneficiarios()
        }

    })

    function limpiarFormularioBeneficiario() {
        $("#dniBeneficiarioRegistro").val('').focus();
        $("#nombresBeneficiarioRegistro").val('');
        $("#apellidoPaternoBeneficiarioRegistro").val('');
        $("#apellidoMaternoBeneficiarioRegistro").val('');
        $("#sexoBeneficiarioRegistro").val(0);
        $("#telefonoBeneficiarioRegistro").val('');
        $("#celularBeneficiarioRegistro").val('');
        $("#fechaNacimientoBeneficiarioRegistro").val('');
        $("#cboSectorZonaRegistroBeneficiario").val(0);
        $("#direccionBeneficiarioRegistro").val('');
        $("#numeroFincaBeneficiarioRegistro").val('');
        $("#cboParentescoRegistroBeneficiario").val(0);
        $("#cboTipoBeneficioRegistroBeneficiario").val(0);
        $("#edadBeneficiarioRegistro").val('');
        $("#pesoBeneficiarioRegistro").val('');
        $("#tallaBeneficiarioRegistro").val('');
        $("#hmgBeneficiarioRegistro").val('');

        $("#fumBeneficiarioRegistro").val('');
        $("#fechaProbableDePartoBeneficiarioRegistro").val('');

        $("#fechaPartoBeneficiarioRegistro").val('');
        $("#fechaFinBeneficiarioRegistro").val('');
    }

    function mostrarDatosDetalleBeneficiarios() {
        let detalleBeneficiarios = beneficiarios.map(beneficiario => {
            const {
                nombres, apellidoPaterno, apellidoMaterno, dni, edad,
                tipoBeneficioTexto, parentescoTexto, peso, talla, hmg
            } = beneficiario

            if (parentescoTexto === 'socio' || parentescoTexto === 'Socio') {
                // Deshabilitar campos del formulario de SOCIO
                $("#dniSocioRegistro").prop("disabled", true).addClass("colorDisable")
                $("#nombresSocioRegistro").prop("disabled", true).addClass("colorDisable")
                $("#apellidoPaternoSocioRegistro").prop("disabled", true).addClass("colorDisable")
                $("#apellidoMaternoSocioRegistro").prop("disabled", true).addClass("colorDisable")
                $("#sexoSocioRegistro").prop("disabled", true).addClass("colorDisable")
                $("#telefonoSocioRegistro").prop("disabled", true).addClass("colorDisable")
                $("#celularSocioRegistro").prop("disabled", true).addClass("colorDisable")
                $("#fechaNacimientoSocioRegistro").prop("disabled", true).addClass("colorDisable")
                $("#cboSectorZonaRegistroSocio").prop("disabled", true).addClass("colorDisable")
                $("#direccionSocioRegistro").prop("disabled", true).addClass("colorDisable")
                $("#numeroFincaSocioRegistro").prop("disabled", true).addClass("colorDisable")
                $("#cboClubDeMadresActivos").prop("disabled", true).addClass("colorDisable")
                $("#observacionSocioRegistro").prop("disabled", true).addClass("colorDisable")
                $("#optionSocioBeneficiarioSi").prop("disabled", true).addClass("colorDisable")
                $("#optionSocioBeneficiarioNo").prop("disabled", true).addClass("colorDisable")

                // Habilitar campos del formulario de beneficiario
                $("#dniBeneficiarioRegistro").prop("disabled", false).removeClass("colorDisable");
                $("#nombresBeneficiarioRegistro").prop("disabled", false).removeClass("colorDisable");
                $("#apellidoPaternoBeneficiarioRegistro").prop("disabled", false).removeClass("colorDisable");
                $("#apellidoMaternoBeneficiarioRegistro").prop("disabled", false).removeClass("colorDisable");
                $("#sexoBeneficiarioRegistro").prop("disabled", false).removeClass("colorDisable");
                $("#telefonoBeneficiarioRegistro").prop("disabled", false).removeClass("colorDisable");
                $("#celularBeneficiarioRegistro").prop("disabled", false).removeClass("colorDisable");
                $("#fechaNacimientoBeneficiarioRegistro").prop("disabled", false).removeClass("colorDisable");
                $("#cboSectorZonaRegistroBeneficiario").prop("disabled", false).removeClass("colorDisable");
                $("#direccionBeneficiarioRegistro").prop("disabled", false).removeClass("colorDisable");
                $("#numeroFincaBeneficiarioRegistro").prop("disabled", false).removeClass("colorDisable");
                $("#cboParentescoRegistroBeneficiario").prop("disabled", false).removeClass("colorDisable");
                $("#cboTipoBeneficioRegistroBeneficiario").prop("disabled", false).removeClass("colorDisable");

                // Oculatar campos fecha de madre
                $(".boxFum").prop("hidden", true)
                $(".boxFechaProbableParto").prop("hidden", true)

                $(".boxFechaParto").prop("hidden", true)
                $(".boxFechaFin").prop("hidden", true)

                //     mostrar tipos de beneficio para beneficiario
                llenarCboTiposBeneficioBeneficiario()

            }

            return `<tr> 
                <td>${dni}</td>
                <td>${nombres} ${apellidoPaterno} ${apellidoMaterno}</td>
                <td>${edad}</td>
                <td>${tipoBeneficioTexto}</td>
                <td>${parentescoTexto}</td>
                <td>${peso != '' ? peso + 'kg' : ''}</td>
                <td>${talla != '' ? talla + 'cm' : ''}</td>                                                        
                <td>${hmg}</td>
                <td>
                    <div class="actions actionsDetalleBeneficiario">                            
                        <img id="btnEditarBeneficiarioDetalle" class="action" src="./assets/icons/action_edit.svg">
                        <img id="btnEliminarBeneficiarioDetalle" class="action" src="./assets/icons/action_ver_detalle.svg">                                            
                    </div>
                </td>
            </tr>`
        })

        $("#listaDetalleBeneficiarios").html(detalleBeneficiarios)
    }


    function losCamposSocioSonValidos(dni, nombres, apellidoPaterno, apellidoMaterno, sexo, telefono, celular,
                                      fechaNacimiento, edad, sectorYZona, direccion, numeroFinca, asociacion) {

        if (dni === '' || nombres === '' || apellidoMaterno === '' || apellidoPaterno === '' || sexo == '' || sexo == 0 || fechaNacimiento === '' ||
            sectorYZona == '' || sectorYZona == 0 || direccion === '' || asociacion === '' || asociacion == 0) {

            Swal.fire({
                title: "¡Advertencia!",
                text: 'Campos incompletos, debe ingresar los datos obligatorios del socio',
                icon: "warning",
                width: "350px",
                confirmButtonColor: "#13252E",
            });
            return false;
        }

        if (edad < 18 || edad > 150) {
            Swal.fire({
                title: "¡Advertencia!",
                text: 'El socio debe ser mayor de edad.',
                icon: "warning",
                width: "350px",
                confirmButtonColor: "#13252E",
            });
            return false;
        }

        return true;
    }

    function losCamposBeneficiarioSonValidos(dni, nombres, apellidoMaterno, apellidoPaterno, sexo, telefono, celular,
                                             fechaNacimiento, edad, sectorYZona, direccion, numeroFinca, parentesco, tipoBeneficio,
                                             tipoBeneficioTexto, fechaUltimaMestruacion, fechaProbableParto,
                                             fechaParto, fechaFinMadreLactante, peso, talla, hmg, asociacion) {


        if (tipoBeneficioTexto.includes("0") && tipoBeneficioTexto.includes("6")) {
            if (edad > 6 || edad < 0) {
                Swal.fire({
                    title: "¡Advertencia!",
                    text: 'Edad incorrecta para el tipo de beneficio: ' + tipoBeneficioTexto,
                    icon: "warning",
                    width: "350px",
                    confirmButtonColor: "#13252E",
                });
                return false;
            }
        }

        if (tipoBeneficioTexto.includes("7") && tipoBeneficioTexto.includes("13")) {
            if (edad > 13 || edad < 7) {
                Swal.fire({
                    title: "¡Advertencia!",
                    text: 'Edad incorrecta para el tipo de beneficio: ' + tipoBeneficioTexto,
                    icon: "warning",
                    width: "350px",
                    confirmButtonColor: "#13252E",
                });
                return false;
            }
        }

        if (tipoBeneficioTexto.includes("mayor")) {
            if (edad < 65) {
                Swal.fire({
                    title: "¡Advertencia!",
                    text: 'Edad incorrecta para el tipo de beneficio: ' + tipoBeneficioTexto,
                    icon: "warning",
                    width: "350px",
                    confirmButtonColor: "#13252E",
                });
                return false;
            }
        }

        if (optionSelected === 1 && edad < 18) {
            Swal.fire({
                title: "¡Advertencia!",
                text: 'El socio debe ser mayor de edad',
                icon: "warning",
                width: "350px",
                confirmButtonColor: "#13252E",
            });
            return false;
        }

        if (optionSelected === 1 && (asociacion === '' || asociacion == 0)) {
            Swal.fire({
                title: "¡Advertencia!",
                text: 'Campos incompletos, debe seleccionar el club de madre',
                icon: "warning",
                width: "350px",
                confirmButtonColor: "#13252E",
            });
            return false;
        }


        if (dni === '' || nombres === '' || apellidoMaterno === '' || apellidoPaterno === '' || sexo == '' || sexo == 0 || fechaNacimiento === '' ||
            sectorYZona == '' || sectorYZona == 0 || direccion === '' || parentesco == '' || parentesco == 0 || tipoBeneficio == '' ||
            tipoBeneficio == 0) {


            if (tipoBeneficioTexto.includes('gestante')) {
                if (fechaUltimaMestruacion === '' || fechaProbableParto === '') {
                    Swal.fire({
                        title: "¡Advertencia!",
                        text: 'Campos incompletos, debe ingresar la fecha de FUM',
                        icon: "warning",
                        width: "350px",
                        confirmButtonColor: "#13252E",
                    });
                    return false;
                }
            }

            if (tipoBeneficioTexto.includes('lactante')) {
                if (fechaParto === '' || fechaFinMadreLactante === '') {
                    Swal.fire({
                        title: "¡Advertencia!",
                        text: 'Campos incompletos, debe ingresar la fecha de parto',
                        icon: "warning",
                        width: "350px",
                        confirmButtonColor: "#13252E",
                    });
                    return false;
                }
            }

            Swal.fire({
                title: "¡Advertencia!",
                text: 'Campos incompletos, debe ingresar los datos obligatorios del beneficiario',
                icon: "warning",
                width: "350px",
                confirmButtonColor: "#13252E",
            });
            return false;
        }

        return true;
    }

    // Filtrar por dni o nombre
    $(document).off("input", "#btnDNIApellidosFiltroSocio").on("input", "#btnDNIApellidosFiltroSocio", function (e) {
        dniOApellidosNombres = $(this).val();
        listarSocios(dniOApellidosNombres, codAsociacion)
    });

    // Filtrar por sector
    $(document).off("input", "#cboClubDeMadresFiltroSocio").on("input", "#cboClubDeMadresFiltroSocio", function (e) {
        codAsociacion = $(this).val();
        if (codAsociacion === 0 || codAsociacion === '0') {
            codAsociacion = undefined
        } else {
            codAsociacion = parseInt(codAsociacion)
        }

        listarSocios(dniOApellidosNombres, codAsociacion)
    });


    function showErrorInternalServer(message, info) {
        Swal.fire({
            title: "¡Error!",
            text: message + ' {' + info + '}',
            icon: "error",
            width: "350px",
            confirmButtonColor: "#13252E",
        });
    }

    function showSuccessAlert(message) {
        Swal.fire({
            icon: "success",
            title: "Registro Exitoso",
            text: message
        }).then(() => {
            $('#modalRegistrarSocioYBeneficiarios').modal('hide');
            listarSocios()
        });
    }

    function showSuccessAlertUpdate(message) {
        Swal.fire({
            icon: "success",
            title: "Actualización Exitoso",
            text: message
        }).then(() => {
            $('#modalEditarSocio').modal('hide');
            listarSocios();
        });
    }
})