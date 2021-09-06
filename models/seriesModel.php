<?php
/**
 * On crée une classe series qui hérite de la classe database
 * On pourra accéder à tous les attributs et toutes les méthodes protégées de database
 */
class series extends database {
    // On utilise le "protected" pour faire en sorte que la classe patients hérite bien de la classe database
    protected $db = NULL;
    // Création des attributs qui permettront de stocker les données, on leur donne une valeur par défaut
    public $id = 0;
    public $title = '';
    public $synopsis = '';
    public $creator = '';
    public $year = 1970;
    public $photo = '';
    public $actors = '';
    public $id_5fE2__status = 0;
    public $id_5fE2__progress = 0;

    /**
     * Ici la méthode magique __costruct assure la connexion à la base de donnée en appellant la méthode construct du parent "database" 
     * qui elle contient l'objet PDO et la phrase de connexion à la base de donnée.
     * Le construct se déclenche au moment où on instancie notre objet dans le controller.
     * Le db de users devient égal au retour de database, pour éviter qu'il se reconnecte plusieurs fois.
     */
    public function __construct()
    {
       $this->db = parent::__construct();
    }

    public function addSeries() {
        //Ici les ":" indiquent que ce sont des marqueurs nominatifs, ces valeurs sont vides, on prépare l'entrée de future données,
        $query = 'INSERT INTO 5fe2__series (title, synopsis, creator, year, photo, actors, id_5fE2__status, id_5fE2__progress)
        VALUES (:title, :synopsis, :creator, :year, :photo, :actors, id_5fE2__status, id_5fE2__progress)';
        //On utilise prepare lorsque l'on a des marqueurs nominatifs, mais elle n'execute pas la requete directement contrairement à query
        $queryExecute = $this->db->prepare($query);
        //Le bindvalue va attribuer les données aux marqueurs nominatifs
        //Le PARAM_STR va dire à la base de donnée de changer la valeur stockée en string. C'est une sécurité pour empêcher les attaques aux requêtes SQL.
        $queryExecute->bindValue(':title', $this->title, PDO::PARAM_STR);
        $queryExecute->bindValue(':synopsis', $this->synopsis, PDO::PARAM_STR);
        $queryExecute->bindValue(':creator', $this->creator, PDO::PARAM_STR);
        $queryExecute->bindValue(':year', $this->year, PDO::PARAM_INT);
        $queryExecute->bindValue(':photo', $this->photo, PDO::PARAM_STR);
        $queryExecute->bindValue(':actors', $this->actors, PDO::PARAM_STR);
        $queryExecute->bindValue(':id_5fE2__status', $this->id_5fE2__status, PDO::PARAM_INT);
        $queryExecute->bindValue(':id_5fE2__progress', $this->id_5fE2__progress, PDO::PARAM_INT);
        //L'execute va éxécuter la requête préparée avec les valeurs données dans le bindvalue qui elles seront tirées de nos inputs
        //On retourne l'execute qui nous renvoi ici true ou false (booléan) car cette méthode ne nous permet pas de récuperer des infos (fetch ou fetch all --> le return nous renverrait alors un tableau)
        return $queryExecute->execute();
    }
}