<?php
//J'instancie mes objets
//Je met ceux là en dehors de ma grande boucle car j'ai besoin d'afficher certaines informations tirées de ces tables
$status = new status();
$statusList = $status->getStatusList();

$seriesGenres = new seriesGenres();
$seriesGenresList = $seriesGenres->getseriesGenresList();

$actors = new actors();
$actorsList = $actors->getActorsList();

if (count($_POST) > 0) {

    //J'appelle mes classes, j'instancie mes objets
    $series = new series();
    $seriesHaveGenres = new seriesHaveGenres();
    $seriesHaveActors = new seriesHaveActors();
    $seasons = new seasons();

    // J'initialise mon tableau formErrors qui contiendra tous mes messages d'erreurs
    $formErrors = [];

    if (!empty($_POST['title'])) {
        $series->title = htmlspecialchars(strtoupper($_POST['title']));
    } else {
        $formErrors['title'] = EMPTY_TITLE;
    }

    if (!empty($_POST['synopsis'])) {
        $series->synopsis = htmlspecialchars($_POST['synopsis']);
    } else {
        $formErrors['synopsis'] = EMPTY_SYNOPSIS;
    }

    if (!empty($_POST['creators'])) {
        if (preg_match($regex['actors'], $_POST['creators'])) {
            $series->creators = strtoupper($_POST['creators']);
        } else {
            $formErrors['creators'] = INVALID_CREATORS;
        }
    } else {
        $formErrors['creators'] = EMPTY_CREATORS;
    }
    
    if (!empty($_POST['year'])) {
        $series->year = $_POST['year'];
    } else {
        $formErrors['year'] = EMPTY_YEAR;
    }

    /**
     * Le tableau super global $_FILES se remplit dès que l'on envoie un fichier. Il crée alors une entrée ['nomDuFichier'] qui devient elle-même un tableau.
     * Ce nouveau tableau ($_FILES['nomDuFichier']) contient des informations très utiles comme le nom du fichier, sa taille et s'il y a eu une erreur lors de l'upload
     * Conseil : Pensez au var_dump, il permet de visualiser une variable ou un tableau
     */

    if ($_FILES['poster']['error'] == 0) {
        $posterExtension = strtolower(pathinfo($_FILES['poster']['name'])['extension']);
        $authorizedExtensions = ['png', 'jpeg', 'jpg', 'gif'];

        if (in_array($posterExtension, $authorizedExtensions)) {
            if (move_uploaded_file($_FILES['poster']['tmp_name'], 'assets/uploads/Series/' . $_FILES['poster']['name'])) {
                chmod('assets/uploads/Series/' . $_FILES['poster']['name'], 0644);
                $series->photo = 'assets/uploads/Series/' . $_FILES['poster']['name'];
            } else {
                $formErrors['poster'] = 'Une erreur est survenue lors de l\'envoi.';
            }
        } else {
            $formErrors['poster'] = INVALID_POSTER;
        }
    } else {
        $formErrors['poster'] = EMPTY_POSTER;
    }

    if(!empty($_POST['seriesStatus'])) {
        $series->idStatus = $_POST['seriesStatus'];
    } else {
        $formErrors['seriesStatus'] = EMPTY_SERIES_STATUS;
    }

    if(!empty($_POST['seasons'])) {
        //Je stocke dans une variable seasonsNumber, la valeur correspondant à l'option choisie dans mon select
        $seasonsNumber = $_POST['seasons'];
    } else {
        $formErrors['seasons'] = EMPTY_SEASONS;
    }

    if(!empty($_POST['seriesGenres'])){
        //Je stocke dans une variable les éléments sélectionnés dans cet input qui ici me renvoie un tableau
        $seriesGenres = $_POST['seriesGenres'];
    }else{
        $formErrors['seriesGenres'] = EMPTY_SERIES_GENRES;
    }

    if(!empty($_POST['actors'])){
        //Je stocke dans une variable les éléments sélectionnés dans cet input qui ici me renvoie un tableau
        $seriesActors = $_POST['actors'];
    }else{
        $formErrors['actors'] = EMPTY_SERIES_ACTORS;
    }

    //Si aucune erreur n'est trouvée
    if(count($formErrors) == 0){
        //Active un mode qui vérifie si une erreur a eu lieu
        //On utilise ici la table series car c'est elle dont les autres tables sont dépendantes
        $series->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //On lui demande d'essayer ce qui suit
        try {
            //Dis au PHP que je démarre la transaction dans ma base de donnée sur ma classe series
            $series->db->beginTransaction();
            //Je lance ma méthode pour l'ajout de série
            $addSeries = $series->addSeries();
            //Je stocke dans l'attribut idSeries de la table seriesHaveGenres
            //Ainsi que dans l'attribut idSeries de la table seriesHaveActors, l'id de la série que j'ajoute juste au dessus
            $seriesHaveGenres->idSeries = $seriesHaveActors->idSeries = $seasons->idSeries = $series->db->lastInsertId();

            //Etant donné que mon checkbox est un tableau, je dois faire un foreach pour récupérer les infos de chaque cases cochées
            foreach ($seriesGenres as $genres){
                //Je stocke dans l'attribut idseriesGenres de la table seriesHaveGenres, l'id récupéré dans les "value" de mes checkbox
                $seriesHaveGenres->idSeriesGenres = $genres;
                //Je lance ma méthode pour remplir ma table seriesHaveGenres
                $seriesHaveGenres->addGenreToSeries();
            }

            //Etant donné que mon checkbox est un tableau, je dois faire un foreach pour récupérer les infos de chaque cases cochées            
            foreach($seriesActors as $actors){
                //Je stocke dans l'attribut idActors de la table seriesHaveActors, l'id récupéré dans mes checkbox
                $seriesHaveActors->idActors = $actors;
                //Je lance ma méthode pour remplir ma table seriesHaveActors
                $seriesHaveActors->addActorsToSeries();
            }

            //je fais une boucle allant de 1 jusqu'au nombre de saisons selectionné dans le select de ma vue
            for($SeriesSeasons = 1; $SeriesSeasons <= $seasonsNumber; $SeriesSeasons++){
                //Je stocke dans l'attribut seasonNumber de ma classe seasons, la value récupéré dans mon select
                $seasons->seasonNumber = $SeriesSeasons;
                //Je lance ma méthode pour ajouter la saison
                $seasons->addSeason();
            }

            //Si tout s'est bien passé, valide la transaction et l'inscrit dans la bdd
            $series->db->commit();
        } catch (PDOException $error) {
            //Si la transation attrape une erreur, retire ce qui vient d'être entré dans la bdd
            $series->db->rollBack();
            die ($error->getMessage());
        }
    }
}