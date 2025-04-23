<div id="modalRegistrarProducto" class="modalProducto modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Producto</h5>
            </div>
            <form class="formProducto" id="registrarProductoForm" action="" method="post">
                <div class="modal-body">
                    <div class="two-column">
                        <label for="descripcionProducto">Descripción (*):</label>
                        <input type="text" id="descripcionProducto" autocomplete="off" maxlength="100">
                    </div>

                    <div class="two-column">
                        <label for="abreviatura">Abreviatura (*):</label>
                        <input type="text" id="abreviatura" autocomplete="off" maxlength="100">
                    </div>

                    <div class="two-column">
                        <label>Unidad de Medida (*):</label>
                        <div id="unidadMedidaContainer">
                            <label><input type="radio" name="unidadMedida" value="kg"> Bolsa</label>
                            <label><input type="radio" name="unidadMedida" value="g"> Tarro</label>

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
