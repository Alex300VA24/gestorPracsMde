$(document).ready(function () {
  $(document).off("click", "#btnLogin").on("click", "#btnLogin", function (e) {
    e.preventDefault();
    const user = $("#username").val().trim();
    const password = $("#password").val().trim();

    if (isFiledsValid(user, password)) {
      $.ajax({
        url: './controllers/autenticacion/login.php',
        method: 'GET',
        dataType: 'text',
        data: { user, password },
        success: function (response) {
          console.log(response)
          const { code, message, info, data } = response;
          if (code === 404) {
            showAlertCredentialsIncorrect();
            return;
          }

          if (code === 200) {
            showModalAutenticacionCUI();
            validateCUI(data);
          }

          if (code === 500) {
            showErrorInternalServer(message, info)
          }

        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.error('Error fetching the content:', textStatus, errorThrown);
        }
      })
      console.log({ user, password })
    }

  })

  function validateCUI(data) {
    const { cui } = data;
    $(document).off("click", "#btnConfirmarCUI").on("click", "#btnConfirmarCUI", function (e) {
      e.preventDefault();
      let valueCUI = $("#cui").val();

      if (!isValidFieldCUI(valueCUI)) return

      if (cui !== valueCUI) {
        showAlertIncorrectCUI();
      } else {
        $.ajax({
          url: './controllers/autenticacion/ingresar.php',
          method: 'POST',
          dataType: 'json',
          data: { data },
          success: function (response) {
            if (response) {
              location.reload();
            }
          }, error: function (jqXHR, textStatus, errorThrown) {
            console.error('Error fetching the content:', textStatus, errorThrown);
          }
        })
      }
    })
  }

  function showAlertIncorrectCUI() {
    Swal.fire({
      title: "¡Error!",
      text: 'El c&ocute;digo único de idenficicación (CUI) no coincide con el del usuario registrado',
      icon: "error",
      width: "350px",
      confirmButtonColor: "#13252E",
    });
  }

  function isValidFieldCUI(cui) {
    if (!/^[0-9]$/.test(cui) || cui === '') {
      console.log("cui invalido")
      Swal.fire({
        title: "¡Advertencia!",
        text: 'Ingrese un CUI valido',
        icon: "warning",
        width: "350px",
        confirmButtonColor: "#13252E",
      });
      return false;
    }
    return true;
  }

  function showModalAutenticacionCUI() {
    let modalValidarCUI = $("#modalValidarCUI");
    $("#validarCUIForm").trigger("reset");

    modalValidarCUI.modal({
      backdrop: 'static',
      keyboard: false
    });

    modalValidarCUI.modal('show');

    modalValidarCUI.on('shown.bs.modal', function () {
      $("#cui").focus();
    });

    $(document).off("click", "#btnCancelarCUI").on("click", "#btnCancelarCUI", function (e) {
      showAlertAutenticacionIncompled()
      return
    })
  }

  function showAlertAutenticacionIncompled() {
    Swal.fire({
      title: "¡Advertencia!",
      text: 'Necesita completar la autenticación de doble factor para ingresar al sistema',
      icon: "warning",
      width: "350px",
      confirmButtonColor: "#13252E",
    });
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

  function showAlertCredentialsIncorrect() {
    Swal.fire({
      title: "¡Advertencia!",
      text: 'Las credenciales ingresadas son incorrectas',
      icon: "warning",
      width: "350px",
      confirmButtonColor: "#13252E",
    });
  }

  function isFiledsValid(user, password) {
    if (user === '' || password === '') {
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
})