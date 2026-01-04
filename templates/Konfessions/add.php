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
            <?= $this->Html->link(__('List Konfessions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="konfessions form content">
            <?= $this->Form->create($konfession) ?>
            <fieldset>
                <legend><?= __('Add Konfession') ?></legend>
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
