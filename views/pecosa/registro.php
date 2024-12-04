<div id="modalRegistrarPecosa" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modalPecosa modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Pecosa</h5>
            </div>
            <form class="" id="registrarPecosaForm" action="" method="post">
                <div class="modal-body">
                    <div class="grid-container">
                        <div class="form-section">
                            <div class="header_container_data">
                                <h2>Datos de pecosa</h2>
                            </div>
                            <form>
                                <div class="two-column">
                                    <label for="numero">Numero (*):</label>
                                    <input 
                                        type="number" 
                                        id="numero" 
                                        autocomplete="off"
                                        maxlength="100"
                                    >
                                </div>

                                <div class="two-column mt-2">
                                    <label for="clubMadres">Club de Madres (*):</label>
                                    <select id="cboClubMadres" class="form-select">
                                    </select>
                                </div>

                                <div class="two-column mt-2">
                                    <label for="presidenta">Presidenta (*):</label>
                                    <input 
                                        type="text" 
                                        id="presidenta" 
                                        autocomplete="off"
                                        maxlength="100"
                                    >
                                </div>

                                <div class="two-column mt-2">
                                    <label for="fechaReparto">Fecha de Reparto (*):</label>
                                    <input 
                                        type="date" 
                                        id="fechaReparto" 
                                        autocomplete="off"
                                        maxlength="100"
                                        disabled
                                    >
                                </div>

                                <div class="two-column mt-3">
                                    <label for="observación" class="form-label col-sm-4">Observación:</label>
                                    <textarea id="obervacion" class="form-control"></textarea>
                                </div>

                            </form>

                        </div>

                        <div class="formDatosProducto">
                            <div class="header_container_data">
                                <h2>Datos de producto</h2>
                            </div>
                            <form>
                                <div class="two-column">
                                    <label for="descripcion">Descripcion (*):</label>
                                    <select id="cboProducto" class="form-select">
                                    </select>
                                </div>

                                <div class="two-column mt-2">
                                    <label for="prioridad">Prioridad (*):</label>
                                    <select id="cboPrioridad" class="form-select">
                                        <option value=1>Primera</option>
                                        <option value=2>Segunda</option>
                                    </select>
                                </div>

                                <div class="two-column mt-2">
                                    <label for="fechaDesde">Fecha desde (*):</label>
                                    <input 
                                        type="date" 
                                        id="fechaDesde" 
                                        autocomplete="off"
                                        maxlength="100"
                                        disabled
                                    >
                                </div>

                                <div class="two-column mt-2">
                                    <label for="fechaHasta">Fecha hasta (*):</label>
                                    <input 
                                        type="date" 
                                        id="fechaHasta" 
                                        autocomplete="off"
                                        maxlength="100"
                                    >
                                </div>

                                <div class="two-column mt-2">
                                    <label for="cantidad">Cantidad (*):</label>
                                    <input 
                                        type="number" 
                                        id="fechaReparto" 
                                        autocomplete="off"
                                        maxlength="100"
                                    >
                                </div>

                                <div class="two-column mt-2">
                                    <label for="precioUnitario">Precio unitario (*):</label>
                                    <input 
                                        type="number" 
                                        id="precioUnitario" 
                                        step="0.01"
                                        min="0"
                                        autocomplete="off"
                                        required
                                    >
                                </div>

                                <p>Todos los campos (*) son obligatorios</p>

                                <div class="btnAgregarPecosa mt-2" id="btnAgregarProducto">
                                    <p>Agregar</p>
                                </div>
                            </form>

                        </div>

                    </div>

                    <div class="detalleBeneficiarios">
                        <div class="header_container_data">
                            <h2>Detalle de Pecosa</h2>
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

                    </div>
        
                    <div class="containerButtonsModal">
                        <input type="submit" class="btn btn-primary" value="Registrar">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>