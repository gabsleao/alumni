<?php
require_once __DIR__ . '/config/config.php';

require_once __DIR__ . '/components/navbar.php';

?>

<div class="container">
    <div class="card text-center">
        <form onsubmit="alert('enviando form!');" method="POST">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <input type="hidden" id="tipo" value="escola">

                    <img src="assets/imgs/faculdade.jpg" class="card-img-top mb-3" alt="..." height="240">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="true" href="#">Escolas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Faculdade</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Idiomas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Profissionalizante</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Outros</a>
                    </li>
                </ul>
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