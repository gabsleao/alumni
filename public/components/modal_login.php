<?php
require_once __DIR__ . '/load.php';
?>
<div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="modalLogin" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Entrar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 needs-validation" novalidate id="formLogin">
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
                <button type="submit" form="formLogin" class="btn btn-primary" id="submit_formLogin">Entrar</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    //no evento do form submit
    document.getElementById('formLogin').addEventListener('submit', validaFormLogin);

    function validaFormLogin() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('#formLogin')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            if (!form.checkValidity()) {
                showToast("toastWhoops");
                event.preventDefault()
                event.stopPropagation()
            } else {
                event.preventDefault();
                logarUsuario(form);
            }

            form.classList.add('was-validated')
        })
    }

    function logarUsuario(Data) {
        var PostData = {
            "email": Data.email.value,
            "senha": Data.senha.value,
            "operacao": "logar_usuario",
            "controller": "UserController",
        };

        showToast("toastLogando");
        $.ajax({
            type: "POST",
            url: "./public/controllers/endpoint.php",
            data: PostData,
            success: function(response) {
                responseJson = JSON.parse(response);

                if (responseJson.status == 405) {
                    switch (responseJson.mensagem) {
                        case "NAO_EXISTENTE":
                            showToast("toastUsuarioNaoExiste");
                            shake(document.getElementById("submit_formLogin"));
                            $('#modalLogin').find('form').removeClass('was-validated');
                            return;
                            break;

                        case "SENHA_INCORRETA":
                            showToast("toastSenhaIncorreta");
                            $('#modalLogin').removeAttr("style");
                            $('#modalLogin').modal('hide');
                            $('#modalLogin').find('form').trigger('reset');
                            $('#modalLogin').find('form').removeClass('was-validated');
                            $('#modalLogin').modal('dispose');
                            return;
                            break;

                        default:
                            showToast("toastWhoops");
                            $('#modalLogin').find('form').removeClass('was-validated');
                            return;
                            break;
                    }
                }

                console.log("status: " + responseJson.status);
                console.log("mensagem: " + responseJson.mensagem);

                if (responseJson.status == 200 && responseJson.mensagem == "USUARIO_LOGADO") {
                    $('#modalLogin').removeAttr("style");
                    $('#modalLogin').modal('hide');
                    $('#modalLogin').find('form').trigger('reset');
                    $('#modalLogin').find('form').removeClass('was-validated');
                    $('#modalLogin').modal('dispose');
                    setTimeout(function() {
                        window.location.href = "./index.php";
                    }, 2000);
                    showToast("toastLogado");
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