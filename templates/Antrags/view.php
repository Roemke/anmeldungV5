<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Antrag $antrag
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Antrag'), ['action' => 'edit', $antrag->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Antrag'), ['action' => 'delete', $antrag->id], ['confirm' => __('Are you sure you want to delete # {0}?', $antrag->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Antrags'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Antrag'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="antrags view content">
            <h3><?= h($antrag->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Schulform') ?></th>
                    <td><?= $antrag->hasValue('schulform') ? $this->Html->link($antrag->schulform->form, ['controller' => 'Schulforms', 'action' => 'view', $antrag->schulform->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('FstFormBevorzugt') ?></th>
                    <td><?= h($antrag->fstFormBevorzugt) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($antrag->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Vorname') ?></th>
                    <td><?= h($antrag->vorname) ?></td>
                </tr>
                <tr>
                    <th><?= __('Geschlecht') ?></th>
                    <td><?= h($antrag->geschlecht) ?></td>
                </tr>
                <tr>
                    <th><?= __('Spaetaussiedler') ?></th>
                    <td><?= h($antrag->spaetaussiedler) ?></td>
                </tr>
                <tr>
                    <th><?= __('Strasse') ?></th>
                    <td><?= h($antrag->strasse) ?></td>
                </tr>
                <tr>
                    <th><?= __('Hausnummer') ?></th>
                    <td><?= h($antrag->hausnummer) ?></td>
                </tr>
                <tr>
                    <th><?= __('Plz') ?></th>
                    <td><?= h($antrag->plz) ?></td>
                </tr>
                <tr>
                    <th><?= __('Stadt') ?></th>
                    <td><?= h($antrag->stadt) ?></td>
                </tr>
                <tr>
                    <th><?= __('Geburtsort') ?></th>
                    <td><?= h($antrag->geburtsort) ?></td>
                </tr>
                <tr>
                    <th><?= __('Familienstand') ?></th>
                    <td><?= h($antrag->familienstand) ?></td>
                </tr>
                <tr>
                    <th><?= __('Telefon') ?></th>
                    <td><?= h($antrag->telefon) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($antrag->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Staat') ?></th>
                    <td><?= $antrag->hasValue('staat') ? $this->Html->link($antrag->staat->Bezeichnung, ['controller' => 'Staats', 'action' => 'view', $antrag->staat->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Konfession') ?></th>
                    <td><?= $antrag->hasValue('konfession') ? $this->Html->link($antrag->konfession->bezeichnung, ['controller' => 'Konfessions', 'action' => 'view', $antrag->konfession->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('E1name') ?></th>
                    <td><?= h($antrag->e1name) ?></td>
                </tr>
                <tr>
                    <th><?= __('E1vorname') ?></th>
                    <td><?= h($antrag->e1vorname) ?></td>
                </tr>
                <tr>
                    <th><?= __('E1geschlecht') ?></th>
                    <td><?= h($antrag->e1geschlecht) ?></td>
                </tr>
                <tr>
                    <th><?= __('E1strasse') ?></th>
                    <td><?= h($antrag->e1strasse) ?></td>
                </tr>
                <tr>
                    <th><?= __('E1hausnummer') ?></th>
                    <td><?= h($antrag->e1hausnummer) ?></td>
                </tr>
                <tr>
                    <th><?= __('E1plz') ?></th>
                    <td><?= h($antrag->e1plz) ?></td>
                </tr>
                <tr>
                    <th><?= __('E1stadt') ?></th>
                    <td><?= h($antrag->e1stadt) ?></td>
                </tr>
                <tr>
                    <th><?= __('E1telefon') ?></th>
                    <td><?= h($antrag->e1telefon) ?></td>
                </tr>
                <tr>
                    <th><?= __('E2name') ?></th>
                    <td><?= h($antrag->e2name) ?></td>
                </tr>
                <tr>
                    <th><?= __('E2vorname') ?></th>
                    <td><?= h($antrag->e2vorname) ?></td>
                </tr>
                <tr>
                    <th><?= __('E2geschlecht') ?></th>
                    <td><?= h($antrag->e2geschlecht) ?></td>
                </tr>
                <tr>
                    <th><?= __('E2strasse') ?></th>
                    <td><?= h($antrag->e2strasse) ?></td>
                </tr>
                <tr>
                    <th><?= __('E2hausnummer') ?></th>
                    <td><?= h($antrag->e2hausnummer) ?></td>
                </tr>
                <tr>
                    <th><?= __('E2plz') ?></th>
                    <td><?= h($antrag->e2plz) ?></td>
                </tr>
                <tr>
                    <th><?= __('E2stadt') ?></th>
                    <td><?= h($antrag->e2stadt) ?></td>
                </tr>
                <tr>
                    <th><?= __('E2telefon') ?></th>
                    <td><?= h($antrag->e2telefon) ?></td>
                </tr>
                <tr>
                    <th><?= __('Letzeschule') ?></th>
                    <td><?= h($antrag->letzeschule) ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Schul Form') ?></th>
                    <td><?= $antrag->hasValue('last_schul_form') ? $this->Html->link($antrag->last_schul_form->title, ['controller' => 'LastSchulForms', 'action' => 'view', $antrag->last_schul_form->schulformNr]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Berufsausbildung Abgeschlossen') ?></th>
                    <td><?= h($antrag->berufsausbildung_abgeschlossen) ?></td>
                </tr>
                <tr>
                    <th><?= __('FoerderBedarf') ?></th>
                    <td><?= h($antrag->foerderBedarf) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($antrag->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Downloads') ?></th>
                    <td><?= $this->Number->format($antrag->downloads) ?></td>
                </tr>
                <tr>
                    <th><?= __('FoeASS') ?></th>
                    <td><?= $this->Number->format($antrag->foeASS) ?></td>
                </tr>
                <tr>
                    <th><?= __('FoeGE') ?></th>
                    <td><?= $this->Number->format($antrag->foeGE) ?></td>
                </tr>
                <tr>
                    <th><?= __('FoeHK') ?></th>
                    <td><?= $this->Number->format($antrag->foeHK) ?></td>
                </tr>
                <tr>
                    <th><?= __('FoeSE') ?></th>
                    <td><?= $this->Number->format($antrag->foeSE) ?></td>
                </tr>
                <tr>
                    <th><?= __('FoeKME') ?></th>
                    <td><?= $this->Number->format($antrag->foeKME) ?></td>
                </tr>
                <tr>
                    <th><?= __('FoeLES') ?></th>
                    <td><?= $this->Number->format($antrag->foeLES) ?></td>
                </tr>
                <tr>
                    <th><?= __('LastDownload') ?></th>
                    <td><?= h($antrag->lastDownload) ?></td>
                </tr>
                <tr>
                    <th><?= __('Geburtsdatum') ?></th>
                    <td><?= h($antrag->geburtsdatum) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($antrag->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($antrag->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Abschluss') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($antrag->abschluss)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Aufmerksam') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($antrag->aufmerksam)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>