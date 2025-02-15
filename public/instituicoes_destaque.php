<?php
$InstituicaoController = new AbstractController("InstituicaoController");
$getInstituicoesDestaqueRequest = json_decode($InstituicaoController->getAll());

if (isset($getInstituicoesDestaqueRequest->Sucesso) && $getInstituicoesDestaqueRequest->Sucesso) {
    if (isset($getInstituicoesDestaqueRequest->Resposta) && is_array($getInstituicoesDestaqueRequest->Resposta) && count($getInstituicoesDestaqueRequest->Resposta) > 0) {
?>
        <div class="row row-cols-1 row-cols-md-3 g-4 mt-3 mb-5">
                <?php
                foreach ($getInstituicoesDestaqueRequest->Resposta as $InstituicaoDestaque) {
                    if(isset($InstituicaoDestaque->informacoes) && is_string($InstituicaoDestaque->informacoes))
                        $Descricao = json_decode($InstituicaoDestaque->informacoes)->descricao ?? 'Descrição não encontrada ):';

                    $Modificado = 'Instituição ainda não modificada.';
                    if($InstituicaoDestaque->data_modificado){
                        $DateTime = new DateTime("now", new DateTimeZone(Utils::getTimezone())); 
                        $DateTime->setTimestamp($InstituicaoDestaque->data_modificado);
                        $Modificado = 'Modificado em ' . $DateTime->format('d/m/Y H:i:s');
                    }                  
                ?>
                <div class="col">
                    <div class="card h-100 ms-4" style="width: 18rem;">
                        <img src="./assets/imgs/inst-informacao[img]" class="card-img-top" alt="Imagem não encontrada" onerror="this.onerror=null;this.src='./assets/imgs/default.jpg'" />
                        <div class="card-body">
                            <h5 class="card-title"><?= $InstituicaoDestaque->nome ?? 'Desconhecido'; ?></h5>
                            <?php if(isset($Descricao)){ ?>
                                <p class="card-text text-truncate"><?= $Descricao; ?></p>
                            <?php } ?>
                            <a href="#" class="btn btn-primary">ver +</a>
                            <div class="d-flex align-items-end flex-column align-bottom">
                                <i class="bi bi-heart" style="cursor: pointer;" onclick="<?php (isset($_SESSION["UsuarioLogado"]) ? "like(this);" : "notAllowed(document);"); ?>" id="like_id-<?= 1 ?>"></i>
                            </div>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted"><?= $Modificado; ?></small>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
        </div>
    <?php
    } else {
    ?>
        <div class="row mt-3 mb-5">
            <div class="col-4">

            </div>

            <div class="col-6">
                <p class="lead">
                    Nenhuma instituição em destaque recentemente...
                </p>
            </div>

            <div class="col-2">

            </div>
        </div>

        <div class="row mt-3 mb-5">
            <div class="col-4">

            </div>

            <div class="col-4 d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" onClick="verInstituicoes();">Ver todas</button>
            </div>

            <div class="col-4">

            </div>
        </div>

        <script>
            function verInstituicoes() {
                window.location.href = "./public/instituicoes_filtro.php";
            }
        </script>

<?php
    }
} else {
    echo "Whoops! Algo deu errado...";
}
