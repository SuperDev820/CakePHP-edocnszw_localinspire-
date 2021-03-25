<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FiltersSubcategory Entity
 *
 * @property int $id
 * @property int $filter_id
 * @property int $subcategory_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Filter $filter
 * @property \App\Model\Entity\Subcategory $subcategory
 */
class FiltersSubcategory extends Entity
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
        'subcategory_id' => true,
        'created' => true,
        'modified' => true,
        'filter' => true,
        'subcategory' => true,
    ];
}
