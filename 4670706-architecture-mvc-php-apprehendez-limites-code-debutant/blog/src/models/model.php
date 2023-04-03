<?php

function getPosts(){

        //1- connection BDD
        // Connexion à la base de données
        try {
            $database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'blog', 'blog');
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        //2- query sql
        // On récupère les 5 derniers posts
            $statement = $database->query(
            "SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS format_creation_date FROM posts ORDER BY format_creation_date DESC LIMIT 0, 5"
            );
        
        //3- recupération des données
        //Structuration des variable Création d'une variable qui fetch les données
        $post = [];
        while ($row = $statement->fetch()) {
            $post = [
            'title' => $row['title'],
            'content' => $row['content'],
            'french_creation_date' => $row['format_creation_date'],
            'identifier' => $row['id'],
            ];
        
        $posts[] = $post;
        }

    return $posts;
}

function getPost($identifier) {
    try {
        $database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'blog', 'blog');
    } catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
    }
 
    $statement = $database->prepare(
        "SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM posts WHERE id = ?"
    );
    $statement->execute([$identifier]);
 
    $row = $statement->fetch();
    $post = [
        'title' => $row['title'],
        'french_creation_date' => $row['creation_date'],
        'content' => $row['content'],
    ];
 
    return $post;
}

function getComments($identifier)
{
    try {
        $database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'blog', 'blog');
    } catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
    }
 
    $statement = $database->prepare(
        "SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM comments WHERE post_id = ? ORDER BY comment_date DESC"
    );
    $statement->execute([$identifier]);
 
    $comments = [];
    while (($row = $statement->fetch())) {
        $comment = [
            'author' => $row['author'],
            'french_creation_date' => $row['creation_date'],
            'comment' => $row['comment'],
        ];
        $comments[] = $comment;
    }

    return $comments;
}



?>