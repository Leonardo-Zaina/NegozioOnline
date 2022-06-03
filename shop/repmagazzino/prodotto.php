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
	
	
}
?>