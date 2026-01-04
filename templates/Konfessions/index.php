<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Konfession> $konfessions
 */
?>
<div class="konfessions index content">
    <?= $this->Html->link(__('New Konfession'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Konfessions') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('kuerzel') ?></th>
                    <th><?= $this->Paginator->sort('bezeichnung') ?></th>
                    <th><?= $this->Paginator->sort('bez_schild') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($konfessions as $konfession): ?>
                <tr>
                    <td><?= $this->Number->format($konfession->id) ?></td>
                    <td><?= h($konfession->kuerzel) ?></td>
                    <td><?= h($konfession->bezeichnung) ?></td>
                    <td><?= h($konfession->bez_schild) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $konfession->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $konfession->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $konfession->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $konfession->id),
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