<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SearchKeyword Entity
 *
 * @property int $id
 * @property string $name
 * @property bool|null $enable_business
 * @property bool|null $enable_filter
 * @property string|null $icon
 * @property int $sic4category_id
 *
 * @property \App\Model\Entity\Sic4category $sic4category
 * @property \App\Model\Entity\Filter[] $filters
 */
class SearchKeyword extends Entity
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
        'enable_business' => true,
        'enable_filter' => true,
        'icon' => true,
        'sic4category_id' => true,
        'sic4category' => true,
        'filters' => true,
    ];
}
