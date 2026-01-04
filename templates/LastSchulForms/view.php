<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LastSchulForm $lastSchulForm
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Last Schul Form'), ['action' => 'edit', $lastSchulForm->schulformNr], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Last Schul Form'), ['action' => 'delete', $lastSchulForm->schulformNr], ['confirm' => __('Are you sure you want to delete # {0}?', $lastSchulForm->schulformNr), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Last Schul Forms'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Last Schul Form'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="lastSchulForms view content">
            <h3><?= h($lastSchulForm->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('SchulformKrz') ?></th>
                    <td><?= h($lastSchulForm->schulformKrz) ?></td>
                </tr>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($lastSchulForm->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('SchulformNr') ?></th>
                    <td><?= $this->Number->format($lastSchulForm->schulformNr) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>