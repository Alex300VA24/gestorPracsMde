$(document).ready(function () {

    let dniOApellidosNombres;
    let codAsociacion;
    let edadMinima;
    let edadMaxima;
    let pesoTallaHmgFiltro;

    listarBeneficiarios(dniOApellidosNombres, codAsociacion, edadMinima, edadMaxima);

    function listarBeneficiarios(dniOApellidosNombres, codAsociacion,  edadMinima, edadMaxima) {
        $.ajax({
            url: './controllers/beneficiario/listar.php',
            method: 'GET',
            dataType: 'json',
            data: {dni_apellidos_nombres: dniOApellidosNombres, codAsociacion, edadMinima, edadMaxima},
            success: function (response) {
                console.log(response)
                const {code, message, info, data} = response;

                if (code === 200) {
                    let row = '';
                    if (data && Array.isArray(data) && data.length > 0) {
                        row = data.map(({codBeneficiario, codPersona, nombres, apellidoPaterno,
                                            apellidoMaterno, sexo, fechaNacimiento, codSectorZona,
                                            codTipoBeneficio, tipoBeneficio, peso, talla, hmg,
                                            direccion, aniosNacido, dni, observaciones, codAsociacion,
                                            nombreAsociacion, cargo, fechaInicio, fechaFin, abreviatura, estado,
                                            codMotivoInhabilitacion, motivoInhabilitacion
                                        }) => {
                            return `
                                <tr>
                                    <td>${codBeneficiario}</td>
                                    <td hidden="hidden">${codPersona}</td>
                                    <td>${apellidoPaterno + ' ' + apellidoMaterno + ' ' + nombres}</td>                                   
                                    <td hidden="hidden">${sexo}</td>
                                    <td hidden="hidden">${fechaNacimiento}</td>
                                    <td hidden="hidden">${codSectorZona}</td>
                                    <td hidden="hidden">${direccion}</td>
                                    <td>${aniosNacido}</td>                                                                                                       
                                    <td>${dni}</td>                                                                                                       
                                    <td hidden="hidden">${codTipoBeneficio}</td>                                                                                                       
                                    <td>${tipoBeneficio}</td>                                                                                                       
                                    <td>${peso ? peso : ''}</td>                                                                                                       
                                    <td>${talla ? talla : ''}</td>                                                                                                       
                                    <td>${hmg ? hmg : ''}</td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                                    <td>
                                        <span class="estado ${abreviatura === "a" ? 'active' : abreviatura === 'v' ? 'vencido' : 'inactive'}">
                                            ${estado}
                                        </span>
                                    </td>
                                    <td hidden="hidden">${codMotivoInhabilitacion}</td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                                    <td>${motivoInhabilitacion ? motivoInhabilitacion : ''}</td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                                    <td>
                                        <div class="actions actions_beneficiarios">     
                                            ${abreviatura == 'a' ?
                                `<img id="btnEditarAsociacion" class="action" src="./assets/icons/action_edit.svg">
                                            <img class="action" src="./assets/icons/action_ver_detalle.svg">
                                            <img class="action" src="./assets/icons/action_ver_beneficiarios.svg">
                                            <img class="action" src="./assets/icons/action_cambiar_beneficio.svg">
                                            <img class="action" src="./assets/icons/action_deshabilitar.svg">
                                            ` : ''}                                            
                                        </div>
                                    </td>
                                </tr>
                            `
                        })
                        $("#listaBeneficiarios").html(row)
                    } else {
                        row = `<tr><td colspan="10">Aún no existen beneficiarios en el sistema</td></tr>`
                    }
                    $("#listaBeneficiarios").html(row)
                }

                if (code === 500) {
                    showErrorInternalServer(message, info)
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error reconocimientos_CRUD.js: ', textStatus, errorThrown);
            }
        })
    }
})