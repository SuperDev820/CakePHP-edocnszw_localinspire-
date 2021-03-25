<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Offer Entity
 *
 * @property int $id
 * @property int $business_id
 * @property string $title
 * @property bool|null $code_offer
 * @property string|null $code
 * @property bool|null $link_offer
 * @property string|null $link
 * @property bool|null $all_members
 * @property bool|null $collection_members
 * @property bool|null $regular
 * @property bool|null $birthday
 * @property bool|null $anniversary
 * @property string|null $start_date
 * @property string|null $stop_date
 * @property string|null $conditions
 * @property string|null $description
 * @property bool|null $active
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Business $business
 */
class Offer extends Entity
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
        'business_id' => true,
        'title' => true,
        'code_offer' => true,
        'code' => true,
        'link_offer' => true,
        'link' => true,
        'all_members' => true,
        'collection_members' => true,
        'regular' => true,
        'birthday' => true,
        'anniversary' => true,
        'start_date' => true,
        'stop_date' => true,
        'conditions' => true,
        'description' => true,
        'active' => true,
        'created' => true,
        'modified' => true,
        'business' => true,
    ];
}
