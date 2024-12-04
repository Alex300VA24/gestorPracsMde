<div id="modalRegistrarMovimiento" class="modalMovimiento modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Movimiento</h5>
            </div>
            <form class="formMovimiento" id="registrarMovimientoForm" action="" method="post">
                <div class="modal-body">
                    <div class="two-column">
                            <label for="producto">Producto (*):</label>
                            <select id="cboProducto" class="form-select">
                            </select>
                    </div>

                    <div class="two-column">
                        <label for="precioUnitario">Precio Unitario (*):</label>
                        <input 
                                type="number" 
                                id="precioUnitario" 
                                step="0.01"
                                min="0"
                                autocomplete="off"
                                required
                                >
                    </div>
                
                    <div class="two-column">
                        <label for="fechaMovimiento">Fecha de Movimiento (*):</label>
                        <input 
                                type="date" 
                                id="fechaMovimiento" 
                                autocomplete="off"
                                maxlength="100"
                                disabled
                                >
                    </div>

                    <div class="two-column">
                        <label for="cantidad">Cantidad (*):</label>
                        <input 
                                type="number" 
                                id="cantidad" 
                                autocomplete="off"
                                maxlength="100"
                                >
                    </div>

                    <div class="two-column">
                            <label for="tipoMovimiento">Tipo Movimiento (*):</label>
                            <select id="cboTipoMovimiento" class="form-select">
                                <option value=1>Ingreso</option>
                                <option value=2>Salida</option>
                            </select>
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