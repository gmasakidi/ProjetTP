<?php

//Si l'utilisateur n'est pas administrateur, alors il est redirigé vers l'index. S'il n'est pas connecté, il est également redirigé
if(isset($_SESSION['idRoles'])){
    if($_SESSION['idRoles'] != 1){
        header('location:index.php');
        exit;
    }
}else{
    header('location:index.php');
    exit;
}