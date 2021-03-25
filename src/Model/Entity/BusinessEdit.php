<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BusinessEdit Entity
 *
 * @property int $id
 * @property int $business_id
 * @property string|null $edits_json
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string|null $changes
 * @property bool|null $approved
 * @property bool|null $declined
 * @property string|null $original
 * @property int $user_id
 *
 * @property \App\Model\Entity\Business $business
 * @property \App\Model\Entity\User $user
 */
class BusinessEdit extends Entity
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
        'edits_json' => true,
        'created' => true,
        'modified' => true,
        'changes' => true,
        'approved' => true,
        'declined' => true,
        'original' => true,
        'user_id' => true,
        'business' => true,
        'user' => true,
    ];
}
