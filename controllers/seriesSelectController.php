<?php

//J'instancie mes objets
$series = new series();
$users = new users();
//J'instancie l'objet qui me permettra de communiquer avec ma table f5e2_viewedseries qui contient les séries vus par l'utilisateur
$viewedSeries = new viewedSeries();

//J'appelle ma méthode
$seriesList = $series->getSeriesList();

if(isset($_POST['selectSeriesButton'])){
    $viewedSeries->idUsers = $_SESSION['id'];
    
    if(!empty($_POST['box'])){
        //Je stocke dans une variable selectedSeries un tableau stockant les values de mon checkbox qui sont ici les id de mes séries
        $selectedSeries = $_POST['box'];
        foreach($selectedSeries as $series){
            $viewedSeries->idSeries = $series;
            $viewedSeries->addViewedSeries();
        }
    }else{
        $formErrors['box'] = EMPTY_SELECTED_SERIES;
    }
    $users->id = $_SESSION['id'];
    //Permet de dire à la base de donnée que la 1ere connexion est passée en modifiant la valeur de cette colonne sur 1
    $incrementFirstConnection = $users->updateFirstConnection();
    //Je redirige ensuite l'utilisateur vers son profile une fois qu'il a envoyé les séries qu'il a regardé
    header('location:userProfile.php');
    exit;
}