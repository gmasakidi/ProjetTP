<?php 
//On crée une classe database
class database {
    // On utilise le "protected" pour faire en sorte que la classe database et ses enfants y ai accès
    protected $db = NULL;
    // Ici la méthode magique __construct assure la connexion à la base de donnée,elle contient l'objet PDO et la phrase de connexion à la base de donnée
    public function __construct(){
        // Ceci permet la connexion à la base de donnée on doit préciser le nom de la bdd + l'identifiant de sa bdd et son mdp
        // Il essaie d'abord la connexion, attrape le message d'erreur si la connexion échoue et affiche le message
        try{
            $this->db = new PDO('mysql:host=localhost;dbname=seriestrakr;charset=utf8', 'root', '223311Pp!');
            return $this->db;
        } catch (Exception $error){
            die ($error->getMessage());
        }
    }
}