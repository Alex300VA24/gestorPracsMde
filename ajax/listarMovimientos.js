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
        $("#producto").focus();
    });
});