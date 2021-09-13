<?php
session_start();

$title = 'Sélectionner';
require_once 'includes/header.php';
?>
<div class="container">
    <form action="seriesSelect.php" method="post">
        <div class="row mt-4">
            <h1 class="text-center mt-5">Quelles séries regardez-vous ?</h1>
            <p class="mb-5 text-center">Sélectionnez les séries que vous regardez ou que vous prevoyez de regarder</p>
            <div class="col-sm-6 d-flex justify-content-center justify-content-sm-end mb-4 mb-sm-0">
                <div class="card seriesCard"  style="width: 12rem;">
                    <img src="assets/img/Breaking Bad.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box[]" value="1" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="card ms-4 seriesCard" style="width: 12rem;">
                    <img src="assets/img/Games_of_Thrones.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box[]" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 d-flex justify-content-center justify-content-sm-start">
                <div class="card seriesCard" style="width: 12rem;">
                    <img src="assets/img/The witcher.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="card seriesCard ms-4" style="width: 12rem;">
                    <img src="assets/img/Queen's gambit.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-6 d-flex justify-content-center justify-content-sm-end mb-4 mb-sm-0">
                <div class="card seriesCard" style="width: 12rem;">
                    <img src="assets/img/Vikings.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="card seriesCard ms-4" style="width: 12rem;">
                    <img src="assets/img/The walking dead.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 d-flex justify-content-center justify-content-sm-start">
                <div class="card seriesCard" style="width: 12rem;">
                    <img src="assets/img/The handmaid's tale.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="card seriesCard ms-4" style="width: 12rem;">
                    <img src="assets/img/Banshee.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-6 d-flex justify-content-center justify-content-sm-end mb-4 mb-sm-0">
                <div class="card seriesCard" style="width: 12rem;">
                    <img src="assets/img/Modern family.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="card seriesCard ms-4" style="width: 12rem;">
                    <img src="assets/img/Downton abbey.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 d-flex justify-content-center justify-content-sm-start">
                <div class="card seriesCard" style="width: 12rem;">
                    <img src="assets/img/House of cards.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="card seriesCard ms-4" style="width: 12rem;">
                    <img src="assets/img/Daredevil.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-6 d-flex justify-content-center justify-content-sm-end mb-4 mb-sm-0">
                <div class="card seriesCard" style="width: 12rem;">
                    <img src="assets/img/HIMYM.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="card seriesCard ms-4" style="width: 12rem;">
                    <img src="assets/img/Outlander2.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 d-flex justify-content-center justify-content-sm-start">
                <div class="card seriesCard" style="width: 12rem;">
                    <img src="assets/img/Murder.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="card seriesCard ms-4" style="width: 12rem;">
                    <img src="assets/img/Bates motel.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-6 d-flex justify-content-center justify-content-sm-end mb-4 mb-sm-0">
                <div class="card seriesCard" style="width: 12rem;">
                    <img src="assets/img/Killing eve.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="card seriesCard ms-4" style="width: 12rem;">
                    <img src="assets/img/TBBT2.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 d-flex justify-content-center justify-content-sm-start">
                <div class="card seriesCard" style="width: 12rem;">
                    <img src="assets/img/Friends.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="card seriesCard ms-4" style="width: 12rem;">
                    <img src="assets/img/Snowfall.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-6 d-flex justify-content-center justify-content-sm-end mb-4 mb-sm-0">
                <div class="card seriesCard" style="width: 12rem;">
                    <img src="assets/img/The fall.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="card seriesCard ms-4" style="width: 12rem;">
                    <img src="assets/img/OITNB.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 d-flex justify-content-center justify-content-sm-start">
                <div class="card seriesCard" style="width: 12rem;">
                    <img src="assets/img/Chicago PD.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="card seriesCard ms-4" style="width: 12rem;">
                    <img src="assets/img/Lucifer.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-6 d-flex justify-content-center justify-content-sm-end mb-4 mb-sm-0">
                <div class="card seriesCard" style="width: 12rem;">
                    <img src="assets/img/This is us.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="card seriesCard ms-4" style="width: 12rem;">
                    <img src="assets/img/Simpsons.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 d-flex justify-content-center justify-content-sm-start">
                <div class="card seriesCard" style="width: 12rem;">
                    <img src="assets/img/You2.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="card seriesCard ms-4" style="width: 12rem;">
                    <img src="assets/img/LCDC.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-6 d-flex justify-content-center justify-content-sm-end mb-4 mb-sm-0">
                <div class="card seriesCard" style="width: 12rem;">
                    <img src="assets/img/Black mirror.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="card seriesCard ms-4" style="width: 12rem;">
                    <img src="assets/img/Stranger things.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 d-flex justify-content-center justify-content-sm-start">
                <div class="card seriesCard" style="width: 12rem;">
                    <img src="assets/img/Shameless.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="card seriesCard ms-4" style="width: 12rem;">
                    <img src="assets/img/Dexter.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-6 d-flex justify-content-center justify-content-sm-end mb-4 mb-sm-0">
                <div class="card seriesCard" style="width: 12rem;">
                    <img src="assets/img/THOHH.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="card seriesCard ms-4" style="width: 12rem;">
                    <img src="assets/img/Mr robot.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 d-flex justify-content-center justify-content-sm-start">
                <div class="card seriesCard" style="width: 12rem;">
                    <img src="assets/img/Teen wolf.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="card seriesCard ms-4" style="width: 12rem;">
                    <img src="assets/img/Brooklyn nine-nine.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-6 d-flex justify-content-center justify-content-sm-end mb-4 mb-sm-0">
                <div class="card seriesCard" style="width: 12rem;">
                    <img src="assets/img/The crown2.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="card seriesCard ms-4" style="width: 12rem;">
                    <img src="assets/img/Penny dreadful.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 d-flex justify-content-center justify-content-sm-start">
                <div class="card seriesCard" style="width: 12rem;">
                    <img src="assets/img/Pose.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="card seriesCard ms-4" style="width: 12rem;">
                    <img src="assets/img/Scandal.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-6 d-flex justify-content-center justify-content-sm-end mb-4 mb-sm-0">
                <div class="card seriesCard" style="width: 12rem;">
                    <img src="assets/img/BLL.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="card seriesCard ms-4" style="width: 12rem;">
                    <img src="assets/img/PLL.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 d-flex justify-content-center justify-content-sm-start">
                <div class="card seriesCard" style="width: 12rem;">
                    <img src="assets/img/Empire.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="card seriesCard ms-4" style="width: 12rem;">
                    <img src="assets/img/Euphoria.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-6 d-flex justify-content-center justify-content-sm-end mb-4 mb-sm-0">
                <div class="card seriesCard" style="width: 12rem;">
                    <img src="assets/img/AHS.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="card seriesCard ms-4" style="width: 12rem;">
                    <img src="assets/img/Peaky blinders.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 d-flex justify-content-center justify-content-sm-start">
                <div class="card seriesCard" style="width: 12rem;">
                    <img src="assets/img/Elite.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="card seriesCard ms-4" style="width: 12rem;">
                    <img src="assets/img/Loki.jpg" class="card-img-top" alt="..." />
                    <div class="center">
                        <label class="label">
                            <input class="label__checkbox" type="checkbox" name="box" />
                            <span class="label__text">
                                <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Success</button>
    </form>
</div>


<?php
var_dump($_POST);
require_once 'includes/footer.php';
?>