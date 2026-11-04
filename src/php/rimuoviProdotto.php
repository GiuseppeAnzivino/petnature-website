<?php
//Connessione al Database e avvio Sessione
require_once "../db/connectDb.php";

//verifica dell'indice 
if (isset($_POST['index'])) {
    $index = $_POST['index'];
    //verifica se nel'array è presente un elemento al posto $indice
    if (isset($_SESSION['carrello'][$index])) {
        // Rimuovi l'elemento dall'array $_SESSION['carrello']
        array_splice($_SESSION['carrello'], $index, 1);
        echo "Elemento rimosso con successo dal carrello.";
    } else {
        echo "Errore: Elemento non trovato nel carrello.";
    }
} else {
    echo "Errore: Indice non specificato.";
}
?>