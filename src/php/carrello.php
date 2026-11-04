<?php 
    //Connessione al Database e avvio Sessione
    require_once "../db/connectDb.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PetNature-Cart</title>

    <!--Stylesheet della page-->
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/carrello.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/mynav.css">
    

    <!--Link per le icone-->
    <link rel="stylesheet"href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <script src="../javascript/gestoreCarrello.js"></script>
</head>
<body>
    
    <!--Barra laterale per l'utente-->
    <div id="myNav" class="overlay">

        <!--Contenuti barra laterale-->
        <div class="overlay-content">


        <!--Php per il controllo del login-->
        <?php 
            if(isset($_SESSION["autorizzato"])){
                $email_utente = $_SESSION['email'];

                /*Query di selezione*/
                $sql = "SELECT nome, cognome, email FROM utente WHERE utente.email= '$email_utente' ";
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
            <li><a href="../php/accessori.php" >Accessori</a></li>
            <li><a href="#contact" >Contact</a></li>
        </ul>


        <!--Icona per la barra laterale-->
        <div class="icons">
            <i class='bx bx-user-circle' id='user-icon'></i>
        </div>



    </header>
    <!-- Fine header -->
    <section>
        <h1 class="cart">Il tuo carrello</h1>
<?php

    // Controlla se il carrello è vuoto
    if (empty($_SESSION['carrello'])) { 
?>
    <table>
        <thead>
            <tr>
                <th>Oggetto</th>
                <th>Prezzo</th>
                <th>Rimuovi</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot></tfoot>
    </table>
    <p class="vuoto">Il carrello è vuoto</p>
    <?php
    } else {
    // Mostra i prodotti nel carrello
    ?>
    <table>
        <thead>
            <tr>
                <th>Oggetto</th>
                <th>Prezzo</th>
                <th>Rimuovi</th>
            </tr>
        </thead>
    <?php
    foreach ($_SESSION['carrello'] as $index => $prodotto) {
    ?>
        <tbody>
            <tr>
                <td>
                    <?php echo "<p class='table'>$prodotto[nome]</p>";?>
                </td>
                <td>
                    <?php echo "<p class='table'>$prodotto[prezzo] €</p>";?>
                </td>
                <td>
                    <?php echo "<button onclick=\"rimuoviProdotto($index)\">Rimuovi</button>"; ?>
                </td>
            </tr>
        </tbody>
    <?php
    }

    // Calcola il totale dei prezzi
    $totale = 0;
    foreach ($_SESSION['carrello'] as $prodotto) {
        $totale += $prodotto['prezzo'];
    }

    // Salvataggio delle informazioni del carrello nel database
    $nomi_prodotto = array_column($_SESSION['carrello'], 'nome');
    $prezzi_prodotto = array_column($_SESSION['carrello'], 'prezzo');
    ?>
<tfoot>
    <tr>
        <th>Totale</th>
        <td colspan="2">
            <?php echo "<p class='table'>$totale €<p>"; ?>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <button onclick="inviaProdotti()"><i class='bx bx-cart'></i>Conferma ordine</button>
        </td>
    </tr>
</tfoot>
</table>
    
    <?php } ?>

<script>
    //funzione per l'invio degli elementi al database
    function inviaProdotti() {
        // Recupera i dati del carrello
        var nomiProdotto = [];
        var prezziProdotto = [];
        var totale = <?php echo $totale ?>;
        <?php foreach ($_SESSION['carrello'] as $prodotto): ?>
            nomiProdotto.push("<?php echo $prodotto['nome']; ?>");
            prezziProdotto.push("<?php echo $prodotto['prezzo']; ?>");
        <?php endforeach; ?>

        // Invia i dati al server tramite AJAX
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "../db/inserisciOrdineDB.php", true);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState === 4 && xhttp.status === 200) {
                // Gestisci la risposta del server
                alert("Ordine confermato!");
            }
        };
        var params = "nomiProdotto=" + encodeURIComponent(nomiProdotto.join(",")) +
                "&prezziProdotto=" + encodeURIComponent(prezziProdotto.join(",")) +
                "&totale= " + totale;
        xhttp.send(params);
        location.reload();// Ricarica la pagina dopo l'invio del carrello
    }

</script>

</section>
    <!--Footer dello shop di animali-->
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