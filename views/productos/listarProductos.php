<?php
    require_once "../../config/parameters.php"
?>

<div class="header_modules">
    <h1>Lista de Productos</h1>
    <div class="filters_btn_new">
        <div class="filters">
            <input type="text" placeholder="Buscar por nombre o codigo">
            <div class="container_clear_filters">
                <img src="<?=base_url?>/assets/icons/clearFilters.svg">
            </div>
        </div>

        <a href="#" id="btnRegistrarProducto" class="btnNuevoRegistro">
            <img src="<?=base_url?>/assets/icons/addRegister.svg">
            Nuevo Producto
        </a>
    </div>

    <div class="listadoProductos_body">
        <table>
            <thead>
                <tr>
                    <th>CodProducto</th>
                    <th>Descripcion</th>
                    <th>Unidad de Medida</th>
                    <th>Precio Unitario</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="bodyListadoProductos">
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-between m-2">
        <div>
            <p class="fs-6">Total de productos:  <span class="fw-bold" id="totalProductosRegistrados"></span></p>
        </div>
        <div>
            <ul class="listadoOpcionesPaginacion" id="opcionesPaginacionUsuarios">

            </ul>
        </div>
    </div>
</div>




<?php  require_once "registro.php"?>


<script src="<?= base_url?>ajax/listarProductos.js"></script>