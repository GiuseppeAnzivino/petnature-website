<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PetNature-Login</title>


    <!--Stylesheet della page-->
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/sign_or_log.css">
    <link rel="stylesheet" href="../css/footer.css">

    <!--Link per le icone-->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>

    <!--Script animazione Input-->
    <script src="../javascript/inputAnimation.js"></script>
    



    <!--Header della login Page -->
    <header>

        <!--Logo con Nome-->
        <h1 class="logo">
            <a href="../php/home.php">
                <img src="../immagini/logoPetNaturecentrato.png">
                <p>PetNature</p>
            </a>
        </h1>

        <!--Pulsante per il menu, usato per dispositivi con schermo piccolo-->
        <div class="menu-container">
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>


        <!--Barra-->
        <ul class="navbar">
            <li><a href="../php/home.php">Home</a></li>
            <li><a href="../php/chisiamo.php">About Us</a></li>
            <li><a href="../php/animali.php">Animali</a></li>
            <li><a href="../php/accessori.php">Accessori</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
        

    </header>
    <!-- Fine header -->




    <!--Section della Login Page-->
    <section>


        <!--PHP Controlli per avvio Login-->
        <?php

            /*Sticky form Activity*/
            if(isset($_POST["password"])){
                $pwd=$_POST["password"];
            }else{
                $pwd="";
            }
            if(isset($_POST["email"])){
                $email=$_POST["email"];
            }else{
                $email="";
            }

            if ( !empty($_POST) && $_POST["login"]=="login"){

                /*Collegamento al Database*/
                require_once "connectDb.php";

                /*Inizializzazione Autorizzato e variabili form*/
                $_SESSION["autorizzato"] = false;
                $email_ok = pg_escape_literal($email);
                $password_ok = pg_escape_literal($pwd);

                /*Trovare utente attraverso email*/
                $sql= "SELECT * FROM utente WHERE email=".$email_ok;
                $ret = pg_query($db, $sql);

                /*Controllo Query*/
                if($ret) {

                    /*Elementi della Query*/
                    $row = pg_fetch_assoc($ret);

                    if($row!=null){
                    
                        /*Controllo della password*/
                        if(password_verify($password_ok, $row['password'])){

                            /*Aggiunta alla session dell'email e set di autorizzato a true*/
                            $_SESSION["email"] = $row['email'];
                            $_SESSION["autorizzato"] = true;
                            header("Location: ../php/home.php");

                        }else{

                        
                            echo "<script> alert('Password errata')</script>";

                            $pwd="";
                        }
                        /*Fine controllo della password*/
                    }else{
                        echo "<script> alert('Account inesistente')</script>";

                        $email="";
                    }
                }else{
                
                    
                    echo "<script> alert ('Login non avvenuto'); </script>";

                    
                }
                /*Fine Controllo Query*/

                /*Chiusura Database*/
                pg_close($db);

            }
            /*Fine controllo avvio Login*/

        ?>



        <!--Form per il Login-->
        <form class="form" action = <?php echo $_SERVER['PHP_SELF']?> method= "POST" autocomplete="off">
            

            <!--Title-->
            <h1 class="title">Login</h1>


            <!--Content text-->
            <p>Inserisci le tue credenziali di accesso<br>personali</p>


            <!--Input e lable per email-->
            <div class="input-menu">
                <input type="text" class="input" id="email" name="email" value= "<?php echo $email ?>" onchange="changeInput('email', '1')" required />
                <label for="email" class="label" id="1">  E-Mail  </label>
            </div>

            
            <!--Input e label per password-->
            <div class="input-menu">    
                <input type="password" class="input" id="password" name="password" value= "<?php echo $pwd ?>" onchange="changeInput('password', '2')" required />
                <label for="password" class="label" id ="2">  Password  </label>
                <i class='bx bxs-low-vision' id="eye" onclick="changeType('password')"></i>
            </div>


            <!--Submit per Login-->
            <input type="submit" id="login" name="login" value="login" required />


            <!--Linea di separazione-->
            <div class="line">
                <hr>OR<hr>
            </div>


            <!--Content text per la registrazione-->
            <p>Non possiedi un account?<a href="recordDb.php"> Registrati </a></p>

            <!--Script animazione input dipendente dal form sticky-->
            <script>
                var input = document.querySelectorAll('.input');
                var label = document.querySelectorAll('.label');
                for(var i = 0; i < input.length; i++){
                    if(input[i].value!=""){
                        input[i].classList.add('active');
                        label[i].classList.add('active');
                    }
                }
            </script>



        </form>
        <!--Fine form per il Login-->

    </section>
    <!--Fine section-->




    <!--Footer della Login Page-->
    <footer id="contact">

        
        <!--Contenuti Footer-->
        <div class="content-menu">


            <!--Contatti-->
            <div class="content">
                <h1>Contattaci</h1>
                <ul>
                    <li><a href="mailto: g.anzivino@studenti.unisa.it">g.anzivino@studenti.unisa.it</a></li>
                    <li><a href="mailto: a.trofimets@studenti.unisa.it">a.trofimets@studenti.unisa.it</a></li>
                    <li><a href="mailto: g.petrone27@studenti.unisa.it">g.petrone27@studenti.unisa.it</a></li>
                </ul>
           </div>
           <!--Fine Contatti-->


            <!--Posizione-->
            <div class="content">   
                <h1>Posizione</h1>
                <ul>
                    <li id="location"></li>
                </ul>
                <script src="../javascript/geoloc.js"></script>
            </div>
            <!--Fine Posizione-->


        </div>
        <!--Fine contenuti Footer-->


        <!--Collegamento ai Social-->
        <div class="social">
            <a href="https://www.instagram.com/official.petnature/"><i class='bx bxl-instagram' id="instagram"></i></a>
            <a href="https://www.facebook.com/?locale=it_IT"><i class='bx bxl-facebook-square' id="facebook"></i></a>
            <a href="https://twitter.com/?lang=it"><i class='bx bxl-twitter' id="twitter"></i></a>
        </div>


        <!--Riga Copyright-->        
        <div class="last">
            <p>© 2024 by PetNature's team. Enjoy the nature</p>
        </div>


    </footer>
    <!--Fine footer-->


    <!--Script per la barra del menu quando si hanno schermi piccoli-->
    <script src="../javascript/menubar.js"></script>
    
    
</body>
</html>