document.addEventListener('DOMContentLoaded', () => {
    const printLink = document.querySelector('#idAusdruck a');
    const neuAntrag = document.getElementById('idNeuAntrag');

    if (!printLink) {
      return;
    }

    printLink.addEventListener('click', e => {
      e.preventDefault();

      if (neuAntrag) {
        neuAntrag.style.display = 'inline';
      }

      window.print();
    });
  });
