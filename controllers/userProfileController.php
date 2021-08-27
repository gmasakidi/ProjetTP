<?php
if(!isset($_GET['ajax'])) {


//J'instancie mon objet -j'appelle ma classe -.
$users = new users;

if (isset($_SESSION['username'])) {
    $users->id = $_SESSION['id'];
    $check = $users->checkIfUserExists();
    if ($check->count == 0) {
        header('location:login.php');
        exit;
    }
} else {
    header('location:login.php');
    exit;
}

$usersProfile = $users->getUserProfile();

/**
 * pour modifier le profil, j'utilise l'ajax du coup je vérifie qu'il y a un paramètre ajax dans l'url 
 * je passe les informations depuis le js j'ai besoin des models et de ma config
 */

    //J'initialise mon tableau qui stockera mes messages d'erreurs
    $formErrors =  [];

    //Si mon formulaire a été envoyé
    if (count($_POST) > 0) {

        /**
         *  Si mon champs mail n'est pas vide alors je compare son contenu à la constante 'FILTER_VALIDATE_EMAIL' via la fonction PHP filter_var(),
         * sinon j'informe l'utilisateur que l'email est obligatoire.
         * Si le contenu du champs mail se conforme bien au format du FILTER_VALIDATE_EMAIL alors je stocke le contenu de mon champs mail 
         * dans l'attribut 'mail' de ma classe 'users', sinon j'informe l'utilisateur que le champs mail est obligatoire.
         */
        if (!empty($_POST['mail'])) {
            /**
             * Le filter_var() - https://www.php.net/manual/fr/function.filter-var.php - permet de remplacer une regex trop complexe. Ici, l'adresse mail par exemple.
             * Le filtre 'FILTER_VALIDATE_EMAIL' est une constante. Les différents filtres existants sont dispos sur le site php.net : https://www.php.net/manual/fr/filter.filters.validate.php
             */
            if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                //Le htmlspecialchars permet de désactiver les balises entrées dans le champs, il transforme l'entrée en chaine de caractère
                $users->mail = htmlspecialchars($_POST['mail']);
            } else {
                $formErrors['mail'] = INVALID_MAIL;
            }
        } else {
            $formErrors['mail'] = EMPTY_MAIL;
        }

        if (count($formErrors) == 0) {
            $users->id = $_SESSION['id'];
            $updateUser = $users->updateUserProfile();
            // header('location:appointmentList.php');
            // exit;
        }
        // si mon tableau formErrors n'est pas vide je le renvoie sous forme de fichier json au js 
        // le js et le php peuvent tous les 2 interpréter le json
        if (count($formErrors) > 0) {
            // echo json_encode($formErrors);
        }
    }
}else{
    session_start();
    require_once '../config.php';
    require_once '../models/database.php';
    require_once '../models/usersModel.php';

    $formErrors =  [];

    $users = new users();
    if (!empty($_GET['mail'])) {
        /**
         * Le filter_var() - https://www.php.net/manual/fr/function.filter-var.php - permet de remplacer une regex trop complexe. Ici, l'adresse mail par exemple.
         * Le filtre 'FILTER_VALIDATE_EMAIL' est une constante. Les différents filtres existants sont dispos sur le site php.net : https://www.php.net/manual/fr/filter.filters.validate.php
         */
        if (filter_var($_GET['mail'], FILTER_VALIDATE_EMAIL)) {
            //Le htmlspecialchars permet de désactiver les balises entrées dans le champs, il transforme l'entrée en chaine de caractère
            $users->mail = htmlspecialchars($_GET['mail']);
        } else {
            $formErrors['mail'] = INVALID_MAIL;
        }
    } else {
        $formErrors['mail'] = EMPTY_MAIL;
    }

    if(count($formErrors) == 0) {
        $users->id = $_SESSION['id'];
        if($users->updateUserMail()){
            echo true;
        }else{
            $formErrors['mail'] = 'ERREUR DB';
            echo json_encode($formErrors);
        }
    }else{
        echo json_encode($formErrors);
    }
}
