<?php 
class Joueur{
	private int $id;
	private string $nom;
	private string $mdp;
	private int $argent;

	public function __construct(int $i, string $n, string $m, int $a)
	{
		$this->id = $i;
		$this->nom = $n;
		$this->mdp = $m;
		$this->argent = $a;
	}

	public function getId() {
		return $this->id;
	}
	public function getNom(){
		return $this->nom;
	}
	public function getMdp(){
		return $this->mdp;
	}
	public function getArgent(){
		return $this->argent;
	}


 }
