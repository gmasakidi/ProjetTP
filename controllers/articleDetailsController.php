<?php

$articles = new articles();
$articlesComments = new articlesComments();

if (!empty($_GET['id'])) {
    
    $articles->id = $articlesComments->idArticles = $_GET['id'];
    $check = $articles->checkIfArticleExists();
    if ($check->count == 0) {
        header('location:newsFeedPage.php');
        exit;
    }else{
        $commentsByArticle = $articlesComments->getCommentsByArticle();
    }
}else {
    header('location:newsFeedPage.php');
    exit;
}

if(!empty($_POST['idRecipient'])) {
    //On stocke le contenu de notre input idRecipient dans l'attribut id de la classe series
    // Ici le contenu de cet input correspond à l'id de l'article que l'ont avait transmis à cet input grace au "data-base-id du bouton supprimer
    $articlesComments->id = $_POST['idRecipient'];
    //On stocke dans une variable le retour de la méthode deleteSeries, qui sera ici un booléan
    $deleteArticleComment = $articlesComments->deleteArticleComment();
}

if(count($_POST) > 0){

    //J'initialise mon tableau formErrors qui contetiendra les futurs messages d'erreurs à afficher
    $formErrors = [];
        
    if(!empty($_POST['articleCommentContent'])){
        $articlesComments->content = htmlspecialchars($_POST['articleCommentContent']);
    }else{
        $formErrors['articleCommentContent'] = EMPTY_ARTICLE_COMMENT_CONTENT;
    }

    if(!empty($_SESSION['id'])){
        $articlesComments->idUsers = $_SESSION['id'];
    }else{
        $formErrors['loggedOut'] = LOGGED_OUT;
    }

    if(!empty($_GET['id'])){
        $articlesComments->idArticles = $_GET['id'];
    }

    if(count($formErrors) == 0){
        $articlesComments->addArticleComment();
    }
}

$articleDetails = $articles->getArticleDetails();
