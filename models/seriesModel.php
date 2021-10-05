<?php

/**
 * On crée une classe series qui hérite de la classe database
 * On pourra accéder à tous les attributs et toutes les méthodes protégées de database
 */
class series extends database {
    // On utilise le "protected" pour faire en sorte que la classe patients hérite bien de la classe database
    //Je le met ici en public car j'utilise le singleton
    public $db = NULL;
    // Création des attributs qui permettront de stocker les données, on leur donne une valeur par défaut
    public $id = 0;
    public $title = '';
    public $synopsis = '';
    public $creators = '';
    public $year = 1970;
    public $photo = '';
    public $idStatus = 0;


    /**
     * Ici la méthode magique __costruct assure la connexion à la base de donnée en appellant la méthode construct du parent "database" 
     * qui elle contient l'objet PDO et la phrase de connexion à la base de donnée.
     * Le construct se déclenche au moment où on instancie notre objet dans le controller.
     * Le db de users devient égal au retour de database, pour éviter qu'il se reconnecte plusieurs fois.
     */
    public function __construct()
    {
        $this->db = parent::getInstance();
    }

    public function addSeries()
    {
        //Ici les ":" indiquent que ce sont des marqueurs nominatifs, ces valeurs sont vides, on prépare l'entrée de future données,
        $query = 'INSERT INTO f5e2_series (title, synopsis, creators, year, photo, idStatus)
        VALUES (:title, :synopsis, :creators, :year, :photo, :idStatus)';
        //On utilise prepare lorsque l'on a des marqueurs nominatifs, mais elle n'execute pas la requete directement contrairement à query
        $queryExecute = $this->db->prepare($query);
        //Le bindvalue va attribuer les données aux marqueurs nominatifs
        //Le PARAM_STR va dire à la base de donnée de changer la valeur stockée en string. C'est une sécurité pour empêcher les attaques aux requêtes SQL.
        $queryExecute->bindValue(':title', $this->title, PDO::PARAM_STR);
        $queryExecute->bindValue(':synopsis', $this->synopsis, PDO::PARAM_STR);
        $queryExecute->bindValue(':creators', $this->creators, PDO::PARAM_STR);
        $queryExecute->bindValue(':year', $this->year, PDO::PARAM_INT);
        $queryExecute->bindValue(':photo', $this->photo, PDO::PARAM_STR);
        $queryExecute->bindValue(':idStatus', $this->idStatus, PDO::PARAM_INT);
        //L'execute va éxécuter la requête préparée avec les valeurs données dans le bindvalue qui elles seront tirées de nos inputs
        //On retourne l'execute qui nous renvoi ici true ou false (booléan) car cette méthode ne nous permet pas de récuperer des infos (fetch ou fetch all --> le return nous renverrait alors un tableau)
        return $queryExecute->execute();
    }

    //Permet de récupérer la liste des articles dans la base de donnée ainsi que leur catégorie
    public function getSeriesList()
    {
        $query = 'SELECT f5e2_series.id AS id, f5e2_series.title as title, f5e2_series.synopsis AS synopsis, f5e2_series.creators AS creators, f5e2_series.year AS year, f5e2_status.status AS status, f5e2_series.photo AS photo
            FROM f5e2_series
            INNER JOIN f5e2_status
            ON f5e2_series.idStatus = f5e2_status.id';
        $queryExecute = $this->db->query($query);
        //Ici le fetchAll est utilisé car on veut prendre toutes les lignes correspondant à cette requête
        //Cette méthode me renvoie donc un array
        $queryResult = $queryExecute->fetchAll(PDO::FETCH_OBJ);
        return $queryResult;
    }

    //La méthode checkIfUserExists permet de vérifier si un utilisateur existe dans la bdd
    public function checkIfSeriesExists()
    {
        $query = 'SELECT COUNT(id) AS count
            FROM f5e2_series
            WHERE id = :id';
        $queryExecute = $this->db->prepare($query);
        $queryExecute->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryExecute->execute();
        return $queryExecute->fetch(PDO::FETCH_OBJ);
    }

    public function getSeriesDetails()
    {
        // Ici les ":" indiquent que ce sont des marqueurs nominatifs, ces valeurs sont vides, on prépare l'entrée de future données, 
        // Le PARAM_STR va dire à la base de donnée de changer la valeur stockée en string. C'est une sécurité pour empêcher les attaques aux requêtes SQL.
        $query = 'SELECT f5e2_series.id AS id, f5e2_series.title as title, f5e2_series.synopsis AS synopsis, f5e2_series.creators AS creators, f5e2_series.year AS year, f5e2_status.status AS status, f5e2_series.photo AS photo
            FROM f5e2_series
            INNER JOIN f5e2_status
            ON f5e2_series.idStatus = f5e2_status.id
            WHERE f5e2_series.id = :id';
        $queryExecute = $this->db->prepare($query);
        $queryExecute->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryExecute->execute();
        //On utilise ici le 'fetch' car on ne cherche à prendre qu'une seule ligne, celle où l'id correspond
        return $queryExecute->fetch(PDO::FETCH_OBJ);
    }

    //Permet de modifier un article dans la base de donnée ainsi que leur catégorie
    public function updateSeries()
    {
        $query = 'UPDATE f5e2_series 
            SET title = :title, synopsis = :synopsis, creators = :creators, year = :year, photo = :photo, idStatus = :idStatus
            WHERE id = :id';
        $queryExecute = $this->db->prepare($query);
        $queryExecute->bindValue(':title', $this->title, PDO::PARAM_STR);
        $queryExecute->bindValue(':synopsis', $this->synopsis, PDO::PARAM_STR);
        $queryExecute->bindValue(':creators', $this->creators, PDO::PARAM_STR);
        $queryExecute->bindValue(':year', $this->year, PDO::PARAM_INT);
        $queryExecute->bindValue(':photo', $this->photo, PDO::PARAM_STR);
        $queryExecute->bindValue(':idStatus', $this->idStatus, PDO::PARAM_INT);
        $queryExecute->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryExecute->execute();
    }

    public function deleteSeries()
    {
        $query = 'DELETE FROM f5e2_series
            WHERE id = :id';
        $queryExecute = $this->db->prepare($query);
        $queryExecute->bindValue(':id', $this->id, PDO::PARAM_INT);
        //On nous retourne ici un booléen     
        return $queryExecute->execute();
    }

    public function getSeriesResults($search = '')
    {
        $query = 'SELECT id, title, synopsis
        FROM f5e2_series
        ';
        if (!empty($search)) {
            // ici on compare :search a lastname et firstname puis on retourne les resultat qui correspond
            $query .= 'WHERE title LIKE :search';
            // on fait prepare($query) car on recupere une valeur pour apres la comparé a notre DB
            $queryExecute = $this->db->prepare($query);
            $queryExecute->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
            $queryExecute->execute();
        } else {
            $queryExecute = $this->db->query($query);
            $queryExecute->execute();
        }

        // le $this est l'objet qui appelle la methode , le db est l'attribut créé plus haut qui contient notre objet PDO 
        // le query() est une methode de PHP qui permet d'executer une requete SQL 
        $queryResult = $queryExecute->fetchAll(PDO::FETCH_OBJ);
        // fetchAll est une methode de l'objet "queryExecute"  permettant de recupere plusieur ligne
        return $queryResult;
    }
}