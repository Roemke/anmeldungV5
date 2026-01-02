<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

final class Schulform extends Entity
{
    protected array $_accessible = [
        '*' => false,
        'form' => true,
        'klasse' => true,
    ];
}
