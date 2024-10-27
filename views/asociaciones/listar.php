<?php
require_once "../../config/parameters.php"
?>
<div class="header_modules">
    <h1>Lista de Club de Madres</h1>
    <div class="filters_btn_new">
        <div class="filters">
            <input type="text" placeholder="Buscar por nombre de club">

            <select id="cboSectores" class="form-select">
            </select>

            <div class="container_clear_filters">
                <img src="<?= base_url ?>/assets/icons/clearFilters.svg">
            </div>
        </div>

        <a href="#" id="nuevaAsociacion" class="btn-nuevo-registro">
            <img src="<?= base_url ?>/assets/icons/addRegister.svg">
            Nuevo club de madre
        </a>
    </div>
</div>

<div class="containerTable">
    <table class="tableAsociaciones">
        <thead>
        <tr>
            <th>Cod Club</th>
            <th>Nombre</th>
            <th>Sector y Zona</th>
            <th>Dirección</th>
            <th>Presidenta</th>
            <th>Cantidad Beneficiarios</th>
            <th>Resolución actual</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody id="listaAsociaciones">
        </tbody>
    </table>
</div>

<?php require_once  "registrar.php"?>
<?php require_once  "editar.php"?>

<script src="<?= base_url?>ajax/sectores_llenarCboSectores.js"></script>
<script src="<?= base_url?>ajax/sectoresZona_llenarCboSectoresZona.js"></script>
<script src="<?= base_url?>ajax/tipoLocal_llenarCboTiposLocal.js"></script>
<script src="<?= base_url?>ajax/asociaciones_CRUD.js"></script>
