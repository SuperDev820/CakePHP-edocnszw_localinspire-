<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UnhelpfulAnswer Entity
 *
 * @property int $id
 * @property int $answer_id
 * @property int $user_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Answer $answer
 * @property \App\Model\Entity\User $user
 */
class UnhelpfulAnswer extends Entity
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
        'answer_id' => true,
        'user_id' => true,
        'created' => true,
        'modified' => true,
        'answer' => true,
        'user' => true,
    ];
}
