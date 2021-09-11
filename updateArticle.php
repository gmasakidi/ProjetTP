<?php
session_start();

$title = 'Modifier l\'article';
require_once 'includes/header.php';
require_once 'models/database.php';
require_once 'models/articlesModel.php';
require_once 'config.php';
require_once 'controllers/updateArticleController.php';
?>
<div class="container">
    <?php if (isset($formErrors['db'])) { ?>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 d-flex justify-content-center alert alert-danger" role="alert">
                <p class="text-center"><?= $formErrors['db'] ?></p>
            </div>
        </div>
    <?php } else { ?>
        <?php if (isset($success)) { ?>
            <div class="row d-flex justify-content-center">
            <div class="col-md-6 d-flex justify-content-center alert alert-success" role="alert">
                <p class="text-center"><?= $success ?></p>
            </div>
        </div>
        <?php } ?>
    <?php } ?>
    <div class="row mt-5">
        <div class="col-12 mt-4">
            <h1 class="text-center">Modifier cet article</h1>
        </div>
        <div class="col-12 mt-4 d-flex justify-content-center">
            <form action="updateArticle.php?id=<?= $articleDetails->id ?>" method="post" enctype="multipart/form-data" class="w-50 mb-5">
                <div class="mb-3">
                    <label for="articleTitle" class="form-label">Titre de l'article</label>
                    <input type="text" placeholder="Ex: Narcos" name="articleTitle" class="form-control <?= !empty($formErrors['articleTitle']) ? 'is-invalid' : ''; ?>" id="articleTitle" value="<?= $articleDetails->title ?>" />
                    <small class="invalid-feedback"><?= @$formErrors['articleTitle']; ?></small>
                </div>
                <div class="mb-4">
                    <label for="articleContent" class="form-label">Contenu de l'article</label>
                    <textarea name="articleContent" class="form-control <?= !empty($formErrors['articleContent']) ? 'is-invalid' : ''; ?>" id="articleContent" rows="5" cols="33"><?= $articleDetails->content ?></textarea>
                    <small class="invalid-feedback"><?= @$formErrors['articleContent']; ?></small>
                </div>
                <div class="mb-3">
                    <div class="input-group mb-3 <?= !isset($formErrors['articlePhoto']) ?: 'has-danger' ?>">
                        <label for="articlePhoto" class="input-group-text">Photo article</label>
                        <input type="file" name="articlePhoto" class="form-control <?= !empty($formErrors['articlePhoto']) ? 'is-invalid' : ''; ?>" id="articlePhoto">
                        <small class="invalid-feedback"><?= @$formErrors['articlePhoto']; ?></small>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group <?= !isset($formErrors['articleCategory']) ?: 'has-danger' ?>">
                        <label for="articleCategory" class="form-label">Catégorie (tag) </label>
                        <select class="form-select <?= !isset($formErrors['articleCategory']) ?: 'is-invalid' ?>" id="articleCategory" name="articleCategory">
                            <option selected disabled>Choisir une catégorie d'article</option>
                            <option value="1">Séries</option>
                            <option value="2">Nouveauté</option>
                            <option value="3">Streaming</option>
                        </select>
                        <small class="invalid-feedback"><?= @$formErrors['articleCategory'] ?></small>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" value="Envoyer" />
            </form>
        </div>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>