$(document).ready(function () {

    let nombreAsociacion
    let codSector

    $.ajax({
        url: './controllers/asociacion/listarAsociaciones.php',
        method: 'GET',
        dataType: 'json',
        data: {nombreAsociacion, codSector},
        success: function (response) {
            const {code, data, message, info} = response;

            if (code === 200) {
                let options = `<option value="0">Seleccionar</option>` +
                    data.map(({codAsociacion, nombreAsociacion}) => {
                        return `<option value="${codAsociacion}">${nombreAsociacion}</option>`;
                    }).join('');
                $('#cboClubDeMadresFiltroSocio').html(options);
            }

            if (code === 500) {
                showErrorInternalServer(message, info);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Error asociaciones_llenarCboAsocTodas.js: ', textStatus, errorThrown);
        }
    });

    function showErrorInternalServer(message, info) {
        Swal.fire({
            title: "¡Error!",
            text: message + ' {' + info + '}',
            icon: "error",
            width: "350px",
            confirmButtonColor: "#13252E",
        });
    }
});
