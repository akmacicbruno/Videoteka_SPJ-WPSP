<?php
header('Content-type: text/json');
header('Content-type: application/json; charset=utf-8');

include 'connection.php';
ini_set('memory_limit', '2048M');

if (isset($_GET['json_id']))
{
	$json = $_GET['json_id'];
	switch ($json) {
		case 'get_rented_movies':
		{
			$sQuery = "SELECT filmovi.sifra, filmovi.naziv, filmovi.opis, filmovi.gledatelj_id, filmovi.zanr_id, filmovi.broj_posudivanja, gledatelj.gledatelj_id, gledatelj.ime, gledatelj.prezime, 
			(SELECT Group_CONCAT(gledatelj.ime, ' ' ,gledatelj.prezime, ', ', gledatelj.gledatelj_id) as ImePrezime
			FROM gledatelj where gledatelj.gledatelj_id = filmovi.gledatelj_id) as ImePrezime from filmovi LEFT JOIN gledatelj on filmovi.gledatelj_id=gledatelj.gledatelj_id where filmovi.gledatelj_id is not null";
			$oRecord = $oConnection->query($sQuery);
			$PosudeniFilmovi = array();
			while($oRow = $oRecord->fetch(PDO::FETCH_BOTH))
			{
				$film_id = $oRow['sifra'];
				$naziv = $oRow['naziv'];
				$opis = $oRow['opis'];
				$gledatelj = $oRow['ImePrezime'];
				$zanr = $oRow['zanr_id'];
                $broj_posudivanja = $oRow['broj_posudivanja'];
				$PosudeniFilm = new Film($film_id, $naziv, $opis, $gledatelj, $zanr, $broj_posudivanja);
				array_push($PosudeniFilmovi, $PosudeniFilm);
			}
			echo json_encode($PosudeniFilmovi);
			break;
		}
        case 'get_available_movies':
            {
                $sQuery = "SELECT filmovi.sifra, filmovi.naziv, filmovi.opis, filmovi.gledatelj_id, filmovi.zanr_id, filmovi.broj_posudivanja, gledatelj.gledatelj_id, gledatelj.ime, gledatelj.prezime, zanr.zanr_id, zanr.naziv as zanrnaziv from filmovi LEFT JOIN gledatelj on filmovi.gledatelj_id=gledatelj.gledatelj_id LEFT JOIN zanr on filmovi.zanr_id=zanr.zanr_id where filmovi.gledatelj_id is null";
                $oRecord = $oConnection->query($sQuery);
                $DostupniFilmovi = array();
                while($oRow = $oRecord->fetch(PDO::FETCH_BOTH))
                {
                    $film_id = $oRow['sifra'];
                    $naziv = $oRow['naziv'];
                    $opis = $oRow['opis'];
                    $gledatelj = $oRow['ime'];
                    $zanr = $oRow['zanrnaziv'];
                    $broj_posudivanja = $oRow['broj_posudivanja'];
                    $DostupniFilm = new Film($film_id, $naziv, $opis, $gledatelj, $zanr, $broj_posudivanja);
                    array_push($DostupniFilmovi, $DostupniFilm);
                }
                echo json_encode($DostupniFilmovi);
                break;
            }
		case 'get_all_movies':
			{
				$sQuery = "SELECT * FROM filmovi";
				$oRecord = $oConnection->query($sQuery);
				$Filmovi = array();
				while($oRow = $oRecord->fetch(PDO::FETCH_BOTH))
				{
					$film_id = $oRow['sifra'];
					$naziv = $oRow['naziv'];
					$opis = $oRow['opis'];
					$gledatelj = $oRow['gledatelj_id'];
					$zanr = $oRow['zanr_id'];
					$broj_posudivanja = $oRow['broj_posudivanja'];
					$Film = new Film($film_id, $naziv, $opis, $gledatelj, $zanr, $broj_posudivanja);
					array_push($Filmovi, $Film);
				}
				echo json_encode($Filmovi);
				break;
			}
		case 'get_all_users':
		{
			$sQuery = "SELECT * FROM gledatelj";
			$oRecord = $oConnection->query($sQuery);
			$oGledatelji = array();
			while($oRow = $oRecord->fetch(PDO::FETCH_BOTH))
			{
				$gledatelj_id = $oRow['gledatelj_id'];
				$ime = $oRow['ime'];
                $prezime = $oRow['prezime'];
				$kolicina_posudivanja = $oRow['kolicina_posudivanja'];
				$Gledatelj = new Gledatelj($gledatelj_id, $ime, $prezime, $kolicina_posudivanja);
				array_push($oGledatelji, $Gledatelj);
			}
			echo json_encode($oGledatelji);
			break;
		}
		case 'get_stats_movies':
            {
                $sQuery = "SELECT * from filmovi ORDER BY broj_posudivanja DESC LIMIT 5";
                $oRecord = $oConnection->query($sQuery);
                $StatsFilmovi = array();
                while($oRow = $oRecord->fetch(PDO::FETCH_BOTH))
                {
                    $film_id = $oRow['sifra'];
                    $naziv = $oRow['naziv'];
                    $opis = $oRow['opis'];
                    $gledatelj = $oRow['gledatelj_id'];
                    $zanr = $oRow['zanr_id'];
                    $broj_posudivanja = $oRow['broj_posudivanja'];
                    $StatFilm = new Film($film_id, $naziv, $opis, $gledatelj, $zanr, $broj_posudivanja);
                    array_push($StatsFilmovi, $StatFilm);
                }
                echo json_encode($StatsFilmovi);
                break;
            }
			case 'get_stats_users':
				{
					$sQuery = "SELECT * FROM gledatelj ORDER BY kolicina_posudivanja DESC LIMIT 5";
					$oRecord = $oConnection->query($sQuery);
					$oStatsKorisnici = array();
					while($oRow = $oRecord->fetch(PDO::FETCH_BOTH))
					{
						$gledatelj_id = $oRow['gledatelj_id'];
						$ime = $oRow['ime'];
						$prezime = $oRow['prezime'];
						$kolicina_posudivanja = $oRow['kolicina_posudivanja'];
						$oStatsKorisnik = new Gledatelj($gledatelj_id, $ime, $prezime, $kolicina_posudivanja);
						array_push($oStatsKorisnici, $oStatsKorisnik);
					}
					echo json_encode($oStatsKorisnici);
					break;
					break;
				}
		default:
        {
            echo "Greška";
        }
	}
}
?>