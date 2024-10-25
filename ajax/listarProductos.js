$(document).ready(function () {

    function listarProductos(codigo, descripcion) {
        $.ajax({
            url: './controllers/productos/listarProductos.php',
            method: 'GET',
            dataType: 'json',
            data: {codigo, descripcion},
            success: function (response) {
                const {code, message, info, data} = response;

                if (code === 200) {
                    let row = '';
                    if (data && Array.isArray(data) && data.length > 0) {
                        row = data.map(({
                                            codigo, descripcion, abreviatura, unidadMedida, estado
                                        }) => {
                            return `
                                <tr>
                                    <td>${codigo}</td>
                                    <td>${descripcion}</td>                                   
                                    <td>${abreviatura}</td>                                   
                                    <td>${unidadMedida}</td>
                                    <td>
                                        <span class="estado ${abreviatura === "a" ? 'active' : 'inactive'}">
                                            ${estado}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="actions actions_productos">
                                        
                                            ${abreviatura == 'i' ?
                                `<img class="action action_habilitar" src="./assets/icons/action_habilitar.svg">` : ''}
                                            
                                            ${abreviatura == 'a' ?
                                `<img class="action" src="./assets/icons/action_ver_detalle.svg">
                                            <img class="action" src="./assets/icons/action_deshabilitar.svg">` : ''}                                            
                                        </div>
                                    </td>
                                </tr>
                            `
                        })
                        $("#listaProductos").html(row)
                    } else {
                        row = `<tr><td colspan="10">Aún no existen productos en el sistema</td></tr>`
                    }
                    $("#listaProductos").html(row)
                }

                if (code === 500) {
                    showErrorInternalServer(message, info)
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error listarProductos.js: ', textStatus, errorThrown);
            }
        })
    }

    listarProductos();

//    nuevo producto - abrir modal
    $(document).off("click", "#nuevoProducto").on("click", "#nuevoProducto", function(e) {
        e.preventDefault();
        let modalRegistrar = $("#modalRegistrarProducto");
        $("#registrarProductoForm").trigger("reset");
    
        modalRegistrar.modal({
            backdrop: 'static',
            keyboard: false
        });
    
        modalRegistrar.modal('show');
    
        modalRegistrar.one('shown.bs.modal', function() {
            $("#codigo").focus();
        });
    });

//    registrar producto
    $(document).off("click", "#registrarProductoForm").on('submit', '#registrarProductoForm', function(e) {
        e.preventDefault();
        const codigo = $.trim($('#codigo').val());
        const descripcion = $.trim($('#descripcionProducto').val());
        const abreviatura = $.trim($('#abreviatura').val());
        const unidadMedida = $.trim($('#cboUnidadMedida').val());
        console.log({codigo, descripcion, abreviatura, unidadMedida})

        if (isFiledsValid(codigo, descripcion, abreviatura, unidadMedida)){
            $.ajax({
                url: './controllers/productos/registrarProductos.php',
                method: 'POST',
                dataType: 'json',
                data: {codigo, descripcion, abreviatura, unidadMedida},
                success: function (response) {
                    console.log(response)
                
                    const {code, message, info, data} = response;

                    if (code == 200) {
                        showSuccessAlert(message)
                    }

                    if (code === 500) {
                        showErrorInternalServer(message, info)
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error listarProductos.js: ', textStatus, errorThrown);
                }
            })
        }
    })

    function isFiledsValid(descripcion, abreviatura, unidadMedida) {
        
        if (descripcion === '' || abreviatura == '' || unidadMedida === 0) {
            Swal.fire({
                title: "¡Advertencia!",
                text: 'Campos incompletos',
                icon: "warning",
                width: "350px",
                confirmButtonColor: "#13252E",
            });
            return false;
        }
        return true;
    }

    function showErrorInternalServer(message, info) {
        Swal.fire({
            title: "¡Error!",
            text: message + ' {' + info + '}',
            icon: "error",
            width: "350px",
            confirmButtonColor: "#13252E",
        });
    }

    function showSuccessAlert(message){
        Swal.fire({
            icon: "success",
            title: "Registro Exitoso",
            text: message
        }).then(() => {
            $('#modalRegistrarProducto').modal('hide');
            listarProductos();
        });
    }

})


