<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Soc Entity
 *
 * @property string $mat_fisc
 * @property string $nom
 * @property string $add_loc
 * @property string $gouvernorat
 * @property int $num_tel
 * @property string $presenteur
 */
class Soc extends Entity
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
        'nom' => true,
        'add_loc' => true,
        'gouvernorat' => true,
        'num_tel' => true,
        'presenteur' => true,
    ];
}
