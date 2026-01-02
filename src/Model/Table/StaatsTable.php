<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

final class StaatsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('staats');
        $this->setPrimaryKey('id');
        $this->setDisplayField('Bezeichnung');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->notEmptyString('id');

        $validator
            ->scalar('Bezeichnung')
            ->maxLength('Bezeichnung', 80)
            ->notEmptyString('Bezeichnung');

        $validator
            ->scalar('StatistikKrz')
            ->maxLength('StatistikKrz', 4)
            ->notEmptyString('StatistikKrz');

        return $validator;
    }

    /**
     * Nur sichtbare Staaten, sortiert für Select-Felder
     * nein sichtbar raus lassen
     */
    public function findForSelect(Query $query, array $options = [])
    {
        return $query
            //->where(['Sichtbar' => '+'])
            ->orderBy([
                'Sortierung' => 'ASC',
                'Bezeichnung' => 'ASC',
            ])
            ->find('list', [
                'keyField' => 'id',
                'valueField' => 'Bezeichnung',
            ]);
    }
}
