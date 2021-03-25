<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Message Entity
 *
 * @property int $id
 * @property int $conversation_id
 * @property int $user_id
 * @property string $body
 * @property bool|null $read
 * @property bool|null $user_deleted
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Conversation $conversation
 * @property \App\Model\Entity\User $user
 */
class Message extends Entity
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
        'conversation_id' => true,
        'user_id' => true,
        'body' => true,
        'read' => true,
        'user_deleted' => true,
        'created' => true,
        'modified' => true,
        'conversation' => true,
        'user' => true,
    ];
}
