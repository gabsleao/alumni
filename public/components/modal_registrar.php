<div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalRegistrar" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Registrar nova conta</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 needs-validation" novalidate id="formRegistrar">
                    <input type="hidden" id="tipo" value="USER">
                    <div class="col-md-12 align-self-end">
                        <label for="nome" class="form-label">Nome</label><span style="color: red;">*</span>
                        <input type="text" class="form-control" id="nome" required minlength="3" maxlength="50">
                        <div class="valid-feedback">
                            Excelente!
                        </div>
                        <div class="invalid-feedback">
                            Seu nome precisa ter entre 3 e 50 caracteres.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label><span style="color: red;">*</span>
                        <input type="email" class="form-control" id="email" placeholder="...@dominio.com" required minlength="3" maxlength="50">
                        <div class="valid-feedback">
                            Excelente!
                        </div>
                        <div class="invalid-feedback">
                            Seu email precisa ser válido.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="confirmar_email" class="form-label">Confirmar Email</label><span style="color: red;">*</span>
                        <input type="email" class="form-control" id="confirmar_email" placeholder="...@dominio.com" required minlength="3" maxlength="50">
                        <div class="valid-feedback" id="feedback_email_ok">
                            Excelente!
                        </div>
                        <div class="invalid-feedback" id="feedback_email">
                            Os emails são inválidos ou diferentes.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="senha" class="form-label">Senha</label><span style="color: red;">*</span>
                        <input type="password" class="form-control" id="senha" placeholder="**********" required minlength="8" maxlength="250">
                        <div class="valid-feedback">
                            Excelente!
                        </div>
                        <div class="invalid-feedback">
                            Sua senha precisa ter pelo menos 8 caracteres.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="confirmar_senha" class="form-label">Confirmar Senha</label><span style="color: red;">*</span>
                        <input type="password" class="form-control" id="confirmar_senha" placeholder="**********" required minlength="8" maxlength="250">
                        <div class="valid-feedback">
                            Excelente!
                        </div>
                        <div class="invalid-feedback" id="feedback_senha">
                            Sua senha precisa ser igual à senha da esquerda e ter pelo menos 8 caracteres.
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label for="estado" class="form-label">Estado</label><span style="color: red;">*</span>
                        <select id="estado" class="form-select" required minlength="4">
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                            <option value="EX">Estrangeiro</option>
                        </select>
                        <div class="valid-feedback">
                            Excelente!
                        </div>
                        <div class="invalid-feedback">
                            Por favor, escolha um estado.
                        </div>
                    </div>
                    <div class="col-md-7">
                        <label for="cidade" class="form-label">Cidade</label><span style="color: red;">*</span>
                        <input type="text" class="form-control" id="cidade" required minlength="3" maxlength="250">
                        <div class="valid-feedback">
                            Excelente!
                        </div>
                        <div class="invalid-feedback">
                            O nome da cidade deve ter pelo menos 3 caracteres.
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" form="formRegistrar" class="btn btn-primary" id="submit_formRegistrar">Criar</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    //no evento do form submit
    document.getElementById('formRegistrar').addEventListener('submit', validaFormRegistrar);

    function validaFormRegistrar() {
        //pega o form pra validar
        const forms = document.querySelectorAll('#formRegistrar')

        //verifica todos (em caso de multiplos forms)
        Array.from(forms).forEach(form => {
            $("#feedback_email").removeClass("d-block");
            $("#feedback_senha").removeClass("d-block");
            if (!form.checkValidity()) {
                showToast("toastWhoops");
                event.preventDefault();
                event.stopPropagation();

                console.log(form.email.value);
                console.log(form.confirmar_email.value);
                //validação adicional...
                if (form.email.value != form.confirmar_email.value) {
                    $("#feedback_email").addClass("d-block");
                    $("#feedback_email_ok").hide();
                    $("#feedback_email_ok").removeClass("valid-feedback");
                    podeRegistrar = false;
                }

            } else {
                var podeRegistrar = true;

                //validação adicional...
                if (form.email.value != form.confirmar_email.value) {
                    $("#feedback_email").addClass("d-block");
                    podeRegistrar = false;
                }

                if (form.senha.value != form.confirmar_senha.value) {
                    $("#feedback_senha").addClass("d-block");
                    podeRegistrar = false;
                }

                if (!podeRegistrar) {
                    showToast("toastWhoops");
                    event.preventDefault();
                    event.stopPropagation();
                    return;
                }
                event.preventDefault();
                registrarUsuario(form);
            }

            form.classList.add('was-validated')
        })
    }

    function registrarUsuario(Data) {
        var PostData = {
            "nome": Data.nome.value,
            "email": Data.email.value,
            "confirmar_email": Data.confirmar_email.value,
            "senha": Data.senha.value,
            "confirmar_senha": Data.confirmar_senha.value,
            "estado": Data.estado.value,
            "cidade": Data.cidade.value,
            "tipo": Data.tipo.value,
            "operacao": "registrar_usuario",
            "controller": "UserController",
        };

        $.ajax({
            type: "POST",
            url: "./public/controllers/endpoint.php",
            data: PostData,
            success: function(response) {
                responseJson = JSON.parse(response);
                if (responseJson.status == 405) {
                    switch (responseJson.mensagem) {
                        case "USUARIO_JA_EXISTENTE":
                            showToast("toastUsuarioJaExiste");
                            shake(document.getElementById("submit_formRegistrar"));
                            $('#modalRegistrar').find('form').removeClass('was-validated');
                            return;
                            break;

                        case "USUARIO_NAO_CRIADO":
                        default:
                            showToast("toastWhoops");
                            $('#modalRegistrar').find('form').removeClass('was-validated');
                            return;
                            break;
                    }
                }

                if (responseJson.status == 200 && responseJson.mensagem == "USUARIO_CRIADO") {
                    showToast("toastOperacaoConcluida");
                    $('#modalRegistrar').removeAttr("style");
                    $('#modalRegistrar').modal('hide');
                    $('#modalRegistrar').find('form').trigger('reset');
                    $('#modalRegistrar').find('form').removeClass('was-validated');
                    $('#modalRegistrar').modal('dispose');
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