<?php
session_start();

require_once 'models/database.php';
require_once 'models/usersModel.php';
require_once 'config.php';
require_once 'controllers/loginController.php';
$title = 'Connexion';
require_once 'includes/header.php';
?>

<div class="container pageHeight">
    <div class="row pageHeight">
        <div class="col-12 text-center pageHeight d-flex align-items-center">
            <?php if (isset($formErrors['db'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $formErrors['db'] ?>
                </div>
            <?php } else { ?>
                <?php if (isset($success)) { ?>
                    <div class="alert alert-success" role="alert">
                        <?= $success ?>
                    </div>
                <?php } ?>
            <?php } ?>

            <form class="form-signin" method="post" action="#">
                <!-- <img class="mb-4" src="" alt="" > -->
                <h1 class="h3 mb-5 fw-normal">Connectez-vous !</h1>
                <div class="form-floating">
                    <input type="text" class="form-control inputNoBottomRadius <?= !isset($formErrors['username']) ?: 'is-invalid' ?>" id="username" name="username" placeholder="Ex: dracofeu" value="<?= @$_POST['username'] ?>" />
                    <label for="username">Nom d'utilisateur</label>
                    <small class="invalid-feedback"><?= @$formErrors['username'] ?></small>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control inputNoTopRadius <?= !isset($formErrors['password']) ?: 'is-invalid' ?>" id="password" name="password" placeholder="********" value="<?= @$_POST['password'] ?>" />
                    <label for="password">Mot de passe</label>
                    <small class="invalid-feedback"><?= @$formErrors['password'] ?></small>
                </div>
                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Se souvenir de moi
                    </label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Se connecter</button>
                <p class="mt-5 mb-3 text-muted">&copy; 2021 SeriesTrackr</p>
            </form>
        </div>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>