<?php
// J'appelle ma classe articles - j'instancie mon objet
$articles = new articles();

if (!empty($_GET['id'])) {
    //Je stocke l'id de mon URL dans l'attribut id de ma classe articles
    $articles->id = $_GET['id'];
    //On stocke dans une variable le résultat de la méthode "checkIfArticleExists"
    $articleExists = $articles->checkIfArticleExists();
    //Si le retour du count de notre méthode est égal à 0 (donc notre article n'existe pas car aucun ID), alors on le redirige
    if ($articleExists->count == 0) {
        header('location:articlesList.php');
        exit;
    }
}else {
    header('location:articlesList.php');
    exit;
}

if (count($_POST) > 0) {
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
                chmod('uploads/Articles/' . $_FILES['articlePhoto']['name'], 0644);
                $articles->photo = '../assets/uploads/Articles/' . $_FILES['articlePhoto']['name'];
            } else {
                $formErrors['articlePhoto'] = 'Une erreur est survenue lors de l\'envoi.';
            }
        } else {
            $formErrors['articlePhoto'] = INVALID_ARTICLE_PHOTO;
        }
    } else {
        $formErrors['articlePhoto'] = EMPTY_ARTICLE_PHOTO;
    }

    if (count($formErrors) == 0) {
        if ($articles->updateArticle()) {
            $success = 'L\'article a bien été modifié.';
        } else {
            $formErrors['db'] = 'Une erreur est survenue.';
        }
    }
}

$articleDetails = $articles->getArticleDetails();