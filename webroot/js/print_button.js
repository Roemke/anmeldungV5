document.addEventListener('DOMContentLoaded', () => {
    const link = document.querySelector('#idAusdruck a');
    if (link) {
      link.addEventListener('click', e => {
        e.preventDefault();
        window.print();
      });
    }
  });

  document.addEventListener('DOMContentLoaded', () => {
    const printLink = document.querySelector('#idAusdruck a');
    const neuAntrag = document.getElementById('idNeuAntrag');

    if (printLink && neuAntrag) {
      printLink.addEventListener('click', e => {
        e.preventDefault();

        // "Neuer Antrag" einblenden
        neuAntrag.style.display = 'inline';

        window.print();
      });
    }
  });
