<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * NotificationSetting Entity
 *
 * @property int $id
 * @property int $user_id
 * @property bool|null $messages
 * @property bool|null $follows
 * @property bool|null $answers
 * @property bool|null $photo_activity
 * @property bool|null $review_activity
 * @property bool|null $business_edits
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 */
class NotificationSetting extends Entity
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
        'user_id' => true,
        'messages' => true,
        'follows' => true,
        'answers' => true,
        'photo_activity' => true,
        'review_activity' => true,
        'business_edits' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
    ];
}
