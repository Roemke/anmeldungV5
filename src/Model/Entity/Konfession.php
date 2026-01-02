<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

final class Konfession extends Entity
{
    protected array $_accessible = [
        '*' => false,
        'kuerzel' => true,
        'bezeichnung' => true,
        'bez_schild' => true,
    ];
}
