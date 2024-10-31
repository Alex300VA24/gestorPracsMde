$(document).ready(function () {
// nuva pecosa - abrir modal
    $(document).off("click", "#nuevaPecosa").on("click", "#nuevaPecosa", function(e) {
        e.preventDefault();
        let modalRegistrar = $("#modalRegistrarPecosa");
        $("#registrarPecosaForm").trigger("reset");

        modalRegistrar.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalRegistrar.modal('show');

        modalRegistrar.one('shown.bs.modal', function() {
            $("#comite").focus();
        });
    });
})