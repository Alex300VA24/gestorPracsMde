<div id="modalDetalleBeneficiario" class="modalPersonalizado modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modalActualizarSocio modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalle Beneficiario</h5>
            </div>
            <form id="detalleBeneficiarioForm" action="" method="post">
                <div class="modal-body">
                    <div class="formDatosBeneficiario">
                        <div class="body_container_data modal-body-detalle-beneficiario">
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
                                    id="nombresBeneficiarioDetalle"
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
                                    id="apellidoPaternoBeneficiarioDetalle"
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
                                    id="apellidoMaternoBeneficiarioDetalle"
                                    autocomplete="off"
                                    maxlength="100"
                                >
                            </div>

                            <div>
                                <label for="dni">Sexo (*):</label>
                                <select
                                    disabled
                                    id="sexoBeneficiariooDetalle"
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
                                    id="telefonoBeneficiarioDetalle"
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
                                    id="celularBeneficiarioDetalle"
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
                                    id="fechaNacimientoBeneficiarioDetalle"
                                    max=""
                                >
                            </div>

                            <div>
                                <label for="edad">Edad (*):</label>
                                <input
                                    class="colorDisable"
                                    disabled
                                    type="number"
                                    id="edadBeneficiarioDetalle"
                                >
                            </div>

                            <div>
                                <label for="sectorZona">Sector y Zona (*):</label>
                                <select
                                    disabled
                                    class="form-control colorDisable"
                                    id="cboSectorZonaDetalleBeneficiario"></select>
                            </div>

                            <div>
                                <label for="direccionBeneficiario">Dirección (*):</label>
                                <input
                                    disabled
                                    class="colorDisable"
                                    type="text"
                                    id="direccionBeneficiarioDetalle"
                                    autocomplete="off"
                                    maxlength="100"
                                >
                            </div>

                            <div>
                                <label for="numeroFincaBeneficiarioDetalle">Número de finca:</label>
                                <input
                                    disabled
                                    class="colorDisable"
                                    type="number"
                                    id="numeroFincaBeneficiarioDetalle"
                                    autocomplete="off"
                                >
                            </div>

                            <div>
                                <label for="direccionBeneficiario">Club de madre (*):</label>
                                <select
                                    disabled
                                    class="form-control colorDisable"
                                    id="cboClubDeMadresActivosDetalle"></select>
                            </div>

                            <div>
                                <label>Estado:</label>
                                <span class="estado estadoDetalle" id="estadoBeneficiariooDetalle"></span>
                            </div>

                            <div class="observaciones">
                                <label for="observaciones">Observaciones:</label>
                                <textarea
                                    disabled
                                    id="observacionBeneficiarioDetalle"
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

