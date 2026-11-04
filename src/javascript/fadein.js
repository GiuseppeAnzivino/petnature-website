function checkVisibility() {
  var elements = document.querySelectorAll('.fade-in');

  elements.forEach(function(element) {
    var posizione = element.getBoundingClientRect();
    var altezzaFinestra = window.innerHeight;

    // Aggiungi la classe "visible" se l'elemento è visibile nella finestra visualizzata
    if (posizione.top < altezzaFinestra && posizione.bottom >= 0) {
      element.classList.add('visible');
    } else {
      element.classList.remove('visible');
    }
  });
}

// Aggiungi un listener per l'evento di scroll
window.addEventListener('scroll', checkVisibility);

// Esegui la funzione al caricamento della pagina per verificare immediatamente la visibilità
window.addEventListener('load', checkVisibility);