<?php
//Si la session de cet utilisateur existe, alors je le redirige vers la page profil (car il a déjà un compte et est connecté)
if (isset($_SESSION['username'])) {
    header('location: userProfile.php');
    exit;
}
//Si mon formulaire a été envoyé
if (count($_POST) > 0) {
    //J'initialise mon tableau qui stockera mes messages d'erreurs
    $formErrors =  [];
    //J'instancie mon objet -j'appelle ma classe -.
    $users = new users;
    /** 
     * Si mon champs username n'est pas vide alors je compare son contenu à ma regex username, sinon j'informe l'utilisateur que
     * le champs est obligatoire.
     * Si le contenu de mon champs respecte ma regex alors je stocke le contenu de mon champs (en le changeant en lettre capitale)
     * dans l'attribut 'username' de ma classe 'users', sinon j'informe l'utilisateur que le pseudo est invalide.
     * De plus, je vérifie si l'utilisateur existe déjà via ma méthode checkIfUsernameExists(). S'il existe j'informe l'utilisateur
     * que ce nom d'utilisateur est déjà réservé.
    */
    if (!empty($_POST['username'])) {
        if (preg_match($regex['username'], $_POST['username'])) {
            $users->username = strtoupper($_POST['username']);
            if ($users->checkIfUsernameExists() > 0) {
                $formErrors['username'] = EXISTING_USERNAME;
            }
        } else {
            $formErrors['username'] = INVALID_USERNAME;
        }
    } else {
        $formErrors['username'] = EMPTY_USERNAME;
    }
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
    
    //Si mon champs password n'existe pas ou qu'il existe mais qu'il est vide, alors j'informe l'utilisateur que le champs est obligatoire 
    if (!isset($_POST['password']) || empty($_POST['password'])) {
        $formErrors['password'] = EMPTY_PASSWORD;
    }

    //Si le champs confirmPassword n'existe pas ou qu'il existe mais qu'il est vide, alors j'informe l'utilisateur que le champs est obligatoire 
    if (!isset($_POST['confirmPassword']) || empty($_POST['confirmPassword'])) {
        $formErrors['confirmPassword'] = EMPTY_PASSWORD;
    }

    /**
     * S'il n'existe aucunes erreurs liées à mon champs password et confirmPassword, je vérifie si le contenu de mes champs password
     * et confirmPassword sont identiques. S'ils le sont, je stocke son contenu dans l'attribut 'password' de ma classe 'users'.
     * S'ils ne le sont pas, on informe l'utilisateur que les 2 champs sont différents
     */
    if (!isset($formErrors['password']) && !isset($formErrors['confirmPassword'])) {
        if ($_POST['password'] === $_POST['confirmPassword']) {
            //password_hash est une fonction PHP qui permet de hacher le mote de passe
            $users->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        } else {
            $formErrors['password'] = $formErrors['confirmPassword'] = INVALID_PASSWORD;
        }
    }
    /**
     * S'il n'y a aucune erreurs trouvées, je vérifie si ma méthode addUser() renvoie true et qu'elle insère dans la bdd. 
     * Si elle l'est, je stocke un message de succès dans ma variable 'success' qui s'affichera dans ma vue si la méthode s'est bien executée.
     * Si elle ne l'est pas, je stocke un message d'erreur qui sera affiché dans la vue pour indiquer qu'une erreur est survenue.
     */
    if (count($formErrors) == 0) {
        if ($users->addUser()) {
            $success = 'Votre compte a bien été créé.';
        } else {
            $formErrors['db'] = 'Une erreur est survenue.';
        }
    }
}

