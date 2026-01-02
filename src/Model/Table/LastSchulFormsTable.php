<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

final class LastSchulFormsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('lastSchulForms');
        $this->setPrimaryKey('schulformNr');
        $this->setDisplayField('title');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('schulformNr')
            ->notEmptyString('schulformNr');

        $validator
            ->scalar('schulformKrz')
            ->maxLength('schulformKrz', 2)
            ->notEmptyString('schulformKrz');

        $validator
            ->scalar('title')
            ->maxLength('title', 64)
            ->notEmptyString('title');

        return $validator;
    }

    /**
     * Für Select-Felder
     */
    public function findForSelect(Query $query, array $options = [])
    {
        return $query
            ->orderBy(['title' => 'ASC'])
            ->find('list', [
                'keyField' => 'schulformNr',
                'valueField' => 'title',
            ]);
    }
}
