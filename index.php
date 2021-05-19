<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="hr">
    <head>
        <meta charset="utf-8">
        <title>Test</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet"> 
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/nav_style.css">
    </head>
    <body>
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="#">Posuđeni filmovi</a>
            <a href="#">Svi korisnici</a>
            <a href="#">Statistika</a>
            <!--<button type="button" class="sidenav__logoff">ODJAVA</button>-->
        </div>
        <div class="navbar">
            <span class="material-icons sidenav__icon" onclick="openNav()">menu</span>
            <span class="sidenav__text">VIDEOTEKA</span>
            
            <!--<span class="material-icons user">perm_identity</span>-->
            
            <div class="navbar__dropdown">
                <h3 class="navbar__currentuser"><?php echo htmlspecialchars($_SESSION["username"]); ?></h3>
                <span class="navbar__dropdown__btn material-icons navbar__dropdown__usericon">perm_identity</span>
                <div class="navbar__dropdown__content">
                <a href="reset-password.php">Promijeni lozinku</a>
                <a href="logout.php">Odjava</a>
                </div>
            </div>
        </div>
        
        <div id="main">
            <div>
              <img class="img" src="img/camera.jpg">
              <h1 class="main__title">Dobrodošli!</h1>
            </div>
        </div>
        <script src="js/animations.js"></script>
    </body>
</html>