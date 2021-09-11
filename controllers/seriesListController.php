<?php
//J'instancie mon objet
$series = new series();

if(!empty($_POST['idRecipient'])) {
    //On stocke le contenu de notre input idRecipient dans l'attribut id de la classe series
    // Ici le contenu de cet input correspond à l'id de l'article que l'ont avait transmis à cet input grace au "data-base-id du bouton supprimer
    $series->id = $_POST['idRecipient'];
    //On stocke dans une variable le retour de la méthode deleteSeries, qui sera ici un booléan
    $deleteSeries = $series->deleteSeries();
}

//J'appelle ma méthode
$seriesList = $series->getSeriesList();