<?php
require_once __DIR__ . '/config/head.php';
require_once __DIR__ . '/config/config.php';

require_once __DIR__ . '/components/load.php';
require_once __DIR__ . '/components/navbar.php';

?>

<div class="container">
    <div class="card text-center">
        <form id="formBuscarMain" novalidate method="GET" action="instituicoes_filtro.php">
            <div class="card-header">
                <nav>
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        <img src="assets/imgs/faculdade.jpg" class="card-img-top mb-3" alt="..." height="240">

                        <li class="nav-item">
                            <a class="nav-link active" href="#" id="nav-escola-tab" data-bs-toggle="tab" data-bs-target="#nav-escola" type="button" role="tab" aria-controls="nav-escola" aria-selected="true" onclick="mudarTipo('escola');">Escolas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="nav-faculdade-tab" data-bs-toggle="tab" data-bs-target="#nav-faculdade" type="button" role="tab" aria-controls="nav-faculdade" aria-selected="true" onclick="mudarTipo('faculdade');">Faculdades</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="nav-idioma-tab" data-bs-toggle="tab" data-bs-target="#nav-idioma" type="button" role="tab" aria-controls="nav-idiomas" aria-selected="true" onclick="mudarTipo('idioma');">Idiomas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="nav-profissionalizante-tab" data-bs-toggle="tab" data-bs-target="#nav-profissionalizante" type="button" role="tab" aria-controls="nav-profissionalizante" aria-selected="true" onclick="mudarTipo('profissionalizante');">Profissionalizantes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="nav-outros-tab" data-bs-toggle="tab" data-bs-target="#nav-outros" type="button" role="tab" aria-controls="nav-outros" aria-selected="true" onclick="mudarTipo('outros');">Outros</a>
                        </li>
                    </ul>
                </nav>

                <div class="tab-content" id="nav-tabContent">
                    <input type="hidden" id="tipo_instituicao" value="escola">
                    <div class="tab-pane fade show active" id="nav-escola" role="tabpanel" aria-labelledby="nav-escola-tab" tabindex="0">
                    </div>
                    <div class="tab-pane fade" id="nav-faculdade" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                    </div>
                    <div class="tab-pane fade" id="nav-idioma" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
                    </div>
                    <div class="tab-pane fade" id="nav-profissionalizante" role="tabpanel" aria-labelledby="nav-profissionalizante-tab" tabindex="0">
                    </div>
                    <div class="tab-pane fade" id="nav-outros" role="tabpanel" aria-labelledby="nav-outros-tab" tabindex="0">
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <label for="nome" class="form-label float-start">Nome</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nome" minlength="3">
                        </div>
                    </div>
                    <div class="col-2">
                        <label for="localizacao" class="form-label float-start">Localização</label>
                        <div class="col-sm-10">
                            <select id="localizacao" class="form-control form-select" minlength="2">
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
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="valor" class="form-label">Valor</label>
                        <input type="range" class="form-range" id="valor" min="0" max="5000" step="100" value="500" oninput="this.nextElementSibling.value = this.value">Até R$<output>500</output>,00 /mês
                    </div>
                    <div class="col-2 ms-5">
                        <div class="form-check form-switch float-start">
                            <input class="form-check-input" type="checkbox" value="1" id="modalidade_presencial" checked>
                            <label class="form-check-label" for="modalidade_presencial">Presencial</label>
                        </div><br>
                        <div class="form-check form-switch float-start">
                            <input class="form-check-input" type="checkbox" value="1" id="modalidade_remoto">
                            <label class="form-check-label" for="modalidade_remoto">Remoto (EaD)</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-end flex-column align-bottom">
                            <div class="mt-auto p-2"><button class="btn btn-primary" type="submit" form="formBuscarMain">Buscar</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        //no evento do form submit
        document.getElementById('formBuscarMain').addEventListener('submit', enviaGetFormBuscarMain);

        function enviaGetFormBuscarMain() {
            var pagina = $('#formBuscarMain').attr('action');
            showToast("toastOperacaoConcluida");
            event.preventDefault();

            var Data = {
                "tipo": document.getElementById("tipo_instituicao").value,
                "nome": this.nome.value,
                "localizacao": this.localizacao.value,
                "valor": this.valor.value,
                "modalidade_presencial": $('#modalidade_presencial').is(":checked"),
                "modalidade_remoto": $('#modalidade_remoto').is(":checked"),
            };

            var URL = encodeURIComponent(JSON.stringify(Data));

            setTimeout(function() {
                window.location.href = "./public/" + pagina + "?json=" + URL;
            }, 500);
        }

        function mudarTipo(tipo) {
            document.getElementById("tipo_instituicao").value = tipo;
        }
    </script>
    <?php
    require_once __DIR__ . "/instituicoes_destaque.php";
    ?>
</div>