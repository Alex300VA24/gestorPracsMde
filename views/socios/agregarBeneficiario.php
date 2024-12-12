<div id="modalAgregarBeneficiario" class="modalPersonalizado modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modalActualizarSocio modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo Beneficiario</h5>
            </div>
            <form id="registrarNuevoBeneficiarioForm" action="" method="post">
                <div class="modal-body">

                    <div class="data-socio">
                        <div>
                            <span>Socio:</span>
                            <span id="nombreSocioNuevoBeneficiario"></span>
                        </div>

                        <div>
                            <span>DNI:</span>
                            <span id="dniSocioNuevoBeneficiario"></span>
                        </div>

                        <div hidden="hidden">
                            <span>CodAsociacion:</span>
                            <span id="codAsociacionSocioNuevoBeneficiario"></span>
                        </div>
                    </div>

                    <input
                            hidden="hidden"
                            type="number"
                            id="codSocioNuevoBeneficiarioRegistro"
                    >

                    <div class="formDatosBeneficiario">
                        <div class="header_container_data">
                            <h2>Datos del beneficiario</h2>
                        </div>
                        <div class="body_container_data">
                            <div>
                                <label for="dni">DNI (*):</label>
                                <input
                                    type="text"
                                    id="dniNuevoBeneficiarioRegistro"
                                    autocomplete="off"
                                    maxlength="8"
                                >
                            </div>

                            <div>
                                <label for="dni">Nombres (*):</label>
                                <input
                                    type="text"
                                    id="nombresNuevoBeneficiarioRegistro"
                                    autocomplete="off"
                                    maxlength="100"
                                >
                            </div>

                            <div>
                                <label for="dni">Apellido Paterno (*):</label>
                                <input
                                    type="text"
                                    id="apellidoPaternoNuevoBeneficiarioRegistro"
                                    autocomplete="off"
                                    maxlength="100"
                                >
                            </div>

                            <div>
                                <label for="dni">Apellido Materno (*):</label>
                                <input
                                    type="text"
                                    id="apellidoMaternoNuevoBeneficiarioRegistro"
                                    autocomplete="off"
                                    maxlength="100"
                                >
                            </div>

                            <div>
                                <label for="dni">Sexo (*):</label>
                                <select id="sexoNuevoBeneficiarioRegistro" class="form-control">
                                    <option value="0" selected>Seleccionar</option>
                                    <option value="f">Femenino</option>
                                    <option value="m">Masculino</option>
                                </select>
                            </div>

                            <div>
                                <label for="dni">Telefono:</label>
                                <input
                                    type="text"
                                    id="telefonoNuevoBeneficiarioRegistro"
                                    autocomplete="off"
                                    maxlength="6"
                                >
                            </div>

                            <div>
                                <label for="dni">Celular:</label>
                                <input
                                    type="text"
                                    id="celularNuevoBeneficiarioRegistro"
                                    autocomplete="off"
                                    maxlength="9"
                                >
                            </div>

                            <div>
                                <label for="fechaNacimiento">Fecha Nacimiento (*):</label>
                                <input
                                    type="date"
                                    id="fechaNacimientoNuevoBeneficiarioRegistro"
                                    max=""
                                >
                            </div>

                            <div>
                                <label for="edad">Edad (*):</label>
                                <input
                                    class="colorDisable"
                                    disabled
                                    type="number"
                                    id="edadNuevoBeneficiarioRegistro"
                                >
                            </div>

                            <div>
                                <label for="sectorZona">Sector y Zona (*):</label>
                                <select class="form-control" id="cboSectorZonaNuevoRegistroBeneficiario"></select>
                            </div>

                            <div>
                                <label for="direccionSocio">Dirección (*):</label>
                                <input
                                    type="text"
                                    id="direccionNuevoBeneficiarioRegistro"
                                    autocomplete="off"
                                    maxlength="100"
                                >
                            </div>

                            <div>
                                <label for="direccionSocio">Número de finca:</label>
                                <input
                                    type="number"
                                    id="numeroFincaNuevoBeneficiarioRegistro"
                                    autocomplete="off"
                                >
                            </div>

                            <div>
                                <label for="parentesco">Parentesco (*):</label>
                                <select class="form-control" id="cboParentescoNuevoRegistroBeneficiario"></select>
                            </div>

                            <div>
                                <label for="tipoBeneficio">Tipo Beneficio (*):</label>
                                <select class="form-control" id="cboTipoBeneficioNuevoRegistroBeneficiario"></select>
                            </div>

                            <div>
                                <label for="peso">Peso (kg):</label>
                                <input
                                    type="number"
                                    id="pesoNuevoBeneficiarioRegistro"
                                    autocomplete="off"
                                >
                            </div>

                            <div>
                                <label for="peso">Talla (cm):</label>
                                <input
                                    type="number"
                                    id="tallaNuevoBeneficiarioRegistro"
                                    autocomplete="off"
                                >
                            </div>

                            <div>
                                <label for="hmg">Hmg:</label>
                                <input
                                    type="number"
                                    id="hmgNuevoBeneficiarioRegistro"
                                    autocomplete="off"
                                >
                            </div>

                            <div class="boxFum" hidden="hidden">
                                <label for="fechaNacimiento">FUM (*):</label>
                                <input
                                    type="date"
                                    id="fumNuevoBeneficiarioRegistro"
                                >
                            </div>

                            <div class="boxFechaProbableParto" hidden="hidden">
                                <label for="fechaNacimiento">Fecha probable de parto (*):</label>
                                <input
                                    disabled
                                    class="colorDisable"
                                    type="date"
                                    id="fechaProbableDePartoNuevoBeneficiarioRegistro"
                                >
                            </div>

                            <div class="boxFechaParto" hidden="hidden">
                                <label for="fechaNacimiento">Fecha de parto (*):</label>
                                <input
                                    type="date"
                                    id="fechaPartoNuevoBeneficiarioRegistro"
                                >
                            </div>

                            <div class="boxFechaFin" hidden="hidden">
                                <label for="fechaNacimiento">Fecha fin (*):</label>
                                <input
                                    disabled
                                    class="colorDisable"
                                    type="date"
                                    id="fechaFinNuevoBeneficiarioRegistro"
                                >
                            </div>
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

