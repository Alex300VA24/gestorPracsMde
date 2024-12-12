$(document).ready(function () {
    $.ajax({
        url: './controllers/asociacion/listarAsociacionesActivas.php', 
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            const {code, data, message, info} = response;

            if (code === 200) {
                let options = `<option value="0">Seleccionar</option>` +
                    data.map(({codAsociacion, nombreAsociacion, presidenta, codSocioPresidenta}) => {
                        return `<option value="${codAsociacion}" data-presidenta="${presidenta}" data-codsociopresidenta="${codSocioPresidenta}">${nombreAsociacion}</option>`;
                    }).join('');
                $('#cboClubMadres').html(options);
            }

            if (code === 500) {
                showErrorInternalServer(message, info);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Error asociaciones_llenarCboAsocActivas.js: ', textStatus, errorThrown);
        }
    });

    // Manejar el cambio de selección en el select
    $('#cboClubMadres').on('change', function () {
        const selectedOption = $(this).find(':selected'); // Obtén la opción seleccionada
        const presidenta = selectedOption.data('presidenta'); // Extrae el valor del atributo data-presidenta
        const codSocioPresidenta = selectedOption.data('codsociopresidenta'); // Extrae el valor del atributo data-codsociopresidenta
        
        $('#presidenta').val(presidenta || ''); // Coloca el nombre de la presidenta en el input, o vacío si no existe
        $('#codSocioPresidenta').val(codSocioPresidenta || ''); // Coloca el codSocioPresidenta en el input correspondiente, o vacío si no existe
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

