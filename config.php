<?php
//On déclare ici des contantes avec leur nom et leur contenu dans les paramètre. Va nous servir à afficher les msg d'erreur dans les small du champs
define('EMPTY_USERNAME', 'Le nom d\'utilisateur est obligatoire.');
define('INVALID_USERNAME', 'Le nom d\'utilisateur doit faire entre 3 et 50 caractère et ne peut contenir que des chiffres et des lettres.');
define('EXISTING_USERNAME', 'Cet identifiant existe déjà');

define('INVALID_LOGIN', 'Le nom d\'utilisateur ou le mot de passe est incorrect');

define('EMPTY_PASSWORD', 'Le mot de passe est obligatoire.');
define('INVALID_PASSWORD', 'Les mots de passe ne sont pas identiques.');

define('EMPTY_BIRTHDATE', 'La date de naissance est obligatoire.');
define('INVALID_BIRTHDATE', 'La date de naissance est incorrecte.');

define('EMPTY_MAIL', 'L\'adresse mail est obligatoire.');
define('INVALID_MAIL', 'L\'adresse mail est incorrecte.');

define('EMPTY_PHOTO', 'La photo est obligatoire.');
define('INVALID_PHOTO', 'La photo n\'est pas au bon format');

$regex = [
    'username' => '/^[a-zA-Z0-9]{3,50}$/',
    'birthdate' =>  '/^[0-9]{4}(-){1}((0[1-9])|(1[0-2])){1}(-){1}((0[1-9])|((1|2)[0-9])|(3[0-1]))$/',
    'id' => '/^[1-9][0-9]*$/'
]; // les regexs sont stockées ici pour être utilisées dans le fichier addPatientController