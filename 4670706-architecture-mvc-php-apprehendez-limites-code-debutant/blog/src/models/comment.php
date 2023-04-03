<?php

function commentDbConnect()
{
	try {
    	$database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'blog', 'blog');

    	return $database;
	} catch(Exception $e) {
    	die('Erreur : '.$e->getMessage());
	}
}

function getComments(string $post)
{
	$database = commentDbConnect();
	$statement = $database->prepare(
    	"SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM comments WHERE post_id = ? ORDER BY comment_date DESC"
	);
	$statement->execute([$post]);

	$comments = [];
	while (($row = $statement->fetch())) {
    	$comment = [
        	'author' => $row['author'],
        	'french_creation_date' => $row['french_creation_date'],
        	'comment' => $row['comment'],
    	];

    	$comments[] = $comment;
	}

	return $comments;
}

function createComment(string $post, string $author, string $comment) : bool
{
	$database = commentDbConnect();
	$statement = $database->prepare(
    	'INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())'
	);
    //si le nombre ligne affecté est sup à 0, alors le commentaire existe
	$affectedLines = $statement->execute([$post, $author, $comment]);

	return ($affectedLines > 0);
}

