$(document).ready(function () {
    $(document).off("click", "#btnLogout").on("click", "#btnLogout", function (e) {
        Swal.fire({
            title: "¿Desea cerrar sesión?",
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#13252E",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí",
            cancelButtonText: "No",
            width: "400px"
        }).then((result) => {
          if (result.isConfirmed){
            cerrarSesion();
          }
        })
    })

    function cerrarSesion() {
        $.ajax({
            url: './controllers/autenticacion/logout.php',
            dataType: 'json',
            success: function (response) {
                if (response) {
                    location.reload();
                }
            }, error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        })
    }
})