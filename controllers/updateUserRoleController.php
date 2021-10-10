<?php

//J'instancie mes objet
$users = new users();
$roles = new roles();

//Si l'utilisateur n'est pas administrateur, alors il est redirigé vers l'index. S'il n'est pas connecté, il est également redirigé
//Protection pour empêcher tout utilisateur autre que l'administrateur d'avoir accès à ces infos
if (isset($_SESSION['idRoles'])) {
    if ($_SESSION['idRoles'] != 1) {
        header('location:index.php');
        exit;
    } else {
        //Si je suis bien admin, je vérifie si le paramètre d'url id existe et n'est pas vide
        if (!empty($_GET['id'])) {
            //Je stocke dans l'attribut id
            $users->id = $_GET['id'];
            //Je stocke dans la variable check le retour de la méthode checkIfUserExists
            $check = $users->checkIfUserExists();
            //Si l'utilisateur n'existe pas, je renvoi vers la liste des utilisateurs
            if ($check->count == 0) {
                header('location:usersList.php');
                exit;
            } else {
                //J'appelle les méthodes me permettant l'affichage des données
                $usersInformations = $users->getUserProfile();
            }
        } else {
            header('location:usersList.php');
            exit;
        }
    }
} else {
    header('location:index.php');
    exit;
}

//J'appelle les méthodes me permettant l'affichage des données
$usersRoleList = $roles->getUsersRoleList();

if (isset($_POST['selectUserRoleButton'])) {
    //J'initialise mon tableau formErrors qui stockera mon message d'erreur
    $formErrors = [];

    if (!empty($_POST['userRole'])) {
        //Je stocke dans l'attribue idRoles de ma classe users, la value de l'élément selectionné dans ma vue (l'id de du role)
        $users->idRoles = $_POST['userRole'];
    } else {
        $formErrors['userRole'] = EMPTY_USER_ROLE;
    }

    //Si aucune erreur n'est trouvée, je modifie le rôle
    if (count($formErrors) == 0) {
        $users->updateUserRole();
    }
}

