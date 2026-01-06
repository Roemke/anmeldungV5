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
                <th class="actions"><?= __('Actions') ?></th>
                <th><?= $this->Paginator->sort('downloads','#DL') ?></th>
                <th><?= $this->Paginator->sort('lastDownload','LDL') ?></th>
                <th><?= $this->Paginator->sort('schulform_id', 'BG') ?></th>
                <th><?= $this->Paginator->sort('name', 'Nachname') ?></th>
                <th><?= $this->Paginator->sort('vorname', 'Vorname') ?></th>
                <th><?= $this->Paginator->sort('geschlecht') ?></th>
                <th><?= $this->Paginator->sort('telefon') ?></th>
                <th><?= $this->Paginator->sort('email') ?></th>
                <th><?= $this->Paginator->sort('stadt') ?></th>
                <th><?= $this->Paginator->sort('foerderBedarf', 'Förderbedarf') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>

            </tr>
            </thead>
            <tbody>
                <?php foreach ($antrags as $antrag): ?>
                <tr>
                    <td class="actions" id="myactions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $antrag->id]) ?>
                        <?= $this->Html->link(__('Print'),['action' => 'print', $antrag->id],
                                ['target' => '_blank', 'rel' => 'noopener'] ) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $antrag->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $antrag->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $antrag->id),
                            ]
                        ) ?>
                        (#<?=  $antrag->id ?>)
                    </td>
                    <td><?= $this->Number->format($antrag->downloads) ?></td>
                    <td><?= $antrag->lastDownload ? $antrag->lastDownload->format('d.m.Y H:i') : '' ?></td>

                    <td><?= $antrag->hasValue('schulform') ?
                        //$this->Html->link($antrag->schulform->form, ['controller' => 'Schulforms', 'action' => 'view', $antrag->schulform->id]) : ''
                        $this->Html->link($antrag->schulform->id, ['controller' => 'Schulforms', 'action' => 'view', $antrag->schulform->id]) : ''
                        ?></td>
                    <td><?= h($antrag->name) ?></td>
                    <td><?= h($antrag->vorname) ?></td>
                    <td><?= h($antrag->geschlecht) ?></td>
                    <td><?= h($antrag->telefon) ?></td>
                    <td><?= h($antrag->email) ?></td>
                    <td><?= h($antrag->stadt) ?></td>
                    <td><?= h($antrag->foerderBedarf) ?></td>
                    <td><?= $antrag->created->format('d.m.Y H:i') ?></td>

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
