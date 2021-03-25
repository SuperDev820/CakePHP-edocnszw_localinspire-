<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Subcategory Entity
 *
 * @property int $id
 * @property string $name
 * @property int $category_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $sic4category_id
 *
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Sic4category $sic4category
 * @property \App\Model\Entity\Business[] $businesses
 * @property \App\Model\Entity\Filter[] $filters
 * @property \App\Model\Entity\Title[] $titles
 */
class Subcategory extends Entity
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
        'name' => true,
        'category_id' => true,
        'created' => true,
        'modified' => true,
        'sic4category_id' => true,
        'category' => true,
        'sic4category' => true,
        'businesses' => true,
        'filters' => true,
        'titles' => true,
    ];
}
