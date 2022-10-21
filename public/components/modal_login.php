<?php
require_once __DIR__ . '/load.php';
?>
<div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="modalLogin" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalLogin">Entrar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 needs-validation" novalidate>
                    <div class="col-md-12 align-self-end">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" required minlength="3" maxlength="50">
                        <div class="valid-feedback">
                            Excelente!
                        </div>
                        <div class="invalid-feedback">
                            Digite um email válido.
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" placeholder="**********" required minlength="8" maxlength="250">
                        <div class="valid-feedback">
                            Excelente!
                        </div>
                        <div class="invalid-feedback">
                            Digite uma senha válida.
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Entrar</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    //valida o form
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    showToast("toastWhoops");
                    event.preventDefault()
                    event.stopPropagation()
                } else {
                    showToast("toastOperacaoConcluida");
                    event.preventDefault();
                    logarUsuario(form);
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()

    function logarUsuario(Data) {
        var PostData = {
            "email": Data.email.value,
            "senha": Data.senha.value,
            "operacao": "logar_usuario",
            "controller": "UserController",
        };

        $.ajax({
            type: "POST",
            url: "./public/controllers/endpoint.php",
            data: PostData,
            success: function(response) {
                console.log('success');
                console.log(response);
            },
            error: function(response) {
                console.log('error');
                console.log(response);
            }
        });
    }
</script>