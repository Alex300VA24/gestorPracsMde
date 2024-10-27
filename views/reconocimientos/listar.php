<?php
require_once "../../config/parameters.php"
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
        </tbody>
    </table>
</div>