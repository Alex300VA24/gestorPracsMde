<div id="modalRegistrarAsociacion" class="modalPersonalizado modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Club de Madre</h5>
            </div>
            <form class="formArea" id="registrarAsociacionForm" action="" method="post">
                <div class="modal-body">
                    <div class="two-column">
                        <label for="nombreAsociacion">Nombre (*):</label>
                        <input
                                type="text"
                                id="nombreAsociacion"
                                autocomplete="off"
                                maxlength="100"
                        >
                    </div>
                    <div class="two-column">
                        <label for="sector">Sector y Zona (*):</label>
                        <select id="cboSectoresZonas" class="form-select">
                        </select>
                    </div>
                    <div class="two-column">
                        <label for="direccion">Dirección (*):</label>
                        <input
                                type="text"
                                id="direccion"
                                autocomplete="off"
                                maxlength="200"
                        >
                    </div>
                    <div class="two-column">
                        <label for="tipoLocal">Tipo Local (*):</label>
                        <select id="cboTiposLocales" class="form-select">
                        </select>
                    </div>
                    <div class="two-column">
                        <label for="nombreAsociacion">Número Finca:</label>
                        <input
                                type="number"
                                id="numeroFinca"
                                autocomplete="off"
                        >
                    </div>
                    <div class="two-column campoObservacion">
                        <label for="observacion" class="form-label col-sm-4">Obervación:</label>
                        <textarea id="obervacionAsociacion" class="form-control"></textarea>
                    </div>
                    <p>Todos los campos (*) son obligatorios</p>
                </div>
                <div class="containerButtonsModal">
                    <input type="submit" class="btn btn-primary" value="Registrar">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

