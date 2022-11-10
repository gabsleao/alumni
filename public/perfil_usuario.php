<?php
require_once __DIR__ . '/config/head.php';
require_once __DIR__ . '/config/config.php';

require_once __DIR__ . '/components/load.php';
require_once __DIR__ . '/components/navbar.php';

//var_dump($_SESSION);

?>

  <div class="py-5 ms-3 me-3">
    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="<?= $UserIcon; ?>" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3"><?= $_SESSION["Session"]->Usuario->nome; ?></h5>
            <p class="text-muted mb-4"><?php echo $_SESSION["Session"]->Usuario->informacoes["cidade"] . ", " . $_SESSION["Session"]->Usuario->informacoes["estado"]; ?></p>
            <div class="d-flex justify-content-center mb-2">
              <button type="button" class="btn btn-primary">Favoritados</button>
            </div>
          </div>
        </div>
        <div class="card mb-4 mb-lg-0">
          <div class="card-body p-0">
            <ul class="list-group list-group-flush rounded-3">
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <p class="mb-0">Nome</p><?= $_SESSION["Session"]->Usuario->nome; ?>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <p class="mb-0">Email</p><?= Seguranca::decryptString($_SESSION["Session"]->Usuario->email); ?>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <p class="mb-0">Tipo</p><?= $_SESSION["Session"]->Usuario->tipo; ?>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <p class="mb-0">Cidade</p><?= $_SESSION["Session"]->Usuario->informacoes["cidade"] ?>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <p class="mb-0">Estado</p><?= $_SESSION["Session"]->Usuario->informacoes["estado"] ?>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <p class="mb-0">Senha</p><a href data-bs-toggle="modal" data-bs-target="#modalMudarSenha"><img src="assets/icons/lock_icon.svg" width="20" height="20"></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="row">
          <div class="col-md-12 mb-4">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                <p class="mb-4">Acessado recentemente</p>
                <li class="d-flex justify-content-between align-items-center">
                  <p class="mb-1">Nome da Instituição</p>Acessado em:<?= "data"; ?>
                </li>

                <li class="d-flex justify-content-between align-items-center">
                  <p class="mb-1">Nome da Instituição</p>Acessado em:<?= "data"; ?>
                </li>

                <li class="d-flex justify-content-between align-items-center">
                  <p class="mb-1">Nome da Instituição</p>Acessado em:<?= "data"; ?>
                </li>

                <li class="d-flex justify-content-between align-items-center">
                  <p class="mb-1">Nome da Instituição</p>Acessado em:<?= "data"; ?>
                </li>

                <li class="d-flex justify-content-between align-items-center">
                  <p class="mb-1">Nome da Instituição</p>Acessado em:<?= "data"; ?>
                </li>                
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                <p class="mb-4">Interesses
                </p>
                <p class="mb-1" style="font-size: .77rem;">Escolas</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Faculdades</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Idiomas</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Profissionalizantes</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Outros</p>
                <div class="progress rounded mb-2" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>