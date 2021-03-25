<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CollectionItem Entity
 *
 * @property int $id
 * @property int $collection_id
 * @property int $business_id
 * @property string|null $note
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Collection $collection
 * @property \App\Model\Entity\Business $business
 */
class CollectionItem extends Entity
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
        'collection_id' => true,
        'business_id' => true,
        'note' => true,
        'created' => true,
        'modified' => true,
        'collection' => true,
        'business' => true,
    ];
}
