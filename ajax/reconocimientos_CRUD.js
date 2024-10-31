$(document).ready(function () {
    let fechaActual = new Date();
    let fechaFormateada = fechaActual.toISOString().split('T')[0];

    let codAsociacion = 0;
    let directiva = [];

    let ultimoDNIPresidenta;
    let ultimoDNIVicepresidenta;
    let ultimoDNITesorera;
    let ultimoDNIVocal;
    let ultimoDNICoordinadora;
    let ultimoDNIAlmacenera;
    let ultimoDNIFiscalizador;
    let ultimoDNISecretaria;

//     nueva asociacion - abrir modal
    $(document).off("click", "#nuevaAsociacion").on("click", "#nuevaAsociacion", function(e) {
        e.preventDefault();
        let modalRegistrar = $("#modalRegistrarReconocimiento");
        $("#registrarReconocimientoForm").trigger("reset");
        $("#fechaInicioReconocimiento").val(fechaFormateada)
        calculateEndDateReconocimiento();

        modalRegistrar.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalRegistrar.modal('show');

        modalRegistrar.one('shown.bs.modal', function() {
            $("#documentoReconocimiento").focus();
        });
    });

//     registrar reconocimiento
    $(document).off("submit", "#registrarReconocimientoForm").on('submit', '#registrarReconocimientoForm', function(e) {
        e.preventDefault();
        const asociacion = $.trim($('#cboAsociacionesNuevasYReconocimientoVencido').val());
        const documento = $.trim($('#documentoReconocimiento').val());
        const fechaInicio = $.trim($('#fechaInicioReconocimiento').val());
        const fechaFin = $.trim($('#fechaFinReconocimiento').val());
        const presidenta = $.trim($('#codPresidenta').val());
        const vicePresidenta = $.trim($('#codVicePresidenta').val());
        const secretaria = $.trim($('#codSecretaria').val());
        const tesorera = $.trim($('#codTesorera').val());
        const vocal = $.trim($('#codVocal').val());
        const coordinadora = $.trim($('#codCoordinadora').val());
        const almacenera = $.trim($('#codAlmacenera').val());
        const fiscalizador = $.trim($('#codFiscalizador').val());

        console.log({asociacion, documento, fechaInicio, fechaFin, presidenta, vicePresidenta, tesorera, vocal, coordinadora, almacenera, fiscalizador})

        if (isFiledsValid(asociacion, documento, fechaInicio, fechaFin, presidenta, vicePresidenta,
            tesorera, vocal, coordinadora, almacenera, fiscalizador)){
            $.ajax({
                url: './controllers/reconocimiento/registrar.php',
                method: 'POST',
                dataType: 'json',
                data: {asociacion, documento, fechaInicio, fechaFin,
                presidenta, vicePresidenta, secretaria, tesorera, vocal, coordinadora, almacenera, fiscalizador},
                success: function (response) {
                    console.log(response)
                    const {code, message, info, data} = response;

                    if (code === 200) {
                        showSuccessAlert(message)
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
    })

    function tieneAsignadoUnCargo(dni){
        return directiva.includes(dni)
    }

    // Llenar campos de presidenta
    $(document).off("input", "#dniPresidentaReconocimiento").on("input", "#dniPresidentaReconocimiento", function(e) {
        const dni = $(this).val();
        const idInputNombrePresidenta = '#nombrePresidentaReconocimiento';
        const idInputCodPresidenta = '#codPresidenta';
        validarInputDNISocio(dni, idInputNombrePresidenta, idInputCodPresidenta, ultimoDNIPresidenta)
    });

    // Llenar campos de vicepresidenta
    $(document).off("input", "#dniVicePresidentaReconocimiento").on("input", "#dniVicePresidentaReconocimiento", function(e) {
        const dni = $(this).val();
        const idInputNombreVicePresidenta = '#nombreVicePresidentaReconocimiento';
        const idInputCodVicePresidenta = '#codVicePresidenta';
        validarInputDNISocio(dni, idInputNombreVicePresidenta, idInputCodVicePresidenta, ultimoDNIVicepresidenta)
    });

    // Llenar campos de secretaria
    $(document).off("input", "#dniSecretariaReconocimiento").on("input", "#dniSecretariaReconocimiento", function(e) {
        const dni = $(this).val();
        const idInputNombreSecretaria = '#nombreSecretariaReconocimiento';
        const idInputCodSecretaria = '#codSecretaria';
        validarInputDNISocio(dni, idInputNombreSecretaria, idInputCodSecretaria, ultimoDNISecretaria)
    });

    // Llenar campos de tesorera
    $(document).off("input", "#dniTesoreraReconocimiento").on("input", "#dniTesoreraReconocimiento", function(e) {
        const dni = $(this).val();
        const idInputNombreTesorera = '#nombreTesoreraReconocimiento';
        const idInputCodTesorera = '#codTesorera';
        validarInputDNISocio(dni, idInputNombreTesorera, idInputCodTesorera, ultimoDNITesorera)
    });

    // Llenar campos de vocal
    $(document).off("input", "#dniVocalReconocimiento").on("input", "#dniVocalReconocimiento", function(e) {
        const dni = $(this).val();
        const idInputNombreVocal = '#nombreVocalReconocimiento';
        const idInputCodVocal = '#codVocal';
        validarInputDNISocio(dni, idInputNombreVocal, idInputCodVocal, ultimoDNIVocal)
    });

    // Llenar campos de coordinadora
    $(document).off("input", "#dniCoordinadoraReconocimiento").on("input", "#dniCoordinadoraReconocimiento", function(e) {
        const dni = $(this).val();
        const idInputNombreCoordinadora = '#nombreCoordinadoraReconocimiento';
        const idInputCodCoordinadora = '#codCoordinadora';
        validarInputDNISocio(dni, idInputNombreCoordinadora, idInputCodCoordinadora, ultimoDNICoordinadora)
    });

    // Llenar campos de almacenera
    $(document).off("input", "#dniAlmaceneraReconocimiento").on("input", "#dniAlmaceneraReconocimiento", function(e) {
        const dni = $(this).val();
        const idInputNombreAlmacenera = '#nombreAlmaceneraReconocimiento';
        const idInputCodAlmacenera = '#codAlmacenera';
        validarInputDNISocio(dni, idInputNombreAlmacenera, idInputCodAlmacenera, ultimoDNIAlmacenera)
    });

    // Llenar campos de fuscalizador
    $(document).off("input", "#dniFiscalizadorReconocimiento").on("input", "#dniFiscalizadorReconocimiento", function(e) {
        const dni = $(this).val();
        const idInputNombreFiscalizador = '#nombreFiscalizadorReconocimiento';
        const idInputCodFiscalizador = '#codFiscalizador';
        validarInputDNISocio(dni, idInputNombreFiscalizador, idInputCodFiscalizador, ultimoDNIFiscalizador)
    });

    function validarInputDNISocio(dni, inputNombreSocio, inputCodSocio, ultimoDNISocio) {
        if (dni.length === 8) {
            if(tieneAsignadoUnCargo(dni)){
                showAlertCargoRepetido(dni, inputNombreSocio, inputCodSocio);
            }else{
                ultimoDNISocio = dni;
                buscarSocioPorDNI(dni, codAsociacion, inputNombreSocio, inputCodSocio);
            }
        }else{
            limpiarInputsCargos(inputNombreSocio, inputCodSocio)
            directiva = directiva.filter(dni => dni != ultimoDNISocio)
        }
    }

    // Buscar socio por cargo
    function buscarSocioPorDNI(dni, codAsociacion, nombreSocioInput, codSocioInput, cargo) {
        $.ajax({
            url: './controllers/socio/buscarByDNI.php',
            method: 'GET',
            dataType: 'json',
            data: {dni, codAsociacion},
            success: function (response) {
                console.log(response)

                const {code, message, info, data} = response;

                if (code === 200) {
                    const { codSocio, nombres } = data;
                    $(nombreSocioInput).val(nombres);
                    $(codSocioInput).val(codSocio);
                    directiva = [...directiva, dni];
                    console.log('directivas al momento de buscar socio', directiva)
                }

                if (code === 404){
                    showAlertSocioNotFound(message)
                }

                if (code === 500) {
                    showErrorInternalServer(message, info)
                }
            },
            error: function  (jqXHR, textStatus, errorThrown) {
                console.error('Error reconocimientos_CRUD.js: ', textStatus, errorThrown);
            }
        })
    }

    // habilitar / deshabilitar campos cargos segun cbo club de madre
    $(document).off("change", "#cboAsociacionesNuevasYReconocimientoVencido").on("change", "#cboAsociacionesNuevasYReconocimientoVencido", function(e) {
        limpiarYDeshabilitarCampos()
        directiva = []

        codAsociacion = $('#cboAsociacionesNuevasYReconocimientoVencido').val();

        if (codAsociacion!=0){
            $('.dniCargos').prop("disabled", false);
            $('.dniCargos').prop("disabled", false).removeClass("colorDisable");
        }
    })

    function limpiarYDeshabilitarCampos() {
        $('.dniCargos').prop("disabled", true);
        $('.dniCargos').prop("disabled", true).addClass("colorDisable");
        $('.dniCargos').val('')
        $('.nombresCargo').val('')
        $('.codCargo').val('')
    }

    // cambiar fecha de fin del reconocimiento
    $(document).off("change", "#fechaInicioReconocimiento").on("change", "#fechaInicioReconocimiento", function(e) {
        calculateEndDateReconocimiento();
    })

    // calcular fecha fin del reconocimiento
    function calculateEndDateReconocimiento() {
        let fechaInicioReconocimiento = new Date($("#fechaInicioReconocimiento").val());
        fechaInicioReconocimiento.setFullYear(fechaInicioReconocimiento.getFullYear() + 2);
        let fechaFinReconocimiento = fechaInicioReconocimiento.toISOString().split('T')[0];
        $("#fechaFinReconocimiento").val(fechaFinReconocimiento);
    }

    function isFiledsValid(codAsociacion, documento, fechaInicio, fechaFin, codPresidenta,
                           codVicePresidenta, codTesorera, codVocal, codCoordinadora,
                           codAlmacenera, codFiscalizador) {
        if (codAsociacion === '' || codAsociacion == 0 || documento == '' || fechaInicio == '' ||
            fechaFin == '' || codPresidenta === '' || codPresidenta === 0 || codVicePresidenta === '' ||
            codVicePresidenta === 0 || codTesorera === 0 || codTesorera === '' || codVocal === 0 || codVocal  === '' ||
            codCoordinadora === 0 || codCoordinadora  === '' || codAlmacenera === 0 || codAlmacenera  === '' ||
            codFiscalizador === 0 || codFiscalizador  === '') {
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

    function showSuccessAlert(message){
        Swal.fire({
            icon: "success",
            title: "Registro Exitoso",
            text: message
        }).then(() => {
            $('#modalRegistrarReconocimiento').modal('hide');
        //     TODO: listar reconocimientos
        });
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

    function showAlertSocioNotFound(message) {
        Swal.fire({
            title: "¡Advertencia!",
            text: message,
            icon: "warning",
            width: "350px",
            confirmButtonColor: "#13252E",
        });
    }

    function showAlertCargoRepetido(dni, inputNombreSocio, inputCodigoSocio) {
        Swal.fire({
            title: "¡Advertencia!",
            text: `El socio con DNI ${dni} ya tiene un cargo asignado.`,
            icon: "warning",
            width: "350px",
            confirmButtonColor: "#13252E",
        }).then(ok => {
            limpiarInputsCargos(inputNombreSocio, inputCodigoSocio)
        });
    }

    function limpiarInputsCargos(inputNombreSocio, inputCodSocio) {
        $(inputCodSocio).val('');
        $(inputNombreSocio).val('');
    }

})