<div class="toast-container p-3 position-fixed top-0 end-0" data-original-class="toast-container p-3">
    <div class="toast fade" id="toastOperacaoConcluida">
        <div class="toast-header">
            <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <rect width="100%" height="100%" fill="#62ff00"></rect>
            </svg>

            <strong class="me-auto">Sucesso!</strong>
            <small>agora mesmo</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Operação enviada!
        </div>
    </div>

    <div class="toast fade" id="toastUsuarioNaoExiste">
        <div class="toast-header">
            <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <rect width="100%" height="100%" fill="#ff0000"></rect>
            </svg>

            <strong class="me-auto">Whoops!</strong>
            <small>agora mesmo</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            O email digitado não existe... ainda!
        </div>
    </div>

    <div class="toast fade" id="toastUsuarioJaExiste">
        <div class="toast-header">
            <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <rect width="100%" height="100%" fill="#ff0000"></rect>
            </svg>

            <strong class="me-auto">Whoops!</strong>
            <small>agora mesmo</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            O email digitado já existe na nossa plataforma, utilize-o para logar ou recupera a senha caso tenha esquecido!
        </div>
    </div>

    <div class="toast fade" id="toastSenhaIncorreta">
        <div class="toast-header">
            <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <rect width="100%" height="100%" fill="#ff0000"></rect>
            </svg>

            <strong class="me-auto">Whoops!</strong>
            <small>agora mesmo</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            A senha está incorreta! Tente novamente.
        </div>
    </div>

    <div class="toast fade" id="toastDeslogando">
        <div class="toast-header">
            <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <rect width="100%" height="100%" fill="#0d6efd"></rect>
            </svg>

            <strong class="me-auto">Aguarde!</strong>
            <small>agora mesmo</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Saindo...
        </div>
    </div>

    <div class="toast fade" id="toastDeslogado">
        <div class="toast-header">
            <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <rect width="100%" height="100%" fill="#62ff00"></rect>
            </svg>

            <strong class="me-auto">Sucesso!</strong>
            <small>agora mesmo</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Usuário <u><b><?php echo $_SESSION["Session"]->Usuario->nome; ?></b></u> deslogado!
        </div>
    </div>

    <div class="toast fade" id="toastLogando">
        <div class="toast-header">
            <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <rect width="100%" height="100%" fill="#0d6efd"></rect>
            </svg>

            <strong class="me-auto">Aguarde!</strong>
            <small>agora mesmo</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Entrando...
        </div>
    </div>

    <div class="toast fade" id="toastLogado">
        <div class="toast-header">
            <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <rect width="100%" height="100%" fill="#62ff00"></rect>
            </svg>

            <strong class="me-auto">Sucesso!</strong>
            <small>agora mesmo</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Usuário logado!
        </div>
    </div>

    <div class="toast fade" id="toastNotAllowed">
        <div class="toast-header">
            <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <rect width="100%" height="100%" fill="#ff0000"></rect>
            </svg>

            <strong class="me-auto">Ação indisponível</strong>
            <small>agora mesmo</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Para realizar essa operação, por favor faça login!
        </div>
    </div>

    <div class="toast fade" id="toastWhoops">
        <div class="toast-header">
            <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <rect width="100%" height="100%" fill="#ff0000"></rect>
            </svg>

            <strong class="me-auto">Whoops!</strong>
            <small>agora mesmo</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Algo deu errado, por favor tente novamente!
        </div>
    </div>
</div>