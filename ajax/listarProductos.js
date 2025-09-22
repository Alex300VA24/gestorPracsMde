$(document).ready(function () {
  let descripcionProducto

  function listarProductos(descripcion) {
    console.log(descripcion)
    $.ajax({
      url: './controllers/productos/listarProductos.php',
      method: 'GET',
      dataType: 'json',
      data: { descripcion },
      success: function (response) {
        const { code, message, info, data } = response;

        if (code === 200) {
          let row = '';
          if (data && Array.isArray(data) && data.length > 0) {
            row = data.map(({
              codProducto, descripcion, abreviatura, codUnidadMedida,
              descripcionUnidadMedida, abreviaturaEstado, descripcionEstado, stock
            }) => {
              return `
                                <tr>
                                    <td>${codProducto}</td>
                                    <td>${descripcion}</td>                                   
                                    <td>${abreviatura}</td>
                                    <td hidden="hidden">${codUnidadMedida}</td>                                   
                                    <td>${descripcionUnidadMedida}</td>
                                    <td>${stock}</td>
                                    <td>
                                        <span class="estado ${abreviaturaEstado === "a" ? 'active' : 'inactive'}">
                                            ${descripcionEstado}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="actions actions_productos">
                                        
                                            ${abreviaturaEstado == 'i' ?
                  `<img id="btnHabilitarProducto" class="action action_habilitar" src="./assets/icons/action_habilitar.svg">` : ''}
                                            
                                            ${(abreviaturaEstado == 'a' || abreviaturaEstado == 'i') ?
                  `<img id="btnEditarProducto" class="action" src="./assets/icons/action_edit.svg">` : ''}
                                
                                            ${abreviaturaEstado == 'a' ?
                  `<img id="btnInhabilitarProducto" class="action" src="./assets/icons/action_deshabilitar.svg">` : ''}
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
  $(document).off("click", "#nuevoProducto").on("click", "#nuevoProducto", function (e) {
    e.preventDefault();
    let modalRegistrar = $("#modalRegistrarProducto");
    $("#registrarProductoForm").trigger("reset");

    modalRegistrar.modal({
      backdrop: 'static',
      keyboard: false
    });

    modalRegistrar.modal('show');

    modalRegistrar.one('shown.bs.modal', function () {
      $("#descripcionProducto").focus();
    });
  });

  //    registrar producto
  $(document).off("submit", "#registrarProductoForm").on('submit', '#registrarProductoForm', function (e) {
    e.preventDefault();
    const descripcion = $.trim($('#descripcionProducto').val());
    const abreviatura = $.trim($('#abreviatura').val());
    const unidadMedida = $.trim($('#cboUnidadMedida').val());
    console.log({ descripcion, abreviatura, unidadMedida })

    if (isFiledsValid(descripcion, abreviatura, unidadMedida)) {
      $.ajax({
        url: './controllers/productos/registrarProductos.php',
        method: 'POST',
        dataType: 'json',
        data: { descripcion, abreviatura, unidadMedida },
        success: function (response) {
          console.log(response)

          const { code, message, info, data } = response;

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
  $(document).off("click", "#btnEditarProducto").on("click", "#btnEditarProducto", function (e) {
    e.preventDefault();
    let modalEditar = $("#modalEditarProducto");
    let fila = $(this).closest("tr");
    let codProducto = fila.find('td:eq(0)').text();
    let descripcion = fila.find('td:eq(1)').text();
    let abreviatura = fila.find('td:eq(2)').text();
    let codUnidadMedida = fila.find('td:eq(3)').text();

    console.log({ codProducto, descripcion })

    $("#codProducto").val(codProducto.trim());
    $("#descripcionProductoEdit").val(descripcion.trim());
    $("#abreviaturaEdit").val(abreviatura.trim());
    $("#cboUnidadMedidaEdit").val(codUnidadMedida);

    modalEditar.modal({
      backdrop: 'static',
      keyboard: false
    });

    modalEditar.modal('show');

    modalEditar.one('shown.bs.modal', function () {
      $("#descripcionProductoEdit").focus();
    });
  });

  // Actualizar productos
  $(document).off("submit", "#editarProductoForm").on('submit', '#editarProductoForm', function (e) {
    e.preventDefault();
    const codProducto = $.trim($('#codProducto').val());
    const descripcion = $.trim($('#descripcionProductoEdit').val());
    const abreviatura = $.trim($('#abreviaturaEdit').val());
    const unidadMedida = $.trim($('#cboUnidadMedidaEdit').val());

    console.log({ codProducto, descripcion, abreviatura, unidadMedida })

    if (isFiledsValid(descripcion, abreviatura, unidadMedida)) {
      $.ajax({
        url: './controllers/productos/actualizar.php',
        method: 'POST',
        dataType: 'json',
        data: { codProducto, descripcion, abreviatura, unidadMedida },
        success: function (response) {
          console.log(response)
          const { code, message, info, data } = response;

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

  // Inhabilitar Producto
  $(document).off("click", "#btnInhabilitarProducto").on("click", "#btnInhabilitarProducto", function (e) {
    e.preventDefault();
    let fila = $(this).closest("tr");
    let nombres = fila.find('td:eq(2)').text();

    Swal.fire({
      icon: "warning",
      title: "¡Advertencia!",
      text: "¿Seguro que desea inhabilitar al Producto " + nombres + "?",
      width: "350px",
      showCancelButton: true,
      confirmButtonColor: "#13252E",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sí",
      cancelButtonText: "No"
    }).then((result) => {
      if (result.isConfirmed) {
        let fila = $(this).closest("tr");
        let codProducto = Number(fila.find('td:eq(0)').text());
        console.log(codProducto)

        $.ajax({
          url: './controllers/productos/inhabilitar.php',
          method: 'POST',
          dataType: 'json',
          data: { codProducto },
          success: function (response) {
            console.log(response)
            const { code, message, info, data } = response;

            if (code === 200) {
              Swal.fire({
                icon: "success",
                title: "¡Éxito!",
                text: message
              }).then(() => {
                listarProductos()
              });
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
    });


  });

    // habilitar productos
    $(document).off("click", "#btnHabilitarProducto").on("click", "#btnHabilitarProducto", function (e) {
      e.preventDefault();
      let fila = $(this).closest("tr");
      let nombres = fila.find('td:eq(2)').text();
  
      Swal.fire({
        icon: "warning",
        title: "¡Advertencia!",
        text: "¿Seguro que desea habilitar al producto " + nombres + "?",
        width: "350px",
        showCancelButton: true,
        confirmButtonColor: "#13252E",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí",
        cancelButtonText: "No"
      }).then((result) => {
        if (result.isConfirmed) {
          let fila = $(this).closest("tr");
          let codProducto = Number(fila.find('td:eq(0)').text());
          console.log(codProducto)
  
          $.ajax({
            url: './controllers/productos/habilitar.php',
            method: 'POST',
            dataType: 'json',
            data: { codProducto },
            success: function (response) {
              console.log(response)
              const { code, message, info, data } = response;
  
              if (code === 200) {
                Swal.fire({
                  icon: "success",
                  title: "¡Éxito!",
                  text: message
                }).then(() => {
                  listarProductos()
                });
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
      });
  
  
    });

  // Filtrar por nombre del producto
  $(document).off("input", "#descripcionProductoFiltro").on("input", "#descripcionProductoFiltro", function (e) {
    descripcionProducto = $(this).val();
    listarProductos(descripcionProducto)
  });

  function isFiledsValid(descripcion, abreviatura, unidadMedida) {
    const regexTexto = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;

    if (descripcion === '' || abreviatura == '' || unidadMedida == '' || unidadMedida === 0) {
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

  function showSuccessAlert(message) {
    Swal.fire({
      icon: "success",
      title: "Registro Exitoso",
      text: message
    }).then(() => {
      $('#modalRegistrarProducto').modal('hide');
      listarProductos();
    });
  }

  function showSuccessAlertUpdate(message) {
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


