<?php

//Si l'utilisateur n'est pas administrateur, alors il est redirigé vers l'index. S'il n'est pas connecté, il est également redirigé
if(isset($_SESSION['idRoles'])){
    if($_SESSION['idRoles'] != 1){
        header('location:index.php');
        exit;
    }
}else{
    header('location:index.php');
    exit;
}

//Si mon formulaire est envoyé
if (count($_POST) > 0) {

    // J'appelle ma classe articles - j'instancie mon objet
    $articles = new articles();

    //J'initialise mon tableau formErros qui stockera mes essages d'erreurs
    $formErrors = [];

    if (!empty($_POST['articleTitle'])) {
        $articles->title = htmlspecialchars($_POST['articleTitle']);
    } else {
        $formErrors['articleTitle'] = EMPTY_ARTICLE_TITLE;
    }

    if (!empty($_POST['articleContent'])) {
        $articles->content = htmlspecialchars($_POST['articleContent']);
    } else {
        $formErrors['articleContent'] = EMPTY_ARTICLE_CONTENT;
    }
    
    if (!empty($_POST['articleCategory'])) {
        $articles->idCategories = $_POST['articleCategory'];
    } else {
        $formErrors['articleCategory'] = EMPTY_ARTICLE_CATEGORY;
    }

    if ($_FILES['articlePhoto']['error'] == 0) {
        $articlePhotoExtension = strtolower(pathinfo($_FILES['articlePhoto']['name'])['extension']);
        $authorizedExtensions = ['png', 'jpeg', 'jpg', 'gif'];

        if (in_array($articlePhotoExtension, $authorizedExtensions)) {
            if (move_uploaded_file($_FILES['articlePhoto']['tmp_name'], 'assets/uploads/Articles/' . $_FILES['articlePhoto']['name'])) {
                chmod('assets/uploads/Articles/' . $_FILES['articlePhoto']['name'], 0644);
                $articles->photo = 'assets/uploads/Articles/' . $_FILES['articlePhoto']['name'];
            } else {
                $formErrors['articlePhoto'] = 'Une erreur est survenue lors de l\'envoi.';
            }
        } else {
            $formErrors['articlePhoto'] = INVALID_ARTICLE_PHOTO;
        }
    } else {
        $formErrors['articlePhoto'] = EMPTY_ARTICLE_PHOTO;
    }

    //Si aucune erreur n'est trouvée
    if(count($formErrors) == 0){
        //Je lance la méthode pour ajouter un article
        $addArticles = $articles->addArticle();
    }
}
