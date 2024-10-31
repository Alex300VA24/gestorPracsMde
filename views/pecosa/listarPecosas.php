<?php
    require_once "../../config/parameters.php"
?>

<div class="header_modules">
    <h1>Lista de Pecosas</h1>
    <div class="filters_btn_new">
        <div class="filters">
            <input type="text" placeholder="Buscar por nombre o codigo">
            <div class="container_clear_filters">
                <img src="<?=base_url?>/assets/icons/clearFilters.svg">
            </div>
        </div>

        <a href="#" id="nuevaPecosa" class="btn-nuevo-registro">
            <img src="<?=base_url?>/assets/icons/addRegister.svg">
            Nuevo Pecosa
        </a>
    </div>

    <div class="containerTable">
        <table class="tableProductos">
            <thead>
                <tr>
                    <th>CodPecosa</th>
                    <th>Comite</th>
                    <th>Presidenta</th>
                    <th>Observacion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="listaPecosas">
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-between m-2">
        <div>
            <p class="fs-6">Total de pecosas:  <span class="fw-bold" id="totalPecosasRegistrados"></span></p>
        </div>
        <div>
            <ul class="listadoOpcionesPaginacion" id="opcionesPaginacionProductos">

            </ul>
        </div>
    </div>
</div>

<?php  require_once "registro.php"?>

<script src="<?= base_url?>ajax/listarPecosas.js"></script>