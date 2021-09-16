<?php

class database {
    
    public $db = NULL;

    private static $_instance;
    // Ici la méthode magique __construct assure la connexion à la base de donnée,elle contient l'objet PDO et la phrase de connexion à la base de donnée
    public function __construct(){
        // Ceci permet la connexion à la base de donnée on doit préciser le nom de la bdd + l'identifiant de sa bdd et son mdp
        // Il essaie d'abord la connexion, attrape le
        try{
            $this->db = new PDO('mysql:host=localhost;dbname=seriestrackr;charset=utf8', 'root', '223311Pp!');

        } catch (PDOException $error){
            die ($error->getMessage());
        }
    }
    //Si instance est null alors il va créer une nouvelle instance, le self représente la classe 
    public static function getInstance(){
        if(is_null(self::$_instance)){
            self::$_instance = new self();
        }
        return self::$_instance->db;
    }

}