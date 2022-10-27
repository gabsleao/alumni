<div class="modal fade" id="modalRecuperarSenha" tabindex="-1" aria-labelledby="modalRecuperarSenha" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Recuperar Senha</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 needs-validation" novalidate id="formRecuperarSenha">
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
            </div>
            <div class="modal-footer">
                <button type="submit" form="formRecuperarSenha" class="btn btn-primary" id="submit_formRecuperarSenha">Entrar</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    //no evento do form submit
    document.getElementById('formRecuperarSenha').addEventListener('submit', validaformRecuperarSenha);

    function validaformRecuperarSenha() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('#formRecuperarSenha')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            if (!form.checkValidity()) {
                showToast("toastWhoops");
                event.preventDefault()
                event.stopPropagation()
            } else {
                event.preventDefault();
                recuperarSenha(form);
            }

            form.classList.add('was-validated')
        })
    }

    function recuperarSenha(Data) {
        var PostData = {
            "email": Data.email.value,
            "operacao": "recuperar_senha",
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
                        case "NAO_EXISTENTE":
                            showToast("toastUsuarioNaoExiste");
                            shake(document.getElementById("submit_formRecuperarSenha"));
                            $('#modalRecuperarSenha').find('form').removeClass('was-validated');
                            return;
                            break;

                        default:
                            showToast("toastWhoops");
                            $('#modalRecuperarSenha').find('form').removeClass('was-validated');
                            return;
                            break;
                    }
                }

                console.log("status: " + responseJson.status);
                console.log("mensagem: " + responseJson.mensagem);

                if (responseJson.status == 200) {
                    $('#modalRecuperarSenha').removeAttr("style");
                    $('#modalRecuperarSenha').modal('hide');
                    $('#modalRecuperarSenha').find('form').trigger('reset');
                    $('#modalRecuperarSenha').find('form').removeClass('was-validated');
                    $('#modalRecuperarSenha').modal('dispose');
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