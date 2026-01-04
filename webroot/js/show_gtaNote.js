document.addEventListener('DOMContentLoaded', function () {

    const schulformSelect = document.getElementById('schulform-id');
    const gtaHinweis = document.getElementById('gtaUnterlagenAddOn');

    const gtaIds = ['2', '4', '5']; // IDs für GTA

    if (!schulformSelect || !gtaHinweis) {
      return;
    }

    function updateGtaHinweis() {
      if (gtaIds.includes(schulformSelect.value)) {
        gtaHinweis.classList.remove('invisible');
      } else {
        gtaHinweis.classList.add('invisible');
      }
    }

    // Initialzustand
    updateGtaHinweis();

    // Änderung der Schulform
    schulformSelect.addEventListener('change', updateGtaHinweis);

  });
