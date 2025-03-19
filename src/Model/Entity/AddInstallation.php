<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AddInstallation Entity
 *
 * @property int $id
 * @property string $mat_fisc
 * @property string $add
 * @property string $gouvernorat
 */
class AddInstallation extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'mat_fisc' => true,
        'add' => true,
        'gouvernorat' => true,
    ];
}
