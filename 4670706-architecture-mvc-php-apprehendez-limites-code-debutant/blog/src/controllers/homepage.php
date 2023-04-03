
<?php
// controllers/homepage.php

require_once('src/models/model.php');

function homepage() {
	$posts = getPosts();

	require('templates/homepage.php');
}

