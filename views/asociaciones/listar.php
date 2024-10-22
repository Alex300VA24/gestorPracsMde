<?php
require_once "../../config/parameters.php"
?>
<div class="header_modules">
    <h1>Lista de Club de Madres</h1>
    <div class="filters_btn_new">
        <div class="filters">
            <input type="text" placeholder="Buscar por nombre de club">

            <select class="form-select">
                <option selected value=0>Todos los sectores</option>
                <option value=1>Divino Jesús</option>
                <option value=2>Sol Naciente</option>
            </select>

            <div class="container_clear_filters">
                <img src="<?= base_url ?>/assets/icons/clearFilters.svg">
            </div>
        </div>

        <a href="#" id="nuevaPersona" class="btn-nuevo-registro">
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
            <th>Sector</th>
            <th>Dirección</th>
            <th>Presidenta</th>
            <th>Cantidad Beneficiarios</th>
            <th>Resolución actual</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody id="listaAsociaciones">
        <tr>
            <td>1</td>
            <td>Divino Jesús</td>
            <td>Nuevo Horizonte</td>
            <td>Mz. H lt. 33</td>
            <td>Angela Maria Lopez Urquiaga</td>
            <td>37</td>
            <td>RS-293-2024</td>
            <td>
                <span class="estado active">
                    Activo
                </span>
            </td>
            <td>
                <div class="actions actions_asociaciones">
                    <img class="action" src="<?= base_url ?>/assets/icons/action_edit.svg">
                    <img class="action" src="<?= base_url ?>/assets/icons/action_ver_detalle.svg">
                    <img class="action" src="<?= base_url ?>/assets/icons/action_deshabilitar.svg">
                </div>
            </td>
        </tr>
        <tr>
            <td>1</td>
            <td>Divino Jesús</td>
            <td>Nuevo Horizonte</td>
            <td>Mz. H lt. 33</td>
            <td>Angela Maria Lopez Urquiaga</td>
            <td>37</td>
            <td>RS-293-2024</td>
            <td>
                <span class="estado inactive">
                    Inactivo
                </span>
            </td>
            <td>
                <div class="actions actions_asociaciones">
                    <img class="action action_habilitar" src="<?= base_url ?>/assets/icons/action_habilitar.svg">
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>
