<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Conversation Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $receiver_id
 * @property bool|null $user_deleted
 * @property bool|null $receiver_deleted
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string|null $updated
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Receiver $receiver
 * @property \App\Model\Entity\Message[] $messages
 */
class Conversation extends Entity
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
        'receiver_id' => true,
        'user_deleted' => true,
        'receiver_deleted' => true,
        'created' => true,
        'modified' => true,
        'updated' => true,
        'user' => true,
        'receiver' => true,
        'messages' => true,
    ];
}
