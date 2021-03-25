<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Sic4categoriesSic8category Entity
 *
 * @property int $id
 * @property int $sic4category_id
 * @property int $sic8category_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Sic4category $sic4category
 * @property \App\Model\Entity\Sic8category $sic8category
 */
class Sic4categoriesSic8category extends Entity
{
    /**
     * Fields that can be mass assigned using newEmptyEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'sic4category_id' => true,
        'sic8category_id' => true,
        'created' => true,
        'modified' => true,
        'sic4category' => true,
        'sic8category' => true,
    ];
}
