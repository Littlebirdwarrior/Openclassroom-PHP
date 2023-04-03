<?php


require_once('src/models/model.php');

function post(string $identifier)
{
	$post = getPost($identifier);
	$comments = getComments($identifier);

	require('templates/post.php');
}