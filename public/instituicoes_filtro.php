<?php
require_once __DIR__ . '/config/head.php';
require_once __DIR__ . '/config/config.php';

require_once __DIR__ . '/components/load.php';
require_once __DIR__ . '/components/navbar.php';

$Parametros = Utils::processarGet($_GET["json"] ?? []);
?>
<div class="container-fluid">
    <div class="row h-75">
        <div class="col-2">
            <div class="p-3 bg-light rounded">
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="nome" minlength="3" placeholder="Busque pelo nome..." value="<?= $Parametros->nome; ?>">
                </div>
                <a href="/" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom"></a>
                <ul class="list-group mb-3">
                    Tipo
                    <input type="hidden" id="tipo" value="<?= $Parametros->tipo; ?>">
                    <li class="list-unstyled">
                        <input class="form-check-input" type="checkbox" value="escolas" id="checkbox_escolas">
                        <label class="form-check-label" for="checkbox_escolas">Escolas</label><br>

                        <input class="form-check-input" type="checkbox" value="faculdades" id="checkbox_faculdades">
                        <label class="form-check-label" for="checkbox_faculdades">Faculdades</label><br>

                        <input class="form-check-input" type="checkbox" value="idiomas" id="checkbox_idiomas">
                        <label class="form-check-label" for="checkbox_idiomas">Idiomas</label><br>

                        <input class="form-check-input" type="checkbox" value="profissionalizantes" id="checkbox_profissionalizantes">
                        <label class="form-check-label" for="checkbox_profissionalizantes">Profissionalizantes</label><br>

                        <input class="form-check-input" type="checkbox" value="outros" id="checkbox_outros">
                        <label class="form-check-label" for="checkbox_outros">Outros</label>
                    </li>
                </ul>

                <ul class="list-group mb-3">
                    Modalidade
                    <li class="list-unstyled">
                        <input class="form-check-input" type="checkbox" value="" id="checkbox_modalidade_presencial">
                        <label class="form-check-label" for="checkbox_modalidade_presencial">Presencial</label>
                    </li>
                    <li class="list-unstyled">
                        <input class="form-check-input" type="checkbox" value="" id="checkbox_modalidade_remoto">
                        <label class="form-check-label" for="checkbox_modalidade_remoto">Remoto (EaD)</label>
                    </li>
                </ul>

                <ul class="list-group mb-3">
                    Localização
                    <select id="localizacao" class="form-control form-select">
                        <option value="XX">-</option>
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
                </ul>
                <ul class="list-group mb-3">
                    <div class="col-sm-12">
                        Valor por mês<br>
                        0 <input type="range" class="form-check-range" id="valor" min="0" max="5000" step="100" value="500" oninput="this.nextElementSibling.value = this.value">
                        R$<output><?= $Parametros->valor; ?></output>
                    </div>
                </ul>
                <ul class="list-group mb-3">
                    <div class="form-check form-switch float-start">
                        <label class="form-check-label" for="instituicao_inclusiva">Instituição Inclusiva</label><button class="btn btn-link" type="button" data-bs-toggle="modal" data-bs-target="#modalInformativoInclusao"><img src="assets/icons/informativo.svg" width="20" height="20"></button>
                        <input class="form-check-input" type="checkbox" value="1" id="instituicao_inclusiva">
                    </div>
                </ul>

                <a href="/" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom"></a>
                <div class="col-12">
                    <div class="d-flex align-items-end flex-column align-bottom">
                        <div class="mt-auto p-2"><button class="btn btn-primary" type="submit" form="formBuscarMain">Buscar</button></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-10">
            <?php require_once './instituicoes_resultado.php'; ?>
        </div>
    </div>
</div>

<script>
    $(window).on("load", function() {
        refreshFiltro();
    });

    function refreshFiltro() {
        document.getElementById("checkbox_<?= $Parametros->tipo; ?>").checked = true;

        document.getElementById("checkbox_modalidade_presencial").checked = <?= json_encode($Parametros->modalidade_presencial); ?>;
        document.getElementById("checkbox_modalidade_remoto").checked = <?= json_encode($Parametros->modalidade_remoto); ?>;

        document.getElementById("localizacao").value = <?= json_encode($Parametros->localizacao); ?>;
        document.getElementById("valor").value = <?= json_encode($Parametros->valor); ?>;
        document.getElementById("instituicao_inclusiva").checked = <?= json_encode($Parametros->instituicao_inclusiva); ?>;
    }
</script>