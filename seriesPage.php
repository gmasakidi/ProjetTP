<?php
session_start();

require_once 'models/database.php';
require_once 'models/seriesModel.php';
require_once 'controllers/seriesPageController.php';
$title = 'Séries';
require_once 'includes/header.php';
?>
<div class="container">
    <div class="row mt-5">
        <div class="col-12 mt-4">
            <h1 class="text-center">Rechercher une série</h1>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12 d-flex justify-content-center mt-5">
            <form class="col-8 mt-5" action="seriesPage.php" method="post">
                <div class="input-group input-group-lg">
                    <span class="input-group-text" id="inputGroup-sizing-lg"><i class="bi bi-lightning"></i></span>
                    <input type="text" class="form-control" name="search" id="search" placeholder="Ex : Vikings" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" />
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Trouver</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
require_once 'includes/footer.php';
?>