$(document).ready(function () {
    $.ajax({
        url: './controllers/tipoBeneficio/listarTiposBeneficio.php',
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            console.log(response)
            const { code, data } = response;

            if (code === 200) {
                let options = `<option value=0>Seleccionar</option>` +
                    data.map((tipoBeneficio) => {
                        return `<option value="${tipoBeneficio.codTipoBeneficio}">${tipoBeneficio.descripcion}</option>`
                    })
                $('#cboTipoBeneficioRegistroBeneficiario').html(options);

                $(document).trigger('selectTiposBeneficioLlenado');
            }

            if (code === 500) {
                showErrorInternalServer(message, info)
            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Error parentescos_llenarCboParentescos.js: ', textStatus, errorThrown);
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