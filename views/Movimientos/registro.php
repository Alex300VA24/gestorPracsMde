<div id="modalRegistrarMovimiento" class="modalMovimiento modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Movimiento</h5>
            </div>
            <form class="formMovimiento" id="registrarMovimientoForm" action="" method="post">
                <div class="modal-body">
                
                    <div class="two-column">
                        <label for="fechaMovimiento">Fecha de Movimiento (*):</label>
                        <input 
                                type="date" 
                                id="fechaMovimiento" 
                                autocomplete="off"
                                maxlength="100"
                                >
                    </div>

                    <div class="two-column">
                        <label for="producto">Producto (*):</label>
                        <select id="cboProducto" class="form-select">
                            
                        </select>
                    </div>

                    <div class="two-column">
                        <label for="cantidad">Cantidad (*):</label>
                        <input 
                                type="text" 
                                id="Cantidad" 
                                autocomplete="off"
                                maxlength="100"
                                >
                    </div>

                    <div class="two-column">
                        <label for="precioUnitario">Precio Unitario (*):</label>
                        <input 
                                type="text" 
                                id="precioUnitario" 
                                autocomplete="off"
                                maxlength="100"
                                >
                    </div>

                    <div class="two-column">
                        <label for="documento">Documento (*):</label>
                        <input 
                                type="text" 
                                id="documento" 
                                autocomplete="off"
                                maxlength="100"
                                >
                    </div>

                    <div class="two-column">
                        <label for="precioTotal">Precio Total (*):</label>
                        <input 
                                type="text" 
                                id="precioTotal" 
                                autocomplete="off"
                                maxlength="100"
                                >
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