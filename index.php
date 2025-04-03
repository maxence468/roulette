<?php 
	require_once('model/JoueurDAO.php');
	require_once('model/PartieDAO.php');
	session_start();
	$jdao = new JoueurDAO();
	$pdao = new PartieDAO();
	$module = "Connexion";
	$message_erreur = "";
	$message_info = '';
	$gagne = false;

//Connexion
if(isset($_GET['btnConnect'])) {
	// Vérifie que les champs existent et ne sont pas vides
	if(isset($_GET['nom']) && $_GET['nom'] != '' &&
		isset($_GET['motdepasse']) && $_GET['motdepasse'] != '') {
		$jdao->connecteUtilisateur($_GET['nom'], $_GET['motdepasse']);
		if($message_erreur == '') {
			// Si pas d'erreur, renvoie l'utilisateur vers le jeu de la roulette
			$module = "jeu";		
		}
	}
}

//Inscription
// Vérifie que le bouton du formulaire a été cliqué
else if(isset($_POST['btnSignup'])) {
	// Vérifie que les champs existent et ne sont pas vides
	if(isset($_POST['nom']) && $_POST['nom'] != '' &&
		isset($_POST['motdepasse']) && $_POST['motdepasse'] != '') {

		// Appelle des fonctions de BDD_Manager.php pour ajouter l'utilisateur en BDD puis le connecter
		$jdao->ajouteUtilisateur($_POST['nom'], $_POST['motdepasse']);
		$jdao->connecteUtilisateur($_POST['nom'], $_POST['motdepasse']);
		
		// Renvoie l'utilisateur vers le jeu de la roulette
		$module = "jeu";
	} else {
		$message_erreur = 'Il faut remplir les champs!';
	}
}

//Jeu de la roulette
else if(isset($_GET['btnJouer'])) {
	if($_GET['mise'] < 0) {
		$message_erreur = 'La mise doit être positive';
	} else if($_GET['mise'] == 0) {
		$message_erreur = 'Il faut miser de l\'argent ...';
	} else if($_GET['mise'] > $_SESSION['joueur_argent']) {
		$message_erreur = 'On ne mise pas plus que ce qu\'on a ...';
	} else if($_GET['numero'] == 0 && !isset($_GET['parite'])) {
		$message_erreur = 'Il faut miser sur quelquechose!';
	} else {
		$_SESSION['joueur_argent'] -= $_GET['mise'];
		$gain = 0;
		$numero = rand(1, 36);

		$miseJoueur = intval($_GET['mise']);
		$numeroJoueur = intval($_GET['numero']);
		$message_info = "La bille s'est arrêtée sur le $numero! ";
		if($_GET['numero']!= 0) {
			$message_info .= "Vous avez misé sur le ".$numeroJoueur."!";
			if($numeroJoueur == $numero) {
				$message_resultat = "Jackpot! Vous gagnez ". $miseJoueur*35 ."€ !";
				$gagne = true;
				$gain = $miseJoueur*35;
				$_SESSION['joueur_argent'] += $gain;
			} else {
				$message_resultat = "Raté!";
			}
		} else {
			$message_info .= "Vous avez misé sur le fait que le résultat soit ".$_GET['parite'];
			$parite = $numero%2 == 0 ? 'pair' : 'impair';
			if($parite == $_GET['parite']) {
				$message_resultat = "Bien joué! Vous gagnez ". $miseJoueur*2 ."€ !";
				$gagne = true;
				$gain = $miseJoueur*2;
				$_SESSION['joueur_argent'] += $gain;
			} else {
				$message_resultat = "C'est perdu, dommage!";
			}
		}
		$jdao->majUtilisateur($_SESSION['joueur_id'], $_SESSION['joueur_argent']);
		$pdao->ajoutePartie($_SESSION['joueur_id'], date('Y-m-d h:i:s'), $_GET['mise'], $gain);
	}
}

//Deconexion
else if (isset($_GET['deco'])) {
	session_unset();
	$module = "Connexion";
}
else if(isset($_GET['inscription'])){
	$module = "Inscription";
}


include('view/head.php');
if($module == "Connexion"){
	include('view/form_conn.php');
}
if($module == "Inscription"){
	include('view/form_inscr.php');
}
if($module == "jeu"){
	include('view/form_jeu.php');
}
include('view/foot.php');
