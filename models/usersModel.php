<?php
/**
 * On crée une classe users qui hérite de la classe database
 * On pourra accéder à tous les attributs et toutes les méthodes protégées de database
 */
class users extends database {
    // On utilise le "protected" pour faire en sorte que la classe patients hérite bien de la classe database
    protected $db = NULL; 
    // Création des attributs qui permettront de stocker les données, on leur donne une valeur par défaut
    public $id = 0;
    public $username = '';
    public $mail = '';
    public $password = '';
    public $birthdate = '01/01/1940';
    public $photo = '';
    public $idUserRole = 0;
    public $birthdatefr = '01/01/1940';

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

    public function addUser() {
        //Ici les ":" indiquent que ce sont des marqueurs nominatifs, ces valeurs sont vides, on prépare l'entrée de future données,
        $query = 'INSERT INTO 5fe2__users (username, mail, birthdate, password)
        VALUES (:username, :mail, :birthdate, :password)';
        //On utilise prepare lorsque l'on a des marqueurs nominatifs, mais elle n'execute pas la requete directement contrairement à query
        $queryExecute = $this->db->prepare($query);
        //Le bindvalue va attribuer les données aux marqueurs nominatifs
        //Le PARAM_STR va dire à la base de donnée de changer la valeur stockée en string. C'est une sécurité pour empêcher les attaques aux requêtes SQL.
        $queryExecute->bindValue(':username', $this->username, PDO::PARAM_STR);
        $queryExecute->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $queryExecute->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $queryExecute->bindValue(':password', $this->password, PDO::PARAM_STR);
        //L'execute va éxécuter la requête préparée avec les valeurs données dans le bindvalue qui elles seront tirées de nos inputs
        //On retourne l'execute qui nous renvoi ici true ou false (booléan) car cette méthode ne nous permet pas de récuperer des infos (fetch ou fetch all --> le return nous renverrait alors un tableau)
        return $queryExecute->execute();
    }

    public function getUserslist() {
        $query = 'SELECT id, username, mail, DATE_FORMAT(birthdate, "%d/%m/%Y") AS birthdate, password
        FROM 5fe2__users';
        //On lance la méthode query qui contient notre requête qu'on lui donne en paramètre
        $queryExecute = $this->db->query($query);
        //On utilise le fetchAll ici car on veut prendre toutes les lignes de la table user
        $queryResult = $queryExecute->fetchAll(PDO::FETCH_OBJ);
        //On retourne le queryResult qui nous renvoie un tableau suite à l'éxecution de notre requête
        return $queryResult;
    }

    public function getUserProfile() {
        // Ici les ":" indiquent que ce sont des marqueurs nominatifs, ces valeurs sont vides, on prépare l'entrée de future données, 
        // Le PARAM_STR va dire à la base de donnée de changer la valeur stockée en string. C'est une sécurité pour empêcher les attaques aux requêtes SQL.
        $query = 'SELECT id, username, mail, DATE_FORMAT(birthdate, "%d/%m/%Y") AS birthdatefr, birthdate
        FROM 5fe2__users
        WHERE id = :id'; 
        $queryExecute = $this->db->prepare($query);
        $queryExecute->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryExecute->execute();
        //On utilise ici le fetch à la place du fetchAll car on cherche à prendre une seule ligne : celle où l'id correspond à la future entrée (':id')
        return $queryExecute->fetch(PDO::FETCH_OBJ);
    }

    public function updateUserProfile() {
        $query = 'UPDATE 5fe2__users 
        SET username = :username, mail = :mail, birthdate = :birthdate, password = :password
        WHERE id=:id'; 
        $queryExecute = $this->db->prepare($query);
        $queryExecute->bindValue(':username', $this->username, PDO::PARAM_STR);
        $queryExecute->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $queryExecute->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $queryExecute->bindValue(':password', $this->password, PDO::PARAM_STR);
        $queryExecute->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryExecute->execute();
    }

    public function updateUserMail() {
        $query = 'UPDATE 5fe2__users 
        SET mail = :mail
        WHERE id=:id'; 
        $queryExecute = $this->db->prepare($query);
        $queryExecute->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $queryExecute->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryExecute->execute();
    }

    public function deleteUser() {
        $query = 'DELETE FROM 5fe2__users
        WHERE id = :id';
        $queryExecute = $this->db->prepare($query);
        $queryExecute->bindValue(':id', $this->id, PDO::PARAM_INT);   
        //On nous retourne ici un booléen     
        return $queryExecute->execute();
    }

    public function getHashByUsername()
    {
        $query = 'SELECT password 
        FROM 5fe2__users
        WHERE username = :username';
        $queryExecute = $this->db->prepare($query);
        $queryExecute->bindValue(':username', $this->username, PDO::PARAM_STR);
        $queryExecute->execute();
        return $queryExecute->fetch(PDO::FETCH_OBJ);
    }

    public function getUsersInformations()
    {
        $query = 'SELECT id, idUserRole
        FROM 5fe2__users
        WHERE username = :username';
        $queryExecute = $this->db->prepare($query);
        $queryExecute->bindValue(':username', $this->username, PDO::PARAM_STR);
        $queryExecute->execute();
        $queryResult = $queryExecute->fetch(PDO::FETCH_OBJ);
        $this->id = $queryResult->id;
        $this->idUserRole = $queryResult->idUserRole;
        return true;
    }

    //La méthode checkIfUsernameExists permet de savoir si un nom d'utilisateur existe déjà dans la bdd
    public function checkIfUsernameExists()
    {
        $query = 'SELECT COUNT(username) AS count
        FROM 5fe2__users
        WHERE username = :username';
        $queryExecute = $this->db->prepare($query);
        $queryExecute->bindValue(':username', $this->username, PDO::PARAM_STR);
        $queryExecute->execute();
        $queryResult = $queryExecute->fetch(PDO::FETCH_OBJ);
        //On sélectione le nombre de username correspondant à l'username qu'on a entré (':username'), si ça nous retourne 0 alors il n'existe pas, si ça nous retourne 1 alors il existe.
        return $queryResult->count;
    }

    //La méthode checkIfUserExists permet de vérifier si un utilisateur existe dans la bdd
    public function checkIfUserExists()
    {
        $query = 'SELECT COUNT(id) AS count
        FROM 5fe2__users
        WHERE id = :id';
        $queryExecute = $this->db->prepare($query);
        $queryExecute->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryExecute->execute();
        return $queryExecute->fetch(PDO::FETCH_OBJ);
    }

}