<!--Connessione al Database e avvio Sessione-->
<?php
    require_once "../db/connectDb.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PetNature-Store-Accessori</title>

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
                <a class="inout" href="../db/logout.php" style="cursor:pointer">LogOut</a><?php    
            
            }else {?>

                <div class="campi">Effettua il login o registrati</div>
                <a class="inout" href="../db/loginDb.php">LogIn</a>/<a class="inout" href="../db/recordDb.php">Registrati</a><?php 
            } 
        ?>
        <!--Fine Controllo-->

        </div>
    </div>
    <!--Fine div per la barra-->



    <!--Header dello shop di accessori-->
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
            <i class="bx bx-menu" id="menu-icon"></i>
        </div>

        <!--Barra-->
        <ul class="navbar">
            <li><a href="../php/home.php">Home</a></li>
            <li><a href="../php/chisiamo.php">About Us</a></li>
            <li><a href="../php/animali.php" >Animali</a></li>
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


    <!--Section dello shop-->
    <section class="shop" id="shop">

        <!--Card-->
        <div class="card" id="1">
            <div class="front" onclick="changeCard('1')">
                <div class="box-img" >
                    <img src="../immagini/cibo_gatti.jpg"">
                </div>
                <h4>Cibo per Gatti</h4>
                <h5>€10,00</h5>
            </div><?php 
            if(isset($_SESSION["autorizzato"])){ ?>
                <div class="cart" onclick="addToCart('Cibo per Gatti',10.00)">
                    <i  class='bx bx-cart'></i> 
                </div><?php
            }else{?>
                <div class="cart" onclick="alert('Effettua il Login o Registrati per utilizzare il carrello')">
                    <i  class='bx bx-cart'></i> 
                </div><?php
            }?>
            <div class="back" onclick="changeCard('1')">
                <h1>Cibo per Gatti</h1>
                <p>
                    Questo pacco di cibo per gatti offre un'equilibrata combinazione di nutrienti essenziali per favorire la salute
                    e il benessere felino. Formulato con ingredienti di alta qualità e ricco di proteine, vitamine e minerali,
                    questo alimento promuove la vitalità e la digestione sana del tuo gatto. Confezionato in pratiche porzioni
                    monodose per una freschezza ottimale, è la scelta ideale per mantenere il tuo felino felice e sano ogni
                    giorno.
                </p>
            </div>
        </div>

            
        <!--Card-->
        <div class="card" id="2">
            <div class="front" onclick="changeCard('2')">
                <div class="box-img">
                    <img src="../immagini/cibo_uccelli.jpg">    
                </div>
                <h4>Cibo per Uccelli</h4>
                <h5>€25,00</h5>
            </div><?php 
            if(isset($_SESSION["autorizzato"])){ ?>
                <div class="cart" onclick="addToCart('Cibo per Uccelli',25.00)">
                    <i  class='bx bx-cart'></i> 
                </div><?php
            }else{?>
                <div class="cart" onclick="alert('Effettua il Login o Registrati per utilizzare il carrello')">
                    <i  class='bx bx-cart'></i> 
                </div><?php
            }?>
            <div class="back" onclick="changeCard('2')">
                <h1>Cibo per Uccelli</h1>
                <p>
                    Questo mangime per uccelli è una miscela equilibrata di semi, cereali e altri ingredienti nutrienti,
                    appositamente formulata per soddisfare le esigenze nutrizionali specifiche degli uccelli. Arricchito con
                    vitamine e minerali essenziali, questo alimento favorisce la salute e l'energia dei tuoi amici piumati.
                    Confezionato con cura per garantire la freschezza e la croccantezza, è la scelta ideale per mantenere i tuoi
                    uccelli felici e attivi.
                </p>
            </div>    
        </div>

            
        <!--Card-->
        <div class="card" id="3">
            <div class="front" onclick="changeCard('3')">
                <div class="box-img">
                    <img src="../immagini/distributore_acqua.jpg">
                </div>
                <h4>Distributore Acqua</h4>
                <h5>€12,00</h5>
            </div><?php 
            if(isset($_SESSION["autorizzato"])){ ?>
                <div class="cart" onclick="addToCart('Distributore Acqua',12.00)">
                    <i  class='bx bx-cart'></i> 
                </div><?php
            }else{?>
                <div class="cart" onclick="alert('Effettua il Login o Registrati per utilizzare il carrello')">
                    <i  class='bx bx-cart'></i> 
                </div><?php
            }?>
            <div class="back" onclick="changeCard('3')">
                <h1>Distributore Acqua</h1>
                <p>
                    Questo distributore d'acqua per animali è progettato per fornire una fonte continua di acqua fresca e pulita
                    ai tuoi amici a quattro zampe. Dotato di un design robusto e anti-sversamento, assicura che l'acqua
                    rimanga pulita e accessibile tutto il giorno. La capacità di auto-riempimento e il sistema di filtraggio
                    integrato garantiscono un'acqua di alta qualità, contribuendo al benessere e alla salute degli animali
                    domestici. 
                </p>
            </div>
        </div>

        <!--Card-->
        <div class="card" id="4">
            <div class="front" onclick="changeCard('4')">
                <div class="box-img">
                    <img src="../immagini/sella.jpg">
                </div>
                <h4>Sella</h4>
                <h5>€500,00</h5>
            </div><?php 
            if(isset($_SESSION["autorizzato"])){ ?>
                <div class="cart" onclick="addToCart('Sella',500.00)">
                    <i  class='bx bx-cart'></i> 
                </div><?php
            }else{?>
                <div class="cart" onclick="alert('Effettua il Login o Registrati per utilizzare il carrello')">
                    <i  class='bx bx-cart'></i> 
                </div><?php
            }?>
            <div class="back" onclick="changeCard('4')">
                <h1>Sella</h1>
                <p>
                    Questa sella offre una combinazione di comfort, sicurezza e prestazioni ottimali per il cavallo e il cavaliere.
                    Realizzata con materiali di alta qualità e un design ergonomico, assicura una distribuzione uniforme del
                    peso e una stabilità superiore durante la monta. Dotata di imbottiture morbide e regolazioni
                    personalizzabili, garantisce un'esperienza confortevole e sicura per lunghe ore di equitazione. Con
                    attenzione ai dettagli e una costruzione resistente, questa sella è la scelta ideale per soddisfare le esigenze
                    di cavalieri e cavalli più esigenti. 
                </p>
            </div>
        </div>
                
        <!--Card-->
        <div class="card" id="5">
            <div class="front" onclick="changeCard('5')">
                <div class="box-img">
                    <img src="../immagini/guinzaglio-per-cani.jpg">
                </div>
                <h4>Guinzaglio per Cani</h4>
                <h5>€10,00</h5>
            </div><?php 
            if(isset($_SESSION["autorizzato"])){ ?>
                <div class="cart" onclick="addToCart('Guinzaglio per Cani',10.00)">
                    <i  class='bx bx-cart'></i> 
                </div><?php
            }else{?>
                <div class="cart" onclick="alert('Effettua il Login o Registrati per utilizzare il carrello')">
                    <i  class='bx bx-cart'></i> 
                </div><?php
            }?>
            <div class="back" onclick="changeCard('5')">
                <h1>Guinzaglio per Cani</h1>
                <p>
                    Questo guinzaglio combina funzionalità e stile per offrire un'esperienza di passeggio sicura e confortevole
                    per te e il tuo cane. Realizzato con materiali di alta qualità e una costruzione resistente, garantisce una
                    presa salda e affidabile durante le passeggiate quotidiane. Il design ergonomico e i dettagli rifiniti con cura
                    assicurano comfort e durata nel tempo, il guinzaglio perfetto per il tuo animale
                </p>
            </div>
        </div>
            
        <!--Card-->
        <div class="card" id="6">
            <div class="front" onclick="changeCard('6')">
                <div class="box-img">
                    <img src="../immagini/spazzola.jpg">
                </div>
                <h4>Spazzola</h4>
                <h5>€10,00</h5>
            </div><?php 
            if(isset($_SESSION["autorizzato"])){ ?>
                <div class="cart" onclick="addToCart('Spazzola',10.00)">
                    <i  class='bx bx-cart'></i> 
                </div><?php
            }else{?>
                <div class="cart" onclick="alert('Effettua il Login o Registrati per utilizzare il carrello')">
                    <i  class='bx bx-cart'></i> 
                </div><?php
            }?>
            <div class="back" onclick="changeCard('6')">
                <h1>Spazzola</h1>
                <p>
                    Questa spazzola per animali offre un modo efficace e delicato per mantenere il mantello del tuo animale
                    domestico pulito e senza nodi. Dotata di setole morbide ma robuste, rimuove efficacemente i peli morti e
                    lo sporco senza irritare la pelle sensibile dell'animale. Il design ergonomico con impugnatura antiscivolo
                    garantisce una presa comoda e sicura durante l'uso, rendendo la toelettatura un'esperienza piacevole per
                    te e il tuo animale. Con materiali di alta qualità e una costruzione durevole, questa spazzola è un'aggiunta
                    essenziale alla tua routine di cura degli animali domestici.
                </p>
            </div>
        </div>
            
        <!--Controllo se si è loggati-->
        <?php
            if(!isset($_SESSION["autorizzato"])){?>
                
                <!--Script per ridurre la visibilità-->
                <script>
                    let img=document.querySelectorAll('.box-img');

                    for(i=1; i<img.length; i++){
                        img[i].classList.add('active');
                    }

                    let testi = document.querySelectorAll('.back p')
                
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
    
    
    <script src="../javascript/menubar.js"></script>
</body>
</html>