<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

final class KonfessionsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('konfessions');
        $this->setPrimaryKey('id');
        $this->setDisplayField('bezeichnung');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('kuerzel')
            ->maxLength('kuerzel', 10)
            ->notEmptyString('kuerzel');

        $validator
            ->scalar('bezeichnung')
            ->maxLength('bezeichnung', 64)
            ->notEmptyString('bezeichnung');

        $validator
            ->scalar('bez_schild')
            ->maxLength('bez_schild', 64)
            ->notEmptyString('bez_schild');

        return $validator;
    }

    /**
     * Für Dropdowns / Select-Felder
     */
    public function findForSelect(\Cake\ORM\Query $query, array $options = [])
    {
        return $query
            ->orderBy(['bezeichnung' => 'ASC'])
            ->find('list', [
            'keyField' => 'id',
            'valueField' => 'bezeichnung',
        ]);
    }
}
