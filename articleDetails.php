<?php
session_start();

require_once 'models/database.php';
require_once 'models/articlesModel.php';
require_once 'models/articlesCommentsModel.php';
require_once 'config.php';
require_once 'controllers/articleDetailsController.php';
$title = $articleDetails->title;
require_once 'includes/header.php';
?>
<div class="container">
    <div class="row mt-5">
        <div class="col-12 mt-5 text-center">
            <h1 class=" fw-bold"><?= $articleDetails->title ?></h1>
            <small class="lead fs-6">Publié le <?= $articleDetails->datefr ?> • Par Gerard</small>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-5 d-flex justify-content-center">
            <div class="card text-white noBorderRadius d-flex justify-content-center" style="width:40rem;">
                <img src="<?= $articleDetails->photo ?>" class="card-img" alt="...">
            </div>
        </div>
        <div class="col-12 mt-5 mb-4 text-center">
            <p>
                <?= htmlspecialchars_decode($articleDetails->content) ?>
            </p>
        </div>
        <hr>
        <?php if (!empty($_SESSION['id']) && !empty($_SESSION['username'])) { ?>
            <div class="col-5 mb-5">
                <form action="articleDetails.php?id=<?= $_GET['id'] ?>" method="post" class="mb-3">
                    <div class="mb-3">
                        <label for="articleCommentContent" class="form-label" id="articleCommentContent">Laisser un commentaire :</label>
                        <textarea name="articleCommentContent" class="form-control <?= !empty($formErrors['articleCommentContent']) ? 'is-invalid' : ''; ?>" id="articleCommentContent" rows="3"></textarea>
                        <small class="invalid-feedback"><?= @$formErrors['articleCommentContent']; ?></small>
                        <small class="invalid-feedback"><?= @$formErrors['loggedOut'] ?></small>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            </div>
        <?php } else { ?>
            <div class="col-5 mb-5">
                <p><a class="link-primary" href="login.php">Connectez-vous</a> pour laisser un commentaire.</p>
            </div>
        <?php } ?>
    </div>
    <div class="row">
        <?php foreach ($commentsByArticle as $articleCommentsDetails) { ?>
            <div class="col-12">
                <div class="card mb-3" style="max-width: 30rem;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="https://www.e-xpertsolutions.com/wp-content/plugins/all-in-one-seo-pack/images/default-user-image.png" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?= $articleCommentsDetails->username ?> :</h5>
                                <p class="card-text"><?= $articleCommentsDetails->content ?></p>
                                <p class="card-text"><small class="text-muted">Posté le <?= $articleCommentsDetails->datefr ?></small></p>
                            </div>
                            <?php if (isset($_SESSION['id']) && $articleCommentsDetails->idUsers == $_SESSION['id']) { ?>
                                <div class="card-footer text-end">
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteArticleComment" data-bs-id="<?= $articleCommentsDetails->id ?>"><i class="bi bi-trash"></i></button>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="modal fade" id="deleteArticleComment" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Souhaitez-vous vraiment supprimer ce commentaire ?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <form method="post" action="articleDetails.php?id=<?= $_GET['id'] ?>">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label"></label>
                                <p>Le commentaire sera définitivement supprimé.</p>
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

<?php
require_once 'includes/footer.php';
?>