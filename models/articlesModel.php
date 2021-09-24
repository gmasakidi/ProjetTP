<?php

class articles extends database {
    // On utilise le "protected" pour faire en sorte que la classe patients hérite bien de la classe database
    public $db = NULL;
    // Création des attributs qui permettront de stocker les données, on leur donne une valeur par défaut
    public $id = 0;
    public $title = '';
    public $content = '';
    public $date = '01/01/1970';
    public $photo = '';
    public $idCategories = '';
    public $datefr = '';

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

    public function addArticle() {
        //Ici les ":" indiquent que ce sont des marqueurs nominatifs, ces valeurs sont vides, on prépare l'entrée de future données,
        $query = 'INSERT INTO f5e2_articles (title, content, date, photo, idCategories)
        VALUES (:title, :content, NOW(), :photo, :idCategories)';
        //On utilise prepare lorsque l'on a des marqueurs nominatifs, mais elle n'execute pas la requete directement contrairement à query
        $queryExecute = $this->db->prepare($query);
        //Le bindvalue va attribuer les données aux marqueurs nominatifs
        //Le PARAM_STR va dire à la base de donnée de changer la valeur stockée en string. C'est une sécurité pour empêcher les attaques aux requêtes SQL.
        $queryExecute->bindValue(':title', $this->title, PDO::PARAM_STR);
        $queryExecute->bindValue(':content', $this->content, PDO::PARAM_STR);
        $queryExecute->bindValue(':photo', $this->photo, PDO::PARAM_STR);
        $queryExecute->bindValue(':idCategories', $this->idCategories, PDO::PARAM_STR);
        //L'execute va éxécuter la requête préparée avec les valeurs données dans le bindvalue qui elles seront tirées de nos inputs
        //On retourne l'execute qui nous renvoi ici true ou false (booléan) car cette méthode ne nous permet pas de récuperer des infos (fetch ou fetch all --> le return nous renverrait alors un tableau)
        return $queryExecute->execute();
    }
 
    //Permet de récupérer la liste des articles dans la base de donnée ainsi que leur catégorie
    public function getArticlesList(){
        $query = 'SELECT f5e2_articles.id AS id, f5e2_articles.date as date, f5e2_articles.title AS title, f5e2_articles.content AS content, f5e2_articles.photo AS photo, f5e2_categories.name AS category, DATE_FORMAT(date, "%d/%m/%Y à %Hh%i") as datefr
        FROM f5e2_articles
        INNER JOIN f5e2_categories
        ON f5e2_articles.idCategories = f5e2_categories.id';
        $queryExecute = $this->db->query($query);
        //Ici le fetchAll est utilisé car on veut prendre toutes les lignes correspondant à cette requête
        //Cette méthode me renvoie donc un array
        $queryResult = $queryExecute->fetchAll(PDO::FETCH_OBJ);
        return $queryResult;
    }

    //La méthode checkIfUserExists permet de vérifier si un utilisateur existe dans la bdd
    public function checkIfArticleExists()
    {
        $query = 'SELECT COUNT(id) AS count
        FROM f5e2_articles
        WHERE id = :id';
        $queryExecute = $this->db->prepare($query);
        $queryExecute->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryExecute->execute();
        return $queryExecute->fetch(PDO::FETCH_OBJ);
    }

    public function getArticleDetails() {
        // Ici les ":" indiquent que ce sont des marqueurs nominatifs, ces valeurs sont vides, on prépare l'entrée de future données, 
        // Le PARAM_STR va dire à la base de donnée de changer la valeur stockée en string. C'est une sécurité pour empêcher les attaques aux requêtes SQL.
        $query = 'SELECT f5e2_articles.id AS id, 
        f5e2_articles.date As date, 
        f5e2_articles.title AS title, 
        f5e2_articles.content AS content, 
        f5e2_articles.photo AS photo, 
        f5e2_categories.name AS category, 
        DATE_FORMAT(date, "%d/%m/%Y à %Hh%i") AS datefr
        FROM f5e2_articles
        INNER JOIN f5e2_categories
        ON f5e2_articles.idCategories = f5e2_categories.id
        WHERE f5e2_articles.id = :id';
        $queryExecute = $this->db->prepare($query);
        $queryExecute->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryExecute->execute();
        //On utilise ici le 'fetch' car on ne cherche à prendre qu'une seule ligne, celle où l'id correspond
        return $queryExecute->fetch(PDO::FETCH_OBJ);
    }

    //Permet de modifier un article dans la base de donnée ainsi que leur catégorie
    public function updateArticle() {
        $query = 'UPDATE f5e2_articles 
        SET title = :title, content = :content, photo = :photo, idCategories = :idCategories
        WHERE id = :id';
        $queryExecute = $this->db->prepare($query);
        $queryExecute->bindValue(':title', $this->title, PDO::PARAM_STR);
        $queryExecute->bindValue(':content', $this->content, PDO::PARAM_STR);
        $queryExecute->bindValue(':photo', $this->photo, PDO::PARAM_STR);
        $queryExecute->bindValue(':idCategories', $this->idCategories, PDO::PARAM_INT);
        $queryExecute->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryExecute->execute();
    }

    public function deleteArticle() {
        $query = 'DELETE FROM f5e2_articles
        WHERE id = :id';
        $queryExecute = $this->db->prepare($query);
        $queryExecute->bindValue(':id', $this->id, PDO::PARAM_INT);   
        //On nous retourne ici un booléen     
        return $queryExecute->execute();
    }
}
