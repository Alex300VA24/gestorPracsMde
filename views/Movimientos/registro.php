<div id="modalRegistrarMovimiento" class="modalMovimiento modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Movimiento</h5>
            </div>
            <form class="formMovimiento" id="registrarMovimientoForm" action="" method="post">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="two-column">
                            <label for="fechaMovimiento">Fecha de Movimiento (*):</label>
                            <input 
                                    type="text" 
                                    id="descripcionProducto" 
                                    autocomplete="off"
                                    maxlength="100"
                                    >
                        </div>

                        <div class="two-column">
                            <label for="producto">Producto (*):</label>
                            <input 
                                    type="text" 
                                    id="abreviatura" 
                                    autocomplete="off"
                                    maxlength="100"
                                    >
                        </div>

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