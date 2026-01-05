<?php
declare(strict_types=1);

namespace App\Service;

use Cake\Database\Expression\QueryExpression;
use Cake\I18n\FrozenTime;
use Cake\ORM\Table;
use Cake\Utility\Text;
use ZipArchive;

/**
 * SCHILD-Export Service
 *
 * Format basiert 1:1 auf CakePHP-2 AntragController.php:
 * - 4 Dateien
 * - Delimiter: |
 * - enclosure: '' (keine Quotes)
 * - Windows-1252 Encoding
 * - "Nachname" enthält: name#klasse
 */
final class SchildExportService
{
    private const DELIM = '|';

    // Dateinamen (wie Altcode)
    public const FILE_BASIS = 'SchuelerBasisdaten.dat';
    public const FILE_ERZ   = 'SchuelerErzieher.dat';
    public const FILE_TEL   = 'SchuelerTelefonnummern.dat';
    public const FILE_ZU    = 'SchuelerZusatzdaten.dat';

    /** @var array<int, string> */
    private array $basisHeader = [
        "Nachname","Vorname","Geburtsdatum","Geschlecht","Status","PLZ","Ort","Straße",
        "Aussiedler","1. Staatsang.","Konfession","StatistikKrz Konfession","Aufnahmedatum",
        "Abmeldedatum Religionsunterricht","Anmeldedatum Religionsunterricht","Schulpflicht erf.",
        "Reform-Pädagogik","Nr. Stammschule","Jahr","Abschnitt","Jahrgang","Klasse",
        "Schulgliederung","OrgForm","Klassenart","Fachklasse","Noch frei",
        "Verpflichtung Sprachförderkurs","Teilnahme Sprachförderkurs","Einschulungsjahr",
        "Übergangsempf. JG5","Jahr Wechsel S1","1. Schulform S1","Jahr Wechsel S2",
        "Förderschwerpunkt","2. Förderschwerpunkt","Schwerstbehinderung","Autist","LS Schulnr.",
        "LS Schulform","Herkunft","LS Entlassdatum","LS Jahrgang","LS Versetzung","LS Reformpädagogik",
        "LS Gliederung","LS Fachklasse","LS Abschluss","Abschluss","Schulnr. neue Schule"
    ];

    /** @var array<int, string> */
    private array $erzHeader = [
        "Nachname","Vorname","Geburtsdatum","Erzieherart","Anrede 1.Person","Titel 1.Person",
        "Nachname 1.Person","Vorname 1.Person","Anrede 2.Person","Titel 2.Person",
        "Nachname 2.Person","Vorname 2.Person","Straße","PLZ","Ort","Ortsteil"
    ];

    /** @var array<int, string> */
    private array $zusatzHeader = [
        "Nachname","Vorname","Geburtsdatum","Namenszusatz","Geburtsname","Geburtsort",
        "Ortsteil","Telefon-Nr.","E-Mail","2. Staatsang.","Externe ID-Nr",
        "Sportbefreiung","Fahrschülerart","Haltestelle","Einschulungsart","Entlassdatum",
        "Entlassjahrgang","Datum Schulwechsel","Bemerkungen"
    ];

    /** @var array<int, string> */
    private array $telHeader = [
        "Nachname","Vorname","Geburtsdatum","Telefonnr.","Art"
    ];

    public function __construct(
        private readonly Table $AntragsTable
    ) {}

    /**
     * Exportiert "all" oder "new" (new = lastDownload IS NULL).
     *
     * @return array<string, string> Map: filename => binary content (Windows-1252)
     * eventuell ein paar mal zu viel getrimmt, nicht schädlich und ich war etwas unkonzentriert
     * beim generieren lassen :-)
     */
    public function buildFiles(string $mode): array
    {
        $mode = strtolower($mode);
        if (!in_array($mode, ['all', 'new'], true)) {
            throw new \InvalidArgumentException('Mode must be "all" or "new".');
        }

        $conditions = [];
        if ($mode === 'new') {
            $conditions = ['Antrags.lastDownload IS' => null];
        }

        // Entitäten inkl. Associations, analog zum Altcode-Zugriff:
        $antrags = $this->AntragsTable->find()
            ->where($conditions)
            ->contain([
                'Schulforms',
                'Konfessions',
                'Staats',
                'LastSchulForms',
            ])
            ->all();

        // Writer-Buffer (UTF-8 intern, am Ende Windows-1252)
        $basis  = [];
        $erz    = [];
        $tel    = [];
        $zusatz = [];

        // Header-Zeilen
        $basis[]  = $this->row($this->basisHeader);
        $erz[]    = $this->row($this->erzHeader);
        $tel[]    = $this->row($this->telHeader);
        $zusatz[] = $this->row($this->zusatzHeader);

        foreach ($antrags as $a) {
            // Defensive: trim wie Altcode array_walk_recursive
            $this->trimEntityStrings($a);

            // ========== BASIS ==========
            $b = [];

            $this->addIntro($b, $a);                     // Nachname, Vorname, Geburtsdatum
            $b[] = (string)($a->geschlecht ?? '');
            $b[] = '0';                                  // Status: 0 -> Neuaufnahme
            $b[] = (string)($a->plz ?? '');
            $b[] = (string)($a->stadt ?? '');
            $b[] = trim(((string)($a->strasse ?? ''))) . ' ' . trim((string)($a->hausnummer ?? ''));

            $b[] = (string)($a->spaetaussiedler ?? '');
            $b[] = (string)($a->staat?->StatistikKrz ?? '');

            // konfession: bez_schild + kuerzel
            $b[] = (string)($a->konfession?->bez_schild ?? '');
            $b[] = (string)($a->konfession?->kuerzel ?? '');

            $this->padEmpty($b, 3);

            $b[] = 'J';                                  // Schulpflicht erfüllt
            $this->padEmpty($b, 5);

            // Klasse aus Schulform
            $b[] = (string)($a->schulform?->klasse ?? '');
            $this->padEmpty($b, 5);

            $b[] = 'N';                                  // Verpflichtung Sprachförderkurs
            $b[] = 'N';                                  // Teilnahme Sprachförderkurs

            $this->padEmpty($b, 7);

            $b[] = 'N';                                  // Schwerstbehinderung
            $b[] = 'N';                                  // Autist

            $this->padEmpty($b, 1);                      // LS Schulnr.

            // LS Schulform (kurz)
            $b[] = (string)($a->last_schul_form?->schulformKrz ?? '');

            $this->padEmpty($b, 9);

            $b[] = '175936';                             // Schulnr. neue Schule (Altcode fix)

            $basis[] = $this->row($b);

            // ========== ZUSATZ ==========
            $z = [];
            $z[] = trim((string)($a->name ?? ''));
            $z[] = trim((string)($a->vorname ?? ''));
            $z[] = $this->formatGebDat($a->geburtsdatum ?? null);
            $this->padEmpty($z, 2);                      // Namenszusatz, Geburtsname
            $z[] = trim((string)($a->geburtsort ?? ''));
            $this->padEmpty($z, 1);                      // Ortsteil
            $z[] = trim((string)($a->telefon ?? ''));
            $z[] = trim((string)($a->email ?? ''));
            $this->padEmpty($z, 9);
            $z[] = $this->sanitizeBemerkungen((string)($a->abschluss ?? ''));

            $zusatz[] = $this->row($z);

            // ========== ERZIEHER ==========
            $e = [];
            $this->addIntro($e, $a);
            $e[] = 'unbekannt'; // Erzieherart

            $e[] = $this->anrede((string)($a->e1geschlecht ?? null));
            $this->padEmpty($e, 1);                      // Titel 1
            $e[] = (string)($a->e1name ?? '');
            $e[] = (string)($a->e1vorname ?? '');

            $e[] = $this->anrede((string)($a->e2geschlecht ?? null)); // 2. Person evtl. leer
            $this->padEmpty($e, 1);                      // Titel 2
            $e[] = trim((string)($a->e2name ?? ''));
            $e[] = trim((string)($a->e2vorname ?? ''));

            $e[] = trim(((string)($a->e1strasse ?? ''))) . ' ' . trim((string)($a->e1hausnummer ?? ''));
            $e[] = trim((string)($a->e1plz ?? ''));
            $e[] = trim((string)($a->e1stadt ?? ''));
            $this->padEmpty($e, 1);                      // Ortsteil

            $erz[] = $this->row($e);

            // ========== TELEFON ==========
            // Altcode: immer Schüler + Erzieher1 + optional Erzieher2
            $this->addTelRow($tel, $a, trim((string)($a->telefon ?? '')), 'Schueler');
            $this->addTelRow($tel, $a, trim((string)($a->e1telefon ?? '')), 'Erzieher1');

            $e2tel = trim((string)($a->e2telefon ?? ''));
            if ($e2tel !== '') {
                $this->addTelRow($tel, $a, $e2tel, 'Erzieher2');
            }
        }

        return [
            self::FILE_BASIS => $this->toWin1252(implode("\r\n", $basis) . "\r\n"),
            self::FILE_ZU    => $this->toWin1252(implode("\r\n", $zusatz) . "\r\n"),
            self::FILE_ERZ   => $this->toWin1252(implode("\r\n", $erz) . "\r\n"),
            self::FILE_TEL   => $this->toWin1252(implode("\r\n", $tel) . "\r\n"),
        ];
    }

    /**
     * Erzeugt ein ZIP (binär) mit den 4 Exportdateien.
     */
    public function buildZip(string $mode): string
    {
        $files = $this->buildFiles($mode);

        $tmp = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'schild_' . Text::uuid() . '.zip';

        $zip = new ZipArchive();
        if ($zip->open($tmp, ZipArchive::CREATE) !== true) {
            throw new \RuntimeException('Could not create zip file.');
        }

        foreach ($files as $name => $content) {
            $zip->addFromString($name, $content);
        }

        $zip->close();

        $bin = (string)file_get_contents($tmp);
        @unlink($tmp);

        return $bin;
    }

    /**
     * Aktualisiert downloads + lastDownload entsprechend dem Modus.
     */
    public function markDownloaded(string $mode): int
    {
        $conditions = [];

        if ($mode === 'new') {
            $conditions['lastDownload IS'] = null;
        }

        $now = FrozenTime::now();

        return $this->AntragsTable->updateAll(
            [
                'downloads' => new QueryExpression('downloads + 1'),
                'lastDownload' => $now,
            ],
            $conditions
        );
    }

    // ----------------- Helpers (1:1 Logik aus Altcode) -----------------

    private function addIntro(array &$row, object $a): void
    {
        // Altcode: name#klasse (klasse aus Schulform)
        $klasse = (string)($a->schulform?->klasse ?? '');
        $row[] = trim((string)($a->name)) . '#' . trim($klasse);

        $row[] = (string)($a->vorname ?? '');

        $row[] = $this->formatGebDat($a->geburtsdatum ?? null);
    }

    private function addTelRow(array &$telRows, object $a, string $tel, string $type): void
    {
        if ($tel === '') {
            return;
        }

        $r = [];
        $this->addIntro($r, $a);
        $r[] = $tel;
        $r[] = $type;
        $telRows[] = $this->row($r);
    }

    private function padEmpty(array &$row, int $count): void
    {
        for ($i = 0; $i < $count; $i++) {
            $row[] = '';
        }
    }

    private function anrede(?string $geschlecht): string
    {
        $g = strtolower(trim((string)$geschlecht));
        $g = ($g !== '' ? $g[0] : '');   // nur erster Buchstabe zählt
        return match ($geschlecht) {
            'm' => 'Herr',
            'w' => 'Frau',
            default => '',
        };
    }

    private function formatGebDat(mixed $geburtsdatum): string
    {
        // Altcode: DateTime($antrag['Antrag']['geburtsdatum'])->format("d.m.Y")
        if ($geburtsdatum === null || $geburtsdatum === '') {
            return '';
        }

        // Cake kann Date/Time Objekte liefern; alles zulassen
        try {
            if ($geburtsdatum instanceof \DateTimeInterface) {
                return $geburtsdatum->format('d.m.Y');
            }

            return (new \DateTime((string)$geburtsdatum))->format('d.m.Y');
        } catch (\Throwable) {
            return '';
        }
    }

    private function sanitizeBemerkungen(string $text): string
    {
        // Altcode: Zeilenumbrüche durch '; ' ersetzen
        $text = str_replace(["\r\n", "\r", "\n"], '; ', $text);
        return trim($text);
    }

    private function normalize(string $value): string
    {
        $value = preg_replace('/\s+/', ' ', $value);
        return trim($value);
    }

    private function row(array $fields): string
    {
        $fields = array_map(
            fn($v) => $this->normalize((string)$v),$fields);

        return implode('|', $fields);
    }


    private function toWin1252(string $utf8): string
    {
        // Altcode: renderToFile(..., "Windows-1252")
        // Iconv: //TRANSLIT ist meist hilfreich, SCHILD ist oft empfindlich.
        $converted = @iconv('UTF-8', 'Windows-1252//TRANSLIT', $utf8);
        return $converted !== false ? $converted : $utf8;
    }

    //arbeitet per reference
    private function trimEntityStrings(object $entity): void
    {
        // Best effort: trim auf string properties, ohne harte Abhängigkeit von Entity-Klasse
        foreach (get_object_vars($entity) as $k => $v) {
            if (is_string($v)) {
                $entity->$k = trim($v);
            }
        }
    }

}
