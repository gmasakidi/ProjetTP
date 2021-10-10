<?php

//J'instancie mon objet
$users = new users();

//Si l'utilisateur n'est pas administrateur, alors il est redirigé vers l'index. S'il n'est pas connecté, il est également redirigé
//Protection pour empêcher tout utilisateur autre que l'administrateur d'avoir accès à ces infos
if(isset($_SESSION['idRoles'])){
    if($_SESSION['idRoles'] != 1){
        header('location:index.php');
        exit;
    }
}else{
    header('location:index.php');
    exit;
}

$usersList = $users->getUserslist();
