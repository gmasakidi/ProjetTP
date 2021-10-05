<?php
session_start();

require_once 'models/database.php';
require_once 'models/usersModel.php';
require_once 'config.php';
require_once 'controllers/userProfileController.php';
$title = 'Profil';
require_once 'includes/header.php';
?>

<div class="container-fluid userPage">
    <div class="row userPage">
        <div class="col-2 p-0 mt-5 userPage">
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
        <div class="col-10 d-flex justify-content-center mt-5">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active mt-5" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <h1 class="fs-3">Bienvenue, <span class="fw-bolder"><?= $usersProfile->username; ?></span> !</h1>
                    <p>Voici ton espace personnel. Sur cet espace, tu peux gérer ton compte de la manière dont tu le souhaites :</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Avoir accès à toutes les informations liées à mon compte</li>
                        <li class="list-group-item">Modifier mon adresse mail</li>
                        <li class="list-group-item">Modifier mon mot de passe</li>
                        <li class="list-group-item">Modifier ma photo de profil</li>
                        <li class="list-group-item text-danger">Supprimer mon compte</li>
                    </ul>
                </div>
                <div class="tab-pane fade mt-5" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <h2 class="fs-3">Mes informations</h2>
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item"><span class="fw-bold">Nom d'utilisateur :</span> <?= $usersProfile->username; ?></li>
                        <li class="list-group-item"><span class="fw-bold">Adresse mail :</span><span id="userMail"> <?= $usersProfile->mail; ?></span></li>
                    </ul>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Modifier
                    </button>
                    <!-- Modale pour modifier le profil -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Modifier mes informations</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-signin" action="userProfile.php" method="post">
                                        <div class="form-floating">
                                            <input type="text" class="form-control inputNoBottomRadius" id="username" name="username" placeholder="Ex: Dracofeu" value="<?= $usersProfile->username ?>" disabled />
                                            <label for="username">Nom d'utilisateur</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="mail" class="form-control inputNoTopRadius <?= !isset($formErrors['mail']) ?: 'is-invalid' ?>" id="mail" name="mail" placeholder="moi@exemple.fr" value="<?= @$_POST['mail'] ?>" />
                                            <label for="mail">Adresse mail</label>
                                            <small class="invalid-feedback" id="mailError"><?= @$formErrors['mail'] ?></small>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <button type="button" id="confirm" class="btn btn-danger">Confirmer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fin de la modale  -->
                </div>
                <div class="tab-pane fade mt-5" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    <h2 class="fs-3">Sécurité</h2>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                        Changer de mot de passe
                    </button>
                    <!-- Modale pour modifier le mot de passe -->
                    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Changer le mot de passe</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-signin" action="userProfile.php" method="post">
                                        <div class="form-floating">
                                            <input type="password" class="form-control inputNoBottomRadius <?= !isset($formErrors['password']) ?: 'is-invalid' ?>" id="password" name="password" placeholder="Password" value="<?= @$_POST['password'] ?>" />
                                            <label for="password">Mot de passe</label>
                                            <small class="invalid-feedback" id="passwordError"><?= @$formErrors['password'] ?></small>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control inputNoTopRadius <?= !isset($formErrors['confirmPassword']) ?: 'is-invalid' ?>" id="confirmPassword" name="confirmPassword" placeholder="Confirmer mot de passe" value="<?= @$_POST['confirmPassword'] ?>" />
                                            <label for="confirmPassword">Confirmer mot de passe</label>
                                            <small class="invalid-feedback" id="confirmPasswordError"><?= @$formErrors['confirmPassword'] ?></small>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <button type="button" id="confirmPasswordChange" class="btn btn-danger">Confirmer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fin de la modale  -->
                </div>
                <div class="tab-pane fade mt-5" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                    <h2 class="fs-3 mb-4">Paramètres</h2>
                    <button type="button" class="btn btn-outline-danger btn-lg" data-bs-toggle="modal" data-bs-target="#testModal" data-bs-test="<?= $_SESSION['id'] ?>">Supprimer mon compte</i></button>
                    <div class="modal fade" id="testModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Souhaitez-vous vraiment supprimer votre compte ?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="userProfile.php" method="post">
                                        <div class="mb-3">
                                            <label for="idRecipient" class="col-form-label"></label>
                                            <input type="hidden" class="form-control" name="idRecipient" id="idRecipient" />
                                            <p>Cette action supprimera définitivement votre compte et toutes les informations qu'il contient.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-danger" name="deleteUserButton" id="deleteUserButton">Confirmer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

require_once 'includes/footer.php';

?>