<?php

/**
 * On crée une classe series qui hérite de la classe database
 * On pourra accéder à tous les attributs et toutes les méthodes protégées de database
 */
class seriesComments extends database{
    // On utilise le "protected" pour faire en sorte que la classe seriescomments hérite bien de la classe database
    public $db = NULL; 
    // Création des attributs qui permettront de stocker les données, on leur donne une valeur par défaut
    public $id = 0;
    public $content = '';
    public $date = '';
    public $rate = 0;
    public $idUsers = '';
    public $idSeries = 0;
    public $idSeasons = '';


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

    public function addSeriesComment() {
        //Ici les ":" indiquent que ce sont des marqueurs nominatifs, ces valeurs sont vides, on prépare l'entrée de future données,
        $query = 'INSERT INTO f5e2_seriescomments (content, date, rate, idUsers, idSeries, idSeasons)
        VALUES (:content, NOW(), :rate, :idUsers, :idSeries, :idSeasons)';
        //On utilise prepare lorsque l'on a des marqueurs nominatifs, mais elle n'execute pas la requete directement contrairement à query
        $queryExecute = $this->db->prepare($query);
        //Le bindvalue va attribuer les données aux marqueurs nominatifs
        //Le PARAM_STR va dire à la base de donnée de changer la valeur stockée en string. C'est une sécurité pour empêcher les attaques aux requêtes SQL.
        $queryExecute->bindValue(':content', $this->content, PDO::PARAM_STR);
        $queryExecute->bindValue(':rate', $this->rate, PDO::PARAM_INT);
        $queryExecute->bindValue(':idUsers', $this->idUsers, PDO::PARAM_INT);
        $queryExecute->bindValue(':idSeries', $this->idSeries, PDO::PARAM_INT);
        $queryExecute->bindValue(':idSeasons', $this->idSeasons, PDO::PARAM_INT);
        //L'execute va éxécuter la requête préparée avec les valeurs données dans le bindvalue qui elles seront tirées de nos inputs
        //On retourne l'execute qui nous renvoi ici true ou false (booléan) car cette méthode ne nous permet pas de récuperer des infos (fetch ou fetch all --> le return nous renverrait alors un tableau)
        return $queryExecute->execute();
    }

    public function getCommentsBySeries() {
        // Ici les ":" indiquent que ce sont des marqueurs nominatifs, ces valeurs sont vides, on prépare l'entrée de future données, 
        // Le PARAM_STR va dire à la base de donnée de changer la valeur stockée en string. C'est une sécurité pour empêcher les attaques aux requêtes SQL.
        $query = 'SELECT f5e2_seriescomments.id AS id, f5e2_seriescomments.content AS content, f5e2_seriescomments.rate AS rate, f5e2_seriescomments.date AS date, DATE_FORMAT(date, "%d/%m/%Y à %Hh%i") AS datefr, f5e2_users.username AS username, f5e2_seriescomments.idUsers
        FROM f5e2_seriescomments
        INNER JOIN f5e2_users
        ON f5e2_seriescomments.idUsers = f5e2_users.id
        WHERE f5e2_seriescomments.idSeries = :id'; 
        $queryExecute = $this->db->prepare($query);
        //Je lie l'id que je trouve en paramètre d'URL à l'idArticles de ma table
        $queryExecute->bindValue(':id', $this->idSeries, PDO::PARAM_INT);
        $queryExecute->execute();
        return $queryExecute->fetchAll(PDO::FETCH_OBJ);
    }

    public function deleteArticleComment() {
        $query = 'DELETE FROM f5e2_seriescomments
        WHERE id = :id';
        $queryExecute = $this->db->prepare($query);
        $queryExecute->bindValue(':id', $this->id, PDO::PARAM_INT);   
        //On nous retourne ici un booléen     
        return $queryExecute->execute();
    }
}