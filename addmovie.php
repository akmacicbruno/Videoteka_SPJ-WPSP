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
        <title>Videoteka | Dodaj film</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="assets/plugins/angularjs/angular.min.js"></script>
        <script src="assets/plugins/angularjs/angular-route.min.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
        <script src="js/app.js"></script>
        <link rel="stylesheet" href="css/index_style.css">
        <link rel="stylesheet" href="css/nav_style.css">
    </head>
    <body ng-app="movies-app" ng-controller="dodajFilm">
        <header>
            <nav-bar></nav-bar>
        </header>
        <div>
            <h2 class="site-title">Dodavanje filma u bazu</h2>
        <div class="form-movie">
            <form autocomplete="off">
                <div>
                    <p style="color:red;">*za uspješno dodavanje potrebno je popuniti sva polja</p>
                    <label>Šifra:</label>
                    <div>
                        <input id="addID-movie" class="movie-input" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "4" autocomplete="off" placeholder=""/>
                    </div>
                    <label>Naziv:</label>
                    <div>
                        <input type="text" id="addNaziv-movie" class="movie-input" autocomplete="off" placeholder=""/>
                    </div>
                    <label>Opis:</label>
                    <div>
                        <textarea type="text" id="addOpis-movie" class="movie-input" autocomplete="off" placeholder="" style="height: 130px;"></textarea>
                    </div>
                    <label>Žanr:</label><br>
                        <table id="zanr_array_id" method="post" style="text-align: left; margin-left:33%; width:40%">
                        <tr>
                            <td>
                                <input class="izbor" type="checkbox" name="zanr_array[]" value="Drama">Drama<br>
                                <input class="izbor" type="checkbox" name="zanr_array[]" value="Komedija">Komedija<br>
                                <input class="izbor" type="checkbox" name="zanr_array[]" value="Animirani">Animirani<br>
                                <input class="izbor" type="checkbox" name="zanr_array[]" value="Misterij">Misterij<br>
                            </td>
                            <td>
                                <input class="izbor" type="checkbox" name="zanr_array[]" value="Pustolovni">Pustolovni<br>
                                <input class="izbor" type="checkbox" name="zanr_array[]" value="Horor">Horor<br>
                                <input class="izbor" type="checkbox" name="zanr_array[]" value="Romantični">Romantični<br>
                                <input class="izbor" type="checkbox" name="zanr_array[]" value="Ratni">Ratni<br>
                            </td>
                            <td>
                                <input class="izbor" type="checkbox" name="zanr_array[]" value="Sci-Fi">Sci-Fi<br>
                                <input class="izbor" type="checkbox" name="zanr_array[]" value="Triler">Triler<br>
                                <input class="izbor" type="checkbox" name="zanr_array[]" value="Krimi">Krimi<br>
                                <input class="izbor" type="checkbox" name="zanr_array[]" value="Akcija">Akcija<br>
                            </td>
                        </tr>
                        
                        </table>
                    <!--<div>
                        <input type="text" id="addZanr-movie" class="movie-input" autocomplete="off" placeholder=""/>
                    </div>-->
                </div>
                </br>
                <button class="movie-btn" ng-click="dodajFilm()">Dodaj film</button>
            </form>
        </div>
        </div>
        <script src="js/animations.js"></script>
    </body>
</html>