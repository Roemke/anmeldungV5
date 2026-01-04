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
            <?= $this->Html->link(__('List Schulforms'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="schulforms form content">
            <?= $this->Form->create($schulform) ?>
            <fieldset>
                <legend><?= __('Add Schulform') ?></legend>
                <?php
                    echo $this->Form->control('form');
                    echo $this->Form->control('klasse');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
