<div id="modalRegistrarPecosa" class="modal modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modalPecosa modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Pecosa</h5>
            </div>
            <form class="" id="registrarPecosaForm" action="" method="post">
                <div class="modal-body">
                    <div class="grid-container">
                        <div class="form-section">
                            <h3>Datos de pecosa</h3>
                            <form>
                                <div class="two-column">
                                    <label for="comite">Comite (*):</label>
                                    <select id="cboComite" class="form-select">
                                    </select>
                                </div>

                                <div class="two-column">
                                    <label for="presidenta">Presidenta (*):</label>
                                    <input 
                                        type="text" 
                                        id="presidenta" 
                                        autocomplete="off"
                                        maxlength="100"
                                    >
                                </div>

                                <div class="two-column">
                                    <label for="fechaReparto">Fecha de Reparto (*):</label>
                                    <input 
                                        type="text" 
                                        id="fechaReparto" 
                                        autocomplete="off"
                                        maxlength="100"
                                    >
                                </div>

                                <div class="two-column">
                                    <label for="cantidad">Cantidad (*):</label>
                                    <input 
                                        type="text" 
                                        id="fechaReparto" 
                                        autocomplete="off"
                                        maxlength="100"
                                    >
                                </div>

                                <div class="two-column">
                                    <label for="observación">Observación (*):</label>
                                    <input 
                                        type="text" 
                                        id="observacion" 
                                        autocomplete="off"
                                        maxlength="100"
                                    >
                                </div>

                            </form>

                        </div>

                        <div class="form-section">
                            <h3>Datos del producto</h3>
                            <form>
                                <div class="two-column">
                                    <label for="descripcion">Descripcion (*):</label>
                                    <input 
                                        type="text" 
                                        id="presidenta" 
                                        autocomplete="off"
                                        maxlength="100"
                                    >
                                </div>

                                <div class="two-column">
                                    <label for="prioridad">Prioridad (*):</label>
                                    <select id="cboPrioridad" class="form-select">
                                    </select>
                                </div>

                                <div class="two-column">
                                    <label for="fechaDesde">Fecha desde (*):</label>
                                    <input 
                                        type="date" 
                                        id="fechaDesde" 
                                        autocomplete="off"
                                        maxlength="100"
                                    >
                                </div>

                                <div class="two-column">
                                    <label for="fechaHasta">Fecha hasta (*):</label>
                                    <input 
                                        type="date" 
                                        id="fechaHasta" 
                                        autocomplete="off"
                                        maxlength="100"
                                    >
                                </div>

                                <div class="two-column">
                                    <label for="cantidad">Cantidad (*):</label>
                                    <input 
                                        type="text" 
                                        id="fechaReparto" 
                                        autocomplete="off"
                                        maxlength="100"
                                    >
                                </div>

                                <div class="two-column">
                                    <label for="precioUnitario">Precio unitario (*):</label>
                                    <input 
                                        type="text" 
                                        id="precioUnitario" 
                                        autocomplete="off"
                                        maxlength="100"
                                    >
                                </div>

                                <button type="button">Agregar</button>

                            </form>

                        </div>

                    </div>

                    <div class="containerTable">
                        <table class="tableProductos">
                            <thead>
                                <tr>
                                    <th>CodProducto</th>
                                    <th>Descripcion</th>
                                    <th>Prioridad</th>
                                    <th>fecha Desde</th>
                                    <th>fecha Hasta</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="listaPecosas">
                            </tbody>
                        </table>
                    </div>

                    <p>Todos los campos (*) son obligatorios</p>

                    <div class="containerButtonsModal">
                        <input type="submit" class="btn btn-primary" value="Registrar">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>