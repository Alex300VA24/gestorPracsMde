$(document).ready(function () {

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

    // Filtrar por nombre de la asociacion
    $(document).off("input change", "#optionSocioBeneficiario").on("input change", "#optionSocioBeneficiario", function(e) {
        console.log($(this).val())
    });

})