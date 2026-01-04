<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Staat> $staats
 */
?>
<div class="staats index content">
    <?= $this->Html->link(__('New Staat'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Staats') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('Bezeichnung') ?></th>
                    <th><?= $this->Paginator->sort('StatistikKrz') ?></th>
                    <th><?= $this->Paginator->sort('Sortierung') ?></th>
                    <th><?= $this->Paginator->sort('Sichtbar') ?></th>
                    <th><?= $this->Paginator->sort('Aenderbar') ?></th>
                    <th><?= $this->Paginator->sort('ExportBez') ?></th>
                    <th><?= $this->Paginator->sort('SchulnrEigner') ?></th>
                    <th><?= $this->Paginator->sort('Bezeichnung2') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($staats as $staat): ?>
                <tr>
                    <td><?= $this->Number->format($staat->id) ?></td>
                    <td><?= h($staat->Bezeichnung) ?></td>
                    <td><?= h($staat->StatistikKrz) ?></td>
                    <td><?= $staat->Sortierung === null ? '' : $this->Number->format($staat->Sortierung) ?></td>
                    <td><?= h($staat->Sichtbar) ?></td>
                    <td><?= h($staat->Aenderbar) ?></td>
                    <td><?= h($staat->ExportBez) ?></td>
                    <td><?= $staat->SchulnrEigner === null ? '' : $this->Number->format($staat->SchulnrEigner) ?></td>
                    <td><?= h($staat->Bezeichnung2) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $staat->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $staat->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $staat->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $staat->id),
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