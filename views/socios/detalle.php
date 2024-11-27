<div id="modalDetalleSocio" class="modalPersonalizado modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modalActualizarSocio modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalle Socio</h5>
            </div>
            <form id="detalleSocioForm" action="" method="post">
                <div class="modal-body">
                    <div class="formDatosSocio">
                        <div class="body_container_data modal-body-detalle-socio">
                            <div>
                                <label for="dni">DNI (*):</label>
                                <input
                                    disabled
                                    class="colorDisable"
                                    type="text"
                                    id="dniSocioDetalle"
                                    maxlength="8"
                                >
                            </div>

                            <div>
                                <label for="dni">Nombres (*):</label>
                                <input
                                    disabled
                                    class="colorDisable"
                                    type="text"
                                    id="nombresSocioDetalle"
                                    autocomplete="off"
                                    maxlength="100"
                                >
                            </div>

                            <div>
                                <label for="dni">Apellido Paterno (*):</label>
                                <input
                                    disabled
                                    class="colorDisable"
                                    type="text"
                                    id="apellidoPaternoSocioDetalle"
                                    autocomplete="off"
                                    maxlength="100"
                                >
                            </div>

                            <div>
                                <label for="dni">Apellido Materno (*):</label>
                                <input
                                    disabled
                                    class="colorDisable"
                                    type="text"
                                    id="apellidoMaternoSocioDetalle"
                                    autocomplete="off"
                                    maxlength="100"
                                >
                            </div>

                            <div>
                                <label for="dni">Sexo (*):</label>
                                <select
                                    disabled
                                    id="sexoSocioDetalle"
                                    class="form-control colorDisable"
                                >
                                    <option value="0" selected>Seleccionar</option>
                                    <option value="f">Femenino</option>
                                    <option value="m">Masculino</option>
                                </select>
                            </div>

                            <div>
                                <label for="dni">Telefono:</label>
                                <input
                                    disabled
                                    class="colorDisable"
                                    type="text"
                                    id="telefonoSocioDetalle"
                                    autocomplete="off"
                                    maxlength="6"
                                >
                            </div>

                            <div>
                                <label for="dni">Celular:</label>
                                <input
                                    disabled
                                    class="colorDisable"
                                    type="text"
                                    id="celularSocioDetalle"
                                    autocomplete="off"
                                    maxlength="9"
                                >
                            </div>

                            <div>
                                <label for="fechaNacimiento">Fecha Nacimiento (*):</label>
                                <input
                                    disabled
                                    class="colorDisable"
                                    type="date"
                                    id="fechaNacimientoSocioDetalle"
                                    max=""
                                >
                            </div>

                            <div>
                                <label for="edad">Edad (*):</label>
                                <input
                                    class="colorDisable"
                                    disabled
                                    type="number"
                                    id="edadSocioDetalle"
                                >
                            </div>

                            <div>
                                <label for="sectorZona">Sector y Zona (*):</label>
                                <select
                                    disabled
                                    class="form-control colorDisable"
                                    id="cboSectorZonaDetalleSocio"></select>
                            </div>

                            <div>
                                <label for="direccionSocio">Dirección (*):</label>
                                <input
                                    disabled
                                    class="colorDisable"
                                    type="text"
                                    id="direccionSocioDetalle"
                                    autocomplete="off"
                                    maxlength="100"
                                >
                            </div>

                            <div>
                                <label for="numeroFincaSocioDetalle">Número de finca:</label>
                                <input
                                    disabled
                                    class="colorDisable"
                                    type="number"
                                    id="numeroFincaSocioDetalle"
                                    autocomplete="off"
                                >
                            </div>

                            <div>
                                <label for="direccionSocio">Club de madre (*):</label>
                                <select
                                    disabled
                                    class="form-control colorDisable"
                                    id="cboClubDeMadresActivosDetalle"></select>
                            </div>

                            <div>
                                <label>Estado:</label>
                                <span class="estado estadoDetalle" id="estadoSocioDetalle"></span>
                            </div>

                            <div class="observaciones">
                                <label for="observaciones">Observaciones:</label>
                                <textarea
                                    disabled
                                    id="observacionSocioDetalle"
                                    class="form-control colorDisable">
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="containerButtonsModal justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

