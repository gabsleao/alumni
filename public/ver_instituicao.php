<?php
require_once __DIR__ . '/config/head.php';
require_once __DIR__ . '/config/config.php';

require_once __DIR__ . '/components/load.php';
require_once __DIR__ . '/components/navbar.php';

if (empty($_GET['id'])) { ?>
<script>
    window.location.replace('./index.php');
</script>
<?php
}

$InstituicaoController = new AbstractController("InstituicaoController");
$InstituicaoController->Controller->idinstituicao = $_GET['id'];
$getInstituicaoRequest = json_decode($InstituicaoController->get());

if (isset($getInstituicaoRequest->Sucesso) && !$getInstituicaoRequest->Sucesso || empty($getInstituicaoRequest->Resposta)){
    echo "Whoops! Algo deu errado...";
    exit;
}

$Instituicao = $getInstituicaoRequest->Resposta;

if(isset($Instituicao->informacoes) && is_string($Instituicao->informacoes)){
    $Endereço = json_decode($Instituicao->informacoes)->endereco ?? 'não encontrado ):';
    $Cidade = json_decode($Instituicao->informacoes)->cidade ?? 'não encontrada ):';
    $Site = json_decode($Instituicao->informacoes)->site ?? 'não encontrado ):';
    $Telefone = json_decode($Instituicao->informacoes)->telefone ?? 'não encontrado ):';
    $Inclusiva = json_decode($Instituicao->informacoes)->instituicao_inclusiva ?? false;
    $Presencial = json_decode($Instituicao->informacoes)->modalidade_presencial ?? false;
    $Remoto = json_decode($Instituicao->informacoes)->modalidade_remoto ?? false;
    $Descrição = json_decode($Instituicao->informacoes)->descricao ?? 'não encontrado ):';
}

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-10">
            <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-light rounded">
                <form class="row g-3 needs-validation mt-3 mb-3 me-2 form-switch" novalidate id="formAdicionarInstituicao">
                    <div class="col-md-9">
                        <label for="nome" class="form-label">Nome da Instituição</label>
                        <input type="text" class="form-control" id="nome" required minlength="3" maxlength="100" value="<?= $Instituicao->nome; ?>" disabled>
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
                            <img src="assets/icons/logo.svg" style="cursor: pointer;" width="80" height="80" id="preview-profile_img_filename" />
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
                        <input type="text" class="form-control" id="endereco" required minlength="5" maxlength="250" value="<?= $Endereço; ?>" disabled>
                        <div class="valid-feedback">
                            Excelente!
                        </div>
                        <div class="invalid-feedback">
                            O endereço ter pelo menos 5 caracteres.
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="estado" class="form-label">Estado</label>
                        <select id="estado" class="form-select" required minlength="4" disabled>
                            <option value="AC" <?= ($Instituicao->localizacao == 'AC' ? 'selected' : ''); ?>>Acre</option>
                            <option value="AL" <?= ($Instituicao->localizacao == 'AL' ? 'selected' : ''); ?>>Alagoas</option>
                            <option value="AP" <?= ($Instituicao->localizacao == 'AP' ? 'selected' : ''); ?>>Amapá</option>
                            <option value="AM" <?= ($Instituicao->localizacao == 'AM' ? 'selected' : ''); ?>>Amazonas</option>
                            <option value="BA" <?= ($Instituicao->localizacao == 'BA' ? 'selected' : ''); ?>>Bahia</option>
                            <option value="CE" <?= ($Instituicao->localizacao == 'CE' ? 'selected' : ''); ?>>Ceará</option>
                            <option value="DF" <?= ($Instituicao->localizacao == 'DF' ? 'selected' : ''); ?>>Distrito Federal</option>
                            <option value="ES" <?= ($Instituicao->localizacao == 'ES' ? 'selected' : ''); ?>>Espírito Santo</option>
                            <option value="GO" <?= ($Instituicao->localizacao == 'GO' ? 'selected' : ''); ?>>Goiás</option>
                            <option value="MA" <?= ($Instituicao->localizacao == 'MA' ? 'selected' : ''); ?>>Maranhão</option>
                            <option value="MT" <?= ($Instituicao->localizacao == 'MT' ? 'selected' : ''); ?>>Mato Grosso</option>
                            <option value="MS" <?= ($Instituicao->localizacao == 'MS' ? 'selected' : ''); ?>>Mato Grosso do Sul</option>
                            <option value="MG" <?= ($Instituicao->localizacao == 'MG' ? 'selected' : ''); ?>>Minas Gerais</option>
                            <option value="PA" <?= ($Instituicao->localizacao == 'PA' ? 'selected' : ''); ?>>Pará</option>
                            <option value="PB" <?= ($Instituicao->localizacao == 'PB' ? 'selected' : ''); ?>>Paraíba</option>
                            <option value="PR" <?= ($Instituicao->localizacao == 'PR' ? 'selected' : ''); ?>>Paraná</option>
                            <option value="PE" <?= ($Instituicao->localizacao == 'PE' ? 'selected' : ''); ?>>Pernambuco</option>
                            <option value="PI" <?= ($Instituicao->localizacao == 'PI' ? 'selected' : ''); ?>>Piauí</option>
                            <option value="RJ" <?= ($Instituicao->localizacao == 'RJ' ? 'selected' : ''); ?>>Rio de Janeiro</option>
                            <option value="RN" <?= ($Instituicao->localizacao == 'RN' ? 'selected' : ''); ?>>Rio Grande do Norte</option>
                            <option value="RS" <?= ($Instituicao->localizacao == 'RS' ? 'selected' : ''); ?>>Rio Grande do Sul</option>
                            <option value="RO" <?= ($Instituicao->localizacao == 'RO' ? 'selected' : ''); ?>>Rondônia</option>
                            <option value="RR" <?= ($Instituicao->localizacao == 'RR' ? 'selected' : ''); ?>>Roraima</option>
                            <option value="SC" <?= ($Instituicao->localizacao == 'SC' ? 'selected' : ''); ?>>Santa Catarina</option>
                            <option value="SP" <?= ($Instituicao->localizacao == 'SP' ? 'selected' : ''); ?>>São Paulo</option>
                            <option value="SE" <?= ($Instituicao->localizacao == 'SE' ? 'selected' : ''); ?>>Sergipe</option>
                            <option value="TO" <?= ($Instituicao->localizacao == 'TO' ? 'selected' : ''); ?>>Tocantins</option>
                            <option value="EX" <?= ($Instituicao->localizacao == 'EX' ? 'selected' : ''); ?>>Estrangeiro</option>
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
                        <input type="text" class="form-control" id="cidade" required minlength="3" maxlength="250" value="<?= $Cidade; ?>" disabled>
                        <div class="valid-feedback">
                            Excelente!
                        </div>
                        <div class="invalid-feedback">
                            O nome da cidade deve ter pelo menos 3 caracteres.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="tipo" class="form-label">Tipo</label>
                        <select id="tipo" class="form-select" required disabled>
                            <option value="escola" <?= ($Instituicao->tipo == 'escola' ? 'selected' : ''); ?>>Creche, Pré-Escola, Ensino Fundamental 1 e 2 e Ensino Médio.</option>
                            <option value="faculdade" <?= ($Instituicao->tipo == 'faculdade' ? 'selected' : ''); ?>>Ensino Superior, Pós-Graduação, Mestrado e Doutorado</option>
                            <option value="idioma" <?= ($Instituicao->tipo == 'idioma' ? 'selected' : ''); ?>>Cursos de Idiomas</option>
                            <option value="profissionalizante" <?= ($Instituicao->tipo == 'profissionalizante' ? 'selected' : ''); ?>>Cursos Profissionalizantes</option>
                            <option value="outros" <?= ($Instituicao->tipo == 'escola' ? 'outros' : ''); ?>>Outros...</option>
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
                        <input type="text" class="form-control" id="site" required minlength="3" maxlength="250" value="<?= $Site; ?>" disabled>
                        <div class="valid-feedback">
                            Excelente!
                        </div>
                        <div class="invalid-feedback">
                            O nome do site deve ter pelo menos 3 caracteres.
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="telefone" class="form-label">Telefone para Contato</label>
                        <input type="text" class="form-control" id="telefone" required minlength="9" maxlength="15" value="<?= $Telefone; ?>" disabled>
                        <div class="valid-feedback">
                            Excelente!
                        </div>
                        <div class="invalid-feedback">
                            Utilize um número de contato válido
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-check-label" for="instituicao_inclusiva">Instituição Inclusiva</label><button class="btn btn-link" type="button" data-bs-toggle="modal" data-bs-target="#modalInformativoInclusao"><img src="assets/icons/informativo.svg" width="20" height="20"></button>
                        <br><input class="form-check-input ms-5" type="checkbox" value="1" id="instituicao_inclusiva" <?= ($Inclusiva ? 'checked' : ''); ?> disabled>
                    </div>

                    <div class="col-md-4">
                        <li class="list-unstyled">
                            <input class="form-check-input" type="checkbox" value="1" id="checkbox_modalidade_presencial" <?= ($Presencial ? 'checked' : ''); ?> disabled>
                            <label class="form-check-label" for="checkbox_modalidade_presencial">Presencial</label>
                        </li>
                        <li class="list-unstyled">
                            <input class="form-check-input" type="checkbox" value="1" id="checkbox_modalidade_remoto" <?= ($Remoto ? 'checked' : ''); ?> disabled>
                            <label class="form-check-label" for="checkbox_modalidade_remoto">Remoto (EaD)</label>
                        </li>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Deixe uma descrição da instituição" id="descricao" minlength="10" maxlength="250" required disabled><?= $Descrição; ?></textarea>
                            <label for="descricao">Breve descrição da instituição</label>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button class="btn btn-primary me-4">Ver Cursos</button>
                        <button class="btn btn-primary me-4">Adicionar um Comentário</button>
                        <i class="bi <?= (in_array($IDUserGlobal, $Instituicao->curtidas) ? 'bi-heart-fill' : 'bi-heart'); ?>" 
                                    style="cursor: pointer;" 
                                    onclick="<?= (isset($IDUserGlobal) ? "like(" . $IDUserGlobal . ", " . $Instituicao->idinstituicao . ", 0);" : "notAllowed(document, " . $Instituicao->idinstituicao . ");"); ?>" 
                                    id="like_id-<?= $Instituicao->idinstituicao; ?>">
                                </i>
                        <button form="formEditarInstituicao" class="btn me-4 mr-4" id="submit_formEditarInstituicao">Editar</button>
                        <button type="button" class="btn btn-secondary me-4 mr-4" data-bs-dismiss="modal" hidden>Cancelar</button>
                        <button type="submit" form="formAdicionarInstituicao" class="btn btn-primary me-4 mr-4" id="submit_formAdicionarInstituicao" hidden>Salvar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-2">
            <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-light rounded">
                LISTA DE LIKES
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-light rounded">
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
                adicionarInstituicao(form);
            }

            form.classList.add('was-validated')
        })
    }

    function adicionarInstituicao(Data) {
        var PostData = {
            "nome": Data.nome.value,
            "profile_img_url": Data.profile_img_url.value,
            "profile_img_filename": Data.profile_img_filename.value,
            "endereco": Data.endereco.value,
            "estado": Data.estado.value,
            "cidade": Data.cidade.value,
            "tipo": Data.tipo.value,
            "site": Data.site.value,
            "telefone": Data.telefone.value,
            "descricao": Data.descricao.value,
            "instituicao_inclusiva": $('#instituicao_inclusiva').is(":checked"),
            "modalidade_presencial": $('#checkbox_modalidade_presencial').is(":checked"),
            "modalidade_remoto": $('#checkbox_modalidade_remoto').is(":checked"),
            "operacao": "adicionar_instituicao",
            "controller": "InstituicaoController",
        };

        $.ajax({
            type: "POST",
            url: "./public/controllers/endpoint.php",
            data: PostData,
            success: function(response) {
                console.log(response);
                responseJson = JSON.parse(response);
                if (responseJson.status == 405) {
                    switch (responseJson.mensagem) {
                        case "INSTITUICAO_JA_EXISTENTE":
                            showToast("toastInstituicaoJaExiste");
                            shake(document.getElementById("submit_formAdicionarInstituicao"));
                            $('#formAdicionarInstituicao').find('form').removeClass('was-validated');
                            return;
                            break;

                        default:
                            showToast("toastWhoops");
                            return;
                            break;
                    }
                }

                if (responseJson.status == 200 && responseJson.mensagem == "INSTITUICAO_CRIADA") {
                    showToast("toastOperacaoConcluida");
                    setTimeout(function() {
                        $('#formAdicionarInstituicao').trigger('reset');
                        $('#formAdicionarInstituicao').removeClass('was-validated');
                        window.location.href = "./adicionar_instituicoes.php";
                    }, 1500);
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