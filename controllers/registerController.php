<?php

if (isset($_SESSION['username'])) {
    header('location: login.php');
    exit;
}
if (count($_POST) > 0) {

    $formErrors =  [];
    $users = new users;

    if (!empty($_POST['username'])) {
        if (preg_match($regex['username'], $_POST['username'])) {
            $users->username = strtoupper($_POST['username']);
            if ($users->checkIfUserExists() > 0) {
                $formErrors['username'] = EXISTING_USERNAME;
            }
        } else {
            $formErrors['username'] = INVALID_USERNAME;
        }
    } else {
        $formErrors['username'] = EMPTY_USERNAME;
    }

    if (!empty($_POST['mail'])) {
        /**
         * Le filter_var() - https://www.php.net/manual/fr/function.filter-var.php - permet de remplacer une regex trop complexe. Ici, l'adresse mail par exemple.
         * Le filtre 'FILTER_VALIDATE_mail' est une constante. Les différents filtres existants sont dispos sur le site php.net : https://www.php.net/manual/fr/filter.filters.validate.php
         */
        if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $users->mail = htmlspecialchars($_POST['mail']);
        } else {
            $formErrors['mail'] = INVALID_MAIL;
        }
    } else {
        $formErrors['mail'] = EMPTY_MAIL;
    }

    if (!empty($_POST['birthdate'])) {
        if (preg_match($regex['birthdate'], $_POST['birthdate'])) {
            $users->birthdate = $_POST['birthdate'];
        } else {
            $formErrors['birthdate'] = INVALID_BIRTHDATE;
        }
    } else {
        $formErrors['birthdate'] = EMPTY_BIRTHDATE;
    }

    if (!isset($_POST['password']) || empty($_POST['password'])) {
        $formErrors['password'] = EMPTY_PASSWORD;
    }

    if (!isset($_POST['confirmPassword']) || empty($_POST['confirmPassword'])) {
        $formErrors['confirmPassword'] = EMPTY_PASSWORD;
    }

    if (!isset($formErrors['password']) && !isset($formErrors['confirmPassword'])) {
        if ($_POST['password'] === $_POST['confirmPassword']) {
            $users->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        } else {
            $formErrors['password'] = $formErrors['confirmPassword'] = INVALID_PASSWORD;
        }
    }

    if (count($formErrors) == 0) {
        if ($users->addUser()) {
            $success = 'Votre compte a bien été créé';
        } else {
            $formErrors['db'] = 'Une erreur est survenue.';
        }
    }
}

