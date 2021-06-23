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
        <title>Videoteka | Posuđeni filmovi</title>
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
    </head>
    <body ng-app="movies-app" ng-controller="posudeniFilmovi">
        <header>
            <nav-bar></nav-bar>
        </header>
        <h2 class="site-title">Posuđeni filmovi</h2>
        <input class="container__table-movies-search" placeholder="Pretraživanje" ng-model="inputTekst"></input>
        <div class="container">
            <table class="container__table-movies">
                <thead>
                    <tr>
                        <th>ID filma</th>
                        <th>Naziv</th>
                        <th>Gledatelj</th>
                        <th style="width: 1px;"></th>
                    </tr>
                </thead>
                <tbody>
                <tr ng-repeat="oPosudeniFilm in oPosudeniFilmovi | filter: inputTekst">
                    <td>{{oPosudeniFilm.film_id}}</td>
                    <td>{{oPosudeniFilm.naziv}}</td>
                    <td>{{oPosudeniFilm.gledatelj}}</td>
                    <td><button class="btn-movies" ng-click="vratiFilm(oPosudeniFilm.film_id)">Vrati</button></td>
                </tr>
                </tbody>
            </table>
        </div>
        <script src="js/animations.js"></script>
    </body>
</html>