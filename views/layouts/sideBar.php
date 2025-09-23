<div class="sideBar">

        <div>
            <div class="option" id="optionInicio">
                <img src="<?=base_url?>/assets/icons/home.svg" alt="">
                <a href="views/inicio.php">
                    <p>Inicio</p>
                </a>
            </div>
        </div>

        <div>
            <a href="views/practicantes/listar.php" class="option" id="option">
                <div class="containerIconOption">
                    <img src="<?=base_url?>/assets/icons/beneficiarios.svg" alt="">
                    
                </div>
                <div>
                    <p>Practicantes</p>
                    <!-- Aqui se creara una entidad practicante y estara en inactivo hasta que sea generado su carta de aceptacion -->
                </div>
            </a>
        </div>

        <div>
            <a href="views/asistencias/listar.php" class="option" id="optionTipoDocumentos">
                <div class="containerIconOption">
                    <img src="<?=base_url?>/assets/icons/socias.svg" alt="">
                </div>
                <div>
                    <p>Asistencias</p>
                    <!-- Aqui se validara la asistencia y se generara el reporte de Horas -->
                </div>
            </a>
        </div>

</div>
