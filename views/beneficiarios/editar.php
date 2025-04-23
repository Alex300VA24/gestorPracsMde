<div id="modalEditarBeneficiario" class="modalPersonalizado modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modalActualizarBeneficiario modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Datos Beneficiario</h5>
            </div>
            <form id="editarBeneficiarioForm" action="" method="post">
                <div class="modal-body">
                    <div class="formDatosBeneficiario">
                        <div class="body_container_data">
                            <input 
                            type="number" 
                            id="codBeneEditar" 
                            hidden="hidden">
                            
                            <input type="number" id="codPersonaEditarBeneficiario" hidden="hidden">
                            <div>
                                <label for="dni">DNI (*):</label>
                                <input type="text" id="dniBeneficiarioEditar" autocomplete="off" maxlength="8" required>
                            </div>
                            <div>
                                <label for="nombres">Nombres (*):</label>
                                <input type="text" id="nombresBeneficiarioEditar" autocomplete="off" maxlength="100" required>
                            </div>
                            <div>
                                <label for="apellidoPaterno">Apellido Paterno (*):</label>
                                <input type="text" id="apellidoPaternoBeneficiarioEditar" autocomplete="off" maxlength="100" required>
                            </div>
                            <div>
                                <label for="apellidoMaterno">Apellido Materno (*):</label>
                                <input type="text" id="apellidoMaternoBeneficiarioEditar" autocomplete="off" maxlength="100" required>
                            </div>
                            <div>
                                <label for="sexo">Sexo (*):</label>
                                <select id="sexoBeneficiarioEditar" class="form-control" required>
                                    <option value="0" selected>Seleccionar</option>
                                    <option value="f">Femenino</option>
                                    <option value="m">Masculino</option>
                                </select>
                            </div>
                            <div>
                                <label for="telefono">Teléfono:</label>
                                <input type="text" id="telefonoBeneficiarioEditar" autocomplete="off" maxlength="6">
                            </div>
                            <div>
                                <label for="celular">Celular:</label>
                                <input type="text" id="celularBeneficiarioEditar" autocomplete="off" maxlength="9">
                            </div>
                            <div>
                                <label for="fechaNacimiento">Fecha Nacimiento (*):</label>
                                <input type="date" id="fechaNacimientoBeneficiarioEditar" max="" required>
                            </div>
                            <div>
                                <label for="edad">Edad (*):</label>
                                <input class="colorDisable" disabled type="number" id="edadBeneficiarioEditar">
                            </div>
                            <div>
                                <label for="sectorZona">Sector y Zona (*):</label>
                                <select class="form-control" id="cboSectorZonaEditarBeneficiario" required></select>
                            </div>
                            <div>
                                <label for="direccionBeneficiario">Dirección (*):</label>
                                <input type="text" id="direccionBeneficiarioEditar" autocomplete="off" maxlength="100" required>
                            </div>
                            <div>
                                <label for="numeroFinca">Número de finca:</label>
                                <input type="number" id="numeroFincaBeneficiarioEditar" autocomplete="off">
                            </div>
                            <div>
                                <label for="clubDeMadre">Club de madre (*):</label>
                                <select class="form-control" id="cboClubDeMadresActivosEditar" required></select>
                            </div>
                            <div class="observaciones">
                                <label for="observaciones">Observaciones:</label>
                                <textarea id="observacionBeneficiarioEditar" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <p>Todos los campos (*) son obligatorios</p>
                </div>
                <div class="containerButtonsModal">
                    <input type="submit" class="btn btn-primary" value="Actualizar">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
