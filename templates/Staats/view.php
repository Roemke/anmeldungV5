<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Staat $staat
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Staat'), ['action' => 'edit', $staat->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Staat'), ['action' => 'delete', $staat->id], ['confirm' => __('Are you sure you want to delete # {0}?', $staat->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Staats'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Staat'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="staats view content">
            <h3><?= h($staat->Bezeichnung) ?></h3>
            <table>
                <tr>
                    <th><?= __('Bezeichnung') ?></th>
                    <td><?= h($staat->Bezeichnung) ?></td>
                </tr>
                <tr>
                    <th><?= __('StatistikKrz') ?></th>
                    <td><?= h($staat->StatistikKrz) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sichtbar') ?></th>
                    <td><?= h($staat->Sichtbar) ?></td>
                </tr>
                <tr>
                    <th><?= __('Aenderbar') ?></th>
                    <td><?= h($staat->Aenderbar) ?></td>
                </tr>
                <tr>
                    <th><?= __('ExportBez') ?></th>
                    <td><?= h($staat->ExportBez) ?></td>
                </tr>
                <tr>
                    <th><?= __('Bezeichnung2') ?></th>
                    <td><?= h($staat->Bezeichnung2) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($staat->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sortierung') ?></th>
                    <td><?= $staat->Sortierung === null ? '' : $this->Number->format($staat->Sortierung) ?></td>
                </tr>
                <tr>
                    <th><?= __('SchulnrEigner') ?></th>
                    <td><?= $staat->SchulnrEigner === null ? '' : $this->Number->format($staat->SchulnrEigner) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>