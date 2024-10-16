<?php
    require_once "../../config/parameters.php"
?>
<div class="header_modules">
    <h1>Lista de Personas</h1>
    <div class="filters_btn_new">
        <div class="filters">
            <input type="text" placeholder="Buscar por DNI o apellidos y nombres">
            <div class="container_clear_filters">
                <img src="<?=base_url?>/assets/icons/clearFilters.svg">
            </div>
        </div>

        <a href="#" id="nuevaPersona" class="btn-nuevo-registro">
            <img src="<?=base_url?>/assets/icons/addRegister.svg">
            Nueva persona
        </a>
    </div>
</div>
