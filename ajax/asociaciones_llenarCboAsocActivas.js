$(document).ready(function () {
    $.ajax({
        url: './controllers/asociacion/listarAsociacionesActivas.php',
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            const {code, data, message, info} = response;

            if (code === 200) {
                let options = `<option value=0>Seleccionar</option>` +
                    data.map(({codAsociacion, nombreAsociacion}) => {
                        return `<option value="${codAsociacion}">${nombreAsociacion}</option>`
                    })
                $('#cboClubMadres').html(options);
            }

            if (code === 500) {
                showErrorInternalServer(message, info)
            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Error asociaciones_llenarCboAsocActivas.js: ', textStatus, errorThrown);
        }
    })


        function showErrorInternalServer(message, info) {
            Swal.fire({
                title: "¡Error!",
                text: message + ' {' + info + '}',
                icon: "error",
                width: "350px",
                confirmButtonColor: "#13252E",
            });
        }
})