document.addEventListener('DOMContentLoaded', () => {
    const link = document.querySelector('#idAusdruck a');
    if (link) {
      link.addEventListener('click', e => {
        e.preventDefault();
        window.print();
      });
    }
  });

