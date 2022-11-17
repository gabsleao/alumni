<?php
$UserIcon = "assets/icons/guest_caret_down.svg";
if (isset($_SESSION["Session"]) && strlen($_SESSION["Session"]->Usuario->informacoes["profile_img_url"]) > 0) {
    $UserIcon = $_SESSION["Session"]->Usuario->informacoes["profile_img_url"];
}

$Username = isset($_SESSION["Session"]) ? $_SESSION["Session"]->Usuario->nome : "visitante";
$Logado = isset($_SESSION["Session"]) ? true : false;

$HTMLTag = $Logado ? "onclick='abrirPaginaInstituicao();'" : "data-bs-toggle=\"modal\" data-bs-target=\"#modalWhoops\"";

?>

<nav class="bg-light shadow-sm mb-3 rounded">
    <div class="container-fluid">
        <div class="row">
            <div class="col-1 mt-2">
                <a class="navbar-brand ms-3" href="index.php">
                    <img src="assets/icons/logo.svg" alt="Bootstrap" width="50" height="60">
                </a>
            </div>

            <div class="col-1 mt-4">
                <li class="nav-item dropdown list-unstyled">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Contribuir
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" <?= $HTMLTag; ?>>Adicionar Instituição</a></li>
                    </ul>
                </li>
            </div>

            <div class="col-10 mt-2">
                <div class="dropdown d-flex align-items-end flex-column align-bottom">
                    <a class="ms-3" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?= $UserIcon ?>" alt="Usuário" width="50" height="50" id="userIcon">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end rounded-3 text-muted mt-3" id="dropdown">
                        <p class="ms-3">
                            Olá, <u><b><?= $Username ?></b></u>!<br> Seja bem-vindo(a).
                        </p>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <?php if (!$Logado) { ?>
                            <li><button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#modalLogin"><img src="assets/icons/sign_in.svg" width="20" height="20"> Entrar com uma conta</button></li>
                            <li><button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#modalRegistrar"><img src="assets/icons/sign_up.svg" width="20" height="20"> Registrar</button></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#modalRecuperarSenha"><img src="assets/icons/forgot_pass.svg" width="20" height="20"> Esqueceu sua senha?</button></li>
                        <?php } else { ?>
                            <li><button class="dropdown-item" type="button" onclick="window.location.href = './public/perfil_usuario.php';"><img src="assets/icons/user_list.svg" width="20" height="20"> Ver perfil</button></li>
                            <!-- <li><button class="dropdown-item" type="button"><img src="assets/icons/gear.svg" width="20" height="20"> Configurações</button></li> -->
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#modalDeslogar"><img src="assets/icons/power.svg" width="20" height="20"> Sair</button></li>
                        <?php } ?>

                    </ul>
                </div>
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

    function abrirPaginaInstituicao(){
        window.location.href = "./adicionar_instituicoes.php"
    }
</script>