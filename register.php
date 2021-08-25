<?php
session_start();

require_once 'models/database.php';
require_once 'models/usersModel.php';
require_once 'config.php';
require_once 'controllers/registerController.php';
$title = 'Inscription';
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

            <form class="form-signin" method="post" action="register.php">
                <!-- <img class="mb-4" src="" alt="" > -->
                <h1 class="h3 mb-3 fw-normal">Inscription</h1>

                <div class="form-floating">
                    <input type="text" class="form-control inputNoBottomRadius <?= !isset($formErrors['username']) ?: 'is-invalid' ?>" id="username" name="username" placeholder="Ex: Dracofeu" value="<?= @$_POST['username'] ?>" />
                    <label for="username">Nom d'utilisateur</label>
                    <small class="invalid-feedback"><?= @$formErrors['username'] ?></small>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control inputNoTopRadius <?= !isset($formErrors['email']) ?: 'is-invalid' ?>" id="email" name="email" placeholder="moi@exemple.fr" value="<?= @$_POST['email'] ?>" />
                    <label for="email">Adresse mail</label>
                    <small class="invalid-feedback"><?= @$formErrors['email'] ?></small>
                </div>

                <div class="form-floating mb-3">
                    <input type="date" class="form-control <?= !isset($formErrors['birthdate']) ?: 'is-invalid' ?>" id="birthdate" name="birthdate" value="<?= @$_POST['birthdate'] ?>" />
                    <label for="birthdate">Date de naissance</label>
                    <small class="invalid-feedback"><?= @$formErrors['birthdate'] ?></small>
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