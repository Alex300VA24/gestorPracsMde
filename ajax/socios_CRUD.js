$(document).ready(function () {

    let optionSelected

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
            $("#nombresNuevo").focus();
        });
    // });

    $(document).off("input", "#dniSocioRegistro").on("input change", "dniSocioRegistro", function(e) {
        console.log('bene')
        if (optionSelected === 1){
            $("#dniBeneficiarioRegistro").val($(this).val());
        }
    })

    // Socio es beneficiario
    $(document).off("input change", "input[name='optionSocioBeneficiario']").on("input change", "input[name='optionSocioBeneficiario']", function(e) {
        optionSelected = $(this).val();

        if(optionSelected === 0){
            $("#dniBeneficiarioRegistro").val();
        }
    });

})