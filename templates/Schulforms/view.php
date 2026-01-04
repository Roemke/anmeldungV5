<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Schulform $schulform
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Schulform'), ['action' => 'edit', $schulform->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Schulform'), ['action' => 'delete', $schulform->id], ['confirm' => __('Are you sure you want to delete # {0}?', $schulform->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Schulforms'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Schulform'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="schulforms view content">
            <h3><?= h($schulform->form) ?></h3>
            <table>
                <tr>
                    <th><?= __('Form') ?></th>
                    <td><?= h($schulform->form) ?></td>
                </tr>
                <tr>
                    <th><?= __('Klasse') ?></th>
                    <td><?= h($schulform->klasse) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($schulform->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>