<?php

//J'appelle mes classes - j'instancie mes objets
$series = new series();

$status = new status();
$statusList = $status->getStatusList();

$seriesGenres = new seriesGenres();
$seriesGenresList = $seriesGenres->getseriesGenresList();

$actors = new actors();
$actorsList = $actors->getActorsList();

if (!empty($_GET['id'])) {
    //Je stocke l'id de mon URL dans l'attribut id de ma classe series
    $series->id = $_GET['id'];
    //On stocke dans une variable le résultat de la méthode "checkIfArticleExists"
    $seriesExists = $series->checkIfSeriesExists();
    //Si le retour du count de notre méthode est égal à 0 (donc notre article n'existe pas car aucun ID), alors on le redirige
    if ($seriesExists->count == 0) {
        header('location:seriesList.php');
        exit;
    }
} else {
    header('location:seriesList.php');
    exit;
}

//Si le $_POST de mon bouton existe, c'est a dire que mon bouton a envoyé des données
if (isset($_POST['seriesButton'])) {
    // J'initialise mon tableau formErrors qui contiendra tous mes messages d'erreurs
    $formErrors = [];

    if (!empty($_POST['title'])) {
        $series->title = htmlspecialchars(strtoupper($_POST['title']));
    } else {
        $formErrors['title'] = EMPTY_TITLE;
    }

    if (!empty($_POST['synopsis'])) {
        $series->synopsis = htmlspecialchars($_POST['synopsis']);
    } else {
        $formErrors['synopsis'] = EMPTY_SYNOPSIS;
    }

    if (!empty($_POST['creators'])) {
        if (preg_match($regex['actors'], $_POST['creators'])) {
            $series->creators = strtoupper($_POST['creators']);
        } else {
            $formErrors['creators'] = INVALID_CREATORS;
        }
    } else {
        $formErrors['creators'] = EMPTY_CREATORS;
    }

    if (!empty($_POST['year'])) {
        $series->year = $_POST['year'];
    } else {
        $formErrors['year'] = EMPTY_YEAR;
    }

    /**
     * Le tableau super global $_FILES se remplit dès que l'on envoie un fichier. Il crée alors une entrée ['nomDuFichier'] qui devient elle-même un tableau.
     * Ce nouveau tableau ($_FILES['nomDuFichier']) contient des informations très utiles comme le nom du fichier, sa taille et s'il y a eu une erreur lors de l'upload
     * Conseil : Pensez au var_dump, il permet de visualiser une variable ou un tableau
     */

    if ($_FILES['poster']['error'] == 0) {
        $posterExtension = strtolower(pathinfo($_FILES['poster']['name'])['extension']);
        $authorizedExtensions = ['png', 'jpeg', 'jpg', 'gif'];

        if (in_array($posterExtension, $authorizedExtensions)) {
            if (move_uploaded_file($_FILES['poster']['tmp_name'], 'assets/uploads/Series/' . $_FILES['poster']['name'])) {
                chmod('assets/uploads/Series/' . $_FILES['poster']['name'], 0644);
                $series->photo = 'assets/uploads/Series/' . $_FILES['poster']['name'];
            } else {
                $formErrors['poster'] = 'Une erreur est survenue lors de l\'envoi.';
            }
        } else {
            $formErrors['poster'] = INVALID_POSTER;
        }
    } else {
        $formErrors['poster'] = EMPTY_POSTER;
    }

    if (!empty($_POST['seriesStatus'])) {
        $series->idStatus = $_POST['seriesStatus'];
    } else {
        $formErrors['seriesStatus'] = EMPTY_SERIES_STATUS;
    }

    if (count($formErrors) == 0) {
        if ($series->updateSeries()) {
            $success = 'La série a bien été modifiée.';
        } else {
            $formErrors['db'] = 'Une erreur est survenue.';
        }
    }
}

if(isset($_POST['seriesSeasonsButton'])){
    //J'appelle ma classe seasons
    $seasons = new seasons;
    //J'initialise mon tableau formErrors
    $formErrors = [];

    if(!empty($_POST['seasons'])){
        //Je stocke dans mon attribut idSeries de ma classe seasons, le l'id stocké dans mon paramètre d'url (qui correspond à l'id de ma série)
        $seasons->idSeries = $_GET['id'];
        //J'appelle la méthode qui supprimera les saisons associés à cette série
        $seasons->deleteSeasonsToSeries();
        //Je stocke dans une variable la valeur récupérée dans mon select
        $seasonsNumber = $_POST['seasons'];
        //je fais une boucle allant de 1 jusqu'au nombre de saisons selectionné dans le select de ma vue
        for($SeriesSeasons = 1; $SeriesSeasons <= $seasonsNumber; $SeriesSeasons++){
            //Je stocke dans l'attribut seasonNumber de ma classe seasons, la value récupéré dans mon select
            $seasons->seasonNumber = $SeriesSeasons;
            //Je lance ma méthode pour ajouter la saison
            $seasons->addSeason();
        }
    }else{
        $formErrors['seasons'] = EMPTY_SEASONS;
    }
}

if (isset($_POST['seriesGenresButton'])) {
    //J'appelle mes classes, j'instancie es objets
    $seriesHaveGenres = new seriesHaveGenres();
    // J'initialise mon tableau formErrors qui contiendra tous mes messages d'erreurs
    $formErrors = [];

    if (!empty($_POST['seriesGenres'])) {
        //Je stocke dans mon attribut idSeries de ma classe seriesHaveGenres, le l'id stocké dans mon paramètre d'url (qui correspond à l'id de ma série)
        $seriesHaveGenres->idSeries = $_GET['id'];
        //J'appelle la méthode qui supprimera les genre associés à cette série
        $seriesHaveGenres->deleteGenreToSeries();
        //Je stocke dans une variable les éléments sélectionnés dans cet input qui ici me renvoie un tableau
        $seriesGenres = $_POST['seriesGenres'];
        //Etant donné que mon checkbox est un tableau, je dois faire un foreach pour récupérer les infos de chaque cases cochées
        foreach ($seriesGenres as $genres) {
            //Je stocke dans l'attribut idseriesGenres de la classe seriesHaveGenres, l'id récupéré dans les "value" de mes checkbox
            $seriesHaveGenres->idSeriesGenres = $genres;
            //Je lance ma méthode pour remplir ma table seriesHaveGenres
            $seriesHaveGenres->addGenreToSeries();
        }
    } else {
        $formErrors['seriesGenres'] = EMPTY_SERIES_GENRES;
    }
}

if (isset($_POST['seriesActorsButton'])) {
    //J'insctancie mon objet
    $seriesHaveActors = new seriesHaveActors();

    // J'initialise mon tableau formErrors qui contiendra tous mes messages d'erreurs
    $formErrors = [];

    if (!empty($_POST['actors'])) {
        //Je stocke dans mon attribut idSeries de ma classe seriesHaveActors, le l'id stocké dans mon paramètre d'url (qui correspond à l'id de ma série)
        $seriesHaveActors->idSeries = $_GET['id'];
        //J'appelle la méthode qui supprimera les acteurs associés à cette série
        $seriesHaveActors->deleteActorsFromSeries();
        //Je stocke dans une variable les éléments sélectionnés dans cet input qui ici me renvoie un tableau
        $seriesActors = $_POST['actors'];
        //Etant donné que mon checkbox est un tableau, je dois faire un foreach pour récupérer les infos de chaque cases cochées            
        foreach ($seriesActors as $actors) {
            //Je stocke dans l'attribut idActors de la classe seriesHaveActors, l'id récupéré dans les "value" de mes checkbox
            $seriesHaveActors->idActors = $actors;
            //Je lance ma méthode pour remplir ma table seriesHaveActors
            $seriesHaveActors->addActorsToSeries();
        }
    }else{
        $formErrors['actors'] = EMPTY_SERIES_ACTORS;
    }
}

$seriesDetails = $series->getSeriesDetails();