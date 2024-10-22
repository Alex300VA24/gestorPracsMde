<div id="modalRegistrarProducto" class="modalProducto modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Producto</h5>
            </div>
            <form class="formProducto" id="registrarProductoForm" action="" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="descripcionProducto" class="form-label">Descripción (*):</label>
                        <input type="text" id="descripcionProducto" autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label for="abreviatura" class="form-label">Abreviatura (*):</label>
                        <input type="text" id="abreviatura" autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label for="unidadMedida" class="form-label">Unidad de Medida (*):</label>
                            <select class="form-select selectUnidadMedida" id="selectUnidadMedida" name="unidadMedida" required>
                                <option value="bolsa">Bolsa</option>
                                <option value="tarro">Tarro</option>
                            </select>
                    </div>

                    <div class="mb-3">
                        <label for="precioUnitario" class="form-label">Precio Unitario (*):</label>
                        <input type="text" id="precioUnitario" autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock (*):</label>
                        <input type="text" id="stock" autocomplete="off">
                    </div>
                    <p>Todos los campos (*) son obligatorios</p>

                    <div class="containerButtonsRegistroProducto">
                        <input type="submit" class="btn" value="Registrar">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>