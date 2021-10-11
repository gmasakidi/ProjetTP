<?php
session_start();

$title = 'Liste des articles';
require_once 'includes/header.php';
require_once 'models/database.php';
require_once 'models/articlesModel.php';
require_once 'controllers/articlesListController.php';
?>
<div class="container">
    <div class="row mt-5">
        <div class="col-12 mt-4 text-center">
            <h1>Liste des articles</h1>
            <p>Un pannel de contrôle pour tout vos articles</p>
        </div>
    </div>
    <div class="row text-center mt-4">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-secondary table-sm table-hover table-bordered table-striped align-middle">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Titre</th>
                            <th scope="col">Date</th>
                            <th scope="col">Contenu</th>
                            <th scope="col">Catégorie</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Voir</th>
                            <th scope="col">Modifier</th>
                            <th scope="col">Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($articlesList as $articlesDetails) {
                        ?>
                            <tr>
                                <td><?= $articlesDetails->id ?></td>
                                <td><?= $articlesDetails->title ?></td>
                                <td><?= $articlesDetails->date ?></td>
                                <td><?= $articlesDetails->content ?></td>
                                <td><?= $articlesDetails->category ?></td>
                                <td><?= $articlesDetails->photo ?></td>
                                <td><a href="articleDetails.php?id=<?= $articlesDetails->id ?>"><button type="button" class="btn btn-primary"><i class="bi bi-eye"></i></button></a></td>
                                <td><a href="updateArticle.php?id=<?= $articlesDetails->id ?>"><button type="button" class="btn btn-warning"><i class="bi bi-gear"></i></button></a></td>
                                <td><button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteArticleModal" data-bs-id="<?= $articlesDetails->id ?>" data-bs-title="<?= $articlesDetails->title ?>"><i class="fas fa-trash"></i></button> <!-- tu peux passer des données à ta modal avec les data-bs-truc -->
                                </td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="modal fade" id="deleteArticleModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Souhaitez-vous vraiment supprimer cet article ?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <form method="post" action="articlesList.php">
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label"></label>
                                    <p id="article"></p>
                                    <input type="hidden" class="form-control" name="idRecipient" id="idRecipient" />
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-danger">Confirmer</button>
                                </div>
                            </form>
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