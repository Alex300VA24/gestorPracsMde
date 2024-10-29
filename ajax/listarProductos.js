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
                                            codProducto,codigo, descripcion, abreviatura, unidadMedida, 
                                            estado, abreviaturaEstado, descripcionEstado
                                        }) => {
                            return `
                                <tr>
                                    <td>${codProducto}</td>
                                    <td>${codigo}</td>
                                    <td>${descripcion}</td>                                   
                                    <td>${abreviatura}</td>                                   
                                    <td>${unidadMedida}</td>
                                    <td>
                                        <span class="estado ${abreviaturaEstado === "a" ? 'active' : 'inactive'}">
                                            ${descripcionEstado}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="actions actions_productos">
                                        
                                            ${abreviaturaEstado == 'i' ?
                                `<img class="action action_habilitar" src="./assets/icons/action_habilitar.svg">` : ''}
                                            
                                            ${(abreviaturaEstado == 'a' || abreviaturaEstado == 'i')?
                                `<img id="btnEditarProducto" class="action" src="./assets/icons/action_edit.svg">` : ''}
                                
                                            ${abreviaturaEstado == 'a' ?
                                `<img class="action" src="./assets/icons/action_deshabilitar.svg">` : ''}
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

//     editar productos - abril modal
    $(document).off("click", "#btnEditarProducto").on("click", "#btnEditarProducto", function(e) {
        e.preventDefault();
        let modalEditar = $("#modalEditarProducto");
        let fila = $(this).closest("tr");
        let codProducto = fila.find('td:eq(0)').text();
        let codigo = fila.find('td:eq(1)').text();
        let descripcion = fila.find('td:eq(2)').text();
        let abreviatura = fila.find('td:eq(3)').text();
        let unidadMedida = fila.find('td:eq(4)').text();

        console.log({codProducto, codigo, descripcion})

        $("#codProducto").val(codProducto.trim());
        $("#codigoEdit").val(codigo.trim());
        $("#descripcionProductoEdit").val(descripcion.trim());
        $("#abreviaturaEdit").val(abreviatura.trim());
        $("#cboUnidadMedidaEdit").val(unidadMedida);

        modalEditar.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalEditar.modal('show');

        modalEditar.one('shown.bs.modal', function() {
            $("#codigoEdit").focus();
        });
    });

// Actualizar productos
    $(document).off("submit", "#editarProductoForm").on('submit', '#editarProductoForm', function(e) {
        e.preventDefault();
        const codProducto = $.trim($('#codProducto').val());
        const codigo = $.trim($('#codigoEdit').val());
        const descripcion = $.trim($('#descripcionProductoEdit').val());
        const abreviatura = $.trim($('#abreviaturaEdit').val());
        const unidadMedida = $.trim($('#cboUnidadMedidaEdit').val());

        console.log({codProducto, codigo, descripcion, abreviatura, unidadMedida})

        if (isFiledsValid(codigo, descripcion, abreviatura, unidadMedida)){
            $.ajax({
                url: './controllers/productos/actualizar.php',
                method: 'POST',
                dataType: 'json',
                data: {codProducto, codigo, descripcion, abreviatura, unidadMedida},
                success: function (response) {
                    console.log(response)
                    const {code, message, info, data} = response;

                    if (code === 200) {
                        showSuccessAlertUpdate(message)
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

    function showSuccessAlertUpdate(message){
        Swal.fire({
            icon: "success",
            title: "Actualización Exitoso",
            text: message
        }).then(() => {
            $('#modalEditarProducto').modal('hide');
            listarProductos();
        });
    }

})


