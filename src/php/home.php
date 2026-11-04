<!--Connessione al Database e avvio Sessione-->
<?php
    require_once "../db/connectDb.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PetNature - Home</title>

    <!--Stylesheet della page-->
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/mynav.css">

    <!--Script per lo slider di immagini-->
    <script src="../javascript/slider.js"></script>

    <!--Link per le icone-->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>

<body onload="showSlides(1)">

    <!--Barra laterale per l'utente-->
    <div id="myNav" class="overlay">

        <!--Contenuti barra laterale-->
        <div class="overlay-content">


        <!--Php per il controllo del login-->
        <?php 
            if(isset($_SESSION["autorizzato"])){
                $email_utente = $_SESSION["email"];

                /*Query di selezione*/
                $sql = "SELECT nome, cognome, email FROM utente WHERE email='$email_utente'";
                $ret = pg_query($db, $sql);
                $ris = pg_fetch_row($ret);
                $nome = $ris[0];
                $cognome = $ris[1];
                $email = $ris[2];?> 
        

                <!--Campi della barra se si è loggati-->
                <div class="campi"><?php echo $nome ?></div>
                <div class="campi"><?php echo  $cognome ?></div>
                <div class="campi"><?php echo $email ?></div>
                <a class="inout" href="../db/logout.php">LogOut</a><?php 

            }else {?>  
                
                <!--Campi della barra se non si è loggati-->
                <div class="campi">Effettua il login<br> o registrati</div>
                <a class="inout" href="../db/loginDb.php">LogIn</a>/<a class="inout" href="../db/recordDb.php">Registrati</a><?php  
            }
        ?>
        <!--Fine Controllo-->

        </div>
    </div>
    <!--Fine div per la barra-->


    <!--Header della Home Page-->
    <header>

        <!--Logo con Nome-->
        <h1 class="logo">
            <img src="../immagini/logoPetNaturecentrato.png">
        </h1>
        
        <!--Title-->
        <div class="titolo">
            <h1>PetNature</h1>
            <h2 class="sottotitolo">al fianco dei vostri animali dal 2024</h2>
        </div>
            
        
        <!--Icona per la barra laterale-->
        <div class="icons">
            <i class='bx bx-user-circle' id='user-icon'></i>
            <?php if(isset($_SESSION['autorizzato'])){ ?>
                <a href="../php/carrello.php"><i class='bx bx-cart'></i></a>
            <?php } ?>
        </div>

        <!--Script per la barra laterale-->
        <script src="../javascript/utenteMenu.js"></script>

    </header>    
    <!--Fine header-->


    <!--Section dello slider-->        
    <section class="slide-show container">

        <!--Prima slide: About Us-->
        <div class="mySlides fade"> 
            <p class="numbertext">1 / 4</p>
            <div class="video">
                <video src="../video/occhio_cavallo.mp4" alt="Occhio del cavallo" autoplay loop ></video> 
                <button class="prev" onclick="plusSlides(-1)"><div class="freccia">&#10094;</div></button>
                <button class="next" onclick="plusSlides(1)"><div class="freccia">&#10095;</div></button>
                <div class="text"><a class="page" href="../php/chisiamo.php">ABOUT US</a></div>
            </div>
        </div>


        <!--Controllo per il Login-->
        <?php 
            if(isset($_SESSION["autorizzato"])){?>    
                
                
                <!--Seconda Slide se si è loggati: LOGOUT-->
                <div class="mySlides fade"> 
                    <p class="numbertext">2 / 4</p>
                    <div class="video">
                        <video src="../video/grano.mp4" alt="Campo di grano" autoplay loop></video>
                        <button class="prev" onclick="plusSlides(-1)"><div class="freccia">&#10094;</div></button>
                        <button class="next" onclick="plusSlides(1)"><div class="freccia">&#10095;</div></button>
                    </div>
                    <div class="text"><a class="page" href="../db/logout.php">LOGOUT</a></div>
                </div><?php

            }else{?>

                <!--Seconda Slide se non si è loggati: LOGIN-->
                <div class="mySlides fade">
                    <div class="numbertext">2 / 4</div>
                    <div class="video">
                        <video src="../video/grano.mp4" alt="Campo di grano" autoplay loop></video>
                        <button class="prev" onclick="plusSlides(-1)"><div class="freccia">&#10094;</div></button>
                        <button class="next" onclick="plusSlides(1)"><div class="freccia">&#10095;</div></button>
                    </div>
                    <div class="text"><a class="page" href="../db/loginDb.php">LOGIN</a></div>
                </div><?php 
            }
        ?>
        <!--Fine controllo-->



        <!--Terza Slide: Animali-->
        <div class="mySlides fade"> 
            <div class="numbertext">3 / 4</div>
            <div class="video">
                <video src="../video/gattini.mp4" alt="Gattini che bevono il latte" autoplay loop></video> 
                <button class="prev" onclick="plusSlides(-1)"><div class="freccia">&#10094;</div></button>
                <button class="next" onclick="plusSlides(1)"><div class="freccia">&#10095;</div></button>
            </div>
            <div class="text"><a class="page" href="../php/animali.php">ANIMALI</a></div>
        </div>


        <!--Quarta Slide: Accessori-->
        <div class="mySlides fade"> 
            <div class="numbertext">4 / 4</div>
            <div class="video">
                <video src="../video/cane_freesbe.mp4" alt="Cane che gioca" autoplay loop></video>
                <button class="prev" onclick="plusSlides(-1)"><div class="freccia">&#10094;</div></button>
                <button class="next" onclick="plusSlides(1)"><div class="freccia">&#10095;</div></button>
            </div>
            <div class="text"><a class="page" href="../php/accessori.php">ACCESSORI</a></div>
        </div>


        <!--Pallini per facilitare il passaggio da una slide ad un altra-->
        <div class="pallini">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
            <span class="dot" onclick="currentSlide(4)"></span>
        </div>

    </section>
    <!--Fine Section-->

    
    <!--Footer della Login Page-->
    <footer>

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
            <div class = "content">                    
                <h1>Posizione</h1>
                <ul>
                    <li id="location"></li>
                </ul>
                <script src="../javascript/geoloc.js"></script>

            </div>
            <!--Fine Posizione-->

        </div>
        <!--Fine Contenuti footer-->


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
    <!--Fine Footer-->
    
</body>
</html>