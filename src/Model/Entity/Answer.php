<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Answer Entity
 *
 * @property int $id
 * @property int $question_id
 * @property int $user_id
 * @property string|null $answer
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property bool|null $mosthelpful
 *
 * @property \App\Model\Entity\Question $question
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\AnswerReport[] $answer_reports
 * @property \App\Model\Entity\HelpfulAnswer[] $helpful_answers
 * @property \App\Model\Entity\UnhelpfulAnswer[] $unhelpful_answers
 * @property \App\Model\Entity\UserActivity[] $user_activities
 */
class Answer extends Entity
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
        'answer' => true,
        'created' => true,
        'modified' => true,
        'mosthelpful' => true,
        'question' => true,
        'user' => true,
        'answer_reports' => true,
        'helpful_answers' => true,
        'unhelpful_answers' => true,
        'user_activities' => true,
    ];
}
