<?php
session_start();

require_once 'models/database.php';
require_once 'models/usersModel.php';
require_once 'config.php';
require_once 'controllers/loginController.php';
$title = 'Connexion';
require_once 'includes/header.php';
?>

<div class="container">
    <div class="row">
        <div class="col-12 text-center">
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
                <h1 class="h3 mb-3 fw-normal">Connectez-vous !</h1>

                <div class="form-floating">
                    <input type="text" class="form-control inputNoBottomRadius <?= !isset($formErrors['username']) ?: 'is-invalid' ?>" id="username" name="username" placeholder="Ex: dracofeu" value="<?= @$_POST['username'] ?>" />
                    <label for="username">Nom d'utilisateur</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control inputNoTopRadius <?= !isset($formErrors['login']) ?: 'is-invalid' ?>" id="password" name="password" placeholder="********" value="<?= @$_POST['password'] ?>" />
                    <label for="password">Mot de passe</label>
                </div>
                <small class="invalid-feedback"><?= @$formErrors['username'] ?></small>
                <small class="invalid-feedback"><?= @$formErrors['password'] ?></small>

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