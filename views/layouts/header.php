<header class="header">
    <div class="logo_nombre_sistema">
        <img src="<?=base_url?>/assets/mde-logo.svg" alt="" srcset="">
        <h1>Sistema de gestión de provale</h1>
    </div>
    <div class="container_userDetails_logout">
        <div class="userDetails">
            <a class="iconUser" href="#" id="btnEditarPerfil">
                <img src="<?=base_url?>/assets/icons/userIcon.svg" alt="">
                <img class="iconEditProfile" src="<?=base_url?>/assets/icons/iconEditProfile.svg" alt="">
            </a>
            <div>
                <span id="nombresUsuarioLog" class="nombresUsuarioLog"> <?php echo 'miguel vega perez' ?> <span class="username">(<?php echo 'mvegape'?>)</span> </span>
                <div class="username_rol">
                    <span id="areaUsuarioLog">  <?php echo 'usuario' ?> <span id="rolUsuarioLog"> </span></span>
                </div>
            </div>
        </div>

        <a>
            <img id="btnLogout" class="iconLogout" src="<?=base_url?>/assets/icons/iconLogout.svg" alt="iconLogout">
        </a>
    </div>
</header>