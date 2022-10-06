<nav class="navbar bg-light shadow-sm mb-5 rounded">
    <div class="container-fluid">
        <!-- logo -->
        <a class="navbar-brand ms-3" href="index.php">
            <img src="assets/icons/logo.svg" alt="Bootstrap" width="50" height="60">
        </a>

        <!-- user icon -->
        <div class="d-flex px-3">
            <div class="dropdown">
                <a class="navbar-brand ms-3" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="assets/icons/guest_caret_down.svg" alt="Usuário" width="50" height="50" id="userIcon">
                </a>
                <ul class="dropdown-menu dropdown-menu-end rounded-3 text-muted" id="dropdown">
                    <p class="dropdown-item">
                        Olá, visitante! Seja bem-vindo(a).
                    </p>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><button class="dropdown-item" type="button"><img src="assets/icons/sign_in.svg" width="20" height="20"> Entrar com uma conta</button></li>
                    <li><button class="dropdown-item" type="button"><img src="assets/icons/sign_up.svg" width="20" height="20"> Registrar</button></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><button class="dropdown-item" type="button"><img src="assets/icons/forgot_pass.svg" width="20" height="20"> Esqueceu sua senha?</button></li>
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

        $('.dropdown').on('hide.bs.dropdown', function(e) {
            document.getElementById("userIcon").src = "assets/icons/guest_caret_down.svg";
        });
    });
</script>