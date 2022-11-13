<div class="modal fade" id="modalMudarSenha" tabindex="-1" aria-labelledby="modalMudarSenha" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Mudar Senha</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 needs-validation" novalidate id="formMudarSenha">
                    <div class="col-md-12 align-self-end">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" required minlength="3" maxlength="50" value="<?= isset($_SESSION["Session"]->Usuario->email) ? Seguranca::decryptString($_SESSION["Session"]->Usuario->email) : ''; ?>">
                        <div class="valid-feedback">
                            Excelente!
                        </div>
                        <div class="invalid-feedback">
                            Digite um email válido.
                        </div>
                    </div>
                    <div class="col-md-6 align-self-end">
                        <label for="senha_atual" class="form-label">Senha Atual</label>
                        <input type="password" class="form-control" id="senha_atual" placeholder="**********" required minlength="8" maxlength="250">
                        <div class="valid-feedback">
                            Excelente!
                        </div>
                        <div class="invalid-feedback">
                            Sua senha precisa ter pelo menos 8 caracteres.
                        </div>
                    </div>
                    <div class="col-md-6 align-self-end">
                        <label for="senha_nova" class="form-label">Nova Senha</label>
                        <input type="password" class="form-control" id="senha_nova" placeholder="**********" required minlength="8" maxlength="250">
                        <div class="valid-feedback">
                            Excelente!
                        </div>
                        <div class="invalid-feedback">
                            Sua senha precisa ter pelo menos 8 caracteres.
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" form="formMudarSenha" class="btn btn-primary" id="submit_formMudarSenha">Entrar</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    //no evento do form submit
    document.getElementById('formMudarSenha').addEventListener('submit', validaformMudarSenha);

    function validaformMudarSenha() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('#formMudarSenha')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            if (!form.checkValidity()) {
                showToast("toastWhoops");
                event.preventDefault()
                event.stopPropagation()
            } else {
                event.preventDefault();
                mudarSenha(form);
            }

            form.classList.add('was-validated')
        })
    }

    function mudarSenha(Data) {
        var PostData = {
            "email": Data.email.value,
            "senha_atual": Data.senha_atual.value,
            "senha_nova": Data.senha_nova.value,
            "operacao": "mudar_senha",
            "controller": "UserController",
        };
        
        showToast("toastOperacaoConcluida");
        $.ajax({
            type: "POST",
            url: "./public/controllers/endpoint.php",
            data: PostData,
            success: function(response) {
                responseJson = JSON.parse(response);

                if (responseJson.status == 405) {
                    switch (responseJson.mensagem) {
                        case "SENHA_DIFERENTE":
                            showToast("");
                            shake(document.getElementById("submit_formMudarSenha"));
                            $('#modalMudarSenha').find('form').removeClass('was-validated');
                            return;
                            break;

                        default:
                            showToast("toastWhoops");
                            $('#modalMudarSenha').find('form').removeClass('was-validated');
                            return;
                            break;
                    }
                }

                console.log("status: " + responseJson.status);
                console.log("mensagem: " + responseJson.mensagem);

                if (responseJson.status == 200) {
                    $('#modalMudarSenha').removeAttr("style");
                    $('#modalMudarSenha').modal('hide');
                    $('#modalMudarSenha').find('form').trigger('reset');
                    $('#modalMudarSenha').find('form').removeClass('was-validated');
                    $('#modalMudarSenha').modal('dispose');
                    setTimeout(function() {
                        window.location.href = "./index.php";
                    }, 2000);
                    showToast("toastEmailEnviadoRecuperarSenha");
                    return;
                }

                //deu zika
                showToast("toastWhoops");
            },
            error: function(response) {
                showToast("toastWhoops");
                console.log('error: ' + response);
            }
        });
    }
</script>