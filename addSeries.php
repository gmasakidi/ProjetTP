<?php
session_start();

$title = 'Ajouter une série';
require_once 'includes/header.php';
?>
<div class="container">
    <div class="row mt-5">
        <div class="col-12 mt-5">
            <h1 class="text-center">Ajouter une série</h1>
        </div>
        <div class="col-12 mt-4 d-flex justify-content-center">
            <form method="POST" action="addPatient.php" enctype="multipart/form-data" class="w-50 mb-5">
                <div class="mb-3">
                    <label for="title" class="form-label">Titre de la série</label>
                    <input type="text" placeholder="Ex: Narcos" name="title" class="form-control <?= !empty($formErrors['title']) ? 'is-invalid' : ''; ?>" id="title" value="<?= @$_POST['title']; ?>" />
                    <small class="invalid-feedback"><?= @$formErrors['title']; ?></small>
                </div>
                <div class="mb-3">
                    <label for="synopsis" class="form-label">Synopsis</label>
                    <textarea name="synopsis" class="form-control <?= !empty($formErrors['synopsis']) ? 'is-invalid' : ''; ?>" id="synopsis" value="<?= @$_POST['synopsis']; ?>" rows="5" cols="33">Description de la série...</textarea>
                    <small class="invalid-feedback"><?= @$formErrors['synopsis']; ?></small>
                </div>
                <div class="mb-3">
                    <label for="creator" class="form-label">Créateur(s)</label>
                    <input type="text" name="creator" class="form-control <?= !empty($formErrors['creator']) ? 'is-invalid' : ''; ?>" id="creator" value="<?= @$_POST['creator']; ?>" />
                    <small class="invalid-feedback"><?= @$formErrors['creator']; ?></small>
                </div>
                <div class="mb-3">
                    <label for="actors" class="form-label">Acteurs</label>
                    <input type="text" name="actors" class="form-control <?= !empty($formErrors['actors']) ? 'is-invalid' : ''; ?>" id="actors" value="<?= @$_POST['actors']; ?>" />
                    <small class="invalid-feedback"><?= @$formErrors['actors']; ?></small>
                </div>
                <div class="mb-3">
                    <div class="form-group <?= !isset($formErrors['year']) ?: 'has-danger' ?>">
                        <label for="year" class="form-label">Année de publication </label>
                        <select class="form-select <?= !isset($formErrors['year']) ?: 'is-invalid' ?>" id="year" name="year">
                            <option selected disabled>Choisir une année</option>
                            <?php for ($i = 2021; $i >= 1900; $i--) {
                            ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php } ?>
                        </select>
                        <small class="invalid-feedback"><?= @$formErrors['year'] ?></small>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="input-group mb-3 <?= !isset($formErrors['photo']) ?: 'has-danger' ?>">
                        <label for="photo" class="input-group-text">Photo série</label>
                        <input type="file" name="photo" class="form-control <?= !empty($formErrors['photo']) ? 'is-invalid' : ''; ?>" id="photo">
                        <small class="invalid-feedback"><?= @$formErrors['actors']; ?></small>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" value="Envoyer" />
            </form>
        </div>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>