<?php
session_start();

require_once 'models/database.php';
require_once 'models/seriesModel.php';
require_once 'models/statusModel.php';
require_once 'models/seriesGenresModel.php';
require_once 'models/actorsModel.php';
require_once 'models/seriesHaveGenresModel.php';
require_once 'models/seriesHaveActorsModel.php';
require_once 'config.php';
require_once 'controllers/updateSeriesController.php';
$title = 'Modifier la série';
require_once 'includes/header.php';
?>
<div class="container">
    <?php if (isset($formErrors['db'])) { ?>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 d-flex justify-content-center alert alert-danger" role="alert">
                <p class="text-center"><?= $formErrors['db'] ?></p>
            </div>
        </div>
    <?php } else { ?>
        <?php if (isset($success)) { ?>
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 d-flex justify-content-center alert alert-success" role="alert">
                    <p class="text-center"><?= $success ?></p>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
    <div class="row mt-5">
        <div class="col-12 mt-4">
            <h1 class="text-center">Modifier la série</h1>
        </div>
        <div class="col-12 mt-4 d-flex justify-content-center">
            <form method="POST" action="updateSeries.php?id=<?= $_GET['id'] ?>" enctype="multipart/form-data" class="w-50 mb-5">
                <div class="mb-3">
                    <label for="title" class="form-label">Titre de la série</label>
                    <input type="text" placeholder="Ex: Narcos" name="title" class="form-control <?= !empty($formErrors['title']) ? 'is-invalid' : ''; ?>" id="title" value="<?= $seriesDetails->title; ?>" />
                    <small class="invalid-feedback"><?= @$formErrors['title']; ?></small>
                </div>
                <div class="mb-3">
                    <label for="synopsis" class="form-label">Synopsis</label>
                    <textarea name="synopsis" class="form-control <?= !empty($formErrors['synopsis']) ? 'is-invalid' : ''; ?>" id="synopsis" rows="5" cols="33"><?= $seriesDetails->synopsis; ?></textarea>
                    <small class="invalid-feedback"><?= @$formErrors['synopsis']; ?></small>
                </div>
                <div class="mb-3">
                    <label for="creators" class="form-label">Créateur(s)</label>
                    <input type="text" name="creators" class="form-control <?= !empty($formErrors['creators']) ? 'is-invalid' : ''; ?>" id="creators" value="<?= $seriesDetails->creators; ?>" />
                    <small class="invalid-feedback"><?= @$formErrors['creators']; ?></small>
                </div>
                <div class="mb-3">
                    <div class="form-group <?= !isset($formErrors['year']) ?: 'has-danger' ?>">
                        <label for="year" class="form-label">Année de publication </label>
                        <select class="form-select <?= !isset($formErrors['year']) ?: 'is-invalid' ?>" id="year" name="year">
                            <option selected disabled>Choisir une année</option>
                            <?php for ($i = 2021; $i >= 1960; $i--) {
                            ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php } ?>
                        </select>
                        <small class="invalid-feedback"><?= @$formErrors['year'] ?></small>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="input-group mb-3 <?= !isset($formErrors['poster']) ?: 'has-danger' ?>">
                        <label for="poster" class="input-group-text">Photo série</label>
                        <input type="file" name="poster" class="form-control <?= !empty($formErrors['poster']) ? 'is-invalid' : ''; ?>" id="poster">
                        <small class="invalid-feedback"><?= @$formErrors['poster']; ?></small>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="form-group <?= !isset($formErrors['seriesStatus']) ?: 'has-danger' ?>">
                        <label for="seriesStatus" class="form-label">Statut de la série</label>
                        <select class="form-select <?= !isset($formErrors['seriesStatus']) ?: 'is-invalid' ?>" id="seriesStatus" name="seriesStatus">
                            <option selected disabled>Sélectionner le statut de la série</option>
                            <?php foreach ($statusList as $status) { ?>
                                <option value="<?= $status->id ?>"><?= $status->status ?></option>
                            <?php } ?>
                        </select>
                        <small class="invalid-feedback"><?= @$formErrors['seriesStatus'] ?></small>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" name="seriesButton" value="Envoyer" />
            </form>
        </div>
        <div class="col-12 mt-4 d-flex justify-content-center">
            <form action="updateSeries.php?id=<?= $_GET['id'] ?>" method="post" class="w-50 mb-5">
                <div class="mb-3">
                    <div class="form-group <?= !isset($formErrors['seriesGenres']) ?: 'has-danger' ?>">
                        <div class="row">
                            <p class="fw-bold">Choisir les genres</p>
                            <?php foreach ($seriesGenresList as $seriesGenres) { ?>
                                <div class="col-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="<?= $seriesGenres->name ?>" name="seriesGenres[]" value="<?= $seriesGenres->id ?>">
                                        <label class="form-check-label" for="<?= $seriesGenres->name ?>"><?= $seriesGenres->name ?></label>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <small class="invalid-feedback"><?= @$formErrors['seriesGenres'] ?></small>
                    </div>
                </div>
                <input type="submit" name="seriesGenresButton" class="btn btn-primary" value="Envoyer" />
            </form>
        </div>
        <div class="col-12 mt-4 d-flex justify-content-center">
            <form action="updateSeries.php?id=<?= $_GET['id'] ?>" method="post" class="w-50 mb-5">
                <div class="mb-3">
                    <div class="form-group <?= !isset($formErrors['actors']) ?: 'has-danger' ?>">
                        <div class="row">
                            <p class="fw-bold">Sélectionner les acteurs</p>
                            <?php foreach ($actorsList as $actors) { ?>
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="<?= $actors->name ?>" name="actors[]" value="<?= $actors->id ?>">
                                        <label class="form-check-label" for="<?= $actors->name ?>"><?= $actors->name ?></label>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <small class="invalid-feedback"><?= @$formErrors['actors'] ?></small>
                    </div>
                </div>
                <input type="submit" name="seriesActorsButton" class="btn btn-primary" value="Envoyer" />
            </form>
        </div>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>