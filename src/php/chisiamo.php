<!--Connessione al Database e avvio Sessione-->
<?php
    require_once "../db/connectDb.php";
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>PetNature - About Us</title>

    <!--Stylesheet della page-->
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/chisiamo.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/mynav.css">


    <!--Link per le icone-->
    <link rel="stylesheet"href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>

<body>

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
                $ret = pg_query($db,$sql);
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


    <!--Header del Chi Siamo-->
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
            <li><a href="../php/animali.php">Animali</a></li>
            <li><a href="../php/accessori.php" >Accessori</a></li>
            <li><a href="#contact" >Contact</a></li>
        </ul>
    

        <!--Icona per la barra laterale-->
        <div class="icons">
            <i class='bx bx-user-circle' id='user-icon'></i>
            <?php if(isset($_SESSION['autorizzato'])){ ?>
                <a href="../php/carrello.php"><i class='bx bx-cart'></i></a>
            <?php } ?>
        </div>


    
    </header>
    <!-- Fine header -->


    <!--Section About Us-->
    <section>

        <!--Title-->
        <div class="titolo">
            <div class="testo"><p>Amore<br>Famiglia<br>Passione</p></div>
            <img src="../immagini/gatto.jpg" alt="immagine_gatto">
        </div>


        <!--Content Text 1-->
        <div class="corpo1 fade-in">
            <div class="testo"><h2>Una Conduzione Famigliare</h2><p> Siamo una <strong>famiglia</strong> appassionata di animali da generazioni. La nostra storia è intrecciata con la <strong>cura</strong> e la passione per la crescita e il benessere degli <strong>animali di razza</strong>. Ogni membro della nostra famiglia è cresciuto imparando il <strong>rispetto</strong> e <strong>l'amore</strong> per questi esseri viventi.</p></div>
            <img src="../immagini/casa.jpg" alt="casa">
        </div>


        <!--Content Text 2-->
        <div class="corpo2 fade-in">
            <img src="../immagini/cani_prato.jpg" alt="cani prato">
            <div class="testo"><h2>I Nostri Principi</h2><p>La nostra filosofia è sempre stata quella di mantenere alti standard di <strong>benessere</strong> animale. Oltre a fornire le cure necessarie, ci assicuriamo che gli animali abbiano <strong>ampi spazi</strong> dove muoversi liberamente e abbiano accesso a un ambiente naturale il più possibile. Ci preoccupiamo anche di garantire che abbiano <strong>interazioni positive</strong> con le persone e con gli altri animali, contribuendo così al loro <strong>equilibrio</strong> e alla loro <strong>felicità</strong>.</p></div>
        </div>


        <!--Content Text 3-->
        <div class="corpo3 fade-in">
            <div class="testo"><h2>Disponibilità ed efficenza</h2><p>Grazie al nostro <strong>supporto</strong>, reperibile per <strong>chiarimenti</strong> e <strong>consigli</strong> su come trattare i vostri animali, vi <strong>daremo una mano</strong> nel vostro primo approccio e ad instaurare un rapporto di <strong>fiducia</strong> e <strong>amore</strong> con il vostro nuovo animale da compagnia. Veniteci a trovare a Salerno, vi aspettiamo!</p></div>
            <img src="../immagini/cani_salotto.jpg" alt="cani divano">
        </div>


        <!--Script animazione Content Text-->
        <script src="../javascript/fadein.js"></script>


    </section>
    <!--Fine Section-->



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
                <h1>Posizione Cliente</h1>
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