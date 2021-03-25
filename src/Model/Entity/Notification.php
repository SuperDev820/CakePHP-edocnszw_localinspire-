<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Notification Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $notification_type_id
 * @property string $message
 * @property bool|null $viewed
 * @property string|null $description
 * @property string|null $url
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int|null $message_user_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\NotificationType $notification_type
 * @property \App\Model\Entity\MessageUser $message_user
 */
class Notification extends Entity
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
        'notification_type_id' => true,
        'message' => true,
        'viewed' => true,
        'description' => true,
        'url' => true,
        'created' => true,
        'modified' => true,
        'message_user_id' => true,
        'user' => true,
        'notification_type' => true,
        'message_user' => true,
    ];
}
