<div id="modalValidarCUI" class="modalCUI modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Autenticación de Doble Factor - CUI</h5>
            </div>
            <form class="formValidarCUI" id="validarCUIForm" action="" method="post">
                <div class="modal-body">

                    <div class="containerGuiaCUI">
                        <p>
                            Busca tu código único de Identificación (CUI) en tu DNI e ingrésalo en el cuadro de abajo.
                        </p>
                        <img src="<?= base_url?>/assets/dniGuiCUI.svg" alt="" srcset="">
                    </div>

                    <div class="containerCUI">
                        <label for="cui" class="form-label">Código único de Identificación (CUI):</label>
                        <input type="text" id="cui" maxlength="1" autocomplete="off" maxlength="50">
                    </div>
                </div>
                <div class="containerButtonsModals">
                    <input type="submit" id="btnConfirmarCUI" class="btn btn-submit" value="Confirmar">
                    <input type="button" id="btnCancelarCUI" class="btn btn-cancel" data-bs-dismiss="modal" value="Cancelar">
                </div>
            </form>
        </div>
    </div>
</div>