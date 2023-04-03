<?php


require_once('src/models/model.php');
require_once('src/models/comment.php');

//ici, est responsable d'afficher les post par id (pas de condition, on laisse ça à la page d'acceuil)
function post(string $identifier) //identifier, ici, est créer au niveau du model, c'est un derivé le l'id
{
	$post = getPost($identifier);
	$comments = getComments($identifier);

	require('templates/post.php');
}