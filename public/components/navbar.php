<?php
$UserIcon = isset($_SESSION["Session"]) ? $_SESSION["Session"]->Usuario->getProfileImageSrc() : "assets/icons/guest_caret_down.svg";
$Username = isset($_SESSION["Session"]) ? $_SESSION["Session"]->Usuario->getUsername() : "visitante";
$Logado = isset($_SESSION["Session"]) ? true : false;

?>

<nav class="bg-light shadow-sm mb-3 rounded">
    <div class="row">
        <div class="col-11 mt-2 mb-2">
            <a class="navbar-brand ms-3" href="index.php">
                <img src="assets/icons/logo.svg" alt="Bootstrap" width="50" height="60">
            </a>
        </div>

        <!-- <div class="col-2 mt-2">
                <div class="d-flex align-items-end flex-column">
                    <button class="dropdown-item" type="button"><img src="assets/icons/location.svg" width="20" height="20"> Pegar localização atual</button>
                </div>
            </div> -->

        <div class="col-1 mt-2 mb-2">
            <div class="dropdown">
                <a class="ms-3" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?= $UserIcon ?>" alt="Usuário" width="50" height="50" id="userIcon">
                </a>
                <ul class="dropdown-menu dropdown-menu-end rounded-3 text-muted mt-3" id="dropdown">
                    <p class="dropdown-item">
                        Olá, <?= $Username ?>! Seja bem-vindo(a).
                    </p>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <?php if (!$Logado) { ?>
                        <li><button class="dropdown-item" type="button"><img src="assets/icons/sign_in.svg" width="20" height="20"> Entrar com uma conta</button></li>
                        <li><button class="dropdown-item" type="button"><img src="assets/icons/sign_up.svg" width="20" height="20"> Registrar</button></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><button class="dropdown-item" type="button"><img src="assets/icons/forgot_pass.svg" width="20" height="20"> Esqueceu sua senha?</button></li>
                    <?php } else { ?>
                        <li><button class="dropdown-item" type="button"><img src="assets/icons/user_list.svg" width="20" height="20"> Ver perfil</button></li>
                        <li><button class="dropdown-item" type="button"><img src="assets/icons/gear.svg" width="20" height="20"> Configurações</button></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><button class="dropdown-item" type="button"><img src="assets/icons/power.svg" width="20" height="20"> Sair</button></li>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </div>
</nav>

<script>
    $(document).ready(function() {
        $(".dropdown").on("show.bs.dropdown", function(event) {
            document.getElementById("userIcon").src = "assets/icons/guest_caret_up.svg";
        });

        $(".dropdown").on("hide.bs.dropdown", function(e) {
            document.getElementById("userIcon").src = "assets/icons/guest_caret_down.svg";
        });
    });
</script>