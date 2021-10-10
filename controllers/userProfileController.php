<?php

/**
 * pour modifier le profil, j'utilise l'ajax du coup je vérifie qu'il y a un paramètre ajax dans l'url 
 * je passe les informations depuis le js j'ai besoin des models et de ma config
 */
if (isset($_GET['ajax'])) {
    session_start();
    require_once '../config.php';
    require_once '../models/database.php';
    require_once '../models/usersModel.php';

    $formErrors =  [];

    $users = new users();
    $users->id = $_SESSION['id'];

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
            echo json_encode($formErrors);
        }
        if(!isset($formErrors['mail'])){
            if ($users->updateUserMail()) {
                echo true;
            } else {
                $formErrors['mail'] = 'ERREUR DB';
                echo json_encode($formErrors);
            }
        }
    } else {
        $formErrors['mail'] = EMPTY_MAIL;
        echo json_encode($formErrors);
    }


} elseif (isset($_GET['passwordAjax'])) {
    session_start();
    require_once '../config.php';
    require_once '../models/database.php';
    require_once '../models/usersModel.php';

    $users = new users();

    $formErrors =  [];

    //Si mon champs password n'existe pas ou qu'il existe mais qu'il est vide, alors j'informe l'utilisateur que le champs est obligatoire 
    if (!isset($_GET['password']) || empty($_GET['password'])) {
        $formErrors['password'] = EMPTY_PASSWORD;
    }

    //Si le champs confirmPassword n'existe pas ou qu'il existe mais qu'il est vide, alors j'informe l'utilisateur que le champs est obligatoire 
    if (!isset($_GET['confirmPassword']) || empty($_GET['confirmPassword'])) {
        $formErrors['confirmPassword'] = EMPTY_PASSWORD;
    }

    /**
     * S'il n'existe aucunes erreurs liées à mon champs password et confirmPassword, je vérifie si le contenu de mes champs password
     * et confirmPassword sont identiques. S'ils le sont, je stocke son contenu dans l'attribut 'password' de ma classe 'users'.
     * S'ils ne le sont pas, on informe l'utilisateur que les 2 champs sont différents
     */
    if (!isset($formErrors['password']) && !isset($formErrors['confirmPassword'])) {
        if ($_GET['password'] == $_GET['confirmPassword']) {
            //password_hash est une fonction PHP qui permet de hacher le mot de passe
            $users->password = password_hash($_GET['password'], PASSWORD_DEFAULT);
        } else {
            $formErrors['password'] = $formErrors['confirmPassword'] = INVALID_PASSWORD;
        }
    }

    if (count($formErrors) == 0) {
        $users->id = $_SESSION['id'];
        if ($users->updateUserPassword()) {
            echo true;
        } else {
            $formErrors['password'] = 'ERREUR DB';
            //echo json_encode($formErrors);
            echo 'premier else';
        }
    } else {
        $testTableau = ['hello', 'world'];
        echo json_encode($formErrors);
    }
} else {

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
     * Si le POST deleteUserButton existe alors je stocke dans l'attribut id de ma classe user, l'id de ma session donc celle correspondant à
     * l'utilisateur connectée
     */
    if (isset($_POST['deleteUserButton'])) {
        // On stocke le contenu de notre input idRecipient dans l'attribut id de la classe appointments
        // Ici le contenu de cet input correspond à l'id du RDV que l'ont avait transmis à cet input grace au "data-base-test du bouton supprimer
        $users->id = $_SESSION['id'];
        // On stocke dans une variable le retour de la méthode deleteAppointement, qui sera ici un booléan
        $users->deleteUser();
        $success = 'Votre compte a bien été supprimé.';
        session_destroy();
        session_unset();
        header('location:index.php');
        exit;
    }else{
        $formErrors['db'] = 'Une erreur est survenue.';
    }

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
}
