<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FiltersSic8category Entity
 *
 * @property int $id
 * @property int $filter_id
 * @property int $sic8category_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Filter $filter
 * @property \App\Model\Entity\Sic8category $sic8category
 */
class FiltersSic8category extends Entity
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
        'filter_id' => true,
        'sic8category_id' => true,
        'created' => true,
        'modified' => true,
        'filter' => true,
        'sic8category' => true,
    ];
}
