<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

final class Staat extends Entity
{
    protected array $_accessible = [
        '*' => false,
        'Bezeichnung' => true,
        'Bezeichnung2' => true,
        'StatistikKrz' => true,
        'Sortierung' => true,
        'Sichtbar' => true,
        'Aenderbar' => true,
        'ExportBez' => true,
        'SchulnrEigner' => true,
    ];

    /**
     * Komfort-Helfer
     */
    protected function _getIsVisible(): bool
    {
        return $this->Sichtbar === '+';
    }
}
