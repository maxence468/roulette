<?php
require_once('Joueur.php');
function initialiseConnexionBDD() {
	$bdd = null;
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=roulette_cybersecu;charset=utf8', 
			'root', 
			''
		);	
	} catch(Exception $e) {
		die('Erreur connexion BDD : '.$e->getMessage());
	}

	return $bdd;
}

class JoueurDAO{
	private ?PDO $bdd;

	public function __construct() {
		$this->bdd = null;
		try {
			$this->bdd = new PDO('mysql:host=localhost;dbname=roulette_cybersecu;charset=utf8', 
				'root', 
				''
			);	
		} catch(Exception $e) {
			die('Erreur connexion BDD : '.$e->getMessage());
		}
	}

	public function getAll() {
		$joueurs = [];
		$sql = 'SELECT * FROM roulette_joueur';
		$req = $this->bdd->query($sql);
		while($data = $req->fetch()) {
			$joueur = new Joueur($data['id'], $data['nom'], $data['mdp'], $data['argent']);
			$joueurs[] = $joueur;
		}
		return $joueurs;
	}

	public function ajouteUtilisateur($nom, $motdepasse) {
		$bdd = initialiseConnexionBDD();
		if($bdd) {
			$query = $bdd->prepare('INSERT INTO roulette_joueur (nom, motdepasse, argent) VALUES (:t_nom, :t_mdp, 500);');
			$query->execute(array('t_nom' => $nom, 't_mdp' => password_hash($motdepasse, PASSWORD_DEFAULT)));
		}
	}


	public function connecteUtilisateur($utilisateur, $motdepasse) {
		$res = '';
		$bdd = initialiseConnexionBDD();
		if($bdd) {/*
			$sql = 'SELECT * FROM roulette_joueur 
			WHERE nom ="'.$utilisateur.'" AND motdepasse = "'.$motdepasse.'";';  
			$result = $bdd->query($sql); */

			$sql = 'SELECT * FROM roulette_joueur
			WHERE nom = ?;';
			$result = $bdd->prepare($sql);
			$result ->execute([$utilisateur]);
			$data = $result->fetch();
			if($data && password_verify($motdepasse, $data['motdepasse'])) {
				$_SESSION['joueur_id'] = intval($data['identifiant']);
				$_SESSION['joueur_nom'] = $data['nom'];
				$_SESSION['joueur_argent'] = intval($data['argent']);
			} else {
				$res = 'Utilisateur inconnu ou mot de passe erroné';
			}
		}
		return $res;	
	}

	public function majUtilisateur($id_joueur, $argent) {
		$bdd = initialiseConnexionBDD();
		if($bdd) {
			$query = $bdd->prepare('UPDATE roulette_joueur SET argent = :t_argent WHERE identifiant = :t_id;');
			$query->execute(array('t_argent' => $argent, 't_id' => $id_joueur));
		}
	}

	public function getById($id){
		$sql = 'SELECT * FROM roulette_joueur WHERE id = ?';
		$req = $this->bdd->prepare($sql);
		$req->execute([$id]);
		$data = $req->fetch();
		if($data) {
			$joueur = new Joueur($data['identifiant'], $data['nom'], $data['motdepasse'], $data['argent']);
		}
		return $joueur;
	}
	
	public function getByName($name){
		$joueur = null;
		$sql = 'SELECT * FROM roulette_joueur WHERE nom = ?';
		$req = $this->bdd->prepare($sql);
		$req->execute([$name]);
		$data = $req->fetch();
		if($data) {
			$joueur = new Joueur($data['identifiant'], $data['nom'], $data['motdepasse'], $data['argent']);
		}
		return $joueur;
	}
}