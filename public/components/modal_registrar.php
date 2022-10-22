<?php
require_once __DIR__ . '/load.php';
?>
<div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalRegistrar" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalRegistrar">Registrar nova conta</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 needs-validation" novalidate id="formRegistrar">
                    <input type="hidden" id="tipo" value="USER">
                    <div class="col-md-12 align-self-end">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" required minlength="3" maxlength="50">
                        <div class="valid-feedback">
                            Excelente!
                        </div>
                        <div class="invalid-feedback">
                            Seu nome precisa ter entre 3 e 50 caracteres.
                        </div>
                    </div>
                    <!-- <div class="col-md-3">
                        <label for="profile_img_filename" class="form-label">
                            <img src="assets/icons/user_focus.svg" class="rounded-circle" style="cursor: pointer;" width="80" height="80" id="preview-profile_img_filename" />
                        </label>
                        <input type="hidden" class="form-control" id="profile_img_url">
                        <input type="file" class="form-control" id="profile_img_filename" accept="image/*" style="display: none;">
                        <div class="valid-feedback">
                            Excelente!
                        </div>
                        <div class="invalid-feedback">
                            Utilize uma imagem válida.
                        </div>
                    </div> -->
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="...@dominio.com" required minlength="3" maxlength="50">
                        <div class="valid-feedback">
                            Excelente!
                        </div>
                        <div class="invalid-feedback">
                            Seu email precisa ser válido.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="confirmar_email" class="form-label">Confirmar Email</label>
                        <input type="email" class="form-control" id="confirmar_email" placeholder="...@dominio.com" required minlength="3" maxlength="50">
                        <div class="valid-feedback">
                            Excelente!
                        </div>
                        <div class="invalid-feedback" id="feedback_email">
                            Os emails são inválidos ou diferentes.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" placeholder="**********" required minlength="8" maxlength="250">
                        <div class="valid-feedback">
                            Excelente!
                        </div>
                        <div class="invalid-feedback">
                            Sua senha precisa ter pelo menos 8 caracteres.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="confirmar_senha" class="form-label">Confirmar Senha</label>
                        <input type="password" class="form-control" id="confirmar_senha" placeholder="**********" required minlength="8" maxlength="250">
                        <div class="valid-feedback">
                            Excelente!
                        </div>
                        <div class="invalid-feedback" id="feedback_senha">
                            Sua senha precisa ser igual à senha da esquerda e ter pelo menos 8 caracteres.
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label for="estado" class="form-label">Estado</label>
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
                        <label for="cidade" class="form-label">Cidade</label>
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
                <button type="submit" form="formRegistrar" class="btn btn-primary">Criar</button>
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

                showToast("toastOperacaoConcluida");
                event.preventDefault();
                registrarUsuario(form);
            }

            form.classList.add('was-validated')
        })
    }

    function registrarUsuario(Data) {
        var PostData = {
            "nome": Data.nome.value,
            // "profile_img_url" : Data.profile_img_url.value,
            // "profile_img_filename": Data.profile_img_filename.value,
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
                $('#modalRegistrar').modal('hide');
                $('#modalRegistrar').removeAttr("style");
                $('#modalRegistrar').find('form').trigger('reset');
                $('#modalRegistrar').find('form').removeClass('was-validated');
                $('#modalRegistrar').modal('dispose');
                console.log(response);
            },
            error: function(response) {
                showToast("toastWhoops");
            }
        });
    }

    //preview imagem de perfil
    //https://developer.mozilla.org/en-US/docs/Web/API/File_API/Using_files_from_web_applications
    // $(function() {
    //     $('#profile_img_filename').change(function() {
    //         var input = this;
    //         var url = $(this).val();
    //         var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    //         if (input.files && input.files[0]) {
    //             var reader = new FileReader();

    //             reader.onload = function(e) {
    //                 $('#preview-profile_img_filename').attr('src', e.target.result);
    //                 $('#profile_img_url').attr('value', URL.createObjectURL(input.files[0]));
    //             }
    //             reader.readAsDataURL(input.files[0]);
    //         }
    //     });
    // });
</script>