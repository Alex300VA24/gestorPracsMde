<div id="modalEditarProducto" class="modalPersonalizado modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
            </div>
            <form class="formProducto" id="editarProductoForm" action="" method="post">
                <div class="modal-body">
                    <input 
                                type="number"
                                id="codProducto"
                                hidden="hidden"
                    >
                    <div class="two-column">
                    <label for="codigo">Codigo (*):</label>
                        <input 
                                type="text" 
                                id="codigoEdit" 
                                autocomplete="off"
                                maxlength="100"
                                >
                    </div>
                    <div class="two-column">
                        <label for="descripcionProducto">Descripción (*):</label>
                        <input 
                                type="text" 
                                id="descripcionProductoEdit" 
                                autocomplete="off"
                                maxlength="100"
                                >
                    </div>

                    <div class="two-column">
                        <label for="abreviatura">Abreviatura (*):</label>
                        <input 
                                type="text" 
                                id="abreviaturaEdit" 
                                autocomplete="off"
                                maxlength="100"
                                >
                    </div>

                    <div class="two-column">
                        <label for="unidadMedida">Unidad de Medida (*):</label>
                            <select id="cboUnidadMedidaEdit" class="form-select">
                                <option value="bolsa">Bolsa</option>
                                <option value="tarro">Tarro</option>
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