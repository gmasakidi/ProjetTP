<?php

//Si mon formulaire a été envoyé
if (count($_POST) > 0) {
    //J'initialise mon tableau qui stockera mes messages d'erreurs
    $formErrors =  [];
    //J'instancie mon objet -j'appelle ma classe -.
    $users = new users;
    
    /** 
     * Si mon champs username n'est pas vide, alors je stocke son contenu dans l'attribut username de ma classe users, sinon j'informe
     * l'utilisateur que le champs est obligatoire.
     * Si ce champs n'est pas vide, je vérifie également qu'il éxiste. Si ce n'est pas le cas, j'informe l'utilisateur que
     * le pseudo ou le mot de passe est incorrect.
    */
    if (!empty($_POST['username'])) {
        $users->username = $_POST['username'];
        if ($users->checkIfUsernameExists() == 0) {
            $formErrors['username'] = $formErrors['password'] = INVALID_LOGIN;
        }
    } else {
        $formErrors['username'] = EMPTY_USERNAME;
    }

    /**
     * Si mon champs password n'est pas vide, je vérifie ensuite que le nom d'utilisateur est bien entré et qu'il existe bien dans la bdd.
     * Si c'est le cas alors je lance mas méthode getHashByUsername() qui me permet de prendre le mot de passe haché enregistré dans ma bdd
     * concernant cet utilisateur.
     * Si le contenu de mon champs password ne correspond pas mot de passe dé-haché par la fonction password_verify, alors j'informe mon utilisateur
     * que le nom d'utilisateur ou le mot de passe est invalide.
     * Si mon champs password est vide, j'informe l'utilisateur que le champs est obligatoire.
     */
    if (!empty($_POST['password'])) {
        if (!isset($formErrors['username'])) {
            $hash = $users->getHashByUsername();
            //pawword_verify permet dé-hacher mon mot de passe enregistré dans la bdd
            if (!password_verify($_POST['password'], $hash->password)) {
                $formErrors['username'] = $formErrors['password'] = INVALID_LOGIN;
            }
        }
    } else {
        $formErrors['password'] = EMPTY_PASSWORD;
    }
    
    /**
     * S'il n'y a aucune erreurs trouvées alors je lance ma méthode getUsersInformations() qui pertmet de récupérer les informations de l'utilisateur
     * je stocke dans mes $_SESSION id, username et idUserRole les valeurs des attributs id, username et idUserRole de la classe users.
     */
    if (count($formErrors) == 0) {
        $users->getUsersInformations();
        $_SESSION['id'] = $users->id;
        $_SESSION['username'] = $users->username;
        $_SESSION['idUserRole'] = $users->idUserRole;

        header('location: userProfile.php');
        exit;
    }
}

if (isset($_SESSION['username'])) {
    header('location:userProfile.php');
    exit;
}