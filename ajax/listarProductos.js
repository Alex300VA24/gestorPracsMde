$(document).ready(function () {

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
            $("#descripcionProducto").focus();
        });
    });

//    registrar producto
    $(document).off("click", "#registrarProductoForm").on('submit', '#registrarProductoForm', function(e) {
        e.preventDefault();
        const descripcion = $.trim($('#descripcionProducto').val());
        const abreviatura = $.trim($('#abreviatura').val());
        const unidadMedida = $.trim($('#cboUnidadMedida').val());
        console.log({descripcion, abreviatura, unidadMedida})

        if (isFiledsValid(descripcion, abreviatura, unidadMedida)){
            $.ajax({
                url: './controllers/productos/registrarProductos.php',
                method: 'POST',
                //dataType: 'json',
                data: {descripcion, abreviatura, unidadMedida},
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


