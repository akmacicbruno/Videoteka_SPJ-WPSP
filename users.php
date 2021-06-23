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
        <title>Videoteka | Korisnici</title>
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
    <body ng-app="movies-app" ng-controller="sviKorisnici">
        <header>
            <nav-bar></nav-bar>
        </header>
        <!--<div>
            <h2 id="skriveni-tekst" class="hidden-div">Uređeni podaci korisnika!</h2>
        </div>-->
        <h2 class="site-title">Svi gledatelji videoteke</h2>
        <input class="container__table-users-search" placeholder="Pretraživanje" ng-model="inputTekst"></input>
        <div class="container">
            <table class="container__table-users">
                <thead>
                    <tr>
                        <th>ID gledatelja</th>
                        <th>Ime</th>
                        <th>Prezime</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="oKorisnik in oKorisnici | filter: inputTekst">
                        <td>{{oKorisnik.gledatelj_id}}</td>
                        <td>{{oKorisnik.ime}}</td>
                        <td>{{oKorisnik.prezime}}</td>
                        <td style="width: 1px; cursor: pointer;"><span class="material-icons" ng-click="openModalEditUser($index)">manage_accounts</span></td>
                        <td style="width: 1px; cursor: pointer"><span class="material-icons" ng-click="obrisiKorisnika(oKorisnik.gledatelj_id)">person_remove</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <script src="js/app.js"></script>
        <script src="js/animations.js"></script>
    </body>
</html>

<div class="modal-container" id="editUser">
    <div class="modal">
      <h1 class="modal__title">Uređivanje</h1>
      <div class="form-user">
            <form autocomplete="off">
                <div>
                    <label>ID gledatelja:</label>
                    <div>
                        <input disabled id="editID" class="modal__user-input" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "6" autocomplete="off" placeholder=""/>
                    </div>
                    <label>Ime:</label>
                    <div>
                        <input id="editIme" type="text" name ="ime" class="modal__user-input" autocomplete="off" placeholder=""/>
                    </div>
                    <label>Prezime:</label>
                    <div>
                        <input id="editPrezime" type="text" name ="prezime" class="modal__user-input" autocomplete="off" placeholder=""/>
                    </div>
                </div>
                </br>
                <button class="modal__btn" ng-click="urediKorisnika($index)">Uredi</button>
            </form>
        </div>
      <a class="modal__btn-close" ng-click="closeModalEditUser()"></a>
    </div>
  </div>
</div>