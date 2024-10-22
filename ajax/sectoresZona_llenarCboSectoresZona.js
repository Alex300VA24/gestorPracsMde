$(document).ready(function () {
    $.ajax({
        url: './controllers/sectorZona/listarSectoresYZonas.php',
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            const { code, data } = response;

            if (code === 200) {
                let options = `<option value=0>Seleccionar</option>` +
                    data.map(({codSectorZona, sector, zona}) => {
                        return `<option value="${codSectorZona}">${sector} - ${zona}</option>`
                    })
                $('#cboSectoresZonas').html(options);
            }

            if (code === 500) {
                showErrorInternalServer(message, info)
            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Error sectoresZona_llenarCboSectoresZona.js: ', textStatus, errorThrown);
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