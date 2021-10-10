<?php 
session_start();

require_once 'models/database.php';
require_once 'models/usersModel.php';
require_once 'controllers/usersListController.php';
$title = 'Liste des utilisateurs';
require_once 'includes/header.php';
?>
<div class="container">
    <div class="row mt-5">
        <div class="col-12 mt-4 text-center">
            <h1>Liste des utilisateurs</h1>
            <p>Un pannel de contrôle pour tout les utilisateurs inscrits</p>
        </div>
    </div>
    <div class="row text-center mt-4">
        <div class="col-12">
            <table class="table table-secondary table-sm table-hover table-bordered table-striped align-middle">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom d'utilisateur</th>
                        <th scope="col">Mail</th>
                        <th scope="col">Role</th>
                        <th scope="col">Modifier</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usersList as $usersDetails) {
                    ?>
                        <tr>
                            <td><?= $usersDetails->id ?></td>
                            <td><?= $usersDetails->username ?></td>
                            <td><?= $usersDetails->mail ?></td>
                            <td><?= $usersDetails->role ?></td>
                            <td><a href="updateUserRole.php?id=<?= $usersDetails->id ?>"><button type="button" class="btn btn-warning"><i class="bi bi-gear"></i></button></a></td>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>