<!--Connessione al Database e avvio Sessione-->
<?php
    require_once "../db/connectDb.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PetNature-Store-Animali</title>

    <!--Stylesheet della page-->
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/shop.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/mynav.css">
    

    <!--Link per le icone-->
    <link rel="stylesheet"href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <!--Script gestione Carrello-->
    <script src="../javascript/gestoreCarrello.js"></script>
</head>


<body>
        
    <!--Script per animazione card-->
    <script>
        function changeCard(card){

            let box = document.getElementById(card);
            box.classList.toggle('active');

            window.onscroll = () =>{
                let total = document.querySelectorAll('.card');
                for(i=0; i<total.length; i++){
                    total[i].classList.remove('active');
                }
            }
        }
    </script>
    <!--Fine Script-->


        
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



    <!--Header dello shop di animali-->
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



    <!---Section dello shop-->
    <section class="shop" id="shop">

        <!--Card-->
        <div class="card" id="1">
            <div class="front" onclick="changeCard('1')">
                <div class="box-img" >
                    <img src="../immagini/beagle.jpg"">
                </div>
                <h4>Beagle</h4>
                <h5>€800,00</h5>
            </div><?php 
            if(isset($_SESSION["autorizzato"])){ ?>
                <div class="cart" onclick="addToCart('Beagle',800.00)">
                    <i  class='bx bx-cart'></i> 
                </div><?php
            }else{?>
                <div class="cart" onclick="alert('Effettua il Login o Registrati per utilizzare il carrello')">
                    <i  class='bx bx-cart'></i> 
                </div><?php
            }?>
            <div class="back" onclick="changeCard('1')">
                <h1>Beagle</h1>
                <p>
                    Tra i cani più famosi al mondo, i Beagle sono animali fedeli, affettuosi e intelligenti. Con i
                    loro grandi occhi marroni, le orecchie cadenti e l'espressione "languida", è anche difficile
                    resistere a questi bei cani. Il loro passato di cacciatori può rendere l'educazione difficile e
                    tendono ad abbaiare più della media, ma i Beagle valgono assolutamente lo sforzo extra.
                    Con un po' di tempo e pazienza, presto avrai uno "Snoopy" al tuo fianco.
                </p>
            </div>
        </div>

        
        <!--Card-->
        <div class="card" id="2">
            <div class="front" onclick="changeCard('2')">
                <div class="box-img">
                    <img src="../immagini/kishu.jpg">    
                </div>
                <h4>Kishu</h4>
                <h5>€2.000,00</h5>
            </div><?php 
            if(isset($_SESSION["autorizzato"])){ ?>
                <div class="cart" onclick="addToCart('Kishu',2000.00)">
                    <i  class='bx bx-cart'></i> 
                </div><?php
            }else{?>
                <div class="cart" onclick="alert('Effettua il Login o Registrati per utilizzare il carrello')">
                    <i  class='bx bx-cart'></i> 
                </div><?php
            }?>
            <div class="back" onclick="changeCard('2')">
                <h1>Kishu</h1>
                <p>
                    Il Kishu è un cane di taglia media, ben proporzionato, molto muscoloso ed energico.
                    Nobile, dignitoso e naturale, è un cane fedele, docile e molto vigile. Ha le orecchie erette e
                    la coda arrotolata o a forma di falce. È compatto, di costituzione robusta e con una buona
                    ossatura. Attualmente, il colore più popolare di questa razza è il bianco. Questo cane viene utilizzato
                    per la caccia al cinghiale, un tempo anche al cervo. La razza ha assunto il nome della
                    regione in cui è stata allevata.
                </p>
            </div>
        </div>

            
        <!--Card-->
        <div class="card" id="3">
            <div class="front" onclick="changeCard('3')">
                <div class="box-img">
                    <img src="../immagini/british.jpg">
                </div>
                <h4>British shorthair</h4>
                <h5>€1.000,00</h5>
            </div><?php 
            if(isset($_SESSION["autorizzato"])){ ?>
                <div class="cart" onclick="addToCart('British Shorthair', 1000.00)">
                    <i  class='bx bx-cart'></i> 
                </div><?php
            }else{?>
                <div class="cart" onclick="alert('Effettua il Login o Registrati per utilizzare il carrello')">
                    <i  class='bx bx-cart'></i> 
                </div><?php
            }?>
            <div class="back" onclick="changeCard('3')">
                <h1>British Shorthair</h1>
                <p>
                    Come si fa a non innamorarsi di un British Shorthair? Ti attirerà il suo musetto paffuto e la
                    pelliccia morbida come seta, ma sarà il suo comportamento educato a renderlo
                    irresistibile. Questa dolce razza si contraddistingue per un miagolio appena udibile ma
                    emette fusa prolungate, ama ricevere le coccole solo quando è in vena. Altrimenti, il British
                    Shorthair rimane un tenace osservatore e un compagno silenzioso.
                </p>
            </div>
        </div>


        <!--Card-->
        <div class="card" id="4">
            <div class="front" onclick="changeCard('4')">
                <div class="box-img">
                    <img src="../immagini/tonchinese.jpg">
                </div>
                <h4>Tonchinese</h4>
                <h5>€1.300,00</h5>
            </div><?php 
            if(isset($_SESSION["autorizzato"])){ ?>
                <div class="cart" onclick="addToCart('Tonchinese', 1300.00)">
                    <i  class='bx bx-cart'></i> 
                </div><?php
            }else{?>
                <div class="cart" onclick="alert('Effettua il Login o Registrati per utilizzare il carrello')">
                    <i  class='bx bx-cart'></i> 
                </div><?php
            }?>
            <div class="back" onclick="changeCard('4')">
                <h1>Tonchinese</h1>
                <p>
                    Il Tonchinese è un gatto molto socievole e preferirebbe vivere in compagnia di altri simili.
                    Intelligenti e generosi con il loro affetto, i Tonchinesi cercheranno di essere coinvolti in tutte
                    le attività domestiche. Si tratta di un gatto che ama la compagnia e che ama essere al centro dell'attenzione.
                </p>
            </div>
        </div>
                

        <!--Card-->
        <div class="card" id="5">
            <div class="front" onclick="changeCard('5')">
                <div class="box-img">
                    <img src="../immagini/haflinger.png">
                </div>
                <h4>Haflinger</h4>
                <h5>€6.000,00</h5>
            </div><?php 
            if(isset($_SESSION["autorizzato"])){ ?>
                <div class="cart" onclick="addToCart('Haflinger', 6000.00)">
                    <i  class='bx bx-cart'></i> 
                </div><?php
            }else{?>
                <div class="cart" onclick="alert('Effettua il Login o Registrati per utilizzare il carrello')">
                    <i  class='bx bx-cart'></i> 
                </div><?php
            }?>
            <div class="back" onclick="changeCard('5')">
                <h1>Haflinger</h1>
                <p>
                    L' Haflinger è la razza equina italiana più diffusa in tutto il Paese, allevata in cinque
                    continenti. Il successo dei cavalli Haflinger viene, soprattutto, dal carattere amabile, dolce
                    e buono e dal grande attaccamento nei confronti dell'uomo. E' un cavallo fedele e
                    generoso. I cavalli Haflinger sono atletici ed energici. L'equilibrio che riescono a mettere tra velocità
                    dell'andatura è davvero notevole. Molti Haflinger, infatti, vengono impiegato in
                    competizioni di endurance e di monta western o in concorsi di salto ostacoli e volteggio.
                </p>
            </div>
        </div>
            

        <!--Card-->
        <div class="card" id="6">
            <div class="front" onclick="changeCard('6')">
                <div class="box-img">
                    <img src="../immagini/sella_italiano.png">
                </div>
                <h4>Sella Italiano</h4>
                <h5>€7.500,00</h5>
            </div><?php 
            if(isset($_SESSION["autorizzato"])){ ?>
                <div class="cart" onclick="addToCart('Sella Italiano',7500.00)">
                    <i  class='bx bx-cart'></i> 
                </div><?php
            }else{?>
                <div class="cart" onclick="alert('Effettua il Login o Registrati per utilizzare il carrello')">
                    <i  class='bx bx-cart'></i> 
                </div><?php
            }?>
            <div class="back" onclick="changeCard('6')">
                <h1>Sella Italiano</h1>
                <p>
                    Il Cavallo sella italiano è una razza equina derivante prevalentemente da incroci del
                    purosangue inglese, arabo, anglo-arabo e loro derivati, o anglo-arabo sardo e suoi
                    derivati, con fattrici di razze tipiche della penisola italiana con principale attitudine alla
                    sella. Lo scopo principale di questi incroci è quello di ottenere delle tipiche caratteristiche: un
                    cavallo dall'aspetto elegante e nobile; con la robustezza tipica del purosangue inglese e la
                    grande affidabilità delle razze italiche. Il cavallo sella italiano viene prevalentemente
                    utilizzato nelle competizioni sportive come salto ostacoli e dressage. Il cavallo sella italiano ha 
                    una conformazione armonica, struttura scheletrica e masse muscolari adatte alla prestazione
                    atletica e ad andature sciolte. Ha una testa elegante e ben proporzionata con collo
                    lungo e ben costruito. La schiena è resistente e ben fatta, termina con groppa e posteriori ben modellati. 
                </p>
            </div>
        </div>

        <!--Card-->
        <div class="card" id="7">
            <div class="front" onclick="changeCard('7')">
                <div class="box-img">
                    <img src="../immagini/ara.png">
                </div>
                <h4>Ara giacinto</h4>
                <h5>€35.000,00</h5>
            </div><?php 
            if(isset($_SESSION["autorizzato"])){ ?>
                <div class="cart" onclick="addToCart('Ara Giacinto',35000.00)">
                    <i  class='bx bx-cart'></i> 
                </div><?php
            }else{?>
                <div class="cart" onclick="alert('Effettua il Login o Registrati per utilizzare il carrello')">
                    <i  class='bx bx-cart'></i> 
                </div><?php
            }?>
            <div class="back" onclick="changeCard('7')">
                <h1>Ara Giacinto</h1>
                <p>
                    L'Ara Giacinto è un pappagallo che si affeziona molto alla persona, è molto
                    docile e giocherellone. Buon parlatore, è anche in grado di eseguire esercizi di abilità.
                    Vista la sua grande taglia ha bisogno di molto spazio, molti giocattoli e bagni giornalieri. E’
                    a volte molto rumoroso.
                </p>
            </div>
        </div>

            

        <!--Card-->
        <div class="card" id="8">
            <div class="front" onclick="changeCard('8')">
                <div class="box-img">
                    <img src="../immagini/conuro.png">
                </div>
                <h4>Conuro testa nera</h4>
                <h5>€500,00</h5>
            </div><?php 
            if(isset($_SESSION["autorizzato"])){ ?>
                <div class="cart" onclick="addToCart('Conuro Testa Nera',500.00)">
                    <i  class='bx bx-cart'></i> 
                </div><?php
            }else{?>
                <div class="cart" onclick="alert('Effettua il Login o Registrati per utilizzare il carrello')">
                    <i  class='bx bx-cart'></i> 
                </div><?php
            }?>
            <div class="back" onclick="changeCard('8')">
                <h1>Canuro Testa Nero</h1>
                <p>
                    Il piumaggio è in generale verde con la caratteristica testa nera, becco completamente
                    nero, anello perioftalmico marrone, petto azzurro, remiganti blu, calzoni rossi, groppone
                    verde più chiaro o giallastro. Non ci sono differenze visibili tra maschio e femmina e i
                    soggetti immaturi hanno i colori meno brillanti e non hanno il petto interamente azzurro.
                    Si nutre in prevalenza di semi ma anche frutta, bacche e vegetali vari.
                </p>
            </div>
        </div>


        <!--Controllo se si è loggati-->
        <?php
            if(!isset($_SESSION["autorizzato"])){?>
                

                <!--Script per ridurre visibilità contenuti-->
                <script>
                    let img=document.querySelectorAll('.box-img');

                    for(i=1; i<img.length; i++){
                        img[i].classList.add('active');
                    }

                    let testi = document.querySelectorAll('.back p');
                
                    for(i=1; i<testi.length; i++){
                        testi[i].classList.add('active');
                    }

                    let prezzi = document.querySelectorAll('.front h5');

                    for(i=1; i<prezzi.length; i++){
                        prezzi[i].classList.add('active');
                    }
                </script><?php
                /*Fine Script*/
            }
        ?>

    </section>
    <!--Fine Section-->


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