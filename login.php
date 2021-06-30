<?php
include "connection.php";
session_start();  
if(isset($_POST["login"]))  
    {  
        if(empty($_POST["username"]) || empty($_POST["password"]))  
        {  
            $message = '<label>Potrebno je popuniti sva polja!</label>';  
        }  
        else  
        {  
            $query = "SELECT * FROM admins WHERE username = :username AND password = :password";  
            $statement = $oConnection->prepare($query);  
            $statement->execute(  
                array(  
                    'username' => $_POST["username"],  
                    'password' => $_POST["password"]  
                    )  
            );  
            $count = $statement->rowCount();  
            if($count > 0)  
            {
                $_SESSION["username"] = $_POST["username"];  
                header("location: index.php");  
            }  
            else  
            {  
                $message = '<label>Pogrešan unos!</label>';  
            }  
        }  
    }
?> 
<!DOCTYPE html>  
 <html>  
      <head>  
           <title>Videoteka | Prijava</title> 
           <meta name="viewport" content="width=device-width, initial-scale=1.0">  
           <script src="assets/plugins/angularjs/angular.min.js"></script>
            <script src="assets/plugins/angularjs/angular-route.min.js"></script>
           <link rel="stylesheet" href="css/login_style.css">
           <script src="js/registration.js"></script>
           <link rel="stylesheet" href="css/modal.css">
      </head>  
      <body style="background-image: url(https://s3-us-west-2.amazonaws.com/flx-editorial-wordpress/wp-content/uploads/2018/03/13153742/RT_300EssentialMovies_700X250.jpg)">  
      <br />  
           <div class="login-container">   
                <h3 class="login-container__title">Prijava u sustav</h3><br/>  
                <form method="post" autocomplete="off"> 
                    <input type="text" id="username_login" name="username" class="login-container__input" autocomplete="off" placeholder="Korisničko ime"/>  
                    <br/>
                    <input type="password" id="username_pass" name="password" class="login-container__input" autocomplete="off" placeholder="Lozinka"/>  
                    <br/>  
                    <?php  
                        if(isset($message))  
                        {  
                            echo '<label style="color:red;">'.$message.'</label>';  
                        }  
                    ?>
                    </br>
                    <input type="submit" name="login" class="login-container__btn" value="Prijava" /></br></br>
                    <a type="button" class="login-container__btn" href="registration.php">Registracija</a>  
                </form>  
           </div>  
           <br />  
      </body>  
 </html>