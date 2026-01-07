<?php
$this->Html->css('add.antrag', ['block' => true]);
$this->Html->css('add.antrag.print', ['media' => 'print', 'block' => true]);

$this->Html->script(
    ['jquery.min', 'show_techniker_question', 'show_foerder', 'show_gtaNote'],
    ['block' => true]
);
?>

<div class="antrag form">

<?= $this->Form->create($antrag) ?>

<fieldset>
<legend>
Gestalten Sie mit uns Ihre berufliche Zukunft – wir beraten Sie gerne!<br>
Online Anmeldeformular für alle Bildungsgänge an der Glasfachschule NRW in Rheinbach
</legend>

<div id="idContainerIntro">
<div>
<p>
Wir empfehlen Ihnen, sich vor der Anmeldung beraten zu lassen. Bringen Sie dazu gerne Ihre Unterlagen
(z.B. Berufswahlpass) aus dem Programm „Kein Abschluss ohne Anschluss“ (KAoA) mit.
Beratungstermine werden telefonisch über das Sekretariat vergeben. Wir freuen uns auf Ihren Anruf!
</p>

<p>
<a href="./GFS-Anmeldezeitraeume26-27.pdf" target="_blank">
Anmeldezeiträume für das Schuljahr 2026/2027 auf einen Blick.
</a>
</p>

<div id="addAntragIntroText">
Bitte beachten Sie beim Ausfüllen folgende Punkte:
<ul>
  <li> Sie können sich nur für <strong>einen Bildungsgang</strong> anmelden. Sollten Sie an mehreren
    Bildungsgängen interessiert sein, führen Sie dies bitte unter Anmerkungen auf.</li>
  <li> Füllen Sie bitte alle Felder aus, lediglich eine zweite erziehungsberechtigte Person ist optional.</li>
  <li> Die <strong>Online-Anmeldung</strong> ist der erste Schritt zu uns. Daneben benötigen wir den von Ihnen (bei nicht Volljährigen auch von
    Erziehungsberechtigten) unterschriebenen Ausdruck dieser Online-Anmeldung. <strong>Die Seite zum Ausdruck erhalten Sie nach dem Absenden des Antrags.</strong>
    Mit der Unterschrift bestätigen Sie, dass Ihre Angaben korrekt sind und Sie darüber informiert sind, dass bei fehlenden
    Unterlagen keine Bearbeitung erfolgt.</li>
  <li>Geben Sie Ihre <strong>Namen und ihr Geschlecht laut Personalausweis</strong> an. Sollten Sie
    eine Namensänderung laut NamÄndG (Namensänderungsgesetz) oder laut TSG (Transsexuellengesetz) anstreben, so informieren Sie bitte das
    Sekretariat der Schule.</li>
</ul>

</div>
</div>

<?= $this->Form->control('schulform_id', [
    'label' => 'Bildungsgang',
    'type' => 'select',
    'options' => $schulforms,
    'empty' => 'Bitte wählen',
    'required' => true,
]) ?>

<div id="idAntragBeigefuegt">
<p>Dem Ausdruck müssen die folgenden Unterlagen beigelegt werden:</p>
<ul>
<li>ausführlicher tabellarischer Lebenslauf mit Unterschrift</li>
<li>beglaubigte Kopie des letzten Zeugnisses (in der Regel Halbjahreszeugnis)</li>
<li>beglaubigte Kopie des Abschlusszeugnisses</li>
<li id="gtaUnterlagenAddOn" class="invisible">
<strong>nur</strong> Berufsfachschule Gestaltung: selbstgestaltete Arbeit(en)
</li>
</ul>
</div>

<p>
Bitte senden Sie die kompletten Unterlagen
an:
</p>

<address>
Glasfachschule NRW<br>
Zu den Fichten 19<br>
53359 Rheinbach
</address>
</div>

<fieldset class="clFieldSetAlign">
<?= $this->Form->control('name', ['label' => 'Nachname']) ?>
<?= $this->Form->control('vorname', ['label' => 'Vorname']) ?>
<?= $this->Form->control('staat_id', [
    'label' => 'Staatsangehörigkeit',
    'type' => 'select',
    'options' => $staats,
    'default' => 1, // Deutschland
]) ?>
<div id="idAntragAusland" class="invisible">
bei internationalen Bewerbern benötigen wir zusätzlich:
<ul>
<li>gültige Aufenthaltsgenehmigung</li>
<li>Feststellung des entsprechenden deutschen Bildungsabschlusses</li>
</ul>
</div>
<?= $this->Form->control('geburtsort', ['label' => 'Geburtsort']) ?>
<?= $this->Form->control('geburtsdatum', [
    'label' => 'Geburtsdatum',
    'type' => 'date',
]) ?>
<?= $this->Form->control('geschlecht', [
    'legend' => 'Geschlecht',
    'type' => 'radio',
    'options' => ['m' => 'männlich', 'w' => 'weiblich', 'd' => 'divers'],
]) ?>
</fieldset>

<fieldset class="clFieldSetAlign">
<?= $this->Form->control('strasse', ['label' => 'Straße']) ?>
<?= $this->Form->control('hausnummer', ['label' => 'Hausnummer']) ?>
<?= $this->Form->control('plz', ['label' => 'Postleitzahl']) ?>
<?= $this->Form->control('stadt', ['label' => 'Ort']) ?>
<?= $this->Form->control('telefon', ['label' => 'Telefon']) ?>
<?= $this->Form->control('email', ['label' => 'E-Mail']) ?>
</fieldset>

<fieldset>
<?= $this->Form->control('familienstand', ['label' => 'Familienstand']) ?>
<?= $this->Form->control('konfession_id', [
    'label' => 'Konfession',
    'type' => 'select',
    'options' => $konfessions,
    'empty' => 'Bitte wählen',
]) ?>
<?= $this->Form->control('spaetaussiedler', [
    'legend' => 'Spätaussiedler',
    'label' => 'Spätaussiedler',
    'type' => 'radio',
    'options' => ['J' => 'ja', 'N' => 'nein'],
]) ?>



<?= $this->Form->control('foerderBedarf', [
    'legend' => 'Förderbedarf / Inklusion',
    'label' => 'Förderbedarf / Inklusion',
    'type' => 'radio',
    'options' => ['j' => 'ja', 'n' => 'nein'],
]) ?>

<div id="idDivFoerder" class="invisible">
<div class="clInputGrid">
<p>Sonderp&auml;dagogischer F&ouml;rderbedarf
(vor der Aufnahme ist ggf. eine Abstimmung mit der Bezirksregierung K&ouml;ln notwendig):</p>
<?= $this->Form->control('foeLES', ['type' => 'checkbox', 'label' => 'LES (Lernen, emotionale und soziale Entwicklung, Sprache)']) ?>
<?= $this->Form->control('foeASS', ['type' => 'checkbox', 'label' => 'ASS (Autismus-Spektrum-Störung)']) ?>
<?= $this->Form->control('foeGE', ['type' => 'checkbox', 'label' => 'GE (Geistige Entwicklung)']) ?>
<?= $this->Form->control('foeHK', ['type' => 'checkbox', 'label' => 'HK (Hören und Kommunikation)']) ?>
<?= $this->Form->control('foeSE', ['type' => 'checkbox', 'label' => 'SE (Sehen)']) ?>
<?= $this->Form->control('foeKME', ['type' => 'checkbox', 'label' => 'KME (körperliche und motorische Entwicklung)']) ?>
Besuchen Sie zur Beratung bitte unsere Schulsozialarbeit und/oder die Beratungs-Lehrkräfte.</p>
</div>
</div>
</fieldset>

<?= $this->Form->control('aufmerksam', [
    'type' => 'textarea',
    'label' => 'Welche Form der Beratung an unserer Schule haben Sie bisher in Anspruch genommen?',
]) ?>

<fieldset class="clFieldSetAlign">
<?= $this->Form->control('letzeschule', ['label' => 'Zuletzt besuchte Schule']) ?>
<?= $this->Form->control('last_schul_form_id', [
    'label' => 'Schulform der letzten Schule',
    'type' => 'select',
    'options' => $lastSchoolForms,
    'empty' => 'Bitte wählen',
]) ?>
<?= $this->Form->control('berufsausbildung_abgeschlossen', [
    'label' => 'abgeschlossene Berufsausbildung als',
]) ?>
</fieldset>

<div>
<fieldset class="clFieldSetAlign">
<span>Daten des Erziehungsberechtigten</span>
<?= $this->Form->control('e1name', ['label' => 'Nachname']) ?>
<?= $this->Form->control('e1vorname', ['label' => 'Vorname']) ?>
<?= $this->Form->control('e1strasse', ['label' => 'Straße']) ?>
<?= $this->Form->control('e1hausnummer', ['label' => 'Hausnummer']) ?>
<?= $this->Form->control('e1plz', ['label' => 'Postleitzahl']) ?>
<?= $this->Form->control('e1stadt', ['label' => 'Ort']) ?>
<?= $this->Form->control('e1telefon', ['label' => 'Telefon']) ?>
<?= $this->Form->control('e1geschlecht', [
    'label' => 'Geschlecht',
    'legend' => 'Geschlecht',
    'type' => 'radio',
    'options' => ['m' => 'männlich', 'w' => 'weiblich', 'd' => 'divers'],
]) ?>
</fieldset>

<fieldset class="clFieldSetAlign">
<span>Daten eines zweiten Erziehungsberechtigten (optional)</span>
<?= $this->Form->control('e2name', ['label' => 'Nachname']) ?>
<?= $this->Form->control('e2vorname', ['label' => 'Vorname']) ?>
<?= $this->Form->control('e2telefon', ['label' => 'Telefon']) ?>
<?= $this->Form->control('e2geschlecht', [
    'label' => 'Geschlecht',
    'legend' => 'Geschlecht',
    'type' => 'radio',
    'options' => ['m' => 'männlich', 'w' => 'weiblich', 'd' => 'divers'],
]) ?>
</fieldset>
</div>
<?= $this->Form->control('abschluss', [
    'type' => 'textarea',
    'label' => 'sonstige Anmerkungen',
]) ?>

<p>
Nach dem Absenden erhalten Sie eine Ergebnisseite mit den wesentlichen Daten.
Drucken Sie diese Seite bitte aus und senden Sie den unterschriebenen Ausdruck ein.
</p>

</fieldset>

<?= $this->Form->hidden('antrag_token', [
    'value' => $antragToken,
]) //token wird in AntragsController gesetzt und hier mit gesendet
?>

<?= $this->Form->button('Absenden', ['class' => 'btn-submit'] ) ?>
<?= $this->Form->end() ?>

</div>
