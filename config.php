<?php
//On déclare ici des contantes avec leur nom et leur contenu dans les paramètre. Va nous servir à afficher les msg d'erreur dans les small du champs
define('EMPTY_USERNAME', 'Le nom d\'utilisateur est obligatoire.');
define('INVALID_USERNAME', 'Le nom d\'utilisateur doit faire entre 3 et 50 caractère et ne peut contenir que des chiffres et des lettres.');
define('EXISTING_USERNAME', 'Cet identifiant existe déjà.');

define('INVALID_LOGIN', 'Le nom d\'utilisateur ou le mot de passe est incorrect.');

define('EMPTY_PASSWORD', 'Le mot de passe est obligatoire.');
define('INVALID_PASSWORD', 'Les mots de passe ne sont pas identiques.');

define('EMPTY_BIRTHDATE', 'La date de naissance est obligatoire.');
define('INVALID_BIRTHDATE', 'La date de naissance est incorrecte.');

define('EMPTY_MAIL', 'L\'adresse mail est obligatoire.');
define('INVALID_MAIL', 'L\'adresse mail est incorrecte.');

define('EMPTY_POSTER', 'L\'affiche est obligatoire.');
define('INVALID_POSTER', 'L\'affiche n\'est pas au bon format : png, jpeg, jpg, gif uniquement.');

define('EMPTY_CREATORS', 'Les créateurs sont obligatoires.');
define('INVALID_CREATORS', 'Le champs créateurs est incorrect.');

define('EMPTY_ACTORS', 'Les acteurs sont obligatoires.');
define('INVALID_ACTORS', 'Le champs acteurs est incorrect.');

define('EMPTY_TITLE', 'Le titre est obligatoire.');

define('EMPTY_SYNOPSIS', 'Le synopsis est obligatoire.');

define('EMPTY_YEAR', 'Veuillez sélectioner une année.');

define('EMPTY_ARTICLE_TITLE', 'Le titre de l\'article est obligatoire.');

define('EMPTY_ARTICLE_CONTENT','Le contenu de l\'article est obligatoire.');

define('EMPTY_ARTICLE_CATEGORY', 'La catégorie d\'article est obligatoire.');

define('INVALID_ARTICLE_PHOTO', 'La photo n\'est pas au bon format : png, jpeg, jpg, gif uniquement.');
define('EMPTY_ARTICLE_PHOTO', 'La photo d\'article est obligatoire.'); 

define('EMPTY_SERIES_STATUS', 'Le statut de la série est obligatoire.');

define('EMPTY_ARTICLE_COMMENT_CONTENT', 'Votre commentaire ne peut être vide.');

define('LOGGED_OUT', 'Vous devez être connecté afin de pouvoir commenter.');

define('EMPTY_SELECTED_SERIES', 'Vous devez sélectionner au moins une série.');

define('EMPTY_SERIES_GENRES', 'Vous devez sélectionner 1 ou plusieurs genres.');

define ('EMPTY_SERIES_ACTORS', 'Vous devez sélectionner 1 ou plusieurs acteurs.');

define ('EMPTY_ACTOR', 'Le nom de l\'acteur est obligatoire.');
define ('INVALID_ACTOR', 'Le nom de l\'acteur est incorrect.');

define('EMPTY_SEARCH', 'Vous devez entrer le titre d\'une série.');

define('EMPTY_SEASONS', 'Le nombre de saisons est obligatoire.');

define('EMPTY_PROGRESS', 'Vous devez séléctionner une saison. ');

$regex = [
    'username' => '/^[a-zA-Z0-9]{3,50}$/',
    'id' => '/^[1-9][0-9]*$/',
    'actors' => '/^[a-zA-ZÀ-ÿ0-9 \, \-\'\.\(\)]{3,255}$/',
    'seriesActor' => '/^[a-zA-ZÀ-ÿ0-9 \-\'\.\(\)]{2,100}$/'
]; // les regexs sont stockées ici pour être utilisées dans le fichier addPatientController