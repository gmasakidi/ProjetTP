<?php
session_start();

require_once 'models/database.php';
require_once 'models/usersModel.php';
require_once 'controllers/userProfileController.php';
$title = 'Profil';
require_once 'includes/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-2 p-0">
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-light ms-0 profileSidebar">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <svg class="bi me-2" width="40" height="32">
                        <use xlink:href="#bootstrap" />
                    </svg>
                    <span class="fs-4">Mon compte</span>
                </a>
                <hr>
                <div class="d-flex align-items-start d-flex justify-content-center">
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="bi bi-speedometer2 me-2"></i>Tableau de bord</button>
                        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="bi bi-person-lines-fill me-2"></i>Profil</button>
                        <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="bi bi-shield-check me-2"></i>Sécurité</button>
                        <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="bi bi-gear me-2"></i>Paramètres</button>
                    </div>
                </div>
                <hr>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle fs-2 me-2"></i>
                        <strong>mdo</strong>
                    </a>
                    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Se déconnecter</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-10 d-flex justify-content-center">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active mt-5" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <h1 class="fs-3">Bienvenue, <span class=" fw-bolder"><?= $usersProfile->username; ?></span> !</h1>
                    <p>Voici ton espace personnel. Sur cet espace, tu peux gérer ton compte de la manière dont tu le souhaites :</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Avoir accès à toutes les informations liées à mon compte</li>
                        <li class="list-group-item">Modifier mon adresse mail</li>
                        <li class="list-group-item">Modifier mon mot de passe</li>
                        <li class="list-group-item">Modifier mon photo de profil</li>
                        <li class="list-group-item text-danger">Supprimer mon compte</li>
                    </ul>
                </div>
                <div class="tab-pane fade mt-5" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <h2 class="fs-3">Mes informations</h2>
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item"><span class="fw-bold">Nom d'utilisateur :</span> <?= $usersProfile->username; ?></li>
                        <li class="list-group-item"><span class="fw-bold">Adresse mail :</span> <?= $usersProfile->mail; ?></li>
                        <li class="list-group-item"><span class="fw-bold">Date de naissance :</span> <?= $usersProfile->birthdate ?></li>
                    </ul>
                </div>
                <div class="tab-pane fade mt-5" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">J'AI TOUT OUBLIE</div>
                <div class="tab-pane fade mt-5" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">QUAND TU M'AS OUBLIE</div>
            </div>
        </div>
    </div>
</div>

<?php

require_once 'includes/footer.php';

?>