<?php
session_start();

require_once 'models/database.php';
require_once 'models/usersModel.php';
require_once 'models/rolesModel.php';
require_once 'config.php';
require_once 'controllers/updateUserRoleController.php';
$title = 'Modifier le rôle de cet utilisateur';
require_once 'includes/header.php';
?>
<div class="container">
    <div class="row mt-5">
        <div class="col-12 mt-4 text-center">
            <h1>Modifier le rôle de cet utilisateur</h1>
            <p>Actualiser les droits d'accès d'un utilisateur</p>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12 text-center">
            <h2><span class="badge bg-secondary">Nom d'utilisateur</span></h2>
            <p class="fw-bold"><?= $usersInformations->username ?></p>
            <form action="updateUserRole.php?id=<?= $_GET['id'] ?>" method="post">
                <div class="form-floating mt-3">
                    <select class="form-select form-group <?= !isset($formErrors['userRole']) ?: 'is-invalid' ?>" id="userRole" name="userRole" aria-label="Floating label select example">
                        <option selected disabled>Sélectionner un rôle</option>
                        <?php foreach($usersRoleList as $usersRoles){ ?>
                            <option value="<?= $usersRoles->id ?>"><?= $usersRoles->name ?></option>
                       <?php } ?>
                    </select>
                    <label for="userRole">Modifier le rôle de cet utilisateur</label>
                    <small class="invalid-feedback"><?= @$formErrors['userRole'] ?></small>
                </div>
                <button type="submit" id="selectUserRoleButton" name="selectUserRoleButton" class="btn btn-outline-success btn-lg mt-3">Enregistrer</button>
            </form>

        </div>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>