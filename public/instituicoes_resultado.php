<?php
$InstituicaoController = new AbstractController("InstituicaoController");

$Filter = (array) $Parametros ?? [];

$Instituicoes = json_decode($InstituicaoController->getAllWithFilter($Filter));

if (isset($Instituicoes->Sucesso) && $Instituicoes->Sucesso) {
    if (isset($Instituicoes->Resposta) && is_array($Instituicoes->Resposta) && count($Instituicoes->Resposta) > 0) {
?>
        <div class="row row-cols-1 row-cols-md-5 g-4 mt-3 mb-5">
                <?php
                foreach ($Instituicoes->Resposta as $InstituicaoDestaque) {
                    if(isset($InstituicaoDestaque->informacoes) && is_string($InstituicaoDestaque->informacoes))
                        $Descricao = json_decode($InstituicaoDestaque->informacoes)->descricao ?? 'Descrição não encontrada ):';

                    $Modificado = 'Instituição ainda não modificada.';
                    if($InstituicaoDestaque->data_modificado){
                        $DateTime = new DateTime("now", new DateTimeZone(Utils::getTimezone())); 
                        $DateTime->setTimestamp($InstituicaoDestaque->data_modificado);
                        $Modificado = 'Modificado em <br>' . $DateTime->format('d/m/Y H:i:s');
                    }   
                ?>
                <div class="col">
                    <div class="card h-100 ms-4" style="width: 16rem;">
                        <img src="./assets/imgs/inst-informacao[img]" class="card-img-top" alt="Imagem não encontrada" onerror="this.onerror=null;this.src='./assets/imgs/default.jpg'" />
                        <div class="card-body">
                            <h5 class="card-title"><?= $InstituicaoDestaque->nome ?? 'Desconhecido'; ?></h5>
                            <?php if(isset($Descricao)){ ?>
                                <p class="card-text text-truncate"><?= $Descricao; ?></p>
                            <?php } ?>
                            <a class="btn btn-primary" onclick="window.location.href = './ver_instituicao.php?id=' + <?= $InstituicaoDestaque->idinstituicao ?>">ver +</a>
                            <div class="d-flex align-items-end flex-column align-bottom">
                            <i class="bi <?= (in_array($IDUserGlobal, $InstituicaoDestaque->curtidas) ? 'bi-heart-fill' : 'bi-heart'); ?>" 
                                    style="cursor: pointer;" 
                                    onclick="<?= (isset($IDUserGlobal) ? "like(" . $IDUserGlobal . ", " . $InstituicaoDestaque->idinstituicao . ");" : "notAllowed(document, " . $InstituicaoDestaque->idinstituicao . ");"); ?>" 
                                    id="like_id-<?= $InstituicaoDestaque->idinstituicao; ?>"><?= count($InstituicaoDestaque->curtidas) ?? '0'; ?>
                                </i>
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
                    Nenhuma instituição encontrada a partir dos filtros selecionados ):
                </p>
            </div>

            <div class="col-2">

            </div>
        </div>
<?php
    }
} else {
    echo "Whoops! Algo deu errado...";
}
