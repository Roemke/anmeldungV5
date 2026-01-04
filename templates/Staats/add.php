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
            <?= $this->Html->link(__('List Staats'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="staats form content">
            <?= $this->Form->create($staat) ?>
            <fieldset>
                <legend><?= __('Add Staat') ?></legend>
                <?php
                    echo $this->Form->control('Bezeichnung');
                    echo $this->Form->control('StatistikKrz');
                    echo $this->Form->control('Sortierung');
                    echo $this->Form->control('Sichtbar');
                    echo $this->Form->control('Aenderbar');
                    echo $this->Form->control('ExportBez');
                    echo $this->Form->control('SchulnrEigner');
                    echo $this->Form->control('Bezeichnung2');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
