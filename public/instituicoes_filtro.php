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
                <form id="formBuscarResultados" novalidate method="GET" action="instituicoes_filtro.php">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="nome" minlength="3" placeholder="Busque pelo nome..." value="<?= $Parametros->nome; ?>">
                    </div>
                    <a href="/" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom"></a>
                    <ul class="list-group mb-3">
                        Tipo
                        <li class="list-unstyled" id="lista_tipos">
                            <input class="form-check-input" type="checkbox" value="escola" id="checkbox_escola" onclick="refreshCheckbox();">
                            <label class="form-check-label" for="checkbox_escola">Escolas</label><br>

                            <input class="form-check-input" type="checkbox" value="faculdade" id="checkbox_faculdade" onclick="refreshCheckbox();">
                            <label class="form-check-label" for="checkbox_faculdade">Faculdades</label><br>

                            <input class="form-check-input" type="checkbox" value="idioma" id="checkbox_idioma" onclick="refreshCheckbox();">
                            <label class="form-check-label" for="checkbox_idioma">Idiomas</label><br>

                            <input class="form-check-input" type="checkbox" value="profissionalizante" id="checkbox_profissionalizante" onclick="refreshCheckbox();">
                            <label class="form-check-label" for="checkbox_profissionalizante">Profissionalizantes</label><br>

                            <input class="form-check-input" type="checkbox" value="outros" id="checkbox_outros" onclick="refreshCheckbox();">
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
                            <option>-</option>
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
                            Valor máximo por mês<br>
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
                            <div class="mt-auto p-2"><button class="btn btn-primary" type="submit" form="formBuscarResultados">Buscar</button></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-10">
            <?php require_once './instituicoes_resultado.php'; ?>
        </div>
    </div>
</div>

<script>

<?php
        foreach($Parametros->tipo as $Tipo){ ?>
document.getElementById("checkbox_<?= $Tipo; ?>").checked = true;
    <?php } ?>

    var checkedCheckboxes;

    $(window).on("load", function() {
        refreshFiltro();
        refreshCheckbox();
    });

    function refreshFiltro() {
        document.getElementById("checkbox_modalidade_presencial").checked = <?= json_encode($Parametros->modalidade_presencial); ?>;
        document.getElementById("checkbox_modalidade_remoto").checked = <?= json_encode($Parametros->modalidade_remoto); ?>;

        document.getElementById("localizacao").value = <?= json_encode($Parametros->localizacao); ?>;
        document.getElementById("valor").value = <?= json_encode($Parametros->valor); ?>;
        document.getElementById("instituicao_inclusiva").checked = <?= json_encode($Parametros->instituicao_inclusiva); ?>;
    }

    //no evento do form submit
    document.getElementById('formBuscarResultados').addEventListener('submit', enviaGetformBuscarResultados);

    function enviaGetformBuscarResultados() {
        var pagina = $('#formBuscarResultados').attr('action');
        showToast("toastOperacaoConcluida");
        event.preventDefault();

        var Data = {
            "tipo": checkedCheckboxes,
            "nome": this.nome.value,
            "localizacao": this.localizacao.value,
            "valor": this.valor.value,
            "modalidade_presencial": $('#checkbox_modalidade_presencial').is(":checked"),
            "modalidade_remoto": $('#checkbox_modalidade_remoto').is(":checked"),
            "instituicao_inclusiva": $('#instituicao_inclusiva').is(":checked"),
        };

        var URL = encodeURIComponent(JSON.stringify(Data));
        setTimeout(function() {
            window.location.href = "./" + pagina + "?json=" + URL;
        }, 500);
    }

    function refreshCheckbox(){
        checkedCheckboxes = $("#lista_tipos input[type='checkbox']:checked").map(function() {
            return this.value;
        }).get();
    }
</script>