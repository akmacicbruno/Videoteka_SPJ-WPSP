<?php
class Configuration
{
	public $host = "localhost";
	public $dbName = "videoteka";
	public $username = "bruno";
	public $password = "";
	public $message = ""; 
}
class Film 
{
	public $film_id = "";
	public $naziv = "";
	public $opis = "";
	public $gledatelj = "";
	public $zanr = "";
	public $broj_posudivanja = "";

	public function __construct ($film_id, $naziv, $opis, $gledatelj, $zanr, $broj_posudivanja)
	{
		$this->film_id = $film_id;
		$this->naziv = $naziv;
		$this->opis = $opis;
		$this->gledatelj = $gledatelj;
		$this->zanr = $zanr;
		$this->broj_posudivanja = $broj_posudivanja;
	}
}
class Gledatelj 
{
	public $gledatelj_id = "";
	public $ime = "";
	public $prezime = "";
	public $kolicina_posudivanja = "";

	public function __construct ($gledatelj_id, $ime, $prezime, $kolicina_posudivanja)
	{
		$this->gledatelj_id = $gledatelj_id;
		$this->ime = $ime;
		$this->prezime = $prezime;
		$this->kolicina_posudivanja = $kolicina_posudivanja;
	}
}
class Zanr 
{
	public $zanr_id = "";
	public $naziv = "";

	public function __construct ($zanr_id, $naziv)
	{
		$this->zanr_id = $zanr_id;
		$this->naziv = $naziv;
	}
}
class Zapis 
{
	public $zapis_id = "";
	public $film_id = "";
	public $naziv = "";
	public $gledatelj_id = "";
	public $ime = "";
	public $prezime = "";
	public $datum_posudivanja = "";
	public $rok ="";
	public $datum_vracanja = "";

	public function __construct ($zapis_id, $film_id, $naziv, $gledatelj_id, $ime, $prezime, $datum_posudivanja, $rok, $datum_vracanja)
	{
		$this->zapis_id = $zapis_id;
		$this->film_id = $film_id;
		$this->naziv = $naziv;
		$this->gledatelj_id = $gledatelj_id;
		$this->ime = $ime;
		$this->prezime = $prezime;
		$this->datum_posudivanja = $datum_posudivanja;
		$this->rok = $rok;
		$this->datum_vracanja = $datum_vracanja;
	}
}
?>