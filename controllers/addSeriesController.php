<?php

if(count($_POST) > 0) {
    /**
     * Le tableau super global $_FILES se remplit dès que l'on envoie un fichier. Il crée alors une entrée ['nomDuFichier'] qui devient elle-même un tableau.
     * Ce nouveau tableau ($_FILES['nomDuFichier']) contient des informations très utiles comme le nom du fichier, sa taille et s'il y a eu une erreur lors de l'upload
     * Conseil : Pensez au var_dump, il permet de visualiser une variable ou un tableau
     */
    if ($_FILES['photo']['error'] == 0) {
        $photoExtension = strtolower(pathinfo($_FILES['photo']['name'])['extension']);
        $authorizedExtensions = ['png', 'jpeg', 'jpg', 'gif'];
        $authorizedMimeTypes = [
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'gif' => 'image/gif'
        ];

        if (in_array($photoExtension, $authorizedExtensions) && mime_content_type($_FILES['photo']['tmp_name']) == $authorizedMimeTypes[$photoExtension]) {
            if (move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/' . $_FILES['photo']['name'])) {
                chmod('uploads/' . $_FILES['photo']['name'], 0644);
                $series->photo = 'uploads/' . $_FILES['photo']['name'];
            } else {
                $formErrors['photo'] = 'Une erreur est survenue';
            }
        } else {
            $formErrors['photo'] = INVALID_PHOTO;
        }
    } else {
        $formErrors['photo'] = EMPTY_PHOTO;
    }
}