<div id="modalEditarMovimiento" class="modalMovimiento modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Movimiento</h5>
            </div>
            <form class="formMovimiento" id="editarMovimientoForm" action="" method="post">
                <div class="modal-body">
                    <input 
                                type="number"
                                id="codMovimiento"
                                hidden="hidden"
                    >
                    <div class="two-column">
                            <label for="producto">Producto (*):</label>
                            <select id="cboProductoEdit" class="form-select">
                            </select>
                    </div>

                    <div class="two-column">
                        <label for="precioUnitario">Precio Unitario (*):</label>
                        <input 
                                type="text" 
                                id="precioUnitarioEdit" 
                                autocomplete="off"
                                maxlength="100"
                                >
                    </div>
                
                    <div class="two-column">
                        <label for="fechaMovimiento">Fecha de Movimiento (*):</label>
                        <input 
                                type="date" 
                                id="fechaMovimientoEdit" 
                                autocomplete="off"
                                maxlength="100"
                                disabled
                                >
                    </div>

                    <div class="two-column">
                        <label for="cantidad">Cantidad (*):</label>
                        <input 
                                type="text" 
                                id="cantidadEdit" 
                                autocomplete="off"
                                maxlength="100"
                                >
                    </div>

                    <div class="two-column">
                            <label for="tipoMovimiento">Tipo Movimiento (*):</label>
                            <select id="cboTipoMovimientoEdit" class="form-select" disabled>
                                <option value=1>Ingreso</option>
                                <option value=2>Salida</option>
                            </select>
                    </div>

                    <p>Todos los campos (*) son obligatorios</p>

                    <div class="containerButtonsModal">
                        <input type="submit" class="btn btn-primary" value="Actualizar">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>