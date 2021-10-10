<?php
session_start();

require_once 'models/database.php';
require_once 'models/usersModel.php';
require_once 'config.php';
require_once 'controllers/registerController.php';
$title = 'Inscription';
require_once 'includes/header.php';
?>
<div class="container pageHeight">
    <div class="row pageHeight">
        <?php if (isset($formErrors['db'])) { ?>
            <div class="alert alert-danger mt-5" role="alert">
                <p class="text-center"><?= $formErrors['db'] ?></p>
            </div>
        <?php } else { ?>
            <?php if (isset($success)) { ?>
                <div class="alert alert-success mt-5" role="alert">
                    <p class="text-center"><?= $success ?></p>
                </div>
            <?php } ?>
        <?php } ?>
        <div class="col-12 text-center pageHeight d-flex align-items-center">
            <form class="form-signin" method="post" action="register.php">
                <h1 class="h3 mb-4 fw-normal">Inscription</h1>

                <div class="form-floating">
                    <input type="text" class="form-control inputNoBottomRadius <?= !isset($formErrors['username']) ?: 'is-invalid' ?>" id="username" name="username" placeholder="Ex: Dracofeu" value="<?= @$_POST['username'] ?>" />
                    <label for="username">Nom d'utilisateur</label>
                    <small class="invalid-feedback"><?= @$formErrors['username'] ?></small>
                </div>
                <div class="form-floating mb-3">
                    <input type="mail" class="form-control inputNoTopRadius <?= !isset($formErrors['mail']) ?: 'is-invalid' ?>" id="mail" name="mail" placeholder="moi@exemple.fr" value="<?= @$_POST['mail'] ?>" />
                    <label for="mail">Adresse mail</label>
                    <small class="invalid-feedback"><?= @$formErrors['mail'] ?></small>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control inputNoBottomRadius <?= !isset($formErrors['password']) ?: 'is-invalid' ?>" id="password" name="password" placeholder="Password" value="<?= @$_POST['password'] ?>" />
                    <label for="password">Mot de passe</label>
                    <small class="invalid-feedback"><?= @$formErrors['password'] ?></small>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control inputNoTopRadius <?= !isset($formErrors['confirmPassword']) ?: 'is-invalid' ?>" id="confirmPassword" name="confirmPassword" placeholder="Confirmer mot de passe" value="<?= @$_POST['confirmPassword'] ?>" />
                    <label for="confirmPassword">Confirmer mot de passe</label>
                    <small class="invalid-feedback"><?= @$formErrors['confirmPassword'] ?></small>
                </div>

                <button class="w-100 btn btn-lg btn-primary" type="submit">S'inscrire</button>
                <p class="mt-5 mb-3 text-muted">&copy; 2021 SeriesTrackr</p>
            </form>
        </div>
    </div>
</div>
<?php
require_once 'includes/footer.php';
?>