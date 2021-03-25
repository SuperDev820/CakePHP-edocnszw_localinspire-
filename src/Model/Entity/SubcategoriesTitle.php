<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SubcategoriesTitle Entity
 *
 * @property int $id
 * @property int $subcategory_id
 * @property int $title_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Subcategory $subcategory
 * @property \App\Model\Entity\Title $title
 */
class SubcategoriesTitle extends Entity
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
        'subcategory_id' => true,
        'title_id' => true,
        'created' => true,
        'modified' => true,
        'subcategory' => true,
        'title' => true,
    ];
}
