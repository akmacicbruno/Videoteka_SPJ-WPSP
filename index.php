<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["username"]))  
 {  
    header("location: login.php");
    exit;
 }
?>
<!DOCTYPE html>
<html lang="hr">
    <head>
        <meta charset="utf-8">
        <title>Videoteka</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="assets/plugins/angularjs/angular.min.js"></script>
        <script src="assets/plugins/angularjs/angular-route.min.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="assets/plugins/jquery/jquery-3.2.1.min.js"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
        <script src="js/app.js"></script>
        <link rel="stylesheet" href="css/index_style.css">
        <link rel="stylesheet" href="css/nav_style.css">
        <link rel="stylesheet" href="css/modal.css">
    </head>
    <body ng-app="movies-app" ng-controller="dostupniFilmovi">
        <header>
        <nav-bar></nav-bar>
        </header>
        <h2 class="site-title">Dostupni filmovi</h2>
        <input class="container__table-available-movies-search" placeholder="Pretraživanje" ng-model="inputTekst"></input>
        <select class="container__table-available-movies-search__genres" ng-model="inputGenre">
            <option value="" disabled selected hidden>Žanr</option>
            <option value="Drama">Drama</option>
            <option value="Pustolovni">Pustolovni</option>
            <option value="Horor">Horor</option>
            <option value="Romantični">Romantični</option>
            <option value="Akcija">Akcija</option>
            <option value="Sci-Fi">Sci-Fi</option>
            <option value="Komedija">Komedija</option>
            <option value="Triler">Triler</option>
            <option value="Animirani">Animirani</option>
            <option value="Krimi">Krimi</option>
        </select>
        <div class="container">
        <table class="container__table-available-movies">
            
            <thead>
                <tr>
                    <th>ID filma</th>
                    <th>Naziv</th>
                    <th>Opis</th>
                    <th>Žanr</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="oFilm in oDostupniFilmovi | filter : {'naziv' : inputTekst} | filter: inputGenre">
                    <td>{{oFilm.film_id}}</td>
                    <td>{{oFilm.naziv}}</td>
                    <td>{{oFilm.opis}}</td>
                    <td>{{oFilm.zanr}}</td>
                    <td style="width: 1px; cursor: pointer;"><button class="btn-movies" ng-click="openModalRent($index)">Posudi</button></td>
                    <td style="width: 1px; cursor: pointer;"><span class="material-icons" ng-click="openModalEdit($index)">edit</span></td>
                    <td style="width: 1px; cursor: pointer;"><span class="material-icons" ng-click="obrisiFilm(oFilm.film_id)">highlight_off</span></td>
                </tr>
            </tbody>
        </table>
        </div>
        <script src="js/animations.js"></script>
    </body>
</html>

<div class="modal-container" id="editMovie">
    <div class="modal">
      <h1 class="modal__title">Uređivanje</h1>
      <div class="form-movie">
            <form autocomplete="off">
                <div>
                    <label>Šifra:</label>
                    <div>
                        <input disabled id="editSifra" class="modal__movie-input" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "4" placeholder=""/>
                    </div>
                    <label>Naziv:</label>
                    <div>
                        <input id="editNaziv" type="text" class="modal__movie-input" placeholder=""/>
                    </div>
                    <label>Opis:</label>
                    <div>
                        <textarea id="editOpis" type="text" class="modal__movie-input" placeholder="" style="height: 130px;"></textarea>
                    </div>
                    <label>Žanr:</label>
                    <div>
                        <input disabled id="editZanr" type="text" class="modal__movie-input" placeholder=""/>
                    </div>
                </div>
                </br>
                <button class="modal__btn" ng-click="urediFilm($index)">Uredi</button>
            </form>
        </div>
      <a class="modal__btn-close" ng-click="closeModalEdit()"></a>
    </div>
  </div>
</div>

<div class="modal-container" id="rentMovie">
    <div class="modal">
      <h1 class="modal__title">Posuđivanje</h1>
      <div class="form-movie" ng-controller="korisnikKojiPosuduje">
            <form>
                <label>Šifra:</label>
                <div>
                    <input disabled id="rentSifra" style="text-align:center;"class="modal__movie-input" type = "number" maxlength = "4" placeholder=""/>
                </div>
                <div>
                    <label>Korisnik:</label><br>
                    <select class="modal__select-user" id="odabrani-korisnik">
                        <option value="" disabled selected hidden>Odaberite korisnika</option>
                        <option ng-repeat="oKorisnik in oKorisnici" value="{{oKorisnik.gledatelj_id}}">{{oKorisnik.ime}} {{oKorisnik.prezime}}</option>
                    </select>
                </div>
                </br>
                <button class="modal__btn" ng-click="posudiFilm($index)">Posudi</button>
            </form>
        </div>
      <a class="modal__btn-close" ng-click="closeModalRent()"></a>
    </div>
  </div>
</div>