<?php

//J'instancie mon objet
$actors = new actors();

//J'initialise mon tableau formErrors qui contiendra mes messages d'erreurs
$formErrors = [];

//Quand j'envoie mon formulaire - nécessaire ici malgré un unique input car sinon mon message d'erreur se lance par défaut dans ma vue
if(count($_POST) > 0){
    if (!empty($_POST['actor'])) {
        if (preg_match($regex['seriesActor'], $_POST['actor'])) {
            //La regex est déjà suffisante pour sécuriser ce champs, mais j'ajoute une seconde sécurité avec le htmlspecialchars
            $actors->name = htmlspecialchars($_POST['actor']);
        } else {
            $formErrors['actor'] = INVALID_ACTOR;
        }
    } else {
        $formErrors['actor'] = EMPTY_ACTOR;
    }
    
    if(count($formErrors) == 0){
        $actors->addActor();
    }
}