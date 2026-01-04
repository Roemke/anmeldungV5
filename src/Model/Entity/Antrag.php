<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

final class Antrag extends Entity
{
    protected array $_accessible = [
        '*' => false,

        // Grunddaten
        'schulform_id' => true,
        'fstFormBevorzugt' => true,
        'name' => true,
        'vorname' => true,
        'geschlecht' => true,
        'geburtsdatum' => true,
        'geburtsort' => true,
        'familienstand' => true,

        // Adresse
        'strasse' => true,
        'hausnummer' => true,
        'plz' => true,
        'stadt' => true,

        // Kontakt
        'telefon' => true,
        'email' => true,

        // Herkunft
        'staat_id' => true,
        'konfession_id' => true,
        'spaetaussiedler' => true,

        // Erziehungsberechtigte
        'e1name' => true,
        'e1vorname' => true,
        'e1geschlecht' => true,
        'e1strasse' => true,
        'e1hausnummer' => true,
        'e1plz' => true,
        'e1stadt' => true,
        'e1telefon' => true,

        'e2name' => true,
        'e2vorname' => true,
        'e2geschlecht' => true,
        'e2strasse' => true,
        'e2hausnummer' => true,
        'e2plz' => true,
        'e2stadt' => true,
        'e2telefon' => true,

        // Schule
        'letzeschule' => true,
        'last_schul_form_id' => true,
        'abschluss' => true,
        'berufsausbildung_abgeschlossen' => true,

        // Förderbedarf
        'foerderBedarf' => true,
        'foeASS' => true,
        'foeGE' => true,
        'foeHK' => true,
        'foeSE' => true,
        'foeKME' => true,
        'foeLES' => true,

        // Meta
        'aufmerksam' => true,
    ];
}
