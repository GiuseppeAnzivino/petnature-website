<?php
//Connessione al Database e avvio Sessione
require_once "../db/connectDb.php";

// Verifica se sono stati ricevuti i dati del prodotto
if (isset($_POST['nome']) && isset($_POST['prezzo'])) {
    // Aggiungi il prodotto al carrello
    $prodotto = array(
        'nome' => $_POST['nome'],
        'prezzo' => $_POST['prezzo']
    );
    $_SESSION['carrello'][] = $prodotto;
    // Invia una risposta di conferma al client
    echo "Prodotto aggiunto al carrello con successo!";
} else {
    // Invia una risposta di errore al client
    echo "Errore: dati del prodotto non ricevuti.";
}
?>