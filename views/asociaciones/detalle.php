<div id="modalDetalleAsociacion" class="modalPersonalizado modal fade" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modalAsocacionDetalle modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalle Club de Madre</h5>
            </div>
            <form class="formAsociacionDetalle" id="detalleAsociacionForm" action="" method="post">
                <div>
                    <div class="header_container_data">
                        <h2>Datos del club de madre</h2>
                    </div>
                    <div class="modal-body-detalle-asociacion">
                        <div class="two-column">
                            <label for="nombreAsociacion">Nombre:</label>
                            <input
                                    disabled
                                    class="colorDisable"
                                    type="text"
                                    id="nombreAsociacionDetalle"
                                    autocomplete="off"
                                    maxlength="100"
                            >
                        </div>
                        <div class="two-column">
                            <label for="sector">Sector y Zona:</label>
                            <input
                                    disabled
                                    class="colorDisable"
                                    type="text"
                                    id="sectorZonaAsociacionDetalle"
                                    autocomplete="off"
                                    maxlength="100"
                            >
                        </div>
                        <div class="two-column">
                            <label for="direccion">Dirección:</label>
                            <input
                                    disabled
                                    class="colorDisable"
                                    type="text"
                                    id="direccionAsociacionDetalle"
                                    autocomplete="off"
                                    maxlength="200"
                            >
                        </div>
                        <div class="two-column">
                            <label for="tipoLocal">Tipo Local:</label>
                            <input
                                    disabled
                                    class="colorDisable"
                                    type="text"
                                    id="tipoLocalAsociacionDetalle"
                                    autocomplete="off"
                                    maxlength="200"
                            >
                        </div>
                        <div class="two-column">
                            <label for="nombreAsociacion">Número Finca:</label>
                            <input
                                    disabled
                                    class="colorDisable"
                                    type="number"
                                    id="numeroFincaAsociacionDetalle"
                                    autocomplete="off"
                            >
                        </div>
                        <div class="two-column campoObservacion">
                            <label for="observacion" class="form-label col-sm-4">Obervación:</label>
                            <textarea id="obervacionAsociacionDetalle" class="form-control colorDisable"
                                      disabled></textarea>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="header_container_data">
                        <h2>Reconocimientos</h2>
                    </div>
                    <div class="modal-body-detalle-reconocimientos">
                    </div>
                </div>

                <div class="containerButtonsModal justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

