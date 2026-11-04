<?php
    require_once "../db/connectDb.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pet Nature-Sign In</title>

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

    <!--Section-->
    <section>

        <!--PHP Controlli per avvio Registrazione-->
        <?php
            /*Sticky form Activity*/
            if(isset($_POST["nome"])){
                $nome=$_POST["nome"];
            }else{
                $nome="";
            }
            if(isset($_POST["cognome"])){
                $cognome=$_POST["cognome"];
            }else{
                $cognome="";
            }
            if(isset($_POST["email"])){
                $email=$_POST["email"];
            }else{
                $email="";
            }
            if(isset($_POST["password"])){
                $pwd=$_POST["password"];
            }else{
                $pwd="";
            }
            if(isset($_POST["password-confirm"])){
                $pwdConfirm=$_POST["password-confirm"];
            }else{
                $pwdConfirm="";
            }
            if(!empty($_POST) && $_POST["signin"]=="Registrati"){

                $_SESSION["autorizzato"]=false;
            
                /*Controllo email valida*/
                if($email!="" && !filter_var($email, FILTER_VALIDATE_EMAIL)){
                    echo "<script>alert('email non valida');</script>";
                    $email="";
                }else{

                    /*Inizializzazione variabili per la query*/
                    $nome_ok=pg_escape_literal($nome);
                    $cognome_ok=pg_escape_literal($cognome);
                    $email_ok = pg_escape_literal($email);
                    $pwd_ok=pg_escape_literal($pwd);
                    $pwd_hash=pg_escape_literal(password_hash($pwd_ok, PASSWORD_DEFAULT));

                    /*Controllo email già presente*/
                    $check="SELECT * FROM utente WHERE email=".$email_ok;
                    $query=pg_query($db, $check);
                    $row=pg_fetch_assoc($query);
                    if($row!=null){
                        echo "<script>alert('email già presente');</script>";
                        $email="";
                    }else{

                        /*Inserimento e-mail*/
                        $sql="INSERT INTO utente(nome, cognome, email, password) VALUES ($nome_ok, $cognome_ok, $email_ok, $pwd_hash)";
                        $ret=pg_query($db, $sql);
                        if(!$ret){
                            echo "<script>alert('email già presente');</script>";
                        }else{

                            /*Indirizzamento pagina di home*/
                            $_SESSION["email"]=$email;
                            $_SESSION["autorizzato"]=true;
                            header("Location: ../php/home.php");
                        }
                    }
                }

                /*Chiusura database*/
                pg_close();
            }
        ?>

        <!--Controller per la password-->
        <script src="../javascript/controller"></script>

        <!--Form per l'inserimento dei dati-->
        <form class="form" id="form" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" onsubmit="return controller()" autocomplete="off">
            
            <!--Title-->
            <h1 class="title">
                Sign-In
            </h1>

            <!--Content-text-->
            <p>Inserisci informazioni personali<br>per la creazione di un nuovo Account.</p>

            <!--Input e label per nome-->
            <div class="input-menu">
                <input type="text" class="input" id="nome" name="nome" value= "<?php echo $nome ?>" onchange="changeInput('nome', '1')" required/>
                <label for="nome" class="label" id="1">Nome</label>
            </div>

            <!--Input e label per cognome-->
            <div class="input-menu">
                <input type="text" class="input" id="cognome" name="cognome" value="<?php echo $cognome?>" onchange="changeInput('cognome', '2')" required/>
                <label for="cognome" class="label" id="2">Cognome</label>
            </div>

            <!--Input e label per email-->
            <div class="input-menu">
                <input type="email" class="input" id="email" name="email" value="<?php echo $email?>" onchange="changeInput('email', '3')" required/>
                <label for="email" class="label" id="3">E-Mail</label>
            </div>

            <!--Input e label per password-->
            <div class="input-menu">
                <input type="password" class="input" id="password" name="password" value="<?php echo $pwd?>" onchange="changeInput('password', '4')" required/>
                <label for="password" class="label" id="4">Password</label>
                <i class='bx bxs-low-vision' id="eye" onclick="changeType('password')"></i>
            </div>
            
            <!--Input e label per conferma password-->
            <div class="input-menu">
                <input type="password" class="input" id="password-confirm" name="password-confirm" value="<?php echo $pwdConfirm?>" onchange="changeInput('password-confirm', '5')" required/>
                <label for="password-confirm" class="label" id="5">Conferma Password</label>
                <i class='bx bxs-low-vision' id="eye" onclick="changeType('password-confirm')"></i>
            </div>

            <!--Label per l'errore di message-->
            <label id="error" style="font-size: 14px;"></label>

            <!--Submit per la Registrazione-->
            <input type="submit" id="signin" name="signin" value="Registrati" required/>

            <!--Linea di separazione-->
            <div class="line">
                <hr>OR<hr>
            </div>

            <!--Content text per la registrazione-->
            <p>Possiedi un account?<a href="loginDb.php">Accedi</a></p>

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
    </section>

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