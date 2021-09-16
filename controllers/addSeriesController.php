<?php

$status = new status();
$statusList = $status->getStatusList();

$seriesGenres = new seriesGenres();
$seriesGenresList = $seriesGenres->getseriesGenresList();

$actors = new actors();
$actorsList = $actors->getActorsList();


if (count($_POST) > 0) {

    //J'appelle ma classe
    $series = new series();
    $seriesHaveGenres = new seriesHaveGenres();
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

    if(!empty($_POST['seriesStatus'])) {
        $series->idStatus = $_POST['seriesStatus'];
    } else {
        $formErrors['seriesStatus'] = EMPTY_SERIES_STATUS;
    }

    if(!empty($_POST['seriesGenres'])){
        //Je stocke dans une variable les éléments sélectionnés dans cet input
        $seriesGenres = $_POST['seriesGenres'];
    }else{
        $formErrors['seriesGenres'] = EMPTY_SERIES_GENRES;
    }

    if(!empty($_POST['actors'])){
        //Je stocke dans une variable les éléments sélectionnés dans cet input
        $seriesGenres = $_POST['actors'];
    }else{
        $formErrors['actors'] = EMPTY_SERIES_ACTORS;
    }

    if(count($formErrors) == 0){
        //Active un mode erreur qui vérifie si une erreur a eu lieu
        $series->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            //Dis au PHP que je démarre la transaction dans ma base de donnée
            $series->db->beginTransaction();
            var_dump($series);
            //Je lance ma méthode pour l'ajout de série
            $addSeries = $series->addSeries();
            //Je stocke dans l'attribut idSeries de la table seriesHaveGenres, l'id de la série que j'ajoute
            $seriesHaveGenres->idSeries = $series->db->lastInsertId();
            foreach ($seriesGenres as $genres){
                //Je stocke dans l'attribut idseriesGenres de la table seriesHaveGenres, l'id récupéré dans mes checkbox
                $seriesHaveGenres->idSeriesGenres = $genres;
                //Je lance ma méthode pour remplir ma table seriesHaveGenres
                $seriesHaveGenres->addGenreToSeries();
            }
            //Si tout s'est bien passé, valide la transaction et l'inscrit dans la bdd
            $series->db->commit();
        } catch (PDOException $error) {
            var_dump($formErrors);
            //Si la transation attrape une erreur, retire ce qui vient d'être entré dans la bdd
            $series->db->rollBack();
            die ($error->getMessage());
        }
    }
}