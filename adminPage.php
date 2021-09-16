<?php
session_start();

$title = 'Control pannel';
require_once 'includes/header.php';
?>
<div class="container">
    <div class="row mt-5">
        <div class="col-12 text-center mt-5">
            <h1>Bienvenue, cher <span class="fw-bold text-uppercase">administrateur</span> !</h1>
            <p>Voici votre interface administrateur qui vous permet de gérer les fonctionnalités du site</p>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-6 text-center d-flex justify-content-center">
            <div class="card w-50 d-flex justify-content-center">
                <div class="card-body">
                    <h5 class="card-title">Séries</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a class="link-secondary" href="seriesList.php">Liste des séries</a></li>
                        <li class="list-group-item"><a class="link-secondary" href="addSeries.php">Ajouter une série</a></li>
                        <li class="list-group-item"><a class="link-secondary" href="seriesSelect.php">Selectionner série</a></li>
                        <li class="list-group-item"><a class="link-secondary" href="seriesSelect.php">Ajouter un acteur</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-center d-flex justify-content-center mt-4 mt-md-0">
            <div class="card w-50 d-flex justify-content-center">
                <div class="card-body">
                    <h5 class="card-title">Utilisateurs</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a class="link-secondary" href="seriesList.php">Liste des utilisateurs</a></li>
                        <li class="list-group-item"><a class="link-secondary" href="addSeries.php">Ajouter un utilisateur</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-6 text-center d-flex justify-content-center mt-4 mt-md-0">
            <div class="card w-50 d-flex justify-content-center">
                <div class="card-body">
                    <h5 class="card-title">Articles</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a class="link-secondary" href="articlesList.php">Liste des articles</a></li>
                        <li class="list-group-item"><a class="link-secondary" href="addArticle.php">Ajouter un article</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>