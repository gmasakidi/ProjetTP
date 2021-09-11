<?php

//J'appelle ma classe - j'instancie
$series = new series();

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
}else {
    header('location:seriesList.php');
    exit;
}

if (count($_POST) > 0) {

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
                chmod('uploads/Series/' . $_FILES['poster']['name'], 0644);
                $series->photo = '../assets/uploads/Series/' . $_FILES['poster']['name'];
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

$seriesDetails = $series->getSeriesDetails();