<!-- File inviaCarrelloAlDatabase.php -->
<?php
require_once "connectDb.php";

if(isset($_SESSION['autorizzato'])){
    // Prepara i valori da inserire nel database
    $utente = pg_escape_literal($_SESSION['email']);
    $totale = $_POST['totale'];
    echo $totale;
    $data = pg_escape_literal(date("d/m/y"));
    
    $nomiProdotti =  $_POST['nomiProdotto'];
    $prezziStringa = $_POST['prezziProdotto'];
    $prezziArray = explode(',', $prezziStringa); // Separare la stringa dei prezzi in un array
    $prodottiArray = explode(',', $nomiProdotti); // Separare la stringa dei prezzi in un array

    // Esegui la query per inserire i dati nel database
    $sql = "INSERT INTO ordine_generale(utente,data,totale) VALUES ($utente,$data,$totale)";
    $ret = pg_query($db, $sql);
    
    //Verifica se la query è stata eseguita correttamente
    if($ret){
        $id = "SELECT MAX(idordine) FROM ordine_generale WHERE ordine_generale.utente= $utente";
        $r = pg_query($db, $id);
        $ris = pg_fetch_row($r);

        $id_ordine = floatval($ris[0]);
        // Inserisci ogni prodotto nel database
        foreach($prodottiArray as $indice => $nomeProdotto){
            // Ottieni il prezzo corrispondente
            $nomeProdotto = $prodottiArray[$indice];
            $prezzoProdotto = $prezziArray[$indice];
            
            $sqlDettaglio = "INSERT INTO ordine_dettagliato(idordine,prodotto, prezzo) VALUES ('$id_ordine','$nomeProdotto', $prezzoProdotto)";
            $retDettaglio = pg_query($db, $sqlDettaglio);

            if($retDettaglio){
                // Inserimento riuscito
                echo "Prodotto aggiunto al carrello con successo";
                unset($_SESSION['carrello']);
                unset($_SESSION['totale']);
            } else {
                // Errore nell'inserimento
                echo "Errore durante l'aggiunta del prodotto al carrello";
            }
        }
    } else {
        // Errore nell'esecuzione della query principale
        echo "Errore durante la creazione dell'ordine generale";
    }
} else {
    echo "Sessione non autorizzata.";
}
?>