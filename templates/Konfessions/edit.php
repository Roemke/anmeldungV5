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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $konfession->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $konfession->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Konfessions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="konfessions form content">
            <?= $this->Form->create($konfession) ?>
            <fieldset>
                <legend><?= __('Edit Konfession') ?></legend>
                <?php
                    echo $this->Form->control('kuerzel');
                    echo $this->Form->control('bezeichnung');
                    echo $this->Form->control('bez_schild');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
