<?php
    require_once "../../config/parameters.php"
?>

<div class="header_modules">
    <h1>Lista de Movimientos</h1>
    <div class="filters_btn_new">
        <div class="filters">
            <input type="text" placeholder="Buscar por nombre o codigo">
            <div class="container_clear_filters">
                <img src="<?=base_url?>/assets/icons/clearFilters.svg">
            </div>
        </div>

        <a href="#" id="nuevoMovimiento" class="btn-nuevo-registro">
            <img src="<?=base_url?>/assets/icons/addRegister.svg">
            Nuevo Movimiento
        </a>
    </div>

    <div class="containerTable">
        <table class="tableMovimientos">
            <thead>
                <tr>
                    <th>CodMov</th>
                    <tr>Producto</tr>
                    <th>Fecha</th>
                    <th>Cantidad</th>
                    <th>Unidad</th>
                    <th>V. Unitario</th>
                    <th>V. Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="listaMovimientos">
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-between m-2">
        <div>
            <p class="fs-6">Total de movimientos:  <span class="fw-bold" id="totalMovimientosRegistrados"></span></p>
        </div>
        <div>
            <ul class="listadoOpcionesPaginacion" id="opcionesPaginacionMovimientos">

            </ul>
        </div>
    </div>

</div>

<?php  require_once "registro.php"?>


<script src="<?= base_url?>ajax/listarMovimientos.js"></script>