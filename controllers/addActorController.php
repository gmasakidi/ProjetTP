<?php 

$actors = new actors();

if(count($_POST) > 0){
    $formErrors = [];
    if(!empty($_POST['actor'])){
        $actors->name = htmlspecialchars($_POST['actor']);
    }else{

    }
}