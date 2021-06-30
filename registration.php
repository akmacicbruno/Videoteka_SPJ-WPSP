<!DOCTYPE html>
<html lang="hr">
    <head>
        <meta charset="utf-8">
        <title>Videoteka | Registracija</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="assets/plugins/angularjs/angular.min.js"></script>
        <script src="assets/plugins/angularjs/angular-route.min.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="assets/plugins/jquery/jquery-3.2.1.min.js"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
        <script src="js/registration.js"></script>
        <link rel="stylesheet" href="css/login_style.css">
    </head>
    <body ng-app="reg-app" ng-controller="administracija">
    <br />
        <h3 class="site-title">Dodavanje admina u bazu</h3>
        <div class="form">
            <form autocomplete="off">
                <div class="form__reg">
                <label>Korisničko ime:</label>
                    <div>
                        <input id="regUsername" type="text" class="form__reg-input" autocomplete="off" placeholder=""/>
                    </div>
                    <label>Lozinka:</label>
                    <div>
                        <input id="regPass" type="password" class="form__reg-input" autocomplete="off" placeholder=""/>
                    </div>
                    <label>Ponovoljena lozinka:</label>
                    <div>
                        <input id="regPass2" type="password" class="form__reg-input" autocomplete="off" placeholder=""/>
                    </div>
                </div>
                </br>
                <button class="form__reg-btn" ng-click="regUser()">Registracija</button>
            </form>
        </div>
    </body>
</html>