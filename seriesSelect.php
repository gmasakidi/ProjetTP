<?php
session_start();

$title = 'Sélectionner';
require_once 'models/database.php';
require_once 'models/seriesModel.php';
require_once 'models/usersModel.php';
require_once 'models/viewedSeriesModel.php';
require_once 'config.php';
require_once 'controllers/seriesSelectController.php';
require_once 'includes/header.php';
?>
<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <h1 class="text-center mt-5">Quelles séries regardez-vous ?</h1>
            <p class="mb-5 text-center">Sélectionnez les séries que vous regardez ou que vous prevoyez de regarder</p>
        </div>
    </div>
    <form action="seriesSelect.php" method="post">
        <div class="row mt-4 d-flex justify-content-center">
            <?php foreach ($seriesList as $seriesDetails) { ?>
                <div class="col-6 col-sm-3 d-flex justify-content-center mb-4">
                    <div class="card seriesCard" style="width: 12rem;">
                        <img src="<?= $seriesDetails->photo ?>" class="card-img-top" alt="seriesPoster" />
                        <div class="center">
                            <label class="label">
                                <input class="label__checkbox" type="checkbox" name="box[]" value="<?= $seriesDetails->id ?>" />
                                <span class="label__text">
                                    <span class="label__check">
                                        <i class="fa fa-check icon"></i>
                                    </span>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if(isset($formErrors['box'])){ ?>
                <small class="text-danger"><?= @$formErrors['box'] ?></small>
            <?php } ?>
        </div>
        <button type="submit" name="selectSeriesButton" class="btn btn-success mt-3 mb-5">Envoyer</button>
    </form>
</div>


<?php
require_once 'includes/footer.php';
?>