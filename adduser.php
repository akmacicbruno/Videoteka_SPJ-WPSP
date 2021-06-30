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
        <title>Videoteka | Dodaj korisnika</title>
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
    <body ng-app="movies-app" ng-controller="dodajKorisnika">
        <header>
            <nav-bar></nav-bar>
        </header>
        <h2 class="site-title">Dodavanje gledatelja u bazu</h2>
        <div class="form-user">
            <form autocomplete="off">
                <div>
                    <p style="color:red;">*za uspješno dodavanje potrebno je popuniti sva polja</p>
                    <label>ID gledatelja:</label>
                    <div>
                        <input class="user-input"  id="addID" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "6" autocomplete="off" placeholder=""/>
                    </div>
                    <label>Ime:</label>
                    <div>
                        <input type="text" id="addIme" name ="ime" class="user-input" autocomplete="off" placeholder=""/>
                    </div>
                    <label>Prezime:</label>
                    <div>
                        <input type="text" id="addPrezime" name ="prezime" class="user-input" autocomplete="off" placeholder=""/>
                    </div>
                </div>
                </br>
                <button class="user-btn" ng-click="dodajKorisnika()" >Dodaj korisnika</button>
            </form>
        </div>
        <script src="js/animations.js"></script>
    </body>
</html>