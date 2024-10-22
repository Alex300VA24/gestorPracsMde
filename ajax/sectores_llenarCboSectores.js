$(document).ready(function () {
    $.ajax({
        url: './controllers/sector/listarSectores.php',
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            const { code, data } = response;

            if (code === 200) {
                let options = `<option value=0>Todos los sectores</option>` +
                data.map((sector) => {
                    return `<option value="${sector.codSector}">${sector.descripcion}</option>`
                })
                $('#cboSectores').html(options);
            }

            if (code === 500) {
                showErrorInternalServer(message, info)
            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Error llenarCboSectores.js: ', textStatus, errorThrown);
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