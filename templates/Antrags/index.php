<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Antrag> $antrags
 */
?>
<div class="antrags index content">
    <?= $this->Html->link(__('New Antrag'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Antrags') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('downloads') ?></th>
                    <th><?= $this->Paginator->sort('lastDownload') ?></th>
                    <th><?= $this->Paginator->sort('schulform_id') ?></th>
                    <th><?= $this->Paginator->sort('fstFormBevorzugt') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('vorname') ?></th>
                    <th><?= $this->Paginator->sort('geschlecht') ?></th>
                    <th><?= $this->Paginator->sort('spaetaussiedler') ?></th>
                    <th><?= $this->Paginator->sort('strasse') ?></th>
                    <th><?= $this->Paginator->sort('hausnummer') ?></th>
                    <th><?= $this->Paginator->sort('plz') ?></th>
                    <th><?= $this->Paginator->sort('stadt') ?></th>
                    <th><?= $this->Paginator->sort('geburtsort') ?></th>
                    <th><?= $this->Paginator->sort('geburtsdatum') ?></th>
                    <th><?= $this->Paginator->sort('familienstand') ?></th>
                    <th><?= $this->Paginator->sort('telefon') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('staat_id') ?></th>
                    <th><?= $this->Paginator->sort('konfession_id') ?></th>
                    <th><?= $this->Paginator->sort('e1name') ?></th>
                    <th><?= $this->Paginator->sort('e1vorname') ?></th>
                    <th><?= $this->Paginator->sort('e1geschlecht') ?></th>
                    <th><?= $this->Paginator->sort('e1strasse') ?></th>
                    <th><?= $this->Paginator->sort('e1hausnummer') ?></th>
                    <th><?= $this->Paginator->sort('e1plz') ?></th>
                    <th><?= $this->Paginator->sort('e1stadt') ?></th>
                    <th><?= $this->Paginator->sort('e1telefon') ?></th>
                    <th><?= $this->Paginator->sort('e2name') ?></th>
                    <th><?= $this->Paginator->sort('e2vorname') ?></th>
                    <th><?= $this->Paginator->sort('e2geschlecht') ?></th>
                    <th><?= $this->Paginator->sort('e2strasse') ?></th>
                    <th><?= $this->Paginator->sort('e2hausnummer') ?></th>
                    <th><?= $this->Paginator->sort('e2plz') ?></th>
                    <th><?= $this->Paginator->sort('e2stadt') ?></th>
                    <th><?= $this->Paginator->sort('e2telefon') ?></th>
                    <th><?= $this->Paginator->sort('letzeschule') ?></th>
                    <th><?= $this->Paginator->sort('last_schul_form_id') ?></th>
                    <th><?= $this->Paginator->sort('berufsausbildung_abgeschlossen') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('foerderBedarf') ?></th>
                    <th><?= $this->Paginator->sort('foeASS') ?></th>
                    <th><?= $this->Paginator->sort('foeGE') ?></th>
                    <th><?= $this->Paginator->sort('foeHK') ?></th>
                    <th><?= $this->Paginator->sort('foeSE') ?></th>
                    <th><?= $this->Paginator->sort('foeKME') ?></th>
                    <th><?= $this->Paginator->sort('foeLES') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($antrags as $antrag): ?>
                <tr>
                    <td><?= $this->Number->format($antrag->id) ?></td>
                    <td><?= $this->Number->format($antrag->downloads) ?></td>
                    <td><?= h($antrag->lastDownload) ?></td>
                    <td><?= $antrag->hasValue('schulform') ? $this->Html->link($antrag->schulform->form, ['controller' => 'Schulforms', 'action' => 'view', $antrag->schulform->id]) : '' ?></td>
                    <td><?= h($antrag->fstFormBevorzugt) ?></td>
                    <td><?= h($antrag->name) ?></td>
                    <td><?= h($antrag->vorname) ?></td>
                    <td><?= h($antrag->geschlecht) ?></td>
                    <td><?= h($antrag->spaetaussiedler) ?></td>
                    <td><?= h($antrag->strasse) ?></td>
                    <td><?= h($antrag->hausnummer) ?></td>
                    <td><?= h($antrag->plz) ?></td>
                    <td><?= h($antrag->stadt) ?></td>
                    <td><?= h($antrag->geburtsort) ?></td>
                    <td><?= h($antrag->geburtsdatum) ?></td>
                    <td><?= h($antrag->familienstand) ?></td>
                    <td><?= h($antrag->telefon) ?></td>
                    <td><?= h($antrag->email) ?></td>
                    <td><?= $antrag->hasValue('staat') ? $this->Html->link($antrag->staat->Bezeichnung, ['controller' => 'Staats', 'action' => 'view', $antrag->staat->id]) : '' ?></td>
                    <td><?= $antrag->hasValue('konfession') ? $this->Html->link($antrag->konfession->bezeichnung, ['controller' => 'Konfessions', 'action' => 'view', $antrag->konfession->id]) : '' ?></td>
                    <td><?= h($antrag->e1name) ?></td>
                    <td><?= h($antrag->e1vorname) ?></td>
                    <td><?= h($antrag->e1geschlecht) ?></td>
                    <td><?= h($antrag->e1strasse) ?></td>
                    <td><?= h($antrag->e1hausnummer) ?></td>
                    <td><?= h($antrag->e1plz) ?></td>
                    <td><?= h($antrag->e1stadt) ?></td>
                    <td><?= h($antrag->e1telefon) ?></td>
                    <td><?= h($antrag->e2name) ?></td>
                    <td><?= h($antrag->e2vorname) ?></td>
                    <td><?= h($antrag->e2geschlecht) ?></td>
                    <td><?= h($antrag->e2strasse) ?></td>
                    <td><?= h($antrag->e2hausnummer) ?></td>
                    <td><?= h($antrag->e2plz) ?></td>
                    <td><?= h($antrag->e2stadt) ?></td>
                    <td><?= h($antrag->e2telefon) ?></td>
                    <td><?= h($antrag->letzeschule) ?></td>
                    <td><?= $antrag->hasValue('last_schul_form') ? $this->Html->link($antrag->last_schul_form->title, ['controller' => 'LastSchulForms', 'action' => 'view', $antrag->last_schul_form->schulformNr]) : '' ?></td>
                    <td><?= h($antrag->berufsausbildung_abgeschlossen) ?></td>
                    <td><?= h($antrag->created) ?></td>
                    <td><?= h($antrag->modified) ?></td>
                    <td><?= h($antrag->foerderBedarf) ?></td>
                    <td><?= $this->Number->format($antrag->foeASS) ?></td>
                    <td><?= $this->Number->format($antrag->foeGE) ?></td>
                    <td><?= $this->Number->format($antrag->foeHK) ?></td>
                    <td><?= $this->Number->format($antrag->foeSE) ?></td>
                    <td><?= $this->Number->format($antrag->foeKME) ?></td>
                    <td><?= $this->Number->format($antrag->foeLES) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $antrag->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $antrag->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $antrag->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $antrag->id),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>