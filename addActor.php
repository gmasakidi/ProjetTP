<?php
session_start();

require_once 'models/database.php';
require_once 'models/actorsModel.php';
require_once 'config.php';
require_once 'controllers/addActorController.php';
$title = 'Ajouter un acteur';
require_once 'includes/header.php';
?>
<div class="container">
    <div class="row mt-5">
        <div class="col-12 mt-4">
            <h1 class="text-center">Ajouter un acteur</h1>
        </div>
        <div class="col-12 mt-4 d-flex justify-content-center">
            <form action="addActor.php" method="post" class="w-50 mb-5">
                <div class="mb-3">
                    <label for="actor" class="form-label">Nom de l'acteur</label>
                    <input type="text" placeholder="Denzell Washington" name="actor" class="form-control <?= !empty($formErrors['actor']) ? 'is-invalid' : ''; ?>" id="actor" value="<?= @$_POST['actor']; ?>" />
                    <small class="invalid-feedback"><?= @$formErrors['actor']; ?></small>
                </div>
                <input type="submit" class="btn btn-primary" value="Envoyer" />
            </form>
        </div>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>