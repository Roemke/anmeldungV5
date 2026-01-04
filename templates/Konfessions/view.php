<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Konfession $konfession
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Konfession'), ['action' => 'edit', $konfession->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Konfession'), ['action' => 'delete', $konfession->id], ['confirm' => __('Are you sure you want to delete # {0}?', $konfession->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Konfessions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Konfession'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="konfessions view content">
            <h3><?= h($konfession->bezeichnung) ?></h3>
            <table>
                <tr>
                    <th><?= __('Kuerzel') ?></th>
                    <td><?= h($konfession->kuerzel) ?></td>
                </tr>
                <tr>
                    <th><?= __('Bezeichnung') ?></th>
                    <td><?= h($konfession->bezeichnung) ?></td>
                </tr>
                <tr>
                    <th><?= __('Bez Schild') ?></th>
                    <td><?= h($konfession->bez_schild) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($konfession->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>