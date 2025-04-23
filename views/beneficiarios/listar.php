<?php
require_once "../../config/parameters.php"
?>
<div class="header_modules">
    <h1>Lista de Beneficiarios</h1>
    <div class="filters_btn_new">
        <div class="filters">
            <input type="text" placeholder="Buscar por DNI ó apellidos y nombres">

            <select id="cboClubDeMadres" class="form-select">
            </select>

            

            <div class="container_clear_filters">
                <img src="<?= base_url ?>/assets/icons/clearFilters.svg">
            </div>

        </div>

        <a href="generar_reporte.php" id="btnReporte" class="btn-nuevo-registro" target="_blank">
            <img src="<?= base_url ?>/assets/icons/reportes.svg" alt="Reportes">
            REPORTE
        </a>
    </div>
</div>
 
<div class="containerTable">
    <table class="tableBeneficios">
        <thead>
        <tr>
            <th>Cod Beneficiario</th>
            <th>Nombres</th>
            <th>Edad</th>
            <th>DNI</th>
            <th>Beneficio</th>
            <th>Peso</th>
            <th>Talla</th>
            <th>Hmg</th>
            <th>Estado</th>
            <th>Motivo Inhabilitacion</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody id="listaBeneficiarios">
        </tbody>
    </table>
</div>

<script src="<?= base_url?>ajax/sectoresZona_llenarCboSectoresZona.js"></script>
<script src="<?= base_url?>ajax/asociaciones_llenarCboAsocNuevaRecVencidoRecPendiente.js"></script>
<script src="<?= base_url?>ajax/parentescos_llenarCboParentescos.js"></script>
<script src="<?= base_url?>ajax/tiposBeneficio_llenarCboTiposBeneficio.js"></script>
<script src="<?= base_url?>ajax/beneficiarios_CRUD.js"></script>





