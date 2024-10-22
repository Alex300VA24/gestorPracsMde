$(document).ready(function () {

    function listarAsociaciones(nombreAsociacion, codSector) {
        $.ajax({
            url: './controllers/asociacion/listarAsociaciones.php',
            method: 'GET',
            dataType: 'json',
            data: {nombreAsociacion, codSector},
            success: function (response) {
                const {code, data} = response;

                if (code === 200) {
                    let row = '';
                    if (data && Array.isArray(data) && data.length > 0) {
                        row = data.map(({
                                            codAsociacion, nombreAsociacion, codSectorZona,
                                            sector, direccion, presidenta, cantidadBeneficiarios,
                                            documento, abreviatura, estado
                                        }) => {
                            return `
                                <tr>
                                    <td>${codAsociacion}</td>
                                    <td>${nombreAsociacion}</td>                                   
                                    <td hidden="hidden">${codSectorZona}</td>
                                    <td>${sector}</td>                                   
                                    <td>${direccion}</td>
                                    <td>${presidenta}</td>
                                    <td>${cantidadBeneficiarios}</td>
                                    <td>${documento ? documento : ''}</td>
                                    <td>
                                        <span class="estado ${abreviatura === "a" ? 'active' : abreviatura === 'pr' ? 'pendingResolution' : 'inactive'}">
                                            ${estado}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="actions actions_asociaciones">
                                        
                                            ${abreviatura == 'i' ?
                                `<img class="action action_habilitar" src="./assets/icons/action_habilitar.svg">` : ''}
                                            
                                            ${(abreviatura == 'a' || abreviatura == 'pr') ?
                                `<img class="action" src="./assets/icons/action_edit.svg">` : ''}    
                                            
                                            ${abreviatura == 'a' ?
                                `<img class="action" src="./assets/icons/action_ver_detalle.svg">
                                            <img class="action" src="./assets/icons/action_deshabilitar.svg">` : ''}                                            
                                        </div>
                                    </td>
                                </tr>
                            `
                        })
                        $("#listaAsociaciones").html(row)
                    } else {
                        row = `<tr><td>Aún no existen club de madres en el sistema</td></tr>`
                    }
                    $("#listaAsociaciones").html(row)
                }

                if (code === 500) {
                    showErrorInternalServer(message, info)
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error asociacionesCRUD.js: ', textStatus, errorThrown);
            }
        })
    }

    listarAsociaciones();

})