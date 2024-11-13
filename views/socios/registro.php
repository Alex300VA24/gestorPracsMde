<div id="modalRegistrarSocioYBeneficiarios" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modalRegistroSocio modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Socio y Beneficiarios</h5>
            </div>
            <form class="" id="registrarSocioYBeneficiarioForm" action="" method="post">
                <div class="formDatosSocio">
                    <div class="header_container_data">
                        <h2>Socio</h2>
                    </div>
                    <div class="body_container_data">
                        <div>
                            <label for="dni">DNI (*):</label>
                            <input
                                    type="text"
                                    id="dniSocioRegistro"
                                    autocomplete="off"
                                    maxlength="8"
                            >
                        </div>

                        <div>
                            <label for="dni">Nombres (*):</label>
                            <input
                                    type="text"
                                    id="nombresSocioRegistro"
                                    autocomplete="off"
                                    maxlength="100"
                            >
                        </div>

                        <div>
                            <label for="dni">Apellido Paterno (*):</label>
                            <input
                                    type="text"
                                    id="apellidoPaternoSocioRegistro"
                                    autocomplete="off"
                                    maxlength="100"
                            >
                        </div>

                        <div>
                            <label for="dni">Apellido Materno (*):</label>
                            <input
                                    type="text"
                                    id="apellidoMaternoSocioRegistro"
                                    autocomplete="off"
                                    maxlength="100"
                            >
                        </div>

                        <div>
                            <label for="dni">Sexo (*):</label>
                            <select id="sexoSocioRegistro" class="form-control">
                                <option value="0" selected>Seleccionar</option>
                                <option value="f">Femenino</option>
                                <option value="m">Masculino</option>
                            </select>
                        </div>

                        <div>
                            <label for="dni">Telefono:</label>
                            <input
                                    type="text"
                                    id="telefonoSocioRegistro"
                                    autocomplete="off"
                                    maxlength="6"
                            >
                        </div>

                        <div>
                            <label for="dni">Celular:</label>
                            <input
                                    type="text"
                                    id="celularSocioRegistro"
                                    autocomplete="off"
                                    maxlength="9"
                            >
                        </div>

                        <div>
                            <label for="fechaNacimiento">Fecha Nacimiento (*):</label>
                            <input
                                    type="date"
                                    id="fechaNacimientoSocioRegistro"
                                    max=""
                            >
                        </div>

                        <div>
                            <label for="edad">Edad (*):</label>
                            <input
                                    class="colorDisable"
                                    disabled
                                    type="number"
                                    id="edadSocioRegistro"
                            >
                        </div>

                        <div>
                            <label for="sectorZona">Sector y Zona (*):</label>
                            <select class="form-control" id="cboSectorZonaRegistroSocio"></select>
                        </div>

                        <div>
                            <label for="direccionSocio">Dirección (*):</label>
                            <input
                                    type="text"
                                    id="direccionSocioRegistro"
                                    autocomplete="off"
                                    maxlength="100"
                            >
                        </div>

                        <div>
                            <label for="direccionSocio">Número de finca (*):</label>
                            <input
                                    type="number"
                                    id="numeroFincaSocioRegistro"
                                    autocomplete="off"
                            >
                        </div>

                        <div>
                            <label for="direccionSocio">Club de madre (*):</label>
                            <select class="form-control" id="cboClubDeMadresActivos"></select>
                        </div>

                        <div>
                            <label for="fechaInicio">Fecha Inicio (*):</label>
                            <input
                                    disabled
                                    class="colorDisable"
                                    type="date"
                                    id="fechaInicioSocioRegistro"
                            >
                        </div>

                        <div class="observaciones">
                            <label for="observaciones">Observaciones (*):</label>
                            <textarea class="form-control"></textarea>
                        </div>

                        <div class="options_socio_beneficiario">
                            <label for="observaciones">Es socio y beneficiario (*):</label>
                            <div>
                                <span>Sí</span>
                                <input name="optionSocioBeneficiario" type="radio" value=1>
                            </div>
                            <div>
                                <span>No</span>
                                <input name="optionSocioBeneficiario" type="radio" value=0 checked>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="formDatosBeneficiario">
                    <div class="header_container_data">
                        <h2>Beneficiario</h2>
                    </div>
                    <div class="body_container_data">
                        <div>
                            <label for="dni">DNI (*):</label>
                            <input
                                    type="text"
                                    id="dniBeneficiarioRegistro"
                                    autocomplete="off"
                                    maxlength="8"
                            >
                        </div>

                        <div>
                            <label for="dni">Nombres (*):</label>
                            <input
                                    type="text"
                                    id="nombresBeneficiarioRegistro"
                                    autocomplete="off"
                                    maxlength="100"
                            >
                        </div>

                        <div>
                            <label for="dni">Apellido Paterno (*):</label>
                            <input
                                    type="text"
                                    id="apellidoPaternoBeneficiarioRegistro"
                                    autocomplete="off"
                                    maxlength="100"
                            >
                        </div>

                        <div>
                            <label for="dni">Apellido Materno (*):</label>
                            <input
                                    type="text"
                                    id="apellidoMaternoBeneficiarioRegistro"
                                    autocomplete="off"
                                    maxlength="100"
                            >
                        </div>

                        <div>
                            <label for="dni">Sexo (*):</label>
                            <select id="sexoBeneficiarioRegistro" class="form-control">
                                <option value="0" selected>Seleccionar</option>
                                <option value="f">Femenino</option>
                                <option value="m">Masculino</option>
                            </select>
                        </div>

                        <div>
                            <label for="dni">Telefono:</label>
                            <input
                                    type="text"
                                    id="telefonoBeneficiarioRegistro"
                                    autocomplete="off"
                                    maxlength="6"
                            >
                        </div>

                        <div>
                            <label for="dni">Celular:</label>
                            <input
                                    type="text"
                                    id="celularBeneficiarioRegistro"
                                    autocomplete="off"
                                    maxlength="9"
                            >
                        </div>

                        <div>
                            <label for="fechaNacimiento">Fecha Nacimiento (*):</label>
                            <input
                                    type="date"
                                    id="fechaNacimientoBeneficiarioRegistro"
                                    max=""
                            >
                        </div>

                        <div>
                            <label for="edad">Edad (*):</label>
                            <input
                                    class="colorDisable"
                                    disabled
                                    type="number"
                                    id="edadBeneficiarioRegistro"
                            >
                        </div>

                        <div>
                            <label for="sectorZona">Sector y Zona (*):</label>
                            <select class="form-control" id="cboSectorZonaRegistroBeneficiario"></select>
                        </div>

                        <div>
                            <label for="direccionSocio">Dirección (*):</label>
                            <input
                                    type="text"
                                    id="direccionSocioRegistro"
                                    autocomplete="off"
                                    maxlength="100"
                            >
                        </div>

                        <div>
                            <label for="direccionSocio">Número de finca (*):</label>
                            <input
                                    type="number"
                                    id="numeroFincaSocioRegistro"
                                    autocomplete="off"
                            >
                        </div>

                        <div>
                            <label for="parentesco">Parentesco (*):</label>
                            <select class="form-control" id="cboParentescoRegistroSocio"></select>
                        </div>

                        <div>
                            <label for="tipoBeneficio">Tipo Beneficio (*):</label>
                            <select class="form-control" id="cboTipoBeneficioRegistroSocio"></select>
                        </div>

                        <div>
                            <label for="fechaNacimiento">Fecha Inicio (*):</label>
                            <input
                                    type="date"
                                    id="fechaInicioSocioRegistro"
                            >
                        </div>

                        <div>
                            <label for="peso">Peso (kg):</label>
                            <input
                                    type="number"
                                    id="pesoSocioRegistro"
                                    autocomplete="off"
                            >
                        </div>

                        <div>
                            <label for="peso">Talla (cm):</label>
                            <input
                                    type="number"
                                    id="tallaSocioRegistro"
                                    autocomplete="off"
                            >
                        </div>

                        <div>
                            <label for="hmg">Hmg:</label>
                            <input
                                    type="number"
                                    id="hmgSocioRegistro"
                                    autocomplete="off"
                            >
                        </div>

                        <div class="btnAgregarSocio" id="btnAgregarBeneficiario">
                            <p>Agregar</p>
                        </div>
                    </div>
                </div>

                <div class="detalleBeneficiarios">
                    <div class="header_container_data">
                        <h2>Detalle de los beneficiarios</h2>
                    </div>
                    <div class="containerTable">
                        <table class="tableReconocimientos">
                            <thead>
                            <tr>
                                <th>Nombres</th>
                                <th>DNI</th>
                                <th>Edad</th>
                                <th>Beneficio</th>
                                <th>Parentesco</th>
                                <th>Peso</th>
                                <th>Talla</th>
                                <th>Hmg</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody id="listaSocios">
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="containerButtonsModal">
                    <input type="submit" class="btn btn-primary" value="Registrar">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

