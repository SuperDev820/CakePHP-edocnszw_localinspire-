<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * QuestionReport Entity
 *
 * @property int $id
 * @property int $question_id
 * @property int $user_id
 * @property string $why
 * @property string|null $specific_detail
 * @property bool|null $treated
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Question $question
 * @property \App\Model\Entity\User $user
 */
class QuestionReport extends Entity
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
        'question_id' => true,
        'user_id' => true,
        'why' => true,
        'specific_detail' => true,
        'treated' => true,
        'created' => true,
        'modified' => true,
        'question' => true,
        'user' => true,
    ];
}
