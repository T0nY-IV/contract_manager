<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Contract Entity
 *
 * @property int $id
 * @property string $nom_soc
 * @property string $presenter
 * @property string $gouvernorat
 * @property string $poids_assenseur
 * @property string|null $cntrct
 */
class Contract extends Entity
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
        'nom_soc' => true,
        'presenter' => true,
        'gouvernorat' => true,
        'poids_assenseur' => true,
        'cntrct' => true,
    ];
}
