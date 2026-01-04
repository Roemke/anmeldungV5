document.addEventListener('DOMContentLoaded', function () {

    const foerderJa = document.getElementById('foerderbedarf-j');
    const foerderNein = document.getElementById('foerderbedarf-n');
    const foerderDiv = document.getElementById('idDivFoerder');

    const staatSelect = document.getElementById('staat-id');
    const auslandDiv = document.getElementById('idAntragAusland');

    // Initialzustand Förderbedarf
    if (foerderJa && foerderJa.checked) {
      foerderDiv.classList.remove('invisible');
    }

    // Förderbedarf: JA
    if (foerderJa) {
      foerderJa.addEventListener('change', function () {
        foerderDiv.classList.remove('invisible');
      });
    }

    // Förderbedarf: NEIN
    if (foerderNein) {
      foerderNein.addEventListener('change', function () {
        foerderDiv.classList.add('invisible');

        // Checkboxen zurücksetzen
        const checkboxes = foerderDiv.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(cb => cb.checked = false);
      });
    }

    // Initialzustand Ausland
    if (staatSelect && staatSelect.value > 1) {
      auslandDiv.classList.remove('invisible');
    }

    // Änderung Staatsangehörigkeit
    if (staatSelect) {
      staatSelect.addEventListener('change', function () {
        if (this.value > 1) {
          auslandDiv.classList.remove('invisible');
        } else {
          auslandDiv.classList.add('invisible');
        }
      });
    }

  });
