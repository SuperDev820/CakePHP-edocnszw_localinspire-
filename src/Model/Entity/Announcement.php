<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Announcement Entity
 *
 * @property int $id
 * @property int $business_id
 * @property string $title
 * @property string $description
 * @property string|null $cta
 * @property string|null $link
 * @property string|null $start_date
 * @property string|null $stop_date
 * @property bool $active
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Business $business
 */
class Announcement extends Entity
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
        'description' => true,
        'cta' => true,
        'link' => true,
        'start_date' => true,
        'stop_date' => true,
        'active' => true,
        'created' => true,
        'modified' => true,
        'business' => true,
    ];
}
