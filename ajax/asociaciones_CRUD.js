$(document).ready(function () {

  let nombreAsociacion
  let codSector

  function listarAsociaciones(nombreAsociacion, codSector) {
    $.ajax({
      url: './controllers/asociacion/listarAsociaciones.php',
      method: 'GET',
      dataType: 'json',
      data: { nombreAsociacion, codSector },
      success: function (response) {
        const { code, message, info, data } = response;

        if (code === 200) {
          let row = '';
          if (data && Array.isArray(data) && data.length > 0) {
            row = data.map(({
              codAsociacion, codigoAsociacion, nombreAsociacion, codSectorZona,
              sector, direccion, presidenta, cantidadBeneficiarios,
              documento, abreviatura, estado, numeroFinca, observaciones, codTipoLocal, tipoLocal
            }) => {
              return `
                                <tr>
                                    <td>${codigoAsociacion}</td>
                                    <td hidden="hidden">${codAsociacion}</td>
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

                              `<div class="tooltip-container">
                                <img id="btnHabilitarAsociacion" class="action action_habilitar" src="./assets/icons/action_habilitar.svg">
                                <span class="custom-tooltip">Habilitar C. Madre</span>
                                </div>
                                ` : ''}
                                            
                                            
                                ${(abreviatura == 'a' || abreviatura == 'pr') ?

                              `
                                    <div class="tooltip-container">
                                    <img id="btnEditarAsociacion" class="action" src="./assets/icons/action_edit.svg">
                                    <span class="custom-tooltip">Editar C. Madre</span>
                                    
                                    ` : ''}    
                                            

                                    ${abreviatura == 'a' ?

                                    `<div class="tooltip-container">
                                    <img id="btnDetalleAsociacion" class="action" src="./assets/icons/action_ver_detalle.svg">
                                    <span class="custom-tooltip">Detalle C. Madre</span>
                                    ` : ''} 
                                    ${abreviatura == 'a' ?

                                    `
                                    <div class="tooltip-container">
                                    <img id="btnDeshabilitarAsociacion" class="action" src="./assets/icons/action_deshabilitar.svg">
                                    <span class="custom-tooltip">Deshabilitar C. Madre</span>    
                                            ` : ''}                                            
                                        </div>
                                    </td>
                                    <td hidden="hidden">${numeroFinca}</td>
                                    <td hidden="hidden">${observaciones}</td>
                                    <td hidden="hidden">${codTipoLocal}</td>
                                    <td hidden="hidden">${tipoLocal}</td>
                                </tr>
                            `
            })
            $("#listaAsociaciones").html(row)
          } else {
            row = `<tr><td colspan="10">Aún no existen club de madres en el sistema</td></tr>`
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

  listarAsociaciones(nombreAsociacion, codSector);

  //     nueva asociacion - abrir modal
  $(document).off("click", "#nuevaAsociacion").on("click", "#nuevaAsociacion", function (e) {
    e.preventDefault();
    let modalRegistrar = $("#modalRegistrarAsociacion");
    $("#registrarAsociacionForm").trigger("reset");

    modalRegistrar.modal({
      backdrop: 'static',
      keyboard: false
    });

    modalRegistrar.modal('show');

    modalRegistrar.one('shown.bs.modal', function () {
      $("#codigoAsociacion").focus();
    });
  });

  //     registrar asociacion
  $(document).off("submit", "#registrarAsociacionForm").on('submit', '#registrarAsociacionForm', function (e) {
    e.preventDefault();
    const codigoAsociacion = $.trim($('#codigoAsociacion').val());
    const nombre = $.trim($('#nombreAsociacion').val());
    const sector = Number($.trim($('#cboSectoresZonas').val()));
    const direccion = $.trim($('#direccion').val()).toUpperCase();
    const tipoLocal = Number($.trim($('#cboTiposLocales').val()));
    const numeroFinca = $.trim($('#numeroFinca').val());
    const observacion = $.trim($('#obervacionAsociacion').val());

    if (isFiledsValid(codigoAsociacion, nombre, sector, direccion, tipoLocal)) {
      $.ajax({
        url: './controllers/asociacion/registrar.php',
        method: 'POST',
        dataType: 'json',
        data: { codigoAsociacion, nombre, sector, direccion, tipoLocal, numeroFinca, observacion },
        success: function (response) {
          const { code, message, info, data } = response;

          if (code === 200) {
            showSuccessAlert(message)
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
  })

  //     editar asociacion - abrir modal
  $(document).off("click", "#btnEditarAsociacion").on("click", "#btnEditarAsociacion", function (e) {
    e.preventDefault();
    let modalEditar = $("#modalEditarAsociacion");
    let fila = $(this).closest("tr");
    let codigoAsociacion = fila.find('td:eq(0)').text();
    let codAsociacion = fila.find('td:eq(1)').text();
    let nombreAsociacion = fila.find('td:eq(2)').text();
    let codSectorZona = fila.find('td:eq(3)').text();
    let direccion = fila.find('td:eq(5)').text();
    let numeroFinca = fila.find('td:eq(11)').text();
    let observaciones = fila.find('td:eq(12)').text();
    let tipoLocal = fila.find('td:eq(13)').text();

    $("#codAsociacion").val(codAsociacion.trim());
    $("#codigoAsociacionEdit").val(codigoAsociacion.trim());
    $("#nombreAsociacionEdit").val(nombreAsociacion.trim());
    $("#cboSectoresZonasEdit").val(codSectorZona);
    $("#cboTiposLocalesEdit").val(tipoLocal);
    $("#direccionEdit").val(direccion.trim());
    $("#numeroFincaEdit").val(numeroFinca.trim() === '0' ? '' : numeroFinca.trim());
    $("#obervacionAsociacionEdit").val(observaciones.trim());

    modalEditar.modal({
      backdrop: 'static',
      keyboard: false
    });

    modalEditar.modal('show');

    modalEditar.one('shown.bs.modal', function () {
      $("#codigoAsociacionEdit").focus();
    });
  });

  // Actualizar asociacion
  $(document).off("submit", "#editarAsociacionForm").on('submit', '#editarAsociacionForm', function (e) {
    e.preventDefault();
    const codAsociacion = $.trim($('#codAsociacion').val());
    const codigoAsociacion = $.trim($('#codigoAsociacionEdit').val());
    const nombre = $.trim($('#nombreAsociacionEdit').val());
    const sector = Number($.trim($('#cboSectoresZonasEdit').val()));
    const direccion = $.trim($('#direccionEdit').val()).toUpperCase();
    const tipoLocal = Number($.trim($('#cboTiposLocalesEdit').val()));
    const numeroFinca = $.trim($('#numeroFincaEdit').val());
    const observacion = $.trim($('#obervacionAsociacionEdit').val());

    console.log({ codAsociacion, nombre, sector, direccion, direccion, tipoLocal, numeroFinca, observacion })

    if (isFiledsValid(codigoAsociacion, nombre, sector, direccion, tipoLocal)) {
      $.ajax({
        url: './controllers/asociacion/actualizar.php',
        method: 'POST',
        dataType: 'json',
        data: { codAsociacion, codigoAsociacion, nombre, sector, direccion, tipoLocal, numeroFinca, observacion },
        success: function (response) {
          const { code, message, info, data } = response;

          if (code === 200) {
            showSuccessAlertUpdate(message)
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
  })

  // Deshabilitar una asociación
  $(document).off("click", "#btnDeshabilitarAsociacion").on("click", "#btnDeshabilitarAsociacion", function (e) {
    e.preventDefault();
    let fila = $(this).closest("tr");
    let nombres = fila.find('td:eq(2)').text();

    Swal.fire({
      icon: "warning",
      title: "¡Advertencia!",
      text: "¿Seguro que desea inhabilitar a la asociación " + nombres + "?",
      width: "350px",
      showCancelButton: true,
      confirmButtonColor: "#13252E",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sí",
      cancelButtonText: "No"
    }).then((result) => {
      if (result.isConfirmed) {
        let fila = $(this).closest("tr");
        let codAsociacion = Number(fila.find('td:eq(1)').text());
        console.log(codAsociacion);

        $.ajax({
          url: './controllers/asociacion/inhabilitar.php',
          method: 'POST',
          dataType: 'json',
          data: { codAsociacion },
          success: function (response) {
            console.log(response)
            const { code, message, info, data } = response;

            if (code === 200) {
              Swal.fire({
                icon: "success",
                title: "¡Éxito!",
                text: message
              }).then(() => {
                listarAsociaciones()
              });
            }

            if (code === 500) {
              showErrorInternalServer(message, info)
            }
          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.error('Error asociaciones_CRUD.js: ', textStatus, errorThrown);
          }
        })
      }

    })

  });

  // Habilitar una asociación
  $(document).off("click", "#btnHabilitarAsociacion").on("click", "#btnHabilitarAsociacion", function (e) {
    e.preventDefault();
    let fila = $(this).closest("tr");
    let nombres = fila.find('td:eq(2)').text();

    Swal.fire({
      icon: "warning",
      title: "¡Advertencia!",
      text: "¿Seguro que desea habilitar a la asociación " + nombres + "?",
      width: "350px",
      showCancelButton: true,
      confirmButtonColor: "#13252E",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sí",
      cancelButtonText: "No"
    }).then((result) => {
      if (result.isConfirmed) {
        let fila = $(this).closest("tr");
        let codAsociacion = Number(fila.find('td:eq(1)').text());
        console.log(codAsociacion);

        $.ajax({
          url: './controllers/asociacion/habilitar.php',
          method: 'POST',
          dataType: 'json',
          data: { codAsociacion },
          success: function (response) {
            console.log(response)
            const { code, message, info, data } = response;

            if (code === 200) {
              Swal.fire({
                icon: "success",
                title: "¡Éxito!",
                text: message
              }).then(() => {
                listarAsociaciones()
              });
            }

            if (code === 500) {
              showErrorInternalServer(message, info)
            }
          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.error('Error asociaciones_CRUD.js: ', textStatus, errorThrown);
          }
        })
      }

    })

  });

  // Filtrar por nombre de la asociacion
  $(document).off("input", "#nombreAsociacionFiltro").on("input", "#nombreAsociacionFiltro", function (e) {
    nombreAsociacion = $(this).val();
    listarAsociaciones(nombreAsociacion, codSector)
  });

  // Detalle de la asociacion
  $(document).off("click", "#btnDetalleAsociacion").on("click", "#btnDetalleAsociacion", function (e) {

    let fila = $(this).closest("tr");
    let codAsociacion = fila.find('td:eq(1)').text();
    let nombreAsociacion = fila.find('td:eq(2)').text();
    let sectorZona = fila.find('td:eq(4)').text();
    let direccion = fila.find('td:eq(5)').text();
    let numeroFinca = fila.find('td:eq(11)').text();
    let observaciones = fila.find('td:eq(12)').text();
    let tipoLocal = fila.find('td:eq(14)').text();

    $.ajax({
      url: './controllers/reconocimiento/listar.php',
      method: 'GET',
      dataType: 'json',
      data: { codAsociacion },
      success: function (response) {
        const { code, message, info, data } = response;

        if (code === 200) {
          $("#nombreAsociacionDetalle").val(nombreAsociacion)
          $("#sectorZonaAsociacionDetalle").val(sectorZona)
          $("#direccionAsociacionDetalle").val(direccion)
          $("#tipoLocalAsociacionDetalle").val(tipoLocal)
          $("#numeroFincaAsociacionDetalle").val(numeroFinca == 0 ? '' : numeroFinca)
          $("#obervacionAsociacionDetalle").val(observaciones)

          let reconocimientos = data.map(reconocimiento => {
            return `
                        <div class="detalle-reconocimiento">
                            <div class="detalle-reconocimiento__estado"></div>
                            <div class="two-column">
                                <label for="documento">Documento:</label>
                                <input
                                        disabled
                                        class="colorDisable"
                                        type="text"                                       
                                        value="${reconocimiento.documento}"
                                >
                            </div>
                            <div>
                                <div class="fecha-inicio">
                                    <label>Fecha Inicio:</label>
                                    <input
                                            disabled
                                            class="colorDisable"
                                            type="date"
                                            value="${reconocimiento.fechaInicio}"                                           
                                    >
                                </div>

                                <div class="fecha-fin">
                                    <label>Fecha Fin:</label>
                                    <input
                                            disabled
                                            class="colorDisable"
                                            type="date"
                                            value="${reconocimiento.fechaFin}"
                                    >
                                </div>
                            </div>
                        </div>                                                                      
                        `
          })

          $('.modal-body-detalle-reconocimientos').html(reconocimientos)
        }

        if (code === 500) {
          showErrorInternalServer(message, info)
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error('Error asociacionesCRUD.js: ', textStatus, errorThrown);
      }
    })


    e.preventDefault();
    let modalDetalle = $("#modalDetalleAsociacion");
    $("#detalleAsociacionForm").trigger("reset");

    modalDetalle.modal({
      backdrop: 'static',
      keyboard: false
    });

    modalDetalle.modal('show');

    modalDetalle.one('shown.bs.modal', function () {
      $("#nombresNuevo").focus();
    });
  });

  function obtenerReconocimientos() {

  }

  // Filtrar por sector
  $(document).off("input", "#cboSectores").on("input", "#cboSectores", function (e) {
    codSector = $(this).val();
    if (codSector === 0 || codSector === '0') {
      codSector = undefined
    }
    console.log({ nombreAsociacion, codSector })
    listarAsociaciones(nombreAsociacion, codSector)
  });


  function isFiledsValid(codigoAsociacion, nombre, sector, direccion, tipoLocal) {
    if (codigoAsociacion == 0 || codigoAsociacion === '' || nombre === '' || sector == '' || sector === 0 || direccion == '' || tipoLocal == '' || tipoLocal === 0) {
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
      $('#modalRegistrarAsociacion').modal('hide');
      listarAsociaciones();
    });
  }

  function showSuccessAlertUpdate(message) {
    Swal.fire({
      icon: "success",
      title: "Actualización Exitoso",
      text: message
    }).then(() => {
      $('#modalEditarAsociacion').modal('hide');
      listarAsociaciones();
    });
  }

})