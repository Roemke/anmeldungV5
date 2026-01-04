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
            <?= $this->Html->link(__('List Last Schul Forms'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="lastSchulForms form content">
            <?= $this->Form->create($lastSchulForm) ?>
            <fieldset>
                <legend><?= __('Add Last Schul Form') ?></legend>
                <?php
                    echo $this->Form->control('schulformKrz');
                    echo $this->Form->control('title');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
