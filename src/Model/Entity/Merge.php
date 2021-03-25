<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Merge Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $merge_user_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $passkey
 * @property string $token
 * @property bool|null $merged
 * @property string|null $link
 * @property string|null $deleted_user
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\MergeUser $merge_user
 */
class Merge extends Entity
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
        'merge_user_id' => true,
        'created' => true,
        'modified' => true,
        'passkey' => true,
        'token' => true,
        'merged' => true,
        'link' => true,
        'deleted_user' => true,
        'user' => true,
        'merge_user' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'token',
    ];
}
