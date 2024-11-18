$(document).ready(function () {

    let optionSelected = 0

    let tiposBeneficio = [];

    let beneficiarios = [];

    const inputFechaSocio = document.querySelector('#fechaNacimientoSocioRegistro');
    const inputFechaBeneficiario = document.querySelector('#fechaNacimientoBeneficiarioRegistro');
    const fechaActual = new Date();
    // fechaActual.setHours(fechaActual.getHours() - 5);
    const fechaFormateada = fechaActual.toISOString().split('T')[0]; // Formatea la fecha como 'YYYY-MM-DD'
    inputFechaSocio.setAttribute('max', fechaFormateada);
    inputFechaBeneficiario.setAttribute('max', fechaFormateada);

    //     nueva asociacion - abrir modal
    // $(document).off("click", "#btnNuevoSocio").on("click", "#btnNuevoSocio", function(e) {
        // e.preventDefault();
        let modalRegistrar = $("#modalRegistrarSocioYBeneficiarios");
        $("#registrarSocioYBeneficiarioForm").trigger("reset");
        $("#fechaInicioSocioRegistro").val(fechaFormateada)

        modalRegistrar.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalRegistrar.modal('show');

        modalRegistrar.one('shown.bs.modal', function() {
            $("#dniSocioRegistro").focus();
        });
    // });

    $(document).off("input", "#dniSocioRegistro").on("input", "#dniSocioRegistro", function(e) {
        if (optionSelected === 1){
            $("#dniBeneficiarioRegistro").val($(this).val());
        }
    })

    $(document).off("input", "#dniSocioRegistro").on("input", "#dniSocioRegistro", function(e) {
        if (optionSelected === 1){
            $("#dniBeneficiarioRegistro").val($(this).val());
        }
    })

    $(document).off("input", "#nombresSocioRegistro").on("input", "#nombresSocioRegistro", function(e) {
        if (optionSelected === 1){
            $("#nombresBeneficiarioRegistro").val($(this).val());
        }
    })

    $(document).off("input", "#apellidoPaternoSocioRegistro").on("input", "#apellidoPaternoSocioRegistro", function(e) {
        if (optionSelected === 1){
            $("#apellidoPaternoBeneficiarioRegistro").val($(this).val());
        }
    })

    $(document).off("input", "#apellidoMaternoSocioRegistro").on("input", "#apellidoMaternoSocioRegistro", function(e) {
        if (optionSelected === 1){
            $("#apellidoMaternoBeneficiarioRegistro").val($(this).val());
        }
    })

    $(document).off("input", "#sexoSocioRegistro").on("input", "#sexoSocioRegistro", function(e) {
        if (optionSelected === 1){
            $("#sexoBeneficiarioRegistro").val($(this).val());
        }
    })

    $(document).off("input", "#telefonoSocioRegistro").on("input", "#telefonoSocioRegistro", function(e) {
        if (optionSelected === 1){
            $("#telefonoBeneficiarioRegistro").val($(this).val());
        }
    })

    $(document).off("input", "#celularSocioRegistro").on("input", "#celularSocioRegistro", function(e) {
        if (optionSelected === 1){
            $("#celularBeneficiarioRegistro").val($(this).val());
        }
    })

    $(document).off("input", "#fechaNacimientoSocioRegistro").on("input", "#fechaNacimientoSocioRegistro", function(e) {

        let edad = calcularEdad($(this).val(), fechaActual)
        $("#edadSocioRegistro").val(edad);

        if (optionSelected === 1){
            $("#fechaNacimientoBeneficiarioRegistro").val($(this).val());
            $("#edadBeneficiarioRegistro").val($("#edadSocioRegistro").val());
        }
    })

    $(document).off("input", "#cboSectorZonaRegistroSocio").on("input", "#cboSectorZonaRegistroSocio", function(e) {
        if (optionSelected === 1){
            $("#cboSectorZonaRegistroBeneficiario").val($(this).val());
        }
    })

    $(document).off("input", "#direccionSocioRegistro").on("input", "#direccionSocioRegistro", function(e) {
        if (optionSelected === 1){
            $("#direccionBeneficiarioRegistro").val($(this).val());
        }
    })

    $(document).off("input", "#numeroFincaSocioRegistro").on("input", "#numeroFincaSocioRegistro", function(e) {
        if (optionSelected === 1){
            $("#numeroFincaBeneficiarioRegistro").val($(this).val());
        }
    })

    // Socio es beneficiario
    $("input[name=optionSocioBeneficiario]").change(function () {
        optionSelected = $(this).val();
        optionSelected = Number(optionSelected)

        if(optionSelected === 0){ // no es socio y beneficiario
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


        }else{ // es socio y beneficiario
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
            $("#cboParentescoRegistroBeneficiario option").each(function() {
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

    function llenarCboTiposBeneficioSocio(){
        if (tiposBeneficio.length == 0){
            $("#cboTipoBeneficioRegistroBeneficiario option").each( function () {
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


    function llenarCboTiposBeneficioBeneficiario(){
        if (tiposBeneficio.length == 0){
            $("#cboTipoBeneficioRegistroBeneficiario option").each( function () {
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

    $(document).off("input", "#fechaNacimientoBeneficiarioRegistro").on("input", "#fechaNacimientoBeneficiarioRegistro", function(e) {
        let edad = calcularEdad($(this).val(), fechaActual)
        $("#edadBeneficiarioRegistro").val(edad);
    })

    $(document).on('selectTiposBeneficioLlenado', function() {
        llenarCboTiposBeneficioBeneficiario();
    });

    // Mostrar inputs en base al Tipo de beneficio (madre gestante y madre lactante)
    $(document).off("input", "#cboTipoBeneficioRegistroBeneficiario").on("input", "#cboTipoBeneficioRegistroBeneficiario", function(e) {
        let optionBeneficio = $(this).find("option:selected").text();

        if (optionBeneficio.includes("gestante")){
            $("#fumBeneficiarioRegistro").val('')
            $("#fechaProbableDePartoBeneficiarioRegistro").val('')

            $(".boxFum").prop("hidden", false)
            $(".boxFechaProbableParto").prop("hidden", false)
        }else{
            $(".boxFum").prop("hidden", true)
            $(".boxFechaProbableParto").prop("hidden", true)
        }

        if (optionBeneficio.includes("lactante")){
            $("#fechaPartoBeneficiarioRegistro").val('')
            $("#fechaFinBeneficiarioRegistro").val('')

            $(".boxFechaParto").prop("hidden", false)
            $(".boxFechaFin").prop("hidden", false)
        }else{
            $(".boxFechaParto").prop("hidden", true)
            $(".boxFechaFin").prop("hidden", true)
        }
    })


    // cambiar fecha de parto probable
    $(document).off("change", "#fumBeneficiarioRegistro").on("change", "#fumBeneficiarioRegistro", function(e) {
        calculateFechaProbableParto()
    })

    // cambiar fecha de fin de madre lactante
    $(document).off("change", "#fechaPartoBeneficiarioRegistro").on("change", "#fechaPartoBeneficiarioRegistro", function(e) {
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
        console.log(fechaNac)
        console.log(fechaActual)

        let edad = fechaActual.getFullYear() - fechaNac.getFullYear();
        const mes = fechaActual.getMonth() - fechaNac.getMonth();

        if (mes < 0 || (mes === 0 && fechaActual.getDate() < fechaNac.getDate())) {
            edad--;
        }

        return edad;
    }

//     agregar beneficiarios al detalle
    $(document).off("click", "#btnAgregarBeneficiario").on("click", "#btnAgregarBeneficiario", function(e) {
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

        console.log({dni, nombres, apellidoMaterno, apellidoPaterno, sexo, telefono, celular,
        fechaNacimiento, sectorYZona, direccion, numeroFinca, parentesco, tipoBeneficio, optionSelected})

        if(losCamposBeneficiarioSonValidos(dni, nombres, apellidoMaterno, apellidoPaterno, sexo, telefono, celular,
                fechaNacimiento, sectorYZona, direccion, numeroFinca, parentesco, tipoBeneficio, tipoBeneficioTexto,
                fechaUltimaMestruacion, fechaProbableParto, fechaParto, fechaFinLactancia, peso, talla, hmg, asociacion)){

            beneficiarios = [...beneficiarios, {dni, nombres, apellidoPaterno, apellidoMaterno, sexo, telefono, celular,
            fechaNacimiento, edad, sectorYZona, direccion, numeroFinca, parentesco, parentescoTexto,
            tipoBeneficio, tipoBeneficioTexto, fechaUltimaMestruacion, fechaProbableParto, fechaParto,
            fechaFinLactancia, peso, talla, hmg}]

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
            const {nombres, apellidoPaterno, apellidoMaterno, dni, edad,
                tipoBeneficioTexto, parentescoTexto, peso, talla, hmg } = beneficiario

            if (parentescoTexto === 'socio' || parentescoTexto === 'Socio'){
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
                <td>${peso!=''? peso + 'kg' : ''}</td>
                <td>${talla!=''? talla + 'cm' : ''}</td>                                                        
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


    function losCamposSocioSonValidos(dni, nombres, apellidoMaterno, apellidoPaterno, sexo, telefono, celular,
                                      fechaNacimiento, sectorYZona, direccion, numeroFinca, asociacion) {
        if (dni === '' || nombres === '' || apellidoMaterno === '' || apellidoPaterno === '' || sexo == '' || sexo == 0 || fechaNacimiento === '' ||
            sectorYZona == '' || sectorYZona == 0 || direccion === '' || asociacion === '' || asociacion == 0){
            Swal.fire({
                title: "¡Advertencia!",
                text: 'Campos incompletos, debe ingresar los datos del socio',
                icon: "warning",
                width: "350px",
                confirmButtonColor: "#13252E",
            });
            return false;
        }
        return true;
    }

    function losCamposBeneficiarioSonValidos(dni, nombres, apellidoMaterno, apellidoPaterno, sexo, telefono, celular,
                                             fechaNacimiento, sectorYZona, direccion, numeroFinca, parentesco, tipoBeneficio,
                                             tipoBeneficioTexto, fechaUltimaMestruacion, fechaProbableParto,
                                             fechaParto, fechaFinMadreLactante, peso, talla, hmg, asociacion) {

        if (optionSelected === 1 && (asociacion === '' || asociacion == 0)){
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
            tipoBeneficio == 0){

                if (tipoBeneficioTexto.includes('gestante')){
                    if (fechaUltimaMestruacion === '' || fechaProbableParto === ''){
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

                if (tipoBeneficioTexto.includes('lactante')){
                    if (fechaParto === '' || fechaFinMadreLactante === ''){
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

})