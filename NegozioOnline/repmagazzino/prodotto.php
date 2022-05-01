<?php
declare(strict_types=1);
require("gestionale.php");

class Prodotto{
	public string $nome;
	public string $marca;
	public string $modello;
	public string $numero_seriale;
	public int $quantità;
	
	public function __construct(
		string $par_nome,
		string $par_marca, 
		string $par_modello, 
		string $par_numero_seriale, 
		int $par_quantità
	)
	{
		$this->nome = $par_nome;
		$this->marca = $par_marca;
		$this->modello = $par_modello;
		$this->numero_seriale = $par_numero_seriale;
		$this->quantità = $par_quantità;
		
	}
	
	// diagonale: sola lettura (getter)
	public function getDiagonale(): int {
		return $this->diagonale;
	}

	// volume_max: lettura e scrittura (gettere e setter)
	public function getVolumeMax(): int {
		return $this->volume_max;
	}

	public function setVolumeMax(int $valore) {
		$this->volume_max = $valore;
	}

	
	public function getVolume(): int {
		return $this->volume;
	}
		
	public function alzaVolume() {
		if ($this->volume < $this->volume_max) {
			$this->volume++;
		}
	}
}
?>