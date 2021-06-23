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
        <title>Videoteka | Statistika</title>
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
    <body ng-app="movies-app" ng-controller="Statistika">
        <header>
            <nav-bar></nav-bar>
        </header>
        <h2 class="site-title">Najpopularniji naslovi</h2>
        <div class="container">
            <table class="container__table-statistics">
                <thead>
                    <tr>
                        <th>Redni broj</th>
                        <th>Naziv</th>
                        <th>Broj posuđivanja</th>
                    </tr>
                    <tr ng-repeat="oStatistikaFilm in oStatistikaFilmovi">
                        <td>{{$index +1}}</td>
                        <td>{{oStatistikaFilm.naziv}}</td>
                        <td>{{oStatistikaFilm.broj_posudivanja}}</td>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
        <h2 class="site-title">Najaktivniji gledatelji</h2>
        <div class="container">
            <table class="container__table-statistics">
                <thead>
                    <tr>
                        <th>Redni broj</th>
                        <th>Gledatelj</th>
                        <th>Količina posuđivanja</th>
                    </tr>
                    <tr ng-repeat="oStatistikaKorisnik in oStatistikaKorisnici">
                        <td>{{$index +1}}</td>
                        <td>{{oStatistikaKorisnik.ime}} {{oStatistikaKorisnik.prezime}}</td>
                        <td>{{oStatistikaKorisnik.kolicina_posudivanja}}</td>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
        <script src="js/animations.js"></script>
    </body>
</html>