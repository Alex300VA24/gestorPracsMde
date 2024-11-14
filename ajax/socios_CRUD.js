$(document).ready(function () {

    let optionSelected = 0

    const inputFechaSocio = document.querySelector('#fechaNacimientoSocioRegistro');
    const inputFechaBeneficiario = document.querySelector('#fechaNacimientoBeneficiarioRegistro');
    const fechaActual = new Date();
    const fechaFormateada = fechaActual.toISOString().split('T')[0]; // Formatea la fecha como 'YYYY-MM-DD'
    inputFechaSocio.setAttribute('max', fechaFormateada);
    inputFechaBeneficiario.setAttribute('max', fechaFormateada);

    //     nueva asociacion - abrir modal
    // $(document).off("click", "#btnNuevoSocio").on("click", "#btnNuevoSocio", function(e) {
        // e.preventDefault();
        let modalRegistrar = $("#modalRegistrarSocioYBeneficiarios");
        $("#registrarSocioYBeneficiarioForm").trigger("reset");

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

    // Socio es beneficiario
    $(document).off("input change", "input[name='optionSocioBeneficiario']").on("input change", "input[name='optionSocioBeneficiario']", function(e) {
        optionSelected = $(this).val();
        optionSelected = Number(optionSelected)

        if(optionSelected === 0){
            //limpiar campos
            $("#dniBeneficiarioRegistro").val("");
            $("#nombresBeneficiarioRegistro").val("");
            $("#apellidoPaternoBeneficiarioRegistro").val("");
            $("#apellidoMaternoBeneficiarioRegistro").val("");
            $("#sexoBeneficiarioRegistro").val(0);
            $("#telefonoBeneficiarioRegistro").val("");
            $("#celularBeneficiarioRegistro").val("");
            $("#fechaNacimientoBeneficiarioRegistro").val("");


            // habilitar campos
            $("#dniBeneficiarioRegistro").prop("disabled", false).removeClass("colorDisable")
            $("#nombresBeneficiarioRegistro").prop("disabled", false).removeClass("colorDisable")
            $("#apellidoPaternoBeneficiarioRegistro").prop("disabled", false).removeClass("colorDisable")
            $("#apellidoMaternoBeneficiarioRegistro").prop("disabled", false).removeClass("colorDisable")
            $("#sexoBeneficiarioRegistro").prop("disabled", false).removeClass("colorDisable")
            $("#telefonoBeneficiarioRegistro").prop("disabled", false).removeClass("colorDisable")
            $("#celularBeneficiarioRegistro").prop("disabled", false).removeClass("colorDisable")
            $("#fechaNacimientoBeneficiarioRegistro").prop("disabled", false).removeClass("colorDisable")

        }else{
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


            // deshabilitar input de beneficiarios
            $("#dniBeneficiarioRegistro").prop("disabled", true).addClass("colorDisable")
            $("#nombresBeneficiarioRegistro").prop("disabled", true).addClass("colorDisable")
            $("#apellidoPaternoBeneficiarioRegistro").prop("disabled", true).addClass("colorDisable")
            $("#apellidoMaternoBeneficiarioRegistro").prop("disabled", true).addClass("colorDisable")
            $("#sexoBeneficiarioRegistro").prop("disabled", true).addClass("colorDisable")
            $("#telefonoBeneficiarioRegistro").prop("disabled", true).addClass("colorDisable")
            $("#celularBeneficiarioRegistro").prop("disabled", true).addClass("colorDisable")
            $("#fechaNacimientoBeneficiarioRegistro").prop("disabled", true).addClass("colorDisable")
        }
    });

    function calcularEdad(fechaNacimiento, fechaActual) {
        const fechaNac = new Date(`${fechaNacimiento}T00:00:00`);

        let edad = fechaActual.getFullYear() - fechaNac.getFullYear();
        const mes = fechaActual.getMonth() - fechaNac.getMonth();

        if (mes < 0 || (mes === 0 && fechaActual.getDate() < fechaNac.getDate())) {
            edad--;
        }

        return edad;
    }

})