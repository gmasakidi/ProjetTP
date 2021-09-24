<?php

class database {
    //Ici l'attribut $db est en 'public' afin de pouvoir l'utiliser à l'extérieur de ma classe
    public $db = NULL;
    /**
     * Ici l'attribut $_instance est en 'private' car elle ne peut etre utilisé que dans la classe 
     * On utilise 'static' car il ne peut pas être instancié, pas besoin de créer d'objet pour l'instancier
     */
    private static $_instance;
    // Ici la méthode magique __construct assure la connexion à la base de donnée, elle contient l'objet PDO et la phrase de connexion à la base de donnée
    public function __construct(){
        // Ceci permet la connexion à la base de donnée on doit préciser le nom de la bdd + l'identifiant de sa bdd et son mdp
        // Il essaie d'abord la connexion, attrape le message d'erreur s'il y en a un et l'affiche
        try{
            $this->db = new PDO('mysql:host=localhost;dbname=seriestrackr;charset=utf8', 'root', '223311Pp!');

        } catch (PDOException $error){
            die ($error->getMessage());
        }
    }
    //Si 'self::$_instance' est nul alors il va créer une nouvelle instance, le self représente la classe 
    //Il retourne l'objet PDO 'self::$_instance'
    public static function getInstance(){
        if(is_null(self::$_instance)){
            self::$_instance = new self();
        }
        return self::$_instance->db;
    }
}