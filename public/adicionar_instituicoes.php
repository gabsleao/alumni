<?php
require_once __DIR__ . '/config/head.php';
require_once __DIR__ . '/config/config.php';

require_once __DIR__ . '/components/load.php';
require_once __DIR__ . '/components/navbar.php';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-2">
            <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-light rounded">
                <button class="btn p-3 border-bottom" type="button" data-bs-toggle="modal" data-bs-target="#modalBoasPraticas">
                    <img src="assets/icons/artigo.svg" width="20" height="20"><span class="fs-5 fw-semibold ms-2">Artigos de Boas Práticas</span>
                </button>
                <div class="list-group list-group-flush border-bottom" style="height: 780px; overflow-y: scroll;">
                    <a href="#" class="list-group-item list-group-item-action py-3 lh-sm" aria-current="true">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">Instituições Duplicadas</strong><small>15/11/2022</small>
                        </div>
                        <div class="col-10 mb-1 small">Antes de adicionar uma instituição de ensino, procure verificar se a mesma já não foi adicionada.</div>
                        <p class="col-10 mb-1 small">
                            última edição: <i>15/11/2022</i>
                        </p>
                    </a>

                    <a href="#" class="list-group-item list-group-item-action py-3 lh-sm" aria-current="true">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">Fake News!</strong><small>15/11/2022</small>
                        </div>
                        <div class="col-10 mb-1 small">Cuidado ao adicionar as informações das instituições e/ou cursos. Informações falsas não serão toleradas.</div>
                        <p class="col-10 mb-1 small">
                            última edição: <i>15/11/2022</i>
                        </p>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-8">
            <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-light rounded">
                <form class="row g-3 needs-validation mt-3 mb-3 me-2 form-switch" novalidate id="formAdicionarInstituicao">
                    <div class="col-md-9">
                        <label for="nome" class="form-label">Nome da Instituição</label>
                        <input type="text" class="form-control" id="nome" required minlength="3" maxlength="100" placeholder="Colégio Alumni">
                        <div class="valid-feedback">
                            Excelente!
                        </div>
                        <div class="invalid-feedback">
                            Seu nome precisa ter entre 3 e 100 caracteres.
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-1">
                        <input type="hidden" class="form-control" id="profile_img_url">
                        <input type="file" class="form-control" id="profile_img_filename" accept="image/*" style="display: none;">
                        <label for="profile_img_filename" class="form-label">
                            <img src="assets/icons/logo.svg" style="cursor: pointer;" width="80" height="80" id="preview-profile_img_filename"/>
                        </label>
                        <div class="valid-feedback">
                            Excelente!
                        </div>
                        <div class="invalid-feedback">
                            Utilize uma imagem válida.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="endereco" class="form-label">Endereço (Rua, Logradouro, Avenida, etc...)</label>
                        <input type="text" class="form-control" id="endereco" required minlength="5" maxlength="250" placeholder="Rua Alumnosa da Silva, 1337">
                        <div class="valid-feedback">
                            Excelente!
                        </div>
                        <div class="invalid-feedback">
                            O endereço ter pelo menos 5 caracteres.
                        </div>
                    </div>
                    <div class="col-md-2">
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
                            <option value="SP" selected>São Paulo</option>
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
                    <div class="col-md-4">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" class="form-control" id="cidade" required minlength="3" maxlength="250" placeholder="Alumnicity">
                        <div class="valid-feedback">
                            Excelente!
                        </div>
                        <div class="invalid-feedback">
                            O nome da cidade deve ter pelo menos 3 caracteres.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="tipo" class="form-label">Tipo</label>
                        <select id="tipo" class="form-select" required>
                            <option value="escola">Creche, Pré-Escola, Ensino Fundamental 1 e 2 e Ensino Médio.</option>
                            <option value="faculdade">Ensino Superior, Pós-Graduação, Mestrado e Doutorado</option>
                            <option value="idioma">Cursos de Idiomas</option>
                            <option value="profissionalizante">Cursos Profissionalizantes</option>
                            <option value="outros">Outros...</option>
                        </select>
                        <div class="valid-feedback">
                            Excelente!
                        </div>
                        <div class="invalid-feedback">
                            Escolha um tipo válido.
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="site" class="form-label">Site da Instituição</label>
                        <input type="text" class="form-control" id="site" required minlength="3" maxlength="250" placeholder="alumnisite.com.br">
                        <div class="valid-feedback">
                            Excelente!
                        </div>
                        <div class="invalid-feedback">
                            O nome do site deve ter pelo menos 3 caracteres.
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="telefone" class="form-label">Telefone para Contato</label>
                        <input type="text" class="form-control" id="telefone" required minlength="9" maxlength="15" placeholder="(19) 99195-0612">
                        <div class="valid-feedback">
                            Excelente!
                        </div>
                        <div class="invalid-feedback">
                            Utilize um número de contato válido
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-check-label" for="instituicao_inclusiva">Instituição Inclusiva</label><button class="btn btn-link" type="button" data-bs-toggle="modal" data-bs-target="#modalInformativoInclusao"><img src="assets/icons/informativo.svg" width="20" height="20"></button>
                        <br><input class="form-check-input ms-5" type="checkbox" value="1" id="instituicao_inclusiva">
                    </div>

                    <div class="col-md-4">
                        <li class="list-unstyled">
                            <input class="form-check-input" type="checkbox" value="1" id="checkbox_modalidade_presencial">
                            <label class="form-check-label" for="checkbox_modalidade_presencial">Presencial</label>
                        </li>
                        <li class="list-unstyled">
                            <input class="form-check-input" type="checkbox" value="1" id="checkbox_modalidade_remoto">
                            <label class="form-check-label" for="checkbox_modalidade_remoto">Remoto (EaD)</label>
                        </li>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Deixe uma descrição da instituição" id="descricao"></textarea>
                            <label for="descricao">Descrição</label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" form="formAdicionarInstituicao" class="btn btn-primary" id="submit_formAdicionarInstituicao">Criar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    //no evento do form submit
    document.getElementById('formAdicionarInstituicao').addEventListener('submit', validaformAdicionarInstituicao);

    function validaformAdicionarInstituicao() {
        //pega o form pra validar
        const forms = document.querySelectorAll('#formAdicionarInstituicao')

        //verifica todos (em caso de multiplos forms)
        Array.from(forms).forEach(form => {
            if (!form.checkValidity()) {
                showToast("toastWhoops");
                event.preventDefault();
                event.stopPropagation();
            } else {
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
                responseJson = JSON.parse(response);
                if (responseJson.status == 405) {
                    switch (responseJson.mensagem) {
                        case "USUARIO_JA_EXISTENTE":
                            showToast("toastUsuarioJaExiste");
                            shake(document.getElementById("submit_formAdicionarInstituicao"));
                            $('#modalRegistrar').find('form').removeClass('was-validated');
                            return;
                            break;

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