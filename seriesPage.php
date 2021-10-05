<?php
session_start();

require_once 'models/database.php';
require_once 'models/seriesModel.php';
require_once 'config.php';
require_once 'controllers/seriesPageController.php';
$title = 'Séries';
require_once 'includes/header.php';
?>
<div class="container">
    <div class="row mt-5">
        <div class="col-12 mt-5">
            <h1 class="text-center">Rechercher une série</h1>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12 d-flex justify-content-center mt-5">
            <form class="col-8 mt-5" action="seriesPage.php" method="post">
                <div class="input-group input-group-lg">
                    <span class="input-group-text" id="inputGroup-sizing-lg"><i class="bi bi-lightning"></i></span>
                    <input type="text" class="form-control <?= !isset($formErrors['search']) ?: 'is-invalid' ?>" name="search" id="search" placeholder="Ex : Vikings" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" />
                    <button class="btn btn-outline-secondary" type="submit" id="seriesSearchButton">Trouver</button>
                    <small class="invalid-feedback"><?= @$formErrors['search'] ?></small>
                </div>
            </form>
            <p id="searchResultNumber" class="mt-3 d-none"><?= $seriesResult->count ?> résultats trouvés à votre recherche :</p>
        </div>
        <div class="row d-none" id="searchResultContent">
            <div class="col-12 col-sm-4 d-flex justify-content-center mt-3">
                <img src="" alt="">
            </div>
            <div class="col-12 col-sm-8 d-flex justify-content-center mt-3">
                <p></p>
            </div>
        </div>

    </div>
</div>
<?php
require_once 'includes/footer.php';
?>