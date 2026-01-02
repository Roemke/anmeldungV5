<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

final class LastSchulForm extends Entity
{
    protected array $_accessible = [
        '*' => false,
        'schulformKrz' => true,
        'title' => true,
    ];
}
