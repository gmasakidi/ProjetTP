<?php

if (count($_POST) > 0) {
    $formErrors =  [];
    $users = new users;

    if (!empty($_POST['username'])) {
        $users->username = $_POST['username'];
        if ($users->checkIfUserExists() == 0) {
            $formErrors['username'] = $formErrors['password'] = INVALID_LOGIN;
        }
    } else {
        $formErrors['username'] = EMPTY_USERNAME;
    }

    if (!empty($_POST['password'])) {
        if (!isset($formErrors['username'])) {
            $hash = $users->getHashByUsername();
            if (!password_verify($_POST['password'], $hash->password)) {
                $formErrors['username'] = $formErrors['password'] = INVALID_LOGIN;
            }
        }
    } else {
        $formErrors['password'] = EMPTY_PASSWORD;
    }

    if (count($formErrors) == 0) {
        $users->getUsersInformations();
        $_SESSION['id'] = $users->id;
        $_SESSION['username'] = $users->username;
        $_SESSION['idUserRole'] = $users->idUserRole;

        var_dump($_SESSION);
    }
}