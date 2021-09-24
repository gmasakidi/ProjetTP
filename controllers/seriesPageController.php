<?php
//J'instancie mon objet
$series = new series();

if (!empty($_POST['search'])) {
    // @$_POST['search'] pour la barre de recherche 
    $seriesDisplay = $series->getSeriesResults(@$_POST['search']);
}

var_dump($seriesDisplay);