function addToCart(nomeProdotto, prezzoProdotto) {
    // Invia una richiesta AJAX per aggiungere il prodotto al carrello
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../php/aggiungiAlCarrello.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function() {
    if (xhttp.readyState === 4 && xhttp.status === 200) {
        // Messaggio di conferma o gestione degli errori
        console.log(xhttp.responseText);
        alert("Prodotto aggiunto al carrello!");
    }
    };
    xhttp.send("nome=" + encodeURIComponent(nomeProdotto) + "&prezzo=" + encodeURIComponent(prezzoProdotto));
}

function rimuoviProdotto(index) {
// Invia l'indice dell'elemento da rimuovere al server
var xhttp = new XMLHttpRequest();
xhttp.open("POST", "../php/rimuoviProdotto.php", true);
xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
xhttp.onreadystatechange = function() {
    if (xhttp.readyState === 4 && xhttp.status === 200) {
        // Gestisci la risposta del server
        console.log(xhttp.responseText);
        location.reload(); // Ricarica la pagina dopo l'aggiornamento del carrello
    }
};
xhttp.send("index=" + encodeURIComponent(index));
}