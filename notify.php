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
        <title>Videoteka | Obavijest</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="assets/plugins/angularjs/angular.min.js"></script>
        <script src="assets/plugins/angularjs/angular-route.min.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
        <script src="js/app.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/emailjs-com@3/dist/email.min.js"></script>
        <script type="text/javascript">
        (function() {
        emailjs.init("user_BTcETQrHM3j9EmVtbsUPn");
        })();
        </script>
        <link rel="stylesheet" href="css/index_style.css">
        <link rel="stylesheet" href="css/nav_style.css">
    </head>
    <body ng-app="movies-app" ng-controller="obavijestGledatelju">
        <header>
            <nav-bar></nav-bar>
        </header>
        <div class="notify-container">   
                <h2 class="notify-container__title">Obavijest korisniku</h2><br/>  
                <form method="post" autocomplete="off"> 
                    <select type="text" id="film" class="notify-container__input" autocomplete="off" placeholder="Odaberite film">
                        <option value="" disabled selected hidden>Odaberite film</option>
                        <option ng-repeat="oFil in oPovijest_posudeno" value="{{oFil.film_id}} | {{oFil.naziv}}">{{oFil.film_id}}, {{oFil.naziv}} | {{oFil.gledatelj_id}}, {{oFil.ime}} {{oFil.prezime}}</option>
                    </select>
                    <br/>
                    <input type="email" id="email" class="notify-container__input" autocomplete="off" placeholder="Unesite email adresu"/> 
                    <br/>
                    <br/> 
                    <button class="notify-container__btn" ng-click="posaljiObavijest()">Pošalji obavijest</button>
                </form>  
           </div>
        <script src="js/animations.js"></script>
    </body>
</html>