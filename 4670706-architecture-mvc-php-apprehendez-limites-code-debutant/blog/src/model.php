<?php

function getPost(){
    //1- connection BDD
    // Connexion à la base de données
    try {
        $database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'blog', 'blog');
    } catch (Exception $e) {
        die('Error : ' . $e->getMessage());
    }
    //2- query sql
    // On récupère les 5 derniers billets
        $statement = $database->query(
        "SELECT id, titre, contenu, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0, 5"
        );
    
    //3- recupération des données
    //Structuration des variable Création d'une variable qui fetch les données
    $post = [];
    while ($row = $statement->fetch()) {
        $post = [
        'title' => $row['titre'],
        'content' => $row['contenu'],
        'frenchCreationDate' => $row['date_creation_fr']
        ];
    
        $posts[] = $post;
    }

    return $posts;
}

?>