<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Sic4category Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Business[] $businesses
 * @property \App\Model\Entity\SearchKeyword[] $search_keywords
 * @property \App\Model\Entity\Subcategory[] $subcategories
 * @property \App\Model\Entity\Filter[] $filters
 * @property \App\Model\Entity\Sic2category[] $sic2categories
 * @property \App\Model\Entity\Sic8category[] $sic8categories
 */
class Sic4category extends Entity
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
        'description' => true,
        'created' => true,
        'modified' => true,
        'businesses' => true,
        'search_keywords' => true,
        'subcategories' => true,
        'filters' => true,
        'sic2categories' => true,
        'sic8categories' => true,
    ];
}
