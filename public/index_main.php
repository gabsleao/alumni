<?php
require_once __DIR__ . '/config/config.php';

require_once __DIR__ . '/components/navbar.php';

?>

<div class="container">
    <div class="card text-center">
        <form onsubmit="alert(JSON.stringify(this));" method="POST">
            <input type="hidden" id="operacao" value="buscar_instituicoes_com_filtro">
            <div class="card-header">
                <nav>
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        <img src="assets/imgs/faculdade.jpg" class="card-img-top mb-3" alt="..." height="240">

                        <li class="nav-item">
                            <a class="nav-link active" href="#" id="nav-escola-tab" data-bs-toggle="tab" data-bs-target="#nav-escola" type="button" role="tab" aria-controls="nav-escola" aria-selected="true">Escolas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="nav-faculdade-tab" data-bs-toggle="tab" data-bs-target="#nav-faculdade" type="button" role="tab" aria-controls="nav-faculdade" aria-selected="true">Faculdades</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="nav-idiomas-tab" data-bs-toggle="tab" data-bs-target="#nav-idiomas" type="button" role="tab" aria-controls="nav-idiomas" aria-selected="true">Idiomas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="nav-profissionalizante-tab" data-bs-toggle="tab" data-bs-target="#nav-profissionalizante" type="button" role="tab" aria-controls="nav-profissionalizante" aria-selected="true">Profissionalizantes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="nav-outros-tab" data-bs-toggle="tab" data-bs-target="#nav-outros" type="button" role="tab" aria-controls="nav-outros" aria-selected="true">Outros</a>
                        </li>
                    </ul>
                </nav>

                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-escola" role="tabpanel" aria-labelledby="nav-escola-tab" tabindex="0">
                        <input type="hidden" id="tipo" value="escola">
                    </div>
                    <div class="tab-pane fade" id="nav-faculdade" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                        <input type="hidden" id="tipo" value="faculdade">
                    </div>
                    <div class="tab-pane fade" id="nav-idiomas" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
                        <input type="hidden" id="tipo" value="idiomas">
                    </div>
                    <div class="tab-pane fade" id="nav-profissionalizante" role="tabpanel" aria-labelledby="nav-profissionalizante-tab" tabindex="0">
                        <input type="hidden" id="tipo" value="profissionalizante">
                    </div>
                    <div class="tab-pane fade" id="nav-outros" role="tabpanel" aria-labelledby="nav-outros-tab" tabindex="0">
                        <input type="hidden" id="tipo" value="outros">
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
                        <label for="nome" class="form-label float-start">Localização</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="localizacao" minlength="2">
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
                            <div class="mt-auto p-2"><button class="btn btn-primary" type="submit">Buscar</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>