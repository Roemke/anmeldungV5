<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\Query;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

final class AntragsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('antrags');
        $this->setPrimaryKey('id');
        $this->setDisplayField('id');

        // Timestamps vorhanden
        $this->addBehavior('Timestamp');

        // Associations (logisch, keine FK in DB)
        $this->belongsTo('Schulforms', [
            'foreignKey' => 'schulform_id',
        ]);

        $this->belongsTo('LastSchulForms', [
            'foreignKey' => 'last_schul_form_id',
            'bindingKey' => 'schulformNr',
        ]);

        $this->belongsTo('Staats', [
            'foreignKey' => 'staat_id',
        ]);

        $this->belongsTo('Konfessions', [
            'foreignKey' => 'konfession_id',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        // Pflichtfelder – Antragsteller
        $validator
            ->notEmptyString('name')
            ->notEmptyString('vorname')
            ->date('geburtsdatum')
            ->notEmptyDate('geburtsdatum')
            ->notEmptyString('geburtsort')
            ->email('email')
            ->notEmptyString('telefon');

        // Adresse
        $validator
            ->notEmptyString('strasse')
            ->notEmptyString('hausnummer')
            ->notEmptyString('plz')
            ->notEmptyString('stadt');

        // Auswahlfelder
        $validator
            ->notEmptyString('geschlecht')
            ->inList('geschlecht', ['m', 'w', 'd']);

        $validator
            ->notEmptyString('spaetaussiedler')
            ->inList('spaetaussiedler', ['J', 'N']);

        // Elternteil 1 (Pflicht)
        $validator
            ->notEmptyString('e1name')
            ->notEmptyString('e1vorname')
            ->notEmptyString('e1telefon');

        // Elternteil 2 (optional)
        $validator
            ->allowEmptyString('e2name')
            ->allowEmptyString('e2vorname');

        // Schule
        $validator
            ->notEmptyString('letzeschule');

        //bemerkungen am Ende
        $validator
            ->allowEmptyString('abschluss');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        // Eindeutigkeit: Name + Vorname + Geburtsdatum
        $rules->add(
            $rules->isUnique(
                ['name', 'vorname', 'geburtsdatum'],
                'Ein Antrag mit diesen Daten existiert bereits.'
            )
        );

        return $rules;
    }
}
