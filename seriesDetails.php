<?php

require_once 'models/database.php';
require_once 'models/seriesModel.php';
require_once 'models/seriesHaveGenresModel.php';
require_once 'models/seriesHaveActorsModel.php';
require_once 'models/seasonsModel.php';
require_once 'models/seriesCommentsModel.php';
require_once 'models/progressModel.php';
require_once 'config.php';
require_once 'controllers/seriesDetailsController.php';
$title = 'Détails de la série';
require_once 'includes/header.php';
?>
<div class="container">
    <div class="row mt-5">
        <div class="col-12 mt-5 mb-5">
            <h1 class="text-center">Détails de la série</h1>
        </div>
    </div>
    <div class="row mt-6">
        <div class="col-12 col-sm-4 d-flex justify-content-center">
            <div class="card">
                <img src="<?= $seriesDetails->photo ?>" class="card-img" alt="seriesPoster" />
            </div>
        </div>
        <div class="col-12 col-sm-8">
            <h2><?= $seriesDetails->title ?></h2>
            <p><span class="fw-bold"><?= $seriesDetails->year ?></span> / <?php foreach ($genresBySeries as $genres) { ?>
                    <?= $genres->name ?>,
                <?php } ?>
            </p>
            <p><span class="fw-bold">Créée par</span> <?= $seriesDetails->creators ?></p>
            <p><span class="fw-bold">Avec</span> <?php foreach ($actorsBySeries as $actors) { ?>
                    <?= $actors->name ?>,
                <?php } ?></p>
            <h2>SYNOPSIS</h2>
            <p>
                <?= $seriesDetails->synopsis ?>
            </p>
            <form action="seriesDetails.php?id=<?= $_GET['id'] ?>" method="post">
                <div class="form-floating">
                    <select class="form-select form-group <?= !isset($formErrors['seasonSelect']) ?: 'is-invalid' ?>" id="seasonSelect" name="seasonSelect" aria-label="Floating label select example">
                        <option selected disabled>Choisir la saison</option>
                        <?php foreach($seasonsBySeries as $seasons){ ?>
                            <option value="<?= $seasons->id ?>">Saison <?= $seasons->seasonNumber ?></option>
                       <?php } ?>
                    </select>
                    <label for="seasonSelect">A quelle saison vous êtes-vous arrêtés ?</label>
                    <small class="invalid-feedback"><?= @$formErrors['seasonSelect'] ?></small>
                </div>
                <button type="submit" id="selectSeasonButton" name="selectSeasonButton" class="btn btn-outline-success btn-lg mt-3">Enregistrer</button>
            </form>
        </div>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>