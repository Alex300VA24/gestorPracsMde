<?php
require_once "../../config/parameters.php"
?>
<div class="header_modules">
    <h1>Lista de Socios</h1>
    <div class="filters_btn_new">
        <div class="filters">
            <input id="btnDNIApellidosFiltroSocio" type="text" placeholder="Buscar por DNI ó apellidos y nombres">

            <select id="cboClubDeMadresFiltroSocio" class="form-select">
            </select>

            <div class="container_clear_filters">
                <img src="<?= base_url ?>/assets/icons/clearFilters.svg">
            </div>
        </div>

        <a href="#" id="btnNuevoSocio" class="btn-nuevo-registro">
            <img src="<?= base_url ?>/assets/icons/addRegister.svg">
            Nuevo Socio
        </a>
    </div>
</div>

<div class="containerTable">
    <table class="tableSocios">
        <thead>
        <tr>
            <th>Cod Socio</th>
            <th>Nombres</th>
            <th>Edad</th>
            <th>DNI</th>
            <th>Club de madre</th>
            <th>Cargo</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody id="listaSocios">
        </tbody>
    </table>
</div>

<?php require_once "registro.php" ?>
<?php require_once "editar.php" ?>

<script src="<?= base_url?>ajax/sectoresZona_llenarCboSectoresZona.js"></script>
<script src="<?= base_url?>ajax/asociaciones_llenarCboAsocNuevaRecVencidoRecPendiente.js"></script>
<script src="<?= base_url?>ajax/asociaciones_llenarCboAsocTodas.js"></script>
<script src="<?= base_url?>ajax/parentescos_llenarCboParentescos.js"></script>
<script src="<?= base_url?>ajax/tiposBeneficio_llenarCboTiposBeneficio.js"></script>
<script src="<?= base_url?>ajax/socios_CRUD.js"></script>
