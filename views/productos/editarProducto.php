<div id="modalEditarProducto" class="modalPersonalizado modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
            </div>
            <form class="formProducto" id="editarProductoForm" action="" method="post">
                <div class="modal-body">
                    <input type="hidden" id="codProducto">
                    <div class="two-column">
                        <label for="descripcionProductoEdit">Descripción (*):</label>
                        <input type="text" id="descripcionProductoEdit" autocomplete="off" maxlength="100">
                    </div>

                    <div class="two-column">
                        <label for="abreviaturaEdit">Abreviatura (*):</label>
                        <input type="text" id="abreviaturaEdit" autocomplete="off" maxlength="100">
                    </div>

                    <div class="two-column">
                        <label>Unidad de Medida (*):</label>
                        <div id="unidadMedidaContainerEdit">
                            <label><input type="radio" name="unidadMedidaEdit" value="kg">Bolsa</label>
                            <label><input type="radio" name="unidadMedidaEdit" value="g">Tarro</label>
  
                        </div>
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
