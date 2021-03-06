<?php
session_start();

$title = 'Actualités';
require_once 'models/database.php';
require_once 'models/articlesModel.php';
require_once 'controllers/newsFeedPageController.php';
require_once 'includes/header.php';
?>
<div class="container">
    <div class="row mt-5">
        <div class="col-12 mt-4 mb-4">
            <h1 class="text-center">Actualités</h1>
        </div>
    </div>

    <div class="row d-flex justify-content-center">
        <?php $count = 0; 
        foreach ($articlesList as $articlesDetails) {
            if ($count % 2 == 0) { ?>
                <div class="col-12 mt-4 d-flex justify-content-center">
                    <div class="card news-post mb-3" style="max-width: 65rem;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="<?= $articlesDetails->photo ?>" class="img-fluid" alt="articlePoster">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h2 class="card-title h3"><a href="articleDetails.php?id=<?= $articlesDetails->id ?>" class="text-decoration-none link-secondary"><?= $articlesDetails->title ?></a></h2>
                                    <p class="card-text"><?= $articlesDetails->content ?>... <a class="text-decoration-none" href="articleDetails.php?id=<?= $articlesDetails->id ?>">En lire plus</a></p>
                                    <p class="card-text"><small class="text-muted">Publié le <?= $articlesDetails->datefr ?></small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $count++ ?>
            <?php } else { ?>
                <div class="col-12 mt-4 d-flex justify-content-center">
                    <div class="card news-post mb-3" style="max-width: 65rem;">
                        <div class="row g-0">
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h2 class="card-title h3"><a href="articleDetails.php?id=<?= $articlesDetails->id ?>" class="text-decoration-none link-secondary"><?= $articlesDetails->title ?></a></h2>
                                    <p class="card-text"><?= $articlesDetails->content ?>... <a class="text-decoration-none" href="articleDetails.php?id=<?= $articlesDetails->id ?>">En lire plus</a></p>
                                    <p class="card-text"><small class="text-muted">Publié le <?= $articlesDetails->datefr ?></small></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <img src="<?= $articlesDetails->photo ?>" class="img-fluid" alt="articlePoster">
                            </div>
                        </div>
                    </div>
                </div>
                <?php $count++ ?>
            <?php } ?>
        <?php } ?>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>