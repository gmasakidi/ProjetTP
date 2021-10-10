<?php
session_start();

//J'instancie mes objets
$series = new series();
$seriesComments = new seriesComments();
$seriesHaveActors = new seriesHaveActors();
$seriesHaveGenres = new seriesHaveGenres();
$seasons = new seasons();

if (!empty($_GET['id'])) {
    
    $series->id = $seriesComments->id = $seriesHaveActors->idSeries = $seriesHaveGenres->idSeries = $seasons->idSeries = $_GET['id'];
    $check = $series->checkIfSeriesExists();
    if ($check->count == 0) {
        header('location:seriesPage.php');
        exit;
    }else{
        $genresBySeries = $seriesHaveGenres->getGenresBySeries();
        $actorsBySeries = $seriesHaveActors->getActorsBySeries();
        $commentsBySeries = $seriesComments->getCommentsBySeries();
        $seasonsBySeries = $seasons->getSeasonsBySeries();
    }
}else {
    header('location:seriesPage.php');
    exit;
}

if(isset($_POST['selectSeasonButton'])){
    //J'appelle ma classe progress
    $progress = new progress;
    //J'initialise mon tableau formErrors
    $formErrors = [];

    if(!empty($_POST['seasonSelect'])){
        //Je stocke dans l'attribue idSeasons de ma class progress, la value de l'élément selectionné dans ma vue (l'id de la saison)
        $progress->idSeasons = $_POST['seasonSelect'];
        $progress->idUsers = $_SESSION['id'];
    }else{
        $formErrors['seasonSelect'] = EMPTY_PROGRESS;
    }

    if(count($formErrors) == 0){
        $progress->addSeriesProgress();
    }
}

if(!empty($_POST['idRecipient'])) {
    //On stocke le contenu de notre input idRecipient dans l'attribut id de la classe series
    // Ici le contenu de cet input correspond à l'id de l'article que l'ont avait transmis à cet input grace au "data-base-id du bouton supprimer
    $articlesComments->id = $_POST['idRecipient'];
    //On stocke dans une variable le retour de la méthode deleteSeries, qui sera ici un booléan
    // $deleteArticleComment = $articlesComments->deleteArticleComment();
}

$seriesDetails = $series->getSeriesDetails();