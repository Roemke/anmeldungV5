<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\LastSchulForm> $lastSchulForms
 */
?>
<div class="lastSchulForms index content">
    <?= $this->Html->link(__('New Last Schul Form'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Last Schul Forms') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('schulformNr') ?></th>
                    <th><?= $this->Paginator->sort('schulformKrz') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lastSchulForms as $lastSchulForm): ?>
                <tr>
                    <td><?= $this->Number->format($lastSchulForm->schulformNr) ?></td>
                    <td><?= h($lastSchulForm->schulformKrz) ?></td>
                    <td><?= h($lastSchulForm->title) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $lastSchulForm->schulformNr]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $lastSchulForm->schulformNr]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $lastSchulForm->schulformNr],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $lastSchulForm->schulformNr),
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