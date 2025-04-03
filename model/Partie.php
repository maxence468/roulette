<?php
class Partie{
	private int $id;
	private string $joueur;
	private string $date;
	private int $mise;
	private int $gain;

	public function __construct(int $i, string $j, string $d, int $m, int $g){
		$this->id = $i;
		$this->joueur = $j;
		$this->date = $d;
		$this->mise = $m;
		$this->gain = $g;
	}

	public function getId() {
		return $this->id;
	}
	public function getJoueur() {
		return $this->joueur;
	}
	public function getDate() {
		return $this->date;
	}
	public function getMise() {
		return $this->id;
	}
	public function getGain() {
		return $this->gain;
	}



}