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
        $articleCommentsList = $articlesComments->getArticleCommentList();
        
    }
}else {
    header('location:newsFeedPage.php');
    exit;
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

var_dump($articleCommentsList);