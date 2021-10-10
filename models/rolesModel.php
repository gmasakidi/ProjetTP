<?php
/**
 * On crée une classe users qui hérite de la classe database
 * On pourra accéder à tous les attributs et toutes les méthodes protégées de database
 */
class roles extends database{
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

    public function getUsersRoleList() {
        $query = 'SELECT id, name    
        FROM f5e2_roles';
        //On lance la méthode query qui contient notre requête qu'on lui donne en paramètre
        $queryExecute = $this->db->query($query);
        //On utilise le fetchAll ici car on veut prendre toutes les lignes de la table user
        $queryResult = $queryExecute->fetchAll(PDO::FETCH_OBJ);
        //On retourne le queryResult qui nous renvoie un tableau suite à l'éxecution de notre requête
        return $queryResult;
    }
}