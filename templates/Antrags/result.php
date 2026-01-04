<?php
//Ersetzt die vorherige Bestätigungsseite nach Antragstellung, war result.ctp
$this->Html->css('result.antrag', ['block' => true]);
$this->Html->css('result.antrag.print', ['media' => 'print', 'block' => true]);
$this->Html->script('print_button', ['block' => true]);
?>
<div id="idAntragSaved">
  <p>
    Wir haben Ihren Antrag gespeichert, drucken Sie bitte diese Kurzfassung aus.
    Der Antrag muss von Ihnen und (falls Sie nicht volljährig sind) von einem
    Erziehungsberechtigten unterschrieben werden.
  </p>

  <p><strong>Führen Sie diese Anmeldung auf keinen Fall ein zweites Mal durch.</strong></p>

  <p>
    Ihre Daten sind nun bei uns gespeichert. Sollten Sie Probleme mit dem Ausdruck haben,
    melden Sie sich bitte im Sekretariat der Schule unter 02226 92200.
  </p>

  <p>
    <span id="idAusdruck"><a href="#print">Ausdruck</a></span>
    <span id="idNeuAntrag">
      <a href="<?= $this->Url->build(['action' => 'add']) ?>">
        Drucken erledigt, neuer Antrag
      </a>
    </span>
  </p>
</div>
<h1 id="idH1Aufnahme">
  Aufnahmeantrag Glasfachschule, Zu den Fichten 19, 53359 Rheinbach
</h1>

<div id="daten">
  <p>
    gewählter Bildungsgang:
    <?= h($antrag->schulform->form) ?><br><br>

    Name:
    <?= h($antrag->vorname . ' ' . $antrag->name) ?><br>

    Adresse:
    <?= h($antrag->strasse . ' ' . $antrag->hausnummer) ?>,
    <?= h($antrag->plz . ' ' . $antrag->stadt) ?><br>

    Telefon:
    <?= h($antrag->telefon) ?>

    <?php if ($antrag->email): ?>
      , E-Mail: <?= h($antrag->email) ?>
    <?php endif; ?>
  </p>
</div>
<?php if ($antrag->foerderBedarf === 'j'): ?>
<div>
  <p>
    Sonderpädagogischer Förderbedarf
    (vor der Aufnahme ist ggf. eine Abstimmung mit der Bezirksregierung Köln notwendig):
  </p>

  <div id="idFoerderDetail">
    <?php
    $types = [
      'foeLES' => 'LES (Lernen, emotionale und soziale Entwicklung, Sprache)',
      'foeASS' => 'ASS (Autismus-Spektrum-Störung)',
      'foeGE'  => 'GE (Geistige Entwicklung)',
      'foeHK'  => 'HK (Hören und Kommunikation)',
      'foeSE'  => 'SE (Sehen)',
      'foeKME' => 'KME (körperliche und motorische Entwicklung)',
    ];
    foreach ($types as $key => $label):
      $sign = $antrag->$key ? '✓' : ' ';
    ?>
      <div><?= h($label) ?></div>
      <div class="framed"><span><?= $sign ?></span></div>
    <?php endforeach; ?>
  </div>

<p>Besuchen Sie zur Beratung bitte unsere Schulsozialarbeit und / oder die Beratungs-Lehrkräfte.</p>
<div id="inklBeratung">
    <div>
        Inklusionsberatung hat stattgefunden
    </div>
    <div id="idParaphe">(Paraphe)</div>
</div>
</div>
<?php endif; ?>
<div id="idDatenErzieher" class="noBreak">
<h1>Erziehungsberechtigte</h1>

<p>
  Name:
  <?= h($antrag->e1vorname . ' ' . $antrag->e1name) ?><br>

  Adresse:
  <?= h($antrag->e1strasse . ' ' . $antrag->e1hausnummer) ?>,
  <?= h($antrag->e1plz . ' ' . $antrag->e1stadt) ?><br>

  Telefon:
  <?= h($antrag->e1telefon) ?>

<?php if ($antrag->e2name): ?>
<br>
  Name:
  <?= h($antrag->e2vorname . ' ' . $antrag->e2name) ?><br>
  Telefon:
  <?= h($antrag->e2telefon) ?>
<?php endif; ?>
</p>

<?php if ($antrag->abschluss): ?>
<div id="idAnmerkungen">
  Anmerkungen:<br>
  <?= nl2br(h($antrag->abschluss)) ?>
</div>
<?php endif; ?>

</div>


<div id="idWeitereUnterlagen" class="noBreak">
<strong>Bitte senden Sie uns einen Ausdruck dieser Seite mit den nachfolgenden Unterlagen zu.</strong>

<ul>
  <li>ausführlicher tabellarischer Lebenslauf mit Unterschrift</li>
  <li>beglaubigte Kopie des letzten Zeugnisses</li>
  <li>beglaubigte Kopie des Abschlusszeugnisses</li>

  <?php if (in_array($antrag->schulform_id, [2,4,5], true)): ?>
    <li>
      <strong>nur</strong> Berufsfachschule Gestaltung:
      selbstgestaltete Arbeit(en) eigener Wahl
    </li>
  <?php endif; ?>
</ul>

<?php if ($antrag->staat->statistikkrz !== '000'): ?>
<strong>Bei internationalen Bewerbern zusätzlich:</strong>
<ul>
  <li>gültige Aufenthaltsgenehmigung</li>
  <li>Feststellung des deutschen Bildungsabschlusses</li>
</ul>
<?php endif; ?>
<div id="idUnterschriften" class="noBreak">
<h1>Unterschriften</h1>

<div id="idUnterschriftFeld">
    <div >Datum, Antragsteller(in)</div>
    <div>Datum, Erziehungsberechtigte(r)</div>
</div>

</div>
