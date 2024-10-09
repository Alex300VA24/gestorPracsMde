<div id="modalValidarCUI" class="modalArea modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Autenticación de Doble Factor - CUI</h5>
            </div>
            <form class="formValidarCUI" id="validarCUIForm" action="" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="descripcionIndicacion" class="form-label">CUI (*):</label>
                        <input type="text" id="cui" autocomplete="off" maxlength="50">
                    </div>
                    <p>Todos los campos (*) son obligatorios</p>
                </div>
                <div class="containerButtonsEditarArea">
                    <input type="submit" id="btnConfirmarCUI" class="btn" value="Confirmar">
                    <button type="button" id="btnCancelarCUI" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>