<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BusinessAdditional Entity
 *
 * @property int $id
 * @property int $filter_id
 * @property int $business_id
 * @property string|null $value
 * @property string|null $value2
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Filter $filter
 * @property \App\Model\Entity\Business $business
 */
class BusinessAdditional extends Entity
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
        'business_id' => true,
        'value' => true,
        'value2' => true,
        'created' => true,
        'modified' => true,
        'filter' => true,
        'business' => true,
    ];
}
