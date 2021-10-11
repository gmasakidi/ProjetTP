<?php
//J'instancie mon objet
$series = new series();

//Si l'utilisateur n'est pas administrateur, alors il est redirigé vers l'index. S'il n'est pas connecté, il est également redirigé
//Protection pour empêcher tout utilisateur autre que l'administrateur d'avoir accès à ces infos
if(isset($_SESSION['idRoles'])){
    if($_SESSION['idRoles'] != 1){
        header('location:index.php');
        exit;
    }
}else{
    header('location:index.php');
    exit;
}

if(!empty($_POST['idRecipient'])) {
    //On stocke le contenu de notre input idRecipient dans l'attribut id de la classe series
    // Ici le contenu de cet input correspond à l'id de l'article que l'ont avait transmis à cet input grace au "data-base-id du bouton supprimer
    $series->id = $_POST['idRecipient'];
    //On stocke dans une variable le retour de la méthode deleteSeries, qui sera ici un booléan
    $deleteSeries = $series->deleteSeries();
}

//J'appelle ma méthode
$seriesList = $series->getSeriesList();