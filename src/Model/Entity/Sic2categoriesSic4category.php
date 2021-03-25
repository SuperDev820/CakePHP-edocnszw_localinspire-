<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Sic2categoriesSic4category Entity
 *
 * @property int $id
 * @property int $sic2category_id
 * @property int $sic4category_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Sic2category $sic2category
 * @property \App\Model\Entity\Sic4category $sic4category
 */
class Sic2categoriesSic4category extends Entity
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
        'sic2category_id' => true,
        'sic4category_id' => true,
        'created' => true,
        'modified' => true,
        'sic2category' => true,
        'sic4category' => true,
    ];
}
