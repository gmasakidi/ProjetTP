<?php
/**
 * On crée une classe users qui hérite de la classe database
 * On pourra accéder à tous les attributs et toutes les méthodes protégées de database
 */
class seriesGenres extends database {
    // On utilise le "protected" pour faire en sorte que la classe patients hérite bien de la classe database
    public $db = NULL; 
    // Création des attributs qui permettront de stocker les données, on leur donne une valeur par défaut
    public $id = 0;
    public $name = '';

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

    public function getSeriesGenresList(){
        $query = 'SELECT  id, name
        FROM f5e2_seriesgenres';
        $queryExecute = $this->db->query($query);
        //Ici le fetchAll est utilisé car on veut prendre toutes les lignes correspondant à cette requête
        //Cette méthode me renvoie donc un array
        $queryResult = $queryExecute->fetchAll(PDO::FETCH_OBJ);
        return $queryResult;
    }
}