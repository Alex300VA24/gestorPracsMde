<div id="modalRegistrarReconocimiento" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modalReconocimiento modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Reconocimiento</h5>
            </div>
            <form class="" id="registrarReconocimientoForm" action="" method="post">
                <div class="modal-body">
                    <div class="d-flex gap-3 flex-grow-1">
                        <div class="two-column">
                            <label for="sector">Club de madre (*):</label>
                            <select id="cboAsociacionesNuevasYReconocimientoVencido" class="form-select">
                            </select>
                        </div>
                        <div class="two-column flex-grow-1">
                            <label for="documentoReconocimiento">Documento (*):</label>
                            <input
                                    type="text"
                                    id="documentoReconocimiento"
                                    autocomplete="off"
                                    maxlength="100"
                            >
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="two-column flex-grow-1">
                            <label for="direccion">Fecha Inicio (*):</label>
                            <input
                                    type="date"
                                    id="fechaInicioReconocimiento"
                            >
                        </div>
                        <div class="two-column flex-grow-1">
                            <label for="direccion">Fecha Fin (*):</label>
                            <input
                                    class="colorDisable"
                                    disabled
                                    type="date"
                                    id="fechaFinReconocimiento"
                            >
                        </div>
                    </div>
                    <div>
                        <div class="header_container_data">
                            <h2>Presidenta</h2>
                        </div>
                        <div class="d-flex gap-3">
                            <div class="two-column flex-grow-1">
                                <label for="nombreAsociacion">DNI (*):</label>
                                <input
                                        disabled
                                        class="dniCargos colorDisable"
                                        type="text"
                                        id="dniPresidentaReconocimiento"
                                        autocomplete="off"
                                        maxlength="8"
                                >
                            </div>
                            <div class="two-column flex-grow-1">
                                <label for="nombreAsociacion">Nombres (*):</label>
                                <input
                                        class="colorDisable nombresCargo"
                                        disabled
                                        type="text"
                                        id="nombrePresidentaReconocimiento"
                                        autocomplete="off"
                                >
                            </div>
                            <input
                                    hidden="hidden"
                                    class="codCargo"
                                    disabled
                                    type="number"
                                    id="codPresidenta"
                            >
                        </div>
                    </div>

                    <div>
                        <div class="header_container_data">
                            <h2>Vice Presidenta</h2>
                        </div>
                        <div class="d-flex gap-3">
                            <div class="two-column flex-grow-1">
                                <label for="dniVicePresidentaReconocimiento">DNI (*):</label>
                                <input
                                        disabled
                                        class="dniCargos colorDisable"
                                        type="text"
                                        id="dniVicePresidentaReconocimiento"
                                        autocomplete="off"
                                        maxlength="8"
                                >
                            </div>
                            <div class="two-column flex-grow-1">
                                <label for="nombreVicePresidentaReconocimiento">Nombres (*):</label>
                                <input
                                        class="colorDisable nombresCargo"
                                        disabled
                                        type="text"
                                        id="nombreVicePresidentaReconocimiento"
                                        autocomplete="off"
                                >
                            </div>
                            <input
                                    hidden="hidden"
                                    class="codCargo"
                                    disabled
                                    type="number"
                                    id="codVicePresidenta"
                            >
                        </div>
                    </div>

                    <div>
                        <div class="header_container_data">
                            <h2>Tesorera</h2>
                        </div>
                        <div class="d-flex gap-3">
                            <div class="two-column flex-grow-1">
                                <label for="dniTesoreraReconocimiento">DNI (*):</label>
                                <input
                                        disabled
                                        class="dniCargos colorDisable"
                                        type="text"
                                        id="dniTesoreraReconocimiento"
                                        autocomplete="off"
                                        maxlength="8"
                                >
                            </div>
                            <div class="two-column flex-grow-1">
                                <label for="nombreTesoreraReconocimiento">Nombres (*):</label>
                                <input
                                        class="colorDisable nombresCargo"
                                        disabled
                                        type="text"
                                        id="nombreTesoreraReconocimiento"
                                        autocomplete="off"
                                >
                            </div>
                            <input
                                    hidden="hidden"
                                    class="codCargo"
                                    disabled
                                    type="number"
                                    id="codTesorera"
                            >
                        </div>
                    </div>

                    <div>
                        <div class="header_container_data">
                            <h2>Vocal</h2>
                        </div>
                        <div class="d-flex gap-3">
                            <div class="two-column flex-grow-1">
                                <label for="dniVocalReconocimiento">DNI (*):</label>
                                <input
                                        disabled
                                        class="dniCargos colorDisable"
                                        type="text"
                                        id="dniVocalReconocimiento"
                                        autocomplete="off"
                                        maxlength="8"
                                >
                            </div>
                            <div class="two-column flex-grow-1">
                                <label for="nombreVocalReconocimiento">Nombres (*):</label>
                                <input
                                        class="colorDisable nombresCargo"
                                        disabled
                                        type="text"
                                        id="nombreVocalReconocimiento"
                                        autocomplete="off"
                                >
                            </div>
                            <input
                                    hidden="hidden"
                                    class="codCargo"
                                    disabled
                                    type="number"
                                    id="codVocal"
                            >
                        </div>
                    </div>

                    <div>
                        <div class="header_container_data">
                            <h2>Coordinadora</h2>
                        </div>
                        <div class="d-flex gap-3">
                            <div class="two-column flex-grow-1">
                                <label for="dniCoordinadoraReconocimiento">DNI (*):</label>
                                <input
                                        disabled
                                        class="dniCargos colorDisable"
                                        type="text"
                                        id="dniCoordinadoraReconocimiento"
                                        autocomplete="off"
                                        maxlength="8"
                                >
                            </div>
                            <div class="two-column flex-grow-1">
                                <label for="nombreVocalReconocimiento">Nombres (*):</label>
                                <input
                                        class="colorDisable nombresCargo"
                                        disabled
                                        type="text"
                                        id="nombreCoordinadoraReconocimiento"
                                        autocomplete="off"
                                >
                            </div>
                            <input
                                    hidden="hidden"
                                    class="codCargo"
                                    disabled
                                    type="number"
                                    id="codCoordinadora"
                            >
                        </div>
                    </div>

                    <div>
                        <div class="header_container_data">
                            <h2>Almacenera</h2>
                        </div>
                        <div class="d-flex gap-3">
                            <div class="two-column flex-grow-1">
                                <label for="dniAlmaceneraReconocimiento">DNI (*):</label>
                                <input
                                        disabled
                                        class="dniCargos colorDisable"
                                        type="text"
                                        id="dniAlmaceneraReconocimiento"
                                        autocomplete="off"
                                        maxlength="8"
                                >
                            </div>
                            <div class="two-column flex-grow-1">
                                <label for="nombreAlmaceneraReconocimiento">Nombres (*):</label>
                                <input
                                        class="colorDisable nombresCargo"
                                        disabled
                                        type="text"
                                        id="nombreAlmaceneraReconocimiento"
                                        autocomplete="off"
                                >
                            </div>
                            <input
                                    hidden="hidden"
                                    class="codCargo"
                                    disabled
                                    type="number"
                                    id="codAlmacenera"
                            >
                        </div>
                    </div>

                    <div>
                        <div class="header_container_data">
                            <h2>Fiscalizador</h2>
                        </div>
                        <div class="d-flex gap-3">
                            <div class="two-column flex-grow-1">
                                <label for="dniFiscalizadorReconocimiento">DNI (*):</label>
                                <input
                                        disabled
                                        class="dniCargos colorDisable"
                                        type="text"
                                        id="dniFiscalizadorReconocimiento"
                                        autocomplete="off"
                                        maxlength="8"
                                >
                            </div>
                            <div class="two-column flex-grow-1">
                                <label for="nombreFiscalizadorReconocimiento">Nombres (*):</label>
                                <input
                                        class="colorDisable nombresCargo"
                                        disabled
                                        type="text"
                                        id="nombreFiscalizadorReconocimiento"
                                        autocomplete="off"
                                >
                            </div>
                            <input
                                    hidden="hidden"
                                    class="codCargo"
                                    disabled
                                    type="number"
                                    id="codFiscalizador"
                            >
                        </div>
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

