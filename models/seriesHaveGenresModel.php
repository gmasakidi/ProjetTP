<?php
/**
 * On crée une classe users qui hérite de la classe database
 * On pourra accéder à tous les attributs et toutes les méthodes protégées de database
 */
class seriesHaveGenres extends database{
    // On utilise le "protected" pour faire en sorte que la classe patients hérite bien de la classe database
    //Je le met ici en public car je vais utiliser le singleton
    public $db = NULL; 
    // Création des attributs qui permettront de stocker les données, on leur donne une valeur par défaut
    public $idSeries = 0;
    public $idSeriesGenres = 0;

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

    public function addGenreToSeries() {
        //Ici les ":" indiquent que ce sont des marqueurs nominatifs, ces valeurs sont vides, on prépare l'entrée de future données,
        $query = 'INSERT INTO f5e2_serieshavegenres (idSeries, idSeriesGenres)
        VALUES (:idSeries, :idSeriesGenres)';
        //On utilise prepare lorsque l'on a des marqueurs nominatifs, mais elle n'execute pas la requete directement contrairement à query
        $queryExecute = $this->db->prepare($query);
        //Le bindvalue va attribuer les données aux marqueurs nominatifs
        //Le PARAM_STR va dire à la base de donnée de changer la valeur stockée en string. C'est une sécurité pour empêcher les attaques aux requêtes SQL.
        $queryExecute->bindValue(':idSeries', $this->idSeries, PDO::PARAM_INT);
        $queryExecute->bindValue(':idSeriesGenres', $this->idSeriesGenres, PDO::PARAM_INT);
        //L'execute va éxécuter la requête préparée avec les valeurs données dans le bindvalue qui elles seront tirées de nos inputs
        //On retourne l'execute qui nous renvoi ici true ou false (booléan) car cette méthode ne nous permet pas de récuperer des infos (fetch ou fetch all --> le return nous renverrait alors un tableau)
        return $queryExecute->execute();
    }

    public function getGenresBySeries() {
        // Ici les ":" indiquent que ce sont des marqueurs nominatifs, ces valeurs sont vides, on prépare l'entrée de future données, 
        // Le PARAM_STR va dire à la base de donnée de changer la valeur stockée en string. C'est une sécurité pour empêcher les attaques aux requêtes SQL.
        $query = 'SELECT f5e2_seriesgenres.id AS id, f5e2_seriesgenres.name AS name
        FROM f5e2_seriesgenres
        INNER JOIN f5e2_serieshavegenres
        ON f5e2_serieshavegenres.idSeriesGenres = f5e2_seriesgenres.id
        WHERE f5e2_serieshavegenres.idSeries = :id'; 
        $queryExecute = $this->db->prepare($query);
        //Je lie l'id que je trouve en paramètre d'URL à l'idArticles de ma table
        $queryExecute->bindValue(':id', $this->idSeries, PDO::PARAM_INT);
        $queryExecute->execute();
        return $queryExecute->fetchAll(PDO::FETCH_OBJ);
    }

    public function deleteGenreToSeries() {
        $query = 'DELETE FROM f5e2_serieshavegenres
        WHERE idSeries = :idSeries';
        $queryExecute = $this->db->prepare($query);
        $queryExecute->bindValue(':idSeries', $this->idSeries, PDO::PARAM_INT);   
        //On nous retourne ici un booléen     
        return $queryExecute->execute();
    }
}