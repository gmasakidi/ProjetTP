<?php

//J'instancie mon objet
$series = new series();
//J'instancie l'objet qui me permettra de communiquer avec ma table f5e2_viewedseries qui contient les séries vus par l'utilisateur
$viewedSeries = new viewedSeries();

//J'appelle ma méthode
$seriesList = $series->getSeriesList();

if(!empty($_POST['box'])){
    $viewedSeries->idUsers = $_SESSION['id'];
    $selectedSeries = $_POST['box'];
    foreach($selectedSeries as $series){
        $viewedSeries->idSeries = $series;
        $viewedSeries->addViewedSeries();
    }
}else{
    $formErrors['box'] = EMPTY_SELECTED_SERIES;
}
