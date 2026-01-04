<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Antrag $antrag
 * @var string[]|\Cake\Collection\CollectionInterface $schulforms
 * @var string[]|\Cake\Collection\CollectionInterface $lastSchulForms
 * @var string[]|\Cake\Collection\CollectionInterface $staats
 * @var string[]|\Cake\Collection\CollectionInterface $konfessions
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $antrag->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $antrag->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Antrags'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="antrags form content">
            <?= $this->Form->create($antrag) ?>
            <fieldset>
                <legend><?= __('Edit Antrag') ?></legend>
                <?php
                    echo $this->Form->control('downloads');
                    echo $this->Form->control('lastDownload', ['empty' => true]);
                    echo $this->Form->control('schulform_id', ['options' => $schulforms]);
                    echo $this->Form->control('fstFormBevorzugt');
                    echo $this->Form->control('name');
                    echo $this->Form->control('vorname');
                    echo $this->Form->control('geschlecht');
                    echo $this->Form->control('spaetaussiedler');
                    echo $this->Form->control('strasse');
                    echo $this->Form->control('hausnummer');
                    echo $this->Form->control('plz');
                    echo $this->Form->control('stadt');
                    echo $this->Form->control('geburtsort');
                    echo $this->Form->control('geburtsdatum');
                    echo $this->Form->control('familienstand');
                    echo $this->Form->control('telefon');
                    echo $this->Form->control('email');
                    echo $this->Form->control('staat_id', ['options' => $staats]);
                    echo $this->Form->control('konfession_id', ['options' => $konfessions]);
                    echo $this->Form->control('e1name');
                    echo $this->Form->control('e1vorname');
                    echo $this->Form->control('e1geschlecht');
                    echo $this->Form->control('e1strasse');
                    echo $this->Form->control('e1hausnummer');
                    echo $this->Form->control('e1plz');
                    echo $this->Form->control('e1stadt');
                    echo $this->Form->control('e1telefon');
                    echo $this->Form->control('e2name');
                    echo $this->Form->control('e2vorname');
                    echo $this->Form->control('e2geschlecht');
                    echo $this->Form->control('e2strasse');
                    echo $this->Form->control('e2hausnummer');
                    echo $this->Form->control('e2plz');
                    echo $this->Form->control('e2stadt');
                    echo $this->Form->control('e2telefon');
                    echo $this->Form->control('letzeschule');
                    echo $this->Form->control('last_schul_form_id', ['options' => $lastSchulForms]);
                    echo $this->Form->control('abschluss');
                    echo $this->Form->control('berufsausbildung_abgeschlossen');
                    echo $this->Form->control('foerderBedarf');
                    echo $this->Form->control('foeASS');
                    echo $this->Form->control('foeGE');
                    echo $this->Form->control('foeHK');
                    echo $this->Form->control('foeSE');
                    echo $this->Form->control('foeKME');
                    echo $this->Form->control('foeLES');
                    echo $this->Form->control('aufmerksam');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
