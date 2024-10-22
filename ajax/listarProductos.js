//Nuevo
$(document).off("click", "#btnRegistrarProducto").on("click", "#btnRegistrarProducto", function(e) {
    e.preventDefault();
    let modalRegistrar = $("#modalRegistrarProducto");
    $("#registrarProductoForm").trigger("reset");

    modalRegistrar.modal({
        backdrop: 'static',
        keyboard: false
    });

    modalRegistrar.modal('show');

    modalRegistrar.one('shown.bs.modal', function() {
        $("#descripcionProducto").focus();
    });

    console.log ('registro producto');
});
