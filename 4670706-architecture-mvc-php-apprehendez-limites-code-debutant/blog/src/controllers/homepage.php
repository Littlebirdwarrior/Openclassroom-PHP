
<?php
// controllers/homepage.php
/*(Dans l'idéal, on temps toujours vers 1url = 1 controller)*/

require_once('src/models/model.php');//bonne pratique pour inclure les bibliothèque

//fonction responsable de l'affichage de l'index
function homepage() {
	$posts = getPosts();

	require('templates/homepage.php');
}

