<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

final class User extends Entity
{
    protected array $_accessible = [
        '*' => false,
        'username' => true,
        'password' => true,
        'is_admin' => true,
        'created' => true,
        'modified' => true,
    ];

    protected array $_hidden = [
        'password',
    ];
}
