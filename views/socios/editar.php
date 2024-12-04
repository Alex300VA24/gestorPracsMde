<div id="modalEditarSocio" class="modalPersonalizado modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modalActualizarSocio modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Datos Socio</h5>
            </div>
            <form id="editarSocioForm" action="" method="post">
                <div class="modal-body">
                    <div class="formDatosSocio">
                        <div class="body_container_data">
                            <input
                                    type="number"
                                    id="codSocioEditar"
                                    hidden="hidden"
                            >

                            <input
                                    type="number"
                                    id="codPersonaEditarSocio"
                                    hidden="hidden"
                            >
                            <div>
                                <label for="dni">DNI (*):</label>
                                <input
                                    type="text"
                                    id="dniSocioEditar"
                                    autocomplete="off"
                                    maxlength="8"
                                >
                            </div>

                            <div>
                                <label for="dni">Nombres (*):</label>
                                <input
                                    type="text"
                                    id="nombresSocioEditar"
                                    autocomplete="off"
                                    maxlength="100"
                                >
                            </div>

                            <div>
                                <label for="dni">Apellido Paterno (*):</label>
                                <input
                                    type="text"
                                    id="apellidoPaternoSocioEditar"
                                    autocomplete="off"
                                    maxlength="100"
                                >
                            </div>

                            <div>
                                <label for="dni">Apellido Materno (*):</label>
                                <input
                                    type="text"
                                    id="apellidoMaternoSocioEditar"
                                    autocomplete="off"
                                    maxlength="100"
                                >
                            </div>

                            <div>
                                <label for="dni">Sexo (*):</label>
                                <select id="sexoSocioEditar" class="form-control">
                                    <option value="0" selected>Seleccionar</option>
                                    <option value="f">Femenino</option>
                                    <option value="m">Masculino</option>
                                </select>
                            </div>

                            <div>
                                <label for="dni">Telefono:</label>
                                <input
                                    type="text"
                                    id="telefonoSocioEditar"
                                    autocomplete="off"
                                    maxlength="6"
                                >
                            </div>

                            <div>
                                <label for="dni">Celular:</label>
                                <input
                                    type="text"
                                    id="celularSocioEditar"
                                    autocomplete="off"
                                    maxlength="9"
                                >
                            </div>

                            <div>
                                <label for="fechaNacimiento">Fecha Nacimiento (*):</label>
                                <input
                                    type="date"
                                    id="fechaNacimientoSocioEditar"
                                    max=""
                                >
                            </div>

                            <div>
                                <label for="edad">Edad (*):</label>
                                <input
                                    class="colorDisable"
                                    disabled
                                    type="number"
                                    id="edadSocioEditar"
                                >
                            </div>

                            <div>
                                <label for="sectorZona">Sector y Zona (*):</label>
                                <select class="form-control" id="cboSectorZonaEditarSocio"></select>
                            </div>

                            <div>
                                <label for="direccionSocio">Dirección (*):</label>
                                <input
                                    type="text"
                                    id="direccionSocioEditar"
                                    autocomplete="off"
                                    maxlength="100"
                                >
                            </div>

                            <div>
                                <label for="direccionSocio">Número de finca:</label>
                                <input
                                    type="number"
                                    id="numeroFincaSocioEditar"
                                    autocomplete="off"
                                >
                            </div>

                            <div>
                                <label for="direccionSocio">Club de madre (*):</label>
                                <select class="form-control" id="cboClubDeMadresActivosEditar"></select>
                            </div>

                            <div class="observaciones">
                                <label for="observaciones">Observaciones:</label>
                                <textarea id="observacionSocioEditar" class="form-control"></textarea>
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

