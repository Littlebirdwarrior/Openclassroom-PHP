<?php
//Routeur

require_once('src/controllers/homepage.php');
require_once('src/controllers/post.php');

//*Les condition d'affichages sont maintenant écrite dans le routeur

//si l'action n'est pas dans l'url, c'est home page qui s'affiche
if (isset($_GET['action']) && $_GET['action'] !== '') {
	//on vérifie que cet action est bien post
	if ($_GET['action'] === 'post') {
		//on verifie que le post en question existe bien
    	if (isset($_GET['id']) && $_GET['id'] > 0) {
			//On associe le mot clé identifié à l'id
        	$identifier = $_GET['id'];
            //On appelle la fonction post(avec id en param)
        	post($identifier);
    	} else {
			//si le post n'existe pas, cette page est nulle
        	echo 'Erreur : aucun identifiant de billet envoyé';

        	die;
    	}
	} else {
		//si l'url est fausse, erreur 404
    	echo "Erreur 404 : la page que vous recherchez n'existe pas.";
	}
} else {
	homepage();
}