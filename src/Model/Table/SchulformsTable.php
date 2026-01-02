<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

final class SchulformsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('schulforms');
        $this->setPrimaryKey('id');
        $this->setDisplayField('form');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('form')
            ->maxLength('form', 128)
            ->notEmptyString('form');

        $validator
            ->scalar('klasse')
            ->maxLength('klasse', 16)
            ->notEmptyString('klasse');

        return $validator;
    }

    /**
     * Für Select-Felder (z. B. "Gymnasium (Klasse 10)")
     */
    public function findForSelect(Query $query, array $options = [])
    {
    return $query
        ->orderBy(['form' => 'ASC', 'klasse' => 'ASC'])
        ->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row->form . ' (Klasse ' . $row->klasse . ')';
            },
        ]);
    }

}
