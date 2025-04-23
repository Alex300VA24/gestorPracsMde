<?php
require_once "../../config/parameters.php";
?>
<div class="header_modules">
    <h1>Reconocimientos</h1>
    <div class="filters_btn_new">
        <div class="filters">
            <input type="text" placeholder="Buscar por documento">

            <select id="cboClubDeMadres" class="form-select">
            </select>

            <div class="container_clear_filters">
                <img src="<?= base_url ?>/assets/icons/clearFilters.svg">
            </div>
        </div>

        <a href="#" id="nuevaAsociacion" class="btn-nuevo-registro">
            <img src="<?= base_url ?>/assets/icons/addRegister.svg">
            Nuevo Reconocimiento
        </a>

        <a href="generar_reporte.php" id="btnReporte" class="btn-nuevo-registro" target="_blank">
            <img src="<?= base_url ?>/assets/icons/reportes.svg" alt="Reportes">
            REPORTE
        </a>
    </div>
</div>

<div class="containerTable">
    <table class="tableReconocimientos">
        <thead>
        <tr>
            <th>Cod Reconocimiento</th>
            <th>Documento</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Club de madre</th>
            <th>Sector</th>
            <th>Presidenta</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody id="listaReconocimientos">
            <!-- Se agregarán las filas dinámicamente -->
        </tbody>
    </table>
</div>

<?php require_once "registro.php"; ?>

<script src="<?= base_url?>/ajax/reconocimientos_CRUD.js"></script>
<script src="<?= base_url?>/ajax/asociaciones_llenarCboAsocNuevaRecVencido.js"></script>


