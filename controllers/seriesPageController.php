<?php

if (isset($_GET['seriesSearchAjax'])) {
    session_start();
    require_once '../models/database.php';
    require_once '../models/seriesModel.php';
    require_once '../config.php';

    //J'instancie mon objet
    $series = new series();
    //J'initialise mon tableau formErrors qui va contenir mon message d'erreur
    $formErrors = [];

    if (!empty($_GET['search'])) {
        //je stocke dans une variable search la valeur envoyé dans le champs de recherche en désactivant les potentiels chevrons
        $search = htmlspecialchars($_GET['search']);

        if (!isset($formErrors['search'])) {
            $seriesResult = $series->getSeriesResults(@$search);
            if (count($seriesResult) > 0) {
                echo json_encode($seriesResult);
            } else {
                $formErrors['search'] = 'ERREUR DB';
                echo false;
                echo json_encode($seriesResult);
            }
        }
    } else {
        $formErrors['search'] = EMPTY_SEARCH;
    }
} else {
    //J'instancie mon objet
    $series = new series();

    if (count($_POST) > 0) {
        //J'initialise mon tableau formErrors qui va contenir mon message d'erreur
        $formErrors = [];

        if (!empty($_POST['search'])) {
            //je stocke dans une variable search la valeur envoyé dans le champs de recherche en désactivant les potentiels chevrons
            $search = htmlspecialchars($_POST['search']);
        } else {
            $formErrors['search'] = EMPTY_SEARCH;
        }

        //si aucun erreur n'a été trouvé sur le champs, alors j'execute ma méthode
        if (count($formErrors) == 0) {
            // @$_POST['search'] pour la barre de recherche 
            $seriesResult = $series->getSeriesResults(@$search);
        }
    }
}

var_dump($seriesResult);