<?php
require_once('Partie.php');

class PartieDAO{
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
		$parties = [];
		$sql = 'SELECT * FROM roulette_partie';
		$req = $this->bdd->query($sql);
		while($data = $req->fetch()) {
			$partie = new Partie($data['id'], $data['joueur'], $data['date'], $data['mise'], $data['gain']);
			$parties[] = $partie;
		}
		return $parties;
	}

	public function ajoutePartie($id_joueur, $date, $mise, $gain) {
		$bdd = initialiseConnexionBDD();
		if($bdd) {
			$query = $bdd->prepare('INSERT INTO roulette_partie (joueur, date, mise, gain) VALUES ( :t_id, :t_date, :t_mise, :t_gain);');
			$query->execute(array('t_id' => $id_joueur, 't_date' => $date, 't_mise' => $mise, 't_gain' => $gain));
		}
	}

	




}