<?php
//J'instancie mon objet -j'appelle ma classe -.
$users = new users;

if(isset($_SESSION['username'])){
    $users->id = $_SESSION['id'];
    $check = $users->checkIfUserExists();
    if ($check->count == 0) {
        header('location:login.php');
        exit;
    }
}else{
    header('location:login.php');
    exit;
}

$usersProfile = $users->getUserProfile();
