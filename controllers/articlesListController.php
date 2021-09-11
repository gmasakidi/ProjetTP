<?php
//J'instancie mon objet
$articles = new articles();

if(!empty($_POST['idRecipient'])) {
    //On stocke le contenu de notre input idRecipient dans l'attribut id de la classe articles
    // Ici le contenu de cet input correspond à l'id de l'article que l'ont avait transmis à cet input grace au "data-base-id du bouton supprimer
    $articles->id = $_POST['idRecipient'];
    //On stocke dans une variable le retour de la méthode deleteArticle, qui sera ici un booléan
    $deleteArticle = $articles->deleteArticle();
}

//J'appelle ma méthode
$articlesList = $articles->getArticlesList();