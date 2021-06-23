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
<header>
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="rented_movies.php">Posuđeni filmovi</a>
        <a href="addmovie.php">Dodaj film</a>
        <a href="users.php">Svi korisnici</a>
        <a href="adduser.php">Dodaj korisnika</a>
        <a href="statistics.php">Statistika</a>
    </div>
    <div class="navbar">
        <span class="material-icons sidenav__icon" onclick="openNav()">menu</span>
        <span class="sidenav__text"><a href="index.php" style="text-decoration: none; color: rgb(154, 160, 166);">VIDEOTEKA</a></span>
        
        <div class="navbar__dropdown">
            <span class="navbar__dropdown__btn material-icons navbar__dropdown__usericon">perm_identity</span>
            <div class="navbar__dropdown__content">
                <a class="navbar__currentuser"><?php echo htmlspecialchars($_SESSION["username"]); ?></a>
                <hr class="solid"></hr>
                <a href="logout.php">Odjava</a>
            </div>
        </div>
    </div>
</header>