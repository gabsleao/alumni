<?php
require_once __DIR__ . '/load.php';
?>
<div class="modal fade" id="modalDeslogar" tabindex="-1" aria-labelledby="modalDeslogar" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Deseja mesmo sair?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <form class="row g-3" novalidate id="formDeslogar">
                    <div class="col-12">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Não</button>
                        <button type="submit" form="formDeslogar" class="btn btn-primary" id="submit_formDeslogar">Sair</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    //no evento do form submit
    document.getElementById('formDeslogar').addEventListener('submit', deslogarUsuario);

    function deslogarUsuario() {
        event.preventDefault();

        var PostData = {
            "operacao": "deslogar_usuario",
            "controller": "SessionController",
        };

        $.ajax({
            type: "POST",
            url: "./public/controllers/endpoint.php",
            data: PostData,
            success: function(response) {
                responseJson = JSON.parse(response);

                if (responseJson.status == 405) {
                    switch (responseJson.mensagem) {
                        case "SESSION_NAO_SETADA":
                            showToast("toastOperacaoConcluida");
                            $('#modalDeslogar').modal('hide');
                            $('#modalDeslogar').modal('dispose');
                            event.preventDefault()
                            window.location.replace('./index.php');
                            return;
                            break;

                        default:
                            showToast("toastWhoops");
                            $('#modalDeslogar').find('form').removeClass('was-validated');
                            return;
                            break;
                    }
                }

                console.log("status: " + responseJson.status);
                console.log("mensagem: " + responseJson.mensagem);

                if (responseJson.status == 200 && responseJson.mensagem == "USUARIO_DESLOGADO") {
                    showToast("toastDeslogando");
                    $('#modalDeslogar').removeAttr("style");
                    $('#modalDeslogar').modal('hide');
                    $('#modalDeslogar').modal('dispose');
                    setTimeout(function() {
                        window.location.href = "./index.php";
                    }, 2000);
                    return;
                }

                showToast("toastWhoops");
            },
            error: function(response) {
                showToast("toastWhoops");
            }
        });
    }
</script>