<?php 
session_start();

$title = 'Accueil';
require_once 'includes/header.php';
?>
    <main>
        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/img/Cover2.webp" alt="seriesWall" />

                    <div class="container">
                        <div class="carousel-caption text-start">
                            <h1>Example headline.</h1>
                            <p>Some representative placeholder content for the first slide of the carousel.</p>
                            <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/img/TBBTcarousel.jpg" alt="TBBTPhoto" />

                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Another example headline.</h1>
                            <p>Some representative placeholder content for the second slide of the carousel.</p>
                            <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/img/Youcarousel.jpg" alt="youPhoto" />

                    <div class="container">
                        <div class="carousel-caption text-end">
                            <h1>One more for good measure.</h1>
                            <p>Some representative placeholder content for the third slide of this carousel.</p>
                            <p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="container marketing">
            <div class="row d-flex align-items-center text-center mt-5 boxShadow">
                <div class="col-12 col-sm-4 text-center">
                    <div class=" display-3 mb-2 rounded-circle">
                        <i class="fas fa-film"></i>
                    </div>
                    <h2>Séries</h2>
                    <p>Retrouvez vos séries favorites et suivez votre progression par saison.</p>
                    <p><a class="btn btn-secondary" href="#">Voir détails &raquo;</a></p>
                </div>
                <div class="col-12 col-sm-4 mt-4 mt-sm-0">
                    <div class=" display-3 mb-2 rounded-circle">
                        <i class="far fa-comment-alt"></i>
                    </div>
                    <h2>Discussion</h2>
                    <p>Partagez vos avis les derniers épisodes que vous avez regardé.</p>
                    <p><a class="btn btn-secondary" href="#">Voir détails &raquo;</a></p>
                </div>
                <div class="col-12 col-sm-4 mt-4 mt-sm-0">
                    <div class=" display-3 mb-2 rounded-circle">
                        <i class="far fa-newspaper"></i>
                    </div>
                    <h2>News</h2>
                    <p>Suivez l'actualité de vos programmes ainsi que les dernières nouveautés.</p>
                    <p><a class="btn btn-secondary" href="#">Voir détails &raquo;</a></p>
                </div>
            </div>
            <!-- FEATURES SECTION START -->
            <hr class="feature-divider">
            <div class="row">
                <div class="col-md-7">
                    <h2 class="feature-heading">Aussi simple que ça. <span class="text-muted">Voyez par vous
                            même.</span></h2>
                    <p class="lead">Regardez vos programmes et retrouvez les tous sur SeriesTrackr, nous nous chargons
                        du reste.</p>
                </div>
                <div class="col-md-5">
                    <img class="featureImage" src="assets/img/watchImage.png" alt="watchImage">
                </div>
            </div>
            <hr class="feature-divider">
            <div class="row">
                <div class="col-md-7 order-md-2">
                    <h2 class="feature-heading">Votre expérience, notre force. <span class="text-muted">Vous serez impressionné.</span></h2>
                    <p class="lead">Sélectionnez les séries que vous connaissez ainsi que les saisons que vous avez regardé. Plus besoin mémoriser votre progression.</p>
                </div>
                <div class="col-md-5 order-md-1">
                    <img class="featureImage" src="assets/img/checkImage.png" alt="checkImage">
                </div>
            </div>
            <hr class="feature-divider">
            <div class="row">
                <div class="col-md-7">
                    <h2 class="feature-heading">Et si on en discutait ? <span class="text-muted">Alors à vos claviers !</span></h2>
                    <p class="lead">SériesTrakr vous propose un véritable espace de discussion où vous pourrez partager vos impressions sur les séries que vous avez regardé.
                        Vous pourrez échanger opinions sur l'actualité de vos programmes préférés.
                    </p>
                </div>
                <div class="col-md-5">
                    <img class="featureImage" src="assets/img/discussImage.png" alt="discussImage">
                </div>
            </div>
            <!-- FEATURES SECTION END -->
            <hr class="feature-divider">
        </div>
    </main>

<?php 
require_once 'includes/footer.php';
?>